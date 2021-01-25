<?php

namespace App\Http\Controllers\Api;

use App\Models\Kamera;
use App\Http\Controllers\Controller;
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
        $kamera = Kamera::latest()->paginate(10);

        return response()->json([ // yang direturn atau dikembalikan berupa json
            'success' => true, 
            'message' => 'Daftar Data Kamera',
            'data' => $kamera
        ], 200); //http status code sukses

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
        $image->storeAs('public/kameras', $image->hashName()); //gambar yang di upload akan masuk ke folder public/kameras
    
        $kamera = Kamera::create([
            'image'     => $image->hashName(),
            'kategori_id'     => $request->kategori_id,
            'merk'     => $request->merk,
            'harga'   => $request->harga
        ]);

        if($kamera)
            {
                return response()->json([ 
                    'success' => true,
                    'message' => 'Kamera berhasil di tambahkan',
                    'data' => $kamera
                ], 200); //http status code sukses
            }else{
                return response()->json([
                'success' => false,
                'message' => 'Kamera gagal di tambahkan',
                'data' => $kamera
            ], 409); //http status code conflict
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
        $kamera = Kamera::where('id', $id)->first();

        return response()->json([
            'success' => true,
            'message' => 'Detail data kamera',
            'data' => $kamera
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'merk'     => 'required',
            'harga'   => 'required'
        ]);
        
    //get data kamera by ID
    $kamera = Kamera::find($id);

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
        return response()->json([ 
            'success' => true,
            'message' => 'Kamera berhasil di update',
            'data' => $kamera
        ], 200); //http status code sukses
    }else{
        return response()->json([
            'success' => false,
            'message' => 'Kamera gagal di update',
            'data' => $kamera
        ], 409); //http status code conflict
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
        $kamera = Kamera::find($id)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Kamera Deleted',
                'data' => $kamera
            ], 200);
    }
}