<?php
/**
 * Created by PhpStorm.
 * User: ahmadgx
 * Date: 02/12/15
 * Time: 02:21 م
 */

namespace Node\ncai18;


class Inst_Prof_Table_5 extends \Orm_Node{

    protected $class_type = __CLASS__;
    protected $name = 'Table 5. Numbers of Graduates in the Most Recent Year';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;
    protected $link_send_to_review = true;
    protected $orientation = 'landscape';

    public function init()
    {
        parent::init();

        $this->set_graduates(array());
    }

    /*
    * Table 5. Numbers of Graduates in the Most Recent Year
    */
    public function set_graduates($value){
        $undergraduate_students_diploma = new \Orm_Property_Text('undergraduate_students_diploma');
        $undergraduate_students_bachelor = new \Orm_Property_Text('undergraduate_students_bachelor');
        $postgraduate_students_higher_diploma = new \Orm_Property_Text('postgraduate_students_higher_diploma');
        $postgraduate_students_master = new \Orm_Property_Text('postgraduate_students_master');
        $postgraduate_students_phd = new \Orm_Property_Text('postgraduate_students_phd');


        $property = new \Orm_Property_Add_More('graduates',$value);

        $program_name = new \Orm_Property_Text('program_name');
        $program_name->set_description('Program Name');
        $property->add_property($program_name);


        $num_of_graduates = new \Orm_Property_Table('num_of_graduates');

        $num_of_graduates->add_cell(1, 1, new \Orm_Property_Fixedtext('nationality', 'Nationality'),3,0);
        $num_of_graduates->add_cell(1, 2, new \Orm_Property_Fixedtext('undergraduate', 'Undergraduates'),0,4);
        $num_of_graduates->add_cell(1, 3, new \Orm_Property_Fixedtext('post_graduate', 'PostGraduates'),0,6);

        $num_of_graduates->add_cell(2, 1, new \Orm_Property_Fixedtext('diploma', 'Diploma'),0,2);
        $num_of_graduates->add_cell(2, 2, new \Orm_Property_Fixedtext('bachelor', 'Bachelor'),0,2);
        $num_of_graduates->add_cell(2, 3, new \Orm_Property_Fixedtext('higher_diploma', 'Higher Diploma'),0,2);
        $num_of_graduates->add_cell(2, 4, new \Orm_Property_Fixedtext('master', 'Master'),0,2);
        $num_of_graduates->add_cell(2, 5, new \Orm_Property_Fixedtext('phd', 'Ph.D.'),0,2);

        $num_of_graduates->add_cell(3, 1, new \Orm_Property_Fixedtext('m', 'M'));
        $num_of_graduates->add_cell(3, 2, new \Orm_Property_Fixedtext('f', 'F'));
        $num_of_graduates->add_cell(3, 3, new \Orm_Property_Fixedtext('m', 'M'));
        $num_of_graduates->add_cell(3, 4, new \Orm_Property_Fixedtext('f', 'F'));
        $num_of_graduates->add_cell(3, 5, new \Orm_Property_Fixedtext('m', 'M'));
        $num_of_graduates->add_cell(3, 6, new \Orm_Property_Fixedtext('f', 'F'));
        $num_of_graduates->add_cell(3, 7, new \Orm_Property_Fixedtext('m', 'M'));
        $num_of_graduates->add_cell(3, 8, new \Orm_Property_Fixedtext('f', 'F'));
        $num_of_graduates->add_cell(3, 9, new \Orm_Property_Fixedtext('m', 'M'));
        $num_of_graduates->add_cell(3, 10, new \Orm_Property_Fixedtext('f', 'F'));


        $num_of_graduates->add_cell(4, 1, new \Orm_Property_Fixedtext('saudi', 'Saudi'));
        $num_of_graduates->add_cell(4, 2, $undergraduate_students_diploma);
        $num_of_graduates->add_cell(4, 3, $undergraduate_students_diploma);
        $num_of_graduates->add_cell(4, 4, $undergraduate_students_bachelor);
        $num_of_graduates->add_cell(4, 5, $undergraduate_students_bachelor);
        $num_of_graduates->add_cell(4, 6, $postgraduate_students_higher_diploma);
        $num_of_graduates->add_cell(4, 7, $postgraduate_students_higher_diploma);
        $num_of_graduates->add_cell(4, 8, $postgraduate_students_master);
        $num_of_graduates->add_cell(4, 9, $postgraduate_students_master);
        $num_of_graduates->add_cell(4, 10, $postgraduate_students_phd);
        $num_of_graduates->add_cell(4, 11, $postgraduate_students_phd);

        $num_of_graduates->add_cell(5, 1, new \Orm_Property_Fixedtext('other', 'Others'));
        $num_of_graduates->add_cell(5, 2, $undergraduate_students_diploma);
        $num_of_graduates->add_cell(5, 3, $undergraduate_students_diploma);
        $num_of_graduates->add_cell(5, 4, $undergraduate_students_bachelor);
        $num_of_graduates->add_cell(5, 5, $undergraduate_students_bachelor);
        $num_of_graduates->add_cell(5, 6, $postgraduate_students_higher_diploma);
        $num_of_graduates->add_cell(5, 7, $postgraduate_students_higher_diploma);
        $num_of_graduates->add_cell(5, 8, $postgraduate_students_master);
        $num_of_graduates->add_cell(5, 9, $postgraduate_students_master);
        $num_of_graduates->add_cell(5, 10, $postgraduate_students_phd);
        $num_of_graduates->add_cell(5, 11, $postgraduate_students_phd);

        $num_of_graduates->add_cell(6, 1, new \Orm_Property_Fixedtext('total', 'Total'));
        $num_of_graduates->add_cell(6, 2, $undergraduate_students_diploma);
        $num_of_graduates->add_cell(6, 3, $undergraduate_students_diploma);
        $num_of_graduates->add_cell(6, 4, $undergraduate_students_bachelor);
        $num_of_graduates->add_cell(6, 5, $undergraduate_students_bachelor);
        $num_of_graduates->add_cell(6, 6, $postgraduate_students_higher_diploma);
        $num_of_graduates->add_cell(6, 7, $postgraduate_students_higher_diploma);
        $num_of_graduates->add_cell(6, 8, $postgraduate_students_master);
        $num_of_graduates->add_cell(6, 9, $postgraduate_students_master);
        $num_of_graduates->add_cell(6, 10, $postgraduate_students_phd);
        $num_of_graduates->add_cell(6, 11, $postgraduate_students_phd);

        $property->add_property($num_of_graduates);

        $this->set_property($property);


    }
    public function get_graduates(){
        return $this->get_property('graduates')->get_value();

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
            $table_5 = array();
            foreach (\Orm_College::get_all() as $college) {
                foreach (\Orm_Program::get_all(array('college_id' => $college->get_id())) as $program) {

                    $bsc_ids =  array_column(\Orm_Program::get_model()->get_all(array('id' => $program->get_id(),'degree_status' => \Orm_Degree::DEGREE_UNDERGRAUDATE_BACHELOR),0,0,array(),\Orm::FETCH_ARRAY),'id');
                    $diploma_ids =  array_column(\Orm_Program::get_model()->get_all(array('id' => $program->get_id(),'degree_status' => \Orm_Degree::DEGREE_UNDERGRAUDATE_DIPLOMA),0,0,array(),\Orm::FETCH_ARRAY),'id');
                    $higher_diploma_ids =  array_column(\Orm_Program::get_model()->get_all(array('id' => $program->get_id(),'degree_status' => \Orm_Degree::DEGREE_POSTGRAUDATE_HIGH_DIPLOMA),0,0,array(),\Orm::FETCH_ARRAY),'id');
                    $masters_ids =  array_column(\Orm_Program::get_model()->get_all(array('id' => $program->get_id(),'degree_status' => \Orm_Degree::DEGREE_POSTGRAUDATE_MASTER),0,0,array(),\Orm::FETCH_ARRAY),'id');
                    $phd_ids =  array_column(\Orm_Program::get_model()->get_all(array('id' => $program->get_id(),'degree_status' => \Orm_Degree::DEGREE_POSTGRAUDATE_DOCTOR),0,0,array(),\Orm::FETCH_ARRAY),'id');
                    $bsc_ids[] = 0;
                    $diploma_ids[] = 0;
                    $higher_diploma_ids[] = 0;
                    $masters_ids[] = 0;
                    $phd_ids[] = 0;

                    $graduates[4][2]['undergraduate_students_diploma'] = \Orm_Data_Graduate::get_sum(array('program_in' => $diploma_ids,'gender' => \Orm_User::GENDER_MALE,'nationality' => 's','academic_year' => $this->get_year()),'graduate');
                    $graduates[4][3]['undergraduate_students_diploma'] = \Orm_Data_Graduate::get_sum(array('program_in' => $diploma_ids,'gender' => \Orm_User::GENDER_FEMALE,'nationality' => 's','academic_year' => $this->get_year()),'graduate');
                    $graduates[4][4]['undergraduate_students_bachelor'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_ids,'gender' => \Orm_User::GENDER_MALE,'nationality' => 's','academic_year' => $this->get_year()),'graduate');
                    $graduates[4][5]['undergraduate_students_bachelor'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_ids,'gender' => \Orm_User::GENDER_FEMALE,'nationality' => 's','academic_year' => $this->get_year()),'graduate');
                    $graduates[4][6]['postgraduate_students_higher_diploma'] = \Orm_Data_Graduate::get_sum(array('program_in' => $higher_diploma_ids,'gender' => \Orm_User::GENDER_MALE,'nationality' => 's','academic_year' => $this->get_year()),'graduate');
                    $graduates[4][7]['postgraduate_students_higher_diploma'] = \Orm_Data_Graduate::get_sum(array('program_in' => $higher_diploma_ids,'gender' => \Orm_User::GENDER_FEMALE,'nationality' => 's','academic_year' => $this->get_year()),'graduate');
                    $graduates[4][8]['postgraduate_students_master'] = \Orm_Data_Graduate::get_sum(array('program_in' => $masters_ids,'gender' => \Orm_User::GENDER_MALE,'nationality' => 's','academic_year' => $this->get_year()),'graduate');
                    $graduates[4][9]['postgraduate_students_master'] = \Orm_Data_Graduate::get_sum(array('program_in' => $masters_ids,'gender' => \Orm_User::GENDER_FEMALE,'nationality' => 's','academic_year' => $this->get_year()),'graduate');
                    $graduates[4][10]['postgraduate_students_phd'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_ids,'gender' => \Orm_User::GENDER_MALE,'nationality' => 's','academic_year' => $this->get_year()),'graduate');
                    $graduates[4][11]['postgraduate_students_phd'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_ids,'gender' => \Orm_User::GENDER_FEMALE,'nationality' => 's','academic_year' => $this->get_year()),'graduate');

                    $graduates[5][2]['undergraduate_students_diploma'] = \Orm_Data_Graduate::get_sum(array('program_in' => $diploma_ids,'gender' => \Orm_User::GENDER_MALE,'nationality' => 'o','academic_year' => $this->get_year()),'graduate');
                    $graduates[5][3]['undergraduate_students_diploma'] = \Orm_Data_Graduate::get_sum(array('program_in' => $diploma_ids,'gender' => \Orm_User::GENDER_FEMALE,'nationality' => 'o','academic_year' => $this->get_year()),'graduate');
                    $graduates[5][4]['undergraduate_students_bachelor'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_ids,'gender' => \Orm_User::GENDER_MALE,'nationality' => 'o','academic_year' => $this->get_year()),'graduate');
                    $graduates[5][5]['undergraduate_students_bachelor'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_ids,'gender' => \Orm_User::GENDER_FEMALE,'nationality' => 'o','academic_year' => $this->get_year()),'graduate');
                    $graduates[5][6]['postgraduate_students_higher_diploma'] = \Orm_Data_Graduate::get_sum(array('program_in' => $higher_diploma_ids,'gender' => \Orm_User::GENDER_MALE,'nationality' => 'o','academic_year' => $this->get_year()),'graduate');
                    $graduates[5][7]['postgraduate_students_higher_diploma'] = \Orm_Data_Graduate::get_sum(array('program_in' => $higher_diploma_ids,'gender' => \Orm_User::GENDER_FEMALE,'nationality' => 'o','academic_year' => $this->get_year()),'graduate');
                    $graduates[5][8]['postgraduate_students_master'] = \Orm_Data_Graduate::get_sum(array('program_in' => $masters_ids,'gender' => \Orm_User::GENDER_MALE,'nationality' => 'o','academic_year' => $this->get_year()),'graduate');
                    $graduates[5][9]['postgraduate_students_master'] = \Orm_Data_Graduate::get_sum(array('program_in' => $masters_ids,'gender' => \Orm_User::GENDER_FEMALE,'nationality' => 'o','academic_year' => $this->get_year()),'graduate');
                    $graduates[5][10]['postgraduate_students_phd'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_ids,'gender' => \Orm_User::GENDER_MALE,'nationality' => 'o','academic_year' => $this->get_year()),'graduate');
                    $graduates[5][11]['postgraduate_students_phd'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_ids,'gender' => \Orm_User::GENDER_FEMALE,'nationality' => 'o','academic_year' => $this->get_year()),'graduate');

                    $graduates[6][2]['undergraduate_students_diploma'] = \Orm_Data_Graduate::get_sum(array('program_in' => $diploma_ids,'gender' => \Orm_User::GENDER_MALE,'academic_year' => $this->get_year()),'graduate');
                    $graduates[6][3]['undergraduate_students_diploma'] = \Orm_Data_Graduate::get_sum(array('program_in' => $diploma_ids,'gender' => \Orm_User::GENDER_FEMALE,'academic_year' => $this->get_year()),'graduate');
                    $graduates[6][4]['undergraduate_students_bachelor'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_ids,'gender' => \Orm_User::GENDER_MALE,'academic_year' => $this->get_year()),'graduate');
                    $graduates[6][5]['undergraduate_students_bachelor'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_ids,'gender' => \Orm_User::GENDER_FEMALE,'academic_year' => $this->get_year()),'graduate');
                    $graduates[6][6]['postgraduate_students_higher_diploma'] = \Orm_Data_Graduate::get_sum(array('program_in' => $higher_diploma_ids,'gender' => \Orm_User::GENDER_MALE,'academic_year' => $this->get_year()),'graduate');
                    $graduates[6][7]['postgraduate_students_higher_diploma'] = \Orm_Data_Graduate::get_sum(array('program_in' => $higher_diploma_ids,'gender' => \Orm_User::GENDER_FEMALE,'academic_year' => $this->get_year()),'graduate');
                    $graduates[6][8]['postgraduate_students_master'] = \Orm_Data_Graduate::get_sum(array('program_in' => $masters_ids,'gender' => \Orm_User::GENDER_MALE,'academic_year' => $this->get_year()),'graduate');
                    $graduates[6][9]['postgraduate_students_master'] = \Orm_Data_Graduate::get_sum(array('program_in' => $masters_ids,'gender' => \Orm_User::GENDER_FEMALE,'academic_year' => $this->get_year()),'graduate');
                    $graduates[6][10]['postgraduate_students_phd'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_ids,'gender' => \Orm_User::GENDER_MALE,'academic_year' => $this->get_year()),'graduate');
                    $graduates[6][11]['postgraduate_students_phd'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_ids,'gender' => \Orm_User::GENDER_FEMALE,'academic_year' => $this->get_year()),'graduate');

                    $table_5[] = array(
                        'program_name' => $program->get_name('english'),
                        'num_of_graduates' => $graduates
                    );
                }
            }
            $this->set_graduates($table_5);
            $this->save();
        }
    }

}