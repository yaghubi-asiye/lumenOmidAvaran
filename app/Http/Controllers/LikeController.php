<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Product;
use App\Models\Comment;
use Tymon\JWTAuth\Facades\JWTAuth;

class LikeController extends Controller
{
    public function likeProduct(Request $request, $id)
    {
        $product = Product::find($id);
        return $this->like($request, $product, 'App\Models\Product');
    }

    public function likeComment(Request $request,$id)
    {
        $comment = Comment::find($id);
        return $this->like($request, $comment, 'App\Models\Comment');
    }

    private function like(Request $request, $likable, $likableType)
    {
        $user = JWTAuth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $existingLike = Like::where([
            ['user_id', $user->id],
            ['likable_id', $likable->id],
            ['likable_type', $likableType],
        ])->first();

        if ($existingLike) {
            return response()->json(['message' => 'Already liked'], 200);
        }

        $like = new Like([
            'user_id' => $user->id,
            'likable_id' => $likable->id,
            'likable_type' => $likableType,
        ]);

        $like->save();

        return response()->json(['message' => 'Liked successfully'], 200);
    }

}

