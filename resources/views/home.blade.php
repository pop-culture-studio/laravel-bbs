<x-app-layout>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('post.store') }}">
                        @csrf

                        <!-- Title -->
                        <div class="mt-4">
                            <x-input-label for="title" :value="__('タイトル')"/>
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                                          :value="old('title')" autofocus/>
                            <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                        </div>

                        <!-- Content -->
                        <div class="mt-4">
                            <x-input-label for="content" :value="__('メッセージ')"/>
                            <textarea id="content"
                                      class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                      type="text" name="content" required>{{ old('content') }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2"/>
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
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
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
                    </div>
                </div>
            @empty
                投稿はまだありません。
            @endforelse

            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
