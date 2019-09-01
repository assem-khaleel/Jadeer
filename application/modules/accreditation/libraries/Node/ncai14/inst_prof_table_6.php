<?php
/**
 * Created by PhpStorm.
 * User: ahmadgx
 * Date: 02/12/15
 * Time: 02:21 م
 */

namespace Node\ncai14;


class Inst_Prof_Table_6 extends \Orm_Node{

    protected $class_type = __CLASS__;
    protected $name = 'Table 6. Mode of Instruction – Student Enrollment ';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;
    protected $link_send_to_review = true;
    protected $orientation = 'landscape';

    public function init()
    {
        parent::init();

        $this->set_student_enrollment(array());
        $this->set_student_enrollment_note();
    }


    /*
     * Table 6. Mode of Instruction – Student Enrollment (excluding preparatory year program)
     */

    public function set_student_enrollment($value){

        $full_time = new \Orm_Property_Fixedtext('full_time', 'Full time');
        $part_time = new \Orm_Property_Fixedtext('part_time', 'Part time');
        $fte = new \Orm_Property_Fixedtext('fte', 'FTE');
        $female = new \Orm_Property_Fixedtext('female', 'F');
        $male = new \Orm_Property_Fixedtext('male', 'M');

        $on_campus_ft = new \Orm_Property_Text('on_campus_ft');
        $on_campus_pt = new \Orm_Property_Text('on_campus_pt');
        $on_campus_fte = new \Orm_Property_Text('on_campus_fte');

        $distance_education_programs_ft = new \Orm_Property_Text('distance_education_programs_ft');
        $distance_education_programs_pt = new \Orm_Property_Text('distance_education_programs_pt');
        $distance_education_programs_fte = new \Orm_Property_Text('distance_education_programs_fte');

        $property = new \Orm_Property_Add_More('student_enrollment',$value);
        $property->set_description('(excluding preparatory year program)');

        $program_name = new \Orm_Property_Text('program_name');
        $program_name->set_description('Program Name');
        $property->add_property($program_name);

        $student_enrollment = new \Orm_Property_Table('student_enrollment');

        $student_enrollment->add_cell(1, 1, new \Orm_Property_Fixedtext('nationality', 'Nationality'), 3, 0);
        $student_enrollment->add_cell(1, 2, new \Orm_Property_Fixedtext('on_campus', 'On Campus Programs'), 0, 6);
        $student_enrollment->add_cell(1, 3, new \Orm_Property_Fixedtext('distance_education_programs', 'Distance Education Programs'), 0, 6);

        $student_enrollment->add_cell(2, 1, $full_time,0,2);
        $student_enrollment->add_cell(2, 2, $part_time,0,2);
        $student_enrollment->add_cell(2, 3, $fte,0,2);
        $student_enrollment->add_cell(2, 4, $full_time,0,2);
        $student_enrollment->add_cell(2, 5, $part_time,0,2);
        $student_enrollment->add_cell(2, 6, $fte,0,2);


        $student_enrollment->add_cell(3, 1, $male);
        $student_enrollment->add_cell(3, 2, $female);
        $student_enrollment->add_cell(3, 3, $male);
        $student_enrollment->add_cell(3, 4, $female);
        $student_enrollment->add_cell(3, 5, $male);
        $student_enrollment->add_cell(3, 6, $female);
        $student_enrollment->add_cell(3, 7, $male);
        $student_enrollment->add_cell(3, 8, $female);
        $student_enrollment->add_cell(3, 9, $male);
        $student_enrollment->add_cell(3, 10, $female);
        $student_enrollment->add_cell(3, 11, $male);
        $student_enrollment->add_cell(3, 12, $female);


        $student_enrollment->add_cell(4, 1, new \Orm_Property_Fixedtext('saudi', 'Saudi'));
        $student_enrollment->add_cell(4, 2, $on_campus_ft);
        $student_enrollment->add_cell(4, 3, $on_campus_ft);
        $student_enrollment->add_cell(4, 4, $on_campus_pt);
        $student_enrollment->add_cell(4, 5, $on_campus_pt);
        $student_enrollment->add_cell(4, 6, $on_campus_fte);
        $student_enrollment->add_cell(4, 7, $on_campus_fte);
        $student_enrollment->add_cell(4, 8, $distance_education_programs_ft);
        $student_enrollment->add_cell(4, 9, $distance_education_programs_ft);
        $student_enrollment->add_cell(4, 10, $distance_education_programs_pt);
        $student_enrollment->add_cell(4, 11, $distance_education_programs_pt);
        $student_enrollment->add_cell(4, 12, $distance_education_programs_fte);
        $student_enrollment->add_cell(4, 13, $distance_education_programs_fte);

        $student_enrollment->add_cell(5, 1, new \Orm_Property_Fixedtext('others', 'Others'));
        $student_enrollment->add_cell(5, 2, $on_campus_ft);
        $student_enrollment->add_cell(5, 3, $on_campus_ft);
        $student_enrollment->add_cell(5, 4, $on_campus_pt);
        $student_enrollment->add_cell(5, 5, $on_campus_pt);
        $student_enrollment->add_cell(5, 6, $on_campus_fte);
        $student_enrollment->add_cell(5, 7, $on_campus_fte);
        $student_enrollment->add_cell(5, 8, $distance_education_programs_ft);
        $student_enrollment->add_cell(5, 9, $distance_education_programs_ft);
        $student_enrollment->add_cell(5, 10, $distance_education_programs_pt);
        $student_enrollment->add_cell(5, 11, $distance_education_programs_pt);
        $student_enrollment->add_cell(5, 12, $distance_education_programs_fte);
        $student_enrollment->add_cell(5, 13, $distance_education_programs_fte);

        $student_enrollment->add_cell(6, 1, new \Orm_Property_Fixedtext('total', 'Total'));
        $student_enrollment->add_cell(6, 2, $on_campus_ft);
        $student_enrollment->add_cell(6, 3, $on_campus_ft);
        $student_enrollment->add_cell(6, 4, $on_campus_pt);
        $student_enrollment->add_cell(6, 5, $on_campus_pt);
        $student_enrollment->add_cell(6, 6, $on_campus_fte);
        $student_enrollment->add_cell(6, 7, $on_campus_fte);
        $student_enrollment->add_cell(6, 8, $distance_education_programs_ft);
        $student_enrollment->add_cell(6, 9, $distance_education_programs_ft);
        $student_enrollment->add_cell(6, 10, $distance_education_programs_pt);
        $student_enrollment->add_cell(6, 11, $distance_education_programs_pt);
        $student_enrollment->add_cell(6, 12, $distance_education_programs_fte);
        $student_enrollment->add_cell(6, 13, $distance_education_programs_fte);
        $property->add_property($student_enrollment);

        $this->set_property($property);


    }
    public function get_student_enrollment(){
        return $this->get_property('student_enrollment')->get_value();
    }

