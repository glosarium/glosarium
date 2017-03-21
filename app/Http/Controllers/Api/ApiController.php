<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    protected $headers = [
        'Content-Type' => 'application/vnd.api.v1+json',
    ];
}
