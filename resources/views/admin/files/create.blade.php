@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
@endsection

@section('content')
    <div class="container">
        <section class="row">
            <div class="col">
                <h1>Subir imagenes</h1>

                {{-- <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.files.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <input type="file" name="file" id="file" accept="image/*">

                                @error('file')
                                    <small class="text-danger d-block mt-2">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Subir imagen
                            </button>
                        </form>
                    </div>
                </div> --}}

                {{-- Formulario dropzone --}}
                <form
                    action="{{ route('admin.files.store') }}"
                    class="dropzone"
                    id="form-image"
                >
                </form>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

    <script>
        Dropzone.options.formImage = { // Id del formulario en camelCase
            headers: { // Encabezados, en este caso el csrf
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            dictDefaultMessage: "Arrastre una imagen al recuadro para subirlo", // Mensaje por defecto
            acceptedFiles: "image/*", // Tipo de archivos aceptados
            maxFiles: 30,
            paramName: 'file', // Nombre del input file
        };
    </script>
@endsection
