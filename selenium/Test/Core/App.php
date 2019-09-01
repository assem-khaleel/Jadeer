<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 10/5/17
 * Time: 11:13 AM
 */

namespace Selenium\Test\Core;


class App
{
    private $config = [];
    private $class;
    private $web;

    public function __construct($config, $class) {
        $this->setConfigs($config);
        $this->class = $class;

        $this->web = (new Web($this));
    }

    private function setConfigs($config) {
        if(is_array($config)) {
            foreach ($config as $key => $value) {
                $this->addConfig($key, $value);
            }
        }
    }

    public function addConfig($key, $value) {
        $this->config[$key] = $value;
    }

    public function getConfig($key) {
        return isset($this->config[$key]) ? $this->config[$key] : null;
    }

    /**
     * @return Web
     */
    public function getWeb()
    {
        return $this->web;
    }

    public function run() {

        $this->getWeb()->getDriver()->get($this->getConfig('base_url'));

        $senario = new $this->class($this); /** @var $senario Senario */
        $senario->run();
    }
}