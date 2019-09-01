<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 10/4/17
 * Time: 2:53 PM
 */

namespace Selenium\Test\Core;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\RemoteWebElement;
use Facebook\WebDriver\WebDriverBy;

class Web
{

    private $host = 'http://localhost:4444/wd/hub';

    private $driver;

    public function __construct()
    {
        $this->driver = $this->initWebDriver();
    }

    private function initWebDriver() {
        $capabilities = DesiredCapabilities::chrome();
        return RemoteWebDriver::create($this->host, $capabilities, 5000);
    }

    /**
     * @return RemoteWebDriver
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * @param $type
     * @param $value
     * @return WebDriverBy
     */
    public static function getSelector($type, $value) {
        switch ($type) {
            case 'tag':
                $webDriverBy = WebDriverBy::tagName($value);
                break;
            case 'linkText':
                $webDriverBy = WebDriverBy::linkText($value);
                break;
            default:
                $webDriverBy = WebDriverBy::id($value);
                break;
        }

        return $webDriverBy;
    }

    /**
     * @param $element
     * @param WebDriverBy $webBy
     * @return RemoteWebElement
     */
    public static function findElement($element, WebDriverBy $webBy) {

        if(method_exists($element, 'findElement')) {
            return $element->findElement($webBy);
        }

        return null;
    }

    /**
     * @param $element
     * @param WebDriverBy $webBy
     * @return RemoteWebElement[]
     */
    public static function findElements($element, WebDriverBy $webBy) {
        if(method_exists($element, 'findElements')) {
            return $element->findElements($webBy);
        }

        return [];
    }
}