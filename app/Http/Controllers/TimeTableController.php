<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimeTableController extends Controller
{
    public function index(){
        return view('index');
    }
    public function subjects(Request $request){
        $days  = $request->days;
        $subjectsPerDay  = $request->subjectsPerDay;
        $totalSubjects = $request->totalSubjects;
        return view('subject',compact('days','subjectsPerDay','totalSubjects'));
    }
    public function test(Request $request){
        $sum = 0;
        $subjects = $request->subject;
        $hours = $request->hour;
        $subject = [];
        $subjectsPerDay = $request->subjectsPerDay;
        $working_days = $request->workingDays;
        foreach ($request->subject as $key => $value) {
            if (!empty($value)) {
                $subject[$value] = $hours[$key];
                $sum+=$hours[$key];
            }
        }
        $total = $subjectsPerDay * $working_days;
        if($sum!=$total){
            return response()->json([
                'status' => 'error',
                'message' => 'Total hours enter for per subject is not matching with total hours for week'
            ]);
        }
        $timetable = "<table border='1' width='100%'>";

        for ($i = 0; $i < $subjectsPerDay; $i++) {
            $subject_keys = array_keys($subject);
            shuffle($subject_keys); // shuffle the subject keys
            $subject_count = 0;
            $timetable .= "<tr>";
            for ($j = 0; $j < $working_days; $j++) {
                $subject_key = $subject_keys[$subject_count] ?? '';
                $timetable .= "<td width='100px'>" . $subject_key . "</td>";
                $subject_count++;
                if ($subject_count >= count($subject_keys)) {
                    $subject_count = 0;
                }
                $subject[$subject_key]--;
                if ($subject[$subject_key] <= 0) {
                    unset($subject[$subject_key]);
                    $subject_keys = array_keys($subject);
                    shuffle($subject_keys); // shuffle the subject keys again
                    $subject_count = 0;
                }
            }
            $timetable .= "</tr>";
        }
    
        $timetable .= "</table>";

        return response()->json([
            'status' => 'success',
            'table' => $timetable
        ]);
    }
}
