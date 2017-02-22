<?php


class FinanceEmployeeTest extends TestCase
{
    public function testShouldReturnCreatedResponse()
    {
        $this->json('GET', '/fin/ma/1');
        assertThat($this->response->getStatusCode(), equalTo(201));
    }


    public function testAssetFlowDataStructure() {

        $this->json('PUT', '/assetFlows', array());
        $this->json('POST', '/assetFlows', array('Employee' => 'CS', 'Team' => 'XYZ', 'Amount' => 42, 'Year' => '2017', 'Month' => '02'));
        $this->json('POST', '/assetFlows', array('Employee' => 'MT', 'Team' => 'ABS', 'Amount' => 42, 'Year' => '2017', 'Month' => '02'));

        $this->json('GET', '/fin/ma/MT');
        $content = json_decode($this->response->getContent(), true);

        assertThat( 1 , count($content) );
        assertThat($content[0]['Employee'], is('MT'));
    }
}
