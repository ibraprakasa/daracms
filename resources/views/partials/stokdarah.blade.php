@extends('template')
@extends('sidebar')
@section('content')

<head>
    <title>
        DARA || Stok Darah
    </title>
    <link href="../assets/css/stylepartials.css" rel="stylesheet">
</head>

<div class="filter btn-group">
    <button class="btn btn-light" type="button" style="background-color: #d9d9d9; color:black;border-radius:15px 0 0 0;">
        Cari Golongan Darah...
    </button>
    <button type="button" class="btn btn-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size:15px;background-color: #3B4B65;border-radius:0 0 15px 0;">
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div style="background-color:#D9D9D9" class="dropdown-menu">
        <a class="dropdown-item" href="#">A</a>
        <a class="dropdown-item" href="#">AB</a>
        <a class="dropdown-item" href="#">B</a>
        <a class="dropdown-item" href="#">O</a>
    </div>
</div>

<div class="filter btn-group">

    <button type="button" class="btn btn-dark" data-toggle="modal" data-target=".tambahstokdarah" style="border-radius:15px 0 0 15px;width: 22px; display: flex; justify-content: center; align-items: center; background-color: #3B4B65;">
        <i class="bi bi-file-plus" style="font-size: 20px; color: white;"></i>
    </button>

    <button class="btn btn-secondary" type="button" style="background-color: #d9d9d9; color:black;border-radius:0 0 0 0;">
        Tambah
    </button>

</div>

<div class="filter btn-group">

    <button type="button" class="btn btn-dark" data-toggle="modal" data-target=".ambilstokdarah" style="border-radius:15px 0 0 15px;width: 22px; display: flex; justify-content: center; align-items: center; background-color: #3B4B65;">
        <i class="bi bi-file-minus" style="font-size: 20px; color: white;"></i>
    </button>

    <button class="btn btn-secondary" type="button" style="background-color: #d9d9d9; color:black;border-radius:0 0 0 0;">
        Ambil
    </button>

</div>

<div class="content" style="margin-top: 20px;">
    <table class="table table-bordered" style="text-align:center; width:1px;">
        <thead class="thead" style="background-color:#3B4B65; color:white;">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Golongan Darah</th>
                <th scope="col">Jumlah</th>
                <th scope="col">UPDATE_AT</th>
            </tr>
        </thead>
        <tbody class="waduh">
            @foreach($data as $key => $row)
            <tr>
                <th scope="row">{{ $key+1 }}</th>
                <td>{{ $row->golongandarah->nama }}</td>
                <td>{{ $row->jumlah }}</td>
                <td>{{ $row->updated_at->diffForHumans() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- MODAL TAMBAH -->
@foreach($data as $row)
<div class="modal fade tambahstokdarah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="titlemodal">Tambah Stok Donor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"">
              <span aria-hidden=" true">&times;</span>
                </button>
            </div>
            <form action="/insertstok" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="goldar">Kode Pendonor</label>
                        <select class="kolom form-control" name="kode_pendonor" id="goldar">
                            @foreach($kode_pendonor as $kp)
                            <option class="kolom form-control" value="{{ $kp->kode_pendonor }}">{{ $kp->kode_pendonor }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="jumlah">Jumlah Kantong</label>
                        <input class="kolom form-control" name="jumlah" type="number" id="jumlah" placeholder="ex : 5">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" style="background-color: #03A13B; border-radius:10px">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<!-- END MODAL -->

<!-- MODAL AMBIL -->
@foreach($data as $row)
<div class="modal fade ambilstokdarah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="titlemodal">Ambil Stok Donor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"">
              <span aria-hidden=" true">&times;</span>
                </button>
            </div>
            <form action="/updatestok" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="goldar">Kode Pendonor</label>
                        <select class="kolom form-control" name="kode_pendonor" id="goldar">
                            @foreach($kode_pendonor as $kp)
                            <option class="kolom form-control" value="{{ $kp->kode_pendonor }}">{{ $kp->kode_pendonor }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="jumlah">Jumlah Ambil Kantong</label>
                        <input class="kolom form-control" name="jumlah" type="number" id="jumlah" placeholder="ex : 5">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="penerimadonor">Penerima Donor</label>
                        <input class="kolom form-control" name=“penerima” type="text" id="penerimadonor" placeholder="ex : Ibra Prakasa">
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="kontak">Kontak Penerima</label>
                        <input class="kolom form-control" name=“kontak” type="number" id="kontak" placeholder="ex : 082235221771">
                    </div>
                    <!-- <div class="form-group" style="color:black; font-weight:bold">
                        <label for="nomorpendonor">Nomor Pendonor</label>
                        <input class="kolom form-control" type="number" id="nomorpendonor" placeholder="ex: 00000000">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="kontak">Kontak Penerima</label>
                        <input class="kolom form-control" type="number" id="kontak" placeholder="ex : 082235221771">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="jumlahambil">Jumlah Ambil Kantong</label>
                        <input class="kolom form-control" type="number" id="jumlahambil" placeholder="ex : 3">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="penerimadonor">Penerima Donor</label>
                        <input class="kolom form-control" type="text" id="penerimadonor" placeholder="ex : Ibra Prakasa">
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" style="background-color: #03A13B; border-radius:10px">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<!-- END MODAL -->


@endsection