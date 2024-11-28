<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\User;
use App\Models\Role;
use App\Models\Kategori;
use App\Models\KategoriRelasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::paginate(5);
        return view('kategori.index')->withkategori($kategori);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate= $request->validate([
            'nama_kategori' => 'required|unique:kategoris|min:5',
            'deskripsi' => 'required',
        ]);

        try{
            $kategori = new Kategori;
            $kategori ->nama_kategori = $request->nama_kategori;
            $kategori ->deskripsi=$request->deskripsi;
            $kategori->save();
        }
        catch(Exception $e){
            return redirect()->back()->with('error','Data Gagal Disimpan');
        }
        return redirect('kategori')->with('success','Data Berhasil Disimpian');
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
        $kategori = Kategori::find($id);
        if(!Auth::user()->isAdmin() && $user->hasRole()->value('role')!='user'){
            return redirect('/kategori')->with('error','Anda tidak berhak');
        }else{
            return view('kategori.edit')->with('kategori',$kategori);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate= $request->validate([
            'nama_kategori' => 'required|unique:users|min:5',
            'deskripsi' => 'required',
        ]);

        try{
            $kategori = new Kategori;
            $kategori ->nama_kategori = $request->nama_kategori;
            $kategori ->deskripsi=$request->deskripsi;
            $kategori->save();
        }
        catch(Exception $e){
            return redirect()->back()->with('error','Data Gagal Disimpan');
        }
        return redirect('kategori')->with('success','Data Berhasil Disimpian');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori =Kategori::find($id);
        try{
            $kategori->delete();
        }
        catch(Expention $e){
            return redirect()->back()->with('error','Data Gagal Dihapus');
        }
        return redirect('kategori')->with('success','Data Berhasil Dihapus');
    }
    
    
}
