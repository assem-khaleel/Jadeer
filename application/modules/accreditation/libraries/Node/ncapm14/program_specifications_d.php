<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncapm14;

/**
 * Description of program_specifications_d
 *
 * @author ahmadgx
 */
class Program_Specifications_D extends \Orm_Node
{

    protected $class_type = __class__;
    protected $name = 'D. Program Structure and Organization';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            /* 1 */
            $this->set_program_description();
            /* curriculum_study */
            $this->set_curriculum_study_plan_levels(array());
            /* 2 */
            $this->set_required_filed();
            $this->set_experience_activity('');
            $this->set_field_experience('');
            $this->set_time_allocation('');
            $this->set_credit_hours_2('');
            /* 3 */
            $this->set_required_research();
            $this->set_project_summery('');
            $this->set_a_description('');
            $this->set_major_learning_outcomes('');
            $this->set_stages('');
            $this->set_credit_hours_3('');
            $this->set_academic_advising('');
            $this->set_assessment_procedures('');
            /* 4 */
            $this->set_outcomes_and_assessment_method();
            $this->set_national_qualification(array());
            $this->set_program_learning_outcome();
            /* Knowledge */
            $this->set_program_outcomes_knowledge(array());
            /* Cognitive Skills */
            $this->set_program_outcomes_cognitive_skills(array());
            /* Interpersonal Skills and Responsibility */
            $this->set_program_outcomes_interpersonal_skills(array());
            /* Communication, Information Technology, Numerical */
            $this->set_program_outcomes_communication(array());
            /* Psychomotor */
            $this->set_program_outcomes_psychomotor(array());
            /* 5 */
            $this->set_required_admition();
            $this->set_handbook('');
            /* 6 */
            $this->set_attendance_requrement();
            $this->set_handbooks('');
    }

    /*
     * 1. Program Description
     */

    public function set_program_description()
    {
        $property = new \Orm_Property_Fixedtext('program_description', 'Program Description:  List the core and elective program courses offered each semester from Prep Year to graduation using the below Curriculum Study Plan Table (A separate table is required for each branch IF a given branch offers a different study plan) <br/> <br/>'
            . '<div style="border: 1px solid black; padding: 6px;">'
            . 'A program or department manual should be available for students or other stakeholders and a copy of the information relating to this program should be attached to the program specification. This information should include required and elective courses, credit hour requirements and department/college and institution requirements, and details of courses to be taken in each year or semester.'
            . '</div> <br/> <br/>'
            . '<strong>Curriculum Study Plan Table <br/>*  Prerequisite</strong> – list course code numbers that are required prior to taking this course.');
        $this->set_property($property);
    }

    public function get_program_description()
    {
        return $this->get_property('program_description')->get_value();
    }

    public function set_curriculum_study_plan_levels($value)
    {

        $property_add_more = new \Orm_Property_Add_More('curriculum_study_plan_levels', $value);
//        $property_add_more->set_group('set_curriculum_study_plan');

        $level = new \Orm_Property_Text('level');
        $level->set_description('Level');
        $property_add_more->add_property($level);

        $property = new \Orm_Property_Table_Dynamic('curriculum_study_plan', $value);
        $property->set_is_responsive(true);

        $course_code = new \Orm_Property_Text('course_code');
        $course_code->set_description('Course Code');
        $course_code->set_width(100);
        $property->add_property($course_code);

        $course_title = new \Orm_Property_Text('course_title');
        $course_title->set_description('Course Title');
        $course_title->set_width(200);
        $property->add_property($course_title);

        $required_or_elective = new \Orm_Property_Radio('required_or_elective');
        $required_or_elective->set_description('Required or Elective');
        $required_or_elective->set_width(100);
        $required_or_elective->set_options(array('Required', 'Elective'));
        $property->add_property($required_or_elective);

        $prerequired_or_elective = new \Orm_Property_Text('prerequired_or_elective');
        $prerequired_or_elective->set_description('Pre- Requisite Courses');
        $prerequired_or_elective->set_width(200);
        $property->add_property($prerequired_or_elective);

        $credit_houre = new \Orm_Property_Text('credit_houre');
        $credit_houre->set_description('Credit Hours');
        $credit_houre->set_width(100);
        $property->add_property($credit_houre);

        $college_or_department = new \Orm_Property_Text('college_or_department');
        $college_or_department->set_description('College or Department');
        $college_or_department->set_width(200);
        $property->add_property($college_or_department);

        $property_add_more->add_property($property);

        $this->set_property($property_add_more);
    }

    public function get_curriculum_study_plan_levels()
    {
        return $this->get_property('curriculum_study_plan_levels')->get_value();
    }

    /*
     * 
     * 2. Required Field Experience Component
     */

    public function set_required_filed()
    {
        $property = new \Orm_Property_Fixedtext('required_filed', '<strong>2. Required Field Experience Component (if any)  (Eg. internship, cooperative program, work experience).</strong> <br/> <br/>'
            . 'Summary of practical, clinical or internship component required in the program. Note:  see Field Experience Specification');
        $this->set_property($property);
    }

    public function get_required_filed()
    {
        return $this->get_property('required_filed')->get_value();
    }

    public function set_experience_activity($value)
    {
        $property = new \Orm_Property_Textarea('experience_activity', $value);
        $property->set_description('a. Brief description of field experience activity');
        $this->set_property($property);
    }

    public function get_experience_activity()
    {
        return $this->get_property('experience_activity')->get_value();
    }

    public function set_field_experience($value)
    {
        $property = new \Orm_Property_Textarea('field_experience', $value);
        $property->set_description('b. At what stage or stages in the program does the field experience occur? (eg. year, semester)');
        $this->set_property($property);
    }

    public function get_field_experience()
    {
        return $this->get_property('field_experience')->get_value();
    }

    public function set_time_allocation($value)
    {
        $property = new \Orm_Property_Text('time_allocation', $value);
        $property->set_description('c. Time allocation and scheduling arrangement. (eg. 3 days per week for 4 weeks, full time for one semester)');
        $this->set_property($property);
    }

    public function get_time_allocation()
    {
        return $this->get_property('time_allocation')->get_value();
    }

    public function set_credit_hours_2($value)
    {
        $property = new \Orm_Property_Text('credit_hours_2', $value);
        $property->set_description('d. Number of credit hours (if any)');
        $this->set_property($property);
    }

    public function get_credit_hours_2()
    {
        return $this->get_property('credit_hours_2')->get_value();
    }

    /*
     * 3. Project or Research Requirements
     */

    public function set_required_research()
    {
        $property = new \Orm_Property_Fixedtext('required_research', '<strong>3. Project or Research Requirements (if any)</strong>');
        $this->set_property($property);
    }

    public function get_required_research()
    {
        return $this->get_property('required_research')->get_value();
    }

    public function set_project_summery($value)
    {
        $property = new \Orm_Property_Upload('project_summery', $value);
        $property->set_description('Summary of any project or thesis requirement in the program. (Other than projects or assignments within individual courses) (A copy of the requirements for the project should be attached.)');
        $this->set_property($property);
    }

    public function get_project_summery()
    {
        return $this->get_property('project_summery')->get_value();
    }

    public function set_a_description($value)
    {
        $property = new \Orm_Property_Textarea('a_description', $value);
        $property->set_description('a. Brief description');
        $this->set_property($property);
    }

    public function get_a_description()
    {
        return $this->get_property('a_description')->get_value();
    }

    public function set_major_learning_outcomes($value)
    {
        $property = new \Orm_Property_Textarea('major_learning_outcomes', $value);
        $property->set_description('b. List the major intended learning outcomes of the project or research task.');
        $this->set_property($property);
    }

    public function get_major_learning_outcomes()
    {
        return $this->get_property('major_learning_outcomes')->get_value();
    }

    public function set_stages($value)
    {
        $property = new \Orm_Property_Text('stages', $value);
        $property->set_description('c. At what stage or stages in the program is the project or research undertaken? (eg. level)');
        $this->set_property($property);
    }

    public function get_stages()
    {
        return $this->get_property('stages')->get_value();
    }

    public function set_credit_hours_3($value)
    {
        $property = new \Orm_Property_Text('credit_hours_3', $value);
        $property->set_description('d. Number of credit hours (if any)');
        $this->set_property($property);
    }

    public function get_credit_hours_3()
    {
        return $this->get_property('credit_hours_3')->get_value();
    }

    public function set_academic_advising($value)
    {
        $property = new \Orm_Property_Textarea('academic_advising', $value);
        $property->set_description('e. Description of academic advising and support mechanisms provided for students to complete the project');
        $this->set_property($property);
    }

    public function get_academic_advising()
    {
        return $this->get_property('academic_advising')->get_value();
    }

    public function set_assessment_procedures($value)
    {
        $property = new \Orm_Property_Textarea('assessment_procedures', $value);
        $property->set_description('f. Description of assessment procedures (including mechanism for verification of standards)');
        $this->set_property($property);
    }

    public function get_assessment_procedures()
    {
        return $this->get_property('assessment_procedures')->get_value();
    }

    /*
     * 4. Learning Outcomes in Domains of Learning, Assessment Methods and Teaching Strategy
     */

    public function set_outcomes_and_assessment_method()
    {
        $property = new \Orm_Property_Fixedtext('outcomes_and_assessment_method', '<strong>4. Learning Outcomes in Domains of Learning, Assessment Methods and Teaching Strategy</strong> <br/> <br/>'
            . 'Program Learning Outcomes, Assessment Methods, and Teaching Strategy work together and are aligned. They are joined together as one, coherent, unity that collectively articulate a consistent agreement between student learning and teaching. <br/> <br/>'
            . '<i>The <strong>National Qualification Framework</strong> (NQF) provides five learning domains. Learning outcomes are required in the first four domains and some programs may also require the Psychomotor Domain</i> <br/> <br/>'
            . '<strong>On the table below are the five NQF Learning Domains, numbered in the left column.</strong> <br/>'
            . '<strong>First</strong>, insert the suitable and measurable learning outcomes required in each of the learning domains. '
            . '<strong>Second</strong>, insert supporting teaching strategies that fit and align with the assessment methods and intended learning outcomes.'
            . '<strong>Third</strong>, insert appropriate assessment methods that accurately measure and evaluate the learning outcome. Each program learning outcomes, assessment method, and teaching strategy ought to reasonably fit and flow together as an integrated learning and teaching process.');
        $this->set_property($property);
    }

    public function get_outcomes_and_assessment_method()
    {
        return $this->get_property('outcomes_and_assessment_method')->get_value();
    }

    public function set_national_qualification($value)
    {

        $nqf_property = new \Orm_Property_Table_Dynamic('national_qualifications', $value);

        $code = new \Orm_Property_Text('code');
        $code->set_description('Code #');
        $code->set_width(50);
        $nqf_property->add_property($code);

        $learning_domain = new \Orm_Property_Textarea('learning_outcome');
        $learning_domain->set_description('Learning Outcomes');
        $learning_domain->set_enable_tinymce(0);
        $learning_domain->set_width(200);
        $nqf_property->add_property($learning_domain);

        $teaching_strategies = new \Orm_Property_Textarea('teaching_strategies');
        $teaching_strategies->set_description('Teaching Strategies');
        $teaching_strategies->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $teaching_strategies->set_width(200);
        $nqf_property->add_property($teaching_strategies);

        $assessment_methods = new \Orm_Property_Textarea('assessment_methods');
        $assessment_methods->set_description('Assessment Methods');
        $assessment_methods->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $assessment_methods->set_width(200);
        $nqf_property->add_property($assessment_methods);

        $property = new \Orm_Property_Table('national_qualification', $value);
        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('text', '<i> 1.0 </i>', 'Knowledge'));
        $property->add_cell(2, 1, $nqf_property);
        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('text', '<i> 2.0 </i>', 'Cognitive Skills'));
        $property->add_cell(4, 1, $nqf_property);
        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('text', '<i> 3.0 </i>', 'Interpersonal Skills and Responsibility'));
        $property->add_cell(6, 1, $nqf_property);
        $property->add_cell(7, 1, new \Orm_Property_Fixedtext('text', '<i> 4.0 </i>', 'Communication, Information Technology, Numerical'));
        $property->add_cell(8, 1, $nqf_property);
        $property->add_cell(9, 1, new \Orm_Property_Fixedtext('text', '<i> 5.0 </i>', 'Psychomotor'));
        $property->add_cell(10, 1, $nqf_property);

        $this->set_property($property);
    }

    public function get_national_qualification()
    {
        return $this->get_property('national_qualification')->get_value();
    }

    public function generate_ams_national_qualification(&$ams_form = array(), $ams_file = null, $class_type = null)
    {

        $national_qualification = $this->get_property('national_qualification');
        /** @var $national_qualification \Orm_Property_Table */

        $ams_table = array();
        $domain = '';

        $index = 0;
        for ($row = 1; $row <= count($national_qualification->get_cells()); $row++) {
            for ($column = 1; $column <= count($national_qualification->get_cells($row)); $column++) {
                $get_national_qualifications = $national_qualification->get_cell_property($row, $column);
                /** @var $get_national_qualifications \Orm_Property_Table_Dynamic */

                if ($get_national_qualifications instanceof \Orm_Property_Table_Dynamic) {
                    if ($get_national_qualifications->get_value()) {
                        foreach ($get_national_qualifications->get_value() as $key => $value) {

                            if ($get_national_qualifications->get_properties() && $value) {
                                foreach ($get_national_qualifications->get_properties() as $name => $property) {
                                    $property->set_value($get_national_qualifications->get_specific_value($key, $name));
                                    $property->generate_ams_property($ams_table[$index], $ams_file, $class_type);
                                }

                                $ams_table[$index][4] = array(
                                    'type' => 'simple',
                                    'field' => $national_qualification->get_ams_id($ams_file, $class_type, 'learning_domain'),
                                    'value' => $domain
                                );
                            }

                            $index++;
                        }
                    }
                } else {
                    /** @var $get_national_qualifications \Orm_Property_Fixedtext */
                    $domain = $get_national_qualifications->get_description();
                }
            }
        }

        $ams_form[] = array(
            'type' => 'table_dynamic',
            'field' => $national_qualification->get_ams_id($ams_file, $class_type),
            'value' => $ams_table
        );
    }

    public function set_program_learning_outcome()
    {
        $property = new \Orm_Property_Fixedtext('program_learning_outcome', '<strong> Program Learning Outcomes Mapping Matrix</strong> <br/>'
            . 'Identify on the table below the courses that are required to achieve the program learning outcomes. Insert the program learning outcomes, according to the level of instruction, from the above table below and indicate the courses and levels that are required to teach each one; use your program’s course numbers across the top and the following level scale.  <div><strong>Levels: </strong><ul><li>I = Introduction</li><li>P = Proficient</li><li>A = Advanced</li></ul></div>(see help icon)');
        $this->set_property($property);
    }

    public function get_program_learning_outcome()
    {
        return $this->get_property('program_learning_outcome')->get_value();
    }

    private $course_options = array();
    private function get_course_options() {

        if ($this->get_id()) {
            $program_id = $this->get_parent_program_node()->get_item_obj()->get_id();

            if(!isset($this->course_options[$program_id])) {
                $course_options = array('' => 'Select One');

                $plans = \Orm_Program_Plan::get_all(array('program_id' => $program_id));
                foreach ($plans as $plan) {
                    $course = $plan->get_course_obj();
                    $course_options[$course->get_number('english')] = $course->get_name('english');
                }

                $this->course_options[$program_id] = $course_options;
            }

            return $this->course_options[$program_id];
        }

        return array();
    }

    /*
     * Knowledge
     */
    public function set_program_outcomes_knowledge($value)
    {

        $property_add_more = new \Orm_Property_Add_More('program_outcomes_knowledge', $value);
        $property_add_more->set_description('Knowledge');

        $learning_outcomes = new \Orm_Property_Text('learning_outcomes');
        $learning_outcomes->set_description('Learning Outcome (Knowledge)');
        $property_add_more->add_property($learning_outcomes);

        $property = new \Orm_Property_Table_Dynamic('course_levels');

        $course_code = new \Orm_Property_Select('course_code');
        $course_code->set_description('Course Code');
        $course_code->set_width(400);
        $course_code->set_is_key_value(true);
        $course_code->set_options($this->get_course_options());
        $property->add_property($course_code);

        $levels = new \Orm_Property_Select('level');
        $levels->set_description('Level');
        $levels->set_width(200);
        $levels->set_is_key_value(true);
        $levels->set_options(array(
            'I' => 'Introduction',
            'P' => 'Proficient',
            'A' => 'Advanced'
        ));

        $property->add_property($levels);

        $property_add_more->add_property($property);

        $this->set_property($property_add_more);
    }

    public function get_program_outcomes_knowledge()
    {
        return $this->get_property('program_outcomes_knowledge')->get_value();
    }

    /*
     * Cognitive Skills
     */

    public function set_program_outcomes_cognitive_skills($value)
    {

        $property_add_more = new \Orm_Property_Add_More('program_outcomes_cognitive_skills', $value);
        $property_add_more->set_description('Cognitive Skills');

        $learning_outcomes = new \Orm_Property_Text('learning_outcomes');
        $learning_outcomes->set_description('Learning Outcome (Cognitive Skills)');
        $property_add_more->add_property($learning_outcomes);

        $property = new \Orm_Property_Table_Dynamic('course_levels');

        $course_code = new \Orm_Property_Select('course_code');
        $course_code->set_description('Course Code');
        $course_code->set_width(400);
        $course_code->set_is_key_value(true);
        $course_code->set_options($this->get_course_options());
        $property->add_property($course_code);

        $levels = new \Orm_Property_Select('level');
        $levels->set_description('Level');
        $levels->set_width(200);
        $levels->set_is_key_value(true);
        $levels->set_options(array(
            'I' => 'Introduction',
            'P' => 'Proficient',
            'A' => 'Advanced'
        ));

        $property->add_property($levels);

        $property_add_more->add_property($property);

        $this->set_property($property_add_more);
    }

    public function get_program_outcomes_cognitive_skills()
    {
        return $this->get_property('program_outcomes_cognitive_skills')->get_value();
    }

    /*
     * Interpersonal Skills and Responsibility
     */

    public function set_program_outcomes_interpersonal_skills_name()
    {
        $property = new \Orm_Property_Fixedtext('program_outcomes_interpersonal_skills_name', '<strong>Interpersonal Skills and Responsibility</strong> <br/>');
        $this->set_property($property);
    }

    public function get_program_outcomes_interpersonal_skills_name()
    {
        return $this->get_property('program_outcomes_interpersonal_skills_name')->get_value();
    }

    public function set_program_outcomes_interpersonal_skills($value)
    {

        $property_add_more = new \Orm_Property_Add_More('program_outcomes_interpersonal_skills', $value);
        $property_add_more->set_description('Interpersonal Skills and Responsibility');

        $learning_outcomes = new \Orm_Property_Text('learning_outcomes');
        $learning_outcomes->set_description('Learning Outcome (Interpersonal Skills and Responsibility)');
        $property_add_more->add_property($learning_outcomes);

        $property = new \Orm_Property_Table_Dynamic('course_levels');

        $course_code = new \Orm_Property_Select('course_code');
        $course_code->set_description('Course Code');
        $course_code->set_width(400);
        $course_code->set_is_key_value(true);
        $course_code->set_options($this->get_course_options());
        $property->add_property($course_code);

        $levels = new \Orm_Property_Select('level');
        $levels->set_description('Level');
        $levels->set_width(200);
        $levels->set_is_key_value(true);
        $levels->set_options(array(
            'I' => 'Introduction',
            'P' => 'Proficient',
            'A' => 'Advanced'
        ));

        $property->add_property($levels);

        $property_add_more->add_property($property);

        $this->set_property($property_add_more);
    }

    public function get_program_outcomes_interpersonal_skills()
    {
        return $this->get_property('program_outcomes_interpersonal_skills')->get_value();
    }

    /*
     * Communication, Information Technology, Numerical
     */

    public function set_program_outcomes_communication($value)
    {

        $property_add_more = new \Orm_Property_Add_More('program_outcomes_communication', $value);
        $property_add_more->set_description('Communication, Information Technology, Numerical');

        $learning_outcomes = new \Orm_Property_Text('learning_outcomes');
        $learning_outcomes->set_description('Learning Outcome (Communication, Information Technology, Numerical)');
        $property_add_more->add_property($learning_outcomes);

        $property = new \Orm_Property_Table_Dynamic('course_levels');

        $course_code = new \Orm_Property_Select('course_code');
        $course_code->set_description('Course Code');
        $course_code->set_width(400);
        $course_code->set_is_key_value(true);
        $course_code->set_options($this->get_course_options());
        $property->add_property($course_code);

        $levels = new \Orm_Property_Select('level');
        $levels->set_description('Level');
        $levels->set_width(200);
        $levels->set_is_key_value(true);
        $levels->set_options(array(
            'I' => 'Introduction',
            'P' => 'Proficient',
            'A' => 'Advanced'
        ));

        $property->add_property($levels);

        $property_add_more->add_property($property);

        $this->set_property($property_add_more);
    }

    public function get_program_outcomes_communication()
    {
        return $this->get_property('program_outcomes_communication')->get_value();
    }

    /*
     * Psychomotor
     */

    public function set_program_outcomes_psychomotor($value)
    {

        $property_add_more = new \Orm_Property_Add_More('program_outcomes_psychomotor', $value);
        $property_add_more->set_description('Psychomotor');

        $learning_outcomes = new \Orm_Property_Text('learning_outcomes');
        $learning_outcomes->set_description('Learning Outcome (Psychomotor)');
        $property_add_more->add_property($learning_outcomes);

        $property = new \Orm_Property_Table_Dynamic('course_levels');

        $course_code = new \Orm_Property_Select('course_code');
        $course_code->set_description('Course Code');
        $course_code->set_width(400);
        $course_code->set_is_key_value(true);
        $course_code->set_options($this->get_course_options());
        $property->add_property($course_code);

        $levels = new \Orm_Property_Select('level');
        $levels->set_description('Level');
        $levels->set_width(200);
        $levels->set_is_key_value(true);
        $levels->set_options(array(
            'I' => 'Introduction',
            'P' => 'Proficient',
            'A' => 'Advanced'
        ));

        $property->add_property($levels);

        $property_add_more->add_property($property);

        $this->set_property($property_add_more);
    }

    public function get_program_outcomes_psychomotor()
    {
        return $this->get_property('program_outcomes_psychomotor')->get_value();
    }

    /*
     * 5.  Admission Requirements for the program
     */

    public function set_required_admition()
    {
        $property = new \Orm_Property_Fixedtext('required_admition', '<strong>5. Admission Requirements for the program</strong>');
        $this->set_property($property);
    }

    public function

    get_required_admition()
    {
        return $this->get_property('required_admition')->get_value();
    }

    public function set_handbook($value)
    {
        $property = new \Orm_Property_Upload('handbook', $value);
        $property->set_description('Attach handbook or bulletin description of admission requirements including any course or experience prerequisites.');
        $this->set_property($property);
    }

    public function get_handbook()
    {
        return $this->get_property('handbook')->get_value();
    }

    /*
     * 6. Attendance and Completion Requirements
     */

    public function set_attendance_requrement()
    {
        $property = new \Orm_Property_Fixedtext('attendance_requrement', '<strong>6. Attendance and Completion Requirements</strong> <br/> <br/>'
            . '<ul style="list-style:none">'
            . '<li>Attach handbook or bulletin description of requirements for:</li>'
            . '<li>a. Attendance.</li>'
            . '<li>b. Progression from year to year.</li>'
            . '<li>c. Program completion or graduation requirements.</li>'
            . '</ul>');

        $this->set_property($property);
    }

    public function get_attendance_requrement()
    {
        return $this->get_property('attendance_requrement')->get_value();
    }

    public function set_handbooks($value)
    {
        $property = new \Orm_Property_Upload('handbooks', $value);
        $this->set_property($property);
    }

    public function get_handbooks()
    {
        return $this->get_property('handbooks')->get_value();
    }

    public function draw_report_program_outcomes_knowledge($pdf = false)
    {
        $property = $this->get_property('program_outcomes_knowledge');
        return $this->draw_report_program_outcomes_map($property, $pdf);
    }

    public function draw_report_program_outcomes_cognitive_skills($pdf = false)
    {
        $property = $this->get_property('program_outcomes_cognitive_skills');
        return $this->draw_report_program_outcomes_map($property, $pdf);
    }

    public function draw_report_program_outcomes_interpersonal_skills($pdf = false)
    {
        $property = $this->get_property('program_outcomes_interpersonal_skills');
        return $this->draw_report_program_outcomes_map($property, $pdf);
    }

    public function draw_report_program_outcomes_communication($pdf = false)
    {
        $property = $this->get_property('program_outcomes_communication');
        return $this->draw_report_program_outcomes_map($property, $pdf);
    }

    public function draw_report_program_outcomes_psychomotor($pdf = false)
    {
        $property = $this->get_property('program_outcomes_psychomotor');
        return $this->draw_report_program_outcomes_map($property, $pdf);
    }

    public function draw_report_program_outcomes_map($property, $pdf = false)
    {

        $html = '<div class="form-group">';

        if (is_array($property->get_value())) {

            $cols = array();
            foreach ($property->get_value() as $col) {
                if(!empty($col['course_levels']) && is_array($col['course_levels'])) {
                    foreach ($col['course_levels'] as $course_level) {
                        $course_code = trim(strtoupper(isset($course_level['course_code']) ? $course_level['course_code'] : ''));
                        if ($course_code) {
                            $cols[$course_code] = $course_code;
                        }
                    }
                }
            }

            if ($cols) {
                $html .= '<div class="table-primary table-responsive" >';
                $html .= '<table class="table table-striped table-bordered" border="1">';
                $html .= '<thead>';
                $html .= '<tr>';
                $html .= '<td>';
                $html .= $property->get_description();
                $html .= '</td>';
                foreach ($cols as $col) {
                    $html .= '<td>';
                    $html .= $col;
                    $html .= '</td>';
                }
                $html .= '</tr>';
                $html .= '</thead>';
                $html .= '<tbody>';
                foreach ($property->get_value() as $row) {
                    $html .= '<tr>';
                    $html .= '<td>';
                    $html .= (isset($row['learning_outcomes']) ? $row['learning_outcomes'] : '');
                    $html .= '</td>';
                    foreach ($cols as $col) {
                        $html .= '<td>';
                        foreach ($property->get_value() as $row1) {
                            if(!empty($row1['course_levels']) && is_array($row1['course_levels'])) {
                                foreach ($row1['course_levels'] as $course_level) {
                                    $course_code = trim(strtoupper(isset($course_level['course_code']) ? $course_level['course_code'] : ''));
                                    if(isset($row['learning_outcomes']) && isset($row1['learning_outcomes'])) {
                                        if ($row['learning_outcomes'] == $row1['learning_outcomes'] && $col == $course_code) {
                                            $html .= (isset($course_level['level']) ? $course_level['level'] : '');
                                        }
                                    }
                                }
                            }
                        }
                        $html .= '</td>';
                    }
                    $html .= '</tr>';
                }
                $html .= '</tbody>';
                $html .= '</table>';
                $html .= '</div>';
            } else {
                $html .= '<div class="label label-danger">';
                $html .= 'There is No ' . $property->get_description() . ' Learning Outcomes  Mapping Matrix';
                $html .= '</div>';
            }
        } else {
            $html .= '<div class="label label-danger">';
            $html .= 'There is No ' . $property->get_description() . ' Learning Outcomes  Mapping Matrix';
            $html .= '</div>';
        }

        $html .= '</div>';

        return $html;
    }

    public function header_actions(&$actions = array()) {

        if (\Orm::get_ci()->config->item('integration_enabled')) {
            if ($this->check_if_editable()) {
                $actions[] = array(
                    'class' => 'btn',
                    'title' => '<i class="fa fa-database"></i> ' . lang('Integration'),
                    'extra' => 'onclick="integration(this, ' . $this->get_id() . ');" ' . data_loading_text(true) . ' title="Extraction of data from other modules"'
                );
            }
        }

        return parent::header_actions($actions);
    }

    public function integration_processes() {
        parent::integration_processes();

        if (\Orm::get_ci()->config->item('integration_enabled')) {
            $program_node = $this->get_parent_program_node();
            if (!is_null($program_node) && $program_node->get_id()) {
                $program_obj = $program_node->get_item_obj(); /* @var $program_obj \Orm_Program */

                $program_plan = \Orm_Program_Plan::get_all(array('program_id' => $program_obj->get_id()),0,0,array('pp.level'));

                $levels = array();

                foreach ($program_plan as $course) {
                    $pre = \Orm_Data_Course_Pre::get_all(array('course_id' => $course->get_id(),'program_id' => $program_obj->get_id()));
                    $pre_courses = array();
                    foreach ($pre as $c) {
                        $pre_courses[] = $c->get_pre_course_obj()->get_name('name');
                    }
                    $levels[$course->get_level()]['level'] = 'Level '.$course->get_level();
                    $levels[$course->get_level()]['curriculum_study_plan'][] = array(
                        'course_code' => $course->get_course_obj()->get_code('english'),
                        'course_title' => $course->get_course_obj()->get_name('english'),
                        'required_or_elective' => $course->get_is_required() ? 'Required' : 'Elective',
                        'prerequired_or_elective' => implode(' / ',$pre_courses),
                        'credit_houre' => $course->get_credit_hours(),
                        'college_or_department' => $course->get_course_obj()->get_department_obj()->get_name('english') . '/' .$course->get_course_obj()->get_department_obj()->get_college_obj()->get_name('english')
                    );
                }

                $this->set_curriculum_study_plan_levels($levels);

                if (\License::get_instance()->check_module('curriculum_mapping') && \Modules::load('curriculum_mapping')) {
                    $assessment_methods = \Orm_Cm_Program_Assessment_Method::get_all(array('program_id' => $program_obj->get_id()));

                    $methods = '<ul>';
                    foreach ($assessment_methods as $method) {
                        $methods .= "<li>{$method->get_assessment_method_obj()->get_title()}</li>";
                    }
                    $methods .= '</ul>';

                    $PLOs = \Orm_Cm_Program_Learning_Outcome::get_all(array('program_id' => $program_obj->get_id(),'ncaaa_code' => 1));
                    $knowledge = array();
                    $code = 0;
                    foreach ($PLOs as $key => $PLO) {
                        $knowledge[2][1]['national_qualifications'][] = array(
                            'code' => '1.'.(++$code),
                            'learning_outcome' => $PLO->get_text(),
                            'teaching_strategies' => $methods,
                            'assessment_methods' => $methods
                        );
                    }
                    $PLOs = \Orm_Cm_Program_Learning_Outcome::get_all(array('program_id' => $program_obj->get_id(),'ncaaa_code' => 2));
                    $code = 0;
                    foreach ($PLOs as $key => $PLO) {
                        $knowledge[4][1]['national_qualifications'][] = array(
                            'code' => '2.'.(++$code),
                            'learning_outcome' => $PLO->get_text(),
                            'teaching_strategies' => $methods,
                            'assessment_methods' => $methods
                        );
                    }

                    $PLOs = \Orm_Cm_Program_Learning_Outcome::get_all(array('program_id' => $program_obj->get_id(),'ncaaa_code' => 3));
                    $code = 0;
                    foreach ($PLOs as $key => $PLO) {
                        $knowledge[6][1]['national_qualifications'][] = array(
                            'code' => '3.'.(++$code),
                            'learning_outcome' => $PLO->get_text(),
                            'teaching_strategies' => $methods,
                            'assessment_methods' => $methods
                        );
                    }

                    $PLOs = \Orm_Cm_Program_Learning_Outcome::get_all(array('program_id' => $program_obj->get_id(),'ncaaa_code' => 4));
                    $code = 0;
                    foreach ($PLOs as $key => $PLO) {
                        $knowledge[8][1]['national_qualifications'][] = array(
                            'code' => '4.'.(++$code),
                            'learning_outcome' => $PLO->get_text(),
                            'teaching_strategies' => $methods,
                            'assessment_methods' => $methods
                        );
                    }

                    $PLOs = \Orm_Cm_Program_Learning_Outcome::get_all(array('program_id' => $program_obj->get_id(),'ncaaa_code' => 5));
                    $code = 0;
                    foreach ($PLOs as $key => $PLO) {
                        $knowledge[10][1]['national_qualifications'][] = array(
                            'code' => '5.'.(++$code),
                            'learning_outcome' => $PLO->get_text(),
                            'teaching_strategies' => $methods,
                            'assessment_methods' => $methods
                        );
                    }
                    $this->set_national_qualification($knowledge);

                    //Knowledge Mapping Matrix
                    $knowledge_mapping = array();
                    $knowledge_plo = \Orm_Cm_Program_Learning_Outcome::get_all(array('ncaaa_code' => 1,'program_id' => $program_obj->get_id()));
                    foreach ($knowledge_plo as $plo)
                    {
                        $courses = \Orm_Cm_Program_Mapping_Matrix::get_all(array('program_learning_outcome_id' => $plo->get_id()));
                        if (count($courses)) {
                            $mapped_courses = array();
                            foreach ($courses as $course)
                            {
                                $mapped_courses[] = array(
                                    'course_code' => $course->get_course_obj()->get_code('english'),
//                                    'level' => mb_strtoupper($course->get_ipa())
                                    'level' => $course->get_ipa()
                                );
                            }
                            $knowledge_mapping[] = array(
                                'learning_outcomes' => $plo->get_text(),
                                'course_levels' => $mapped_courses
                            );
                        }
                    }

                    $this->set_program_outcomes_knowledge($knowledge_mapping);

                    //Cognitive Mapping Matrix
                    $cognitive_mapping = array();
                    $cognitive_plo = \Orm_Cm_Program_Learning_Outcome::get_all(array('ncaaa_code' => 2,'program_id' => $program_obj->get_id()));
                    foreach ($cognitive_plo as $plo)
                    {
                        $courses = \Orm_Cm_Program_Mapping_Matrix::get_all(array('program_learning_outcome_id' => $plo->get_id()));
                        if (count($courses)) {
                            $mapped_courses = array();
                            foreach ($courses as $course)
                            {
                                $mapped_courses[] = array(
                                    'course_code' => $course->get_course_obj()->get_code('english'),
//                                    'level' => mb_strtoupper($course->get_ipa())
                                    'level' => $course->get_ipa()
                                );
                            }
                            $cognitive_mapping[] = array(
                                'learning_outcomes' => $plo->get_text(),
                                'course_levels' => $mapped_courses
                            );
                        }
                    }

                    $this->set_program_outcomes_cognitive_skills($cognitive_mapping);

                    //Interpersonal Skills & Responsibility Mapping Matrix
                    $ethics_mapping = array();
                    $interpersonal_plo = \Orm_Cm_Program_Learning_Outcome::get_all(array('ncaaa_code' => 3,'program_id' => $program_obj->get_id()));
                    foreach ($interpersonal_plo as $plo)
                    {
                        $courses = \Orm_Cm_Program_Mapping_Matrix::get_all(array('program_learning_outcome_id' => $plo->get_id()));
                        if (count($courses)) {
                            $mapped_courses = array();
                            foreach ($courses as $course)
                            {
                                $mapped_courses[] = array(
                                    'course_code' => $course->get_course_obj()->get_code('english'),
//                                    'level' => mb_strtoupper($course->get_ipa())
                                    'level' => $course->get_ipa()
                                );
                            }
                            $ethics_mapping[] = array(
                                'learning_outcomes' => $plo->get_text(),
                                'course_levels' => $mapped_courses
                            );
                        }
                    }

                    $this->set_program_outcomes_interpersonal_skills($ethics_mapping);

                    //Communication Skills Mapping Matrix
                    $communication_mapping = array();
                    $communication_plo = \Orm_Cm_Program_Learning_Outcome::get_all(array('ncaaa_code' => 4,'program_id' => $program_obj->get_id()));
                    foreach ($communication_plo as $plo)
                    {
                        $courses = \Orm_Cm_Program_Mapping_Matrix::get_all(array('program_learning_outcome_id' => $plo->get_id()));
                        if (count($courses)) {
                            $mapped_courses = array();
                            foreach ($courses as $course)
                            {
                                $mapped_courses[] = array(
                                    'course_code' => $course->get_course_obj()->get_code('english'),
//                                    'level' => mb_strtoupper($course->get_ipa())
                                    'level' => $course->get_ipa()
                                );
                            }
                            $communication_mapping[] = array(
                                'learning_outcomes' => $plo->get_text(),
                                'course_levels' => $mapped_courses
                            );
                        }
                    }

                    $this->set_program_outcomes_communication($communication_mapping);

                    //Psychomotor Skills Mapping Matrix
                    $psychomotor_mapping = array();
                    $psychomotor_plo = \Orm_Cm_Program_Learning_Outcome::get_all(array('ncaaa_code' => 5,'program_id' => $program_obj->get_id()));

                    foreach ($psychomotor_plo as $plo)
                    {
                        $courses = \Orm_Cm_Program_Mapping_Matrix::get_all(array('program_learning_outcome_id' => $plo->get_id()));
                        if (count($courses)) {
                            $mapped_courses = array();
                            foreach ($courses as $course)
                            {
                                $mapped_courses[] = array(
                                    'course_code' => $course->get_course_obj()->get_code('english'),
//                                    'level' => mb_strtoupper($course->get_ipa())
                                    'level' => $course->get_ipa()
                                );
                            }
                            $psychomotor_mapping[] = array(
                                'learning_outcomes' => $plo->get_text(),
                                'course_levels' => $mapped_courses
                            );
                        }
                    }

                    $this->set_program_outcomes_psychomotor($psychomotor_mapping);
                }
            }
            $this->save();
        }
    }

}
