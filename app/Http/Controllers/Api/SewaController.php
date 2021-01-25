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
        $sewa = sewa::where('id', $id)->first();

        return response()->json([
            'success' => true,
            'message' => 'Detail data sewa',
            'data' => $sewa
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
            'harga'   => 'required',
            'penyewa'   => 'required',
            'jaminan'   => 'required',
            'tgl_sewa'   => 'required',
            'tgl_kembali'   => 'required',
            'denda'   => 'required',
            'total'   => 'required',
        ]);
        
    //get data sewa by ID
    $sewa = sewa::find($id);

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

        $kamera->update($request->except('image'))([
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
        return response()->json([ 
            'success' => true,
            'message' => 'sewa berhasil di update',
            'data' => $sewa
        ], 200); //http status code sukses
    }else{
        return response()->json([
            'success' => false,
            'message' => 'sewa gagal di update',
            'data' => $sewa
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
        $sewa = sewa::find($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Sewa Deleted',
            'data' => $sewa
        ], 200);
    }
}
