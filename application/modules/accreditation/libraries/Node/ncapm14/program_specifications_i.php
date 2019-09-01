<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncapm14;

/**
 * Description of program_specifications_i
 *
 * @author ahmadgx
 */
class Program_Specifications_I extends \Orm_Node
{

    protected $class_type = __class__;
    protected $name = 'I. Program Evaluation and Improvement Processes';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_effectivness('');
            $this->set_qa_processes('');
            $this->set_faculty_skills('');
            $this->set_overall_program();
            $this->set_student('');
            $this->set_advisors('');
            $this->set_stakeholders('');
            $this->set_attachment();
            $this->set_regulation('');
            $this->set_specifications('');
    }

    public function set_effectivness()
    {
        $property = new \Orm_Property_Fixedtext('effectivness', '<strong>1. Effectiveness of Teaching</strong>');
        $this->set_property($property);
    }

    public function get_effectivness()
    {
        return $this->get_property('effectivness')->get_value();
    }

    public function set_qa_processes($value)
    {
        $property = new \Orm_Property_Textarea('qa_processes', $value);
        $property->set_description('a. What QA processes are used to evaluate and improve the strategies for developing learning outcomes in the different domains of learning?');
        $this->set_property($property);
    }

    public function get_qa_processes()
    {
        return $this->get_property('qa_processes')->get_value();
    }

    public function set_faculty_skills($value)
    {
        $property = new \Orm_Property_Textarea('faculty_skills', $value);
        $property->set_description('b. What processes are used for evaluating the skills of faculty and teaching staff in using the planned strategies?');
        $this->set_property($property);
    }

    public function get_faculty_skills()
    {
        return $this->get_property('faculty_skills')->get_value();
    }

    public function set_overall_program()
    {
        $property = new \Orm_Property_Fixedtext('overall_program', '<strong>2. Overall Program Evaluation</strong> <br/> <br/>'
            . 'a. What strategies are used in the program for obtaining assessments of the overall quality of the program and achievement of its intended learning outcomes:');
        $this->set_property($property);
    }

    public function get_overall_program()
    {
        return $this->get_property('overall_program')->get_value();
    }

    public function set_student($value)
    {
        $property = new \Orm_Property_Textarea('student', $value);
        $property->set_description('(i) From current students and graduates of the program?');
        $this->set_property($property);
    }

    public function get_student()
    {
        return $this->get_property('student')->get_value();
    }

    public function set_advisors($value)
    {
        $property = new \Orm_Property_Textarea('advisors', $value);
        $property->set_description('(ii) From independent advisors and/or evaluator(s)?');

        $this->set_property($property);
    }

    public function get_advisors()
    {
        return $this->get_property('advisors')->get_value();
    }

    public function set_stakeholders($value)
    {
        $property = new \Orm_Property_Textarea('stakeholders', $value);
        $property->set_description('(iii) From employers, Advisory Committee, and/or other stakeholders');
        $this->set_property($property);
    }

    public function get_stakeholders()
    {
        return $this->get_property('stakeholders')->get_value();
    }

    public function set_attachment()
    {
        $property = new \Orm_Property_Fixedtext('attachment', '<strong>Attachments:</strong>');
        $this->set_property($property);
    }

    public function get_attachment()
    {
        return $this->get_property('attachment')->get_value();
    }

    public function set_regulation($value)
    {
        $property = new \Orm_Property_Upload('regulation', $value);
        $property->set_description('1. Copies of regulations and other documents referred to in template preceded by a table of contents.');
        $this->set_property($property);
    }

    public function get_regulation()
    {
        return $this->get_property('regulation')->get_value();
    }

    public function set_specifications($value)
    {
        $property = new \Orm_Property_Upload('specifications', $value);
        $property->set_description('2. Course specifications for all program courses including field experience specification if applicable.');
        $this->set_property($property);
    }

    public function get_specifications()
    {
        return $this->get_property('specifications')->get_value();
    }

}
