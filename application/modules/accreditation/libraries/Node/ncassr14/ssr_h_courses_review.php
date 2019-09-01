<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ssr_h_courses_review
 *
 * @author ahmadgx
 */
class Ssr_H_Courses_Review extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'H. Review of Course ';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_processs('');
            $this->set_course_report('');
            $this->set_course_evaluation('');
    }

    public function set_processs($value)
    {
        $property = new \Orm_Property_Textarea('processs', $value);
        $property->set_description('1. Describe the processes followed in reviewing courses (e.g. Surveys of graduates, faculty, or members of the profession, analysis of student course evaluations, review of course and program reports, interviews with faculty, comparison with similar programs elsewhere, consultancy advice, etc.).');
        $this->set_property($property);
    }

    public function get_processs()
    {
        return $this->get_property('processs')->get_value();
    }

    public function set_course_report()
    {
        $property = new \Orm_Property_Fixedtext('course_report', '<strong>2. Course Evaluations</strong>');
        $this->set_property($property);
    }

    public function get_course_report()
    {
        return $this->get_property('course_report')->get_value();
    }

    public function set_course_evaluation($value)
    {
        $property = new \Orm_Property_Textarea('course_evaluation', $value);
        $property->set_description('Provide a list report on the strengths and recommendations for improvement in courses and any other conclusions from the processes described directly above.');
        $this->set_property($property);
    }

    public function get_course_evaluation()
    {
        return $this->get_property('course_evaluation')->get_value();
    }

}
