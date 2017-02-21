<?php

use App\AssetFlow;

class FinanceEmployeeTest extends TestCase
{
    public function testShouldReturnCreatedResponse()
    {
        $this->json('GET', '/fin/ma/');
        assertThat($this->response->getStatusCode(), equalTo(201));
    }
}
