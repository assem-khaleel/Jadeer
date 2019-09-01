<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 10/4/17
 * Time: 2:18 PM
 */

namespace Selenium\Test\Senarios;

use Selenium\Test\Core\App;
use Selenium\Test\Core\Web;
use Selenium\Test\Core\Senario;

/**
 * Class Signin
 * @package Selenium\Test\Senarios
 */
class Signin extends Senario
{
    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    public function run() {
        $driver = parent::run();

        $formElement = Web::findElement($driver, Web::getSelector('id', 'signin-form_id'));
        $formInputs = Web::findElements($formElement, Web::getSelector('tag', 'input'));

        $attributes = [
            'email' => 'admin@eaa.com.sa',
            'password' => '123456',
        ];

        foreach ($formInputs as $formInput) {
            $name = $formInput->getAttribute('name');
            if(array_key_exists($name, $attributes)) {
                $formInput->sendKeys($attributes[$name]);
            }
        }
        $formElement->submit();

        return $driver;
    }

}