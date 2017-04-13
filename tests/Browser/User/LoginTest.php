<?php

namespace Tests\Browser\User;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * Test login with user
     */
    public function testLogin()
    {
        $user = factory(\App\User::class)->make([
            'name'     => 'Browser Test',
            'email'    => 'test@email.com',
            'password' => bcrypt('secret'),
        ]);

        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'test@email.com')
                ->type('password', 'secret')
                ->press('Login')
                ->assertPathIs('/');
        });
    }
}
