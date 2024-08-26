<?php

namespace App\Services;

use App\Models\Result;
use Illuminate\Support\Facades\DB;

class ResultService{

    public Array $card;

    public function getCardWeights($exerciseId)
    {
        $lastRecord = DB::table('results')
            ->where('user_id', auth()->id())
            ->where('exercise_id', $exerciseId)
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$lastRecord) {
            return;
        }

        $currentWeights = explode('#', $lastRecord->weights);
        $currentHighestWeight = max(array_map('floatval', $currentWeights));

        $allWeights = DB::table('results')
            ->where('user_id', auth()->id())
            ->where('exercise_id', $exerciseId)
            ->whereNot('id', $lastRecord->id)
            ->pluck('weights');

        $allHighestWeight = 0;
        foreach ($allWeights as $weights) {
            $weightsArray = explode('#', $weights);
            $maxWeight = max(array_map('floatval', $weightsArray));
            if ($maxWeight > $allHighestWeight) {
                $allHighestWeight = $maxWeight;
            }
        }

        $percentageChange = 0;
        $weightChange = 0;
        if ($allHighestWeight > 0) {
            $percentageChange = (($currentHighestWeight - $allHighestWeight) / $allHighestWeight) * 100;
            $weightChange = ($currentHighestWeight - $allHighestWeight);
        }
        //dd($percentageChange, $weightChange);

        $this->card[] = [
            'header' => 'Weight percent',
            'value' => $currentHighestWeight . 'k',
            'percent' => number_format($percentageChange, '2') . ' %',
            'status' => ($currentHighestWeight >= $allHighestWeight) ? 'increase' : 'decrease',
        ];

        $this->card[] = [
            'header' => 'Weight',
            'value' => $currentHighestWeight . 'k',
            'percent' => $weightChange . 'k',
            'status' => ($currentHighestWeight >= $allHighestWeight) ? 'increase' : 'decrease',
        ];
    }

    public function calculateWeights($exerciseId)
    {
        $results = Result::where('user_id', auth()->id())
            ->where('exercise_id', $exerciseId)
            ->whereNotNull('meta')
            ->pluck('meta');

        $arrayResults = [];
        $allWeightsOnReps = [];
        foreach ($results as $result) {
            $arrayResult = json_decode($result, true);
            foreach($arrayResult as $item) {
                $allWeightsOnReps[$item['reps']][] = $item['value'];
                $allWeightsOnReps[$item['reps']] = array_unique($allWeightsOnReps[$item['reps']]);
            }
        }

        dd($allWeightsOnReps);
    }
}
