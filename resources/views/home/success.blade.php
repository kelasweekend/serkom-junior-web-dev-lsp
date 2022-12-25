@extends('layouts.frontend.index')
@section('title')
    Detail Tiket
@endsection

@section('content')
    <section class="list">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <img src=" https://api.qrserver.com/v1/create-qr-code/?data=FauzanTaqiyuddin"
                                class="img-fluid w-100 h-100" alt="">
                        </div>
                        <div class="col-md-6">
                            <h2 class="fw-bold mb-4 text-center mt-3">Tiket Pemesanan Anda</h2>
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th scope="row">Nama Armada</th>
                                        <td>:</td>
                                        <td>{{ $armada->title }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Type Kelas Armada</th>
                                        <td>:</td>
                                        <td>{{ $armada->type }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Nama Lengkap</th>
                                        <td>:</td>
                                        <td>{{ $data->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">No Identitas</th>
                                        <td>:</td>
                                        <td>{{ $data->ktp }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">No Handphone</th>
                                        <td>:</td>
                                        <td>{{ $data->handphone }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Jadwal Berangkat</th>
                                        <td>:</td>
                                        <td>{{ $data->jadwal }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Jumlah Penumpang</th>
                                        <td>:</td>
                                        <td>{{ $data->normal }} Orang</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Jumlah Penumpang Lansia</th>
                                        <td>:</td>
                                        <td>{{ $data->lansia }} Orang</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Total harga</th>
                                        <td>:</td>
                                        <td>Rp {{ number_format($data->harga) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
