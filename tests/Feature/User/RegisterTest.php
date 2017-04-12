<?php

namespace Tests\Feature\User;

use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * Register form
     */
    public function testRegisterForm()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }
}
