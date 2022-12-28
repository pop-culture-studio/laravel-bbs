<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-lg font-bold">本当に削除しますか？コメントも削除されます。</h2>
                    <form method="post" action="{{ route('post.destroy', $post) }}" class="p-6">
                        @csrf
                        @method('delete')

                        <h2 class="text-lg font-medium text-gray-900">
                            {{ $post->title ?? 'NO TITLE' }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {!! nl2br(e($post->content)) !!}
                        </p>

                        <div class="mt-6">
                            <x-input-label for="password" value="削除するには投稿時のパスワードを入力してください"/>
                            @can('admin')
                                <div class="text-red-600">管理者はパスワード不要</div>
                            @endcan

                            <x-text-input
                                id="password"
                                name="password"
                                type="password"
                                class="mt-1 block w-full"
                                placeholder="Password"
                            />

                            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">キャンセル</a>

                            <x-danger-button class="ml-3">
                                削除
                            </x-danger-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
