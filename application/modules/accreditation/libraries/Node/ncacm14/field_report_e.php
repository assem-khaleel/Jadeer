<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncacm14;

/**
 * Description of Field_Report_E
 *
 * @author user
 */
class Field_Report_E extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'E.  Evaluation of Field Experience Activity';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_student_evalaution('');
            $this->set_student_evaluation_report('');
            $this->set_important_recommendations('');
            $this->set_response_of_instructor('');
            $this->set_other_evaluation('');
            $this->set_other_evaluation_report('');
            $this->set_important_recommendations2('');
            $this->set_response_of_instructor2('');
    }

    public function set_student_evalaution($value)
    {
        $property = new \Orm_Property_Text('student_evalaution', $value);
        $property->set_description('1. Student evaluation of the field experience.');
        $this->set_property($property);
    }

    public function get_student_evalaution()
    {
        return $this->get_property('student_evalaution')->get_value();
    }

    public function set_student_evaluation_report($value)
    {
        $property = new \Orm_Property_Textarea('student_evaluation_report', $value);
        $property->set_description('Attach summary of survey results');
        $this->set_property($property);
    }

    public function get_student_evaluation_report()
    {
        return $this->get_property('student_evaluation_report')->get_value();
    }

    public function set_important_recommendations($value)
    {
        $property = new \Orm_Property_Textarea('important_recommendations', $value);
        $property->set_description('a. List the most important recommendations for improvement and strengths');
        $this->set_property($property);
    }

    public function get_important_recommendations()
    {
        return $this->get_property('important_recommendations')->get_value();
    }

    public function set_response_of_instructor($value)
    {
        $property = new \Orm_Property_Textarea('response_of_instructor', $value);
        $property->set_description('b. Response of instructor and field staff to this evaluation');
        $this->set_property($property);
    }

    public function get_response_of_instructor()
    {
        return $this->get_property('response_of_instructor')->get_value();
    }

    public function set_other_evaluation($value)
    {
        $property = new \Orm_Property_Textarea('other_evaluation', $value);
        $property->set_description('2. Other Evaluation (e.g. by head of department, peer observations, accreditation review, other stakeholders)');
        $this->set_property($property);
    }

    public function get_other_evaluation()
    {
        return $this->get_property('other_evaluation')->get_value();
    }

    public function set_other_evaluation_report($value)
    {
        $property = new \Orm_Property_Upload('other_evaluation_report', $value);
        $property->set_description('Attach summary of survey results');
        $this->set_property($property);
    }

    public function get_other_evaluation_report()
    {
        return $this->get_property('other_evaluation_report')->get_value();
    }

    public function set_important_recommendations2($value)
    {
        $property = new \Orm_Property_Textarea('important_recommendations2', $value);
        $property->set_description('a. List the most important recommendations for improvement and strengths');
        $this->set_property($property);
    }

    public function get_important_recommendations2()
    {
        return $this->get_property('important_recommendations2')->get_value();
    }

    public function set_response_of_instructor2($value)
    {
        $property = new \Orm_Property_Textarea('response_of_instructor2', $value);
        $property->set_description('b. Response of instructor and field staff to this evaluation');
        $this->set_property($property);
    }

    public function get_response_of_instructor2()
    {
        return $this->get_property('response_of_instructor2')->get_value();
    }

//    public function header_actions(&$actions = array())
//    {
//        if (\Orm::get_ci()->config->item('integration_enabled')) {
//            if ($this->check_if_editable()) {
//                $actions[] = array(
//                    'class' => 'btn',
//                    'title' => '<i class="fa fa-database"></i> ' . lang('Integration'),
//                    'extra' => 'onclick="integration(this, ' . $this->get_id() . ');" ' . data_loading_text(true) . ' title="Extraction of data from other modules"'
//                );
//            }
//        }
//        return parent::header_actions($actions);
//    }

}
