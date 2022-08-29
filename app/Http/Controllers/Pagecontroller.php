<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
class Pagecontroller extends Controller
{
    public function index()
    {
        return view ('page.index');
    }

    public function post(Request $request)
    {
       

        $this->validate( $request, [
            'nama'=> 'required',
            'nama_p' => 'required',
            'nim' => 'required | max:9',
            'gambar' => 'required', 
            'jurusan' => 'required'
        ]);

        Mahasiswa::create([
            'nama' => $request->input('nama'),
            'nama_p' => $request->input('nama_p'),
            'nim' => $request->input('nim'),
            'gambar' => $request->input('gambar'),
            'jurusan' => $request->input('jurusan')
        ]);
        if($request->file('gambar')) {
            $mhsa['gambar'] = $request->file('gambar')->store('kategori-images');
        }

        return redirect() -> back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function mahasiswa()
    {
        $mahasiswa = Mahasiswa::all();
        return view('page.mahasiswa', compact('mahasiswa'));
    }

    public function edit(Request $request, $id)
    {
       
        if($request->isMethod('post')) 
        {
            $mhsa = $request->all();

            Mahasiswa::where(['id'=> $id])->update([
                'gambar' => 'image|mimes:png,jpeg,jpg',
                'nama' => $mhsa['nama'],
                'nama_p' => $mhsa['nama_p'],
                'nim' => $mhsa['nim'],
                'jurusan' => $mhsa['jurusan']
            ]);

            

            return redirect()->back()->with('success', 'Data Berhasil Diupdate');
        }
    }

    public function show($id)
    {
        // $maha = $id->all();
        Mahasiswa::where(['id'=>$id]);

        return view('page.mahasiswa');
    }

    public function delete($id=null)
    {
        Mahasiswa::where(['id'=>$id])->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

}
