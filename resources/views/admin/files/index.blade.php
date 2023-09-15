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

                            <form
                                action="{{ route('admin.files.destroy', $file) }}"
                                method="POST"
                                class="d-inline"
                                id="form-delete-{{ $file->id }}"
                            >
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

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('feedback'))
        <script>
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            );
        </script>
    @endif

    <script>
        document.addEventListener('submit', (e) => {
            e.preventDefault();

            const fuenteEvento = e.target;

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this! " + fuenteEvento.id,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
            })
            .then((result) => {
                if (result.isConfirmed) {
                    fuenteEvento.submit();
                }
            });
        });
    </script>
@endsection
