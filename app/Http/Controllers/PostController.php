<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**php artisan
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('post');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPosts()
    {
        $posts = Post::latest('id')->get();

        return response()->json($posts);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;

        $post = new Post();
        $post->fill([
            'user_id' => $user_id,
            'post' => $request->post,
            'title' => $request->title,
        ]);
        $post->save();

        return response()->json(true);
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $posts = Post::latest('id')->get();

        return view('post');
    }

    public function show($id)
    {
        return redirect()->route('post.index');
    }

    public function update(Request $request, $id)
    {
        $post = Post::updateOrCreate([
            'id' => $id
        ], [
            'post' => $request->post,
            'title' => $request->title
        ]);


        return response()->json(true);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json(true);

    }
}
