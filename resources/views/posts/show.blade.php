@extends('layouts.app')

@section('titulo')
  {{ $post->titulo }}
@endsection

@section('contenido')
  <div class="container mx-auto md:flex">
    <div class="md:w-1/2">
      <img src="{{ asset('uploads') . '/' . $post->imagen }}"
        alt="Imagen del post {{ $post->titulo }}">
      <div class="flex items-center gap-3 p-3">
        @auth
          @if ($post->checkLike(auth()->user()))
            <form action="{{ route('posts.likes.destroy', $post) }}"
              method="POST">
              @method('DELETE')
              @csrf
              <div class="my-4">
                <button type="submit">
                  <svg class="h-6 w-6"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="red"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                  </svg>
                </button>
              </div>
            </form>
          @else
            <form action="{{ route('posts.likes.store', $post) }}"
              method="POST">
              @csrf
              <div class="my-4">
                <button type="submit">
                  <svg class="h-6 w-6"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                  </svg>
                </button>
              </div>
            </form>
          @endif
        @endauth

        <p class="font-bold">{{ $post->likes->count() }} <span class="font-normal">likes</span></p>
      </div>
      <div>
        <p class="font-bold">{{ $post->user->username }}</p>
        <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
        <p class="mt-5">{{ $post->descripcion }}</p>
      </div>

      @auth
        @if ($post->user_id === auth()->user()->id)
          <form action="{{ route('posts.destroy', $post) }}"
            method="POST">
            @method('DELETE')
            @csrf
            <input class="mt-4 cursor-pointer rounded bg-red-500 p-2 font-bold text-white hover:bg-red-600"
              type="submit"
              value="eliminar publicación">
          </form>
        @endif
      @endauth

    </div>
    <div class="p-5 md:w-1/2">

      <div class="mb-5 bg-white p-5 shadow">

        @auth
          <p class="mb-4 text-center text-xl font-bold">Agrega un nuevo comentario</p>

          @if (session('mensaje'))
            <div class="mb-6 rounded bg-green-500 p-2 text-center font-bold uppercase text-white">
              {{ session('mensaje') }}
            </div>
          @endif

          <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}"
            method="POST">
            @csrf

            <div class="mb-5">
              <label class="mb-2 block font-bold uppercase text-gray-500"
                for="comentario">
                Comentario
              </label>
              <textarea class="@error('comentario') border-red-500 @enderror w-full rounded-lg border p-3"
                id="comentario"
                name="comentario"
                type="text"
                placeholder="Escribe un comentario"></textarea>
              @error('comentario')
                <p class="my-2 rounded-lg bg-red-500 p-2 text-center text-sm text-white">{{ $message }}</p>
              @enderror
            </div>

            <input
              class="w-full cursor-pointer rounded-lg bg-sky-600 p-3 font-bold uppercase text-white transition-colors hover:bg-sky-600"
              type="submit"
              value="comentar">
          </form>
        @endauth

        <div class="mb-5 mt-10 max-h-96 overflow-y-auto bg-white shadow">
          @if ($post->comentarios->count())
            @foreach ($post->comentarios as $comentario)
              <div class="border-b border-gray-500 p-5">
                <a class="font-bold"
                  href="{{ route('posts.index', ['user' => $comentario->user]) }}">{{ $comentario->user->username }}</a>

                <p>{{ $comentario->comentario }}</p>

                <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>

              </div>
            @endforeach
          @else
            <p class="p-10 text-center">No hay comentarios aún</p>
          @endif
        </div>

      </div>
    </div>
  </div>
@endsection
