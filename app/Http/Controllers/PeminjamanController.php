<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pinjam;
use App\Models\Pengembalian;
use App\Models\User;
use App\Models\Buku;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjaman = Pinjam::with(['buku', 'user'])->get();
        return view('peminjaman.index', compact('peminjaman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Logic for creating a new peminjaman (if necessary)
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'tanggal_pinjam' => 'required|date',
        ]);
    
        try {
            // Simpan data peminjaman
            Pinjam::create([
                'buku_id' => $validated['buku_id'],
                'user_id' => Auth::id(),
                'tgl_pinjam' => $validated['tanggal_pinjam'],
                'status' => 'pinjam',
            ]);
    
            // Kirimkan response sukses
            return response()->json([
                'success' => true,
                'message' => 'Peminjaman berhasil disimpan.'
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Logic to show a specific peminjaman if necessary
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Logic to edit peminjaman if necessary
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Update peminjaman logic if necessary
    }

    /**
     * Update the status of the peminjaman to 'kembali'.
     */
    public function updateStatus($id)
    {
        // Cari peminjaman berdasarkan ID
        $peminjaman = Pinjam::findOrFail($id);

        // Perbarui status peminjaman menjadi 'kembali' dan set tanggal kembali
        $peminjaman->update([
            'status' => 'kembali',
            'tgl_kembali' => now(),
        ]);

        // Redirect setelah sukses
        return redirect()->back()->with('success', 'Status peminjaman berhasil diperbarui menjadi kembali');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Cari peminjaman berdasarkan ID
        $peminjaman = Pinjam::findOrFail($id);

        // Hapus peminjaman
        $peminjaman->delete();

        // Redirect setelah sukses
        return redirect()->back()->with('success', 'Peminjaman berhasil dihapus.');
    }
}
