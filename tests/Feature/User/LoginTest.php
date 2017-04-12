<?php

namespace Tests\Feature\User;

use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * Login form
     */
    public function testLoginForm()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
}
