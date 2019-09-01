<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncapm14;

/**
 * Description of program_specifications_h
 *
 * @author ahmadgx
 */
class Program_Specifications_H extends \Orm_Node
{

    protected $class_type = __class__;
    protected $name = 'H. Faculty and other Teaching Staff';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_appointment();
            $this->set_appointments('');
            $this->set_program_planning();
            $this->set_processes('');
            $this->set_advisory_committee('');
            $this->set_professional();
            $this->set_skills('');
            $this->set_research('');
            $this->set_teaching_staff();
            $this->set_orientation('');
            $this->set_part_time();
            $this->set_summary('');
    }

    public function set_appointment()
    {
        $property = new \Orm_Property_Fixedtext('appointment', '<strong>1. Appointments</strong>');
        $this->set_property($property);
    }

    public function get_appointment()
    {
        return $this->get_property('appointment')->get_value();
    }

    public function set_appointments($value)
    {
        $property = new \Orm_Property_Textarea('appointments', $value);
        $property->set_description('Summarize the process of employment of new faculty and teaching staff to ensure that they are appropriately qualified and experienced for their teaching responsibilities.');
        $this->set_property($property);
    }

    public function get_appointments()
    {
        $this->get_property('appointments')->get_value();
    }

    public function set_program_planning()
    {
        $property = new \Orm_Property_Fixedtext('program_planning', '<strong>2. Participation in Program Planning, Monitoring and Review</strong>');

        $this->set_property($property);
    }

    public function get_program_planning()
    {
        return $this->get_property('program_planning')->get_value();
    }

    public function set_processes($value)
    {
        $property = new \Orm_Property_Textarea('processes', $value);
        $property->set_description('a. Explain the process for consultation with and involvement of teaching staff in monitoring program quality, annual review and planning for improvement.');
        $this->set_property($property);
    }

    public function get_processes()
    {
        $this->get_property('processes')->get_value();
    }

    public function set_advisory_committee($value)
    {
        $property = new \Orm_Property_Textarea('advisory_committee', $value);
        $property->set_description('b. Explain the process of the Advisory Committee (if applicable)');
        $this->set_property($property);
    }

    public function get_advisory_committee()
    {
        $this->get_property('advisory_committee')->get_value();
    }

    public function set_professional()
    {
        $property = new \Orm_Property_Fixedtext('professional', '<strong>3. Professional Development</strong> <br/> <br/><strong>What arrangements are made for professional development of faculty and teaching staff for:</strong>');
        $this->set_property($property);
    }

    public function get_professional()
    {
        return $this->get_property('professional')->get_value();
    }

    public function set_skills($value)
    {
        $property = new \Orm_Property_Textarea('skills', $value);
        $property->set_description('a. Improvement of skills in teaching and student assessment?');
        $this->set_property($property);
    }

    public function get_skills()
    {
        $this->get_property('skills')->get_value();
    }

    public function set_research($value)
    {
        $property = new \Orm_Property_Textarea('research', $value);
        $property->set_description('b. Other professional development including knowledge of research and developments in their field of teaching specialty?');
        $this->set_property($property);
    }

    public function get_research()
    {
        $this->get_property('research')->get_value();
    }

    public function set_teaching_staff()
    {
        $property = new \Orm_Property_Fixedtext('teaching_staff', '<strong>4. Preparation of New Faculty and Teaching Staff</strong>');
        $this->set_property($property);
    }

    public function get_teaching_staff()
    {
        $this->get_property('teaching_staff')->get_value();
    }

    public function set_orientation($value)
    {
        $property = new \Orm_Property_Textarea('orientation', $value);
        $property->set_description('Describe the process used for orientation and induction of new, visiting or part time teaching staff to ensure full understanding of the program and the role of the course(s) they teach as components within it.');
        $this->set_property($property);
    }

    public function get_orientation()
    {
        $this->get_property('orientation')->get_value();
    }

    public function set_part_time()
    {
        $property = new \Orm_Property_Fixedtext('part_time', '<strong>5. Part Time and Visiting Faculty and Teaching Staff</strong>');
        $this->set_property($property);
    }

    public function get_part_time()
    {
        $this->get_property('part_time')->get_value();
    }

    public function set_summary($value)
    {
        $property = new \Orm_Property_Textarea('summary', $value);
        $property->set_description('Provide a summary of Program/Department/ College/institution policy on appointment of part time and visiting teaching staff. (ie. Approvals required, selection process, proportion of total teaching staff etc.)');
        $this->set_property($property);
    }

    public function get_summary()
    {
        $this->get_property('summary')->get_value();
    }

}
