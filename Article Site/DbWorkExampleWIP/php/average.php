<?php

//Average ////////////////////////////////////////////////////////////

$Values = [12, 7, 12, 6, 1, 2, 13, 15, 12];

function AverageValuesFromArray($Input) {

    $MyResult= array_sum($Input)/count($Input);

    return $MyResult;

}

echo "Average is : ".AverageValuesFromArray($Values);


$MyResult = AverageValuesFromArray([43,1234322]);


$Values = range(0,20);

function ReturnStringOfValuesEvenFromArray() {}

echo "Even Values are : ".ReturnStringOfValuesEvenFromArray($Values);


function recArea($l, $w){
    $area = $l * $w;
    echo "A rectangle of length $l and width $w has an area of $area.";
}

//Call function.
recArea(2, 4);
?>