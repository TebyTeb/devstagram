@extends('layouts.app')

@push('styles')
  <link
    type="text/css"
    href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css"
    rel="stylesheet"
  />
@endpush

@section('titulo')
  Crea una nueva publicación
@endsection

@section('contenido')
  <div class="md:flex md:items-center">
    <div class="px-10 md:w-1/2">
      <form
        class="dropzone flex h-96 flex-col items-center justify-center rounded border-2 border-dashed"
        id="dropzone"
        action="{{ route('imagenes.store') }}"
        method="POST"
        enctype="multipart/form-data"
      >
        @csrf
      </form>
    </div>
    <div class="mt-10 rounded-lg bg-white p-10 shadow-xl md:mt-0 md:w-1/2">
      <form
        action="{{ route('posts.store') }}"
        method="POST"
        novalidate
      >
        @csrf
        <div class="mb-5">
          <label
            class="mb-2 block font-bold uppercase text-gray-500"
            for="titulo"
          >
            Título
          </label>
          <input
            class="@error('titulo') border-red-500 @enderror w-full rounded-lg border p-3"
            id="titulo"
            name="titulo"
            type="text"
            value="{{ old('titulo') }}"
            placeholder="Título de la publicación"
          />
          @error('titulo')
            <p class="my-2 rounded-lg bg-red-500 p-2 text-center text-sm text-white">{{ $message }}</p>
          @enderror
        </div>
        <div class="mb-5">
          <label
            class="mb-2 block font-bold uppercase text-gray-500"
            for="descripcion"
          >
            Descripción
          </label>
          <textarea
            class="@error('descripcion') border-red-500 @enderror w-full rounded-lg border p-3"
            id="descripcion"
            name="descripcion"
            type="text"
            placeholder="Descripción de la publicación"
          >{{ old('descripcion') }}</textarea>
          @error('descripcion')
            <p class="my-2 rounded-lg bg-red-500 p-2 text-center text-sm text-white">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-5">
          <input
            name="imagen"
            type="hidden"
            value="{{old('imagen')}}"
          />
          @error('imagen')
            <p class="my-2 rounded-lg bg-red-500 p-2 text-center text-sm text-white">{{ $message }}</p>
          @enderror
        </div>

        <input
          class="w-full cursor-pointer rounded-lg bg-sky-600 p-3 font-bold uppercase text-white transition-colors hover:bg-sky-600"
          type="submit"
          value="crear publicación"
        >
      </form>
    </div>
  </div>
@endsection
