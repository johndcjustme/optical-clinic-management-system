<?php


use Illuminate\Support\Facades\Storage;

function storage($disk, $url) 
{
    if (!empty($url) || ($url != null)) {
        return Storage::disk($disk)->url($url); } 
    else {
        if ($disk == 'avatars') {
            return Storage::disk($disk)->url('default-user-avatar.png');
        }
        if ($disk == 'items') {
            return Storage::disk($disk)->url('default-item-image.jpg');
        }
    }
}


function avatar($url) 
{
    if (!empty($url) || ($url != NULL)) 
        return Storage::disk('avatars')->url($url); 
    else 
        return Storage::disk('avatars')->url('default-user-avatar.png'); 
}