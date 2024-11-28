<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\User;
use App\Models\Role;
use App\Models\Pinjam;
use App\Models\Kategori;
use App\Models\KategoriRelasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = Buku::paginate(5);
        return view('buku.index')->withbuku($buku);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris= Kategori::all();
        return view('buku.create')->with('kategoris',$kategoris);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'judul' => ['required', 'string', 'unique:bukus'],
            'penulis' => 'required|string',
            'penerbit' => 'required|string',
            'isbn' => ['required', 'numeric', 'digits:9'],
            'tahun' => ['required', 'integer'],
            'jumlah' => ['required', 'integer'],
            'kategoris.*'=>'required',
        ]);
        

        
        try{
            $buku = new Buku;
            $buku ->judul = $request->judul;
            $buku ->penulis=$request->penulis;
            $buku ->penerbit=$request->penerbit;
            $buku ->isbn = $request->isbn;
            $buku ->tahun = $request->tahun;
            $buku ->jumlah = $request->jumlah;
            $buku->save(); 
            foreach($request->kategoris as $kategoris){
                $kat=new KategoriRelasi;
                $kat->buku_id = $buku->id; 
                $kat->kategori_id = $kategoris; 
                $kat->save();
             }
        //     $buku = Buku::create([
            
        //     //'jumlah' => $request->jumlah,
        // ]);
    }
    catch(Exception $e){
        return redirect()->back()->with('error','Data Gagal Disimpan');
    }
    return redirect('buku')->with('success','Data Berhasil Disimpian');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $buku = Buku::find($id);
        $kategoris= Kategori::all();
        if(!Auth::user()->isAdmin() && $user->hasRole()->value('role')!='user'){
            return redirect('/buku')->with('error','Anda tidak berhak');
        }else{
            return view('buku.edit')->with('buku',$buku)->with('kategoris',$kategoris);
        }
        
       
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Validasi input
    $validate = $request->validate([
        'judul' => ['required', 'string', 'unique:bukus,judul,' . $id],
        'penulis' => 'required|string',
        'penerbit' => 'required|string',
        'isbn' => ['required', 'numeric', 'digits:9'],
        'tahun' => ['required', 'integer'],
        'jumlah' => ['required', 'integer'],
        'kategoris.*' => 'required',
    ]);

    try {
        // Ambil buku berdasarkan ID
        $buku = Buku::findOrFail($id);
        // Update data buku
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->penerbit = $request->penerbit;
        $buku->isbn = $request->isbn;
        $buku->tahun = $request->tahun;
        $buku->jumlah = $request->jumlah;
        $buku->save();

        // Hapus kategori lama dari tabel kategori_relasi
        $buku->kategoriRelasi()->delete();

        // Simpan kategori yang baru
        foreach($request->kategoris as $kategoris){
            $kat=new KategoriRelasi;
            $kat->buku_id = $buku->id; 
            $kat->kategori_id = $kategoris; 
            $kat->save();
        }

    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Data Gagal Disimpan');
    }

    return redirect('buku')->with('success', 'Data Berhasil Diperbarui');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku =Buku::find($id);
        try{
            $buku->delete();
        }
        catch(Expention $e){
            return redirect()->back()->with('error','Data Gagal Dihapus');
        }
        return redirect('buku')->with('success','Data Berhasil Dihapus');
    }
}
