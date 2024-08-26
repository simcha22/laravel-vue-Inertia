<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkoutRequest;
use App\Http\Requests\UpdateWorkoutRequest;
use App\Http\Resources\WorkoutResource;
use App\Models\Exercise;
use App\Models\Workout;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workouts = Workout::orderBy('created_at', 'desc')->get();
        $exercises = Exercise::select(['id', 'name'])->get();
        return Inertia::render('Workouts/Index', ['workouts' => WorkoutResource::collection($workouts), 'exercises' => $exercises]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Workouts/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkoutRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        $workout = Workout::create($data);

        return redirect()->route('workouts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Workout $workout)
    {
        $workout = Workout::with(['user'])->where('id', $workout->id)->first();
        return Inertia::render('Workouts/Show', ['workout' => new WorkoutResource($workout)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Workout $workout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkoutRequest $request, Workout $workout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workout $workout)
    {
        //
    }
}
