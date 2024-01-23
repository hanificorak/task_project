<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HarshadNumberController extends Controller
{
    public function checkHarshadNumber(Request $request)
    {
        $number = $request->input('number');

        if ($this->isHarshadNumber($number)) {
            $result = 'Harshad Number';
        } else {
            $result = 'Not a Harshad Number';
        }

        return view('checkHarshadNumberResult', compact('number', 'result'));
    }

    private function isHarshadNumber($number)
    {
        $sumOfDigits = array_sum(str_split($number));

        return $number % $sumOfDigits === 0;
    }
}
