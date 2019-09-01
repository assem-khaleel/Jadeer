<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\abet_eac;

/**
 * Description of criterion_7
 *
 * @author ahmadgx
 */
class Criterion_7 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'CRITERION 7. FACILITIES';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_offices();
            $this->set_office('');
            $this->set_classroom('');
            $this->set_laboratory('');
            $this->set_computing();
            $this->set_computing_resources('');
            $this->set_guidance();
            $this->set_guidance_discribtion('');
            $this->set_maintenance();
            $this->set_maintenance_facilities('');
            $this->set_library_services();
            $this->set_library_services_discribtion('');
            $this->set_overall();
            $this->set_overall_comment('');
    }

    public function set_offices()
    {
        $property = new \Orm_Property_Fixedtext('offices', '<b>A. Offices, Classrooms and Laboratories</b> <br/>Summarize each of the program’s facilities in terms of their ability to support the attainment of the student outcomes and to provide an atmosphere conducive to learning.');
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_offices()
    {
        return $this->get_property('offices')->get_value();
    }

    public function set_office($value)
    {
        $property = new \Orm_Property_Textarea('office', $value);
        $property->set_description('1. Offices (such as administrative, faculty, clerical, and teaching assistants) and any associated equipment that is typically available there.');
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_office()
    {
        return $this->get_property('office')->get_value();
    }

    public function set_classroom($value)
    {
        $property = new \Orm_Property_Textarea('classroom', $value);
        $property->set_description('2. Classrooms and associated equipment that are typically available where the program courses are taught.');
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_classroom()
    {
        return $this->get_property('classroom')->get_value();
    }

    public function set_laboratory($value)
    {
        $property = new \Orm_Property_Textarea('laboratory', $value);
        $property->set_description('3. Laboratory facilities including those containing computers (describe available hardware and software) and the associated tools and equipment that support instruction.  Include those facilities used by students in the program even if they are not dedicated to the program and state the times they are available to students.  Complete Appendix C containing a listing of the major pieces of equipment used by the program in support of instruction.');
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_laboratory()
    {
        return $this->get_property('laboratory')->get_value();
    }



    public function set_computing()
    {
        $property = new \Orm_Property_Fixedtext('computing', '<b>B. Computing Resources</b>');
        $property->set_group('group_b');
        $this->set_property($property);
    }

    public function get_computing()
    {
        return $this->get_property('computing')->get_value();
    }

    public function set_computing_resources($value)
    {
        $property = new \Orm_Property_Textarea('computing_resources', $value);
        $property->set_description('Describe any computing resources (workstations, servers, storage, networks including software) in addition to those described in the laboratories in Part A, which are used by the students in the program. Include a discussion of the accessibility of university-wide computing resources available to all students via various locations such as student housing, library, student union, off-campus, etc.  State the hours the various computing facilities are open to students.  Assess the adequacy of these facilities to support the scholarly and professional activities of the students and faculty in the program.');
        $property->set_group('group_b');
        $this->set_property($property);
    }

    public function get_computing_resources()
    {
        return $this->get_property('computing_resources')->get_value();
    }

    public function set_guidance()
    {
        $property = new \Orm_Property_Fixedtext('guidance', '<b>C. Guidance</b>');
        $property->set_group('group_c');
        $this->set_property($property);
    }

    public function get_guidance()
    {
        return $this->get_property('guidance')->get_value();
    }

    public function set_guidance_discribtion($value)
    {
        $property = new \Orm_Property_Textarea('guidance_discribtion', $value);
        $property->set_description('Describe how students in the program are provided appropriate guidance regarding the use of the tools, equipment, computing resources, and laboratories.');
        $property->set_group('group_c');
        $this->set_property($property);
    }

    public function get_guidance_discribtion()
    {
        return $this->get_property('guidance_discribtion')->get_value();
    }

    public function set_maintenance()
    {
        $property = new \Orm_Property_Fixedtext('maintenance', '<b>D. Maintenance and Upgrading of Facilities</b>');
        $property->set_group('group_d');
        $this->set_property($property);
    }

    public function get_maintenance()
    {
        return $this->get_property('maintenance')->get_value();
    }

    public function set_maintenance_facilities($value)
    {
        $property = new \Orm_Property_Textarea('maintenance_facilities', $value);
        $property->set_description('Describe the policies and procedures for maintaining and upgrading the tools, equipment, computing resources, and laboratories used by students and faculty in the program.');
        $property->set_group('group_d');
        $this->set_property($property);
    }

    public function get_maintenance_facilities()
    {
        return $this->get_property('maintenance_facilities')->get_value();
    }

    public function set_library_services()
    {
        $property = new \Orm_Property_Fixedtext('library_services', '<b>E. Library Services</b>');
        $property->set_group('group_e');
        $this->set_property($property);
    }

    public function get_library_services()
    {
        return $this->get_property('library_services')->get_value();
    }

    public function set_library_services_discribtion($value)
    {
        $property = new \Orm_Property_Textarea('library_services_discribtion', $value);
        $property->set_description('Describe and evaluate the capability of the library (or libraries) to serve the program including the adequacy of the library’s technical collection relative to the needs of the program and the faculty, the adequacy of the process by which faculty may request the library to order books or subscriptions, the library’s systems for locating and obtaining electronic information, and any other library services relevant to the needs of the program.');
        $property->set_group('group_e');
        $this->set_property($property);
    }

    public function get_library_services_discribtion()
    {
        return $this->get_property('library_services_discribtion')->get_value();
    }

    public function set_overall()
    {
        $property = new \Orm_Property_Fixedtext('overall', '<b>F. Overall Comments on Facilities</b>');
        $property->set_group('group_f');
        $this->set_property($property);
    }

    public function get_overall()
    {
        return $this->get_property('overall')->get_value();
    }

    public function set_overall_comment($value)
    {
        $property = new \Orm_Property_Textarea('overall_comment', $value);
        $property->set_description('Describe how the program ensures the facilities, tools, and equipment used in the program are safe for their intended purposes (See the 2015-2016 APPM II.G.6.b.(1)).');
        $property->set_group('group_f');
        $this->set_property($property);
    }

    public function get_overall_comment()
    {
        return $this->get_property('overall_comment')->get_value();
    }

}
