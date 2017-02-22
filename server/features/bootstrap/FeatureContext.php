<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

class FeatureContext extends Laravel\Lumen\Testing\TestCase implements Context
{
    /**
     * This is a template method from TestCase
     */
    public function createApplication()
    {
        return require __DIR__.'/../../bootstrap/app.php';
    }


    public function __construct()
    {
        # triggers Lumen TestCase initialization
        $this->setUp();
    }

    /**
     * @When I get the root resource
     */
    public function getRootResource()
    {
        $this->get('/');
    }

    /**
     * @Then it returns the empty string
     */
    public function verifyEmptyString()
    {
        assertThat($this->getJsonResponse(), is(nullOrEmptyString()));
    }

    function getJsonResponse()
    {
        $assoc = true;
        return json_decode($this->response->getContent(), $assoc);
    }

    /**
     * @Given multiple asset flows
     */
    public function createAssetFlows()
    {
        $this->json('PUT', '/assetFlows', array());
        $revenue = array('amount' => 1);
        $this->json('POST', '/assetFlows', $revenue);
    }

    /**
     * @When /ask for all asset flows/
     */
    public function getAllAssetFlows()
    {
        $this->get('/assetFlows');
    }

    /**
     * @Then /complete list of revenues and expenses/
     */
    public function verifyRevenuesAndExpensesExist()
    {
        assertThat($this->response->getStatusCode(), equalTo(200));
        $expectedFlows = array(array("amount" => 1));
        assertThat($this->getJsonResponse(), containsInAnyOrder($expectedFlows));
        $this->json('PUT', '/assetFlows', array());
    }
}
