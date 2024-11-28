@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body">
                    @if($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    @if($message = Session::get('error'))
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    
                    <a href="{{ route('buku.create') }}" class="btn btn-success btn-md m-4"><i class="fa fa-plus"></i> Tambah Buku</a>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Penerbit</th>
                                <th>Tahun Terbit</th>
                                <th>ISBN</th>
                                <th>Jumlah</th>
                                <th>Kategori</th>
                                <th>Pinjam</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($buku as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>{{ $item->penulis }}</td>
                                <td>{{ $item->penerbit }}</td>
                                <td>{{ $item->tahun }}</td>
                                <td>{{ $item->isbn }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>
                                    @foreach($item->kategoriRelasi as $kate)
                                        {{ $kate->kategori->nama_kategori }}
                                    @endforeach
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#peminjamanModal" data-buku-id="{{ $item->id }}" data-judul="{{ $item->judul }}">Pinjam</button>
                                </td>
                                <td>
                                    @if(Auth::user()->isAdmin() || Auth::user()->role == 'user')
                                        <div class="input-group mb-3">
                                            <a href="{{ route('buku.edit', $item->id) }}" class="btn btn-sm btn-secondary mx-1 shadow" title="Edit"><i class="fa fa-lg fa-fw fa-pen"></i></a>
                                            <form method="POST" action="{{ route('buku.destroy', $item->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-lg fa-fw fa-trash"></i></button>
                                            </form>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $buku->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Peminjaman -->
<div class="modal fade" id="peminjamanModal" tabindex="-1" aria-labelledby="peminjamanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="peminjamanForm" action="{{ route('peminjaman.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="peminjamanModalLabel">Tambah Peminjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="buku_id" id="modalBukuId">
                    <div class="mb-3">
                        <label for="modalJudulBuku" class="form-label">Buku</label>
                        <input type="text" id="modalJudulBuku" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                        <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- SweetAlert Konfirmasi Hapus -->
<script type="text/javascript">
    $(".btn-delete").click(function(e){
        e.preventDefault();
        var form = $(this).parents("form");
        Swal.fire({
            title: "Konfirmasi Hapus Buku",
            text: "Apakah Anda yakin ingin menghapus buku ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Ambil referensi modal peminjaman
    var peminjamanModal = document.getElementById('peminjamanModal');
    
    // Tambahkan event listener ketika modal ditampilkan
    peminjamanModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Tombol yang membuka modal
        var bukuId = button.getAttribute('data-buku-id'); // Ambil data buku ID
        var judul = button.getAttribute('data-judul'); // Ambil data judul buku
        
        // Isi nilai pada input di modal
        document.getElementById('modalBukuId').value = bukuId; // Input hidden untuk ID buku
        document.getElementById('modalJudulBuku').value = judul; // Input untuk judul buku (readonly)
    });

    // Tambahkan event listener pada form untuk submit
    var peminjamanForm = document.getElementById('peminjamanForm');
    peminjamanForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Cegah form dikirim secara default

        // Kirim data ke controller menggunakan AJAX
        var formData = new FormData(this); // Ambil data dari form
        fetch(this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: formData
        })
        .then(response => response.json()) // Menganggap respons dalam format JSON
        .then(data => {
            if (data.success) {
                alert('Peminjaman berhasil disimpan.');
                location.reload(); // Refresh halaman setelah berhasil
            } else {
                alert('Terjadi kesalahan: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengirim data.');
        });
    });
</script>


@endsection
