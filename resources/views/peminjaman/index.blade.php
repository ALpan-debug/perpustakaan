@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Daftar Peminjaman</h2>
    <div class="table-responsive">
        <table class="table table-hover table-striped align-middle mt-3">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Buku</th>
                    <th>Peminjam</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjaman as $peminjamans)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $peminjamans->buku->judul }}</td>
                        <td>{{ $peminjamans->user->name }}</td>
                        <td>{{ $peminjamans->tgl_pinjam }}</td>
                        <td>{{ $peminjamans->tgl_kembali ?? '-' }}</td>
                        <td>
                            <span class="badge bg-{{ $peminjamans->status == 'pinjam' ? 'warning' : 'success' }}">
                                {{ ucfirst($peminjamans->status) }}
                            </span>
                        </td>
                        <td class="text-center">
                            @if ($peminjamans->status == 'pinjam')
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#statusModal" data-peminjaman-id="{{ $peminjamans->id }}">Kembali</button>
                            @endif
                            <form action="{{ route('peminjaman.destroy', $peminjamans->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Update Status -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="statusForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Ubah Status Peminjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin mengubah status peminjaman ini menjadi <strong>kembali</strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Ya, Kembali</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    var statusModal = document.getElementById('statusModal');
    statusModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var peminjamanId = button.getAttribute('data-peminjaman-id');

        // Update action form untuk mengubah status
        var form = document.getElementById('statusForm');
        form.action = '/peminjaman/' + peminjamanId + '/status';
    });
</script>
@endsection
