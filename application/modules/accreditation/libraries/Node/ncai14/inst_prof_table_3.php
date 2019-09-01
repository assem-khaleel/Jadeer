<?php
/**
 * Created by PhpStorm.
 * User: ahmadgx
 * Date: 02/12/15
 * Time: 02:21 م
 */

namespace Node\ncai14;


class Inst_Prof_Table_3 extends \Orm_Node{

    protected $class_type = __CLASS__;
    protected $name = 'Table 3. Program Data';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;
    protected $link_send_to_review = true;
    protected $orientation = 'landscape';

    public function init()
    {
        parent::init();

        $this->set_program_data(array());
        $this->set_program_data_note();
    }


    /*
   * Program Data
   */

    public function set_program_data($value)
    {

        $male = new \Orm_Property_Text('male');
        $female = new \Orm_Property_Text('female');

        $property = new \Orm_Property_Add_More('program_data', $value);

        $program_name = new \Orm_Property_Text('program_name');
        $program_name->set_description('Program Name');
        $property->add_property($program_name);

        $start_date = new \Orm_Property_Text('start_date');
        $start_date->set_description('Start Date');
        $property->add_property($start_date);

        $all_data = new \Orm_Property_Table('all_data');

        $gender = new \Orm_Property_Fixedtext('gender','Gender');
        $gender->set_width(50);
        $enrolled = new \Orm_Property_Fixedtext('total_student_enrollment','Total Students Enrollment');
        $enrolled->set_width(80);
        $phd_holders = new \Orm_Property_Fixedtext('num_ph_d_faculty','No. of PhD holders in Teaching Staff');
        $phd_holders->set_width(80);
        $teaching_staff = new \Orm_Property_Fixedtext('teaching_staff','No. of Teaching Staff');
        $teaching_staff->set_width(80);
        $class_size = new \Orm_Property_Fixedtext('avg_class_size','Average Class Size');
        $class_size->set_width(40);
        $work_load = new \Orm_Property_Fixedtext('avg_teaching_load','Average Teaching Load');
        $work_load->set_width(40);
        $ratio_total = new \Orm_Property_Fixedtext('ratio_student_teaching_faculty','Ratio of Total Students to Teaching Faculty');
        $ratio_total->set_width(50);
        $ratio_male = new \Orm_Property_Fixedtext('ratio_male_student_teaching_faculty','Ratio of Male Students to Teaching Faculty');
        $ratio_male->set_width(50);
        $ratio_female = new \Orm_Property_Fixedtext('ratio_female_student_teaching_faculty','Ratio of Female Students to Teaching Faculty');
        $ratio_female->set_width(50);

        $all_data->add_cell(1,1,$gender,2,0);
        $all_data->add_cell(1,2,$enrolled,0,2);
        $all_data->add_cell(1,3,$phd_holders,0,2);
        $all_data->add_cell(1,4,$teaching_staff,0,2);
        $all_data->add_cell(1,5,$class_size,2,0);
        $all_data->add_cell(1,6,$work_load,2,0);
        $all_data->add_cell(1,7,$ratio_total,2,0);
        $all_data->add_cell(1,8,$ratio_male,2,0);
        $all_data->add_cell(1,9,$ratio_female,2,0);

        $all_data->add_cell(2,1,new \Orm_Property_Fixedtext('saudi','S**'));
        $all_data->add_cell(2,2,new \Orm_Property_Fixedtext('other','O***'));
        $all_data->add_cell(2,3,new \Orm_Property_Fixedtext('saudi','S'));
        $all_data->add_cell(2,4,new \Orm_Property_Fixedtext('other','O'));
        $all_data->add_cell(2,5,new \Orm_Property_Fixedtext('saudi','S'));
        $all_data->add_cell(2,6,new \Orm_Property_Fixedtext('other','O'));


        $all_data->add_cell(3,1,new \Orm_Property_Fixedtext('male','M'));
        $all_data->add_cell(3,2,$male);
        $all_data->add_cell(3,3,$male);
        $all_data->add_cell(3,4,$male);
        $all_data->add_cell(3,5,$male);
        $all_data->add_cell(3,6,$male);
        $all_data->add_cell(3,7,$male);
        $all_data->add_cell(3,8,$male);
        $all_data->add_cell(3,9,$male);
        $all_data->add_cell(3,10,$male,2,0);
        $all_data->add_cell(3,11,$male,2,0);
        $all_data->add_cell(3,12,$male,2,0);


        $all_data->add_cell(4,1,new \Orm_Property_Fixedtext('female','F'));
        $all_data->add_cell(4,2,$female);
        $all_data->add_cell(4,3,$female);
        $all_data->add_cell(4,4,$female);
        $all_data->add_cell(4,5,$female);
        $all_data->add_cell(4,6,$female);
        $all_data->add_cell(4,7,$female);
        $all_data->add_cell(4,8,$female);
        $all_data->add_cell(4,9,$female);

        $property->add_property($all_data);


        $this->set_property($property);
    }

    public function get_program_data()
    {
        return $this->get_property('program_data')->get_value();
    }

