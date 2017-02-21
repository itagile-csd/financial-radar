<?php

class PostAssetFlowsResponseTest extends TestCase
{

    public function testShouldReturnCreatedResponse()
    {
        $this->json('POST', '/assetFlows', array('amount' => 10));
        assertThat($this->response->getStatusCode(), equalTo(201));
    }

    public function testSavingSingleDataset(){
        $this->json('PUT', '/assetFlows', array());

        $this->json('POST', '/assetFlows', array('EmployeeID' => 'AW', 'Type' => 'User', 'amount' => 42, 'Date' => time()));

        $this->json('GET', '/assetFlows');
        $content = json_decode($this->response->getContent(), true);

        assertThat($content[0]['EmployeeID'], is('AW'));
    }

    public function testSavingMultipleDataset(){
        $this->json('PUT', '/assetFlows', array());

        $this->json('POST', '/assetFlows', array('EmployeeID' => 'AW', 'Type' => 'User', 'amount' => 42, 'Date' => time()));
        $this->json('POST', '/assetFlows', array('EmployeeID' => 'ML', 'Type' => 'User', 'amount' => 700, 'Date' => time()));

        $this->json('GET', '/assetFlows');
        $content = json_decode($this->response->getContent(), true);

        assertThat(count($content), is(2));
        assertThat($content[0]['EmployeeID'], is('AW'));
        assertThat($content[1]['EmployeeID'], is('ML'));
    }
}
