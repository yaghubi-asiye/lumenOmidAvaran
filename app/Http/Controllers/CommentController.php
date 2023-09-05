<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Product;
use Tymon\JWTAuth\Facades\JWTAuth;


class CommentController extends Controller
{

    public function store($id)
    {

        $user = JWTAuth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $validator = $this->validateData();

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $product = Product::find($id);
        $comment = new Comment([
            'body' => request()->input('body'),
            'user_id' => $user->id,
        ]);

        $product->comments()->save($comment);

        return response()->json(['message' => 'Comment created successfully'], 201);
    }

    private function validateData()
    {
        return validator(request()->all(), [
            'body' => 'required|string',
        ]);
    }

}
