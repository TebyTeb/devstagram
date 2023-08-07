@extends('layouts.app')

@section('titulo')
  Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
  <div class="md:flex md:justify-center">
    <div class="bg-white p-6 shadow md:w-1/2">
      <form class="mt-10 md:mt-0"
        action="">
        @csrf
        <div class="mb-5">
          <label class="mb-2 block font-bold uppercase text-gray-500"
            for="username">
            Nombre de Usuario
          </label>
          <input class="@error('username') border-red-500 @enderror w-full rounded-lg border p-3"
            id="username"
            name="username"
            type="text"
            value="{{ auth()->user()->username }}"
            placeholder="Tu Nombre de Usuario" />
          @error('username')
            <p class="my-2 rounded-lg bg-red-500 p-2 text-center text-sm text-white">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-5">
          <label class="mb-2 block font-bold uppercase text-gray-500"
            for="imagen">
            Imagen Perfil
          </label>
          <input class="w-full rounded-lg border p-3"
            id="imagen"
            name="imagen"
            type="file"
            value=""
            accept=".jpg, .jpeg, .png" />
        </div>

        <input
          class="w-full cursor-pointer rounded-lg bg-sky-600 p-3 font-bold uppercase text-white transition-colors hover:bg-sky-700"
          type="submit"
          value="Guardar Cambios" />
      </form>
    </div>
  </div>
@endsection
