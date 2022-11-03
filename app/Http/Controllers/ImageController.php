<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        Storage::disk('local')->put($name, $file);
        $file->move('img/', $name);

        return response()->json(['url' => asset('/img/'.$name)], 201);
    }
}
