@forelse($posts as $post)
    <div class="flex flex-row">
        <div class="p-6 my-3 w-1/4">
            <div class="text-lg font-bold">{{ $post->name ?? 'NO NAME' }}</div>

            <time class="mt-6" datetime="{{ $post->created_at }}">{{ $post->created_at }}</time>
        </div>
        <div class="grow my-3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-lg text-gray-900">
                <h2 class="font-bold inline">{{ $post->title ?? 'NO TITLE' }}</h2><span
                    class="text-gray-300 font-medium ml-3">#{{ $post->id }}</span>
                <p class="py-2">
                    {!! nl2br(e($post->content)) !!}
                </p>
            </div>

            <div class="p-6 border-t">
                @include('home.comment')
            </div>
        </div>
    </div>
@empty
    投稿はまだありません。
@endforelse

{{ $posts->links() }}
