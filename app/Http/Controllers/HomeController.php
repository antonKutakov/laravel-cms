<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Category;

class HomeController extends Controller
{
    public function index(){
        // dd(Auth::check());
        $posts = Post::where('status', Post::IS_PUBLIC)->paginate(2);
        return view('pages.index', ['posts' => $posts]);
    }

    public function show($slug){
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('pages.show', compact('post'));
    }

    public function tag($slug){
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->paginate(2);
        return view('pages.list', compact('posts'));
    }

    public function category($slug){
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->paginate(2);
        return view('pages.list', compact('posts'));
    }
}
