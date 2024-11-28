@extends('layouts.guest')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah User</div>

                <div class="card-body">
                <form method="POST" action="{{ route('buku.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Judul') }}</label>

                            <div class="col-md-6">
                                <input id="judul" type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul') }}" required autocomplete="judul" autofocus>

                                @error('judul')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="penulis" class="col-md-4 col-form-label text-md-end">{{ __('Penulis') }}</label>

                            <div class="col-md-6">
                                <input id="nama_lengkap" type="text" class="form-control @error('penulis') is-invalid @enderror" name="penulis" value="{{ old('penulis') }}" required autocomplete="penulis" autofocus>

                                @error('penulis')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="penerbit" class="col-md-4 col-form-label text-md-end">{{ __('Penerbit') }}</label>

                            <div class="col-md-6">
                                <input id="penerbit" type="text" class="form-control @error('penerbit') is-invalid @enderror" name="penerbit" value="{{ old('penerbit') }}" required autocomplete="penerbit">

                                @error('penerbit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="isbn" class="col-md-4 col-form-label text-md-end">{{ __('ISBN') }}</label>

                            <div class="col-md-6">
                                <input id="isbn" type="text" class="form-control @error('isbn') is-invalid @enderror" name="isbn" value="{{ old('isbn') }}" required autocomplete="isbn">

                                @error('isbn')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tahun" class="col-md-4 col-form-label text-md-end">{{ __('Tahun Terbit') }}</label>

                            <div class="col-md-6">
                                <input id="tahun" type="text" class="form-control @error('tahun') is-invalid @enderror" name="tahun" required autocomplete="tahun">

                                @error('tahun')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jumlah" class="col-md-4 col-form-label text-md-end">{{ __('Jumlah Buku') }}</label>

                            <div class="col-md-6">
                                <input id="jumlah" type="text" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" required autocomplete="jumlah">

                                @error('jumlah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kategori" class="col-md-4 col-form-label text-md-end">{{ __('Kategori') }}</label>
                            <div class="col-md-6">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownKategori" data-bs-toggle="dropdown" aria-expanded="false">
                                        Pilih Kategori
                                    </button>
                                    <div class="dropdown-menu p-3" aria-labelledby="dropdownKategori">
                                        @foreach($kategoris as $kat)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="kategoris[]" value="{{ $kat->id }}" id="kategori{{ $kat->id }}">
                                                <label class="form-check-label" for="kategori{{ $kat->id }}">
                                                    {{ $kat->nama_kategori }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                @error('kategoris')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Tambah Buku') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection