<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of ssri_d_context_of_the_self_study
 *
 * @author ahmadgx
 */
class Ssri_D_Context_Of_The_Self_Study extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'D. Context of the Self Study';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_environmental('');
            $this->set_environmental_context('');
            $this->set_institutional('');
            $this->set_institutional_context('');
    }

    public function set_environmental()
    {
        $property = new \Orm_Property_Fixedtext('environmental', '<strong>1. Environmental Context.</strong>');
        $this->set_property($property);
    }

    public function get_environmental()
    {
        return $this->get_property('environmental')->get_value();
    }

    public function set_environmental_context($value)
    {
        $property = new \Orm_Property_Textarea('environmental_context', $value);
        $property->set_description('Provide a summary of significant elements of the external environment in which the institution is operating and changes that have occurred recently or are expected to occur (e.g. economic or social developments, population changes, government policies, developments at other institutions with implications for this institution’s programs). ');
        $this->set_property($property);
    }

    public function get_environmental_context()
    {
        return $this->get_property('environmental_context')->get_value();
    }

    public function set_institutional()
    {
        $property = new \Orm_Property_Fixedtext('institutional', '<strong>2. Institutional Context.</strong>');
        $this->set_property($property);
    }

    public function get_institutional()
    {
        return $this->get_property('institutional')->get_value();
    }

    public function set_institutional_context($value)
    {
        $property = new \Orm_Property_Textarea('institutional_context', $value);
        $property->set_description('Provide a brief summary of recent developments at the institution with implications for the review.');
        $this->set_property($property);
    }

    public function get_institutional_context()
    {
        return $this->get_property('institutional_context')->get_value();
    }

}
