<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb_business;

/**
 * Description of aacsb_business_section_2_standard_7
 *
 * @author ahmadgx
 */
class Aacsb_Business_Section_2_Standard_7 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 7';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_standard_name('');
            $this->set_definition('');
            $this->set_resource_plan('');
            $this->set_professional_staff('');
            $this->set_professional_services('');
            $this->set_management_process('');
    }

    public function set_standard_name()
    {
        $property = new \Orm_Property_Fixedtext('standard_name', "<b>The school maintains and deploys professional staff and/or services sufficient to ensure quality outcomes across the range of degree programs it offers and to achieve other components of its mission. [PROFESSIONAL STAFF SUFFICIENCY AND DEPLOYMENT]</b>");
        $this->set_property($property);
    }

    public function get_standard_name()
    {
        return $this->get_property('standard_name')->get_value();
    }

    public function set_definition()
    {
        $property = new \Orm_Property_Fixedtext('definition', '<strong>Definitions</strong>'
            . '<ul>'
            . '<li>Professional staff and/or services provide direct support for learning, instructional development, the deployment and use of informational technology, the production and impact of intellectual contributions, the strategic management and advancement of the school, and other key mission components, but they do not have faculty appointments. It is not required that professional staff be permanent staff of the school or the institution.</li>'
            . '</ul><br/><br/>'
            . '<strong>Basis for Judgment</strong>'
            . '<ul>'
            . '<li>Depending on the teaching and learning models employed and the associated division of labor across faculty and professional staff, professional staff and services are sufficient to support student learning, instructional development, and information technology for degree programs.</li>'
            . '<li>Professional staff must also be sufficient to provide for intellectual contributions and their impact, student academic assistance and advising, career advising and placement, alumni relations, public relations, fundraising, student admissions, and executive education, as well as other mission expectations.</li>'
            . '<li>Processes for managing and developing professional staff and services are well-defined and effective.</li>'
            . '<li>The organizational structure of the business school is consistent with mission, expected outcomes, and strategies and supports mission achievement.</li>'
            . '<li>Student support services are sufficient and available, but may be provided by staff, faculty members, or a combination and may be located within or outside the school.</li>'
            . '</ul><br/><br/>'
            . '<strong>Guidance for Documentation</strong>');
        $this->set_property($property);
    }

    public function get_definition()
    {
        return $this->get_property('definition')->get_value();
    }

    public function set_resource_plan($value)
    {
        $property = new \Orm_Property_Textarea('resource_plan', $value);
        $property->set_description('Describe the overall resource plan related to professional staff and services, including the organization and deployment of professional staff across mission-related activities.');
        $this->set_property($property);
    }

    public function get_resource_plan()
    {
        return $this->get_property('resource_plan')->get_value();
    }

    public function set_professional_staff($value)
    {
        $property = new \Orm_Property_Textarea('professional_staff', $value);
        $property->set_description('Demonstrate that professional staff and services are sufficient to support student learning, instructional development, and information technology for degree programs.');
        $this->set_property($property);
    }

    public function get_professional_staff()
    {
        return $this->get_property('professional_staff')->get_value();
    }

    public function set_professional_services($value)
    {
        $property = new \Orm_Property_Textarea('professional_services', $value);
        $property->set_description('Show that professional staff and services are sufficient to provide for intellectual contributions and their impact, student academic assistance and advising, career advising and placement, alumni relations, public relations, fundraising, student admissions, and executive education, as well as other mission expectations, depending on the organization.');
        $this->set_property($property);
    }

    public function get_professional_services()
    {
        return $this->get_property('professional_services')->get_value();
    }

    public function set_management_process($value)
    {
        $property = new \Orm_Property_Textarea('management_process', $value);
        $property->set_description('Document management processes—including hiring practices, development, and evaluation systems for professional staff—that ensure high-quality outcomes relative to mission and strategies.');
        $this->set_property($property);
    }

    public function get_management_process()
    {
        return $this->get_property('management_process')->get_value();
    }

}
