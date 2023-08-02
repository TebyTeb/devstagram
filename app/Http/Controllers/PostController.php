<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
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
    $posts = Post::where('user_id', $user->id)->paginate(12);

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
      'post' => $post
    ]);
  }
}
