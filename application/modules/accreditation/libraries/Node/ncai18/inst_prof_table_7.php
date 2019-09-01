<?php
/**
 * Created by PhpStorm.
 * User: ahmadgx
 * Date: 02/12/15
 * Time: 02:21 م
 */

namespace Node\ncai18;


class Inst_Prof_Table_7 extends \Orm_Node{

    protected $class_type = __CLASS__;
    protected $name = 'Table 7. Mode of Instruction – Teaching Staff';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;
    protected $link_send_to_review = true;
    protected $orientation = 'landscape';

    public function init()
    {
        parent::init();

        $this->set_instruction_teaching_staff(array());
        $this->set_instruction_teaching_staff_note();
    }

    /*
    * Table 7. Mode of Instruction – Teaching Staff
    */

    public function set_instruction_teaching_staff($value){

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

        $property = new \Orm_Property_Add_More('instruction_teaching_staff',$value);
        $property->set_description('(excluding preparatory year program)');

        $program_name = new \Orm_Property_Text('program_name');
        $program_name->set_description('Program Name');
        $property->add_property($program_name);

        $teaching_staff= new \Orm_Property_Table('teaching_staff');

        $teaching_staff->add_cell(1, 1, new \Orm_Property_Fixedtext('nationality', 'Nationality'), 3, 0);
        $teaching_staff->add_cell(1, 2, new \Orm_Property_Fixedtext('on_campus', 'On Campus Programs'), 0, 6);
        $teaching_staff->add_cell(1, 3, new \Orm_Property_Fixedtext('distance_education_programs', 'Distance Education Programs'), 0, 6);

        $teaching_staff->add_cell(2, 1, $full_time,0,2);
        $teaching_staff->add_cell(2, 2, $part_time,0,2);
        $teaching_staff->add_cell(2, 3, $fte,0,2);
        $teaching_staff->add_cell(2, 4, $full_time,0,2);
        $teaching_staff->add_cell(2, 5, $part_time,0,2);
        $teaching_staff->add_cell(2, 6, $fte,0,2);


        $teaching_staff->add_cell(3, 1, $male);
        $teaching_staff->add_cell(3, 2, $female);
        $teaching_staff->add_cell(3, 3, $male);
        $teaching_staff->add_cell(3, 4, $female);
        $teaching_staff->add_cell(3, 5, $male);
        $teaching_staff->add_cell(3, 6, $female);
        $teaching_staff->add_cell(3, 7, $male);
        $teaching_staff->add_cell(3, 8, $female);
        $teaching_staff->add_cell(3, 9, $male);
        $teaching_staff->add_cell(3, 10, $female);
        $teaching_staff->add_cell(3, 11, $male);
        $teaching_staff->add_cell(3, 12, $female);

        $teaching_staff->add_cell(4, 1, new \Orm_Property_Fixedtext('saudi', 'Saudi'));
        $teaching_staff->add_cell(4, 2, $on_campus_ft);
        $teaching_staff->add_cell(4, 3, $on_campus_ft);
        $teaching_staff->add_cell(4, 4, $on_campus_pt);
        $teaching_staff->add_cell(4, 5, $on_campus_pt);
        $teaching_staff->add_cell(4, 6, $on_campus_fte);
        $teaching_staff->add_cell(4, 7, $on_campus_fte);
        $teaching_staff->add_cell(4, 8, $distance_education_programs_ft);
        $teaching_staff->add_cell(4, 9, $distance_education_programs_ft);
        $teaching_staff->add_cell(4, 10, $distance_education_programs_pt);
        $teaching_staff->add_cell(4, 11, $distance_education_programs_pt);
        $teaching_staff->add_cell(4, 12, $distance_education_programs_fte);
        $teaching_staff->add_cell(4, 13, $distance_education_programs_fte);

        $teaching_staff->add_cell(5, 1, new \Orm_Property_Fixedtext('others', 'Others'));
        $teaching_staff->add_cell(5, 2, $on_campus_ft);
        $teaching_staff->add_cell(5, 3, $on_campus_ft);
        $teaching_staff->add_cell(5, 4, $on_campus_pt);
        $teaching_staff->add_cell(5, 5, $on_campus_pt);
        $teaching_staff->add_cell(5, 6, $on_campus_fte);
        $teaching_staff->add_cell(5, 7, $on_campus_fte);
        $teaching_staff->add_cell(5, 8, $distance_education_programs_ft);
        $teaching_staff->add_cell(5, 9, $distance_education_programs_ft);
        $teaching_staff->add_cell(5, 10, $distance_education_programs_pt);
        $teaching_staff->add_cell(5, 11, $distance_education_programs_pt);
        $teaching_staff->add_cell(5, 12, $distance_education_programs_fte);
        $teaching_staff->add_cell(5, 13, $distance_education_programs_fte);

        $teaching_staff->add_cell(6, 1, new \Orm_Property_Fixedtext('total', 'Total'));
        $teaching_staff->add_cell(6, 2, $on_campus_ft);
        $teaching_staff->add_cell(6, 3, $on_campus_ft);
        $teaching_staff->add_cell(6, 4, $on_campus_pt);
        $teaching_staff->add_cell(6, 5, $on_campus_pt);
        $teaching_staff->add_cell(6, 6, $on_campus_fte);
        $teaching_staff->add_cell(6, 7, $on_campus_fte);
        $teaching_staff->add_cell(6, 8, $distance_education_programs_ft);
        $teaching_staff->add_cell(6, 9, $distance_education_programs_ft);
        $teaching_staff->add_cell(6, 10, $distance_education_programs_pt);
        $teaching_staff->add_cell(6, 11, $distance_education_programs_pt);
        $teaching_staff->add_cell(6, 12, $distance_education_programs_fte);
        $teaching_staff->add_cell(6, 13, $distance_education_programs_fte);

        $property->add_property($teaching_staff);

        $this->set_property($property);



    }
    public function get_instruction_teaching_staff(){
        return $this->get_property('instruction_teaching_staff')->get_value();

    }
    public function set_instruction_teaching_staff_note(){
        $property = new \Orm_Property_Fixedtext('instruction_teaching_staff_note', '<strong>Note:  In some situations FTE faculty members teach both on campus and in the distant education program; it these cases the FTE faculty should be entered ONE section, not in both. </strong>');
        $this->set_property($property);
    }
    public function get_instruction_teaching_staff_note(){
        return $this->get_property('instruction_teaching_staff_note')->get_value();

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
            $table_7 = array();

            foreach (\Orm_College::get_all() as $college) {
                foreach (\Orm_Program::get_all(array('college_id' => $college->get_id())) as $program) {

                    $faculty_count_m_s = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 's' ,'program_id' => $program->get_id(), 'academic_year' => $this->get_year()), 'teaching_staff');
                    $faculty_count_m_o = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 'o' ,'program_id' => $program->get_id(), 'academic_year' => $this->get_year()), 'teaching_staff');

                    $faculty_count_f_s = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 's' ,'program_id' => $program->get_id(), 'academic_year' => $this->get_year()), 'teaching_staff');
                    $faculty_count_f_o = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 'o' ,'program_id' => $program->get_id(), 'academic_year' => $this->get_year()), 'teaching_staff');

                    $staff[4][2]['on_campus_ft'] = $faculty_count_m_s;
                    $staff[4][3]['on_campus_ft'] = $faculty_count_f_s;
                    $staff[4][4]['on_campus_pt'] = 0;
                    $staff[4][5]['on_campus_pt'] = 0;
                    $staff[4][6]['on_campus_fte'] = 0;
                    $staff[4][7]['on_campus_fte'] = 0;
                    $staff[4][8]['distance_education_programs_ft'] = 0;
                    $staff[4][9]['distance_education_programs_ft'] = 0;
                    $staff[4][10]['distance_education_programs_pt'] = 0;
                    $staff[4][11]['distance_education_programs_pt'] = 0;
                    $staff[4][12]['distance_education_programs_fte'] = 0;
                    $staff[4][13]['distance_education_programs_fte'] = 0;

                    $staff[5][2]['on_campus_ft'] = $faculty_count_m_o;
                    $staff[5][3]['on_campus_ft'] = $faculty_count_f_o;
                    $staff[5][4]['on_campus_pt'] = 0;
                    $staff[5][5]['on_campus_pt'] = 0;
                    $staff[5][6]['on_campus_fte'] = 0;
                    $staff[5][7]['on_campus_fte'] = 0;
                    $staff[5][8]['distance_education_programs_ft'] = 0;
                    $staff[5][9]['distance_education_programs_ft'] = 0;
                    $staff[5][10]['distance_education_programs_pt'] = 0;
                    $staff[5][11]['distance_education_programs_pt'] = 0;
                    $staff[5][12]['distance_education_programs_fte'] = 0;
                    $staff[5][13]['distance_education_programs_fte'] = 0;

                    $staff[6][2]['on_campus_ft'] = $faculty_count_m_s + $faculty_count_m_o;
                    $staff[6][3]['on_campus_ft'] = $faculty_count_f_s + $faculty_count_f_o;
                    $staff[6][4]['on_campus_pt'] = 0;
                    $staff[6][5]['on_campus_pt'] = 0;
                    $staff[6][6]['on_campus_fte'] = 0;
                    $staff[6][7]['on_campus_fte'] = 0;
                    $staff[6][8]['distance_education_programs_ft'] = 0;
                    $staff[6][9]['distance_education_programs_ft'] = 0;
                    $staff[6][10]['distance_education_programs_pt'] = 0;
                    $staff[6][11]['distance_education_programs_pt'] = 0;
                    $staff[6][12]['distance_education_programs_fte'] = 0;
                    $staff[6][13]['distance_education_programs_fte'] = 0;

                    $table_7[] = array(
                        'program_name' => $program->get_name('english'),
                        'teaching_staff' => $staff
                    );
                }
            }
            $this->set_instruction_teaching_staff($table_7);
            $this->save();
        }
    }

}