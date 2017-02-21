<?php

class PostAssetFlowsResponseTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->json('PUT', '/assetFlows', array());
        $this->json('POST', '/assetFlows', array('EmployeeID' => 'AW', 'Type' => 'User', 'Amount' => 42, 'Date' => time()));
    }

    public function testShouldReturnCreatedResponse()
    {
        assertThat($this->response->getStatusCode(), equalTo(201));
    }

    public function testSavingSingleDataset()
    {
        $this->json('GET', '/assetFlows');
        $content = json_decode($this->response->getContent(), true);

        assertThat($content[0]['EmployeeID'], is('AW'));
    }

    public function testSavingMultipleDataset()
    {
        $this->json('POST', '/assetFlows', array('EmployeeID' => 'ML', 'Type' => 'User', 'Amount' => 700, 'Date' => time()));

        $this->json('GET', '/assetFlows');
        $content = json_decode($this->response->getContent(), true);

        assertThat(count($content), is(2));
        assertThat($content[0]['EmployeeID'], is('AW'));
        assertThat($content[1]['EmployeeID'], is('ML'));
    }
}
