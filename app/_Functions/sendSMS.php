<?php


use Nexmo\Laravel\Facade\Nexmo;

function sendSMS($to, $text)
{
    Nexmo::message()->send([
        'from' => '+639512558697',
        'to' => $to,
        'text' => $text,
    ]);
}
