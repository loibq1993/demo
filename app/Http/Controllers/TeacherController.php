<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        return view('students.index');
    }
}
