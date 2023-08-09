<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

  public function __construct()
  {
    // Protege los métodos de la clase de usuarios no autenticados
    // Con el except liberamos ciertos métodos para ser accesibles sin autenticacion
    $this->middleware('auth')->except(['show', 'index']);
  }

  public function index(User $user)
  {
    /**
     * Usando este método, podemos acceder a los post del 
     * usuario en blade usando $user->posts ya que hemos vinculado
     * los posts al usuario en el modelo de user. Sin embargo, 
     * esta opción no nos permite paginar resultados, por eso usamos 
     * la opción descomentada, que hace uso de Eloquent
     */
    // return view('dashboard', [
    //   'user' => $user
    // ]);

    // Este método es usando Eloquent (?)
    $posts = Post::where('user_id', $user->id)->latest()->paginate(12);

    return view('dashboard', [
      'user' => $user,
      'posts' => $posts
    ]);
  }

  public function create()
  {
    return view('posts.create');
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'titulo' => ['required', 'max:255'],
      'descripcion' => ['required'],
      'imagen' => ['required']
    ]);

    // Post::create([
    //   'titulo' => $request->titulo,
    //   'descripcion' => $request->descripcion,
    //   'imagen' => $request->imagen,
    //   'user_id' => auth()->user()->id
    // ]);

    // Forma alternativa de guardar a la BD
    // $post = new Post;
    // $post->titulo = $request->titulo;
    // $post->descripcion = $request->descripcion;
    // $post->imagen = $request->imagen;
    // $post->user_id = auth()->user()->id;
    // $post->save();

    // Forma de guardar a la BD con relación al usuario directamente
    $request->user()->posts()->create([
      'titulo' => $request->titulo,
      'descripcion' => $request->descripcion,
      'imagen' => $request->imagen,
      'user_id' => auth()->user()->id
    ]);

    return redirect()->route('posts.index', auth()->user()->username);
  }

  public function show(User $user, Post $post)
  {
    return view('posts.show', [
      'user' =>$user,
      'post' => $post
    ]);
  }

  public function destroy(Post $post)
  {
    // El 'authorize' se asegura de que el usuario que está borrando el post es el dueño del mismos
    $this->authorize('delete', $post);
    $post->delete();

    // Eliminar la imagen
    $imagen_path = public_path('uploads/'.$post->imagen);
    if (File::exists($imagen_path)) {
      unlink($imagen_path);
    }

    return redirect()->route('posts.index', auth()->user()->username);
  }
}
