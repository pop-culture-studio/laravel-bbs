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

    <!-- Icon -->
    <div class="mt-4">
        <x-input-label for="icon" :value="__('アイコン')"/>
        <select id="icon"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                name="icon">
            <option value="" @selected(blank(request()->cookie('icon')))>なし</option>
            @foreach(config('icon') as $key => $icon)
                <option value="{{ $key }}" @selected(request()->cookie('icon') === $key)>{{ $icon['name'] }}</option>
            @endforeach
        </select>

        <div class="my-3 flex flex-row flex-wrap space-x-5">
            @foreach(config('icon') as $key => $icon)
                <span><img src="{{ asset('/icon/'.$icon['file']) }}" class="w-8 rounded-full inline" alt="{{ $icon['name'] }}" title="{{ $icon['name'] }}">
                    <span class="font-bold">{{ $icon['name'] }}</span>
                </span>
            @endforeach
        </div>

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
