<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\File;
use Illuminate\Support\Facades\Storage;

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
        $validated = $request->validate([
            'file' => 'required|image|max:2048'
        ]);

        // return $request->file('file')->store('img', 'public'); // retorna: img/name.extension
        // return $request->file('file')->store('public/img'); // retorna: public/img/name.extension

        // Almacenar el archivo en storage de cualquier forma, yo prefiero esta
        $url = $request->file('file')->store('img', 'public');

        // Formatear el path del archivo de public/img/... a storage/img... para poder acceder
        $url = Storage::url($url);

        // Guardar la url en BD
        $file = File::create([
            'url' => $url
        ]);

        // Redirigir al usuario a index con un mensaje flash de feedback
        return redirect()->route('admin.files.index')->with('feedback', 'created');
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
