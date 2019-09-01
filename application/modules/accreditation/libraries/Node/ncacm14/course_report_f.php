<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncacm14;

/**
 * Description of course_report_course_evaluation
 *
 * @author ahmadgx
 */
class Course_Report_F extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'F. Course Evaluation';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_course_evaluation('');
            $this->set_student_evaluation_report('');
            $this->set_improvement_and_strength('');
            $this->set_course_team('');

            $this->set_other_course_evaluation('');
            $this->set_other_evaluation_report('');
            $this->set_other_evaluation_improvement('');
            $this->set_other_evaluation_course_team('');
    }

    /*
     * student evaluation
     */

    public function set_course_evaluation($value)
    {
        $property = new \Orm_Property_Textarea('course_evaluation', $value);
        $property->set_description('1. Student evaluation of the course');
        $this->set_property($property);
    }

    public function get_course_evaluation()
    {
        return $this->get_property('course_evaluation')->get_value();
    }

    public function set_student_evaluation_report($value)
    {
        $property = new \Orm_Property_Upload('student_evaluation_report', $value);
        $property->set_description('Attach survey results report');
        $this->set_property($property);
    }

    public function get_student_evaluation_report()
    {
        return $this->get_property('student_evaluation_report')->get_value();
    }

    public function set_improvement_and_strength($value)
    {
        $property = new \Orm_Property_Textarea('improvement_and_strength', $value);
        $property->set_description("a. List the most important recommendations for improvement and strengths");
        $this->set_property($property);
    }

    public function get_improvement_and_strength()
    {
        return $this->get_property('improvement_and_strength')->get_value();
    }

    public function set_course_team($value)
    {
        $property = new \Orm_Property_Textarea('course_team', $value);
        $property->set_description("b. Response of instructor or course team to this evaluation");
        $this->set_property($property);
    }

    public function get_course_team()
    {
        return $this->get_property('course_team')->get_value();
    }

    /*
     * other evaluation
     */

    public function set_other_course_evaluation($value)
    {
        $property = new \Orm_Property_Textarea('other_course_evaluation', $value);
        $property->set_description('2. Other Evaluation (e.g. by head of department, peer observations, accreditation review, other stakeholders)');
        $this->set_property($property);
    }

    public function get_other_course_evaluation()
    {
        return $this->get_property('other_course_evaluation')->get_value();
    }

    public function set_other_evaluation_report($value)
    {
        $property = new \Orm_Property_Upload('other_evaluation_report', $value);
        $property->set_description('Attach survey results report');
        $this->set_property($property);
    }

    public function get_other_evaluation_report()
    {
        return $this->get_property('other_evaluation_report')->get_value();
    }

    public function set_other_evaluation_improvement($value)
    {
        $property = new \Orm_Property_Textarea('other_evaluation_improvement', $value);
        $property->set_description("a. List the most important  recommendations for improvement and strengths");
        $this->set_property($property);
    }

    public function get_other_evaluation_improvement()
    {
        return $this->get_property('other_evaluation_improvement')->get_value();
    }

    public function set_other_evaluation_course_team($value)
    {
        $property = new \Orm_Property_Textarea('other_evaluation_course_team', $value);
        $property->set_description("b. Response of instructor or course team to this evaluation");
        $this->set_property($property);
    }

    public function get_other_evaluation_course_team()
    {
        return $this->get_property('other_evaluation_course_team')->get_value();
    }

//    public function header_actions(&$actions = array())
//    {

//        $shared_node = $this->get_shared_node();
//        if ($shared_node->get_id() && (get_class($shared_node) == __CLASS__) && $this->check_if_editable()) {
//            $actions[] = array(
//                'class' => 'btn',
//                'title' => '<i class="fa fa-share-alt"></i> ' . lang('Get Shared'),
//                'extra' => 'onclick="integration(this, ' . $this->get_id() . ');" ' . data_loading_text(true)
//            );
//        }
//
//        if ($this->check_if_editable()) {
//            $actions[] = array(
//                'class' => 'btn',
//                'title' => '<i class="fa fa-database"></i> ' . lang('Integration'),
//                'extra' => 'onclick="integration(this, ' . $this->get_id() . ');" ' . data_loading_text(true) . ' title="Extraction of data from other modules"'
//            );
//        }
//
//        return parent::header_actions($actions);
//    }

}
