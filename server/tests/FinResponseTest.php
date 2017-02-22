<?php

class FinResponseTest extends TestCase
{
    public function testShouldReturnFinGetResponse()
    {
        $this->json('GET', '/fin');

        $content = $this->response->getContent();

        $result = json_decode($content, true);

        assertThat($this->response->getStatusCode(), equalTo(200));

        assertThat(isset($result['Income_Return']), is(true));
    }

}
