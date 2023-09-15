@extends('layouts.app-galery')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">

                <section class="card-columns">
                    @foreach ($files as $file)
                        <article class="card">
                            <img src="{{ asset($file->url) }}" class="card-img-top" alt="Imagen">
                            <div class="card-body">
                                <h4 class="card-title">Título de la Imagen</h4>
                                <p class="card-text">
                                    This is a longer card with supporting text below as a natural lead-in to
                                    additional content. This content is a little bit longer.
                                </p>
                            </div>
                        </article>
                    @endforeach
                </section>

                {{ $files->links() }}
            </div>
        </div>
    </div>
@endsection
