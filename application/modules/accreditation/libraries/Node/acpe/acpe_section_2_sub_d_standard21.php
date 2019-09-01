<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_2_sub_d_standard21
 *
 * @author ahmadgx
 */
class Acpe_Section_2_Sub_D_Standard21 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 21: Physical Facilities and Educational Resources';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_college('');
            $this->set_key('');
            $this->set_facilities('');
            $this->set_physical_facilities('');
            $this->set_facilities_Attribute('');
            $this->set_educational_resources('');
            $this->set_expertise_access('');
    }

    public function set_college()
    {
        $property = new \Orm_Property_Fixedtext('college', 'The college or school has adequate and appropriately equipped physical and educational facilities to achieve its mission and goals. ');
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

    public function set_facilities($value)
    {
        $property = new \Orm_Property_Textarea('facilities', $value);
        $property->set_description('21.1. Physical facilities – The college or school’s physical facilities (or the access to other facilities) meet legal and safety standards, utilize current educational technology, and are clean and well maintained.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_facilities()
    {
        return $this->get_property('facilities')->get_value();
    }

    public function set_physical_facilities()
    {
        $property = new \Orm_Property_Fixedtext('physical_facilities', '<b>21.2. Physical facilities’ attributes – The college or school’s physical facilities also include adequate:'
            . '<ul><li>Faculty office space with sufficient privacy to permit accomplishment of responsibilities</li>'
            . '<li>Space that facilitates interaction of administrators, faculty, students, and interprofessional collaborators</li>'
            . '<li>Classrooms that comfortably accommodate the student body and that are equipped to allow for the use of required technology</li>'
            . '<li>Laboratories suitable for skills practice, demonstration, and competency evaluation</li>'
            . '<li>Access to educational simulation capabilities</li>'
            . '<li>Faculty research laboratories with well-maintained equipment including research support services within the college or school and the university</li>'
            . '<li>Animal facilities that meet care regulations (if applicable)</li>'
            . '<li>Individual and group student study space and student meeting facilities</li></ul></b>');

        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_physical_facilities()
    {
        return $this->get_property('physical_facilities')->get_value();
    }

    public function set_facilities_Attribute($value)
    {
        $property = new \Orm_Property_Textarea('facilities_Attribute', $value);
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_facilities_Attribute()
    {
        return $this->get_property('facilities_Attribute')->get_value();
    }

    public function set_educational_resources($value)
    {
        $property = new \Orm_Property_Textarea('educational_resources', $value);
        $property->set_description('21.3. Educational resource access – The college or school makes available technological access to current scientific literature and other academic and educational resources by students, faculty, and preceptors.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_educational_resources()
    {
        return $this->get_property('educational_resources')->get_value();
    }

    public function set_expertise_access($value)
    {
        $property = new \Orm_Property_Textarea('expertise_access', $value);
        $property->set_description('21.4 Librarian expertise access – The college or school has access to librarian resources with the expertise needed to work with students, faculty, and preceptors on effective literature and database search and retrieval strategies.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_expertise_access()
    {
        return $this->get_property('expertise_access')->get_value();
    }

}
