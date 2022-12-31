<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function uploadImage(Request $req)
    {
        $req->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $image = $req->file('image');
        

        $name = 'img_' . uniqid();
        $ext = $image->extension();
        $filename = '/products/' . $name . '.' . $ext;


        $image->storePubliclyAs('public', $filename);


        return response()->json(['image'=>$filename], 200);
    }
}
