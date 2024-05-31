<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag; 

class TagController extends Controller
{
    public function index(){
        $tags = Tag::all();
        return view('tags.index', [
            'tags' => $tags
        ]);
    }

    public function create(){
        $tags = Tag::all(); // Fetch all brands for select dropdown
        return view('tags.create', compact('tags'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string',
        ]);

        Tag::create($request->all());

        return redirect('tags')->with('status', 'Etiqueta creada exitósamente!');
    }

    public function edit($id){
        $tag = Tag::findOrFail($id);
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag){
        $request->validate([
            'name' => 'required|string',
        ]);

        $tag->update($request->all());

        return redirect('tags')->with('status', 'Etiqueta actualizada exitósamente!');
    }

    public function destroy($tagId){
        $tag = Tag::findOrFail($tagId);
        $tag->delete();
        return redirect('tags')->with('status', 'Etiqueta eliminada exitósamente!');
    }
}
