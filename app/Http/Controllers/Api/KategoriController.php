<?php

namespace App\Http\Controllers\Api;

use App\Models\Kategori;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = kategori::orderBy('id', 'desc')->paginate(3);

        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Kategori',
            'data' => $kategori
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
        $request->validate([
            'name' => 'required|unique:kategoris|max:255',
            'description' => 'required',
        ]);

        $kategori = kategori::create([
            'name'=> $request->name,
            'description' => $request->description,
            ]);

            if($kategori)
            {
                return response()->json([
                    'success' => true,
                    'message' => 'Kategori berhasil di tambahkan',
                    'data' => $kategori
                ], 200);
            }else{
                return response()->json([
                'success' => false,
                'message' => 'Kategori gagal di tambahkan',
                'data' => $kategori
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
        $kategori = kategori::where('id', $id)->first();

        return response()->json([
            'success' => true,
            'message' => 'Detail data kategori',
            'data' => $kategori
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
        $kategori = Kategori::find($id)->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Kategori Updated',
            'data' => $kategori
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = kategori::find($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kategori Deleted',
            'data' => $kategori
        ], 200);
    }
}
