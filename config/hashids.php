<?php

/*
 * This file is part of Laravel Hashids.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
     */

    'default'     => 'word',

    /*
    |--------------------------------------------------------------------------
    | Hashids Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
     */

    'connections' => [

        'word'        => [
            'salt'     => '93a7c5d4057a5e4673acf39de9f73b11d0ecdb1d',
            'length'   => '',
            'alphabet' => 'qwertyuiopasdfghjklzxcvbnm',
        ],

        'alternative' => [
            'salt'     => 'your-salt-string',
            'length'   => 'your-length-integer',
            'alphabet' => 'your-alphabet-string',
        ],

    ],

];
