@extends('layouts.frontend.index')
@section('title')
    BUSON | Tiket Bus Online
@endsection

@section('content')
    <section class="list" id="search">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif
        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="heading">
                    <h2>Rekomendasi Bus</h2>
                    <p class="text-success fw-bold">Berikut Rekomendasi Bus Untuk Anda</p>
                </div>
                <form action="" method="get" id="type">
                    <select class="form-select custom-select-icon" name="type" aria-label="Default select example">
                        <option {{ empty($type) ? 'selected' : '' }} value=""><i
                                class="fa-regular fa-filter-list"></i> Type Kelas
                        </option>
                        <option {{ $type == 'eksekutif' ? 'selected' : '' }} value="eksekutif">Eksekutif</option>
                        <option {{ $type == 'ekonomi' ? 'selected' : '' }} value="ekonomi">Ekonomi</option>
                        <option {{ $type == 'bisnis' ? 'selected' : '' }} value="bisnis">Bisnis</option>
                    </select>
                </form>
            </div>

            <div class="row justify-content-center">
                @forelse ($data as $bus)
                    <div class="col-md-3 col-11">
                        <div class="card p-3">
                            <img src="{{ asset('fe/img/' . $bus->image) }}" alt="">
                            <div class="text-center mb-3">
                                <h3>{{ $bus->title }}</h3>
                                <hr class="mb-2 mt-3">
                                <p>Jakarta <i class="fa-sharp fa-solid fa-arrow-right"></i> Wonogiri</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="type">
                                    <p class="mb-0">{{ ucfirst(trans($bus->type)) }}</p>
                                    <h4>Rp {{ number_format($bus->harga) }}</h4>
                                </div>
                                <button class="btn btn-primary" id="order" data-armada="{{ $bus->id }}"
                                    data-harga="{{ $bus->harga }}">Pesan</button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            Tidak ada Armada Yang tersedia
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- pesan -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <h2 class="text-center">Form Pemesaranan</h2>
                        <hr>
                        <form action="{{ route('pesan') }}" method="POST">
                            @csrf
                            <input type="number" hidden value="" id="harga">
                            <input type="number" hidden value="" name="armada_id" id="armada">
                            <input type="number" hidden value="" name="total" id="total_harga">
                            <div class="row g-3 align-items-center mb-0 mt-0">
                                <div class="col-4">
                                    <label for="nama" class="col-form-label">Nama Lengkap</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" id="nama" name="nama" class="form-control">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-0 mt-0">
                                <div class="col-4">
                                    <label for="identitas" class=" col-form-label">Nomor Identitas</label>
                                </div>
                                <div class="col-8">
                                    <input type="number" id="identitas" name="identitas" class=" form-control">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-0 mt-0">
                                <div class="col-4">
                                    <label for="handphone" class=" col-form-label">No Hp</label>
                                </div>
                                <div class="col-8">
                                    <input type="number" id="handphone" name="handphone" class=" form-control">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-0 mt-0">
                                <div class="col-4">
                                    <label for="jadwal" class=" col-form-label">Jadwal Berangkat</label>
                                </div>
                                <div class="col-8">
                                    <input type="date" id="jadwal" name="jadwal" class=" form-control">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-0 mt-0">
                                <div class="col-4">
                                    <label for="normal" class=" col-form-label">Jumlah Penumpang</label>
                                </div>
                                <div class="col-8">
                                    <input type="number" id="normal" name="normal" class=" form-control">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-0 mt-0">
                                <div class="col-4">
                                    <label for="lansia" class=" col-form-label">Jumlah Penumpang Lansia</label>
                                </div>
                                <div class="col-8">
                                    <input type="number" id="lansia" name="lansia" class=" form-control">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-0 mt-0">
                                <div class="col-4">
                                    <label for="lansia" class=" col-form-label">Harga Tiket</label>
                                </div>
                                <div class="col-8">
                                    <p class="fw-bold mt-2" id="tiket_harga">Rp 0</p>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-0 mt-0">
                                <div class="col-4">
                                    <label for="lansia" class=" col-form-label">Total Harga Tiket</label>
                                </div>
                                <div class="col-8">
                                    <p class="fw-bold" id="total">Rp 0</p>
                                </div>
                            </div>
                            <hr>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Saya dan/atau rombongan telah membaca,
                                    memahami dan setuju berdasarkan syarat dan ketentuanyang telah diterapkan</label>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-primary w-100" id="hitung">Hitung
                                        Total
                                        Bayar</button>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" disabled class="btn btn-success w-100" id="pesan">Pesan
                                        Tiket</button>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-danger w-100"
                                        data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
