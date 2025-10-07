<?php
    class Calculator{

        public function calc($string = null, $num1 = null, $num2 = null) {
            $operators = ["+", "-", "*", "/"];
            if (func_num_args() < 3) {
                $ans = "Cannot perform operation. You must have three arguments. A string for the operator (+,-,*,/) and two integers or floats for the numbers.";
                return "<p>" . $ans . "</p>";
            }
            if(in_array($string, $operators)){
                if(is_int($num1) || is_float($num1)){
                    if(is_int($num2) || is_float($num2)){
                        if($string == "+"){
                            $sol = $num1 + $num2;
                            $ans = "The calculation is $num1 + $num2. The answer is $sol.";
                        } elseif($string == "-"){
                            $sol = $num1 - $num2;
                            $ans = "The calculation is $num1 - $num2. The answer is $sol.";
                        } elseif($string == "*"){
                            $sol = $num1 * $num2;
                            $ans = "The calculation is $num1 * $num2. The answer is $sol.";
                        } elseif($string == "/"){
                            if($num2 == 0){
                                $ans = "The calculation is $num1 / $num2. The answer is cannot divide a number by zero.";
                            } else{
                                $sol = $num1 / $num2;
                            $ans = "The calculation is $num1 / $num2. The answer is $sol.";
                            }
                        }
                    } else {
                        $ans = "Cannot perform operation. You must have three arguments. A string for the operator (+,-,*,/) and two integers or floats for the numbers.";
                    }
                } else {
                    $ans = "Cannot perform operation. You must have three arguments. A string for the operator (+,-,*,/) and two integers or floats for the numbers.";
                }
            } else{
                $ans = "Cannot perform operation. You must have three arguments. A string for the operator (+,-,*,/) and two integers or floats for the numbers.";
            }
            return "<p>" . $ans . "</p>";
        }
    }
?>