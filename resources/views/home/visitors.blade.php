<span class="font-bold">最近の訪問者</span>
@foreach(cache('visitors') as $visitor)
    <span class="ml-3">
        {{ $visitor }}
    </span>
@endforeach
