<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb_business;

/**
 * Description of aacsb_business_section_2_standard_6
 *
 * @author ahmadgx
 */
class Aacsb_Business_Section_2_Standard_6 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 6';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_standard_name('');
            $this->set_definition('');
            $this->set_faculty_assign('');
            $this->set_performance_expectations('');
            $this->set_evaluation('');
            $this->set_orientation_processes('');
            $this->set_faculty_resources('');
            $this->set_intellectual_contributions('');
    }

    public function set_standard_name()
    {
        $property = new \Orm_Property_Fixedtext('standard_name', "<b>The school has well-documented and well-communicated processes to manage and support faculty members over the progression of their careers that are consistent with the school’s mission, expected outcomes, and strategies. [FACULTY MANAGEMENT AND SUPPORT]</b>");
        $this->set_property($property);
    }

    public function get_standard_name()
    {
        return $this->get_property('standard_name')->get_value();
    }

    public function set_definition()
    {
        $property = new \Orm_Property_Fixedtext('definition', '<strong>Basis for Judgment</strong>'
            . '<ul>'
            . '<li>Faculty management processes systematically assign faculty responsibilities to individuals. These processes fulfill the school’s mission while setting realistic expectations for individual faculty members.</li>'
            . '<li>The school communicates performance expectations to faculty members clearly and in a manner that allows timely performance.</li>'
            . '<li>Faculty assignments may reflect differences in expectations for different faculty members. However, workloads from all activities are reasonably distributed across all faculty members.</li>'
            . '<li>Faculty evaluation, promotion, and reward processes are systematic and support the school’s mission.</li>'
            . '<li>The school has effective processes for providing orientation, guidance, and mentoring to faculty.</li>'
            . '<li>The school has an overall faculty resource plan that reflects its mission and that projects faculty resource requirements and anticipated resource actions.</li>'
            . '<li>Policies guiding faculty scholarship should be clear and consistent with the mission and with expected outcomes from intellectual contributions.</li>'
            . '<li>Faculty evaluation and performance systems recognize and include intellectual contributions outcomes in the assessment of faculty performance.</li>'
            . '</ul>'
            . '<strong>Guidance for Documentation</strong>');
        $this->set_property($property);
    }

    public function get_definition()
    {
        return $this->get_property('definition')->get_value();
    }

    public function set_faculty_assign($value)
    {
        $property = new \Orm_Property_Textarea('faculty_assign', $value);
        $property->set_description('Describe processes for assigning faculty responsibilities to individuals.');
        $this->set_property($property);
    }

    public function get_faculty_assign()
    {
        return $this->get_property('faculty_assign')->get_value();
    }

    public function set_performance_expectations($value)
    {
        $property = new \Orm_Property_Textarea('performance_expectations', $value);
        $property->set_description('Describe processes for determining performance expectations for faculty.');
        $this->set_property($property);
    }

    public function get_performance_expectations()
    {
        return $this->get_property('performance_expectations')->get_value();
    }

    public function set_evaluation($value)
    {
        $property = new \Orm_Property_Textarea('evaluation', $value);
        $property->set_description('Describe evaluation, promotion, and reward processes, as well as ways that faculty are engaged in these processes.');
        $this->set_property($property);
    }

    public function get_evaluation()
    {
        return $this->get_property('evaluation')->get_value();
    }

    public function set_orientation_processes($value)
    {
        $property = new \Orm_Property_Textarea('orientation_processes', $value);
        $property->set_description('Describe processes for determining performance expectations for faculty.');
        $this->set_property($property);
    }

    public function get_orientation_processes()
    {
        return $this->get_property('orientation_processes')->get_value();
    }

    public function set_faculty_resources($value)
    {
        $property = new \Orm_Property_Textarea('faculty_resources', $value);
        $property->set_description('Describe the overall faculty resource plan.');
        $this->set_property($property);
    }

    public function get_faculty_resources()
    {
        return $this->get_property('faculty_resources')->get_value();
    }

    public function set_intellectual_contributions($value)
    {
        $property = new \Orm_Property_Textarea('intellectual_contributions', $value);
        $property->set_description('Document that intellectual contributions are incorporated into the assessment of faculty performance.');
        $this->set_property($property);
    }

    public function get_intellectual_contributions()
    {
        return $this->get_property('intellectual_contributions')->get_value();
    }

}
