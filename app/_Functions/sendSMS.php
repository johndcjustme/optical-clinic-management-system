<?php

use Nexmo\Laravel\Facade\Nexmo;

function sendSMS($to, $text)
{
    Nexmo::message()->send([
        'from' => 'Dango Optical Clinic',
        'to' => $to,
        'text' => $text,
    ]);
}
