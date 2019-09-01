<?php
/**
 * Created by PhpStorm.
 * User: ahmadgx
 * Date: 02/12/15
 * Time: 02:22 م
 */

namespace Node\ncai18;


class Inst_Prof_Table_8 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Table 8. Program Completion Rate/Graduation Rate*';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;
    protected $link_send_to_review = true;
    protected $orientation = 'landscape';

    public function init()
    {
        parent::init();

        $this->set_graduation_rate(array());
        $this->set_graduation_rate_note();
    }

    public function set_graduation_rate($value)
    {

        $under_programs_4 = new \Orm_Property_Text('under_programs_4');
        $under_programs_5 = new \Orm_Property_Text('under_programs_5');
        $under_programs_6 = new \Orm_Property_Text('under_programs_6');

        $master_programs_2 = new \Orm_Property_Text('master_programs_2');
        $master_programs_3 = new \Orm_Property_Text('master_programs_3');
        $master_programs_4 = new \Orm_Property_Text('master_programs_4');

        $doctor_programs_3 = new \Orm_Property_Text('doctor_programs_3');
        $doctor_programs_4 = new \Orm_Property_Text('doctor_programs_4');
        $doctor_programs_5 = new \Orm_Property_Text('doctor_programs_5');

        $property = new \Orm_Property_Add_More('graduation_rate', $value);
        $property->set_description('Table 8. Program Completion Rate/Graduation Rate*');

        $program_name = new \Orm_Property_Text('program_name');
        $program_name->set_description('Program Name');
        $property->add_property($program_name);


        $student_rate = new \Orm_Property_Table('student_rate');

        $student_rate->add_cell(1, 1, new \Orm_Property_Fixedtext('gender', 'Gender'), 3, 0);
        $student_rate->add_cell(1, 2, new \Orm_Property_Fixedtext('under_programs', 'Undergraduate Programs'), 0, 9);
        $student_rate->add_cell(1, 3, new \Orm_Property_Fixedtext('master_programs', 'Master Programs'), 0, 9);
        $student_rate->add_cell(1, 4, new \Orm_Property_Fixedtext('doctor_programs', 'Doctoral Programs'), 0, 9);

        $student_rate->add_cell(2, 1, new \Orm_Property_Fixedtext('four_years', 'Four-Year Program*'), 0, 3);
        $student_rate->add_cell(2, 2, new \Orm_Property_Fixedtext('five_years', 'Five-Year Program'), 0, 3);
        $student_rate->add_cell(2, 3, new \Orm_Property_Fixedtext('six_years', 'Six-Year Program'), 0, 3);

        $student_rate->add_cell(2, 4, new \Orm_Property_Fixedtext('two_years', 'Two-Year Program'), 0, 3);
        $student_rate->add_cell(2, 5, new \Orm_Property_Fixedtext('three_years', 'Three-Year Program'), 0, 3);
        $student_rate->add_cell(2, 6, new \Orm_Property_Fixedtext('four_years', 'Four-Year Program'), 0, 3);

        $student_rate->add_cell(2, 7, new \Orm_Property_Fixedtext('three_years', 'Three-Year Program'), 0, 3);
        $student_rate->add_cell(2, 8, new \Orm_Property_Fixedtext('four_years', 'Four-Year Program'), 0, 3);
        $student_rate->add_cell(2, 9, new \Orm_Property_Fixedtext('five_years', 'Five-Year Program'), 0, 3);

        $student_rate->add_cell(3, 1, new \Orm_Property_Fixedtext('four_years_4', '4'));
        $student_rate->add_cell(3, 2, new \Orm_Property_Fixedtext('four_years_5', '5'));
        $student_rate->add_cell(3, 3, new \Orm_Property_Fixedtext('four_years_6', '6'));

        $student_rate->add_cell(3, 4, new \Orm_Property_Fixedtext('five_years_5', '5'));
        $student_rate->add_cell(3, 5, new \Orm_Property_Fixedtext('five_years_6', '6'));
        $student_rate->add_cell(3, 6, new \Orm_Property_Fixedtext('five_years_7', '7'));

        $student_rate->add_cell(3, 7, new \Orm_Property_Fixedtext('six_years_6', '6'));
        $student_rate->add_cell(3, 8, new \Orm_Property_Fixedtext('six_years_7', '7'));
        $student_rate->add_cell(3, 9, new \Orm_Property_Fixedtext('six_years_8', '8'));

        $student_rate->add_cell(3, 10, new \Orm_Property_Fixedtext('two_years_2', '2'));
        $student_rate->add_cell(3, 11, new \Orm_Property_Fixedtext('two_years_3', '3'));
        $student_rate->add_cell(3, 12, new \Orm_Property_Fixedtext('two_years_4', '4'));

        $student_rate->add_cell(3, 13, new \Orm_Property_Fixedtext('two_years_3', '3'));
        $student_rate->add_cell(3, 14, new \Orm_Property_Fixedtext('two_years_4', '4'));
        $student_rate->add_cell(3, 15, new \Orm_Property_Fixedtext('two_years_5', '5'));

        $student_rate->add_cell(3, 16, new \Orm_Property_Fixedtext('two_years_4', '4'));
        $student_rate->add_cell(3, 17, new \Orm_Property_Fixedtext('two_years_5', '5'));
        $student_rate->add_cell(3, 18, new \Orm_Property_Fixedtext('two_years_6', '6'));

        $student_rate->add_cell(3, 19, new \Orm_Property_Fixedtext('three_years_3', '3'));
        $student_rate->add_cell(3, 20, new \Orm_Property_Fixedtext('three_years_4', '4'));
        $student_rate->add_cell(3, 21, new \Orm_Property_Fixedtext('three_years_5', '5'));

        $student_rate->add_cell(3, 22, new \Orm_Property_Fixedtext('three_years_4', '4'));
        $student_rate->add_cell(3, 23, new \Orm_Property_Fixedtext('three_years_5', '5'));
        $student_rate->add_cell(3, 24, new \Orm_Property_Fixedtext('three_years_6', '6'));

        $student_rate->add_cell(3, 25, new \Orm_Property_Fixedtext('three_years_5', '5'));
        $student_rate->add_cell(3, 26, new \Orm_Property_Fixedtext('three_years_6', '6'));
        $student_rate->add_cell(3, 27, new \Orm_Property_Fixedtext('three_years_7', '7'));


        $student_rate->add_cell(4, 1, new \Orm_Property_Fixedtext('male', 'Male'));
        $student_rate->add_cell(4, 2, $under_programs_4);
        $student_rate->add_cell(4, 3, $under_programs_4);
        $student_rate->add_cell(4, 4, $under_programs_4);

        $student_rate->add_cell(4, 5, $under_programs_5);
        $student_rate->add_cell(4, 6, $under_programs_5);
        $student_rate->add_cell(4, 7, $under_programs_5);

        $student_rate->add_cell(4, 8, $under_programs_6);
        $student_rate->add_cell(4, 9, $under_programs_6);
        $student_rate->add_cell(4, 10, $under_programs_6);

        $student_rate->add_cell(4, 11, $master_programs_2);
        $student_rate->add_cell(4, 12, $master_programs_2);
        $student_rate->add_cell(4, 13, $master_programs_2);

        $student_rate->add_cell(4, 14, $master_programs_3);
        $student_rate->add_cell(4, 15, $master_programs_3);
        $student_rate->add_cell(4, 16, $master_programs_3);

        $student_rate->add_cell(4, 17, $master_programs_4);
        $student_rate->add_cell(4, 18, $master_programs_4);
        $student_rate->add_cell(4, 19, $master_programs_4);

        $student_rate->add_cell(4, 20, $doctor_programs_3);
        $student_rate->add_cell(4, 21, $doctor_programs_3);
        $student_rate->add_cell(4, 22, $doctor_programs_3);

        $student_rate->add_cell(4, 23, $doctor_programs_4);
        $student_rate->add_cell(4, 24, $doctor_programs_4);
        $student_rate->add_cell(4, 25, $doctor_programs_4);

        $student_rate->add_cell(4, 26, $doctor_programs_5);
        $student_rate->add_cell(4, 27, $doctor_programs_5);
        $student_rate->add_cell(4, 28, $doctor_programs_5);

        $student_rate->add_cell(5, 1, new \Orm_Property_Fixedtext('female', 'Female'));
        $student_rate->add_cell(5, 2, $under_programs_4);
        $student_rate->add_cell(5, 3, $under_programs_4);
        $student_rate->add_cell(5, 4, $under_programs_4);

        $student_rate->add_cell(5, 5, $under_programs_5);
        $student_rate->add_cell(5, 6, $under_programs_5);
        $student_rate->add_cell(5, 7, $under_programs_5);

        $student_rate->add_cell(5, 8, $under_programs_6);
        $student_rate->add_cell(5, 9, $under_programs_6);
        $student_rate->add_cell(5, 10, $under_programs_6);

        $student_rate->add_cell(5, 11, $master_programs_2);
        $student_rate->add_cell(5, 12, $master_programs_2);
        $student_rate->add_cell(5, 13, $master_programs_2);

        $student_rate->add_cell(5, 14, $master_programs_3);
        $student_rate->add_cell(5, 15, $master_programs_3);
        $student_rate->add_cell(5, 16, $master_programs_3);

        $student_rate->add_cell(5, 17, $master_programs_4);
        $student_rate->add_cell(5, 18, $master_programs_4);
        $student_rate->add_cell(5, 19, $master_programs_4);

        $student_rate->add_cell(5, 20, $doctor_programs_3);
        $student_rate->add_cell(5, 21, $doctor_programs_3);
        $student_rate->add_cell(5, 22, $doctor_programs_3);

        $student_rate->add_cell(5, 23, $doctor_programs_4);
        $student_rate->add_cell(5, 24, $doctor_programs_4);
        $student_rate->add_cell(5, 25, $doctor_programs_4);

        $student_rate->add_cell(5, 26, $doctor_programs_5);
        $student_rate->add_cell(5, 27, $doctor_programs_5);
        $student_rate->add_cell(5, 28, $doctor_programs_5);

        $student_rate->add_cell(6, 1, new \Orm_Property_Fixedtext('total', 'Total'));
        $student_rate->add_cell(6, 2, $under_programs_4);
        $student_rate->add_cell(6, 3, $under_programs_4);
        $student_rate->add_cell(6, 4, $under_programs_4);

        $student_rate->add_cell(6, 5, $under_programs_5);
        $student_rate->add_cell(6, 6, $under_programs_5);
        $student_rate->add_cell(6, 7, $under_programs_5);

        $student_rate->add_cell(6, 8, $under_programs_6);
        $student_rate->add_cell(6, 9, $under_programs_6);
        $student_rate->add_cell(6, 10, $under_programs_6);

        $student_rate->add_cell(6, 11, $master_programs_2);
        $student_rate->add_cell(6, 12, $master_programs_2);
        $student_rate->add_cell(6, 13, $master_programs_2);

        $student_rate->add_cell(6, 14, $master_programs_3);
        $student_rate->add_cell(6, 15, $master_programs_3);
        $student_rate->add_cell(6, 16, $master_programs_3);

        $student_rate->add_cell(6, 17, $master_programs_4);
        $student_rate->add_cell(6, 18, $master_programs_4);
        $student_rate->add_cell(6, 19, $master_programs_4);

        $student_rate->add_cell(6, 20, $doctor_programs_3);
        $student_rate->add_cell(6, 21, $doctor_programs_3);
        $student_rate->add_cell(6, 22, $doctor_programs_3);

        $student_rate->add_cell(6, 23, $doctor_programs_4);
        $student_rate->add_cell(6, 24, $doctor_programs_4);
        $student_rate->add_cell(6, 25, $doctor_programs_4);

        $student_rate->add_cell(6, 26, $doctor_programs_5);
        $student_rate->add_cell(6, 27, $doctor_programs_5);
        $student_rate->add_cell(6, 28, $doctor_programs_5);

        $property->add_property($student_rate);

        $this->set_property($property);
    }

    public function get_student_rate()
    {
        return $this->get_property('student_rate')->get_value();
    }

    public function set_graduation_rate_note()
    {
        $property = new \Orm_Property_Fixedtext('instruction_teaching_staff_note', '<strong>Initial Cohort: </strong>All students who enter an academic Program as first-time, full-time, degree seeking undergraduate students for the given Fall Semester.<br/><br/><strong>*Completion rate/Graduation rate for undergraduate students:</strong>The percentage of the cohort class in a given Fall Semester who graduated within a designated period of time. For example, in a four-year program, the "Four-Year Graduation" rate for the Fall Semester 2008 cohort class is the percentage of the Fall Semester 2008 cohort class who graduated from the institution before Fall Semester 2012, while the “Six-Year Graduation” rate for the Fall Semester 2008 cohort class is the percentage of the Fall Semester 2008 cohort class who graduated from the institution before Fall Semester 2014.<br/><br/><strong>** Completion rate for postgraduate students: </strong>The proportion of students entering postgraduate programs who complete those programs in specified time. The time for completion should be specified in the table.');
        $this->set_property($property);
    }

    public function get_graduation_rate_note()
    {
        return $this->get_property('graduation_rate_note')->get_value();

    }

    public function header_actions(&$actions = array())
    {

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

    public function integration_processes()
    {
        //ToDo Fixed for all university depends on what the real degree form Master,Phd Bachelor
        parent::integration_processes();

        if (\Orm::get_ci()->config->item('integration_enabled')) {
            $table_8 = array();


            foreach (\Orm_College::get_all() as $college) {
                foreach (\Orm_Program::get_all(array('college_id' => $college->get_id())) as $program) {

                    $four_programs = 0;
                    $five_programs = 0;
                    $six_programs = 0;

                    $two_master_programs = 0;
                    $three_master_programs = 0;
                    $four_master_programs = 0;

                    $three_phd_programs = 0;
                    $four_phd_programs = 0;
                    $five_phd_programs = 0;

                    $total = 0;

                    if ($program->get_duration() == 4 && $program->get_degree_obj()->get_is_undergraduate() == \Orm_Degree::DEGREE_UNDERGRAUDATE_BACHELOR) {
                        $four_programs = $program->get_id();
                        $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_MALE));
                        $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_FEMALE));
                        $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $this->get_year()));
                    } elseif ($program->get_duration() == 5 &&  $program->get_degree_obj()->get_is_undergraduate() == \Orm_Degree::DEGREE_UNDERGRAUDATE_BACHELOR) {
                        $five_programs = $program->get_id();
                        $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_MALE));
                        $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_FEMALE));
                        $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $this->get_year()));
                    } elseif ($program->get_duration() == 6 &&  $program->get_degree_obj()->get_is_undergraduate() == \Orm_Degree::DEGREE_UNDERGRAUDATE_BACHELOR) {
                        $six_programs = $program->get_id();
                        $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_MALE));
                        $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_FEMALE));
                        $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $this->get_year()));
                    } elseif ($program->get_duration() == 2  &&  $program->get_degree_obj()->get_is_undergraduate() == \Orm_Degree::DEGREE_POSTGRAUDATE_MASTER){
                        $two_master_programs = $program->get_id();
                        $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_MALE));
                        $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_FEMALE));
                        $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs, 'academic_year' => $this->get_year()));
                    } elseif( $program->get_duration() == 3  && $program->get_degree_obj()->get_is_undergraduate() == \Orm_Degree::DEGREE_POSTGRAUDATE_MASTER){
                        $three_master_programs = $program->get_id();
                        $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_master_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_MALE));
                        $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_master_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_FEMALE));
                        $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_master_programs, 'academic_year' => $this->get_year()));
                    } elseif ($program->get_duration() == 4  && $program->get_degree_obj()->get_is_undergraduate() == \Orm_Degree::DEGREE_POSTGRAUDATE_MASTER){
                        $four_master_programs = $program->get_id();
                        $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_MALE));
                        $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_FEMALE));
                        $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $this->get_year()));

                    } elseif ($program->get_duration() == 3  && $program->get_degree_obj()->get_is_undergraduate() == \Orm_Degree::DEGREE_POSTGRAUDATE_DOCTOR){
                        $three_phd_programs = $program->get_id();
                        $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_MALE));
                        $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_FEMALE));
                        $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs, 'academic_year' => $this->get_year()));

                    } elseif ($program->get_duration() == 4 & $program->get_degree_obj()->get_is_undergraduate() == \Orm_Degree::DEGREE_POSTGRAUDATE_DOCTOR){
                        $four_phd_programs = $program->get_id();
                        $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_MALE));
                        $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_FEMALE));
                        $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs, 'academic_year' => $this->get_year()));

                    } elseif ($program->get_duration() == 5 &  $program->get_degree_obj()->get_is_undergraduate() == \Orm_Degree::DEGREE_POSTGRAUDATE_DOCTOR){
                        $five_phd_programs = $program->get_id();
                        $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_MALE));
                        $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs, 'academic_year' => $this->get_year(), 'gender' => \Orm_User::GENDER_FEMALE));
                        $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs, 'academic_year' => $this->get_year()));

                    }

                    if ($total) {
                        if (!isset($total_m) || !$total_m) {
                            $total_m = 1;
                        }
                        if (!isset($total_f) || !$total_f) {
                            $total_f = 1;
                        }
                        if (!isset($total) || !$total) {
                            $total = 1;
                        }

                        $completion_rate[4][2]['under_programs_4'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $this->get_year(), 'number_of_years_less' => 4, 'gender' => \Orm_User::GENDER_MALE)) / $total_m * 100, 2);
                        $completion_rate[4][3]['under_programs_4'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 5, 'gender' => \Orm_User::GENDER_MALE)) / $total_m * 100, 2);
                        $completion_rate[4][4]['under_programs_4'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $this->get_year(), 'number_of_years_more' => 6, 'gender' => \Orm_User::GENDER_MALE)) / $total_m * 100, 2);
                        $completion_rate[4][5]['under_programs_5'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $this->get_year(), 'number_of_years_less' => 5, 'gender' => \Orm_User::GENDER_MALE)) / $total_m * 100, 2);
                        $completion_rate[4][6]['under_programs_5'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 6, 'gender' => \Orm_User::GENDER_MALE)) / $total_m * 100, 2);
                        $completion_rate[4][7]['under_programs_5'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $this->get_year(), 'number_of_years_more' => 7, 'gender' => \Orm_User::GENDER_MALE)) / $total_m * 100, 2);
                        $completion_rate[4][8]['under_programs_6'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $this->get_year(), 'number_of_years_less' => 6, 'gender' => \Orm_User::GENDER_MALE)) / $total_m * 100, 2);
                        $completion_rate[4][9]['under_programs_6'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 7, 'gender' => \Orm_User::GENDER_MALE)) / $total_m * 100, 2);
                        $completion_rate[4][10]['under_programs_6'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $this->get_year(), 'number_of_years_more' => 8, 'gender' => \Orm_User::GENDER_MALE)) / $total_m * 100, 2);

                        $completion_rate[4][11]['post_programs_master_2'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs, 'academic_year' => $this->get_year(), 'number_of_years_less' => 2, 'gender' => \Orm_User::GENDER_MALE)) / $total_m * 100, 2);
                        $completion_rate[4][12]['post_programs_master_2'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 3, 'gender' => \Orm_User::GENDER_MALE)) / $total_m * 100, 2);
                        $completion_rate[4][13]['post_programs_master_2'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs, 'academic_year' => $this->get_year(), 'number_of_years_more' => 4, 'gender' => \Orm_User::GENDER_MALE)) / $total_m * 100, 2);
                        $completion_rate[4][14]['post_programs_master_3'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_master_programs, 'academic_year' => $this->get_year(), 'number_of_years_less' => 3, 'gender' => \Orm_User::GENDER_MALE)) / $total_m * 100, 2);
                        $completion_rate[4][15]['post_programs_master_3'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_master_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 4, 'gender' => \Orm_User::GENDER_MALE)) / $total_m * 100, 2);
                        $completion_rate[4][16]['post_programs_master_3'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_master_programs, 'academic_year' => $this->get_year(), 'number_of_years_more' => 5, 'gender' => \Orm_User::GENDER_MALE)) / $total_m * 100, 2);
                        $completion_rate[4][17]['post_programs_master_4'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $this->get_year(), 'number_of_years_less' => 4, 'gender' => \Orm_User::GENDER_MALE)) / $total_m * 100, 2);
                        $completion_rate[4][18]['post_programs_master_4'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 5, 'gender' => \Orm_User::GENDER_MALE)) / $total_m * 100, 2);
                        $completion_rate[4][19]['post_programs_master_4'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $this->get_year(), 'number_of_years_more' => 6, 'gender' => \Orm_User::GENDER_MALE)) / $total_m * 100, 2);

                        $completion_rate[4][20]['post_programs_phd_3'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs, 'academic_year' => $this->get_year(), 'number_of_years_less' => 3, 'gender' => \Orm_User::GENDER_MALE)) / $total_m * 100, 2);
                        $completion_rate[4][21]['post_programs_phd_3'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 4, 'gender' => \Orm_User::GENDER_MALE)) / $total_m * 100, 2);
                        $completion_rate[4][22]['post_programs_phd_3'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs, 'academic_year' => $this->get_year(), 'number_of_years_more' => 5, 'gender' => \Orm_User::GENDER_MALE)) / $total_m * 100, 2);
                        $completion_rate[4][23]['post_programs_phd_4'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs, 'academic_year' => $this->get_year(), 'number_of_years_less' => 4, 'gender' => \Orm_User::GENDER_MALE)) / $total_m * 100, 2);
                        $completion_rate[4][24]['post_programs_phd_4'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 5, 'gender' => \Orm_User::GENDER_MALE)) / $total_m * 100, 2);
                        $completion_rate[4][25]['post_programs_phd_4'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs, 'academic_year' => $this->get_year(), 'number_of_years_more' => 6, 'gender' => \Orm_User::GENDER_MALE)) / $total_m * 100, 2);
                        $completion_rate[4][26]['post_programs_phd_5'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs, 'academic_year' => $this->get_year(), 'number_of_years_less' => 5, 'gender' => \Orm_User::GENDER_MALE)) / $total_m * 100, 2);
                        $completion_rate[4][27]['post_programs_phd_5'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 6, 'gender' => \Orm_User::GENDER_MALE)) / $total_m * 100, 2);
                        $completion_rate[4][28]['post_programs_phd_5'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs, 'academic_year' => $this->get_year(), 'number_of_years_more' => 7, 'gender' => \Orm_User::GENDER_MALE)) / $total_m * 100, 2);

                        $completion_rate[5][2]['under_programs_4'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $this->get_year(), 'number_of_years_less' => 4, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f * 100, 2);
                        $completion_rate[5][3]['under_programs_4'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 5, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f * 100, 2);
                        $completion_rate[5][4]['under_programs_4'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $this->get_year(), 'number_of_years_more' => 6, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f * 100, 2);
                        $completion_rate[5][5]['under_programs_5'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $this->get_year(), 'number_of_years_less' => 5, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f * 100, 2);
                        $completion_rate[5][6]['under_programs_5'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 6, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f * 100, 2);
                        $completion_rate[5][7]['under_programs_5'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $this->get_year(), 'number_of_years_more' => 7, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f * 100, 2);
                        $completion_rate[5][8]['under_programs_6'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $this->get_year(), 'number_of_years_less' => 6, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f * 100, 2);
                        $completion_rate[5][9]['under_programs_6'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 7, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f * 100, 2);
                        $completion_rate[5][10]['under_programs_6'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $this->get_year(), 'number_of_years_more' => 8, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f * 100, 2);

                        $completion_rate[5][11]['post_programs_master_2'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs, 'academic_year' => $this->get_year(), 'number_of_years_less' => 2, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f * 100, 2);
                        $completion_rate[5][12]['post_programs_master_2'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 3, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f * 100, 2);
                        $completion_rate[5][13]['post_programs_master_2'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs, 'academic_year' => $this->get_year(), 'number_of_years_more' => 4, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f * 100, 2);
                        $completion_rate[5][14]['post_programs_master_3'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_master_programs, 'academic_year' => $this->get_year(), 'number_of_years_less' => 3, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f * 100, 2);
                        $completion_rate[5][15]['post_programs_master_3'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_master_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 4, 'gender' => \Orm_User::GENDER_MALE)) / $total_f * 100, 2);
                        $completion_rate[5][16]['post_programs_master_3'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_master_programs, 'academic_year' => $this->get_year(), 'number_of_years_more' => 5, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f * 100, 2);
                        $completion_rate[5][17]['post_programs_master_4'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $this->get_year(), 'number_of_years_less' => 4, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f * 100, 2);
                        $completion_rate[5][18]['post_programs_master_4'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 5, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f * 100, 2);
                        $completion_rate[5][19]['post_programs_master_4'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $this->get_year(), 'number_of_years_more' => 6, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f * 100, 2);

                        $completion_rate[5][20]['post_programs_phd_3'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs, 'academic_year' => $this->get_year(), 'number_of_years_less' => 3, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f * 100, 2);
                        $completion_rate[5][21]['post_programs_phd_3'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 4, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f * 100, 2);
                        $completion_rate[5][22]['post_programs_phd_3'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs, 'academic_year' => $this->get_year(), 'number_of_years_more' => 5, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f * 100, 2);
                        $completion_rate[5][23]['post_programs_phd_4'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs, 'academic_year' => $this->get_year(), 'number_of_years_less' => 4, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f * 100, 2);
                        $completion_rate[5][24]['post_programs_phd_4'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 5, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f * 100, 2);
                        $completion_rate[5][25]['post_programs_phd_4'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs, 'academic_year' => $this->get_year(), 'number_of_years_more' => 6, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f * 100, 2);
                        $completion_rate[5][26]['post_programs_phd_5'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs, 'academic_year' => $this->get_year(), 'number_of_years_less' => 5, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f * 100, 2);
                        $completion_rate[5][27]['post_programs_phd_5'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 6, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f * 100, 2);
                        $completion_rate[5][28]['post_programs_phd_5'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs, 'academic_year' => $this->get_year(), 'number_of_years_more' => 7, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f * 100, 2);

                        $completion_rate[6][2]['under_programs_4'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $this->get_year(), 'number_of_years_less' => 4)) / $total * 100, 2);
                        $completion_rate[6][3]['under_programs_4'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 5)) / $total * 100, 2);
                        $completion_rate[6][4]['under_programs_4'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $this->get_year(), 'number_of_years_more' => 6)) / $total * 100, 2);
                        $completion_rate[6][5]['under_programs_5'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $this->get_year(), 'number_of_years_less' => 5)) / $total * 100, 2);
                        $completion_rate[6][6]['under_programs_5'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 6)) / $total * 100, 2);
                        $completion_rate[6][7]['under_programs_5'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $this->get_year(), 'number_of_years_more' => 7)) / $total * 100, 2);
                        $completion_rate[6][8]['under_programs_6'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $this->get_year(), 'number_of_years_less' => 6)) / $total * 100, 2);
                        $completion_rate[6][9]['under_programs_6'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 7)) / $total * 100, 2);
                        $completion_rate[6][10]['under_programs_6'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $this->get_year(), 'number_of_years_more' => 8)) / $total * 100, 2);

                        $completion_rate[6][11]['post_programs_master_2'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs, 'academic_year' => $this->get_year(), 'number_of_years_less' => 2))/ $total * 100, 2);
                        $completion_rate[6][12]['post_programs_master_2'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 3))/ $total * 100, 2);
                        $completion_rate[6][13]['post_programs_master_2'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs, 'academic_year' => $this->get_year(), 'number_of_years_more' => 4))/ $total * 100, 2);
                        $completion_rate[6][14]['post_programs_master_3'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_master_programs, 'academic_year' => $this->get_year(), 'number_of_years_less' => 3))/ $total * 100, 2);
                        $completion_rate[6][15]['post_programs_master_3'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_master_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 4))/ $total * 100, 2);
                        $completion_rate[6][16]['post_programs_master_3'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_master_programs, 'academic_year' => $this->get_year(), 'number_of_years_more' => 5))/ $total * 100, 2);
                        $completion_rate[6][17]['post_programs_master_4'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $this->get_year(), 'number_of_years_less' => 4))/ $total * 100, 2);
                        $completion_rate[6][18]['post_programs_master_4'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 5))/ $total * 100, 2);
                        $completion_rate[6][19]['post_programs_master_4'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $this->get_year(), 'number_of_years_more' => 6))/ $total * 100, 2);

                        $completion_rate[6][20]['post_programs_phd_3'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs, 'academic_year' => $this->get_year(), 'number_of_years_less' => 3))/ $total * 100, 2);
                        $completion_rate[6][21]['post_programs_phd_3'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 4))/ $total * 100, 2);
                        $completion_rate[6][22]['post_programs_phd_3'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs, 'academic_year' => $this->get_year(), 'number_of_years_more' => 5))/ $total * 100, 2);
                        $completion_rate[6][23]['post_programs_phd_4'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs, 'academic_year' => $this->get_year(), 'number_of_years_less' => 4))/ $total * 100, 2);
                        $completion_rate[6][24]['post_programs_phd_4'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 5))/ $total * 100, 2);
                        $completion_rate[6][25]['post_programs_phd_4'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs, 'academic_year' => $this->get_year(), 'number_of_years_more' => 6))/ $total * 100, 2);
                        $completion_rate[6][26]['post_programs_phd_5'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs, 'academic_year' => $this->get_year(), 'number_of_years_less' => 5))/ $total * 100, 2);
                        $completion_rate[6][27]['post_programs_phd_5'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs, 'academic_year' => $this->get_year(), 'number_of_years' => 6))/ $total * 100, 2);
                        $completion_rate[6][28]['post_programs_phd_5'] = round(\Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs, 'academic_year' => $this->get_year(), 'number_of_years_more' => 7))/ $total * 100, 2);


                        $table_8[] = array(
                            'program_name' => $program->get_name('english'),
                            'student_rate' => $completion_rate
                        );
                    }

                }
            }
            $this->set_graduation_rate($table_8);
            $this->save();
        }
    }
}