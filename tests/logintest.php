<?php

use PHPUnit\Framework\TestCase;

class exampleTest extends TestCase
{
    public function testsomething()
    {
        $this->assertEquals(0,0);
    }

   
    public function testLoginPage(){
        $response = $this->call('POST', '/dashboard',[
            'email' => 'test@gmail.com',
            'password' => 'test'
        ]);
        $this->assertEquals(200, $response->getStatusCode());
    }
}