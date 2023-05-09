<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Car;

class CommentController extends Controller
{


    public function store(Request $request, Car $car)
    {
        $request->validate(['body' => 'required']);

        $comment = new Comment([
            'body' => $request->body,
            'user_id' => auth()->id()
        ]);

        $car->comments()->save($comment);

        return redirect()->route('cars.show', $car->id);
    }

    public function destroy(Car $car, Comment $comment)
    {
        $comment->delete();
        return redirect()->route('cars.show', $car->id);
    }
}
