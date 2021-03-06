<?php
namespace App\Http\Controllers;

use App\Post;
use Facades\App\Repository\Posts;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('post.index',['posts' => $posts ]);
    }

    public function show(Post $slug)
    {
        return view('post.single',['post' => $slug ]);
    }
    public function getlike(Request $request)
    {
        $post = Post::find($request->post);
        return response()->json([
            'post'=>$post,
        ]);
    }
    public function like(Request $request)
    {
        $post = Post::find($request->post);
        $value = ($post->like == 1)? 0: 1;
        $post->like = $value;
        $post->save();
        return response()->json([
            'message'=>'Thanks',
            'like' =>  $value
        ]);
    }
}