    public function set_student_enrollment_note()
    {
        $property = new \Orm_Property_Fixedtext('student_enrollment_note', '<strong>Note : </strong>FTE (full time equivalent) for part time students - assume a full time load is 15 credit hours and divide the number of credit hours taken by each student by 15 (use this formula only for part time students).');
        $this->set_property($property);
    }

    public function get_student_enrollment_note()
    {
        return $this->get_property('student_enrollment_note')->get_value();
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
            $table_6 = array();
            foreach (\Orm_College::get_all() as $college) {
                foreach (\Orm_Program::get_all(array('college_id' => $college->get_id())) as $program) {

                    $enrolled[4][2]['on_campus_ft'] = \Orm_Data_Level_Enrolled::get_sum(array('program_id' => $program->get_id(),'gender' => \Orm_User::GENDER_MALE,'nationality' => 's','academic_year' => $this->get_year()));
                    $enrolled[4][3]['on_campus_ft'] = \Orm_Data_Level_Enrolled::get_sum(array('program_id' => $program->get_id(),'gender' => \Orm_User::GENDER_FEMALE,'nationality' => 's','academic_year' => $this->get_year()));
                    $enrolled[4][4]['on_campus_pt'] = 0;
                    $enrolled[4][5]['on_campus_pt'] = 0;
                    $enrolled[4][6]['on_campus_fte'] = 0;
                    $enrolled[4][7]['on_campus_fte'] = 0;
                    $enrolled[4][8]['distance_education_programs_ft'] = 0;
                    $enrolled[4][9]['distance_education_programs_ft'] = 0;
                    $enrolled[4][10]['distance_education_programs_pt'] = 0;
                    $enrolled[4][11]['distance_education_programs_pt'] = 0;
                    $enrolled[4][12]['distance_education_programs_fte'] = 0;
                    $enrolled[4][13]['distance_education_programs_fte'] = 0;
                    $enrolled[5][2]['on_campus_ft'] = \Orm_Data_Level_Enrolled::get_sum(array('program_id' => $program->get_id(),'gender' => \Orm_User::GENDER_MALE,'nationality' => 'o','academic_year' => $this->get_year()));
                    $enrolled[5][3]['on_campus_ft'] = \Orm_Data_Level_Enrolled::get_sum(array('program_id' => $program->get_id(),'gender' => \Orm_User::GENDER_FEMALE,'nationality' => 'o','academic_year' => $this->get_year()));
                    $enrolled[5][4]['on_campus_pt'] = 0;
                    $enrolled[5][5]['on_campus_pt'] = 0;
                    $enrolled[5][6]['on_campus_fte'] = 0;
                    $enrolled[5][7]['on_campus_fte'] = 0;
                    $enrolled[5][8]['distance_education_programs_ft'] = 0;
                    $enrolled[5][9]['distance_education_programs_ft'] = 0;
                    $enrolled[5][10]['distance_education_programs_pt'] = 0;
                    $enrolled[5][11]['distance_education_programs_pt'] = 0;
                    $enrolled[5][12]['distance_education_programs_fte'] = 0;
                    $enrolled[5][13]['distance_education_programs_fte'] = 0;
                    $enrolled[6][2]['on_campus_ft'] = \Orm_Data_Level_Enrolled::get_sum(array('program_id' => $program->get_id(),'gender' => \Orm_User::GENDER_MALE,'academic_year' => $this->get_year()));
                    $enrolled[6][3]['on_campus_ft'] = \Orm_Data_Level_Enrolled::get_sum(array('program_id' => $program->get_id(),'gender' => \Orm_User::GENDER_FEMALE,'academic_year' => $this->get_year()));
                    $enrolled[6][4]['on_campus_pt'] = 0;
                    $enrolled[6][5]['on_campus_pt'] = 0;
                    $enrolled[6][6]['on_campus_fte'] = 0;
                    $enrolled[6][7]['on_campus_fte'] = 0;
                    $enrolled[6][8]['distance_education_programs_ft'] = 0;
                    $enrolled[6][9]['distance_education_programs_ft'] = 0;
                    $enrolled[6][10]['distance_education_programs_pt'] = 0;
                    $enrolled[6][11]['distance_education_programs_pt'] = 0;
                    $enrolled[6][12]['distance_education_programs_fte'] = 0;
                    $enrolled[6][13]['distance_education_programs_fte'] = 0;

                    $table_6[] = array(
                        'program_name' => $program->get_name('english'),
                        'student_enrollment' => $enrolled
                    );
                }
            }
            $this->set_student_enrollment($table_6);
            $this->save();
        }
    }

}