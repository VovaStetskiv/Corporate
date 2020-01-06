<?php

namespace Corp\Http\Controllers;

use Corp\Http\Requests\CommentRequest;
use Corp\Models\Article;
use Corp\Models\Comment;
use Illuminate\Http\Request;

use Corp\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class CommentController extends SiteController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except(['_token', 'comment_post_id', 'comment_parent']);

        $data['article_id'] = $request->comment_post_id;

        $data['parent_id'] = $request->comment_parent;

        $validator = Validator::make($data, [
            'article_id' => 'integer|required',
            'parent_id' => 'integer|required',
            'text' => 'string|required'
        ]);

        $validator->sometimes(['name', 'email'], 'required|max:255', function (){
            return !Auth::check();
        });

        if($validator->fails()) {
            return Response::json(['error' => $validator->errors()->all()]);
        }

        $user = Auth::user();

        $comment = new Comment($data);

        if($user) {
            $comment->user_id = $user->id;
        }

        $article = Article::find($data['article_id']);

        $article->comments()->save($comment);


        $comment->load('user');
        $data['id'] = $comment->id;

        $data['name'] = (!empty($data['name'])) ? $data['name'] : $comment->user->name;
        $data['email'] = (!empty($data['email'])) ? $data['email'] : $comment->user->email;

        $data['hash'] = md5($data['email']);

        $view_comment = view(env('THEME').'.singleComment')->with(['comment' => $comment])->render();

        return Response::json([
                'success' => true,
                'comment' => $view_comment,
                'data' => $data
            ]);

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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }
}
