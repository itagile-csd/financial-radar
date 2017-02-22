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
}
