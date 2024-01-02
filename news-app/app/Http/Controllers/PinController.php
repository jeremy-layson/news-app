<?php

namespace App\Http\Controllers;

use App\Models\Pin;
use Illuminate\Http\Request;
use App\Http\Requests\News\PinCreateRequest;

class PinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pins = $this->fetchPins();

        return response($pins);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PinCreateRequest $request)
    {
        $data = $request->validated();
        $data['is_pinned'] = 1;
        $data['source'] = 'the_guardian';

        $pin = Pin::firstOrCreate([
            // to avoid duplication
            'article_id' => $data['article_id'],
        ],$data);
        
        return response($this->fetchPins());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pin $pin, Request $request)
    {
        $pin->delete();

        // re-fetch pins
        return response($this->fetchPins());
    }

    protected function fetchPins()
    {
        return Pin::where('is_pinned', 1)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
