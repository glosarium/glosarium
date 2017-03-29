<?php

namespace App\Http\Controllers\Api\Alpha;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    protected $headers = [
        'Content-Type' => 'application/vnd.glosarium.api.v1-alpha+json',
    ];

    protected $user;
}
