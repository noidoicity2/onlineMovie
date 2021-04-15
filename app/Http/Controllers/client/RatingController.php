<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\MovieRating;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    //
    public function PostRateMovie(Request  $request) {
        $rating = MovieRating::select('id')
        ->where([
            'movie_id' => $request->movie_id,
            'user_id'  => Auth::id(),
        ])->get();
        if($rating->count() ==0) {
            try{
                MovieRating::create($request->all());
                return json_encode([
                    'success' => true ,
                    'message' => "rating movie successfully",
                ]);
            }
            catch (Exception $exception) {
                return json_encode([
                    'success' => false ,
                    'message' => "Failed to rate movie",
                ]);
            }
        }
        else {
            MovieRating::where([
                'movie_id' => $request->movie_id,
                'user_id'  => Auth::id(),
            ])->update([
                'rating_point' => $request->rating_point,
            ]);
            return json_encode([
                'success' => true ,
                'message' => "rating movie successfully",
            ]);
        }


    }
}
