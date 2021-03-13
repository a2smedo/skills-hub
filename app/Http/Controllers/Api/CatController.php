<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CatResource;
use App\Models\Cat;
use Illuminate\Http\Request;

class CatController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        dd($user);
        //return CatResource::collection(Cat::get());

        if ($user !== null ) {
            return CatResource::collection(Cat::get());
        }

        return response()->json([
            'message' => 'please login to show all categories.',
        ], 404);

    }


    public function show($id)
    {
        $cat = Cat::with('skills')->findOrFail($id);
        return new CatResource($cat);

    }
}
