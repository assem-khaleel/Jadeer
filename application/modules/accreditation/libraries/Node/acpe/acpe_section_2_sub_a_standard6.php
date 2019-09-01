<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_2_sub_a_standard6
 *
 * @author ahmadgx
 */
class Acpe_Section_2_Sub_A_Standard6 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 6: College or School Vision, Mission, and Goals';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_college('');
            $this->set_key('');
            $this->set_college_mission('');
            $this->set_commtiment('');
            $this->set_education('');
            $this->set_initiative('');
            $this->set_goals('');
    }

    public function set_college()
    {
        $property = new \Orm_Property_Fixedtext('college', 'The college or school publishes statements of its vision, mission, and goals.');
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

    public function set_college_mission($value)
    {
        $property = new \Orm_Property_Textarea('college_mission', $value);
        $property->set_description('6.1. College or school vision and mission – These statements are compatible with the vision and mission of the university in which the college or school operates.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_college_mission()
    {
        return $this->get_property('college_mission')->get_value();
    }

    public function set_commtiment($value)
    {
        $property = new \Orm_Property_Textarea('commtiment', $value);
        $property->set_description('6.2. Commitment to educational outcomes – The mission statement is consistent with a commitment to the achievement of the Educational Outcomes (Standards 1–4).');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_commtiment()
    {
        return $this->get_property('commtiment')->get_value();
    }

    public function set_education($value)
    {
        $property = new \Orm_Property_Textarea('education', $value);
        $property->set_description('6.3. Education, scholarship, service, and practice – The statements address the college or school’s commitment to professional education, research and scholarship, professional and community service, pharmacy practice, and continuing professional development.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_education()
    {
        return $this->get_property('education')->get_value();
    }

    public function set_initiative($value)
    {
        $property = new \Orm_Property_Textarea('initiative', $value);
        $property->set_description('6.4. Consistency of initiatives – All program initiatives are consistent with the college or school’s vision, mission, and goals.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_initiative()
    {
        return $this->get_property('initiative')->get_value();
    }

    public function set_goals($value)
    {
        $property = new \Orm_Property_Textarea('goals', $value);
        $property->set_description('6.5. Subunit goals and objectives alignment – If the college or school organizes its faculty into subunits, the subunit goals are aligned with those of the college or school.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_goals()
    {
        return $this->get_property('goals')->get_value();
    }

}
