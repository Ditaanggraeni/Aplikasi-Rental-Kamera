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

        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Kamera',
            'data' => $kamera
        ], 200);

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

        $image = $request->file('image');
        $image->storeAs('public/kameras', $image->hashName());
    
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
                ], 200);
            }else{
                return response()->json([
                'success' => false,
                'message' => 'Kamera gagal di tambahkan',
                'data' => $kamera
            ], 409);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
