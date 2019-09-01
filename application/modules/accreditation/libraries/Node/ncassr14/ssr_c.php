<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ssr_c
 *
 * @author duaa
 */
class Ssr_C extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'C. Periodic Program Profile Template B: College Data';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_college('');
            $this->set_department('');
            $this->set_program('');
            $this->set_template_b(array());
            $this->set_number_of_graduates(array());
            $this->set_student_completion_rate(array());
            $this->set_mode_of_instruction_student_enrolment(array());
            $this->set_student_enrollment_note();
            $this->set_mode_of_instruction_teaching_staff(array());
            $this->set_teaching_staff_note();
    }

    public function set_college($value)
    {
        $property = new \Orm_Property_Text('college', $value);
        $property->set_description('College:');
        $this->set_property($property);
    }

    public function get_college()
    {
        return $this->get_property('college')->get_value();
    }

    public function set_department($value)
    {
        $property = new \Orm_Property_Text('department', $value);
        $property->set_description('Department:');
        $this->set_property($property);
    }

    public function get_department()
    {
        return $this->get_property('department')->get_value();
    }

    public function set_program($value)
    {
        $property = new \Orm_Property_Text('program', $value);
        $property->set_description('Program:');
        $this->set_property($property);
    }

    public function get_program()
    {
        return $this->get_property('program')->get_value();
    }

    public function set_template_b($value)
    {
        $property = new \Orm_Property_Table_Dynamic('template_b', $value);
        $property->set_description('*(On Campus Programs, Distance Learning)');
        $property->set_is_responsive(true);

        $faculty_name = new \Orm_Property_Text('faculty_name');
        $faculty_name->set_description('Names');
        $faculty_name->set_group('Faculty/Teaching Staff');
        $faculty_name->set_width(200);
        $property->add_property($faculty_name);

        $gender = new \Orm_Property_Radio('gender');
        $gender->set_description('Gender');
        $gender->set_group('Faculty/Teaching Staff');
        $gender->set_options(array('M', 'F'));
        $gender->set_width(50);
        $property->add_property($gender);

        $nationality = new \Orm_Property_Text('nationality');
        $nationality->set_description('Nationality');
        $nationality->set_width(200);
        $property->add_property($nationality);

        $academic_rank = new \Orm_Property_Text('academic_rank');
        $academic_rank->set_description('Academic Rank');
        $academic_rank->set_width(200);
        $property->add_property($academic_rank);

        $general_specialty = new \Orm_Property_Text('general_specialty');
        $general_specialty->set_description('General Specialty');
        $general_specialty->set_width(200);
        $property->add_property($general_specialty);

        $specific_specialty = new \Orm_Property_Text('specific_specialty');
        $specific_specialty->set_description('Specific Specialty');
        $specific_specialty->set_width(200);
        $property->add_property($specific_specialty);

        $institution_graduated_from = new \Orm_Property_Text('institution_graduated_from');
        $institution_graduated_from->set_description('Institution Graduated From');
        $institution_graduated_from->set_width(200);
        $property->add_property($institution_graduated_from);

        $degree = new \Orm_Property_Text('degree');
        $degree->set_description('Degree');
        $degree->set_width(200);
        $property->add_property($degree);

        $study_mode = new \Orm_Property_Text('study_mode');
        $study_mode->set_description('*Study Mode');
        $study_mode->set_width(200);
        $property->add_property($study_mode);

        $list_courses_taught_this_academic_year = new \Orm_Property_Textarea('list_courses_taught_this_academic_year');
        $list_courses_taught_this_academic_year->set_description('List Courses Taught This Academic Year');
        $list_courses_taught_this_academic_year->set_width(200);
        $list_courses_taught_this_academic_year->set_enable_tinymce(0);
        $property->add_property($list_courses_taught_this_academic_year);

        $full_time = new \Orm_Property_Radio('full_time');
        $full_time->set_description('Full or Part Time');
        $full_time->set_options(array('F/T', 'P/T'));
        $full_time->set_width(70);
        $property->add_property($full_time);


        $this->set_property($property);
    }

    public function get_template_b()
    {
        return $this->get_property('template_b')->get_value();
    }

    public function set_number_of_graduates($value)
    {
        $undergraduate_students = new \Orm_Property_Text('undergraduate_students');
        $post_graduate_masters_students = new \Orm_Property_Text('post_graduate_masters_students');
        $post_graduate_phd_students = new \Orm_Property_Text('post_graduate_phd_students');

        $property = new \Orm_Property_Table('number_of_graduates', $value);
        $property->set_description('Number of Graduates in the Most Recent Year');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('empty', ''));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('undergraduate_students', 'Undergraduate Students'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('post_graduate_masters_students', 'Post Graduate Masters Students'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('post_graduate_phd_students', 'Post Graduate Ph.D. Students'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('male', 'Male'));
        $property->add_cell(2, 2, $undergraduate_students);
        $property->add_cell(2, 3, $post_graduate_masters_students);
        $property->add_cell(2, 4, $post_graduate_phd_students);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('female', 'Female'));
        $property->add_cell(3, 2, $undergraduate_students);
        $property->add_cell(3, 3, $post_graduate_masters_students);
        $property->add_cell(3, 4, $post_graduate_phd_students);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('total', 'Total'));
        $property->add_cell(4, 2, $undergraduate_students);
        $property->add_cell(4, 3, $post_graduate_masters_students);
        $property->add_cell(4, 4, $post_graduate_phd_students);

        $this->set_property($property);
    }

    public function get_number_of_graduates()
    {
        return $this->get_property('number_of_graduates')->get_value();
    }

    public function set_student_completion_rate($value)
    {
        $undergraduate_programs_four_years = new \Orm_Property_Percentage('undergraduate_programs_four_years');
        $undergraduate_programs_five_years = new \Orm_Property_Percentage('undergraduate_programs_five_years');
        $undergraduate_programs_six_years = new \Orm_Property_Percentage('undergraduate_programs_six_years');
        $postgraduate_programs_master = new \Orm_Property_Percentage('postgraduate_programs_master');
        $postgraduate_programs_doctor = new \Orm_Property_Percentage('postgraduate_programs_doctor');

        $property = new \Orm_Property_Table('student_completion_rate', $value);
        $property->set_description('Apparent Student Completion Rate: The number of students who graduated in the most recent year as a percentage of those who commenced those programs in that cohort four, five, or six years previously (e.g. for a four year program the number of students who graduated as a percentage who commenced the program four years previously).');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('student', 'Students'), 2, 0);
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('undergraduate_programs', 'Undergraduate Programs'), 0, 3);
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('postgraduate_programs', 'Postgraduate Programs'), 0, 3);

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('four_years', 'Four Years'));
        $property->add_cell(2, 2, new \Orm_Property_Fixedtext('five_years', 'Five Years'));
        $property->add_cell(2, 3, new \Orm_Property_Fixedtext('six_years', 'Six Years'));
        $property->add_cell(2, 4, new \Orm_Property_Fixedtext('master', 'Master'));
        $property->add_cell(2, 5, new \Orm_Property_Fixedtext('doctor', 'Doctor'));


        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('male', 'Male'));
        $property->add_cell(3, 2, $undergraduate_programs_four_years);
        $property->add_cell(3, 3, $undergraduate_programs_five_years);
        $property->add_cell(3, 4, $undergraduate_programs_six_years);
        $property->add_cell(3, 5, $postgraduate_programs_master);
        $property->add_cell(3, 6, $postgraduate_programs_doctor);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('female', 'Female'));
        $property->add_cell(4, 2, $undergraduate_programs_four_years);
        $property->add_cell(4, 3, $undergraduate_programs_five_years);
        $property->add_cell(4, 4, $undergraduate_programs_six_years);
        $property->add_cell(4, 5, $postgraduate_programs_master);
        $property->add_cell(4, 6, $postgraduate_programs_doctor);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('total', 'Total'));
        $property->add_cell(5, 2, $undergraduate_programs_four_years);
        $property->add_cell(5, 3, $undergraduate_programs_five_years);
        $property->add_cell(5, 4, $undergraduate_programs_six_years);
        $property->add_cell(5, 5, $postgraduate_programs_master);
        $property->add_cell(5, 6, $postgraduate_programs_doctor);

        $this->set_property($property);
    }

    public function get_student_completion_rate()
    {
        return $this->get_property('student_completion_rate')->get_value();
    }

    public function set_mode_of_instruction_student_enrolment($value)
    {
        $full_time = new \Orm_Property_Fixedtext('full_time', 'Full time');
        $part_time = new \Orm_Property_Fixedtext('part_time', 'Part time');
        $fte = new \Orm_Property_Fixedtext('fte', 'FTE');

        $on_campus_fulltime = new \Orm_Property_Text('on_campus_fulltime');
        $on_campus_parttime = new \Orm_Property_Text('on_campus_parttime');
        $on_campus_fte = new \Orm_Property_Text('on_campus_fte');
        $distance_education_programs_fulltime = new \Orm_Property_Text('distance_education_programs_fulltime');
        $distance_education_programs_parttime = new \Orm_Property_Text('distance_education_programs_parttime');
        $distance_education_programs_fte = new \Orm_Property_Text('distance_education_programs_fte');

        $property = new \Orm_Property_Table('mode_of_instruction_student_enrolment', $value);
        $property->set_description('Mode of Instruction – Student Enrollment (excluding preparatory program)');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('student', 'Students'), 2, 0);
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('on_campus', 'On Campus Programs'), 0, 3);
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('distance_education_programs', 'Distance Education Programs'), 0, 3);

        $property->add_cell(2, 1, $full_time);
        $property->add_cell(2, 2, $part_time);
        $property->add_cell(2, 3, $fte);
        $property->add_cell(2, 4, $full_time);
        $property->add_cell(2, 5, $part_time);
        $property->add_cell(2, 6, $fte);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('male', 'Male'));
        $property->add_cell(3, 2, $on_campus_fulltime);
        $property->add_cell(3, 3, $on_campus_parttime);
        $property->add_cell(3, 4, $on_campus_fte);
        $property->add_cell(3, 5, $distance_education_programs_fulltime);
        $property->add_cell(3, 6, $distance_education_programs_parttime);
        $property->add_cell(3, 7, $distance_education_programs_fte);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('female', 'Female'));
        $property->add_cell(4, 2, $on_campus_fulltime);
        $property->add_cell(4, 3, $on_campus_parttime);
        $property->add_cell(4, 4, $on_campus_fte);
        $property->add_cell(4, 5, $distance_education_programs_fulltime);
        $property->add_cell(4, 6, $distance_education_programs_parttime);
        $property->add_cell(4, 7, $distance_education_programs_fte);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('total', 'Total'));
        $property->add_cell(5, 2, $on_campus_fulltime);
        $property->add_cell(5, 3, $on_campus_parttime);
        $property->add_cell(5, 4, $on_campus_fte);
        $property->add_cell(5, 5, $distance_education_programs_fulltime);
        $property->add_cell(5, 6, $distance_education_programs_parttime);
        $property->add_cell(5, 7, $distance_education_programs_fte);
        $this->set_property($property);
    }

    public function get_mode_of_instruction_student_enrolment()
    {
        return $this->get_property('mode_of_instruction_student_enrolment')->get_value();
    }

    public function set_student_enrollment_note()
    {
        $property = new \Orm_Property_Fixedtext('student_enrollment_note', '<strong>Note:</strong>FTE (full time equivalent) for part time students assume a full time load is 15 credit hours and divide the number of credit hours taken by each student by 15 (use this formula only for part time students).');
        $this->set_property($property);
    }

    public function get_student_enrollment_note()
    {
        return $this->get_property('student_enrollment_note')->get_value();
    }

    public function set_mode_of_instruction_teaching_staff($value)
    {
        $full_time = new \Orm_Property_Fixedtext('full_time', 'Full time');
        $part_time = new \Orm_Property_Fixedtext('part_time', 'Part time');
        $fte = new \Orm_Property_Fixedtext('fte', 'FTE');

        $on_campus_fulltime = new \Orm_Property_Text('on_campus_fulltime');
        $on_campus_parttime = new \Orm_Property_Text('on_campus_parttime');
        $on_campus_fte = new \Orm_Property_Text('on_campus_fte');
        $distance_education_programs_fulltime = new \Orm_Property_Text('distance_education_programs_fulltime');
        $distance_education_programs_parttime = new \Orm_Property_Text('distance_education_programs_parttime');
        $distance_education_programs_fte = new \Orm_Property_Text('distance_education_programs_fte');

        $property = new \Orm_Property_Table('mode_of_instruction_teaching_staff', $value);
        $property->set_description('Mode of Instruction – Teaching Staff (excluding preparatory program)');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('number_of_teaching_staff', 'Number of Teaching Staff'), 2, 0);
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('on_campus', 'On Campus Programs'), 0, 3);
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('distance_education_programs', 'Distance Education Programs'), 0, 3);

        $property->add_cell(2, 1, $full_time);
        $property->add_cell(2, 2, $part_time);
        $property->add_cell(2, 3, $fte);
        $property->add_cell(2, 4, $full_time);
        $property->add_cell(2, 5, $part_time);
        $property->add_cell(2, 6, $fte);


        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('male', 'Male'));
        $property->add_cell(3, 2, $on_campus_fulltime);
        $property->add_cell(3, 3, $on_campus_parttime);
        $property->add_cell(3, 4, $on_campus_fte);
        $property->add_cell(3, 5, $distance_education_programs_fulltime);
        $property->add_cell(3, 6, $distance_education_programs_parttime);
        $property->add_cell(3, 7, $distance_education_programs_fte);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('female', 'Female'));
        $property->add_cell(4, 2, $on_campus_fulltime);
        $property->add_cell(4, 3, $on_campus_parttime);
        $property->add_cell(4, 4, $on_campus_fte);
        $property->add_cell(4, 5, $distance_education_programs_fulltime);
        $property->add_cell(4, 6, $distance_education_programs_parttime);
        $property->add_cell(4, 7, $distance_education_programs_fte);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('total', 'Total'));
        $property->add_cell(5, 2, $on_campus_fulltime);
        $property->add_cell(5, 3, $on_campus_parttime);
        $property->add_cell(5, 4, $on_campus_fte);
        $property->add_cell(5, 5, $distance_education_programs_fulltime);
        $property->add_cell(5, 6, $distance_education_programs_parttime);
        $property->add_cell(5, 7, $distance_education_programs_fte);
        $this->set_property($property);
    }

    public function get_mode_of_instruction_teaching_staff()
    {
        return $this->get_property('mode_of_instruction_teaching_staff')->get_value();
    }

    public function set_teaching_staff_note()
    {
        $property = new \Orm_Property_Fixedtext('teaching_staff_note', '<strong>Note:</strong> Teaching staff includes tutors, lectures, and assistant, associate and full professors. This does not include research, teaching, or laboratory assistants. Academic staff who oversee the planning and delivery of teaching programs are included (e.g. head of department, dean for a college, rector and vice rectors).');
        $this->set_property($property);
    }

    public function get_teaching_staff_note()
    {
        return $this->get_property('teaching_staff_note')->get_value();
    }

    public function after_node_load()
    {
        parent::after_node_load();

        $program_node = $this->get_parent_program_node();
        if (!is_null($program_node) && $program_node->get_id()) {
            $program_obj = $program_node->get_item_obj(); /* @var $program_obj \Orm_Program */
            $department_obj = $program_obj->get_department_obj();
            $this->set_college($department_obj->get_college_obj()->get_name('english'));
            $this->set_department($department_obj->get_name('english'));
            $this->set_program($program_obj->get_name('english'));
        }
    }

    public function header_actions(&$actions = array()) {

        if ($this->check_if_editable()) {
            $actions[] = array(
                'class' => 'btn',
                'title' => '<i class="fa fa-database"></i> ' . lang('Integration'),
                'extra' => 'onclick="integration(this, ' . $this->get_id() . ');" ' . data_loading_text(true) . ' title="Extraction of data from other modules"'
            );
        }

        return parent::header_actions($actions);
    }

    public function integration_processes() {
        parent::integration_processes();

	    $program_node = $this->get_parent_program_node();
        if (!is_null($program_node) && $program_node->get_id()) {
            /* @var $program_obj \Orm_Program */
            $program_obj = $program_node->get_item_obj();
            $template_b = array();

            foreach (\Orm_User_Faculty::get_all(array('program_id' => $program_obj->get_id())) as $faculty) {
                $courses = '';
                foreach (\Orm_Course_Section::get_all(array('teacher_id' => $faculty->get_id())) as $course) {
                    $courses = $course->get_course_obj()->get_code('english') . ' ' . $course->get_course_obj()->get_name('english') . "\n";
                }
                $template_b[] = array(
                    'faculty_name' => $faculty->get_full_name(),
                    'gender' => $faculty->get_gender() == \Orm_User::GENDER_MALE ? 'M' : 'F',
                    'nationality' => $faculty->get_nationality(),
                    'year' => $faculty->get_service_time(),
                    'academic_rank' => $faculty->get_academic_rank(true),
                    'general_specialty' => '',
                    'specific_specialty' => '',
                    'institution_graduated_from' => '',
                    'degree' => '',
                    'study_mode' => '',
                    'list_courses_taught_this_academic_year' => $courses,
                    'full_time' => 'F/T'
                );
            }

            $this->set_template_b($template_b);
        }
        if (\Orm::get_ci()->config->item('integration_enabled')) {
            if (!is_null($program_node) && $program_node->get_id()) {
                $program_obj = $program_node->get_item_obj();
                /* @var $program_obj \Orm_Program */
                $department_obj = $program_obj->get_department_obj();
                $college_obj = $department_obj->get_college_obj();

                $graduates = array();

                //TODO FIX THE DEGREE CODES
                $bsc_programs = array_column(\Orm_Program::get_model()->get_all(array('college_id' => $college_obj->get_id(), 'degree_id' => 5), 0, 0, array(), \Orm::FETCH_ARRAY), 'id');
                $master_programs = array_column(\Orm_Program::get_model()->get_all(array('college_id' => $college_obj->get_id(), 'degree_id' => 8), 0, 0, array(), \Orm::FETCH_ARRAY), 'id');
                $phd_programs = array_column(\Orm_Program::get_model()->get_all(array('college_id' => $college_obj->get_id(), 'degree_id' => 10), 0, 0, array(), \Orm::FETCH_ARRAY), 'id');
                $bsc_programs[] = 0;
                $master_programs[] = 0;
                $phd_programs[] = 0;

                $graduates[2][2]['undergraduate_students'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_programs, 'gender' => \Orm_User::GENDER_MALE, 'academic_year' => $this->get_year()), 'graduate');
                $graduates[2][3]['post_graduate_masters_students'] = \Orm_Data_Graduate::get_sum(array('program_in' => $master_programs, 'gender' => \Orm_User::GENDER_MALE, 'academic_year' => $this->get_year()), 'graduate');
                $graduates[2][4]['post_graduate_phd_students'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_programs, 'gender' => \Orm_User::GENDER_MALE, 'academic_year' => $this->get_year()), 'graduate');
                $graduates[3][2]['undergraduate_students'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_programs, 'gender' => \Orm_User::GENDER_FEMALE, 'academic_year' => $this->get_year()), 'graduate');
                $graduates[3][3]['post_graduate_masters_students'] = \Orm_Data_Graduate::get_sum(array('program_in' => $master_programs, 'gender' => \Orm_User::GENDER_FEMALE, 'academic_year' => $this->get_year()), 'graduate');
                $graduates[3][4]['post_graduate_phd_students'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_programs, 'gender' => \Orm_User::GENDER_FEMALE, 'academic_year' => $this->get_year()), 'graduate');
                $graduates[4][2]['undergraduate_students'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_programs, 'academic_year' => $this->get_year()), 'graduate');
                $graduates[4][3]['post_graduate_masters_students'] = \Orm_Data_Graduate::get_sum(array('program_in' => $master_programs, 'academic_year' => $this->get_year()), 'graduate');
                $graduates[4][4]['post_graduate_phd_students'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_programs, 'academic_year' => $this->get_year()), 'graduate');

                $this->set_number_of_graduates($graduates);

                $completion = array();

                $four_programs = array_column(\Orm_Program::get_model()->get_all(array('college_id' => $college_obj->get_id(), 'duration' => 4), 0, 0, array(), \Orm::FETCH_ARRAY), 'id');
                $five_programs = array_column(\Orm_Program::get_model()->get_all(array('college_id' => $college_obj->get_id(), 'duration' => 5), 0, 0, array(), \Orm::FETCH_ARRAY), 'id');
                $six_programs = array_column(\Orm_Program::get_model()->get_all(array('college_id' => $college_obj->get_id(), 'duration' => 6), 0, 0, array(), \Orm::FETCH_ARRAY), 'id');
                $four_programs[] = 0;
                $five_programs[] = 0;
                $six_programs[] = 0;

                $four_male = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $four_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_MALE)) ? (\Orm_Data_Competion_Rate::get_sum(array('program_in' => $four_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 4, 'gender' => \Orm_User::GENDER_MALE)) / \Orm_Data_Competion_Rate::get_sum(array('program_in' => $four_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_MALE))) : 0;
                $four_female = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $four_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_FEMALE)) ? (\Orm_Data_Competion_Rate::get_sum(array('program_in' => $four_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 4, 'gender' => \Orm_User::GENDER_FEMALE)) / \Orm_Data_Competion_Rate::get_sum(array('program_in' => $four_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_FEMALE))) : 0;
                $four_total = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $four_programs, 'academic_year' => $this->get_year())) ? (\Orm_Data_Competion_Rate::get_sum(array('program_in' => $four_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 4)) / \Orm_Data_Competion_Rate::get_sum(array('program_in' => $four_programs, 'academic_year' => $this->get_year()))) : 0;
                $five_male = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $five_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_MALE)) ? (\Orm_Data_Competion_Rate::get_sum(array('program_in' => $five_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 5, 'gender' => \Orm_User::GENDER_MALE)) / \Orm_Data_Competion_Rate::get_sum(array('program_in' => $five_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_MALE))) : 0;
                $five_female = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $five_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_FEMALE)) ? (\Orm_Data_Competion_Rate::get_sum(array('program_in' => $five_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 5, 'gender' => \Orm_User::GENDER_FEMALE)) / \Orm_Data_Competion_Rate::get_sum(array('program_in' => $five_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_FEMALE))) : 0;
                $five_total = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $five_programs, 'academic_year' => $this->get_year())) ? (\Orm_Data_Competion_Rate::get_sum(array('program_in' => $five_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 5)) / \Orm_Data_Competion_Rate::get_sum(array('program_in' => $five_programs, 'academic_year' => $this->get_year()))) : 0;
                $six_male = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $five_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_MALE)) ? (\Orm_Data_Competion_Rate::get_sum(array('program_in' => $six_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 6, 'gender' => \Orm_User::GENDER_MALE)) / \Orm_Data_Competion_Rate::get_sum(array('program_in' => $six_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_MALE))) : 0;
                $six_female = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $five_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_FEMALE)) ? (\Orm_Data_Competion_Rate::get_sum(array('program_in' => $six_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 6, 'gender' => \Orm_User::GENDER_FEMALE)) / \Orm_Data_Competion_Rate::get_sum(array('program_in' => $six_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_FEMALE))) : 0;
                $six_total = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $five_programs, 'academic_year' => $this->get_year())) ? (\Orm_Data_Competion_Rate::get_sum(array('program_in' => $six_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 6)) / \Orm_Data_Competion_Rate::get_sum(array('program_in' => $six_programs, 'academic_year' => $this->get_year()))) : 0;



                $completion[3][2]['undergraduate_programs_four_years'] = $four_male * 100;
                $completion[3][3]['undergraduate_programs_five_years'] = $five_male * 100;
                $completion[3][4]['undergraduate_programs_six_years'] = $six_male * 100;
                $completion[3][5]['postgraduate_programs_master'] = 0;
                $completion[3][6]['postgraduate_programs_doctor'] = 0;
                $completion[4][2]['undergraduate_programs_four_years'] = $four_female * 100;
                $completion[4][3]['undergraduate_programs_five_years'] = $five_female * 100;
                $completion[4][4]['undergraduate_programs_six_years'] = $six_female * 100;
                $completion[4][5]['postgraduate_programs_master'] = 0;
                $completion[4][6]['postgraduate_programs_doctor'] = 0;
                $completion[5][2]['undergraduate_programs_four_years'] = $four_total * 100;
                $completion[5][3]['undergraduate_programs_five_years'] = $five_total * 100;
                $completion[5][4]['undergraduate_programs_six_years'] = $six_total * 100;
                $completion[5][5]['postgraduate_programs_master'] = 0;
                $completion[5][6]['postgraduate_programs_doctor'] = 0;

                $this->set_student_completion_rate($completion);

                $enrolled = array();

                $enrolled[3][2]['on_campus_fulltime'] = \Orm_Data_Graduate::get_sum(array('program_id' => $program_obj->get_id(), 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_MALE), 'enrolled');
                $enrolled[3][3]['on_campus_parttime'] = 0;
                $enrolled[3][4]['on_campus_fte'] = 0;
                $enrolled[3][5]['distance_education_programs_fulltime'] = 0;
                $enrolled[3][6]['distance_education_programs_parttime'] = 0;
                $enrolled[3][7]['distance_education_programs_fte'] = 0;
                $enrolled[4][2]['on_campus_fulltime'] = \Orm_Data_Graduate::get_sum(array('program_id' => $program_obj->get_id(), 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_FEMALE), 'enrolled');
                $enrolled[4][3]['on_campus_parttime'] = 0;
                $enrolled[4][4]['on_campus_fte'] = 0;
                $enrolled[4][5]['distance_education_programs_fulltime'] = 0;
                $enrolled[4][6]['distance_education_programs_parttime'] = 0;
                $enrolled[4][7]['distance_education_programs_fte'] = 0;
                $enrolled[5][2]['on_campus_fulltime'] = \Orm_Data_Graduate::get_sum(array('program_id' => $program_obj->get_id(), 'academic_year' => $this->get_year()), 'enrolled');
                $enrolled[5][3]['on_campus_parttime'] = 0;
                $enrolled[5][4]['on_campus_fte'] = 0;
                $enrolled[5][5]['distance_education_programs_fulltime'] = 0;
                $enrolled[5][6]['distance_education_programs_parttime'] = 0;
                $enrolled[5][7]['distance_education_programs_fte'] = 0;

                $this->set_mode_of_instruction_student_enrolment($enrolled);

                $teaching_staff = array();

                $teaching_staff[3][2]['on_campus_fulltime'] = \Orm_User_Faculty::get_count(array('program_id' => $program_obj->get_id(), 'gender' => \Orm_User::GENDER_MALE));
                $teaching_staff[3][3]['on_campus_parttime'] = 0;
                $teaching_staff[3][4]['on_campus_fte'] = 0;
                $teaching_staff[3][5]['distance_education_programs_fulltime'] = 0;
                $teaching_staff[3][6]['distance_education_programs_parttime'] = 0;
                $teaching_staff[3][7]['distance_education_programs_fte'] = 0;

                $teaching_staff[4][2]['on_campus_fulltime'] = \Orm_User_Faculty::get_count(array('program_id' => $program_obj->get_id(), 'gender' => \Orm_User::GENDER_FEMALE));
                $teaching_staff[4][3]['on_campus_parttime'] = 0;
                $teaching_staff[4][4]['on_campus_fte'] = 0;
                $teaching_staff[4][5]['distance_education_programs_fulltime'] = 0;
                $teaching_staff[4][6]['distance_education_programs_parttime'] = 0;
                $teaching_staff[4][7]['distance_education_programs_fte'] = 0;

                $teaching_staff[5][2]['on_campus_fulltime'] = \Orm_User_Faculty::get_count(array('program_id' => $program_obj->get_id()));
                $teaching_staff[5][3]['on_campus_parttime'] = 0;
                $teaching_staff[5][4]['on_campus_fte'] = 0;
                $teaching_staff[5][5]['distance_education_programs_fulltime'] = 0;
                $teaching_staff[5][6]['distance_education_programs_parttime'] = 0;
                $teaching_staff[5][7]['distance_education_programs_fte'] = 0;

                $this->set_mode_of_instruction_teaching_staff($teaching_staff);
            }
        }
        $this->save();
    }

}
