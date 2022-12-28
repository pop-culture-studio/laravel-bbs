<h3 class="text-lg font-bold">コメント</h3>

<ul class="ml-3 space-y-1">
    @forelse($post->comments as $comment)
        <li>
            <span class="font-bold">
                @if(filled($comment->icon) && file_exists(public_path('/icon/'.config('icon.'.$comment->icon.'.file'))))
                    <img src="{{ asset('/icon/'.config('icon.'.$comment->icon.'.file')) }}"
                         class="w-8 rounded-full inline"
                         alt="{{ config('icon.'.$comment->icon.'.name') }}"
                         title="{{ config('icon.'.$comment->icon.'.name') }}"
                    >
                @endif
                {{ $comment->name ?? 'NO NAME' }}</span>
            <span class="mx-1">『{{ $comment->content }}』</span>
            <time class="text-gray-400" datetime="{{ $comment->created_at }}">{{ $comment->created_at }}</time>
        </li>
    @empty
        <span class="text-gray-300">コメントはありません。</span>
    @endforelse
</ul>

<details class="mt-3">
    <summary>コメントを書く</summary>
    <div class="p-6 bg-gray-100">
        <form method="POST" action="{{ route('post.comment.store', $post) }}">
            @csrf

            <!-- Content -->
            <div class="mt-4">
                <x-input-label for="content" :value="__('コメント')"/>
                <x-text-input id="content"
                              class="block mt-1 w-full"
                              type="text" name="content" :value="old('content')" required/>
                <x-input-error :messages="$errors->get('content')" class="mt-2"/>
            </div>

            <!-- Icon -->
            <div class="mt-4">
                <x-input-label for="icon" :value="__('アイコン')"/>
                <select id="icon"
                        class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        name="icon">
                    <option value="" @selected(blank(request()->cookie('icon')))>なし</option>
                    @foreach(config('icon') as $key => $icon)
                        <option
                            value="{{ $key }}" @selected(request()->cookie('icon') === $key)>{{ $icon['name'] }}</option>
                    @endforeach
                </select>

                <x-input-error :messages="$errors->get('icon')" class="mt-2"/>
            </div>

            <!-- Name -->
            <div class="mt-4">
                <x-input-label for="name" :value="__('名前')"/>
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                              :value="old('name', request()->cookie('name'))"/>
                <x-input-error :messages="$errors->get('name')" class="mt-2"/>
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('メール（公開されません）')"/>
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                              :value="old('email', request()->cookie('email'))"/>
                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('削除用パスワード')"/>

                <x-text-input id="password" class="block mt-1 w-full"
                              type="password"
                              name="password"
                              required
                              autocomplete="password"/>

                <x-input-error :messages="$errors->get('password')" class="mt-2"/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-4">
                    {{ __('送信') }}
                </x-primary-button>
            </div>

        </form>
    </div>
</details>
