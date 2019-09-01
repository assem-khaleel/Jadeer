<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\abet_etac;

/**
 * Description of criterion_1
 *
 * @author ahmadgx
 */
class Criterion_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'CRITERION 1. STUDENTS';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info('');
            $this->set_student('');
            $this->set_student_admission('');
            $this->set_evaluation('');
            $this->set_student_evaluation('');
            $this->set_transfer('');
            $this->set_student_and_course('');
            $this->set_advising('');
            $this->set_advising_and_career('');
            $this->set_courses('');
            $this->set_work_in_lieu('');
            $this->set_graduation('');
            $this->set_graduation_requirements('');
            $this->set_transcripts('');
            $this->set_recent_graduates('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'For the sections below, attach any written policies that apply.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_student()
    {
        $property = new \Orm_Property_Fixedtext('student', '<b>A. Student Admissions</b>');
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_student()
    {
        return $this->get_property('student')->get_value();
    }

    public function set_student_admission($value)
    {
        $property = new \Orm_Property_Textarea('student_admission', $value);
        $property->set_description('Summarize the requirements and process for accepting new students into the program.');
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_student_admission()
    {
        return $this->get_property('student_admission')->get_value();
    }

    public function set_evaluation()
    {
        $property = new \Orm_Property_Fixedtext('evaluation', '<b>B. Evaluating Student Performance</b>');
        $property->set_group('group_b');
        $this->set_property($property);
    }

    public function get_evaluation()
    {
        return $this->get_property('evaluation')->get_value();
    }

    public function set_student_evaluation($value)
    {
        $property = new \Orm_Property_Textarea('student_evaluation', $value);
        $property->set_description('Summarize the process by which student performance is evaluated and student progress is monitored.  Include information on how the program ensures and documents that students are meeting prerequisites and how it handles the situation when a prerequisite has not been met.');
        $property->set_group('group_b');
        $this->set_property($property);
    }

    public function get_student_evaluation()
    {
        return $this->get_property('student_evaluation')->get_value();
    }

    public function set_transfer()
    {
        $property = new \Orm_Property_Fixedtext('transfer', '<b>C. Transfer Students and Transfer Courses</b>');
        $property->set_group('group_c');
        $this->set_property($property);
    }

    public function get_transfer()
    {
        return $this->get_property('transfer')->get_value();
    }

    public function set_student_and_course($value)
    {
        $property = new \Orm_Property_Textarea('student_and_course', $value);
        $property->set_description('Summarize the requirements and process for accepting transfer students and transfer credit.  Include any state-mandated articulation requirements that impact the program');
        $property->set_group('group_c');
        $this->set_property($property);
    }

    public function get_student_and_course()
    {
        return $this->get_property('student_and_course')->get_value();
    }

    public function set_advising()
    {
        $property = new \Orm_Property_Fixedtext('advising', '<b>D. Advising and Career Guidance</b>');
        $property->set_group('group_d');
        $this->set_property($property);
    }

    public function get_advising()
    {
        return $this->get_property('advising')->get_value();
    }

    public function set_advising_and_career($value)
    {
        $property = new \Orm_Property_Textarea('advising_and_career', $value);
        $property->set_description('Summarize the process for advising and providing career guidance to students.  Include information on how often students are advised, who provides the advising (program faculty, departmental, college or university advisor).');
        $property->set_group('group_d');
        $this->set_property($property);
    }

    public function get_advising_and_career()
    {
        return $this->get_property('advising_and_career')->get_value();
    }

    public function set_courses()
    {
        $property = new \Orm_Property_Fixedtext('courses', '<b>E. Work in Lieu of Courses</b>');
        $property->set_group('group_e');
        $this->set_property($property);
    }

    public function get_courses()
    {
        return $this->get_property('courses')->get_value();
    }

    public function set_work_in_lieu($value)
    {
        $property = new \Orm_Property_Textarea('work_in_lieu', $value);
        $property->set_description('Summarize the requirements and process for awarding credit for work in lieu of courses.  This could include such things as life experience, Advanced Placement, dual enrollment, test out, military experience, etc');
        $property->set_group('group_e');
        $this->set_property($property);
    }

    public function get_work_in_lieu()
    {
        return $this->get_property('work_in_lieu')->get_value();
    }

    public function set_graduation()
    {
        $property = new \Orm_Property_Fixedtext('graduation', '<b>F. Graduation Requirements</b>');
        $property->set_group('group_f');
        $this->set_property($property);
    }

    public function get_graduation()
    {
        return $this->get_property('graduation')->get_value();
    }

    public function set_graduation_requirements($value)
    {
        $property = new \Orm_Property_Textarea('graduation_requirements', $value);
        $property->set_description('Summarize the graduation requirements for the program and the process for ensuring and documenting that each graduate completes all graduation requirements for the program.  State the name of the degree awarded (Master of Science in Safety Sciences, Bachelor of Technology, Bachelor of Science in Computer Science, Bachelor of Science in Electrical Engineering, etc.)');
        $property->set_group('group_f');
        $this->set_property($property);
    }

    public function get_graduation_requirements()
    {
        return $this->get_property('graduation_requirements')->get_value();
    }

    public function set_transcripts()
    {
        $property = new \Orm_Property_Fixedtext('transcripts', '<b>G. Transcripts of Recent Graduates</b>');
        $property->set_group('group_g');
        $this->set_property($property);
    }

    public function get_transcripts()
    {
        return $this->get_property('transcripts')->get_value();
    }

    public function set_recent_graduates($value)
    {
        $property = new \Orm_Property_Textarea('recent_graduates', $value);
        $property->set_description('The program will provide transcripts from some of the most recent graduates to the visiting team along with any needed explanation of how the transcripts are to be interpreted.  These transcripts will be requested separately by the team chair.  State how the program and any program options are designated on the transcript.  (See 2015-2016 APPM, Section II.G.4.a.)');
        $property->set_group('group_g');
        $this->set_property($property);
    }

    public function get_recent_graduates()
    {
        return $this->get_property('recent_graduates')->get_value();
    }

}
