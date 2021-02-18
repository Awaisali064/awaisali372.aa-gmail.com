<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post;

class postcontroller extends Controller
{
    public function newpost()
    {
        //  echo 'ok in new post';
        return view('newpost');
    }
    public function createpost(Request $request)
    {
        echo $title = $request->title;
        echo $body = $request->body;
        $input = $request->all();
        $post = post::create($input);
        if ($post) {
            return redirect('home')->with('success', 'Post posted');
        }
    }
    public function edit()
    {
        return view('editpost');
    }
    public function update(Request $request)
    {

        echo 'update post<br>';
        echo $title = $request->title;
        echo $body = $request->body;
        /* $input = $request->all();
        $post = post::create($input);
        if ($post) {
            return redirect('home')->with('error', 'Post posted');
        }*/
        return redirect('home')->with('success', 'Post posted');
    }
}