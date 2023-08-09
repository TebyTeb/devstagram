<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
  public function __construct()
  {
    // Método nativo de Laravel para proteger rutas sólo para el usuario autenticado
    $this->middleware('auth');
  }
  public function index()
  {
    return view('profile.index');
  }

  public function store(Request $request)
  {
    /** Modifica el username para pasarlo a lowercase,
     *  sustituir los espacios por guiones
     *  y eliminar los espacios antes y despues del texto (trim) */
    $request->request->add(['username' => Str::slug($request->username)]);

    $this->validate($request, [
      /** el campo "not_in" nos permite designar una lista de elementos a excluir de las posibilidades 
       * El añadido de users,username . auth()->user()->id permite el cambio si vuelvo a asignar mi mismo username
       */
      'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter,editar-perfil'],
      'email' => ['required', 'unique:users,email,' . auth()->user()->id, 'email', 'max:40'],
      // 'password' => ['confirmed', 'min:6'],
    ]);

    // Cambio de password:
    // Comprobar contraseña actual para cambiar la password
/*     if (
      $request->currPassword
      && !auth()->attempt($request->only('currPassword'))
    ) {
      return back()->with('mensaje', 'Contraseña actual incorrecta');
    }  */

    // Comprobamos si el usuario sube o actualiza su imagen
    if ($request->imagen) {
      // Recibimos la imagen desde el input del usuario
      $imagen = $request->file('imagen');
      // Asignamos un nombre único a la imagen para alojarla en servidor
      $nombreImagen = Str::uuid() . '.' . $imagen->extension();
      /** Intervention Image docs: https://image.intervention.io/v2 */
      // Le pasamos la imagen a Intervention Image para procesarla:
      $imagenServidor = Image::make($imagen);
      // Procesamos la imagen para hacerla cuadrada con Intervention Image:
      $imagenServidor->fit(1000, 1000);
      // Establecemos la ruta donde guardar la imagen:
      $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
      // Guardamos la imagen en el servidor:
      $imagenServidor->save($imagenPath);
    }

    // Guardar cambios
    /** Al guardar la imagen comprobamos lo siguiente:
     * si estamos subiendo una imagen, aplicamos su nombre.
     * si no subimos imagen, pero el usuario ya tiene, la mantenemos.
     * si no subimos imagen y el usuario no tiene, establecemos null */
    $usuario = User::find(auth()->user()->id);
    $usuario->username = $request->username;
    $usuario->email = $request->email;
    // $usuario->password = Hash::make($request->password);
    $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
    $usuario->save();

    // Redireccionar: Pasamos el nombre que acabamos de guardar en la BD por si modifica al de Auth()->user()
    return redirect()->route('posts.index', $usuario->username);
  }
}
