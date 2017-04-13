<?php

namespace Tests\Unit;

use App\Libraries\Wikipedia;
use Tests\TestCase;

class WikipediaTest extends TestCase
{

    /**
     * Ping to Wikipedia
     */
    public function testPing()
    {
        $wikipedia = new Wikipedia;

        return $this->assertTrue($wikipedia->ping());
    }

    /**
     * Page is exists
     */
    public function testExists()
    {
        $wikipedia = new Wikipedia;
        $response = $wikipedia->openSearch('data');

        return $this->assertTrue(!$response->isEmpty());
    }

    /**
     * Page is empty or not found
     */
    public function testEmpty()
    {
        $wikipedia = new Wikipedia;
        $response = $wikipedia->openSearch('Imma not exists');

        return $this->assertTrue($response->isEmpty());
    }
}
