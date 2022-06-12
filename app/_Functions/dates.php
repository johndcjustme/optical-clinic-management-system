<?php

use \Carbon\Carbon;



date_default_timezone_set("Asia/Manila");


function notificationTime($date) {
    $carbon = Carbon::parse($date);
    return $carbon->isoFormat('MMM D') . ', ' . $carbon->format('g:i A'); 
}

function humanReadableDate($date) { 
    return Carbon::parse($date)->isoFormat('MMM D, YYYY'); 
}

function humanReadableDay($day) { 
    return \Carbon\Carbon::parse($day)->format('l'); 
}

function humanReadableTime($time) { 
    return isset($time) ? \Carbon\Carbon::parse($time)->format('g:i A') : ''; 
}

function getTomorrow()
{
    return date("Y-m-d", strtotime('tomorrow'));
}

function getYesterday()
{
    return date("Y-m-d", strtotime("yesterday"));
}

function getToday()
{
    return date("Y-m-d");
}