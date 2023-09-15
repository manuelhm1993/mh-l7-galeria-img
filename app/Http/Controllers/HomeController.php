<?php

namespace App\Http\Controllers;

use App\Admin\File;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Devolver todas las imágenes a la vista welcome
    public function index()
    {
        $files = File::paginate(15);

        return view('welcome', compact('files'));
    }
}
