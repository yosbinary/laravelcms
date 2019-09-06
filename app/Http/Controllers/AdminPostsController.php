<?php

namespace App\Http\Controllers;

use App\Post;
use App\Photo;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\PostCreateRequest;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        $categories = Category::all();
        $user = Auth::user();

        //dd($categories);
        return view('admin.posts.create',compact('categories','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        //
        $user = Auth::user();
        $post = new Post;
        //populate the post request
        $post->title = $request->title;
        $post->body = $request->body;
        $post->category_id = $request->category_id;

       // $input = $request->all();

        if($file = $request->file('file')){
            $name = time().$file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file' => $name]);
            $post->photo_id = $photo->id;
        }

        $user->posts()->save($post);
        
        
        return redirect(route('admin.posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = Auth::user();
        $categories = Category::all(); 
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post','categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostCreateRequest $request, $id)
    {
        //
        //$post = Post::findOrFail($id);
        $input = $request->all();
        
        if($file = $request->file('file')){
            $name = time().$file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file' => $name]);
            $input['photo_id'] = $photo->id;
        }

        //$post->update($input);
        Auth::user()->posts()->whereId($id)->first()->update($input);
        Session::flash('alert_message','Post Updated');
        return redirect(route('admin.posts.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //$post = Post::findOrFail($id);
        Auth::user()->posts()->whereId($id)->first()->delete();
        Session::flash('alert_message','Post deleted');
        return redirect(route('admin.posts.index'));
        
    }

    //public
    public function post($id){
        $post = Post::findOrFail($id);
        $user = Auth::user();
        $comments = $post->comments()->whereIsActive(1)->get();
        
        return view('post',compact('post', 'user', 'comments'));
    }
}
