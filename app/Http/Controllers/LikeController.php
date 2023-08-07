<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
  public function store(Request $request, Post $post)
  {
    $post->likes()->create([
      'user_id' => $request->user()->id
    ]);

    return back();
  }

  public function destroy(Request $request, Post $post)
  {
    /** De la request seleccionamos el usuario,
     * mediante la relación con sus likes hacemos una búsqueda (where)
     * donde el like sea el id del post en donde estamos ($post)
     * y lo borramos (delete()) */
    $request->user()->likes()->where('post_id', $post->id)->delete();
    
    return back();
  }
}
