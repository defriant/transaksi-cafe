@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- RECENT PURCHASES -->
        <div class="panel panel-headline">
            <div class="panel-heading">
                <h3 class="panel-title">Transaksi</h3>
                {{-- <div class="right">
                    <button type="button" data-toggle="modal" data-target="#modalInput"><i class="far fa-plus"></i>&nbsp; Input Transaksi</button>
                </div> --}}
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <p>Tanggal transaksi</p>
                        <div class="input-group">
                            <input class="form-control date-picker" id="periode-transaksi" type="text" value="{{date('Y-m-d')}}" readonly>
                            <span class="input-group-btn"><button class="btn btn-primary" type="button" id="search-transaksi"><i class="fas fa-search"></i></button></span>
                        </div>
                    </div>
                </div>
                <br><br>
                <div id="data-transaksi">
                    <br><br>
                    <div class="loader">
                        <div class="loader4"></div>
                        <h5 style="margin-top: 2.5rem">Loading data</h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- END RECENT PURCHASES -->
    </div>
</div>

<div class="modal fade" id="modalInput" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Input transaksi</h4>
            </div>
            <div class="modal-body">
                <div id="transaksi-produk">
                    <div class="row" style="margin-bottom: 2rem">
                        <div class="col-md-6">
                            <p>Produk</p>
                            <select class="form-control input-produk">
                                
                            </select>
                        </div>
                        <div class="col-md-3">
                            <p>Stok Tersisa</p>
                            <input type="number" class="form-control sisa-stok" readonly>
                        </div>
                        <div class="col-md-2">
                            <p>Jumlah</p>
                            <input type="number" class="form-control input-jumlah">
                        </div>
                        <div class="col-md-1">
                            <p>&nbsp;</p>
                        </div>
                    </div>
                </div>
                <button class="transaksi-tambah-produk"><i class="fal fa-plus"></i> &nbsp; Tambah produk</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-input-data">Input</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Detail transaksi</h4>
            </div>
            <div class="modal-body" id="modal-body-detail-transaksi">
                
            </div>
        </div>
    </div>
</div>

@endsection
