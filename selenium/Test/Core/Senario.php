<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 10/5/17
 * Time: 12:16 PM
 */

namespace Selenium\Test\Core;


class Senario
{
    /**
     * @var App
     */
    private $app;

    /**
     * Senario constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    /**
     * @return App
     */
    public function getApp()
    {
        return $this->app;
    }

    public function run() {
        return $this->getApp()->getWeb()->getDriver();
    }
}