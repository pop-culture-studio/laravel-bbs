<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyPostRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        return to_route('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePostRequest $request)
    {
        $request->merge([
            'password' => bcrypt($request->input('password')),
        ]);

        Post::create($request->only([
            'title',
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

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Post $post)
    {
        $post->load('comments');

        return view('post.show')->with(compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyPostRequest  $request
     * @param  Post  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DestroyPostRequest $request, Post $post)
    {
        $post->delete();

        return to_route('home');
    }
}
