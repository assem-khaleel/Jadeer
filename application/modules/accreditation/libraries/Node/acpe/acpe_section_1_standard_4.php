<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_1_standard_4
 *
 * @author ahmadgx
 */
class Acpe_Section_1_Standard_4 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 4: Personal and Professional Development';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_personal_development('');
            $this->set_key('');
            $this->set_self_awareness('');
            $this->set_leadership('');
            $this->set_innovation('');
            $this->set_professionalism('');
    }

    public function set_personal_development($value)
    {
        $property = new \Orm_Property_Textarea('personal_development', $value);
        $property->set_description('The program imparts to the graduate the knowledge, skills, abilities, behaviors, and attitudes necessary to demonstrate self-awareness, leadership, innovation and entrepreneurship, and professionalism.');
        $this->set_property($property);
    }

    public function get_personal_development()
    {
        return $this->get_property('personal_development')->get_value();
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

    public function set_self_awareness($value)
    {
        $property = new \Orm_Property_Textarea('self_awareness', $value);
        $property->set_description('4.1. Self-awareness – The graduate is able to examine and reflect on personal knowledge, skills, abilities, beliefs, biases, motivation, and emotions that could enhance or limit personal and professional growth.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_self_awareness()
    {
        return $this->get_property('self_awareness')->get_value();
    }

    public function set_leadership($value)
    {
        $property = new \Orm_Property_Textarea('leadership', $value);
        $property->set_description('4.2. Leadership – The graduate is able to demonstrate responsibility for creating and achieving shared goals, regardless of position.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_leadership()
    {
        return $this->get_property('leadership')->get_value();
    }

    public function set_innovation($value)
    {
        $property = new \Orm_Property_Textarea('innovation', $value);
        $property->set_description('4.3. Innovation and entrepreneurship – The graduate is able to engage in innovative activities by using creative thinking to envision better ways of accomplishing professional goals.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_innovation()
    {
        return $this->get_property('innovation')->get_value();
    }

    public function set_professionalism($value)
    {
        $property = new \Orm_Property_Textarea('professionalism', $value);
        $property->set_description('4.4. Professionalism – The graduate is able to exhibit behaviors and values that are consistent with the trust given to the profession by patients, other healthcare providers, and society.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_professionalism()
    {
        return $this->get_property('professionalism')->get_value();
    }

}
