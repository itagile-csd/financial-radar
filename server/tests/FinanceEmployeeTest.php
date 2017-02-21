<?php

use App\AssetFlow;

class FinanceEmployeeTest extends TestCase
{
    public function testShouldReturnCreatedResponse()
    {
        $this->json('GET', '/fin/ma/1');
        assertThat($this->response->getStatusCode(), equalTo(201));
    }


    public function testAssetFlowDataStructure() {

        $this->json('PUT', '/assetFlows', array());
        $this->json('POST', '/assetFlows', array('EmployeeID' => 'CS', 'Type' => 'User', 'amount' => 42, 'Date' => time()));
        $this->json('POST', '/assetFlows', array('EmployeeID' => 'MT', 'Type' => 'User', 'amount' => 42, 'Date' => time()));

        $this->json('GET', '/fin/ma/MT');
        $content = json_decode($this->response->getContent(), true);

        assertThat( 1 , count($content) );
        assertThat($content[0]['EmployeeID'], is('MT'));
    }
}
