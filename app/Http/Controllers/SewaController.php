<?php

namespace App\Http\Controllers;

use App\Models\Sewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SewaController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sewa = sewa::latest()->paginate(10);
        return view('sewa.index', compact('sewa'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sewa.create');
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
            'merk'     => 'required',
            'harga'   => 'required',
            'penyewa'   => 'required',
            'jaminan'   => 'required',
            'tgl_sewa'   => 'required',
            'tgl_kembali'   => 'required',
            'denda'   => 'required',
            'total'   => 'required',
        ]);
    
        //upload image
        $image = $request->file('image');
        $image->storeAs('public/sewas', $image->hashName());
    
        $sewa = Sewa::create([
            'image'     => $image->hashName(),
            'merk'     => $request->merk,
            'harga'   => $request->harga,
            'penyewa'   => $request->penyewa,
            'jaminan'   => $request->jaminan,
            'tgl_sewa'   => $request->tgl_sewa,
            'tgl_kembali'   => $request->tgl_kembali,
            'denda'   => $request->denda,
            'total'   => $request->total
        ]);
    
        if($sewa){
            //redirect dengan pesan sukses
            return redirect()->route('sewa.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('sewa.index')->with(['error' => 'Data Gagal Disimpan!']);
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
    public function edit(sewa $sewa)
    {
        return view('sewa.edit', compact('sewa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sewa $sewa)
    {
        $this->validate($request, [
            'merk'     => 'required',
            'harga'   => 'required',
            'penyewa'   => 'required',
            'jaminan'   => 'required',
            'tgl_sewa'   => 'required',
            'tgl_kembali'   => 'required',
            'denda'   => 'required',
            'total'   => 'required',
        ]);
        
    //get data sewa by ID
    $sewa = sewa::findOrFail($sewa->id);

    if($request->file('image') == "") {

        $sewa->update([
            'merk'     => $request->merk,
            'harga'   => $request->harga,
            'penyewa'   => $request->penyewa,
            'jaminan'   => $request->jaminan,
            'tgl_sewa'   => $request->tgl_sewa,
            'tgl_kembali'   => $request->tgl_kembali,
            'denda'   => $request->denda,
            'total'   => $request->total
        ]);

    } else {

        //hapus old image
        Storage::disk('local')->delete('public/sewas/'.$sewa->image);

        //upload new image
        $image = $request->file('image');
        $image->storeAs('public/sewas', $image->hashName());

        $kamera->update([
            'image'     => $image->hashName(),
            'merk'     => $request->merk,
            'harga'   => $request->harga,
            'penyewa'   => $request->penyewa,
            'jaminan'   => $request->jaminan,
            'tgl_sewa'   => $request->tgl_sewa,
            'tgl_kembali'   => $request->tgl_kembali,
            'denda'   => $request->denda,
            'total'   => $request->total
        ]);

    }

    if($sewa){
        //redirect dengan pesan sukses
        return redirect()->route('sewa.index')->with(['success' => 'Data Berhasil Diupdate!']);
    }else{
        //redirect dengan pesan error
        return redirect()->route('sewa.index')->with(['error' => 'Data Gagal Diupdate!']);
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
        
  $sewa = sewa::findOrFail($id);
  Storage::disk('local')->delete('public/sewas/'.$sewa->image);
  $sewa->delete();

  if($sewa){
     //redirect dengan pesan sukses
     return redirect()->route('sewa.index')->with(['success' => 'Data Berhasil Dihapus!']);
  }else{
    //redirect dengan pesan error
    return redirect()->route('sewa.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
