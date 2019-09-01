<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of Ssri_Template_A1_Program_Data
 *
 * @author ahmadgx
 */
class Ssri_Template_A1_Program_Data extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Program Data';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;
    protected $orientation = 'landscape';

    function init()
    {
        parent::init();

            $this->set_college('');
            $this->set_program_data(array());
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

    public function set_program_data($value)
    {
        $property = new \Orm_Property_Table_Dynamic('program_data', $value);
        $property->set_is_responsive(true);
        $property->set_description('NCAAA requires each college within the applying institution to complete Template A1 and A2 as part of the accreditation eligibility process.');

        $program_name = new \Orm_Property_Text('program_name');
        $program_name->set_description('Program Name');
        $program_name->set_width(80);
        $property->add_property($program_name);

        $start_date = new \Orm_Property_Text('start_date');
        $start_date->set_description('Start Date');
        $start_date->set_width(25);
        $property->add_property($start_date);

        $total_student_enrollment_m = new \Orm_Property_Text('total_student_enrollment_m');
        $total_student_enrollment_m->set_description('M');
        $total_student_enrollment_m->set_group('Total Student Enrollment');
        $total_student_enrollment_m->set_width(25);
        $property->add_property($total_student_enrollment_m);

        $total_student_enrollment_f = new \Orm_Property_Text('total_student_enrollment_f');
        $total_student_enrollment_f->set_description('F');
        $total_student_enrollment_f->set_group('Total Student Enrollment');
        $total_student_enrollment_f->set_width(25);
        $property->add_property($total_student_enrollment_f);

        $num_ph_d_faculty_saudi_m = new \Orm_Property_Text('num_ph_d_faculty_saudi_m');
        $num_ph_d_faculty_saudi_m->set_description('M');
        $num_ph_d_faculty_saudi_m->set_group('No. of Ph.D Faculty (Saudi)');
        $num_ph_d_faculty_saudi_m->set_width(25);
        $property->add_property($num_ph_d_faculty_saudi_m);

        $num_ph_d_faculty_saudi_f = new \Orm_Property_Text('num_ph_d_faculty_saudi_f');
        $num_ph_d_faculty_saudi_f->set_description('F');
        $num_ph_d_faculty_saudi_f->set_group('No. of Ph.D Faculty (Saudi)');
        $num_ph_d_faculty_saudi_f->set_width(25);
        $property->add_property($num_ph_d_faculty_saudi_f);

        $num_ph_d_faculty_others_m = new \Orm_Property_Text('num_ph_d_faculty_others_m');
        $num_ph_d_faculty_others_m->set_description('M');
        $num_ph_d_faculty_others_m->set_group('No. of Ph.D Faculty (Others)');
        $num_ph_d_faculty_others_m->set_width(25);
        $property->add_property($num_ph_d_faculty_others_m);

        $num_ph_d_faculty_others_f = new \Orm_Property_Text('num_ph_d_faculty_others_f');
        $num_ph_d_faculty_others_f->set_description('F');
        $num_ph_d_faculty_others_f->set_group('No. of Ph.D Faculty (Others)');
        $num_ph_d_faculty_others_f->set_width(25);
        $property->add_property($num_ph_d_faculty_others_f);

        $teching_staff_saudi_m = new \Orm_Property_Text('teching_staff_saudi_m');
        $teching_staff_saudi_m->set_description('M');
        $teching_staff_saudi_m->set_group('No. of Teaching Staff (Saudi)');
        $teching_staff_saudi_m->set_width(25);
        $property->add_property($teching_staff_saudi_m);

        $teching_staff_saudi_f = new \Orm_Property_Text('teching_staff_saudi_f');
        $teching_staff_saudi_f->set_description('F');
        $teching_staff_saudi_f->set_group('No. of Teaching Staff (Saudi)');
        $teching_staff_saudi_f->set_width(25);
        $property->add_property($teching_staff_saudi_f);

        $teching_staff_others_m = new \Orm_Property_Text('teching_staff_others_m');
        $teching_staff_others_m->set_description('M');
        $teching_staff_others_m->set_group('No. of Teaching Staff (Others)');
        $teching_staff_others_m->set_width(25);
        $property->add_property($teching_staff_others_m);

        $teching_staff_others_f = new \Orm_Property_Text('teching_staff_others_f');
        $teching_staff_others_f->set_description('F');
        $teching_staff_others_f->set_group('No. of Teaching Staff (Others)');
        $teching_staff_others_f->set_width(25);
        $property->add_property($teching_staff_others_f);

        $ratio_student_teaching_faculty = new \Orm_Property_Text('ratio_student_teaching_faculty');
        $ratio_student_teaching_faculty->set_description('Ratio of Total Students to Teaching Faculty');
        $ratio_student_teaching_faculty->set_width(25);
        $property->add_property($ratio_student_teaching_faculty);

        $ratio_male_student_teaching_faculty = new \Orm_Property_Text('ratio_male_student_teaching_faculty');
        $ratio_male_student_teaching_faculty->set_description('Ratio of Male Students to Teaching Faculty');
        $ratio_male_student_teaching_faculty->set_width(25);
        $property->add_property($ratio_male_student_teaching_faculty);

        $ratio_female_student_teaching_faculty = new \Orm_Property_Text('ratio_female_student_teaching_faculty');
        $ratio_female_student_teaching_faculty->set_description('Ratio of Female Students to Teaching Faculty');
        $ratio_female_student_teaching_faculty->set_width(25);
        $property->add_property($ratio_female_student_teaching_faculty);

        $avg_class_size_m = new \Orm_Property_Text('avg_class_size_m');
        $avg_class_size_m->set_description('M');
        $avg_class_size_m->set_group('Average Class Size');
        $avg_class_size_m->set_width(25);
        $property->add_property($avg_class_size_m);

        $avg_class_size_f = new \Orm_Property_Text('avg_class_size_f');
        $avg_class_size_f->set_description('F');
        $avg_class_size_f->set_group('Average Class Size');
        $avg_class_size_f->set_width(25);
        $property->add_property($avg_class_size_f);

        $avg_teaching_load_m = new \Orm_Property_Text('avg_teaching_load_m');
        $avg_teaching_load_m->set_description('M');
        $avg_teaching_load_m->set_group('Average Teaching Load');
        $avg_teaching_load_m->set_width(25);
        $property->add_property($avg_teaching_load_m);

        $avg_teaching_load_f = new \Orm_Property_Text('avg_teaching_load_f');
        $avg_teaching_load_f->set_description('F');
        $avg_teaching_load_f->set_group('Average Teaching Load');
        $avg_teaching_load_f->set_width(25);
        $property->add_property($avg_teaching_load_f);

        $this->set_property($property);
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
                    'extra' => 'onclick="integration(this, ' . $this->get_id() . ');" ' . data_loading_text(true) . ' title="Extraction of data from other modules"'
                );
            }
        }

        return parent::header_actions($actions);
    }

    public function integration_processes() {
        parent::integration_processes();
        if (\Orm::get_ci()->config->item('integration_enabled')) {
            $college = $this->get_item_id();

            $table = array();

            foreach (\Orm_Program::get_all(array('college_id' => $college)) as $program) {

                $faculty_count_m_s = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 's' ,'program_id' => $program->get_id(), 'academic_year' => $this->get_year()), 'teaching_staff');
                $faculty_count_m_o = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 'o' ,'program_id' => $program->get_id(), 'academic_year' => $this->get_year()), 'teaching_staff');

                $faculty_count_f_s = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 's' ,'program_id' => $program->get_id(), 'academic_year' => $this->get_year()), 'teaching_staff');
                $faculty_count_f_o = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 'o' ,'program_id' => $program->get_id(), 'academic_year' => $this->get_year()), 'teaching_staff');

                $student_enrolled_m_s = \Orm_Data_Level_Enrolled::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 's' ,'program_id' => $program->get_id(), 'academic_year' => $this->get_year()));
                $student_enrolled_m_o = \Orm_Data_Level_Enrolled::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 'o' ,'program_id' => $program->get_id(), 'academic_year' => $this->get_year()));

                $student_enrolled_f_s = \Orm_Data_Level_Enrolled::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 's' ,'program_id' => $program->get_id(), 'academic_year' => $this->get_year()));
                $student_enrolled_f_o = \Orm_Data_Level_Enrolled::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 'o' ,'program_id' => $program->get_id(), 'academic_year' => $this->get_year()));

                $workload_classsize_m = \Orm_Data_Workload::get_average(array('gender' => \Orm_User::GENDER_FEMALE, 'program_id' => $program->get_id(), 'academic_year' => $this->get_year()));
                $workload_classsize_f = \Orm_Data_Workload::get_average(array('gender' => \Orm_User::GENDER_MALE, 'program_id' => $program->get_id(), 'academic_year' => $this->get_year()));

                $workload_m = round($workload_classsize_m['work_load'], 2);
                $class_size_m = round($workload_classsize_m['class_size'], 2);

                $workload_f = round($workload_classsize_f['work_load'], 2);
                $class_size_f = round($workload_classsize_f['class_size'], 2);

                $total_faculty = $faculty_count_m_s + $faculty_count_f_s + $faculty_count_m_o + $faculty_count_f_o;
                $total_students = $student_enrolled_m_s + $student_enrolled_f_s + $student_enrolled_m_o + $student_enrolled_f_o;
                $total_students_male = $student_enrolled_m_s + $student_enrolled_f_s + $student_enrolled_m_o + $student_enrolled_f_o;
                $total_students_female = $student_enrolled_m_s + $student_enrolled_f_s + $student_enrolled_m_o + $student_enrolled_f_o;


                $table[] = array(
                    'program_name' => $program->get_name('english'),
                    'start_date' => '',
                    'total_student_enrollment_m' => ($student_enrolled_m_s + $student_enrolled_m_o),
                    'total_student_enrollment_f' => ($student_enrolled_f_s + $student_enrolled_f_o),
                    'num_ph_d_faculty_saudi_m' => \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 's' ,'program_id' => $program->get_id(), 'academic_year' => $this->get_year()), 'phd_holder'),
                    'num_ph_d_faculty_saudi_f' => \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 's' ,'program_id' => $program->get_id(), 'academic_year' => $this->get_year()), 'phd_holder'),
                    'num_ph_d_faculty_others_m' => \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 'o' ,'program_id' => $program->get_id(), 'academic_year' => $this->get_year()), 'phd_holder'),
                    'num_ph_d_faculty_others_f' => \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 'o' ,'program_id' => $program->get_id(), 'academic_year' => $this->get_year()), 'phd_holder'),
                    'teching_staff_saudi_m' => $faculty_count_m_s,
                    'teching_staff_saudi_f' => $faculty_count_f_s,
                    'teching_staff_others_m' => $faculty_count_m_o,
                    'teching_staff_others_f' => $faculty_count_f_o,
                    'ratio_student_teaching_faculty' => ($total_faculty ? round($total_students / $total_faculty, 2) : 0) . ':' . '1',
                    'ratio_male_student_teaching_faculty' => ($total_faculty ? round($total_students_male / $total_faculty, 2) : 0) . ':' . '1',
                    'ratio_female_student_teaching_faculty' => ($total_faculty ? round($total_students_female / $total_faculty, 2) : 0) . ':' . '1',
                    'avg_class_size_m' => $class_size_m,
                    'avg_class_size_f' => $class_size_f,
                    'avg_teaching_load_m' => $workload_m,
                    'avg_teaching_load_f' => $workload_f
                );
            }

            $this->set_program_data($table);
            $this->save();
        }
    }
}
