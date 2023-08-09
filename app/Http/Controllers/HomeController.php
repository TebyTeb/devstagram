<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function __invoke()
  {
    // Obtenemos los ids de las personas a las que seguimos
    $ids = auth()->user()->followings->pluck('id')->toArray();
    // Obtenemos los posts de esas personas, ordenadas por fecha
    $posts = Post::whereIn('user_id', $ids)->latest()->paginate(12);

    return view('home', [
      'posts' => $posts
    ]);
  }
}
