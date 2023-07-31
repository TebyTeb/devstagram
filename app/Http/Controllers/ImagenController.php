<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
  public function store(Request $request)
  {
    // Recibimos la imagen desde el input del usuario
    $imagen = $request->file('file');
    // Asignamos un nombre único a la imagen para alojarla en servidor
    $nombreImagen = Str::uuid().'.'.$imagen->extension();
    /** Intervention Image docs: https://image.intervention.io/v2 */
    // Le pasamos la imagen a Intervention Image para procesarla:
    $imagenServidor = Image::make($imagen);
    // Procesamos la imagen para hacerla cuadrada con Intervention Image:
    $imagenServidor->fit(1000,1000);
    // Establecemos la ruta donde guardar la imagen:
    $imagenPath = public_path('uploads').'/'.$nombreImagen;
    // Guardamos la imagen en el servidor:
    $imagenServidor->save($imagenPath);

    return response()->json(['imagen' => $nombreImagen]);
  }
}
