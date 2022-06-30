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
                    <label for="" class="col-sm-2">Hari</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{$hari}}" id="hari" readonly class="form-control">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <button data-target="#modal-form" onclick="addJadwal()" data-toggle="modal" class="btn btn-secondary btn-sm" style="float: right;">Tambah Jadwal</button>
                    </div>
                </div>
                <div class="row">
                    <label for="" class="col-sm-2">Detail Siaran</label>
                    <div class="col-sm-10">
                        <table id="tableData" class="table table-striped mt-2">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Hari</th>
                                    <th>Nama Siaran</th>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($siaran as $row)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td style="text-transform:capitalize">{{$row->hari}}</td>
                                    <td>{{$row->nama_siaran}}</td>
                                    <td>{{$row->waktu_mulai}}</td>
                                    <td>{{$row->waktu_selesai}}</td>
                                    <td>
                                        <button onclick="updateJadwal(`{{$row->id}}`,`{{$row->waktu_mulai}}`,`{{$row->waktu_selesai}}`,`{{$row->nama_siaran}}`)" type="button" data-target="#modal-form" data-toggle="modal" class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i></button>
                                        <button onclick="deleteJadwal(`{{$row->id}}`)" type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-secondary btn-sm"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <button class="btn btn-primary btn-sm">Simpan</button>
                        <a href="/jadwal-siaran" class="btn btn-secondary btn-sm">Kembali</a>
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
                <h5 class="modal-title" id="titleModal">Tambah Rekening</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" method="post" id="form" action="/add-rekening">
                    @csrf
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Nama Siaran</label>
                        <div class="col-sm-10">
                            <input type="text" required class="form-control" id="namaSiaran" value="{{old('namaSiaran')}}" name="namaSiaran" placeholder="Nama Siaran">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Waktu Mulai</label>
                        <div class="col-sm-10">
                            <div class="input-group date" id="waktuMulai" data-target-input="nearest">
                                <input style="border-top-right-radius:0px !important;border-bottom-right-radius:0px !important;" id="startTime" type="text" class="form-control datetimepicker-input" data-target="#waktuMulai">
                                <div class="input-group-append" data-target="#waktuMulai" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Waktu Selesai</label>
                        <div class="col-sm-10">
                            <div class="input-group date" id="waktuSelesai" data-target-input="nearest">
                                <input style="border-top-right-radius:0px !important;border-bottom-right-radius:0px !important;" id="endTime" type="text" class="form-control datetimepicker-input" data-target="#waktuSelesai">
                                <div class="input-group-append" data-target="#waktuSelesai" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                <button type="button" id="btnSave" class="btn btn-primary">Simpan</button>
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
                <h5 class="modal-title" id="titleModal">Hapus Jadwal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Anda yakin ingin menghapus data tersebut?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                <a  id="btnDelete" class="btn btn-primary">Hapus</a>
            </div>
            <div class="bg-red rounded-modal" style="color: red;height:15px;"></div>
        </div>
    </div>
</div>
<script>
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

    function addJadwal() {
        let btnSave = document.getElementById("btnSave");
        btnSave.setAttribute("onclick", "proccessAddJadwal()")
        document.getElementById("startTime").value = "";
        document.getElementById("endTime").value = "";
        document.getElementById("namaSiaran").value = "";
    }

    function updateJadwal(id, waktuMulai, waktuSelesai, namaSiaran) {
        let btnSave = document.getElementById("btnSave");
        document.getElementById("startTime").value = waktuMulai;
        document.getElementById("endTime").value = waktuSelesai;
        document.getElementById("namaSiaran").value = namaSiaran;
        btnSave.setAttribute("onclick", `proccessUpdateJadwal(${id})`)
    }

    function deleteJadwal(id){
        document.getElementById("btnDelete").href = `/delete-jadwal-siaran/${id}`;
    }

    function getDataJadwal() {
        $("#tableData tbody").empty();
        let hari = document.getElementById("hari").value;
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: `/jadwal-siaran-show/${hari}`,
            success: function(response) {
                let data = response;
                let k = 1;
                for (let i = 0; i < data.length; i++) {
                    var tr = $("<tr>");
                    tr.append("<td>" + k++ + "</td>");
                    tr.append("<td style='text-transform:capitalize'>" + data[i].hari + "</td>");
                    tr.append("<td>" + data[i].nama_siaran + "</td>");
                    tr.append("<td>" + data[i].waktu_mulai + "</td>");
                    tr.append("<td>" + data[i].waktu_selesai + "</td>");
                    tr.append(`<td>
                                    <button onclick="updateJadwal('${data[i].id}','${data[i].waktu_mulai}','${data[i].waktu_selesai}','${data[i].nama_siaran}')" type="button"data-target="#modal-form" data-toggle="modal" class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i></button>
                                    <button 
                                    onclick="deleteJadwal('${data[i].id}')"
                                    type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-secondary btn-sm"><i class="fa fa-trash"></i></button>
                                </td>`);
                    $("#tableData").append(tr);
                }
            }
        })
    }
</script>
@endsection