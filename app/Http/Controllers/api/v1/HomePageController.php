<?php

namespace App\Http\Controllers\api\v1;

use Validator;
use App\Models\HomePage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    public function show($id)
    {
        $homePage = HomePage::find($id);

        if (is_null($homePage)) {
            return $this->respondError('Home Page not found.', [], 404);
        }

        return $this->respondSuccess('Home Page successfully get.', ['homePage' => $homePage]);
    }

    public function store(Request $request)
    {
        return response()->json('Not Available');
    }
}