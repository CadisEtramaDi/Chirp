<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;


class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('chirps.index', [
            'chirps' => Chirp::with('user')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = $request->validate([
            'message' => 'required|string|max:255',
        ]);
 
        $request->user()->chirps()->create($validate);
 
        return view('chirps.index',[
            'chirps' => Chirp::with('user')->latest()->get(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        //
        return view('chirps.edit',[
            'chirp' => $chirp,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
        //
        $validate = $request->validate([
            'message' => 'required|string|max:5000',
        ]);

        $chirp->update($validate);

        return view('chirps.index',[
            'chirps' => Chirp::with('user')->latest()->get(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {

        $chirp->delete();

        return view('chirps.index',[
            'chirps' => Chirp::with('user')->latest()->get(),
        ]);
    }
}
