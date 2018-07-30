<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Precedent;
use App\Repositories\Comments;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class CommentController extends Controller
{
    protected $comments;

    public function __construct(Comments $comments)
    {
        $this->comments = $comments;
    }

    public function show(Comment $comment)
    {
        return view('comments.show', compact('comment'));
    }

    public function store(Request $request, Precedent $precedent)
    {
        $data = $request->all();

        $validate = validator($data, $this->comments->createRules);

        if($validate->fails()) 
        {
            return redirect()->back()->withErrors($validate)->withInput(); 
        }
        else
        {
            $file = !isset($data['file']) ? null : '/storage/'.Storage::disk('local')->putFile('uploads', $data['file']);

            $comment = Auth::user()->comments()->create([
            'body' => $request->get('body'),
            'slug' => str_random(48),
            'file' => $file,
            'precedent_id' => $precedent->id,
            'user_id' => Auth::user()->id
            ]);

            return view('comments.show', compact('comment'));
        }
        
    }

    public function status(Request $request)
    {
        $comment = Comment::find($request->id);

        $update = $comment->update([
                'status' => '1'
        ]);

        if($update)
        {
            return redirect()->back(); 
        }
        else
        {
            return 'Erro';
        }
    }
}
