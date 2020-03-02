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
        '#LNGCongress2020',
        '#LNGCongress',
        '#fuellingtheindustry',
        '#bgs',
        '#BGSGroup',
        '#LNG2020',
        '#LNG6',
        '#6thInternationalLNGCongress',
        '#InternationalLNGCongress',
        '#LNGBelgium',
        '#LNGBrussels',
        '#LNGCongressBelgium',
        '#LNGCongressBrussels',
        '#LNGCongressgaladinner',
        '#galadinnerLNG',
        '#LNGgaladinner',
        '#oilandgasseries',
        '#LNGonelove',
        '#LNGinfluencers',
        '#LNGforever',
    ],

    'sponsor' => [
        'logo' => '/images/sponsor/logo.png',
    ]
];
