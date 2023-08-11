<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
  /*
  |-----------------------------------------------------
  * Atributos 
  |-----------------------------------------------------
  ? Estan disponibles directamente para las vistas 
  ? de livewire sin necesidad de hacer nada mas
  */
  public $post;
  public $isLiked;
  public $likes;

  /* 
  |----------------------------------------------------
  * Función Mount
  |----------------------------------------------------
  ? Forma parte del Lifecycle de livewire y se ejecuta 
  ? automáticamente cuando se instancia el componente
  | Le podemos pasar parametros que reciba el componente
  | desde otra vista 
  */
  public function mount($post)
  {
    $this->isLiked = $post->checkLike(auth()->user());
    $this->likes = $post->likes->count();
  }
  public function like()
  {
    if ($this->post->checkLike(auth()->user())) {
      /** Del post seleccionamos el usuario,
       * mediante la relación con sus likes hacemos una búsqueda (where)
       * donde el like sea el id del post en donde estamos ($post)
       * y lo borramos (delete()) */
      $this->post->likes()->where('post_id', $this->post->id)->delete();
      $this->isLiked = false;
      $this->likes--;
    } else {
      /** Creamos un like usando la relación
       * del post con sus likes, donde el 'user_id'
       * sea el usuario actualmente autenticado ('yo') */
      $this->post->likes()->create([
        'user_id' => auth()->user()->id
      ]);
      $this->isLiked = true;
      $this->likes++;
    }
  }
  public function render()
  {
    return view('livewire.like-post');
  }
}
