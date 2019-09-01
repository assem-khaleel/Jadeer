<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 10/5/17
 * Time: 11:24 AM
 */

namespace Facebook\WebDriver;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

require_once('../vendor/autoload.php');

// start Firefox with 5 second timeout
$host = 'http://localhost:4444/wd/hub'; // this is the default
$capabilities = DesiredCapabilities::chrome();
$driver = RemoteWebDriver::create($host, $capabilities, 5000);

// navigate to 'http://www.seleniumhq.org/'
$driver->get('http://jplus.local');

// adding cookie
$driver->manage()->deleteAllCookies();
$cookie = new Cookie('ci_session', 'nrrfc1fvul86lg1kqlveheonbakca4le');
$driver->manage()->addCookie($cookie);
$cookie = new Cookie('csrf_cookie_name', '2327350d809546721adf1b083b0be826');
$driver->manage()->addCookie($cookie);
//
$driver->findElement(WebDriverBy::cssSelector('[name=email]'))->sendKeys('admin@eaa.com.sa');
sleep(1);
$driver->findElement(WebDriverBy::cssSelector('[name=password]'))->sendKeys('123456');
sleep(1);
$driver->findElement(WebDriverBy::cssSelector('[type=submit]'))->click();