<?php

namespace App\Http\Controllers;

use App\Mail\CommentMail;
use App\Mail\RegisterMail;
use App\Models\PostComments;
use App\Models\Posts;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PostController extends BaseController
{

    public function login_user()
    {

        try {

            $email = request()->get('email');
            $password = request()->get('password');

            $user = User::where('email', $email)->first();
            if ($user == null) {
                return redirect()->back()->with('error', 'User Not Found !');
            }

            if (!Hash::check($password, $user->password)) {
                return redirect()->back()->with('error', 'Your information is incorrect. Please try again.');
            }

            Auth::login($user);

            if (Auth::check()) {
                return redirect()->route('home');
            } else {
                return redirect()->back()->with('error', 'Erro !');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error :(.');
        }
    }

    public function register_save()
    {

        try {

            $name = request()->get('name');
            $surname = request()->get('surname');
            $email = request()->get('email');
            $password = request()->get('password');
            $password_repeat = request()->get('password_repeat');

            if ($password != $password_repeat) {
                return redirect()->back()->with('error', 'The entered passwords are incompatible with each other.');
            }

            $userCheck = User::where('email', $email)->first();
            if ($userCheck != null) {
                return redirect()->back()->with('error', 'There is a user record for the e-mail address.');
            }


            $user = new User();
            $user->name = $name;
            $user->surname = $surname;
            $user->email = $email;
            $user->password = Hash::make($password);

            $userCode = md5($user->id . "-xg42" . Carbon::now());
            $user->user_code = $userCode;

            if ($user->save()) {
                Mail::to($email)->send(new RegisterMail(route('email_verified', [$userCode])));
                return redirect()->back()->with('success', 'Your registration has been completed successfully. Please check your e-mail address.');
            } else {
                return redirect()->back()->with('error', 'Error :(.');
            }
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', 'Error :(.');
        }
    }

    public function create_post()
    {
        try {

            $title = request()->get('title');
            $sub_title = request()->get('sub_title');
            $content = request()->get('content');

            if ($content == null) {
                return redirect()->back()->with('error', 'The Content field cannot be left empty.');
            }

            $mdl = new Posts();
            $mdl->created_at = Carbon::now();
            $mdl->create_user_id = Auth::user()->id;
            $mdl->update_user_id = null;
            $mdl->title = $title;
            $mdl->sub_title = $sub_title;
            $mdl->text = $content;

            if ($mdl->save()) {
                return redirect()->route('home')->with('success', 'Your post has been shared successfully.');
            } else {
                return redirect()->back()->with('error', 'The operation failed.');
            }
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('error', 'Error :(.');
        }
    }

    public function commentSave()
    {
        try {

            $comment = request()->get('comment');
            $post_id = request()->get('post_id');
            if (is_null($comment)) {
                return redirect()->back()->with('error', 'Comment is required.');
            }

            $comModel = new PostComments();
            $comModel->create_user_id = Auth::user()->id;
            $comModel->updated_at = null;
            $comModel->post_id = $post_id;
            $comModel->comment = $comment;

            if ($comModel->save()) {

                $post_info = Posts::find($post_id)->first();
                Mail::to($post_info->user->email)->send(new CommentMail());

                return redirect()->route('post_detail', [$post_id])->with('success', 'Comment success.');
            } else {
                return redirect()->back()->with('error', 'Error :(');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error :(');
        }
    }

    public function editComment()
    {
        try {

            $comment = request()->get('comment');
            $comment_id = request()->get('comment_id');
            $post_id = request()->get('post_id');
            if (is_null($comment)) {
                return redirect()->back()->with('error', 'Comment is required.');
            }

            $comModel = PostComments::find($comment_id);
            $comModel->updated_at = Carbon::now();
            $comModel->comment = $comment;

            if ($comModel->save()) {
                return redirect()->route('post_detail', [$post_id])->with('success', 'Comment success.');
            } else {
                return redirect()->back()->with('error', 'Error :(');
            }
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('error', 'Error :(');
        }
    }

    public function commentDelete()
    {
        try {
            $comment_id = request()->get('commentId');
            $post_id = request()->get('postId');


            $comModel = PostComments::find($comment_id);
            $comModel->deleted_user_id = Auth::user()->id;
            if ($comModel->save()) {
                $comModel->delete();
                return redirect()->route('post_detail', [$post_id])->with('success', 'Comment deleted.');
            } else {
                return redirect()->back()->with('error', 'Error :(');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error :(');
        }
    }

    public function update_post()
    {
        try {
            $post_id = request()->get('post_id');
            $title = request()->get('title');
            $sub_title = request()->get('sub_title');
            $content = request()->get('content');

            if ($content == null) {
                return redirect()->back()->with('error', 'The Content field cannot be left empty.');
            }
            $post = Posts::find($post_id);
            $post->update_user_id = Auth::user()->id;
            $post->updated_at = Carbon::now();
            $post->title = $title;
            $post->sub_title = $sub_title;
            $post->text = $content;


            if ($post->save()) {
                return redirect()->route('post_detail', [$post_id])->with('success', 'Updated Success.');
            } else {
                return redirect()->back()->with('error', 'Error :(');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error :(');
        }
    }

    public function delete_post()
    {
        try {

            $post_id = request()->get('post_id');
            $post = Posts::find($post_id);

            $postCommentCount = PostComments::where('post_id', $post_id)->count();
            if ($postCommentCount > 0) {
                return redirect()->route('post_detail', [$post_id])->with('error', 'Commented posts cannot be deleted.');
            }

            if ($post->delete()) {
                return redirect()->route('home')->with('success', 'Post deleted.');
            } else {
                return redirect()->back()->with('error', 'Error :(');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error :(');
        }
    }
}
