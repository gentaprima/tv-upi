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
                            <th>Banner</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataBerita as $berita)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td style="width: 250px;">{{$berita->judul}}</td>
                            <td>{{$berita->tgl}}</td>
                            <td>{{$berita->nama_kategori}}</td>
                            <td><img onclick="showImage('{{$berita->image}}',`{{asset('uploads/berita')}}`)" data-target="#modal-image" data-toggle="modal" style="width: 143px; height:80px;" src="{{asset('uploads/berita')}}/{{$berita->image}}" alt=""></td>
                            <td>
                                <button type="button" onclick="showDetail(`{{$berita->id}}`)" data-target="#modal-detail" data-toggle="modal" class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i></button>
                                <button type="button" onclick="updateData(`{{$berita->id}}`)" data-target="#modal-form" data-toggle="modal" class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i></button>
                                <button type="button" onclick="deleteData(`{{$berita->id}}`)" data-target="#modal-delete" data-toggle="modal" class="btn btn-secondary btn-sm"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>

                </table>
                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                    <ul class="pagination">

                        @php if($dataBerita->currentPage() == 1){ @endphp
                        <li class="paginate_button next prev disabledd" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0"><i class="fa fa-chevron-left"></i></a></li>
                        @php }else{ @endphp
                        <li class="paginate_button next prev " id="example1_previous"><a href="data-video?page={{$dataBerita->currentPage() -  1}}" aria-controls="example1" data-dt-idx="0" tabindex="0"><i class="fa fa-chevron-left"></i></a></li>
                        @php } @endphp
                        <li class="paginate_button active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">{{$dataBerita->currentPage()}}</a></li>
                        @php if($dataBerita->currentPage() == $dataBerita->lastPage()){ @endphp
                        <li class="paginate_button next disabledd" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0"><i class="fa fa-chevron-right"></i></a></li>
                        @php }else{ @endphp
                        <li class="paginate_button next " id="example1_next"><a href="data-video?page={{$dataBerita->currentPage() +  1}} " aria-controls="example1" data-dt-idx="2" tabindex="0"><i class="fa fa-chevron-right"></i></a></li>
                        @php } @endphp
                    </ul>
                </div>
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
                <form class="form" method="post" id="form" action="/add-rekening" enctype="multipart/form-data">
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
                        <label for="inputPassword" class="col-sm-2 col-form-label">Tangal</label>
                        <div class="col-sm-10">
                            <input type="date" required class="form-control" placeholder="Tanggal" name="date" id="date" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Banner</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" required class="custom-file-input" name="image" id="imagePick">
                                    <label id="labelNamePhoto" class="custom-file-label" for="imagePick">Choose file</label>
                                </div>
                                <!-- <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div> -->
                            </div>
                            <p id="labelPhoto" class="mt-1">(kosongkan jika tidak ingin mengubah foto)</p>
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
<div class="modal fade" id="modal-image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content rounded">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Banner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="" style="width: 100%;border-radius:8px;" id="imageBanner" alt="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                </form>
            </div>
            <div class="bg-red rounded-modal" style="color: red;height:15px;"></div>
        </div>
    </div>
</div>
<script>
    function showImage(image, path) {
        document.getElementById("imageBanner").src = path + '/' + image;
    }


    function updateData(id) {
        document.getElementById("titleModal").innerHTML = 'Perbarui Berita';
        document.getElementById("form").action = `/update-berita/${id}`;
        let requiredImage = document.getElementById("imagePick");
        requiredImage.removeAttribute('required', '')
        $.ajax({
            type: 'get',
            dataType: 'html',
            url: `/show-berita/${id}`,
            success: function(response) {
                let data = JSON.parse(response);
                document.getElementById("judul").value = data.judul;
                document.getElementById("kategoriBerita").value = data.id_kategori;
                document.getElementById("date").value = data.tgl;
                document.getElementById("tanggalDetail").innerHTML = data.tgl;
                document.getElementById("deskripsi").innerHTML = data.deskripsi;
                document.getElementById("labelNamePhoto").innerHTML = data.image;
                document.getElementById("labelPhoto").hidden = false;
                if (data.is_publish == 1) {
                    document.getElementById("radioStatusPublish").checked = true
                    document.getElementById("radioStatusDraft").checked = false
                } else {
                    document.getElementById("radioStatusPublish").checked = false
                    document.getElementById("radioStatusDraft").checked = true

                }
            }
        })
    }

    function showDetail(id) {
        $.ajax({
            type: 'get',
            dataType: 'html',
            url: `/show-berita/${id}`,
            success: function(response) {
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
        let requiredImage = document.getElementById("imagePick");
        requiredImage.setAttribute('required', '')
        document.getElementById("kategoriBerita").value = "";
        document.getElementById("titleModal").innerHTML = 'Tambah Berita';
        document.getElementById("form").action = '/add-berita';
        document.getElementById("date").value = "";
    }

    function deleteData(id) {
        document.getElementById("btnDelete").href = `/delete-berita/${id}`;
    }
</script>
@endsection