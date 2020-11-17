<?php

namespace App\Http\Controllers;

use App\Models\Kamera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KameraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kamera = kamera::latest()->paginate(10);
        return view('kamera.index', compact('kamera'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kamera.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image'     => 'required|image|mimes:png,jpg,jpeg',
            'kategori_id'   => 'required',
            'merk'     => 'required',
            'harga'   => 'required'
        ]);
    
        //upload image
        $image = $request->file('image');
        $image->storeAs('public/kameras', $image->hashName());
    
        $kamera = Kamera::create([
            'image'     => $image->hashName(),
            'kategori_id'     => $request->kategori_id,
            'merk'     => $request->merk,
            'harga'   => $request->harga
        ]);
    
        if($kamera){
            //redirect dengan pesan sukses
            return redirect()->route('kamera.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('kamera.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Kamera $kamera)
    {
        return view('kamera.edit', compact('kamera'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kamera $kamera)
    {
        $this->validate($request, [
            'merk'     => 'required',
            'harga'   => 'required'
        ]);
        
    //get data kamera by ID
    $kamera = Kamera::findOrFail($kamera->id);

    if($request->file('image') == "") {

        $kamera->update([
            'merk'     => $request->merk,
            'harga'   => $request->harga
        ]);

    } else {

        //hapus old image
        Storage::disk('local')->delete('public/kameras/'.$kamera->image);

        //upload new image
        $image = $request->file('image');
        $image->storeAs('public/kameras', $image->hashName());

        $kamera->update([
            'image'     => $image->hashName(),
            'merk'     => $request->merk,
            'harga'   => $request->harga
        ]);

    }

    if($kamera){
        //redirect dengan pesan sukses
        return redirect()->route('kamera.index')->with(['success' => 'Data Berhasil Diupdate!']);
    }else{
        //redirect dengan pesan error
        return redirect()->route('kamera.index')->with(['error' => 'Data Gagal Diupdate!']);
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
  $kamera = Kamera::findOrFail($id);
  Storage::disk('local')->delete('public/kameras/'.$kamera->image);
  $kamera->delete();

  if($kamera){
     //redirect dengan pesan sukses
     return redirect()->route('kamera.index')->with(['success' => 'Data Berhasil Dihapus!']);
  }else{
    //redirect dengan pesan error
    return redirect()->route('kamera.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}