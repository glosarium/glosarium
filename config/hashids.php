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

        'glosarium'   => [
            'salt'     => '93a7c5d4057a5e4673acf39de9f73b11d0ecdb1d',
            'length'   => '',
            'alphabet' => 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890',
        ],

        'category'    => [
            'salt'     => '5ccbf9c9c5fc1bc34df8238a97094968f38f5165',
            'length'   => '',
            'alphabet' => 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890',
        ],

        'dictionary'  => [
            'salt'     => 'f18bfb74e613afb11f36bdd80cf05cd5dfad98d6',
            'length'   => '',
            'alphabet' => 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890',
        ],

        'alternative' => [
            'salt'     => 'your-salt-string',
            'length'   => 'your-length-integer',
            'alphabet' => 'your-alphabet-string',
        ],

    ],

];
