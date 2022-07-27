<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;

class PostController extends Controller
{

    public function index()
    {
        $perPage = 20;
        $posts = Post::paginate($perPage);   // andiamo nel database a prenderci paginate(); capire meglio
        return view('admin.posts.index', compact('posts'));   // admin perche stiamo sotto ad Admin, posts perche siamo sotto a PostController e index perchè stiamo nel metodo index
                                                              // e siccome gli sto passando una sola variabile utilizzo il compact
    }


    public function create()
    {
        // mi prendo le categories e le passo al create per stampare una select composta da queste categories
        // stessa cosa faccio per la collection $tags che verra passato al fieldset Tags in create.blade.php
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', [
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }


    public function store(Request $request)
    {
        // dump($request->all()); // dump: per vedere cosa mi viene passato nel back-end quando clicco save in create.blade.php; decommentare e analizzare
        // dobbiamo fare la validation e il salvataggio all interno di store()
        // Validation: lo facciamo direttamente sulla $request
        $request->validate([
            'title'     => 'required|string|max:100',
            'slug'      => 'required|string|max:100|unique:posts',
            'category_id'  => 'required|integer|exists:categories,id',
            'tags'      => 'nullable|array',
            'tags.*'    => 'integer|exists:tags,id',
            'image'     => 'required_without:content|nullable|url',
            'content'   => 'required_without:image|nullable|string|max:5000',
            'excerpt'   => 'nullable|string|max:200',
        ]);

        // dump($request->all());  // se la validation non passa torniamo nel form; se invece le validation passano ci stampera il dump; dopo aver inserito i campi, salvare e decommentare questo dump()
        $data = $request->all();
        // dump($data);

        // salvataggio
        $post = Post::create($data);
        $post->tags()->sync($data['tags']);

        // redirect
        return redirect()->route('admin.posts.show', ['post' => $post->id]);
    }


    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }


    public function edit(Post $post)
    {
        // return view ('admin.posts.edit'), compact('post')
    }


    public function update(Request $request, Post $post)
    {
        //
    }


    public function destroy(Post $post)
    {
        //
    }
}
