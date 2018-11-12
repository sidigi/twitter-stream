<?php
namespace App\Service;

class TwitterService
{
    public static function addFromForm(string $data){
        $tweetId = collect(explode('/', $data))->filter()->last();

        return \App\Tweet::saveById($tweetId);
    }
}