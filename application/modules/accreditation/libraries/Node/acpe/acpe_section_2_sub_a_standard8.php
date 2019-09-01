<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_2_sub_a_standard8
 *
 * @author ahmadgx
 */
class Acpe_Section_2_Sub_A_Standard8 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 8: Organization and Governance';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_college('');
            $this->set_key('');
            $this->set_leadership('');
            $this->set_qualified_dean('');
            $this->set_qualified_team('');
            $this->set_responsibilities('');
            $this->set_resource('');
            $this->set_university_governance('');
            $this->set_faculty('');
            $this->set_system_failures('');
            $this->set_alternate_pathway('');
    }

    public function set_college()
    {
        $property = new \Orm_Property_Fixedtext('college', 'The college or school is organized and staffed to advance its vision and facilitate the accomplishment of its mission and goals.');
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
        $property->set_description('8.1. Leadership collaboration – University leadership and the college or school dean collaborate to advance the program’s vision and mission and to meet ACPE accreditation standards. The dean has direct access to the university administrator(s) with ultimate responsibility for the program.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_leadership()
    {
        return $this->get_property('leadership')->get_value();
    }

    public function set_qualified_dean($value)
    {
        $property = new \Orm_Property_Textarea('qualified_dean', $value);
        $property->set_description('8.2. Qualified dean – The dean is qualified to provide leadership in pharmacy professional education and practice, research and scholarship, and professional and community service.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_qualified_dean()
    {
        return $this->get_property('qualified_dean')->get_value();
    }

    public function set_qualified_team($value)
    {
        $property = new \Orm_Property_Textarea('qualified_team', $value);
        $property->set_description('8.3. Qualified administrative team – The dean and other college or school administrative leaders have credentials and experience that have prepared them for their respective roles and collectively have the needed backgrounds to effectively manage the educational program.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_qualified_team()
    {
        return $this->get_property('qualified_team')->get_value();
    }

    public function set_responsibilities($value)
    {
        $property = new \Orm_Property_Textarea('responsibilities', $value);
        $property->set_description("8.4. Dean’s other substantial administrative responsibilities – If the dean is assigned other substantial administrative responsibilities, the university ensures adequate resources to support the effective administration of the affairs of the college or school.");
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_responsibilities()
    {
        return $this->get_property('responsibilities')->get_value();
    }

    public function set_resource($value)
    {
        $property = new \Orm_Property_Textarea('resource', $value);
        $property->set_description('8.5. Authority, collegiality, and resources – The college or school administration has defined lines of authority and responsibility, fosters organizational unit collegiality and effectiveness, and allocates resources appropriately.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_resource()
    {
        return $this->get_property('resource')->get_value();
    }

    public function set_university_governance($value)
    {
        $property = new \Orm_Property_Textarea('university_governance', $value);
        $property->set_description('8.6. College or school participation in university governance – College or school administrators and faculty are effectively represented in the governance of the university, in accordance with its policies and procedures.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_university_governance()
    {
        return $this->get_property('university_governance')->get_value();
    }

    public function set_faculty($value)
    {
        $property = new \Orm_Property_Textarea('faculty', $value);
        $property->set_description('8.7. Faculty participation in college or school governance – The college or school uses updated, published documents, such as bylaws, policies, and procedures, to ensure faculty participation in the governance of the college or school.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_faculty()
    {
        return $this->get_property('faculty')->get_value();
    }

    public function set_system_failures($value)
    {
        $property = new \Orm_Property_Textarea('system_failures', $value);
        $property->set_description('8.8. Systems failures – The college or school has comprehensive policies and procedures that address potential systems failures, including technical, administrative, and curricular failures.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_system_failures()
    {
        return $this->get_property('system_failures')->get_value();
    }

    public function set_alternate_pathway($value)
    {
        $property = new \Orm_Property_Textarea('alternate_pathway', $value);
        $property->set_description('8.9. Alternate pathway equitability* – The college or school ensures that any alternative pathways to the Doctor of Pharmacy degree are equitably resourced and integrated into the college or school’s regular administrative structures, policies, and procedures, including planning, oversight, and evaluation.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_alternate_pathway()
    {
        return $this->get_property('alternate_pathway')->get_value();
    }

}
