<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

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

            $this->set_student_rate(array());
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
        $teaching_staff->set_description('Number of Teaching Staff (full time equivalent equals teaching 15 credit hours per week)');
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
        $property->set_description('Number of Graduates in the Most Recent');
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
        $property = new \Orm_Property_Fixedtext('student_enrollment_note', '<strong>Note : </strong>FTE (full time equivalent) for part time students assume a full time load is 15 credit hours and divide the number of credit hours taken by each student by 15 (use this formula only for part time students).');
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
        $property = new \Orm_Property_Fixedtext('teaching_staff_note', '<strong>Note : </strong>Teaching staff includes tutors, lectures, and assistant, associate and full professors. This does not include research, teaching, or laboratory assistants. Academic staff who oversee the planning and delivery of teaching programs are included (e.g. head of department, dean for a college, rector and vice rectors). ');
        $property->set_group('staff');
        $this->set_property($property);
    }

    public function get_teaching_staff_note()
    {
        return $this->get_property('teaching_staff_note')->get_value();
    }

    public function set_student_rate($value)
    {

        $under_programs_4 = new \Orm_Property_Text('under_programs_4');
        $under_programs_5 = new \Orm_Property_Text('under_programs_5');
        $under_programs_6 = new \Orm_Property_Text('under_programs_6');

        $post_programs_master = new \Orm_Property_Text('post_programs_master');
        $post_programs_doctor = new \Orm_Property_Text('post_programs_doctor');

        $property = new \Orm_Property_Table('student_rate', $value);
        $property->set_description('Apparent Student Completion Rate: The number of students who graduated in the most recent year as a percentage of those who commenced those programs in that cohort four, five, or six years previously (e.g. for a four year program the number of students who graduated as a percentage who commenced the program four years previously).');
        $property->set_group('rating');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('student', 'Student'), 2, 0);
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('under_programs', 'Undergraduate Programs'), 0, 3);
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('post_programs', 'Postgraduate Programs'), 0, 2);

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('four_years', 'Four Years'));
        $property->add_cell(2, 2, new \Orm_Property_Fixedtext('five_years', 'Five Years'));
        $property->add_cell(2, 3, new \Orm_Property_Fixedtext('six_years', 'Six Years'));
        $property->add_cell(2, 4, new \Orm_Property_Fixedtext('master', 'Master'));
        $property->add_cell(2, 5, new \Orm_Property_Fixedtext('doctor', 'Doctor'));

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('male', 'Male'));
        $property->add_cell(3, 2, $under_programs_4);
        $property->add_cell(3, 3, $under_programs_5);
        $property->add_cell(3, 4, $under_programs_6);
        $property->add_cell(3, 5, $post_programs_master);
        $property->add_cell(3, 6, $post_programs_doctor);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('female', 'Female'));
        $property->add_cell(4, 2, $under_programs_4);
        $property->add_cell(4, 3, $under_programs_5);
        $property->add_cell(4, 4, $under_programs_6);
        $property->add_cell(4, 5, $post_programs_master);
        $property->add_cell(4, 6, $post_programs_doctor);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('total', 'Total'));
        $property->add_cell(5, 2, $under_programs_4);
        $property->add_cell(5, 3, $under_programs_5);
        $property->add_cell(5, 4, $under_programs_6);
        $property->add_cell(5, 5, $post_programs_master);
        $property->add_cell(5, 6, $post_programs_doctor);

        $this->set_property($property);
    }

    public function get_student_rate()
    {
        return $this->get_property('student_rate')->get_value();
    }

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

        $property->add_cell(7, 1, new \Orm_Property_Fixedtext('total', 'Total'));
        $property->add_cell(7, 2, $land_area);
        $property->add_cell(7, 3, $land_area_per_student);
        $property->add_cell(7, 4, $total_building_space);
        $property->add_cell(7, 5, $building_space_per_student);

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

    public function header_actions(&$actions = array()) {

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

    public function integration_processes() {
        parent::integration_processes();
        if (\Orm::get_ci()->config->item('integration_enabled')) {
            $college = $this->get_item_id();

            $preparatory = \Orm_Data_Preparatory_Year::get_by_year($this->get_year());
            $medicine = array();
            $engineering = array();
            $humanities = array();
            $community = array(
                'stream' => 'Community Students',
                'SAUDI_MALE' => 0,
                'NONESAUDI_MALE' => 0,
                'SAUDI_FEMALE' => 0,
                'NONESAUDI_FEMALE' => 0
            );

            foreach ($preparatory as $ay) {
                if ($ay['stream'] == 'Health Science Track') {
                    $medicine = $ay;
                } elseif ($ay['stream'] == 'Science/Engineering Track') {
                    $engineering = $ay;
                } elseif ($ay['stream'] == 'Humanities Track') {
                    $humanities = $ay;
                } elseif ($ay['stream'] == 'Community Students') {
                    $community = $ay;
                }
            }

            $total_faculty_male = 0;
            $total_faculty_female = 0;

            if (!empty($engineering) || !empty($humanities) || !empty($medicine)) {

                if (in_array($college,array(1,19,16,13,11))) { //Science

                    $faculty_male = \Orm_Data_Preparatory_Year_Faculty::get_one(array('stream' => $engineering['stream'],'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_MALE))->get_teacher_count();
                    $faculty_female = \Orm_Data_Preparatory_Year_Faculty::get_one(array('stream' => $engineering['stream'],'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_FEMALE))->get_teacher_count();
                    $total_faculty  = $faculty_male + $faculty_female;

                    $prep[0]['stream_or_sections'] = $engineering['stream'];
                    $prep[0]['male_student'] = $engineering['SAUDI_MALE'] + $engineering['NONESAUDI_MALE'];
                    $prep[0]['female_student'] = $engineering['SAUDI_FEMALE'] + $engineering['NONESAUDI_FEMALE'];
                    $prep[0]['total_student'] = $engineering['SAUDI_MALE'] + $engineering['NONESAUDI_MALE'] + $engineering['SAUDI_FEMALE'] + $engineering['NONESAUDI_FEMALE'];
                    $prep[0]['teaching_staff'] = $total_faculty;

                } elseif (in_array($college,array(21,4,7,8,2,20,6,14,18))) { //Humanities

                    $faculty_male = \Orm_Data_Preparatory_Year_Faculty::get_one(array('stream' => $humanities['stream'],'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_MALE))->get_teacher_count();
                    $faculty_female = \Orm_Data_Preparatory_Year_Faculty::get_one(array('stream' => $humanities['stream'],'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_FEMALE))->get_teacher_count();
                    $total_faculty  = $faculty_male + $faculty_female;

                    $prep[0]['stream_or_sections'] = $humanities['stream'];
                    $prep[0]['male_student'] = $humanities['SAUDI_MALE'] + $humanities['NONESAUDI_MALE'];
                    $prep[0]['female_student'] = $humanities['SAUDI_FEMALE'] + $humanities['NONESAUDI_FEMALE'];
                    $prep[0]['total_student'] = $humanities['SAUDI_MALE'] + $humanities['NONESAUDI_MALE'] + $humanities['SAUDI_FEMALE'] + $humanities['NONESAUDI_FEMALE'];
                    $prep[0]['teaching_staff'] = $total_faculty;

                } elseif (in_array($college, array(9, 12, 5, 17, 10, 3, 34))) { //Medical

                    $faculty_male = \Orm_Data_Preparatory_Year_Faculty::get_one(array('stream' => $medicine['stream'],'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_MALE))->get_teacher_count();
                    $faculty_female = \Orm_Data_Preparatory_Year_Faculty::get_one(array('stream' => $medicine['stream'],'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_FEMALE))->get_teacher_count();
                    $total_faculty  = $faculty_male + $faculty_female;

                    $prep[0]['stream_or_sections'] = $medicine['stream'];
                    $prep[0]['male_student'] = $medicine['SAUDI_MALE'] + $medicine['NONESAUDI_MALE'];
                    $prep[0]['female_student'] = $medicine['SAUDI_FEMALE'] + $medicine['NONESAUDI_FEMALE'];
                    $prep[0]['total_student'] = $medicine['SAUDI_MALE'] + $medicine['NONESAUDI_MALE'] + $medicine['SAUDI_FEMALE'] + $medicine['NONESAUDI_FEMALE'];
                    $prep[0]['teaching_staff'] = $total_faculty;
                } elseif (in_array($college, array(15))) { //Community

                    $faculty_male = \Orm_Data_Preparatory_Year_Faculty::get_one(array('stream' => $community['stream'],'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_MALE))->get_teacher_count();
                    $faculty_female = \Orm_Data_Preparatory_Year_Faculty::get_one(array('stream' => $community['stream'],'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_FEMALE))->get_teacher_count();
                    $total_faculty  = $faculty_male + $faculty_female;

                    $prep[0]['stream_or_sections'] = $community['stream'];
                    $prep[0]['male_student'] = $community['SAUDI_MALE'] + $community['NONESAUDI_MALE'];
                    $prep[0]['female_student'] = $community['SAUDI_FEMALE'] + $community['NONESAUDI_FEMALE'];
                    $prep[0]['total_student'] = $community['SAUDI_MALE'] + $community['NONESAUDI_MALE'] + $community['SAUDI_FEMALE'] + $community['NONESAUDI_FEMALE'];
                    $prep[0]['teaching_staff'] = $total_faculty;
                } else {
                    $prep = array();
                    foreach ($preparatory as $key => $ay) {

                        $faculty_male = \Orm_Data_Preparatory_Year_Faculty::get_one(array('stream' => $ay['stream'],'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_MALE))->get_teacher_count();
                        $faculty_female = \Orm_Data_Preparatory_Year_Faculty::get_one(array('stream' => $ay['stream'],'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_FEMALE))->get_teacher_count();
                        $total_faculty  = $faculty_male + $faculty_female;

                        $total_faculty_male += $faculty_male;
                        $total_faculty_female += $faculty_female;

                        $prep[$key]['stream_or_sections'] = $ay['stream'];
                        $prep[$key]['male_student'] = $ay['SAUDI_MALE'] + $ay['NONESAUDI_MALE'];
                        $prep[$key]['female_student'] = $ay['SAUDI_FEMALE'] + $ay['NONESAUDI_FEMALE'];
                        $prep[$key]['total_student'] = $ay['SAUDI_MALE'] + $ay['NONESAUDI_MALE'] + $ay['SAUDI_FEMALE'] + $ay['NONESAUDI_FEMALE'];
                        $prep[$key]['teaching_staff'] = $total_faculty;
                    }
                }
                $this->set_program_foundation($prep);
            }

            $graduates = array();

            $bsc_programs = array_column(\Orm_Program::get_model()->get_all(array('college_id' => $college,'degree_id' => 5) ,0,0, array(), \Orm::FETCH_ARRAY),'id');
            $master_programs = array_column(\Orm_Program::get_model()->get_all(array('college_id' => $college,'degree_id' => 8),0,0, array(), \Orm::FETCH_ARRAY),'id');
            $phd_programs = array_column(\Orm_Program::get_model()->get_all(array('college_id' => $college,'degree_id' => 10),0,0, array(), \Orm::FETCH_ARRAY),'id');
            $bsc_programs[] = 0;
            $master_programs[] = 0;
            $phd_programs[] = 0;

            $graduates[2][2]['undergraduate_students'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_programs,'gender' => \Orm_User::GENDER_MALE,'academic_year' => $this->get_year()),'graduate');
            $graduates[2][3]['post_graduate_masters_students'] = \Orm_Data_Graduate::get_sum(array('program_in' => $master_programs,'gender' => \Orm_User::GENDER_MALE,'academic_year' => $this->get_year()),'graduate');
            $graduates[2][4]['post_graduate_ph_d_students'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_programs,'gender' => \Orm_User::GENDER_MALE,'academic_year' => $this->get_year()),'graduate');
            $graduates[3][2]['undergraduate_students'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_programs,'gender' => \Orm_User::GENDER_FEMALE,'academic_year' => $this->get_year()),'graduate');
            $graduates[3][3]['post_graduate_masters_students'] = \Orm_Data_Graduate::get_sum(array('program_in' => $master_programs,'gender' => \Orm_User::GENDER_FEMALE,'academic_year' => $this->get_year()),'graduate');
            $graduates[3][4]['post_graduate_ph_d_students'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_programs,'gender' => \Orm_User::GENDER_FEMALE,'academic_year' => $this->get_year()),'graduate');
            $graduates[4][2]['undergraduate_students'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_programs,'academic_year' => $this->get_year()),'graduate');
            $graduates[4][3]['post_graduate_masters_students'] = \Orm_Data_Graduate::get_sum(array('program_in' => $master_programs,'academic_year' => $this->get_year()),'graduate');
            $graduates[4][4]['post_graduate_ph_d_students'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_programs,'academic_year' => $this->get_year()),'graduate');

            $this->set_num_of_graduates($graduates);

            $enrolled = array();

            $college_programs = array_column(\Orm_Program::get_model()->get_all(array('college_id' => $college),0,0, array(), \Orm::FETCH_ARRAY),'id');
            $college_programs[] = 0;

            $enrolled[3][2]['on_campus_ft'] = \Orm_Data_Graduate::get_sum(array('program_in' => $college_programs,'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_MALE),'enrolled');
            $enrolled[3][3]['on_campus_pt'] = 0;
            $enrolled[3][4]['on_campus_fte'] = 0;
            $enrolled[3][5]['distance_education_programs_ft'] = 0;
            $enrolled[3][6]['distance_education_programs_pt'] = 0;
            $enrolled[3][7]['distance_education_programs_fte'] = 0;
            $enrolled[4][2]['on_campus_ft'] = \Orm_Data_Graduate::get_sum(array('program_in' => $college_programs,'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_FEMALE),'enrolled');
            $enrolled[4][3]['on_campus_pt'] = 0;
            $enrolled[4][4]['on_campus_fte'] = 0;
            $enrolled[4][5]['distance_education_programs_ft'] = 0;
            $enrolled[4][6]['distance_education_programs_pt'] = 0;
            $enrolled[4][7]['distance_education_programs_fte'] = 0;
            $enrolled[5][2]['on_campus_ft'] = \Orm_Data_Graduate::get_sum(array('program_in' => $college_programs,'academic_year' => $this->get_year()),'enrolled');
            $enrolled[5][3]['on_campus_pt'] = 0;
            $enrolled[5][4]['on_campus_fte'] = 0;
            $enrolled[5][5]['distance_education_programs_ft'] = 0;
            $enrolled[5][6]['distance_education_programs_pt'] = 0;
            $enrolled[5][7]['distance_education_programs_fte'] = 0;

            $this->set_student_enrollment($enrolled);

            $teaching_staff = array();

            if ($college == 22) {
                $teaching_staff[3][2]['on_campus_ft'] = $total_faculty_male;
                $teaching_staff[3][3]['on_campus_pt'] = 0;
                $teaching_staff[3][4]['on_campus_fte'] = 0;
                $teaching_staff[3][5]['distance_education_programs_ft'] = 0;
                $teaching_staff[3][6]['distance_education_programs_pt'] = 0;
                $teaching_staff[3][7]['distance_education_programs_fte'] = 0;

                $teaching_staff[4][2]['on_campus_ft'] = $total_faculty_female;
                $teaching_staff[4][3]['on_campus_pt'] = 0;
                $teaching_staff[4][4]['on_campus_fte'] = 0;
                $teaching_staff[4][5]['distance_education_programs_ft'] = 0;
                $teaching_staff[4][6]['distance_education_programs_pt'] = 0;
                $teaching_staff[4][7]['distance_education_programs_fte'] = 0;

                $teaching_staff[5][2]['on_campus_ft'] = $total_faculty_male + $total_faculty_female;
                $teaching_staff[5][3]['on_campus_pt'] = 0;
                $teaching_staff[5][4]['on_campus_fte'] = 0;
                $teaching_staff[5][5]['distance_education_programs_ft'] = 0;
                $teaching_staff[5][6]['distance_education_programs_pt'] = 0;
                $teaching_staff[5][7]['distance_education_programs_fte'] = 0;
            } else {
                $teaching_staff[3][2]['on_campus_ft'] = \Orm_User_Faculty::get_count(array('college_id' => $college,'gender' => \Orm_User::GENDER_MALE));
                $teaching_staff[3][3]['on_campus_pt'] = 0;
                $teaching_staff[3][4]['on_campus_fte'] = 0;
                $teaching_staff[3][5]['distance_education_programs_ft'] = 0;
                $teaching_staff[3][6]['distance_education_programs_pt'] = 0;
                $teaching_staff[3][7]['distance_education_programs_fte'] = 0;

                $teaching_staff[4][2]['on_campus_ft'] = \Orm_User_Faculty::get_count(array('college_id' => $college,'gender' => \Orm_User::GENDER_FEMALE));
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
            }

            $this->set_teaching_staff($teaching_staff);

            foreach (\Orm_Program::get_all(array('college_id' => $college)) as $program) {
                if ($program->get_duration() == 4 && $program->get_degree_id() == 5) {
                    $four_programs[] = $program->get_id();
                } elseif ($program->get_duration() == 5 && $program->get_degree_id() == 5) {
                    $five_programs[] = $program->get_id();
                } elseif ($program->get_duration() == 6 && $program->get_degree_id() == 5) {
                    $six_programs[] = $program->get_id();
                } elseif ($program->get_degree_id() == 8) {
                    $master_programs[] = $program->get_id();
                } elseif ($program->get_degree_id() == 10) {
                    $phd_programs[] = $program->get_id();
                }
            }
            $four_programs[] = 0;
            $five_programs[] = 0;
            $six_programs[] = 0;
            $master_programs[] = 0;
            $phd_programs[] = 0;


            $four_years_m = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $four_programs,'academic_year' => $this->get_year(),'number_of_years_less' => 4,'gender' => \Orm_User::GENDER_MALE));
            $four_years_f = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $four_programs,'academic_year' => $this->get_year(),'number_of_years_less' => 4,'gender' => \Orm_User::GENDER_FEMALE));
            $all_four_m = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $four_programs,'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_MALE));
            $all_four_f = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $four_programs,'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_FEMALE));

            $five_years_m = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $five_programs,'academic_year' => $this->get_year(),'number_of_years_less' => 5,'gender' => \Orm_User::GENDER_MALE));
            $five_years_f = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $five_programs,'academic_year' => $this->get_year(),'number_of_years_less' => 5,'gender' => \Orm_User::GENDER_FEMALE));
            $all_five_m = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $five_programs,'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_MALE));
            $all_five_f = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $five_programs,'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_FEMALE));

            $six_years_m = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $six_programs,'academic_year' => $this->get_year(),'number_of_years_less' => 6,'gender' => \Orm_User::GENDER_MALE));
            $six_years_f = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $six_programs,'academic_year' => $this->get_year(),'number_of_years_less' => 6,'gender' => \Orm_User::GENDER_FEMALE));
            $all_six_m = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $six_programs,'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_MALE));
            $all_six_f = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $six_programs,'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_FEMALE));

            $master_m = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $master_programs,'academic_year' => $this->get_year(),'number_of_years_less' => 2,'gender' => \Orm_User::GENDER_MALE));
            $master_f = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $master_programs,'academic_year' => $this->get_year(),'number_of_years_less' => 2,'gender' => \Orm_User::GENDER_FEMALE));
            $all_master_m = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $master_programs,'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_MALE));
            $all_master_f = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $master_programs,'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_FEMALE));

            $phd_m = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $phd_programs,'academic_year' => $this->get_year(),'number_of_years_less' => 4,'gender' => \Orm_User::GENDER_MALE));
            $phd_f = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $phd_programs,'academic_year' => $this->get_year(),'number_of_years_less' => 4,'gender' => \Orm_User::GENDER_FEMALE));
            $all_phd_m = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $phd_programs,'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_MALE));
            $all_phd_f = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $phd_programs,'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_FEMALE));

            $completion[3][2]['under_programs_4'] = round($all_four_m ? ($four_years_m / $all_four_m) * 100 : 0,2);
            $completion[3][3]['under_programs_5'] = round($all_five_m ? ($five_years_m / $all_five_m) * 100 : 0,2);
            $completion[3][4]['under_programs_6'] = round($all_six_m ? ($six_years_m / $all_six_m) * 100 : 0,2);
            $completion[3][5]['post_programs_master'] = round($all_master_m ? ($master_m / $all_master_m) * 100 : 0,2);
            $completion[3][6]['post_programs_doctor'] = round($all_phd_m ? ($phd_m / $all_phd_m) * 100 : 0,2);
            $completion[4][2]['under_programs_4'] = round($all_four_f ? ($four_years_f / $all_four_f) * 100 : 0,2);
            $completion[4][3]['under_programs_5'] = round($all_five_f ? ($five_years_f / $all_five_f) * 100 : 0,2);
            $completion[4][4]['under_programs_6'] = round($all_six_f ? ($six_years_f / $all_six_f) * 100 : 0,2);
            $completion[4][5]['post_programs_master'] = round($all_master_f ? ($master_f / $all_master_f) * 100 : 0,2);
            $completion[4][6]['post_programs_doctor'] = round($all_phd_f ? ($phd_f / $all_phd_f) * 100 : 0,2);
            $completion[5][2]['under_programs_4'] = round(($all_four_m + $all_four_f) ? ($four_years_m + $four_years_f) / ($all_four_m + $all_four_f) * 100 : 0,2);
            $completion[5][3]['under_programs_5'] = round(($all_five_m + $all_five_f) ? ($five_years_m+$five_years_f) / ($all_five_m + $all_five_f) * 100 : 0,2);
            $completion[5][4]['under_programs_6'] = round(($all_six_m + $all_six_f) ? ($six_years_m+$six_years_f) / ($all_six_m + $all_six_f) * 100 : 0,2);
            $completion[5][5]['post_programs_master'] = round(($all_master_m + $all_master_f) ? ($master_m+$master_f) / ($all_master_m + $all_master_f) * 100 : 0,2);
            $completion[5][6]['post_programs_doctor'] = round(($all_phd_m + $all_phd_f) ? ($phd_m+$phd_f) / ($all_phd_m + $all_phd_f) * 100 : 0,2);

            $this->set_student_rate($completion);

            $students_count = \Orm_Data_Graduate::get_sum(array('college_id' => $college,'academic_year' => $this->get_year()),'enrolled');

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