<?php

namespace App\Http\Controllers;

use App\Models\PostComments;
use App\Models\Posts;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class PageController extends BaseController
{
    public function index()
    {

        $oneYearAgo = Carbon::now()->subYear();


        $posts = Posts::where('created_at', '>=', $oneYearAgo)->get();

        return view('home', compact('posts'));
    }

    public function search()
    {
        $searchTerm = request()->get('search');

        $oneYearAgo = Carbon::now()->subYear();

        $posts = Posts::where(function ($query) use ($searchTerm) {
            $query->where('title', 'like', '%' . $searchTerm . '%')
                ->orWhere('sub_title', 'like', '%' . $searchTerm . '%')
                ->orWhere('text', 'like', '%' . $searchTerm . '%');
        })->where('created_at', '>=', $oneYearAgo)
            ->get();

        return view('home', compact('posts'));

    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function create_post()
    {

        if (Auth::user()->email_verified == 0) {
            return redirect()->route('home')->with('error', 'You must verify your e-mail address.');
        }
        return view('create_post');
    }

    public function postDetail($postId)
    {

        $post_info = Posts::where('id', $postId)->first();
        $comments = PostComments::where('post_id', $postId)->get();


        return view('post_detail', compact('post_info', 'comments'));
    }

    public function edit_post($id)
    {

        $postCommentCount = PostComments::where('post_id', $id)->count();
        if ($postCommentCount > 0) {
            return redirect()->route('post_detail', [$id])->with('error', 'Commented posts cannot be edited.');
        }
        $post = Posts::where("id", $id)->first();
        return view('edit_post', compact('post'));
    }

    public function email_verified($code)
    {

        $user = User::where('user_code', $code)->first();

        $userModel = User::find($user->id);
        $userModel->email_verified = 1;
        $userModel->save();

        return redirect()->route('home')->with('success', 'Your e-mail address has been verified.');
    }
}
