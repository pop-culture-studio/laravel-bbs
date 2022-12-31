<div class="flex flex-col sm:flex-row">
    <div class="px-6 sm:p-6 my-3 sm:w-1/4">
        @if(filled($post->icon) && file_exists(public_path('/icon/'.config('icon.'.$post->icon.'.file'))))
            <img src="{{ asset('/icon/'.config('icon.'.$post->icon.'.file')) }}"
                 class="w-48 rounded-full"
                 alt="{{ config('icon.'.$post->icon.'.name') }}"
                 title="{{ config('icon.'.$post->icon.'.name') }}"
            >
        @endif

        <div class="text-lg font-bold">{{ $post->name ?? 'NO NAME' }}</div>

        <time class="mt-6" datetime="{{ $post->created_at }}">{{ $post->created_at }}</time>
    </div>
    <div class="grow sm:my-3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-lg text-gray-900">
            <div class="flex space-x-3">
                <h2 class="font-bold">
                    <a href="{{ route('post.show', $post) }}" class="hover:underline">
                    {{ $post->title ?? 'NO TITLE' }}
                    </a>
                </h2>

                <div class="text-gray-400 font-medium">
                    #{{ $post->id }}
                </div>

                <div>
                    @include('post.post-menu')
                </div>
            </div>
            <p class="py-2">
                {!! nl2br(e($post->content)) !!}
            </p>
        </div>

        <div class="p-6 border-t">
            @include('post.comment')
        </div>
    </div>
</div>
