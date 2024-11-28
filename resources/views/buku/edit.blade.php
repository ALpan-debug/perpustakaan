@extends('layouts.guest')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Buku</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('buku.update', $buku->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Judul -->
                        <div class="row mb-3">
                            <label for="judul" class="col-md-4 col-form-label text-md-end">{{ __('Judul') }}</label>

                            <div class="col-md-6">
                                <input id="judul" type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul', $buku->judul) }}" required autocomplete="judul" autofocus>

                                @error('judul')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Penulis -->
                        <div class="row mb-3">
                            <label for="penulis" class="col-md-4 col-form-label text-md-end">{{ __('Penulis') }}</label>

                            <div class="col-md-6">
                                <input id="penulis" type="text" class="form-control @error('penulis') is-invalid @enderror" name="penulis" value="{{ old('penulis', $buku->penulis) }}" required autocomplete="penulis" autofocus>

                                @error('penulis')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Penerbit -->
                        <div class="row mb-3">
                            <label for="penerbit" class="col-md-4 col-form-label text-md-end">{{ __('Penerbit') }}</label>

                            <div class="col-md-6">
                                <input id="penerbit" type="text" class="form-control @error('penerbit') is-invalid @enderror" name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" required autocomplete="penerbit">

                                @error('penerbit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- ISBN -->
                        <div class="row mb-3">
                            <label for="isbn" class="col-md-4 col-form-label text-md-end">{{ __('ISBN') }}</label>

                            <div class="col-md-6">
                                <input id="isbn" type="text" class="form-control @error('isbn') is-invalid @enderror" name="isbn" value="{{ old('isbn', $buku->isbn) }}" required autocomplete="isbn">

                                @error('isbn')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Tahun Terbit -->
                        <div class="row mb-3">
                            <label for="tahun" class="col-md-4 col-form-label text-md-end">{{ __('Tahun Terbit') }}</label>

                            <div class="col-md-6">
                                <input id="tahun" type="text" class="form-control @error('tahun') is-invalid @enderror" name="tahun" value="{{ old('tahun', $buku->tahun) }}" required autocomplete="tahun">

                                @error('tahun')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Jumlah Buku -->
                        <div class="row mb-3">
                            <label for="jumlah" class="col-md-4 col-form-label text-md-end">{{ __('Jumlah Buku') }}</label>

                            <div class="col-md-6">
                                <input id="jumlah" type="text" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" value="{{ old('jumlah', $buku->jumlah) }}" required autocomplete="jumlah">

                                @error('jumlah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Kategori -->
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
                                                <input class="form-check-input" type="checkbox" name="kategoris[]" value="{{ $kat->id }}" id="kategori{{ $kat->id }}"
                                                    @if($buku->kategoriRelasi->pluck('kategori_id')->contains($kat->id)) checked @endif>
                                                <label class="form-check-label" for="kategori{{ $kat->id }}">
                                                    {{ $kat->nama_kategori }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Buku') }}
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
