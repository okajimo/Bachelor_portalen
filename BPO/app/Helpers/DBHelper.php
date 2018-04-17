<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\input;

Class DBHelper
{
    public static function studIGruppe($number, $year)
    {
        $student = DB::select('select student_groups.student from student_groups, groups 
        where groups.group_number = student_groups.student_groups_number and groups.year = student_groups_year 
        and student_groups.student_groups_number LIKE :number and student_groups.student_groups_year LIKE :year', 
        ['number' => $number, 'year' => $year]);

        return $student;
    }
}
?>