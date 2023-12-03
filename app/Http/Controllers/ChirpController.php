<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $chirps = Chirp::with('user')->latest()->get();

        return view('chirps.index', compact('chirps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(['message' => 'required|max:255']);

        $request->user()->chirps()->create($validated);

        return to_route('chirps.index')
        ->with('success', __('Chirp created successfully!'));
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
        $this->authorize('view', $chirp);
        return view('chirps.edit')->with('chirp', $chirp);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
        //
        $this->authorize('update', $chirp);
        $validated = $request->validate(['message'=> 'required|max:255']);
        $chirp->update($validated);
        return to_route('chirps.index')->with('success', __('Chirp updated successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        $this->authorize('delete', $chirp);
        $chirp->delete();
        return to_route('chirps.index')->with('success', __('Chirp deleted successfully!'));
    }
}
