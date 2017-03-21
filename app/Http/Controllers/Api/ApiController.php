<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    protected $headers = [
        'Content-Type' => 'application/vnd.glosarium.api.v1+json',
    ];

    protected $user;

    public function __construct()
    {
        $this->middleware('jwt.auth');
    }
}
