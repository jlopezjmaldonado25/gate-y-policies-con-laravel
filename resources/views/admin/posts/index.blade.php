@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>Posts</h1>

            @can('create', App\Post::class)
                <p><a href="#" class="btn btn-primary">Crear Post</a></p>
            @endcan

            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->author->name }}</td>
                        <td>
                            @can('update',$post)
                                <a href="{{ route('posts.edit',$post) }}" class="btn btn-default">Editar</a>
                            @elsecan('report',$post)
                                <a href="#" class="btn btn-default">Reportar Problema</a>
                            @endcan

                            @can('delete',$post)
                                <a href="#" class="btn btn-default">Elimnar</a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
              </table>
              {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
