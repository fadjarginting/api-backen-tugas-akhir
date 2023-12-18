<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi;
class MateriController extends Controller
{
    public function getmateri(){
        $materi = Materi::all();
        if($materi){
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil Menampilkan Data Materi',
                'count' => $materi->count(),
                'data' => $materi,                
            ]);
        }
        return response()->json([
            'status' => 404,
            'message' => 'Data Materi Tidak Ditemukan'
        ]);
    }


    
    public function postmateri(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'judul' => 'required',
            'materi' => 'required',
            'link_vd' => 'nullable|url',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed
        ]);

        // Handle the image upload
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/gambar', $imageName);

            // Save only the image filename to the database
            $materi = Materi::create([
                'judul' => $request->judul,
                'materi' => $request->materi,
                'link_vd' => $request->link_vd,
                'gambar' => $imageName, // Save only the filename
            ]);

            if ($materi) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Berhasil Menambahkan Data Materi',
                    'data' => $materi,
                ]);
            }
        }

        return response()->json([
            'status' => 404,
            'message' => 'Gagal Menambahkan Data Materi',
        ]);
    }

}
