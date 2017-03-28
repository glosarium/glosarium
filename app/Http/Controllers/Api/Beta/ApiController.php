<?php

namespace App\Http\Controllers\Api\Beta;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    protected $headers = [
        'Content-Type' => 'application/vnd.glosarium.api.v2-beta+json',
    ];

    protected $user;
}
