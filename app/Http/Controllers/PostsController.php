<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class PostsController extends Controller
{
    //
    public function index(){
         $lists = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('username', 'images', 'posts.*')
            ->orderBy('posts.created_at','desc')
            ->get();
        return view('posts.index',['lists'=>$lists]);
    }

    public function post(Request $request){
        $tweet = $request->input('newPost');
        DB::table('posts')->insert([
            'posts' => $tweet,
            'user_id'=>Auth::id(),
            'created_at'=>now(),
            'updated_at'=>now()
            ]
        );
        return redirect('top');
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $up_post = $request->input('upPost');
        DB::table('posts')
            ->where('id', $id)
            ->update(
                ['posts' => $up_post]
            );

        return redirect('top');
    }

     public function delete($id)
    {
        DB::table('posts')
            ->where('id', $id)
            ->delete();

        return redirect('top');
    }

}
