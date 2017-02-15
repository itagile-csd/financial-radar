<?php

class PostAssetFlowsResponseTest extends TestCase
{
    public function testShouldReturnCreatedResponse()
    {
        $this->json('POST', '/assetFlows', array('amount' => 10));
        assertThat($this->response->getStatusCode(), equalTo(201));
    }
}