    public function set_program_data_note(){
        $property = new \Orm_property_Fixedtext('program_data_note','<ul><li><strong>* All programs are listed:  diploma, bachelors, higher diploma,masters, and PhD. </strong></li><li>**S: Saudi Nationality  ***O: Other Nationality</li><li>M: Male</li><li>F: Female</li></ul>');
        $this->set_property($property);

    }
    public function get_program_data_note(){
        return $this->get_property('program_data_note')->get_value();

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
            $table_2 = array();

            foreach (\Orm_College::get_all() as $college) {
                foreach (\Orm_Program::get_all(array('college_id' => $college->get_id())) as $program) {

                    $faculty_count_m_s = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 's' ,'program_id' => $program->get_id(), 'academic_year' => $this->get_year()), 'teaching_staff');
                    $faculty_count_m_o = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 'o' ,'program_id' => $program->get_id(), 'academic_year' => $this->get_year()), 'teaching_staff');

                    $faculty_count_f_s = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 's' ,'program_id' => $program->get_id(), 'academic_year' => $this->get_year()), 'teaching_staff');
                    $faculty_count_f_o = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 'o' ,'program_id' => $program->get_id(), 'academic_year' => $this->get_year()), 'teaching_staff');

                    $student_enrolled_m_s = \Orm_Data_Level_Enrolled::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 's' ,'program_id' => $program->get_id(), 'academic_year' => $this->get_year()));
                    $student_enrolled_m_o = \Orm_Data_Level_Enrolled::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 'o' ,'program_id' => $program->get_id(), 'academic_year' => $this->get_year()));

                    $student_enrolled_f_s = \Orm_Data_Level_Enrolled::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 's' ,'program_id' => $program->get_id(), 'academic_year' => $this->get_year()));
                    $student_enrolled_f_o = \Orm_Data_Level_Enrolled::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 'o' ,'program_id' => $program->get_id(), 'academic_year' => $this->get_year()));

                    $workload_classsize_m = \Orm_Data_Workload::get_average(array('gender' => \Orm_User::GENDER_MALE, 'program_id' => $program->get_id(), 'academic_year' => $this->get_year()));
                    $workload_classsize_f = \Orm_Data_Workload::get_average(array('gender' => \Orm_User::GENDER_FEMALE, 'program_id' => $program->get_id(), 'academic_year' => $this->get_year()));

                    $workload_m = round($workload_classsize_m['work_load'], 2);
                    $class_size_m = round($workload_classsize_m['class_size'], 2);

                    $workload_f = round($workload_classsize_f['work_load'], 2);
                    $class_size_f = round($workload_classsize_f['class_size'], 2);

                    $total_faculty = $faculty_count_m_s + $faculty_count_f_s + $faculty_count_m_o + $faculty_count_f_o;
                    $total_students = $student_enrolled_m_s + $student_enrolled_f_s + $student_enrolled_m_o + $student_enrolled_f_o;
                    $total_students_male = $student_enrolled_m_s + $student_enrolled_f_s + $student_enrolled_m_o + $student_enrolled_f_o;
                    $total_students_female = $student_enrolled_m_s + $student_enrolled_f_s + $student_enrolled_m_o + $student_enrolled_f_o;

                    $data = array();
                    $data[3][2]['male']= $student_enrolled_m_s;
                    $data[3][3]['male']= $student_enrolled_m_o;
                    $data[3][4]['male']= \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 's' ,'program_id' => $program->get_id(), 'academic_year' => $this->get_year()), 'phd_holder');
                    $data[3][5]['male']= \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 'o' ,'program_id' => $program->get_id(), 'academic_year' => $this->get_year()), 'phd_holder');
                    $data[3][6]['male']= $faculty_count_m_s;
                    $data[3][7]['male']= $faculty_count_m_o;
                    $data[3][8]['male']= $class_size_m;
                    $data[3][9]['male']= $workload_m;
                    $data[3][10]['male']= ($total_faculty ? round($total_students / $total_faculty, 2) : 0) . ':' . '1';
                    $data[3][11]['male']= ($total_faculty ? round($total_students_male / $total_faculty, 2) : 0) . ':' . '1';
                    $data[3][12]['male']= ($total_faculty ? round($total_students_female / $total_faculty, 2) : 0) . ':' . '1';
                    $data[4][2]['female']= $student_enrolled_f_s;
                    $data[4][3]['female']= $student_enrolled_f_o;
                    $data[4][4]['female']= \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 's' ,'program_id' => $program->get_id(), 'academic_year' => $this->get_year()), 'phd_holder');
                    $data[4][5]['female']= \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 'o' ,'program_id' => $program->get_id(), 'academic_year' => $this->get_year()), 'phd_holder');
                    $data[4][6]['female']= $faculty_count_f_s;
                    $data[4][7]['female']= $faculty_count_f_o;
                    $data[4][8]['female']= $class_size_f;
                    $data[4][9]['female']= $workload_f;
                    $data[4][10]['female']= ($total_faculty ? round($total_students / $total_faculty, 2) : 0) . ':' . '1';
                    $data[4][11]['female']= ($total_faculty ? round($total_students_male / $total_faculty, 2) : 0) . ':' . '1';
                    $data[4][12]['female']= ($total_faculty ? round($total_students_female / $total_faculty, 2) : 0) . ':' . '1';


                    $table_2[] = array(
                        'program_name' => $program->get_name('english'),
                        'start_date' => '',
                        'all_data'=>$data,
                    );
                }
            }
            $this->set_program_data($table_2);
            $this->save();
        }
    }

}