@extends('layouts.app')

@section('titulo')
  {{ $post->titulo }}
@endsection

@section('contenido')
  <div class="container mx-auto md:flex">
    <div class="md:w-1/2">
      <img
        src="{{ asset('uploads') . '/' . $post->imagen }}"
        alt="Imagen del post {{ $post->titulo }}"
      >
      <div class="p-3">0 likes</div>
      <div>
        <p class="font-bold">{{ $post->user->username }}</p>
        <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
        <p class="mt-5">{{ $post->descripcion }}</p>
      </div>
    </div>
    <div class="p-5 md:w-1/2">

      <div class="mb-5 bg-white p-5 shadow">

        @auth
          <p class="mb-4 text-center text-xl font-bold">Agrega un nuevo comentario</p>
          <form
            action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}"
            method="POST"
          >

            @if (session('mensaje'))
              <div class="mb-6 rounded bg-green-500 p-2 text-center font-bold uppercase text-white">
                {{ session('mensaje') }}
              </div>
            @endif

            @csrf
            <div class="mb-5">
              <label
                class="mb-2 block font-bold uppercase text-gray-500"
                for="comentario"
              >
                Comentario
              </label>
              <textarea
                class="@error('comentario') border-red-500 @enderror w-full rounded-lg border p-3"
                id="comentario"
                name="comentario"
                type="text"
                placeholder="Escribe un comentario"
              ></textarea>
              @error('comentario')
                <p class="my-2 rounded-lg bg-red-500 p-2 text-center text-sm text-white">{{ $message }}</p>
              @enderror
            </div>

            <input
              class="w-full cursor-pointer rounded-lg bg-sky-600 p-3 font-bold uppercase text-white transition-colors hover:bg-sky-600"
              type="submit"
              value="comentar"
            >
          </form>
        </div>
      @endauth

    </div>
  </div>
@endsection
