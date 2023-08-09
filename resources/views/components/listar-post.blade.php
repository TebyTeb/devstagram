<div>
  @if ($posts->count())
    <div class="mx-4 grid gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
      @foreach ($posts as $post)
        <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
          <img src="{{ asset('uploads') . '/' . $post->imagen }}"
            alt="Imagen del post {{ $post->titulo }}">
        </a>
      @endforeach
    </div>
    <div class="my-10">
      {{ $posts->links('pagination::tailwind') }}
    </div>
  @else
    <p class="text-center text-sm font-bold uppercase text-gray-600">Aún no hay posts</p>
  @endif
</div>
