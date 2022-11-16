<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'user' => auth()->user()
            ]
        ], 200);
    }

}