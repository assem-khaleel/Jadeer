<?php
/**
 * Created by PhpStorm.
 * User: miral
 * Date: 10/9/17
 * Time: 9:53 AM
 */

namespace Selenium\Test\Senarios;

use Selenium\Test\Core\App;
use Selenium\Test\Core\Web;
use Selenium\Test\Core\Senario;


class TeamFormation extends Signin
{
    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    public function run() {

        $driver = parent::run();

        $driver->get($this->getApp()->getConfig('base_url') . 'team_formation/add_edit');

        $formElement = Web::findElement($driver, Web::getSelector('tag', 'form'));
        $formInputs = Web::findElements($formElement, Web::getSelector('tag', 'input'));
        $form_text_input = Web::findElements($formElement, Web::getSelector('tag', 'iframe'));
        $attributes = [
            'name_en' => 'name_en',
            'name_ar' => 'name_ar',
            'description_en' => 'description_en',
            'description_ar' => 'description_ar',
            'policies_en' => 'policies_en',
            'policies_ar' => 'policies_ar',
        ];
        foreach ($formInputs as $formInput) {
            $name = $formInput->getAttribute('name');
            if(array_key_exists($name, $attributes)) {
                $formInput->sendKeys($attributes[$name]);
            }
        }
//        $tinymce = [
//            'description_en_ifr' => 'description_en',
//            'description_ar_ifr' => 'description_ar',
//            'policies_en_ifr' => 'policies_en',
//            'policies_ar_ifr' => 'policies_ar',
//        ];
//        foreach ($form_text_input as $ifram_input) {
//            $ids = $ifram_input->getAttribute('id');
//            if(array_key_exists($ids, $tinymce)) {
//                $tecxt_input = Web::findElements($ifram_input, Web::getSelector('tag', 'body'));
//                $tecxt_input->sendKeys($tinymce[$ids]);
//            }
//        }
        $formElement->submit();

        return $driver;
    }
}