<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostDeleteConfirmController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Request  $request
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Post $post)
    {
        return view('post.post-delete-confirm')->with(compact('post'));
    }
}
