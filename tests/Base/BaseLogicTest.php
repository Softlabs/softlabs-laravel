<?php

use Softlabs\Base\Logic;
use Softlabs\Base\Repository;
use Mockery as m;
use Illuminate\Support\Facades\Facade;
/**
 * This test case will attempt to create a sample dashboard and
 * check that the correct methods and properties exist
 * within the class.
 */

require_once(__DIR__.'/DashboardLogic.php');
require_once(__DIR__.'/UserRepository.php');

class BaseLogicTest extends Orchestra\Testbench\TestCase
{

    /**
     * Called when the dashboard test should construct itself.
     */
    public function __construct()
    {

        parent::__construct();
    }

    /**
    * Setup the test environment.
    */
    public function setUp()
    {
        parent::setUp();

        //View Mock
        $app = $this->createApplication();

        Illuminate\Support\Facades\Facade::setFacadeApplication($app);

        Illuminate\Support\Facades\App::swap($app);


        $collection = m::mock('Illuminate\Support\Collection')->makePartial();

        $this->dashboard = new DashboardLogic($collection);

    }

    public function tearDown()
    {
        m::close();
        unset($this->app);
    }

    public function testIsLogic()
    {
        $this->assertEquals(true, $this->dashboard instanceof Logic);
    }

    public function testRepository()
    {

        $this->dashboard->addRepository('UserRepository');

        $this->asserTtrue($this->dashboard->getRepository('UserRepository') instanceof Repository);
    }

}