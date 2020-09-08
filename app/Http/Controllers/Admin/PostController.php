<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{

    public function index(){

        $posts = Post::query()
            ->with('author')
            ->unless(auth()->user()->can('view-all', Post::class), function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->paginate();


        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $this->authorize('create', Post::class);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $request->user()->posts()->create([
            //'user_id' => $request->user()->id,
            'title'   => $request->title,
        ]);

        return new Response('Post created', 201);
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return 'Editar post';
    }

    public function update(Post $post, UpdatePostRequest $request) {

        $this->authorize('update', $post);

        /*  if(auth()->guest()){
             abort('401');
         }

         if(auth()->user()->cant('update', $post)){
             abort('403');
         } */

        /*  if(Gate::denies('update', $post)){
             abort('403');
         } */

         $post->update([
             'title' => $request->title
         ]);

         return 'Post updated!';
     }

     public function delete(Post $post){

        $this->authorize('delete', $post);

        $post->delete();

        return redirect('admin/posts');
     }
}
