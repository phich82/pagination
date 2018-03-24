<div class="posts">
    @foreach ($posts as $post)
        <article>
            <h2>{{ $post->title }}</h2>
            {{ $post->body }}
        </article>
    @endforeach
    {{ $posts->links() }}
</div>