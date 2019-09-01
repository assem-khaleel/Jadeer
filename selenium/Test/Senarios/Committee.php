<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 10/5/17
 * Time: 4:11 PM
 */

namespace Selenium\Test\Senarios;


use Facebook\WebDriver\WebDriverSelect;
use Selenium\Test\Core\App;
use Selenium\Test\Core\Web;

class Committee extends Signin
{

    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    public function run()
    {
        $driver = parent::run();

        $driver->get($this->getApp()->getConfig('base_url') . 'committee_work');

        $formElement = Web::findElement($driver, Web::getSelector('tag', 'form'));
        $formSelects = Web::findElements($formElement, Web::getSelector('tag', 'select'));

        $attributes = [
            'fltr[campus_id]' => '18',
            'fltr[college_id]' => '80',
            'fltr[program_id]' => '168',
        ];

        foreach ($formSelects as $formSelect) {
            $name = $formSelect->getAttribute('name');
            if(array_key_exists($name, $attributes)) {
                $select = new WebDriverSelect($formSelect);
                $select->selectByValue($attributes[$name]);
                sleep(1);
            }
        }

        Web::findElement($driver, Web::getSelector('linkText', 'Add New'))->click();

        $formElement = Web::findElement($driver, Web::getSelector('id', 'committee-form'));
        echo $formElement->getAttribute('action');
//        $formInputs = Web::findElements($formElement, Web::getSelector('tag', 'input'));
//
//        $uniq = uniqid('committee work');
//        $attributes = [
//            'title_en' => $uniq . 'en',
//            'title_ar' => $uniq . 'ar',
//            'description_en' => '168',
//        ];
//
//        foreach ($formInputs as $formInput) {
//            $name = $formInput->getAttribute('name');
//            if(array_key_exists($name, $attributes)) {
//                $formInput->sendKeys($attributes[$name]);
//            }
//        }
    }
}