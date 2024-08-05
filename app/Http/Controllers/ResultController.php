<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResultRequest;
use App\Http\Requests\UpdateResultRequest;
use App\Http\Resources\ExerciseResource;
use App\Models\Exercise;
use App\Models\Result;
use App\Services\ResultService;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ResultController extends Controller
{
    public function __construct(public ResultService $resultService){}

    public function index(Exercise $exercise)
    {
        $this->resultService->getCardWeights($exercise->id);
        $exercise = Exercise::with(['results' => function ($query) {
            $query->where('user_id', auth()->id());
        }])->where('id','=', $exercise->id)->get();

        return Inertia::render('Results/Index', [
            'exercise' => ExerciseResource::collection($exercise),
            'cards' => $this->resultService->card,
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
    public function store(StoreResultRequest $request, Exercise $exercise)
    {
        $data = $request->validated();

        Result::create([
            'user_id' => auth()->id(),
            'exercise_id' => $exercise->id,
            'reps_type' => $data['type'],
            'level' => $data['level'],
            'rehearsals' => collect($data['weight'])->pluck('reps')->implode('#') ,
            'weights'=> collect($data['weight'])->pluck('value')->implode('#'),
            'rounds' => $data['sets'],
            'percentage' => collect($data['weight'])->pluck('percent')->implode('#'),
            'notes' => $data['notes'] ?? null ,
            'done_at' => $data['done_at'],
            'meta' => json_encode($data['weight']),
        ]);

        return Redirect::route('results.index', $exercise)
            ->with('message', 'psr create successfully.');
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
