<?php

// include the functions file with the maths functions
include ("functions.php"); 

// people.txt is the input
$input_handle = fopen('people.txt', 'r');

// output.html is the output
$output_handle = fopen('output.html', 'w');

$module_code = "";
$module_name = "";
$tutor_name = "";
$date = "";
$student_marks = array();

$mark_counts = array(
    "distinctions" => 0,
    "merits" => 0,
    "passes" => 0,
    "fails" => 0,
);

// file validation (not properly implimented yet)
function contentIsNotEmpty($input_handle) {
    $isEmpty = empty($input_handle) || (count($input_handle) == 1 && empty($input_handle[0]));
    return $isEmpty ? false : $input_handle;
}

// start reading the file
$first = false;
while (!feof($input_handle)) {
    $data = fgetcsv($input_handle);
    if (!$first) {
        $module_code = $data[0];
        $module_name = $data[1];
        $tutor_name = $data[2];
        $date = $data[3];
        $first = true;
    } else { 
        if ($data[1] <=100 && $data >= 0) {
            if ($data[1] >= 70) {
                $mark_counts['distinctions']++;
            }
            elseif ($data[1] >= 60) {
                $mark_counts['merits']++;
            }
            elseif ($data[1] >= 40) {
                $mark_counts['passes']++;
            }   
            elseif ($data[1] >= 0) {
                $mark_counts['fails']++;
            }

            $student_marks[] = array(
                'student_id' => $data[0],
                'mark' => $data[1],
            );

        // error handling for if the mark presented is not between 0 and 100
        } else {
            $student_marks[] = array(
                'student_id' => $data[0],
                'error' => "Mark is greater than 100 or less than 0.",
            );
        }
    }
}


var_dump($module_code);
var_dump($module_name);
var_dump($tutor_name);
var_dump($data);
var_dump($student_marks);
var_dump($mark_counts);

// error handling for NaN to be implemented on output 
foreach ($tests as $element) {
    if (is_numeric($element)) {
        echo var_export($element, true) . " is numeric", PHP_EOL;
    } else {
        echo var_export($element, true) . " is NOT numeric", PHP_EOL;
    }
}

fwrite($output_handle, "asdasdasd");
fwrite($output_handle, "a<p>sdas</p>dasd");
fwrite($output_handle, "asdasdasd");
fwrite($output_handle, "asdasdasd");

// close the files
fclose($input_handle);
fclose($output_handle);