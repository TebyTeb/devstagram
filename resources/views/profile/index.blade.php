@extends('layouts.app')

@section('titulo')
  Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
  <div class="md:flex md:justify-center">
    <div class="bg-white p-6 shadow md:w-1/2">
      <form class="mt-10 md:mt-0"
        action="{{ route('profile.store') }}"
        method="POST"
        enctype="multipart/form-data">
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
            for="email">
            Email
          </label>
          <input class="@error('email') border-red-500 @enderror w-full rounded-lg border p-3"
            id="email"
            name="email"
            type="email"
            value="{{auth()->user()->email }}"
            placeholder="Tu Email de registro" />
          @error('email')
            <p class="my-2 rounded-lg bg-red-500 p-2 text-center text-sm text-white">{{ $message }}</p>
          @enderror
        </div>

        {{-- <div class="mb-5">
          <label class="mb-2 block font-bold uppercase text-gray-500"
            for="currPassword">
            Password Actual
          </label>
          <input class="@error('password') border-red-500 @enderror w-full rounded-lg border p-3"
            id="currPassword"
            name="currPassword"
            type="password"
            placeholder="Tu password actual" />
          @if (session('mensaje'))
            <p class="my-2 rounded-lg bg-red-500 p-2 text-center text-sm text-white">{{ session('mensaje') }}</p>
          @endif
        </div>

        <div class="mb-5">
          <label class="mb-2 block font-bold uppercase text-gray-500"
            for="password">
            Nueva Password
          </label>
          <input class="@error('password') border-red-500 @enderror w-full rounded-lg border p-3"
            id="password"
            name="password"
            type="password"
            placeholder="Tu nueva password" />
          @error('password')
            <p class="my-2 rounded-lg bg-red-500 p-2 text-center text-sm text-white">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-5">
          <label class="mb-2 block font-bold uppercase text-gray-500"
            for="password_confirmation">
            Repetir Password
          </label>
          <input class="w-full rounded-lg border p-3"
            id="password_confirmation"
            name="password_confirmation"
            type="password"
            placeholder="Repite tu nueva password" />
        </div> --}}

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
