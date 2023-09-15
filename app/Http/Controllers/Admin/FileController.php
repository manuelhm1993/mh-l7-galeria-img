<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Intervention\Image\Facades\Image;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.files.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.files.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        // return $request->file('file')->store('img', 'public'); // retorna: img/name.extension
        // return $request->file('file')->store('public/img'); // retorna: public/img/name.extension

        // Almacenar el archivo en storage de cualquier forma, yo prefiero esta
        $url = $request->file('file')->store('img', 'public');

        // Formatear el path del archivo de public/img/... a storage/img... para poder acceder
        $url = Storage::url($url);

         */

        $validated = $request->validate([
            'file' => 'required|image'
        ]);

        $file = $request->file('file');
        $nombre = Str::random(10) . $file->getClientOriginalName();
        $path = storage_path() . '\app\public\img\\' . $nombre;

        $img = Image::make($file);

        // Optimizar el peso de la imagen antes de guardarla
        $img->resize(1200, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path);

        // Guardar la url en BD
        $file = File::create([
            'user_id' => auth()->user()->id,
            'url'     => '/storage/img/' . $nombre
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  File $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        return view('admin.files.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  File $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        return view('admin.files.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  File $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  File $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        //
    }
}
