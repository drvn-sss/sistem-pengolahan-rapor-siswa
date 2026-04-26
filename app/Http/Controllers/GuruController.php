<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function showGuru() {
        return view('pages.data_guru');
    }
}