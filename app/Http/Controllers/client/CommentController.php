<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\MovieComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isEmpty;

class CommentController extends Controller
{
    //
    public function PostAddComment(Request  $request) {
        if($request->comment == "") {
            return json_encode([
                'success' =>true ,
                'message'=> "Invalid comment",
            ]);
        }
        MovieComment::create([
            'movie_id' => $request->movie_id,
            'user_id' => Auth::id(),
            'content' => $request->comment,
        ]);
        return json_encode([
           'success' =>true ,
           'message'=> "add comment successfully",
        ]);
    }
}
