<?php

namespace App\Http\Controllers\Api;

use App\Models\Sewa;
use App\Http\Controllers\Controller;
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
       
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Sewa',
            'data' => $sewa
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
     
         $sewa = sewa::create([
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

         if($sewa)
         {
             return response()->json([
                 'success' => true,
                 'message' => 'Data Sewa berhasil di tambahkan',
                 'data' => $sewa
             ], 200);
         }else{
             return response()->json([
             'success' => false,
             'message' => 'Data Sewa gagal di tambahkan',
             'data' => $sewa
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
