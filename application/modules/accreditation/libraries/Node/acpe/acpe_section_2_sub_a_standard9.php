<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_2_sub_a_standard9
 *
 * @author ahmadgx
 */
class Acpe_Section_2_Sub_A_Standard9 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 9: Organizational Culture';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_college('');
            $this->set_key('');
            $this->set_leadership('');
            $this->set_behaviors('');
            $this->set_culture('');
    }

    public function set_college()
    {
        $property = new \Orm_Property_Fixedtext('college', 'The college or school provides an environment and culture that promotes self-directed lifelong learning, professional behavior, leadership, collegial relationships, and collaboration within and across academic units, disciplines, and professions.');
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

    public function set_leadership($value)
    {
        $property = new \Orm_Property_Textarea('leadership', $value);
        $property->set_description('9.1. Leadership and professionalism – The college or school demonstrates a commitment to developing professionalism and to fostering leadership in administrators, faculty, preceptors, staff, and students. Faculty and preceptors serve as mentors and positive role models for students.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_leadership()
    {
        return $this->get_property('leadership')->get_value();
    }

    public function set_behaviors($value)
    {
        $property = new \Orm_Property_Textarea('behaviors', $value);
        $property->set_description('9.2. Behaviors – The college or school has policies that define expected behaviors for administrators, faculty, preceptors, staff, and students, along with consequences for deviation from those behaviors');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_behaviors()
    {
        return $this->get_property('behaviors')->get_value();
    }

    public function set_culture($value)
    {
        $property = new \Orm_Property_Textarea('culture', $value);
        $property->set_description('9.3. Culture of collaboration – The college or school develops and fosters a culture of collaboration within subunits of the college or school, as well as within and outside the university, to advance its vision, mission, and goals, and to support the profession.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_culture()
    {
        return $this->get_property('culture')->get_value();
    }

}
