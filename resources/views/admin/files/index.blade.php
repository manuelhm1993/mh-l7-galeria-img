@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Galería de imagenes MHenriquez</h1>

        <div class="row">
            @foreach ($files as $file)
                <div class="col-4">
                    <article class="card mb-3">
                        <img src="{{ asset($file->url) }}" class="card-img-top" alt="Imagen">
                        <div class="card-footer">
                            <a href="{{ route('admin.files.edit', $file) }}" class="btn btn-primary" role="button">
                                Editar
                            </a>

                            <form action="{{ route('admin.files.destroy', $file) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Eliminar</button>
                            </form>
                        </div>
                    </article>
                </div>
            @endforeach

            <div class="col-12">
                {{ $files->links() }}
            </div>
        </div>
    </div>
@endsection
