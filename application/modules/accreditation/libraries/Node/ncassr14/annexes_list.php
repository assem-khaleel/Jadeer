<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of annexes_list
 *
 * @author ahmadgx
 */
class Annexes_List extends \Orm_Node {

    protected $class_type = __CLASS__;
    protected $name = '';

    protected $link_pdf = true;
    protected $link_edit = true;
    protected $link_view = true;

    function init() {
        parent::init();

            $this->set_standard(0);
            $this->set_annexes('');
    }

    public function set_standard($value) {
        $property = new \Orm_Property_Hidden('standard', $value);
        $this->set_property($property);
    }

    public function get_standard() {
        return $this->get_property('standard')->get_value();
    }

    public function set_annexes($value) {
        $property = new \Orm_Property_Textarea('annexes', $value);
        $this->set_property($property);
    }

    public function get_annexes() {
        return $this->get_property('annexes')->get_value();
    }

}
