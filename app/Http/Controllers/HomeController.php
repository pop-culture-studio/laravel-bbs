<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function __invoke(Request $request)
    {
        $posts = Post::with([
            'comments' => fn ($comment) => $comment->latest(),
        ])->latest('updated_at')
          ->paginate();

        return view('home')->with(compact('posts'));
    }
}
