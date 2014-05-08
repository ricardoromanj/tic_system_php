<?php

// This file returns the current semester

function create_date_range_array($strDateFrom,$strDateTo)
{
    $arrayRange=array();

    $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),substr($strDateFrom,8,2),substr($strDateFrom,0,4));
    $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),substr($strDateTo,8,2),substr($strDateTo,0,4));

    if ($iDateTo>=$iDateFrom)
    {
        array_push($arrayRange,date('Y-m-d',$iDateFrom));
        while ($iDateFrom<$iDateTo)
        {
            $iDateFrom+=86400; // add 24 hours
            array_push($arrayRange,date('Y-m-d',$iDateFrom));
        }
    }
    return $arrayRange;
}

function get_current_semester($con) {
    $current_semester = array();
    $query = "SELECT * FROM semester";
    $semester_result = mysqli_query($con, $query);
    while ($semester_row = mysqli_fetch_array($semester_result)) {
        if (in_array(date("Y-m-d", time()), create_date_range_array(date("Y-m-d",strtotime($semester_row['semester_begin_date'])),date("Y-m-d",strtotime($semester_row['semester_end_date'])))))
        {
            $current_semester = $semester_row;
        }
    }
    return $current_semester;
}

?>