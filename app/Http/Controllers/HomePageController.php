<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\HomePage;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $homePages = HomePage::where('user_id',auth()->user()->id)
            ->latest()
            ->get();

        return view('home-pages.index',compact('homePages'));
    }

    public function create()
    {
        return view('home-pages.create');
    }

    protected static function validateHomePage()
    {
        $rules = [
            'title' => ['required'],
            'website_link' => ['required'],
            'content' => ['required'],
            'banner' => ['required','image','mimes:jpg,png,jpeg,gif,svg','max:2048']
        ];

        if (request()->isMethod('PATCH')) {
            $rules['banner'] = ['nullable','image','mimes:jpg,png,jpeg,gif,svg','max:2048'];
        }

        return Validator::make(request()->all(), $rules);
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
        $validatedData = $validation->valid();

        if ($validation->fails()) {
            return $this->respondError('Validation Errors.', ['errors' => $validation->errors()], 401);
        }

        if ($request->hasFile('banner')) {
            $imageName = time().'.'.$request->banner->extension();
            $request->banner->move(public_path('images'), $imageName);
            $validatedData['banner'] = asset('images').'/'.$imageName;
        }

        $homePage->update($validatedData);

        session()->flash('message', 'Home Page successfully updated.'); 

        return response()->json(['success' => true]);
    }

    public function destroy(Homepage $homePage)
    {
        $homePage->delete();

        return back()->with('message','Home Page deleted successfully.');
    }
}