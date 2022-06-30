@extends('master')

@section('title-link','Beranda')
@section('sub-title-link','Data Pengguna ')
@section('title','Data Pengguna')

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
                        <li class="breadcrumb-item active">Data Pengguna</li>
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
                            <th>Email</th>
                            <th>Nama Lengkap</th>
                            <th>Nomor Telepon</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataProfile as $row)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$row->email}}</td>
                            <!-- <td><img onclick="showImage('{{$row->path_url}}',`{{asset('uploads/banner')}}`)" data-target="#modal-image" data-toggle="modal" style="width: 143px; height:80px;" src="{{asset('uploads/banner')}}/{{$row->path_url}}" alt=""></td> -->
                            <td>{{$row->nama_lengkap}}</td>
                            <td>{{$row->nomor_telepon}}</td>
                            <td>
                                @php if($row->role == 1 ){ @endphp
                                   <span class="badge badge-primary">Super Admin</span>
                                @php }else if($row->role == 2){ @endphp
                                    <span class="badge badge-primary">Admin</span>
                                @php }else{ @endphp
                                    <span class="badge badge-primary">Pengguna</span>
                                @php } @endphp
                            </td>
                            <td>
                                <button onclick="updateData(`{{$row->id}}`,`{{$row->email}}`,`{{$row->nama_lengkap}}`,`{{$row->nomor_telepon}}`,`{{$row->role}}`)" type="button" data-target="#modal-form" data-toggle="modal" class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i></button>
                                <button type="button" onclick="deleteData(`{{$row->id}}`)" data-target="#modal-delete" data-toggle="modal" class="btn btn-secondary btn-sm"><i class="fa fa-trash"></i></button>
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
                <form class="form" method="post" id="form" action="/add-rekening" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" required class="form-control" id="email" name="email" value="" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-10">
                            <input type="text" required class="form-control" id="fullname" name="fullname" value="" placeholder="Nama Lengkap">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Nomor Telepon</label>
                        <div class="col-sm-10">
                            <input type="text" required class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Nomor Telepon"">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                            <select type="text" required class="form-control" id="role" name="role">
                                <option value="">-- Pilih Pengguna -- </option>
                                <option value="1">Super Admin</option>
                                <option value="2">Admin</option>
                            </select>
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
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content rounded">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Rekening</h5>
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
    function checkAds(val) {
        console.log(val.value);
    }

    function showImage(image, path) {
        document.getElementById("imageBanner").src = path + '/' + image;
    }

    function updateData(id, email, fullName, phoneNumber,role) {
        document.getElementById("fullname").value = fullName;
        let emailForm = document.getElementById("email");
        emailForm.value = email
        document.getElementById("phoneNumber").value = phoneNumber;
        document.getElementById("role").value = role;
        document.getElementById("form").action = `/update-profile/${id}/2`;
        document.getElementById("titleModal").innerHTML = 'Perbarui Pengguna';
        emailForm.removeAttribute('required');
    }

    function addData() {
        document.getElementById("fullname").value = "";
        let emailForm = document.getElementById("email");
        emailForm.value = "";
        emailForm.setAttribute('required','');
        document.getElementById("phoneNumber").value = "";
        document.getElementById("form").action = `/add-users`;
        document.getElementById("role").value = "";
        document.getElementById("titleModal").innerHTML = 'Tambah Pengguna';
        
    }

    function deleteData(id) {
        document.getElementById("btnDelete").href = `/delete-users/${id}`;
    }
</script>
@endsection