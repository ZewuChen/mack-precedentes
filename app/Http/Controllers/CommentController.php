<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentCreateRequest;
use App\Precedent;
use App\Repositories\Comments;
use Illuminate\Http\File;
use Illuminate\Http\Request;
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
        // $this->authorize('view', $comment);

        return view('comments.show', compact('comment'));
    }

    public function store(CommentCreateRequest $request)
    {
        $this->authorize('create', Comment::class);

        $comment = $this->comments->create(
            Auth::user(),
            $request->only('body', 'precedent_id')
        );

        if ($request->has('file')) {
            $path = Storage::putFile('docs/comments', $request->file('file'));

            $this->comments->setFilePath($comment, $path);
        }

        return redirect()
            ->route('comments.show', $comment)
            ->with('success', 'Comentário adicionado com sucesso.');
    }

    public function approve(Comment $comment)
    {
        $this->authorize('approve', $comment);

        $comment = $this->comments->approve($comment);

        return redirect()
            ->route('comments.show', $comment)
            ->with('success', 'Comentário aprovado com sucesso.');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $this->comments->delete($comment);

        return back();
    }
}
