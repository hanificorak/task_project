<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NumberController extends Controller
{


    public function numberForm()
    {
        return view('numberForm');
    }

    public function checkNumber(Request $request)
    {
        try {
            $number = $request->input('number');

            if ($this->isDeficient($number)) {
                $result = 'Deficient';
            } elseif ($this->isPerfect($number)) {
                $result = 'Perfect';
            } else {
                $result = 'Abundant';
            }

            return view('numberResult', compact('number', 'result'));
        } catch (\Throwable $th) {
            abort(500);
        }
    }

    private function isDeficient($number)
    {
        try {
            return $this->sumOfDivisors($number) < 2 * $number;
        } catch (\Throwable $th) {
            abort(500);
        }
    }

    private function isPerfect($number)
    {
        try {
            return $this->sumOfDivisors($number) == 2 * $number;
        } catch (\Throwable $th) {
            abort(500);
        }
    }

    private function sumOfDivisors($number)
    {
        try {
            $sum = 1;

            for ($i = 2; $i <= sqrt($number); $i++) {
                if ($number % $i == 0) {
                    $sum += $i;

                    if ($i != $number / $i) {
                        $sum += $number / $i;
                    }
                }
            }

            return $sum;
        } catch (\Throwable $th) {
            abort(500);
        }
    }
    
    public function checkHarshadForm()  {
        return view('checkHarshadNumberForm');
    }
}
