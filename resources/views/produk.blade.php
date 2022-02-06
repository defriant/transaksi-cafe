@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-headline">
            <div class="panel-heading">
                <h3 class="panel-title">Produk</h3>
                <div class="right">
                    <button type="button" class="kasir-hide" data-toggle="modal" data-target="#modalInput"><i class="far fa-plus"></i>&nbsp; Tambah produk</button>
                </div>
            </div>
            <div class="panel-body" id="produk-panel">
                <div class="input-group" style="width: 250px">
                    <span class="input-group-addon"><i class="fas fa-search"></i></span>
                    <input class="form-control" placeholder="Cari produk ..." type="text" id="search-produk">
                </div>
                <br>
                <div class="loader" id="loader" style="display: none">
                    <i class="fas fa-ban" style="font-size: 5rem; opacity: .5"></i>
                    <h5 style="margin-top: 2.5rem"></h5>
                </div>
                <br>
                <div class="items-row" id="produk-data">
                    <div class="item-wrapper">
                        <div class="item-image"></div>
                        <div class="item-detail">
                            <h4 class="item-name">&nbsp;</h4>
                            <div class="item-left">
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item-image"></div>
                        <div class="item-detail">
                            <h4 class="item-name">&nbsp;</h4>
                            <div class="item-left">
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item-image"></div>
                        <div class="item-detail">
                            <h4 class="item-name">&nbsp;</h4>
                            <div class="item-left">
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item-image"></div>
                        <div class="item-detail">
                            <h4 class="item-name">&nbsp;</h4>
                            <div class="item-left">
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalInput" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah produk</h4>
            </div>
            <div class="modal-body">
                <div class="input-gambar">
                    <div class="img-preview"></div>
                    <button type="button" class="btn btn-warning choose-img-btn">Pilih Gambar</button>
                    <input type="file" class="choose-img-file" id="input-gambar">
                </div>
                <br><br>
                <p>Nama Produk</p>
                <input type="text" id="input-nama" class="form-control">
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <p>Harga</p>
                        <div class="input-group">
                            <span class="input-group-addon">Rp.</span>
                            <input class="form-control input-number" id="input-harga" type="text">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <p>Stok</p>
                        <input type="number" id="input-stok" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-input-data">Tambahkan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Produk</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="update-id" class="form-control">
                <div class="input-gambar">
                    <div class="img-preview" id="update-img-preview"></div>
                    <button type="button" class="btn btn-warning choose-img-btn">Pilih Gambar</button>
                    <input type="file" class="choose-img-file" id="update-gambar">
                </div>
                <br><br>
                <p>Nama Produk</p>
                <input type="text" id="update-nama" class="form-control">
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <p>Harga</p>
                        <div class="input-group">
                            <span class="input-group-addon">Rp.</span>
                            <input class="form-control input-number" id="update-harga" type="text">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <p>Stok</p>
                        <input type="number" id="update-stok" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-edit-data">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDeleteData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h4 class="text-center" style="margin-top: 3rem" id="delete-warning-message"></h4>
                <input type="hidden" id="delete-id">
                <div style="margin-top: 5rem; text-align: center">
                    <button type="button" class="btn btn-danger" id="btn-delete-data">Hapus</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection