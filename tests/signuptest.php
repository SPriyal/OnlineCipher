<?php

use PHPUnit\Framework\TestCase;

class exampleTest extends TestCase
{
   
    public function testSignupPage(){
        $response = $this->call('POST', '/dashboard',[
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => 'test'
            'retry-password' => 'test@12345'
        ]);
        $this->assertEquals(200, $response->getStatusCode());
    }
}