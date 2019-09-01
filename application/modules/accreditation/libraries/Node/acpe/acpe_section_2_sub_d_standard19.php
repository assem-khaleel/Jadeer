<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_2_sub_d_standard19
 *
 * @author ahmadgx
 */
class Acpe_Section_2_Sub_D_Standard19 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 19: Faculty and Staff—Qualitative Factors';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_faculty('');
            $this->set_key('');
            $this->set_educational_effectiveness('');
            $this->set_scholarly_productivity('');
            $this->set_service_commitment('');
            $this->set_practice('');
            $this->set_faculty_development('');
            $this->set_policy_application('');
    }

    public function set_faculty()
    {
        $property = new \Orm_Property_Fixedtext('faculty', 'Faculty and staff have academic and professional credentials and expertise commensurate with their responsibilities to the professional program and their academic rank.');
        $this->set_property($property);
    }

    public function get_faculty()
    {
        return $this->get_property('faculty')->get_value();
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

    public function set_educational_effectiveness($value)
    {
        $property = new \Orm_Property_Textarea('educational_effectiveness', $value);
        $property->set_description('19.1. Educational effectiveness – Faculty members have the capability and demonstrate a continuous commitment to be effective educators and are able to effectively use contemporary educational techniques to promote student learning in all offered pathways.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_educational_effectiveness()
    {
        return $this->get_property('educational_effectiveness')->get_value();
    }

    public function set_scholarly_productivity($value)
    {
        $property = new \Orm_Property_Textarea('scholarly_productivity', $value);
        $property->set_description('19.2. Scholarly productivity – The college or school creates an environment that both requires and promotes scholarship and also develops mechanisms to assess both the quantity and quality of faculty scholarly productivity.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_scholarly_productivity()
    {
        return $this->get_property('scholarly_productivity')->get_value();
    }

    public function set_service_commitment($value)
    {
        $property = new \Orm_Property_Textarea('service_commitment', $value);
        $property->set_description('19.3. Service commitment – In the aggregate, faculty engage in professional, institutional, and community service that advances the program and the profession of pharmacy.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_service_commitment()
    {
        return $this->get_property('service_commitment')->get_value();
    }

    public function set_practice($value)
    {
        $property = new \Orm_Property_Textarea('practice', $value);
        $property->set_description('19.4. Practice understanding – Faculty members, regardless of their discipline, have a conceptual understanding of and commitment to advancing current and proposed future pharmacy practice.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_practice()
    {
        return $this->get_property('practice')->get_value();
    }

    public function set_faculty_development($value)
    {
        $property = new \Orm_Property_Textarea('faculty_development', $value);
        $property->set_description('19.5. Faculty/staff development – The college or school provides opportunities for career and professional development of its faculty and staff, individually and collectively, to enhance their role-related skills, scholarly productivity, and leadership.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_faculty_development()
    {
        return $this->get_property('faculty_development')->get_value();
    }

    public function set_policy_application($value)
    {
        $property = new \Orm_Property_Textarea('policy_application', $value);
        $property->set_description('19.6. Policy application – The college or school ensures that policies and procedures for faculty and staff recruitment, performance review, promotion, tenure (if applicable), and retention are applied in a consistent manner.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_policy_application()
    {
        return $this->get_property('policy_application')->get_value();
    }

}
