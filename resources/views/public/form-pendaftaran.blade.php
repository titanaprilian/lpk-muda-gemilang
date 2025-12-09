@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/pendaftaran.css') }}">
@endpush

@section('title', 'Beranda - LPK Muda Gemilang')

@section('content')
    <div class="form-container" data-aos="fade-up">
        <h2>Formulir Pendaftaran LPK Muda Gemilang</h2>
        <form action="#" method="post">

            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan Nama Lengkap" required>

            <label for="ttl">Tempat Tanggal Lahir</label>
            <input type="text" id="ttl" name="ttl" placeholder="Masukkan Tempat Tanggal Lahir" required>

            <label for="Usia">Usia</label>
            <input type="text" id="usia" name="usia" placeholder="Masukkan Usia Anda" required>

            <label for="jenis_kelamin">Jenis Kelamin</label>
            <input type="text" id="jenis_kelamin" name="jenis_kelamin" placeholder="Masukkan Jenis Kelamin" required>

            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" placeholder="Masukkan alamat Tempat Tinggal" required></textarea>

            <label for="asal_sekolah">Asal Sekolah</label>
            <input type="text" id="asal_sekolah" name="asal_sekolah" placeholder="Masukkan Asal Sekolah" required>

            <label for="telepon">Nomor Telepon</label>
            <input type="text" id="telepon" name="telepon" placeholder="Masukkan Nomor Aktif" required>

            <label for="telepon">Nomor Telepon Orang Tua/Wali</label>
            <input type="text" id="telepon" name="telepon" placeholder="Masukkan Nomor Aktif" required>

            <label for="email">Email</label>
            <input type="text" id="email" name="email" placeholder="Masukkan alamat email" required>

            <label for="hobi">Hobi</label>
            <input type="text" id="hobi" name="hobi" placeholder="Masukkan Hobi" required>

            <label for="tb_bb">Tinggi & Berat Badan</label>
            <input type="text" id="tb_bb" name="tb_bb" placeholder="Masukkan Tinggi & Berat Badan" required>

            <label for="kerja">Pengalaman Kerja</label>
            <textarea id="kerja" name="kerja" placeholder="Tuliskan Pengalaman Kerja" required></textarea>

            <label class="form-label">Tujuan ke Jepang</label>
            <div class="checkbox-group">
                <label>
                    <input type="checkbox" name="tujuan[]" value="pemagangan">
                    Program Magang Jepang
                </label>
                <label>
                    <input type="checkbox" name="tujuan[]" value="tokutei">
                    Program Tokutei Ginou
                </label>
            </div>

            <button type="submit" class="cta-btn">Kirim Pendaftaran</button>
        </form>
        <p id="successMessage" style="display:none; color:green; font-weight:bold; margin-top:10px;">
            Formulir terkirim!
        </p>
    </div>


@endsection
