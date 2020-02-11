<?php

namespace App\Http\Controllers\Author;

use App\Blog;
use App\User;
use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('author.index')->with('blogs', $user->blogs);
        // return view('author.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        $blog = new Blog;
        $blog->title = $request->input('title');
        $blog->body = $request->input('body');
        $blog->user_id = auth()->user()->id;
        if ($blog->save()) {
            $request->session()->flash('success', $blog->title . ' posted!');
        }else {
            $request->session()->flash('error', 'There was an error in posting', $blog->title . '!');
        }
        return redirect()->route('author.blogs.index');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        if (Gate::denies('read-blogs')) {
            return redirect(route('admin.users.index'));
        }
        return view('author.show')->with('blog', $blog);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
       if (Gate::denies('edit-blogs')) {
           return redirect(route('home'));
       }

       return view('author.edit')->with('blog', $blog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $blog ->title = $request->title;
        $blog ->body = $request->body;
        if ($blog->save()) {
            $request->session()->flash('success', $blog->title . ' has been updated!');
        }else {
            $request->session()->flash('error', 'There was an error updating', $blog->title . '!');
        }

        return redirect()->route('author.blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        if (Gate::denies('delete-blogs')) {
            return redirect(route('home'));
        }

        $blog->delete();
        return redirect()->route('author.blogs.index');
    }
}
