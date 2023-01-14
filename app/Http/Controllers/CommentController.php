<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Post;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCommentRequest  $request
     * @param  Post  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCommentRequest $request, Post $post)
    {
        $request->merge([
            'password' => bcrypt($request->input('password')),
        ]);

        $post->comments()->create($request->only([
            'content',
            'name',
            'email',
            'icon',
            'password',
        ]));

        $cookie_days = 60 * 24 * 30;

        cookie()->queue('name', $request->input('name'), $cookie_days);
        cookie()->queue('email', $request->input('email'), $cookie_days);
        cookie()->queue('icon', $request->input('icon'), $cookie_days);

        return to_route('post.show', $post);
    }
}
