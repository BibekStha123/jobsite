<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\Rule;

class ListingController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('listings.index', [
            'listings' => Listing::latest()->filter($request->tag, $request->search)->get()
        ]);
    }

    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    public function create()
    {
        return view('listings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'company' => 'required|unique:listings',
            'location' => 'required',
            'website' => 'required',
            'email' => 'required|email',
            'tags' => 'required',
            'description' => 'required'
        ]);

        Listing::create([
            'title' => $request->title,
            'company' => $request->company,
            'location' => $request->location,
            'website' => $request->website,
            'email' => $request->email,
            'tags' => $request->tags,
            'description' => $request->description
        ]);

        return redirect('/')->with('message', 'Listing Created Successfully!!');
    }
}
