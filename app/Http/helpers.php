<?php

use App\Models\CandidateProfileAssessmentScore;
use App\Models\CandidateProfileAssessmentTestScore;


if (!function_exists('getAccessToken')) {
    function getAccessToken($amount,$test_id)
    {
        $tokenApiUrl =
            'https://ipg1.apps.net.pk/Ecommerce/api/Transaction/GetAccessToken';
        $urlPostParams = sprintf(
            'MERCHANT_ID=%s&SECURED_KEY=%s&TXNAMT=%s&BASKET_ID=%s&CURRENCY_CODE=%s',
            env('MERCHANT_ID'),
            env('SECURED_KEY'),
            $amount,
            $test_id,
            'PKR'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $tokenApiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); curl_setopt($ch,
        CURLOPT_POST, 1); curl_setopt($ch, CURLOPT_POSTFIELDS,
        $urlPostParams);
        curl_setopt($ch, CURLOPT_USERAGENT, 'RT CAT Test');
        $response = curl_exec($ch);
        curl_close($ch);
        $payload = json_decode($response);
        $token = isset($payload->ACCESS_TOKEN) ? $payload->ACCESS_TOKEN : '';
        return $token;
    }
}

if (!function_exists('candidateProfileAssessmentCharts')) {
    function candidateProfileAssessmentCharts($quiz_id, $candidateId)
    {
        // $candidateId = Auth::guard('candidate')->id();
        $candidateProfileTest = CandidateProfileAssessmentTestScore::where('candidate_id', $candidateId)
                ->where('quiz_id', $quiz_id);
        if($candidateProfileTest->count() < 40)
        {
            return response()->json([
                'status' => 'error',
                'message' => "You Left this test incomplete",
            ]);
        }
        $scoresByCategory = CandidateProfileAssessmentTestScore::with('question.subCategory')
            ->where('candidate_id', $candidateId)
            ->where('quiz_id', $quiz_id)
            ->get()
            ->groupBy('question.subCategory.name') // Assuming a `category` relationship exists
            ->map(function ($answers) {
                return $answers->sum('score');
            });

        // Step 2: Initialize category comparisons
        $comparisons = [
            'SO_vs_G' => compareCategories($scoresByCategory, 'SO', 'G', $candidateId,$quiz_id),
            'A_vs_P' => compareCategories($scoresByCategory, 'A', 'P', $candidateId,$quiz_id),
            'I_vs_F' => compareCategories($scoresByCategory, 'I', 'F', $candidateId,$quiz_id),
            'SP_vs_D' => compareCategories($scoresByCategory, 'SP', 'D', $candidateId,$quiz_id),
        ];
//        Log::info($comparisons);
        if (in_array('tie_unresolved', $comparisons)) {
            return response()->json([
                'status' => 'error',
                'message' => "It appears that your responses were entered inconsistently or without due reflection. As a result, the system could not accurately generate your personality assessment results.

To ensure meaningful and reliable outcomes, we encourage you to carefully consider each statement before responding. Your thoughtful input is essential for producing accurate and insightful results.

Please try again when you're ready to engage more attentively. We look forward to assisting you with a more successful assessment experience.",
            ]);
        }

        return response()->json([
            'status' => 'success',
            'data' => $comparisons,
        ]);

    }
}

if (!function_exists('compareCategories')) {
    function compareCategories($scoresByCategory, $category1, $category2, $candidateId,$quiz_id)
    {
        // Step 1: Get total scores
        $score1 = $scoresByCategory[$category1] ?? 0;
        $score2 = $scoresByCategory[$category2] ?? 0;

        // Step 2: Determine the winner
        if ($score1 > $score2) {
            return $category1;
        } elseif ($score1 < $score2) {
            return $category2;
        } else {
            // Step 3: Resolve tie with highest individual score
            $highestScore1 = getHighestScoreInCategory($candidateId, $category1,$quiz_id);
            $highestScore2 = getHighestScoreInCategory($candidateId, $category2,$quiz_id);

            if ($highestScore1 > $highestScore2) {
                return $category1;
            } elseif ($highestScore1 < $highestScore2) {
                return $category2;
            } else {
                // Step 4: Resolve tie with scores above 7
                $aboveSeven1 = countScoresAboveThreshold($candidateId, $category1, 7,$quiz_id);
                $aboveSeven2 = countScoresAboveThreshold($candidateId, $category2, 7,$quiz_id);
                if ($aboveSeven1 > $aboveSeven2) {
                    return $category1;
                } elseif ($aboveSeven1 < $aboveSeven2) {
                    return $category2;
                } else {
                    // Step 5: Resolve tie with scores above 5
                    $aboveFive1 = countScoresAboveThreshold($candidateId, $category1, 5,$quiz_id);
                    $aboveFive2 = countScoresAboveThreshold($candidateId, $category2, 5,$quiz_id);

                    if ($aboveFive1 == $aboveFive2) {

                        // Fully unresolved tie
                        return 'tie_unresolved';
                    }

                    return ($aboveFive1 >= $aboveFive2) ? $category1 : $category2;
                }
            }
        }
    }
}

if (!function_exists('countScoresAboveThreshold')) {
    function countScoresAboveThreshold($candidateId, $category, $threshold,$quiz_id)
    {
        return CandidateProfileAssessmentScore::with('question.subCategory')
            ->where('candidate_id', $candidateId)
            ->whereHas('question.subCategory', function ($query) use ($category) {
                $query->where('name', $category);
            })
            ->where('quiz_id',$quiz_id)
            ->where('score', '>', $threshold)
            ->count();
    }
}

if (!function_exists('getHighestScoreInCategory')) {
    function getHighestScoreInCategory($candidateId, $category,$quiz_id)
    {
        return CandidateProfileAssessmentScore::with('question.subCategory')
            ->where('candidate_id', $candidateId)
            ->where('quiz_id',$quiz_id)
            ->whereHas('question.subCategory', function ($query) use ($category) {
                $query->where('name', $category);
            })
            ->max('score');
    }
}

if (!function_exists('findJobRole')) {
    function findJobRole($comparisons)
    {
        try {
            // Step 2: Extract the winners
            $winners = array_values($comparisons); // Example: ["G", "A", "I", "SP"]

            // Step 3: Generate permutations of all four values
            $combinations = generatePermutations($winners);

            // Step 4: Fetch valid combinations from the config file
            $validCombinations = config('profile_assessment.valid_combinations');

            // Step 5: Check for a matching combination in the config file
            foreach ($combinations as $combination) {
                if (array_key_exists($combination, $validCombinations)) {
                    return response()->json([
                        'matching_combination' => $combination,
                        'details' => $validCombinations[$combination],
                        'success' => true
                    ]);
                }
            }

            return response()->json([
                'generated_combinations' => $combinations,
                'message' => 'No matching combination found in the config file.',
                'success' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error processing combinations: ' . $e->getMessage(),
                'success' => false
            ]);
        }
    }
}

if (!function_exists('generatePermutations')) {
    function generatePermutations(array $elements)
    {
        if (count($elements) === 1) {
            return [$elements[0]];
        }

        $permutations = [];

        foreach ($elements as $key => $element) {
            $remaining = array_merge(array_slice($elements, 0, $key), array_slice($elements, $key + 1));
            foreach (generatePermutations($remaining) as $permutation) {
                $permutations[] = $element . $permutation;
            }
        }
        return $permutations;
    }
}
