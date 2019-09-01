<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_2_sub_a_standard7
 *
 * @author ahmadgx
 */
class Acpe_Section_2_Sub_A_Standard7 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 7: Strategic Plan';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_college('');
            $this->set_key('');
            $this->set_process('');
            $this->set_resources('');
            $this->set_planning('');
    }

    public function set_college()
    {
        $property = new \Orm_Property_Fixedtext('college', 'The college or school develops, utilizes, assesses, and revises on an ongoing basis a strategic plan that includes tactics to advance its vision, mission, and goals.');
        $this->set_property($property);
    }

    public function get_college()
    {
        return $this->get_property('college')->get_value();
    }

    public function set_key()
    {
        $property = new \Orm_Property_Fixedtext('key', '<b>Key Element:</b>');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_key()
    {
        return $this->get_property('key')->get_value();
    }

    public function set_process($value)
    {
        $property = new \Orm_Property_Textarea('process', $value);
        $property->set_description('7.1. Inclusive process – The strategic plan is developed through an inclusive process, including faculty, staff, students, preceptors, practitioners, and other relevant constituents, and is disseminated in summary form to key stakeholders.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_process()
    {
        return $this->get_property('process')->get_value();
    }

    public function set_resources($value)
    {
        $property = new \Orm_Property_Textarea('resources', $value);
        $property->set_description('7.2. Appropriate resources – Elements within the strategic plan are appropriately resourced and have the support of the university administration as needed for implementation.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_resources()
    {
        return $this->get_property('resources')->get_value();
    }

    public function set_planning($value)
    {
        $property = new \Orm_Property_Textarea('planning', $value);
        $property->set_description('7.3. Substantive change planning – Substantive programmatic changes contemplated by the college or school are linked to its ongoing strategic planning process.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_planning()
    {
        return $this->get_property('planning')->get_value();
    }

}
