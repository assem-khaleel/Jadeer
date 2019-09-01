<?php
/**
 * Created by PhpStorm.
 * User: miral
 * Date: 10/11/17
 * Time: 11:54 AM
 */

namespace Selenium\Test\Senarios\TeamFormation;

use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverBy;
use Selenium\Test\Core\App;
use Selenium\Test\Senarios\Signin;

class InviteMembers extends Signin
{
    public function __construct(App $app)
    {
        parent::__construct($app);
    }
    public function run() {
        $driver = parent::run();

        $driver->get($this->getApp()->getConfig('base_url') . 'team_formation/manage');

        $a_tags = $driver->findElements(WebDriverBy::cssSelector('a'));
        foreach ($a_tags as $a){
            if(strpos($a->getAttribute("data-toggle") , "ajaxModal") !== false){
                $a->click();
                break;
            }
        }
        $users = $driver->findElements(WebDriverBy::id('refresh_users'));



        return $driver;
    }

}