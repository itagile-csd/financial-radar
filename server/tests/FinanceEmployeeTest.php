<?php

use App\AssetFlow;

class FinanceEmployeeTest extends TestCase
{
    public function testAssetFlowDataStructure() {

        $this->json('PUT', '/assetFlows', array());
        $this->json('POST', '/assetFlows', array('Employee' => 'CS', 'Team' => 'XYZ', 'Amount' => 42, 'Year' => '2017', 'Month' => '02'));
        $this->json('POST', '/assetFlows', array('Employee' => 'MT', 'Team' => 'ABS', 'Amount' => 42, 'Year' => '2017', 'Month' => '02'));

        $this->json('GET', '/assetFlows/ma/MT');
        $content = json_decode($this->response->getContent(), true);

        assertThat( 1 , count($content) );
        assertThat($content[0]['Employee'], is('MT'));
    }

    public function testFinanceByEmployee()
    {
        $this->json('PUT', '/assetFlows', array());
        $this->json('POST', '/assetFlows', array('Employee' => 'CS', 'Team' => 'XYZ', 'Amount' => 42, 'Year' => '2017', 'Month' => '02'));
        $this->json('POST', '/assetFlows', array('Employee' => 'MT', 'Team' => 'ABS', 'Amount' => 42, 'Year' => '2017', 'Month' => '02'));
        $this->json('POST', '/assetFlows', array('Employee' => 'MT', 'Team' => 'ABS', 'Amount' => -12, 'Year' => '2017', 'Month' => '02'));

        $this->json('GET', '/fin/ma/MT');
        $content = json_decode($this->response->getContent(), true);

        assertThat( 1 , count($content) );
        assertThat($content['Income'], is(30));

    }

    public function testFilterAssetFlowDataStructure() {
        $this->json('PUT', '/assetFlows', array());
        $this->json('POST', '/assetFlows', array('Employee' => 'CS', 'Amount' => 42, 'Year' => "2017", 'Month' => "02"));
        $this->json('POST', '/assetFlows', array('Employee' => 'MT', 'Amount' => 42, 'Year' => "2017", 'Month' => "02"));
        $this->json('POST', '/assetFlows', array('Employee' => 'MT', 'Amount' => 22, 'Year' => "2017", 'Month' => "01"));

        $this->json('GET', '/fin/ma/MT?year=2017');
        $content = $this->response->getContent();
        assertThat($content, is(64));
    }
}
