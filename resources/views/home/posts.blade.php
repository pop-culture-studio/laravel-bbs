@forelse($posts as $post)
    @include('post.post')
@empty
    投稿はまだありません。
@endforelse

{{ $posts->links() }}
