<?php

use Illuminate\Support\Facades\Session;
?>

@extends('master')

@section('title-link','Beranda')
@section('sub-title-link','Profile ')
@section('title','Profile')

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
                        <li class="breadcrumb-item active">Profile</li>
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
                    <div class="col-4">
                        <?php if (Session::get('dataUsers')->foto == null) { ?>
                            <img src="LOGO_TVUPI_PLAYSTORE_1.png" alt="">
                        <?php } else { ?>
                            <img style="width:150px;height:150px;border-radius: 50%;" src="{{asset('uploads/profile')}}/{{Session::get('dataUsers')->foto}}" alt="">
                        <?php } ?>
                    </div>
                    <div class="col-8">
                        <span>Nama</span>
                        <p class="font-weight-bold">{{Session::get('dataUsers')->nama_lengkap}}</p>
                        <span>Email</span>
                        <p class="font-weight-bold">{{Session::get('dataUsers')->email}}</p>
                        <span>Nomor Telepon</span>
                        <p class="font-weight-bold">{{Session::get('dataUsers')->nomor_telepon}}</p>
                        <button data-toggle="modal" data-target="#modal-form" class="btn btn-primary">Perbarui</button>
                    </div>
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
                <h5 class="modal-title" id="titleModal">Perbarui Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" method="post" id="form" action="/update-profile/{{Session::get('dataUsers')->id}}/1" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" readonly class="form-control" id="email" name="email" value="{{Session::get('dataUsers')->email}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fullname" name="fullname" value="{{Session::get('dataUsers')->nama_lengkap}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Nomor Telepon</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="{{Session::get('dataUsers')->nomor_telepon}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Foto Profil</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="imagePick">
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
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="password" style="border-top-right-radius: 0px !important;border-bottom-right-radius:0px !important;" class="form-control" id="password" name="password" value="">
                                <div class="input-group-append">
                                    <span onclick="seePassword()" class="input-group-text" id="basic-addon2"><i id="eyePassword" class="fa fa-eye-slash"></i></span>
                                </div>
                                <!-- <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div> -->
                            </div>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="password"  style="border-top-right-radius: 0px !important;border-bottom-right-radius:0px !important;" class="form-control" id="confirmPassword" name="confirmPassword" value="">
                                <div class="input-group-append">
                                    <span onclick="seeConfirmPassword()" class="input-group-text" id="basic-addon2"><i id="eyeConfirmPassword" class="fa fa-eye-slash"></i></span>
                                </div>
                            </div>
                            <p id="labelPhoto" class="mt-1">(kosongkan jika tidak ingin mengubah password)</p>
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

<script>
    function seePassword(){
       let classEye = document.getElementById("eyePassword");
       if(classEye.className == 'fa fa-eye'){
          classEye.setAttribute('class','fa fa-eye-slash');
          document.getElementById("password").type = "password";
       }else{
          document.getElementById("password").type = "text";
          classEye.setAttribute('class','fa fa-eye');
       }

    }

    function seeConfirmPassword(){
        let classEye = document.getElementById("eyeConfirmPassword");
       if(classEye.className == 'fa fa-eye'){
          classEye.setAttribute('class','fa fa-eye-slash');
          document.getElementById("confirmPassword").type = "password";
       }else{
          document.getElementById("confirmPassword").type = "text";
          classEye.setAttribute('class','fa fa-eye');
       }
    }
</script>
@endsection