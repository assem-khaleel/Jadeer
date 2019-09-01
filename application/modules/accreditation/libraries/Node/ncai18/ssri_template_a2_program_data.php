<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of template_a2_program_data
 *
 * @author ahmadgx
 */
class Ssri_Template_A2_Program_Data extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = ' Programs Data';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

        $this->set_college('');

        $this->set_program_foundation(array());
        $this->set_num_of_graduates(array());

        $this->set_student_enrollment(array());
        $this->set_student_enrollment_note();

        $this->set_teaching_staff(array());
        $this->set_teaching_staff_note();

//       $this->set_student_rate(array());
        $this->set_std_rate();
        $this->set_std_rate_undergraduate(array());
        $this->set_std_rate_master(array());
        $this->set_std_rate_doctorate(array());


        $this->set_summary(array());
    }

    public function set_college($value)
    {
        $property = new \Orm_Property_Text('college', $value);
        $property->set_description('College');
        $this->set_property($property);
    }

    public function get_college()
    {
        return $this->get_property('college')->get_value();
    }

    /*
     * program foundation
     */

    public function set_program_foundation($value)
    {
        $property = new \Orm_Property_Table_Dynamic('program_foundation', $value);
        $property->set_description('Preparatory or Foundation Programs');
        $property->set_group('foundation');

        $stream_or_sections = new \Orm_Property_Text('stream_or_sections');
        $stream_or_sections->set_description('Streams or Sections');
        $stream_or_sections->set_width(200);
        $property->add_property($stream_or_sections);

        $male_student = new \Orm_Property_Text('male_student');
        $male_student->set_description('Male Students');
        $male_student->set_width(100);
        $property->add_property($male_student);

        $female_student = new \Orm_Property_Text('female_student');
        $female_student->set_description('Female Students');
        $female_student->set_width(100);
        $property->add_property($female_student);

        $total_student = new \Orm_Property_Text('total_student');
        $total_student->set_description('Total  Students');
        $total_student->set_width(100);
        $property->add_property($total_student);

        $teaching_staff = new \Orm_Property_Text('teaching_staff');
        $teaching_staff->set_description('Number of Teaching Staff (full time as defined by the Comprehensive Regulations of Saudi Faculties and Similar Staff Affairs)');
        $teaching_staff->set_width(180);
        $property->add_property($teaching_staff);

        $this->set_property($property);
    }

    public function get_program_foundation()
    {
        return $this->get_property('program_foundation')->get_value();
    }

    public function set_num_of_graduates($value)
    {
        $undergraduate_students = new \Orm_Property_Text('undergraduate_students');
        $post_graduate_masters_students = new \Orm_Property_Text('post_graduate_masters_students');
        $post_graduate_ph_d_students = new \Orm_Property_Text('post_graduate_ph_d_students');

        $property = new \Orm_Property_Table('num_of_graduates', $value);
        $property->set_description('Number of Graduates in the Most Recent Year');
        $property->set_group('graduates');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('', ''));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('undergraduate_students', 'Undergraduate students'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('post_graduate_masters_students', 'Post Graduate Masters Students'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('post_graduate_ph_d_students', 'Post Graduate Ph.D. Students'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('male', 'Male'));
        $property->add_cell(2, 2, $undergraduate_students);
        $property->add_cell(2, 3, $post_graduate_masters_students);
        $property->add_cell(2, 4, $post_graduate_ph_d_students);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('female', 'Female'));
        $property->add_cell(3, 2, $undergraduate_students);
        $property->add_cell(3, 3, $post_graduate_masters_students);
        $property->add_cell(3, 4, $post_graduate_ph_d_students);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('total', 'Total'));
        $property->add_cell(4, 2, $undergraduate_students);
        $property->add_cell(4, 3, $post_graduate_masters_students);
        $property->add_cell(4, 4, $post_graduate_ph_d_students);


        $this->set_property($property);
    }

    public function get_num_of_graduates()
    {
        return $this->get_property('num_of_graduates')->get_value();
    }

    public function set_student_enrollment($value)
    {
        $full_time = new \Orm_Property_Fixedtext('full_time', 'Full time');
        $part_time = new \Orm_Property_Fixedtext('part_time', 'Part time');
        $fte = new \Orm_Property_Fixedtext('fte', 'FTE');

        $on_campus_ft = new \Orm_Property_Text('on_campus_ft');
        $on_campus_pt = new \Orm_Property_Text('on_campus_pt');
        $on_campus_fte = new \Orm_Property_Text('on_campus_fte');

        $distance_education_programs_ft = new \Orm_Property_Text('distance_education_programs_ft');
        $distance_education_programs_pt = new \Orm_Property_Text('distance_education_programs_pt');
        $distance_education_programs_fte = new \Orm_Property_Text('distance_education_programs_fte');

        $property = new \Orm_Property_Table('student_enrollment', $value);
        $property->set_description('Mode of Instruction – Student Enrollment (excluding preparatory program)');
        $property->set_group('enrollment');

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
        $property->add_cell(3, 2, $on_campus_ft);
        $property->add_cell(3, 3, $on_campus_pt);
        $property->add_cell(3, 4, $on_campus_fte);
        $property->add_cell(3, 5, $distance_education_programs_ft);
        $property->add_cell(3, 6, $distance_education_programs_pt);
        $property->add_cell(3, 7, $distance_education_programs_fte);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('female', 'Female'));
        $property->add_cell(4, 2, $on_campus_ft);
        $property->add_cell(4, 3, $on_campus_pt);
        $property->add_cell(4, 4, $on_campus_fte);
        $property->add_cell(4, 5, $distance_education_programs_ft);
        $property->add_cell(4, 6, $distance_education_programs_pt);
        $property->add_cell(4, 7, $distance_education_programs_fte);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('total', 'Total'));
        $property->add_cell(5, 2, $on_campus_ft);
        $property->add_cell(5, 3, $on_campus_pt);
        $property->add_cell(5, 4, $on_campus_fte);
        $property->add_cell(5, 5, $distance_education_programs_ft);
        $property->add_cell(5, 6, $distance_education_programs_pt);
        $property->add_cell(5, 7, $distance_education_programs_fte);

        $this->set_property($property);
    }

    public function get_student_enrollment()
    {
        return $this->get_property('student_enrollment')->get_value();
    }

    /*
     * note
     */

    public function set_student_enrollment_note()
    {
        $property = new \Orm_Property_Fixedtext('student_enrollment_note', '<strong>Note : </strong>FTE (FTE means “full-time equivalent” according to MOE definitions, see the by-laws regulating university staff and faculty members).');
        $property->set_group('enrollment');
        $this->set_property($property);
    }

    public function get_student_enrollment_note()
    {
        return $this->get_property('student_enrollment_note')->get_value();
    }

    public function set_teaching_staff($value)
    {
        $full_time = new \Orm_Property_Fixedtext('full_time', 'Full time');
        $part_time = new \Orm_Property_Fixedtext('part_time', 'Part time');
        $fte = new \Orm_Property_Fixedtext('fte', 'FTE');

        $on_campus_ft = new \Orm_Property_Text('on_campus_ft');
        $on_campus_pt = new \Orm_Property_Text('on_campus_pt');
        $on_campus_fte = new \Orm_Property_Text('on_campus_fte');

        $distance_education_programs_ft = new \Orm_Property_Text('distance_education_programs_ft');
        $distance_education_programs_pt = new \Orm_Property_Text('distance_education_programs_pt');
        $distance_education_programs_fte = new \Orm_Property_Text('distance_education_programs_fte');

        $property = new \Orm_Property_Table('teaching_staff', $value);
        $property->set_description('Mode of Instruction – Teaching Staff (excluding preparatory program)');
        $property->set_group('staff');

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
        $property->add_cell(3, 2, $on_campus_ft);
        $property->add_cell(3, 3, $on_campus_pt);
        $property->add_cell(3, 4, $on_campus_fte);
        $property->add_cell(3, 5, $distance_education_programs_ft);
        $property->add_cell(3, 6, $distance_education_programs_pt);
        $property->add_cell(3, 7, $distance_education_programs_fte);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('female', 'Female'));
        $property->add_cell(4, 2, $on_campus_ft);
        $property->add_cell(4, 3, $on_campus_pt);
        $property->add_cell(4, 4, $on_campus_fte);
        $property->add_cell(4, 5, $distance_education_programs_ft);
        $property->add_cell(4, 6, $distance_education_programs_pt);
        $property->add_cell(4, 7, $distance_education_programs_fte);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('total', 'Total'));
        $property->add_cell(5, 2, $on_campus_ft);
        $property->add_cell(5, 3, $on_campus_pt);
        $property->add_cell(5, 4, $on_campus_fte);
        $property->add_cell(5, 5, $distance_education_programs_ft);
        $property->add_cell(5, 6, $distance_education_programs_pt);
        $property->add_cell(5, 7, $distance_education_programs_fte);

        $this->set_property($property);
    }

    public function get_teaching_staff()
    {
        return $this->get_property('teaching_staff')->get_value();
    }

    /*
     * note
     */

    public function set_teaching_staff_note()
    {
        $property = new \Orm_Property_Fixedtext('teaching_staff_note', '<strong>Note : </strong>Teaching staff includes tutors, lectures, and assistant, associate and full professors. This does not include research, teaching, or laboratory assistants. Academic staff who oversee the planning and delivery of teaching programs are included (e.g. head of department, dean for a college, rector and vice rectors).');
        $property->set_group('staff');
        $this->set_property($property);
    }

    public function get_teaching_staff_note()
    {
        return $this->get_property('teaching_staff_note')->get_value();
    }

    /*Start Apparent Student Completion Rate*/

    public function set_std_rate()
    {
        $property = new \Orm_Property_Fixedtext('std_rate', '<strong>Apparent Student Completion Rate: </strong>The number of students who graduated in the most recent year as a percentage of those who commenced those programs in that cohort four, five, or six years previously (e.g. for a four year program the number of students who graduated as a percentage who commenced the program four years previously).');
        $property->set_group('rating');
        $this->set_property($property);
    }

    public function get_std_rate()
    {
        return $this->get_property('std_rate')->get_value();
    }


    public function set_std_rate_undergraduate($value)
    {

        $enroll_std = new \Orm_Property_Text('enroll_std');
        $graduate_std = new \Orm_Property_Text('graduate_std');
        $rate = new \Orm_Property_Text('rate');

        $property = new \Orm_Property_Table('std_rate_undergraduate', $value);
        $property->set_description('Undergraduate Programs.');
        $property->set_group('rating');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('student', 'Student'));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('enroll', 'Students enrolled 4, 5, or 6 years ago, in accordance with duration of the program.'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('graduate', 'Number of students that graduated in the specified time, in accordance with duration of the program.'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('completion_rate', 'Apparent program completion rate'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('male', 'Male'));
        $property->add_cell(2, 2, $enroll_std);
        $property->add_cell(2, 3, $graduate_std);
        $property->add_cell(2, 4, $rate);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('female', 'Female'));
        $property->add_cell(3, 2, $enroll_std);
        $property->add_cell(3, 3, $graduate_std);
        $property->add_cell(3, 4, $rate);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('total', 'Total'));
        $property->add_cell(4, 2, $enroll_std);
        $property->add_cell(4, 3, $graduate_std);
        $property->add_cell(4, 4, $rate);

        $this->set_property($property);


    }

    public function get_std_rate_undergraduate()
    {
        return $this->get_property('std_rate_undergraduate')->get_value();
    }

    public function set_std_rate_master($value)
    {

        $enroll_std = new \Orm_Property_Text('enroll_std');
        $graduate_std = new \Orm_Property_Text('graduate_std');
        $rate = new \Orm_Property_Text('rate');

        $property = new \Orm_Property_Table('std_rate_master', $value);
        $property->set_description('Master Programs.');
        $property->set_group('rating');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('student', 'Student'));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('enroll', 'Students enrolled 2, 3, or 4 years ago, in accordance with duration of the program.'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('graduate', 'Number of students that graduated in the specified time, in accordance with duration of the program.'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('completion_rate', 'Apparent program completion rate'));


        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('male', 'Male'));
        $property->add_cell(2, 2, $enroll_std);
        $property->add_cell(2, 3, $graduate_std);
        $property->add_cell(2, 4, $rate);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('female', 'Female'));
        $property->add_cell(3, 2, $enroll_std);
        $property->add_cell(3, 3, $graduate_std);
        $property->add_cell(3, 4, $rate);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('total', 'Total'));
        $property->add_cell(4, 2, $enroll_std);
        $property->add_cell(4, 3, $graduate_std);
        $property->add_cell(4, 4, $rate);

        $this->set_property($property);


    }

    public function get_std_rate_master()
    {
        return $this->get_property('std_rate_master')->get_value();
    }
    public function set_std_rate_doctorate($value)
    {

        $enroll_std = new \Orm_Property_Text('enroll_std');
        $graduate_std = new \Orm_Property_Text('graduate_std');
        $rate = new \Orm_Property_Text('rate');

        $property = new \Orm_Property_Table('std_rate_doctorate', $value);
        $property->set_description('Doctorate Programs');
        $property->set_group('rating');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('student', 'Student'));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('enroll', 'Students enrolled 3,4, or 5 years ago, in accordance with duration of the program.'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('graduate', 'Number of students that graduated in the specified time, in accordance with duration of the program.'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('completion_rate', 'Apparent program completion rate'));


        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('male', 'Male'));
        $property->add_cell(2, 2, $enroll_std);
        $property->add_cell(2, 3, $graduate_std);
        $property->add_cell(2, 4, $rate);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('female', 'Female'));
        $property->add_cell(3, 2, $enroll_std);
        $property->add_cell(3, 3, $graduate_std);
        $property->add_cell(3, 4, $rate);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('total', 'Total'));
        $property->add_cell(4, 2, $enroll_std);
        $property->add_cell(4, 3, $graduate_std);
        $property->add_cell(4, 4, $rate);

        $this->set_property($property);


    }

    public function get_std_rate_doctorate()
    {
        return $this->get_property('std_rate_doctorate')->get_value();
    }


    /* end of student completion rate */

    public function set_summary($value)
    {
        $land_area = new \Orm_Property_Text('land_area');
        $land_area_per_student = new \Orm_Property_Text('land_area_per_student');
        $total_building_space = new \Orm_Property_Text('total_building_space');
        $building_space_per_student = new \Orm_Property_Text('building_space_per_student');

        $property = new \Orm_Property_Table('summary', $value);
        $property->set_description('Land and Building Summary');
        $property->set_group('summary');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('', ''));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('land_area', 'Total Land Area (Square Meters)'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('land_area_per_student', 'Land Area per Student (Square Meters)'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('total_building_space', 'Total Building Space (Square Meters)'));
        $property->add_cell(1, 5, new \Orm_Property_Fixedtext('building_space_per_student', 'Building Space per Student (Square Meters)'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('main_campus', 'Main Campus'));
        $property->add_cell(2, 2, $land_area);
        $property->add_cell(2, 3, $land_area_per_student);
        $property->add_cell(2, 4, $total_building_space);
        $property->add_cell(2, 5, $building_space_per_student);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('a_Branch_Location', 'a. Branch / Location'));
        $property->add_cell(3, 2, $land_area);
        $property->add_cell(3, 3, $land_area_per_student);
        $property->add_cell(3, 4, $total_building_space);
        $property->add_cell(3, 5, $building_space_per_student);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('b_Branch_Location', 'b. Branch / Location'));
        $property->add_cell(4, 2, $land_area);
        $property->add_cell(4, 3, $land_area_per_student);
        $property->add_cell(4, 4, $total_building_space);
        $property->add_cell(4, 5, $building_space_per_student);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('c_Branch_Location', 'c. Branch / Location'));
        $property->add_cell(5, 2, $land_area);
        $property->add_cell(5, 3, $land_area_per_student);
        $property->add_cell(5, 4, $total_building_space);
        $property->add_cell(5, 5, $building_space_per_student);

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('d_Branch_Location', 'd. Branch / Location'));
        $property->add_cell(6, 2, $land_area);
        $property->add_cell(6, 3, $land_area_per_student);
        $property->add_cell(6, 4, $total_building_space);
        $property->add_cell(6, 5, $building_space_per_student);

        $property->add_cell(7, 1, new \Orm_Property_Fixedtext('e_Branch_Location', 'e. Branch / Location'));
        $property->add_cell(7, 2, $land_area);
        $property->add_cell(7, 3, $land_area_per_student);
        $property->add_cell(7, 4, $total_building_space);
        $property->add_cell(7, 5, $building_space_per_student);

        $property->add_cell(8, 1, new \Orm_Property_Fixedtext('f_Branch_Location', 'f. Branch / Location'));
        $property->add_cell(8, 2, $land_area);
        $property->add_cell(8, 3, $land_area_per_student);
        $property->add_cell(8, 4, $total_building_space);
        $property->add_cell(8, 5, $building_space_per_student);

        $property->add_cell(9, 1, new \Orm_Property_Fixedtext('g_Branch_Location', 'g. Branch / Location'));
        $property->add_cell(9, 2, $land_area);
        $property->add_cell(9, 3, $land_area_per_student);
        $property->add_cell(9, 4, $total_building_space);
        $property->add_cell(9, 5, $building_space_per_student);

        $property->add_cell(10, 1, new \Orm_Property_Fixedtext('total', 'Total'));
        $property->add_cell(10, 2, $land_area);
        $property->add_cell(10, 3, $land_area_per_student);
        $property->add_cell(10, 4, $total_building_space);
        $property->add_cell(10, 5, $building_space_per_student);

        $this->set_property($property);
    }

    public function get_summary()
    {
        return $this->get_property('summary')->get_value();
    }

    public function get_program_data()
    {
        return $this->get_property('program_data')->get_value();
    }

    /**
     * @return \Orm_College
     */
    public function get_item_obj()
    {
        return \Orm_College::get_instance($this->get_item_id());
    }

    public function after_node_load()
    {
        parent::after_node_load();

        $college = $this->get_item_obj();
        $this->set_college($college->get_name('english'));
    }

    public function header_actions(&$actions = array())
    {

        if (\Orm::get_ci()->config->item('integration_enabled')) {
            if ($this->check_if_editable()) {
                $actions[] = array(
                    'class' => 'btn',
                    'title' => '<i class="fa fa-database"></i> ' . lang('Integration'),
                    'extra' => 'onclick="integration(this, ' . $this->get_id() . ');" ' . data_loading_text(true)
                );
            }
        }

        return parent::header_actions($actions);
    }

    public function integration_processes()
    {
        parent::integration_processes();
        if (\Orm::get_ci()->config->item('integration_enabled')) {

            $college = $this->get_item_id();

            $preparatory = \Orm_Data_Preparatory_Year::get_by_year($this->get_year());
            $total_faculty_male = 0;
            $total_faculty_female = 0;
            $prep = array();

            foreach ($preparatory as $key => $ay) {

                $faculty_male = \Orm_Data_Preparatory_Year_Faculty::get_one(array('stream' => $ay['stream'], 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_MALE))->get_teacher_count();
                $faculty_female = \Orm_Data_Preparatory_Year_Faculty::get_one(array('stream' => $ay['stream'], 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_FEMALE))->get_teacher_count();
                $total_faculty = $faculty_male + $faculty_female;

                $total_faculty_male += $faculty_male;
                $total_faculty_female += $faculty_female;

                $prep[$key]['stream_or_sections'] = $ay['stream'];
                $prep[$key]['male_student'] = $ay['SAUDI_MALE'] + $ay['NONESAUDI_MALE'];
                $prep[$key]['female_student'] = $ay['SAUDI_FEMALE'] + $ay['NONESAUDI_FEMALE'];
                $prep[$key]['total_student'] = $ay['SAUDI_MALE'] + $ay['NONESAUDI_MALE'] + $ay['SAUDI_FEMALE'] + $ay['NONESAUDI_FEMALE'];
                $prep[$key]['teaching_staff'] = $total_faculty;
                $this->set_program_foundation($prep);
            }

            $graduates = array();

            $bsc_programs = array_column(\Orm_Program::get_model()->get_all(array('college_id' => $college, 'degree_status' => \Orm_Degree::DEGREE_UNDERGRAUDATE_BACHELOR), 0, 0, array(), \Orm::FETCH_ARRAY), 'id');
            $master_programs = array_column(\Orm_Program::get_model()->get_all(array('college_id' => $college, 'degree_status' => \Orm_Degree::DEGREE_POSTGRAUDATE_MASTER), 0, 0, array(), \Orm::FETCH_ARRAY), 'id');
            $phd_programs = array_column(\Orm_Program::get_model()->get_all(array('college_id' => $college, 'degree_status' => \Orm_Degree::DEGREE_POSTGRAUDATE_DOCTOR), 0, 0, array(), \Orm::FETCH_ARRAY), 'id');
            $bsc_programs[] = 0;
            $master_programs[] = 0;
            $phd_programs[] = 0;

            $graduates[2][2]['undergraduate_students'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_programs, 'gender' => \Orm_User::GENDER_MALE, 'academic_year' => $this->get_year()), 'graduate');
            $graduates[2][3]['post_graduate_masters_students'] = \Orm_Data_Graduate::get_sum(array('program_in' => $master_programs, 'gender' => \Orm_User::GENDER_MALE, 'academic_year' => $this->get_year()), 'graduate');
            $graduates[2][4]['post_graduate_ph_d_students'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_programs, 'gender' => \Orm_User::GENDER_MALE, 'academic_year' => $this->get_year()), 'graduate');
            $graduates[3][2]['undergraduate_students'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_programs, 'gender' => \Orm_User::GENDER_FEMALE, 'academic_year' => $this->get_year()), 'graduate');
            $graduates[3][3]['post_graduate_masters_students'] = \Orm_Data_Graduate::get_sum(array('program_in' => $master_programs, 'gender' => \Orm_User::GENDER_FEMALE, 'academic_year' => $this->get_year()), 'graduate');
            $graduates[3][4]['post_graduate_ph_d_students'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_programs, 'gender' => \Orm_User::GENDER_FEMALE, 'academic_year' => $this->get_year()), 'graduate');
            $graduates[4][2]['undergraduate_students'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_programs, 'academic_year' => $this->get_year()), 'graduate');
            $graduates[4][3]['post_graduate_masters_students'] = \Orm_Data_Graduate::get_sum(array('program_in' => $master_programs, 'academic_year' => $this->get_year()), 'graduate');
            $graduates[4][4]['post_graduate_ph_d_students'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_programs, 'academic_year' => $this->get_year()), 'graduate');

            $this->set_num_of_graduates($graduates);

            $enrolled = array();

            $college_programs = array_column(\Orm_Program::get_model()->get_all(array('college_id' => $college), 0, 0, array(), \Orm::FETCH_ARRAY), 'id');
            $college_programs[] = 0;

            $enrolled[3][2]['on_campus_ft'] = \Orm_Data_Graduate::get_sum(array('program_in' => $college_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_MALE), 'enrolled');
            $enrolled[3][3]['on_campus_pt'] = 0;
            $enrolled[3][4]['on_campus_fte'] = 0;
            $enrolled[3][5]['distance_education_programs_ft'] = 0;
            $enrolled[3][6]['distance_education_programs_pt'] = 0;
            $enrolled[3][7]['distance_education_programs_fte'] = 0;
            $enrolled[4][2]['on_campus_ft'] = \Orm_Data_Graduate::get_sum(array('program_in' => $college_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_FEMALE), 'enrolled');
            $enrolled[4][3]['on_campus_pt'] = 0;
            $enrolled[4][4]['on_campus_fte'] = 0;
            $enrolled[4][5]['distance_education_programs_ft'] = 0;
            $enrolled[4][6]['distance_education_programs_pt'] = 0;
            $enrolled[4][7]['distance_education_programs_fte'] = 0;
            $enrolled[5][2]['on_campus_ft'] = \Orm_Data_Graduate::get_sum(array('program_in' => $college_programs, 'academic_year' => $this->get_year()), 'enrolled');
            $enrolled[5][3]['on_campus_pt'] = 0;
            $enrolled[5][4]['on_campus_fte'] = 0;
            $enrolled[5][5]['distance_education_programs_ft'] = 0;
            $enrolled[5][6]['distance_education_programs_pt'] = 0;
            $enrolled[5][7]['distance_education_programs_fte'] = 0;

            $this->set_student_enrollment($enrolled);

            $teaching_staff = array();

            $teaching_staff[3][2]['on_campus_ft'] = \Orm_User_Faculty::get_count(array('college_id' => $college, 'gender' => \Orm_User::GENDER_MALE));
            $teaching_staff[3][3]['on_campus_pt'] = 0;
            $teaching_staff[3][4]['on_campus_fte'] = 0;
            $teaching_staff[3][5]['distance_education_programs_ft'] = 0;
            $teaching_staff[3][6]['distance_education_programs_pt'] = 0;
            $teaching_staff[3][7]['distance_education_programs_fte'] = 0;

            $teaching_staff[4][2]['on_campus_ft'] = \Orm_User_Faculty::get_count(array('college_id' => $college, 'gender' => \Orm_User::GENDER_FEMALE));
            $teaching_staff[4][3]['on_campus_pt'] = 0;
            $teaching_staff[4][4]['on_campus_fte'] = 0;
            $teaching_staff[4][5]['distance_education_programs_ft'] = 0;
            $teaching_staff[4][6]['distance_education_programs_pt'] = 0;
            $teaching_staff[4][7]['distance_education_programs_fte'] = 0;

            $teaching_staff[5][2]['on_campus_ft'] = \Orm_User_Faculty::get_count(array('college_id' => $college));
            $teaching_staff[5][3]['on_campus_pt'] = 0;
            $teaching_staff[5][4]['on_campus_fte'] = 0;
            $teaching_staff[5][5]['distance_education_programs_ft'] = 0;
            $teaching_staff[5][6]['distance_education_programs_pt'] = 0;
            $teaching_staff[5][7]['distance_education_programs_fte'] = 0;


            $this->set_teaching_staff($teaching_staff);

            $bsc = array();

            $bsc_programs = array_column(\Orm_Program::get_model()->get_all(array('college_id' => $college, 'degree_status' => \Orm_Degree::DEGREE_UNDERGRAUDATE_BACHELOR), 0, 0, array(), \Orm::FETCH_ARRAY), 'id');
            $bsc_programs[] = 0;

            $bsc[2][2]['enroll_std'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_programs, 'gender' => \Orm_User::GENDER_MALE, 'academic_year' => $this->get_year()), 'enrolled');
            $bsc[2][3]['graduate_std'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_programs, 'gender' => \Orm_User::GENDER_MALE, 'academic_year' => $this->get_year()), 'graduate');
            $bsc[2][4]['rate'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $bsc_programs, 'gender' => \Orm_User::GENDER_MALE, 'academic_year' => $this->get_year()));
            $bsc[3][2]['enroll_std'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_programs, 'gender' => \Orm_User::GENDER_FEMALE, 'academic_year' => $this->get_year()), 'enrolled');
            $bsc[3][3]['graduate_std'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_programs, 'gender' => \Orm_User::GENDER_FEMALE, 'academic_year' => $this->get_year()), 'graduate');
            $bsc[3][4]['rate'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $bsc_programs, 'gender' => \Orm_User::GENDER_FEMALE, 'academic_year' => $this->get_year()));
            $bsc[4][2]['enroll_std'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_programs, 'academic_year' => $this->get_year()), 'enrolled');
            $bsc[4][3]['graduate_std'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_programs, 'academic_year' => $this->get_year()), 'graduate');
            $bsc[4][4]['rate'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $bsc_programs, 'academic_year' => $this->get_year()));


            $this->set_std_rate_undergraduate($bsc);

            $master = array();
            $master_programs = array_column(\Orm_Program::get_model()->get_all(array('college_id' => $college, 'degree_status' => \Orm_Degree::DEGREE_POSTGRAUDATE_MASTER), 0, 0, array(), \Orm::FETCH_ARRAY), 'id');
            $master_programs[] = 0;

            $master[2][2]['enroll_std'] = \Orm_Data_Graduate::get_sum(array('program_in' => $master_programs, 'gender' => \Orm_User::GENDER_MALE, 'academic_year' => $this->get_year()), 'enrolled');
            $master[2][3]['graduate_std'] = \Orm_Data_Graduate::get_sum(array('program_in' => $master_programs, 'gender' => \Orm_User::GENDER_MALE, 'academic_year' => $this->get_year()), 'graduate');
            $master[2][4]['rate'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $master_programs, 'gender' => \Orm_User::GENDER_MALE, 'academic_year' => $this->get_year()));
            $master[3][2]['enroll_std'] = \Orm_Data_Graduate::get_sum(array('program_in' => $master_programs, 'gender' => \Orm_User::GENDER_FEMALE, 'academic_year' => $this->get_year()), 'enrolled');
            $master[3][3]['graduate_std'] = \Orm_Data_Graduate::get_sum(array('program_in' => $master_programs, 'gender' => \Orm_User::GENDER_FEMALE, 'academic_year' => $this->get_year()), 'graduate');
            $master[3][4]['rate'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $master_programs, 'gender' => \Orm_User::GENDER_FEMALE, 'academic_year' => $this->get_year()));
            $master[4][2]['enroll_std'] = \Orm_Data_Graduate::get_sum(array('program_in' => $master_programs, 'academic_year' => $this->get_year()), 'enrolled');
            $master[4][3]['graduate_std'] = \Orm_Data_Graduate::get_sum(array('program_in' => $master_programs, 'academic_year' => $this->get_year()), 'graduate');
            $master[4][4]['rate'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $master_programs, 'academic_year' => $this->get_year()));


            $this->set_std_rate_master($master);
            $phd = array();
            $phd_programs = array_column(\Orm_Program::get_model()->get_all(array('college_id' => $college, 'degree_status' => \Orm_Degree::DEGREE_POSTGRAUDATE_DOCTOR), 0, 0, array(), \Orm::FETCH_ARRAY), 'id');
            $phd_programs[] = 0;


            $phd[2][2]['enroll_std'] = \Orm_Data_Graduate::get_sum(array('program_in' => $master_programs, 'gender' => \Orm_User::GENDER_MALE, 'academic_year' => $this->get_year()), 'enrolled');
            $phd[2][3]['graduate_std'] = \Orm_Data_Graduate::get_sum(array('program_in' => $master_programs, 'gender' => \Orm_User::GENDER_MALE, 'academic_year' => $this->get_year()), 'graduate');
            $phd[2][4]['rate'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $master_programs, 'gender' => \Orm_User::GENDER_MALE, 'academic_year' => $this->get_year()));
            $phd[3][2]['enroll_std'] = \Orm_Data_Graduate::get_sum(array('program_in' => $master_programs, 'gender' => \Orm_User::GENDER_FEMALE, 'academic_year' => $this->get_year()), 'enrolled');
            $phd[3][3]['graduate_std'] = \Orm_Data_Graduate::get_sum(array('program_in' => $master_programs, 'gender' => \Orm_User::GENDER_FEMALE, 'academic_year' => $this->get_year()), 'graduate');
            $phd[3][4]['rate'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $master_programs, 'gender' => \Orm_User::GENDER_FEMALE, 'academic_year' => $this->get_year()));
            $phd[4][2]['enroll_std'] = \Orm_Data_Graduate::get_sum(array('program_in' => $master_programs, 'academic_year' => $this->get_year()), 'enrolled');
            $phd[4][3]['graduate_std'] = \Orm_Data_Graduate::get_sum(array('program_in' => $master_programs, 'academic_year' => $this->get_year()), 'graduate');
            $phd[4][4]['rate'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $master_programs, 'academic_year' => $this->get_year()));



            $this->set_std_rate_doctorate($phd);

            $students_count = \Orm_Data_Graduate::get_sum(array('college_id' => $college, 'academic_year' => $this->get_year()), 'enrolled');

            $college_obj = \Orm_College::get_instance($college);
            $summary[2][2]['land_area'] = $college_obj->get_area();
            $summary[2][3]['land_area_per_student'] = $students_count ? round($college_obj->get_area() / $students_count, 2) : 0;
            $summary[2][4]['total_building_space'] = $college_obj->get_size();
            $summary[2][5]['building_space_per_student'] = $students_count ? round($college_obj->get_size() / $students_count, 2) : 0;

            $summary[7][2]['land_area'] = $college_obj->get_area();
            $summary[7][3]['land_area_per_student'] = $students_count ? round($college_obj->get_area() / $students_count, 2) : 0;
            $summary[7][4]['total_building_space'] = $college_obj->get_size();
            $summary[7][5]['building_space_per_student'] = $students_count ? round($college_obj->get_size() / $students_count, 2) : 0;

            $this->set_summary($summary);

            $this->save();
        }
    }
}