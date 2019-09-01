<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ssr_h_courses_review
 *
 * @author ahmadgx
 */
class Ssr_H_Courses_Review extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'H. Review of Courses';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_processs('');
            $this->set_course_report();
            $this->set_course_evaluation(array());
            $this->set_conclusions('');
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
        $property = new \Orm_Property_Table_Dynamic('course_evaluation', $value);
        $property->set_description('Provide a list report on the strengths and recommendations for improvement in courses and any other conclusions from the processes described directly above.');

        $strength = new \Orm_Property_Text('strength');
        $strength->set_description('Strengths');
        $property->add_property($strength);

        $recommendation = new \Orm_Property_Text('recommendation');
        $recommendation->set_description('Recommendations for Improvement');
        $property->add_property($recommendation);

        $this->set_property($property);
    }

    public function get_course_evaluation()
    {
        return $this->get_property('course_evaluation')->get_value();
    }

   public function set_conclusions($value)
    {
        $property = new \Orm_Property_Textarea('conclusions', $value);
        $property->set_description('Conclusions');
        $this->set_property($property);
    }

    public function get_conclusions()
    {
        return $this->get_property('conclusions')->get_value();
    }
}
