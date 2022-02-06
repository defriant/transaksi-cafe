<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\TProduk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WebController extends Controller
{
    public function login_attempt(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect('/check-this-user-role');
        } else {
            Session::flash('failed');
            return redirect()->back()->withInput($request->all());
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function check_role()
    {
        if (Auth::user()->role == "admin") {
            return redirect('/admin/dashboard');
        } elseif (Auth::user()->role == "kasir") {
            return redirect('/dashboard');
        }
    }

    public function get_dashboard()
    {
        $produk = Produk::all();
        $total_terjual = TProduk::all()->sum('jumlah');
        $produkSort = [];

        foreach ($produk as $p) {
            $produkSort[] = [
                "nama" => $p->nama,
                "terjual" => $p->tproduk->sum('jumlah')
            ];
        }

        usort($produkSort, function ($a, $b) {
            return $a['terjual'] < $b['terjual'];
        });

        $produkTerlaris = array_slice($produkSort, 0, 5);

        $chart_data = [];
        foreach ($produkSort as $ps) {
            $chart_data["label"][] = $ps["nama"];
            $chart_data["value"][] = $ps["terjual"];
        }

        $response = [
            "response" => "success",
            "produk_terlaris" => $produkTerlaris,
            "total_terjual" => $total_terjual,
            "total_produk" => $produk->count(),
            "chart_data" => $chart_data
        ];
        return response()->json($response);
    }

    public function get_produk()
    {
        $produk = Produk::all();
        foreach ($produk as $p) {
            $p->harga = number_format($p->harga);
            $p->gambar = asset('assets/goods-img/' . $p->gambar);
        }

        $response = [
            "response" => "success",
            "data" => $produk
        ];
        return response()->json($response);
    }

    public function search_produk(Request $request)
    {
        $produk = Produk::where('nama', 'like', '%' . $request->search . '%')->get();
        foreach ($produk as $p) {
            $p->harga = number_format($p->harga);
            $p->gambar = asset('assets/goods-img/' . $p->gambar);
        }

        $response = [
            "response" => "success",
            "data" => $produk
        ];
        return response()->json($response);
    }

    public function input_produk(Request $request)
    {
        $gambar = $this->upload_image($request->gambar, '/assets/goods-img/');
        $id = $this->random('char', 2) . "-" . $this->random('num', 5);
        while (true) {
            $cek = Produk::where('id', $id)->first();
            if ($cek) {
                $id = $this->random('char', 2) . "-" . $this->random('num', 5);
            } else {
                break;
            }
        }

        Produk::create([
            'id' => $id,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $gambar
        ]);

        $response = [
            "response" => "success",
            "message" => "Berhasil menambahkan produk"
        ];
        return response()->json($response);
    }

    public function update_produk(Request $request)
    {
        if ($request->gambar == null) {
            Produk::where('id', $request->id)->update([
                'nama' => $request->nama,
                'harga' => $request->harga,
                'stok' => $request->stok
            ]);
        } else {
            $produk = Produk::find($request->id);
            $this->delete_file($produk->gambar, '/assets/goods-img/');

            $gambar = $this->upload_image($request->gambar, '/assets/goods-img/');
            Produk::where('id', $request->id)->update([
                'nama' => $request->nama,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'gambar' => $gambar
            ]);
        }

        $response = [
            "response" => "success",
            "message" => "Produk berhasil di update"
        ];
        return response()->json($response);
    }

    public function delete_produk(Request $request)
    {
        $produk = Produk::find($request->id);
        $this->delete_file($produk->gambar, '/assets/goods-img/');
        $produk->delete();

        $response = [
            "response" => "success",
            "message" => "Berhasil menghapus produk " . $request->nama
        ];
        return response()->json($response);
    }

    public function get_transaksi(Request $request)
    {
        $transaksi = Transaksi::where('periode', date('Y-m-d', strtotime($request->periode)))->orderBy('created_at')->get();
        $data = [];

        foreach ($transaksi as $t) {
            $produk = '';
            foreach ($t->tproduk as $tpKey => $tpVal) {
                if ($t->tproduk->count() == $tpKey + 1) {
                    $produk .= $tpVal->nama;
                } else {
                    $produk .= $tpVal->nama . ", ";
                }
            }

            $data[] = [
                "invoice" => $t->id,
                "periode" => date('d F Y', strtotime($t->periode)),
                "waktu" => date('H:i', strtotime($t->created_at)),
                "produk" => $produk
            ];
        }

        $response = [
            "response" => "success",
            "data" => $data
        ];
        return response()->json($response);
    }

    public function input_transaksi(Request $request)
    {
        foreach ($request->produk as $p) {
            $produk = Produk::find($p["produk"]);
            if ($produk->stok < $p["jumlah"]) {
                $response = [
                    "response" => "failed",
                    "message" => "Stok produk " . $produk->nama . " tidak cukup !"
                ];
                return response()->json($response);
            }
        }

        $inv = "INV" . $this->random('num', 4);
        while (true) {
            $cek = Transaksi::where('id', $inv)->first();
            if ($cek) {
                $inv = "INV" . $this->random('num', 4);
            } else {
                break;
            }
        }

        $total_belanja = 0;

        foreach ($request->produk as $p) {
            $produk = Produk::find($p["produk"]);
            $harga = $produk->harga;
            $jumlah = $p["jumlah"];
            $total = $harga * $p["jumlah"];
            $total_belanja = $total_belanja + $total;

            $produk->update([
                "stok" => $produk->stok - $jumlah
            ]);

            TProduk::create([
                'periode' => date('Y-m-d', strtotime($request->periode)),
                'invoice' => $inv,
                'id_produk' => $produk->id,
                'nama' => $produk->nama,
                'harga' => $harga,
                'jumlah' => $jumlah,
                'total' => $total
            ]);
        }

        Transaksi::create([
            'id' => $inv,
            'periode' => date('Y-m-d', strtotime($request->periode)),
            'total' => $total_belanja
        ]);

        $response = [
            "response" => "success",
            "message" => "Berhasil menyimpan data transaksi"
        ];
        return response()->json($response);
    }

    public function detail_transaksi(Request $request)
    {
        $transaksi = Transaksi::find($request->id);
        $tproduk = [];

        foreach ($transaksi->tproduk as $tp) {
            $tproduk[] = [
                "produk" => $tp->nama,
                "harga" => number_format($tp->harga),
                "jumlah" => $tp->jumlah,
                "total" => number_format($tp->total)
            ];
        }

        $data = [
            "invoice" => $transaksi->id,
            "tanggal" => date('d F Y', strtotime($transaksi->periode)),
            "waktu" => date('H:i', strtotime($transaksi->created_at)),
            "produk" => $tproduk,
            "total" => "Rp " . number_format($transaksi->total)
        ];

        return response()->json($data);
    }
}
