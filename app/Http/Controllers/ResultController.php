<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResultRequest;
use App\Http\Requests\UpdateResultRequest;
use App\Http\Resources\ExerciseResource;
use App\Models\Exercise;
use App\Models\Result;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Inertia;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Exercise $exercise)
    {
        $exercise = Exercise::with(['results' => function ($query) {
            $query->where('user_id', auth()->id());
        }])->where('id','=', $exercise->id)->get();

        return Inertia::render('Results/Index', ['exercise' => ExerciseResource::collection($exercise)]);
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
    public function store(StoreResultRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Result $result)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResultRequest $request, Result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Result $result)
    {
        //
    }
}
