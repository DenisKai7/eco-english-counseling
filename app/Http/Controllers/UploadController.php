<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads/images', 'public'); // Simpan di storage/app/public/uploads/images
            return response()->json(['location' => Storage::url($path)]); // Kembalikan URL publik
        }

        return response()->json(['error' => 'No image uploaded'], 400);
    }

    // Anda bisa menambahkan metode untuk upload audio jika diperlukan
    public function uploadAudio(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:mp3,wav,ogg|max:10240', // Maksimal 10MB
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads/audio', 'public');
            return response()->json(['location' => Storage::url($path)]);
        }

        return response()->json(['error' => 'No audio uploaded'], 400);
    }
}
