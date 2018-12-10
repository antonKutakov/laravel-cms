<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    public function index(){
        $tags = Tag::all();
        return view('admin.tags.index', ['tags' => $tags]);
    }

    public function create(){
        return view('admin.tags.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required'
        ]);
        Tag::create($request->all());
        return redirect()->route('tags.index');
    }

    public function edit($id){
        $tag = Tag::find($id);
        return view('admin.tags.edit', ['tag' => $tag]);
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'title' => 'required'
        ]);
        $tag = Tag::find($id);
        $tag->update($request->all());
        return redirect()->route('tags.index');
    }

    public function destroy($id){
        Tag::find($id)->delete();
        return redirect()->route('tags.index');
    }
}
