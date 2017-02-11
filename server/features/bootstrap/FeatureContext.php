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
     * @Then it says hi
     */
    public function verifyGreeting()
    {
        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }
}
