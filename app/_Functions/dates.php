<?php

use \Carbon\Carbon;


function humanReadableDate($date) { 
    return Carbon::parse($date)->isoFormat('MMM D, YYYY'); 
}

function humanReadableDay($day) { 
    return \Carbon\Carbon::parse($day)->format('l'); 
}

function humanReadableTime($time) { 
    return isset($time) ? \Carbon\Carbon::parse($time)->format('g:i A') : ''; 
}

function tomorrow()
{
    return date("Y-m-d", strtotime('tomorrow'));
}