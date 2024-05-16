<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'proof_of_payment' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string|max:255',
        ]);

        $imageName = time().'.'.$request->proof_of_payment->extension();
        $request->proof_of_payment->move(public_path('images'), $imageName);

        $photo = new Photo;
        $photo->user_id = auth()->user()->id;
        $photo->file_path = '/images/'.$imageName;
        $photo->description = $request->description;
        $photo->save();

        return back()->with('success','You have successfully upload image.');
    }
}
