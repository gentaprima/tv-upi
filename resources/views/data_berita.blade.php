@extends('master')

@section('title-link','Beranda')
@section('sub-title-link','Data Berita ')
@section('title','Data Berita')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding: 10px 12px 0px 37px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item active">Data Berita</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @if(Session::has('message'))
    <p hidden="true" id="message">{{ Session::get('message') }}</p>
    <p hidden="true" id="icon">{{ Session::get('icon') }}</p>
    @endif
    <!-- Main content -->

    <section class="content">
        <div class="container-fluid">
            <div class="card p-5 rounded mb-3">
                <div class="row">
                    <div class="col-6">
                        <button class="btn btn-outline-primary size-btn" onclick="addData()" data-toggle="modal" data-target="#modal-form">Tambah Data</button>
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-3 search">
                            <input type="text" class="form-control" placeholder="Telusuri ..." aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped mt-2">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataBerita as $berita)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$berita->judul}}</td>
                            <td>{{$berita->tgl}}</td>
                            <td>{{$berita->nama_kategori}}</td>
                            <td>
                                <button type="button" onclick="showDetail(`{{$berita->id}}`)" data-target="#modal-detail" data-toggle="modal" class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i></button>
                                <button type="button" onclick="updateData(`{{$berita->id}}`)" data-target="#modal-form" data-toggle="modal" class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i></button>
                                <button type="button" onclick="deleteData(`{{$berita->id}}`)" data-target="#modal-delete" data-toggle="modal" class="btn btn-secondary btn-sm"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content rounded">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModal">Tambah Rekening</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" method="post" id="form" action="/add-rekening">
                    @csrf
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" required class="form-control" id="judul" value="{{old('judul')}}" name="judul" placeholder="Judul Berita">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Kategori Berita</label>
                        <div class="col-sm-10">
                            <select type="text" required class="form-control" id="kategoriBerita" value="{{old('kategoriBerita')}}" name="kategoriBerita">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($dataKategoriBerita as $row)
                                <option value="{{$row->id}}">{{$row->nama_kategori}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea required class="form-control" placeholder="Deskripsi Berita ..." name="deskripsi" id="deskripsi" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" required id="radioStatusPublish" name="status" value="1">
                                        <label for="radioStatusPublish">
                                            Publish
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                <div class="icheck-primary d-inline">
                                        <input type="radio" required id="radioStatusDraft" name="status" value="0">
                                        <label for="radioStatusDraft">
                                            Draft
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
            <div class="bg-red rounded-modal" style="color: red;height:15px;"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content rounded">
            <div class="modal-header">
                <h5 class="modal-title">Detail Berita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3"><span class="font-weight-bold">Judul</span></div>
                    <div class="col-sm-9"><span id="judulDetail">judul</span></div>
                </div>
                <div class="row">
                    <div class="col-sm-3"><span class="font-weight-bold">Kategori</span></div>
                    <div class="col-sm-9"><span id="kategoriDetail">judul</span></div>
                </div>
                <div class="row">
                    <div class="col-sm-3"><span class="font-weight-bold">Deskripsi</span></div>
                    <div class="col-sm-9"><span id="deskripsiDetail">judul</span></div>
                </div>
                <div class="row">
                    <div class="col-sm-3"><span class="font-weight-bold">Tanggal</span></div>
                    <div class="col-sm-9"><span id="tanggalDetail">judul</span></div>
                </div>
                <div class="row">
                    <div class="col-sm-3"><span class="font-weight-bold">Jumlah disukai</span></div>
                    <div class="col-sm-9"><span id="countLikeDetail">judul</span></div>
                </div>
                <div class="row">
                    <div class="col-sm-3"><span class="font-weight-bold">Dibuat Oleh</span></div>
                    <div class="col-sm-9"><span id="createdByDetail">judul</span></div>
                </div>
            </div>  
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            </div>
            <div class="bg-red rounded-modal" style="color: red;height:15px;"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content rounded">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Kategori Berita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Anda yakin ingin menghapus data tersebut?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                <a id="btnDelete" type="submit" class="btn btn-primary">Hapus</a>
                </form>
            </div>
            <div class="bg-red rounded-modal" style="color: red;height:15px;"></div>
        </div>
    </div>
</div>
<script>
    function updateData(id) {
        document.getElementById("titleModal").innerHTML = 'Perbarui Berita';
        document.getElementById("form").action = `/update-berita/${id}`;   
        $.ajax({
            type: 'get',
            dataType:'html',
            url:`/show-berita/${id}`,
            success : function(response){
                let data = JSON.parse(response);
                document.getElementById("judul").value = data.judul;
                document.getElementById("kategoriBerita").value = data.id_kategori;
                document.getElementById("tanggalDetail").innerHTML = data.tgl;
                document.getElementById("deskripsi").innerHTML = data.deskripsi;

                if(data.is_publish == 1){
                    document.getElementById("radioStatusPublish").checked = true
                    document.getElementById("radioStatusDraft").checked = false
                }else{
                    document.getElementById("radioStatusPublish").checked = false
                    document.getElementById("radioStatusDraft").checked = true
                    
                }
            }
        })
    }

    function showDetail(id){
        $.ajax({
            type: 'get',
            dataType:'html',
            url:`/show-berita/${id}`,
            success : function(response){
                let data = JSON.parse(response);
                document.getElementById("judulDetail").innerHTML = data.judul;
                document.getElementById("kategoriDetail").innerHTML = data.nama_kategori;
                document.getElementById("tanggalDetail").innerHTML = data.tgl;
                document.getElementById("deskripsiDetail").innerHTML = data.deskripsi;
                document.getElementById("countLikeDetail").innerHTML = data.count_like;
                document.getElementById("createdByDetail").innerHTML = data.created_by;
            }
        })
    }

    function addData() {
        document.getElementById("kategoriBerita").value = "";
        document.getElementById("titleModal").innerHTML = 'Tambah Berita';
        document.getElementById("form").action = '/add-berita';
    }

    function deleteData(id) {
        document.getElementById("btnDelete").href = `/delete-kategori-berita/${id}`;
    }
</script>
@endsection