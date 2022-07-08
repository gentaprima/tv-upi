@extends('master')

@section('title-link','Beranda')
@section('sub-title-link','Data Iklan ')
@section('title','Data Iklan')

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
                        <li class="breadcrumb-item active">Data Iklan</li>
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
                        <button class="btn btn-outline-primary size-btn" onclick="addData('{{$jenis}}')" data-toggle="modal" data-target="#modal-form">Tambah Data</button>
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-3 search">
                            <input type="search" class="form-control border-search" placeholder="Telusuri ..." aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <p hidden="true" id="jenis">{{$jenis}}</p>
                <table id="table" class="table table-striped mt-2">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Banner</th>
                            <th>Urutan</th>
                            @php if($jenis == "beranda"){ @endphp
                            <th>Posisi</th>
                            @php } @endphp
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                   
                </div>

                </table>
                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                    <ul class="pagination">
                        <li>Halaman</li>
                        <li class="paginate_button active mr-2"><a href="#" aria-controls="example1" id="current_page" data-dt-idx="1" tabindex="0">1</a></li>
                        <li>Dari</li>
                        <li class="ml-2" id="total_page"></li>
                        <li class="paginate_button next prev" id="example1_previous"><a href="#" aria-controls="example1" id="link_prev" data-dt-idx="0" tabindex="0"><i class="fa fa-chevron-left"></i></a></li>
                        <li class="paginate_button next" id="example1_next"><a id="link_next" href="" aria-controls="example1" data-dt-idx="2" tabindex="0"><i class="fa fa-chevron-right"></i></a></li>
                    </ul>
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
                    @php if($jenis == "beranda"){ @endphp
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Posisi</label>
                        <div class="col-sm-10">
                            <select type="text" required class="form-control" id="position" value="{{old('position')}}" name="position">
                                <option value="">-- Pilih Posisi Iklan -- </option>
                                <option value="1">Pertama</option>
                                <option value="2">Kedua</option>
                                <option value="3">Ketiga</option>
                            </select>
                        </div>
                    </div>
                    @php } @endphp
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Urutan</label>
                        <div class="col-sm-10">
                            <input type="text" required class="form-control" id="urutan" value="{{old('urutan')}}" name="urutan" placeholder="Urutan">
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
                        <label for="" class="col-sm-2">Status</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" required name="isActive" value="1" id="radioStatus1">
                                        <label for="radioStatus1">
                                            Aktif
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" required name="isActive" value="0" id="radioStatus2">
                                        <label for="radioStatus2">
                                            Tidak Aktif
                                        </label>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <input type="hidden" id="jenis" name="jenis" value="{{$jenis}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                <button type="submit" id="btnSave" class="btn btn-primary">Simpan</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Hapus Iklan</h5>
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
                <img src="" style="width: 100%;height:300px;border-radius:8px;" id="imageBanner" alt="">
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

    $(document).ready(function() {
        loadData(1)
    })

    $('input[type=search]').on('input', function() {
        clearTimeout(this.delay);
        this.delay = setTimeout(function() {
            /* call ajax request here */
            loadData(1, this.value)
        }.bind(this), 800);
    });

    function loadData(page, search = "") {
        let jenis = document.getElementById("jenis").innerHTML
        $("#table tbody").empty();
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: `/show-ads-json/${jenis}?page=${page}&search=${search}`,
            success: function(response) {
                let data = response;
                let k = 1;
                if (data.data.current_page > 1) {
                    k = ((data.data.current_page * 10) - 10) + 1
                }
                let linkBanner = data.data.linkBanner

                // set pagination
                let buttonPrev = document.getElementById("link_prev")
                buttonPrev.href = "#"
                if (data.data.current_page == 1) {
                    $("#example1_previous").addClass("paginate_button next prev disabledd")
                    buttonPrev.removeAttribute("onclick")
                } else {
                    $("#example1_previous").removeClass("disabledd")
                    buttonPrev.setAttribute("onclick", `loadData(${data.data.current_page - 1})`)
                }

                let buttonNext = document.getElementById("link_next")
                buttonNext.href = "#"
                if (data.data.current_page == data.data.last_page) {
                    $("#example1_next").addClass("paginate_button next prev disabledd")
                    buttonNext.removeAttribute("onclick")
                } else {
                    buttonNext.setAttribute("onclick", ``)
                    $("#example1_next").removeClass("disabledd")
                    buttonNext.setAttribute("onclick", `loadData(${data.data.current_page + 1})`)
                }

                document.getElementById("current_page").innerHTML = data.data.current_page
                document.getElementById("total_page").innerHTML = data.data.last_page

                // set pagination


                for (let i = 0; i < data.data.data.length; i++) {
                    var tr = $("<tr>");
                    tr.append("<td>" + k++ + "</td>");
                    tr.append(` <td><img onclick="showImage('${data.data.data[i].image}','${data.linkBanner}')" data-target="#modal-image" data-toggle="modal" style="width: 143px; height:80px;" src="${data.linkBanner}/${data.data.data[i].image}" alt=""></td>`);
                    
                    tr.append("<td>" + data.data.data[i].urutan + "</td>");
                    if(jenis == "beranda"){
                        if(data.data.data[i].position == 1){

                            tr.append("<td> <span class='badge badge-primary'>TOP</span></td>");
                        }else if(data.data.data[i].position == 2){
                            tr.append("<td> <span class='badge badge-primary'>CENTER</span></td>");
                        
                        }else{
                            tr.append("<td> <span class='badge badge-primary'>BOTTOM</span></td>");

                        }
                    }
                    if (data.data.data[i].is_active == 1) {
                        tr.append("<td> <span class='badge badge-success'>Aktif</span></td>");

                    } else {
                        tr.append("<td> <span class='badge badge-danger'>Tidak Aktif</span></td>");
                    }
                    tr.append(`
                    <td>
                    <button onclick="updateData('${data.data.data[i].id}','${data.data.data[i].image}','${data.data.data[i].urutan}','${data.data.data[i].jenis}','${data.data.data[i].is_active}','${data.data.data[i].position}')" type="button" data-target="#modal-form" data-toggle="modal" class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i></button>
                                <button type="button" onclick="deleteData('${data.data.data[i].id}')" data-target="#modal-delete" data-toggle="modal" class="btn btn-secondary btn-sm"><i class="fa fa-trash"></i></button>
                    </td>`)
                    $("#table tbody").append(tr);
                }
            }
        })
    }

    function checkAds(val) {}

    function showImage(image, path) {
        document.getElementById("imageBanner").src = path + '/' + image;
    }

    function updateData(id, image, urutan, jenis, is_active, position) {
        if (jenis == "beranda") {
            document.getElementById("position").value = position;
        }
        document.getElementById("urutan").value = urutan;
        document.getElementById("labelNamePhoto").innerHTML = image;
        document.getElementById("labelPhoto").hidden = false;
        document.getElementById("form").action = `/update-ads/${id}`;
        document.getElementById("titleModal").innerHTML = 'Perbarui Iklan';

        if (is_active == 0) {
            document.getElementById('radioStatus1').checked = false;
            document.getElementById('radioStatus2').checked = true;
        } else {
            document.getElementById('radioStatus1').checked = true;
            document.getElementById('radioStatus2').checked = false;
        }

        let requiredImage = document.getElementById("imagePick");
        requiredImage.removeAttribute('required', '')
        let buttonSave = document.getElementById("btnSave");
        buttonSave.setAttribute("type", "submit");
        buttonSave.removeAttribute("onclick");
    }

    function addData(jenis) {
        if (jenis == "beranda") {
            document.getElementById("position").value = "";
        }
        document.getElementById("urutan").value = "";
        document.getElementById("labelNamePhoto").innerHTML = "Choose File";
        document.getElementById("labelPhoto").hidden = true;
        document.getElementById("form").action = `/add-ads/`;
        document.getElementById("form").method = 'post';
        document.getElementById("titleModal").innerHTML = 'Tambah Iklan';
        let buttonSave = document.getElementById("btnSave");
        buttonSave.setAttribute("type", "button");
        buttonSave.setAttribute("onclick", "processAddAds()");

        let requiredImage = document.getElementById("imagePick");
        requiredImage.setAttribute('required', '')

    }

    function processAddAds() {

    }

    function deleteData(id) {
        document.getElementById("btnDelete").href = `/delete-ads/${id}`;
    }
</script>
@endsection