<?php

namespace App\Http\Controllers;

use App\Comment;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class CommentController extends ApiController
{
    private $comment; 

    public function __construct(Comment $comment) 
    {
        $this->comment = $comment; 
    }

    public function getAll()
    {
        $comment = $this->comment->all(); 

        return $this->showResponse($comment);
    }

    public function store(Request $request)
    {
        $user = $this->getAuthUser($request->token); 
        
        $rule = [
            'message'   => 'required', 
            'rating'    => 'required',
            'place_id'  => 'required',
            'photo'     => 'image' 
        ]; 
        
        $this->validate($request, $rule);
        
        $photo = null; 
        if ($request->photo) {
            $photo = $request->photo->store('');
        }
        
        $comment = $this->comment->create([
            'message' => $request->message, 
            'photo' => $photo, 
            'rating' => $request->rating, 
            'like' => 0, 
            'user_id' => $user->id, 
            'place_id' => $request->place_id,
        ]); 

        return $this->showResponse($comment);
    }

    public function getPhoto($id) 
    {
        $comment = $this->comment->findOrFail($id); 

        if (!Storage::exists($comment->photo)) {
            return $this->notAcceptQueryResponse('Image not found!'); 
        }

        $file = Storage::get($comment->photo);
        $type = Storage::mimeType($comment->photo);

        $response = Response::make($file, 200);
        $response->header('Content-Type', $type);

        return $response;
    }

}
