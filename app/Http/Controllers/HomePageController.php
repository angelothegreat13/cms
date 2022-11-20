<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\HomePage;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $homePages = HomePage::latest()->get();

        return view('home-pages.index',compact('homePages'));
    }

    public function create()
    {
        return view('home-pages.create');
    }

    protected static function validateHomePage()
    {
        $validated = Validator::make(request()->all(), [
            'title' => ['required'],
            'website_link' => ['required'],
            'content' => ['required'],
            'banner' => ['required','image','mimes:jpg,png,jpeg,gif,svg','max:2048']
        ]);

        return $validated;
    }

    public function store(Request $request)
    {
        $validation = self::validateHomePage();

        if ($validation->fails()) {
            return $this->respondError('Validation Errors.', ['errors' => $validation->errors()], 401);
        }

        $imageName = time().'.'.$request->banner->extension();
        $request->banner->move(public_path('images'), $imageName);

        $validatedData = $validation->valid();
        $validatedData['banner'] = asset('images').'/'.$imageName;
        $validatedData['user_id'] = auth()->user()->id;

        HomePage::create($validatedData);

        session()->flash('message', 'Home Page successfully saved.'); 

        return response()->json(['success' => true]);
    }   

    public function edit(HomePage $homePage)
    {
        return view('home-pages.edit', compact('homePage'));
    }

    public function update(HomePage $homePage, Request $request)
    {
        $validation = self::validateHomePage();

        if ($validation->fails()) {
            return $this->respondError('Validation Errors.', ['errors' => $validation->errors()], 401);
        }

        return response()->json(['success' => true]);
    }

    public function destroy()
    {

    }
}