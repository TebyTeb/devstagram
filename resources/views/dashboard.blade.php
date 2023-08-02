@extends('layouts.app')

@section('titulo')
  Perfil: {{ $user->username }}
@endsection

@section('contenido')
  <div class="flex justify-center">
    <div class="flex w-full flex-col items-center md:w-8/12 md:flex-row lg:w-6/12">
      <div class="w-8/12 px-5 lg:w-6/12">
        <img
          src="{{ asset('img/usuario.svg') }}"
          alt="imagen usuario"
        >
      </div>
      <div class="flex flex-col items-center px-5 py-10 md:w-8/12 md:items-start md:justify-center md:py-10 lg:w-6/12">
        <p class="mb-5 text-2xl text-gray-700">{{ $user->username }}</p>
        <p class="mb-3 text-sm font-bold text-gray-800">
          0
          <span class="font-normal">Seguidores</span>
        </p>
        <p class="mb-3 text-sm font-bold text-gray-800">
          0
          <span class="font-normal">Siguiendo</span>
        </p>
        <p class="mb-3 text-sm font-bold text-gray-800">
          0
          <span class="font-normal">Posts</span>
        </p>
      </div>
    </div>
  </div>

  <section class="container mx-auto mt-10">
    <h2 class="my-10 text-center text-4xl font-black">Publicaciones</h2>

    @if ($posts->count())
      <div class="mx-4 grid gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @foreach ($posts as $post)
          <a href="{{ route('posts.show', ['post' => $post, 'user' => $user]) }}">
            <img
              src="{{ asset('uploads') . '/' . $post->imagen }}"
              alt="Imagen del post {{ $post->titulo }}"
            >
          </a>
        @endforeach
      </div>
      <div class="my-10">
        {{ $posts->links('pagination::tailwind') }}
      </div>
    @else
      <p class="text-center text-sm font-bold uppercase text-gray-600">Aún no hay posts</p>
    @endif

  </section>
@endsection
