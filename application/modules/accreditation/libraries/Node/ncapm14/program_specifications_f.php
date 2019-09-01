<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncapm14;

/**
 * Description of program_specifications_f
 *
 * @author ahmadgx
 */
class Program_Specifications_F extends \Orm_Node
{

    protected $class_type = __class__;
    protected $name = 'F. Student Administration and Support';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_student_academic();
            $this->set_academic_counselling('');
            $this->set_student_appeal();
            $this->set_student_appeals('');
    }

    public function set_student_academic()
    {
        $property = new \Orm_Property_Fixedtext('student_academic', '<strong>1. Student Academic Counselling</strong>');
        $this->set_property($property);
    }

    public function get_student_academic()
    {
        return $this->get_property('student_academic')->get_value();
    }

    public function set_academic_counselling($value)
    {
        $property = new \Orm_Property_Textarea('academic_counselling', $value);
        $property->set_description('Describe arrangements for academic counselling and advising for students, including both scheduling of faculty office hours and advising on program planning, subject selection and career planning (which might be available at college level).');
        $this->set_property($property);
    }

    public function get_academic_counselling()
    {
        $this->get_property('academic_counselling')->get_value();
    }

    public function set_student_appeal()
    {
        $property = new \Orm_Property_Fixedtext('student_appeal', '<strong>2. Student Appeals</strong>');
        $this->set_property($property);
    }

    public function get_student_appeal()
    {
        return $this->get_property('student_appeal')->get_value();
    }

    public function set_student_appeals($value)
    {
        $property = new \Orm_Property_Textarea('student_appeals', $value);
        $property->set_description('Attach regulations for student appeals on academic matters, including processes for consideration of those appeals.');
        $this->set_property($property);
    }

    public function get_student_appeals()
    {
        $this->get_property('student_appeals')->get_value();
    }

}
