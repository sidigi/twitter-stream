<?php

return [

    /*
     * To work with Twitter's Streaming API you'll need some credentials.
     *
     * If you don't have credentials yet, head over to https://apps.twitter.com/
     */

    'access_token' => env('TWITTER_ACCESS_TOKEN'),

    'access_token_secret' => env('TWITTER_ACCESS_TOKEN_SECRET'),

    'consumer_key' => env('TWITTER_CONSUMER_KEY'),

    'consumer_secret' => env('TWITTER_CONSUMER_SECRET'),

    'hash' => [
'#bgs',
'#BGSGroup',
'#PRC',
'#PRCEurope',
'#PRCEurope2023',
'#PRC2023',
'#PRCGalaDinner',
'#RefinetheIndustry',
'#WineDine&Refine',
'#RecyclingReprocessingRefining',
'#ThinkGreen'
    ],

    'sponsor' => [
        'logo' => '/images/sponsor/sponsor.png',
    ]
];
