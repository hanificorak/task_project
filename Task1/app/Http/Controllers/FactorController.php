<?php

namespace App\Http\Controllers;

class FactorController extends Controller
{
    public function index()
    {
        $factors = $this->calculateFactors(900900);
        $factorPairs = $this->calculateFactorPairs($factors);

        return view('factorPairs', compact('factorPairs'));
    }

    private function calculateFactors($number)
    {
        $factors = [];
        for ($i = 1; $i <= sqrt($number); $i++) {
            if ($number % $i == 0) {
                $factors[] = $i;
                $factors[] = $number / $i;
            }
        }

        return array_unique($factors);
    }

    private function calculateFactorPairs($factors)
    {
        sort($factors);
        $factorPairs = [];

        for ($i = 0; $i < count($factors) / 2; $i++) {
            $smallerFactor = $factors[$i];
            $largerFactor = $factors[count($factors) - $i - 1];
            $product = $smallerFactor * $largerFactor;
            $factorPairs[] = "$smallerFactor * $largerFactor = $product";
        }

        return $factorPairs;
    }
}
