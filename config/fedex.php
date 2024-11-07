<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Mailer
    |--------------------------------------------------------------------------
    |
    | This option controls the default mailer that is used to send any email
    | messages sent by your application. Alternative mailers may be setup
    | and used as needed; however, this mailer will be used by default.
    |
    */

    'client_id' => env('FEDEX_CLIENT_ID'),
    'secret_id' => env('FEDEX_CLIENT_SECRET'),
    'account_number' => env('FEDEX_ACCOUNT_NUMBER'),
    'mode' => env('FEDEX_MODE'),

   

];
