<?php
/**
 * Created by PhpStorm.
 * User: ahmadgx
 * Date: 29/11/15
 * Time: 10:07 ص
 */

namespace Node\ncai14;


class Inst_Profile extends \Orm_Node{

    protected $class_type = __CLASS__;
    protected $name = 'Institutional Profile';
    protected $link_pdf = true;
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_send_to_review = true;
    protected $orientation = 'landscape';

    public function init()
    {
        parent::init();

        $this->set_date('');
        $this->set_introduction();
        $this->set_institution('');
        $this->set_rector('');
        $this->set_vice_rector(array());
        $this->set_dean_quality('');
        $this->set_institutional_data();
        $this->set_institutional_summary('');
        $this->set_branch(array());
        $this->set_units(array());
        $this->set_achievements('');
    }
    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $childrens = array();
        $childrens[] = new Inst_Prof_Table_1();
        $childrens[] = new Inst_Prof_Table_2();
        $childrens[] = new Inst_Prof_Table_3();
        $childrens[] = new Inst_Prof_Table_4();
        $childrens[] = new Inst_Prof_Table_5();
        $childrens[] = new Inst_Prof_Table_6();
        $childrens[] = new Inst_Prof_Table_7();
        $childrens[] = new Inst_Prof_Table_8();


        return $childrens;
    }

    public function set_date($value){
        $property = new \Orm_Property_Date('date',$value);
        $property->set_description('Date');
        $this->set_property($property);
    }
    public function  get_date(){
        return $this->get_property('date')->get_value();
    }

    public function set_introduction(){
        $property = new \Orm_Property_Fixedtext('introduction','<strong>INTRODUCTION<br/>The aim of this template is to collect information and data associated with the Institution. The Institutional information and data should be updated annually, and will be used for aggregated national benchmarking.The aim of this template is to collect information and data associated with the Institution. The Institutional information and data should be updated annually, and will be used for aggregated national benchmarking.<br/><br/>Institutional Data</strong>');
        $this->set_property($property);
    }

    public function set_institution($value)
    {
        $property = new \Orm_Property_Text('institution', $value);
        $property->set_description('Name of Institution');
        $this->set_property($property);
    }

    public function get_institution()
    {
        return $this->get_property('institution')->get_value();
    }

    public function set_rector($value){
        $property = new \Orm_Property_Table('rector',$value);
        $property->set_description('Name and Contact Information for Rector');


        $property->add_cell(1,1,new \Orm_Property_Fixedtext('name_of_rector','Name Of Rector'));
        $property->add_cell(1,2,new \Orm_Property_Text('name'));

        $property->add_cell(2,1,new \Orm_Property_Fixedtext('contact_information','Contact Information'), 0, 2);

        $property->add_cell(3,1,new \Orm_Property_Fixedtext('address','Address'));
        $property->add_cell(3,2,new \Orm_Property_Text('address'));

        $property->add_cell(4,1,new \Orm_Property_Fixedtext('telephone','Telephone'));
        $property->add_cell(4,2,new \Orm_Property_Text('telephone'));

        $property->add_cell(5,1,new \Orm_Property_Fixedtext('email','Email'));
        $property->add_cell(5,2,new \Orm_Property_Text('email'));
        $this->set_property($property);

    }

    public function get_rector(){
        return $this->get_property('rector')->get_value();
    }


    public function set_vice_rector($value){
        $property = new \Orm_Property_Add_More('vice_rector', $value);

        $name_of_vice_Rector = new \Orm_Property_Text('name_of_vice_Rector');
        $name_of_vice_Rector->set_description('Name of Vice Rectors and their position title:');
        $property->add_property($name_of_vice_Rector);

        $address_of_vice_rector = new \Orm_Property_Text('address_of_vice_rector');
        $address_of_vice_rector->set_description('Address of Vice Rector');
        $property->add_property($address_of_vice_rector);

        $telephone_of_vice_rector = new \Orm_Property_Text('telephone_of_vice_rector');
        $telephone_of_vice_rector->set_description('Telephone of Vice Rector');
        $property->add_property($telephone_of_vice_rector);

        $email_of_vice_rector = new \Orm_Property_Text('email_of_vice_rector');
        $email_of_vice_rector->set_description('Email of Vice Rector');
        $property->add_property($email_of_vice_rector);

        $this->set_property($property);

    }

    public function get_vice_rector(){
        return $this->get_property('vice_rector')->get_value();
    }

    public function set_dean_quality($value){
        $property = new \Orm_Property_Table('dean_quality',$value);
        $property->set_description('Name and Contact Information for Vice Rector');


        $property->add_cell(1,1,new \Orm_Property_Fixedtext('name_of_dean','Name  of Dean of Quality Assurance:'));
        $property->add_cell(1,2,new \Orm_Property_Text('name'));

        $property->add_cell(2,1,new \Orm_Property_Fixedtext('contact_information','Contact Information'), 0, 2);

        $property->add_cell(3,1,new \Orm_Property_Fixedtext('address','Address'));
        $property->add_cell(3,2,new \Orm_Property_Text('address'));

        $property->add_cell(4,1,new \Orm_Property_Fixedtext('telephone','Telephone'));
        $property->add_cell(4,2,new \Orm_Property_Text('telephone'));

        $property->add_cell(5,1,new \Orm_Property_Fixedtext('email','Email'));
        $property->add_cell(5,2,new \Orm_Property_Text('email'));
        $this->set_property($property);

    }

    public function get_dean_quality(){
        return $this->get_property('dean_quality')->get_value();
    }

   public function set_institutional_data(){
       $property = new \Orm_Property_Fixedtext('institutional_data','<strong>B. Institutional Profile Data:</strong>');
       $this->set_property($property);
   }
   public function get_institutional_data(){

       return $this->get_property('institutional_data')->get_value();
   }

    public function set_institutional_summary($value){
       $property = new \Orm_Property_Textarea('institutional_summary',$value);
        $property->set_description('I. Brief Summary of the Institution History');
       $this->set_property($property);
   }
   public function get_institutional_summary(){

       return $this->get_property('institutional_summary')->get_value();
   }

    public function set_branch($value){
        $property = new \Orm_Property_Add_More('branch', $value);

        $branch = new \Orm_Property_Text('branches');
        $branch->set_description('II. Branches/Locations');
        $property->add_property($branch);

        $this->set_property($property);

    }

    public function get_branch(){

        return $this->get_property('branch')->get_value();
    }


    public function set_units($value){
        $property = new \Orm_Property_Table('units',$value);
        $property->set_description('III. Institution’s Academic Units');

        $property->add_cell(1,1,new \Orm_Property_Fixedtext('deanship','Number of Deanships'));
        $property->add_cell(1,2,new \Orm_Property_Text('deanship_num'));
        $property->add_cell(2,1,new \Orm_Property_Fixedtext('colleges','Number of Colleges'));
        $property->add_cell(2,2,new \Orm_Property_Text('college_num'));
        $property->add_cell(3,1,new \Orm_Property_Fixedtext('programs','Number of Programs'));
        $property->add_cell(3,2,new \Orm_Property_Text('program_num'));
        $property->add_cell(4,1,new \Orm_Property_Fixedtext('institutes','Number of Institutes'));
        $property->add_cell(4,2,new \Orm_Property_Text('Institute_num'));
        $property->add_cell(5,1,new \Orm_Property_Fixedtext('research_center','Number of  research Centers'));
        $property->add_cell(5,2,new \Orm_Property_Text('research_center_num'));
        $property->add_cell(6,1,new \Orm_Property_Fixedtext('research_chairs','Number of  research Chairs'));
        $property->add_cell(6,2,new \Orm_Property_Text('research_chair_num'));
        $property->add_cell(7,1,new \Orm_Property_Fixedtext('hospitals','Number of Medical Hospitals and Centers'));
        $property->add_cell(7,2,new \Orm_Property_Text('hospital_num'));
        $property->add_cell(8,1,new \Orm_Property_Fixedtext('societies','Number of Scientific Societies'));
        $property->add_cell(8,2,new \Orm_Property_Text('societies_num'));

        $this->set_property($property);
    }
    public function get_units(){

        return $this->get_property('units')->get_value();
    }

    public function set_achievements($value){
        $property = new \Orm_Property_Textarea('achievements',$value);
        $property->set_description('IV. List of the Institution’s Achievements, Awards, and Significant Accomplishments');
        $this->set_property($property);
    }
    public function get_achievements(){
        return $this->get_property('achievements')->get_value();
    }



    public function after_node_load()
    {
        parent::after_node_load();
        $this->set_institution(\Orm_Institution::get_university_name('english'));
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
            $info = \Orm_Data_Institution::get_all(array('academic_year' => $this->get_year()));

            $vice_rector = array();

            foreach ($info as $rector) {
                if ($rector->get_position() == 'rector')
                {
                    $rector_array = array();
                    $rector_array[1][2]['name'] = $rector->get_full_name();
                    $rector_array[3][2]['address'] = $rector->get_address();
                    $rector_array[4][2]['telephone'] = $rector->get_telephone();
                    $rector_array[5][2]['email'] = $rector->get_email();
                    $this->set_rector($rector_array);
                } elseif ($rector->get_position() == 'quality_assurance') {
                    $quality_array = array();
                    $quality_array[1][2]['name'] = $rector->get_full_name();
                    $quality_array[3][2]['address'] = $rector->get_address();
                    $quality_array[4][2]['telephone'] = $rector->get_telephone();
                    $quality_array[5][2]['email'] = $rector->get_email();
                    $this->set_dean_quality($quality_array);
                } else {
                    $vice_rector[] = array(
                        'name_of_vice_Rector' => $rector->get_full_name() . ' - ' . $rector->get_position(),
                        'address_of_vice_rector' => $rector->get_address(),
                        'telephone_of_vice_rector' => $rector->get_telephone(),
                        'email_of_vice_rector' => $rector->get_email()
                    );
                }
            }
            $this->set_vice_rector($vice_rector);



            if (\Orm_Campus::get_count() != 0) {
                $branches = $this->get_branch();
                $i = 0;

                $dynamic_branches = \Orm_Campus::get_all();
                foreach ($dynamic_branches as $branch) {
                    $branches[$i]['branches'] = $branch->get_name();
                    $i++;
                }
            } else {
                $branches = array();
                $branches[0]['branches'] = 'Main Campus';
            }


            $units = $this->get_units();

            $counts = \Orm_Data_Academic_Units::get_one(array('academic_year' => $this->get_year()));
            $units[1][2]['deanship_num'] = $counts->get_no_deanships();
            $units[2][2]['college_num'] = $counts->get_no_colleges();
            $units[3][2]['program_num'] = $counts->get_no_programs();
            $units[4][2]['Institute_num'] = $counts->get_no_institutions();
            $units[5][2]['research_center_num'] = $counts->get_no_research_center();
            $units[6][2]['research_chair_num'] = $counts->get_no_research_chairs();
            $units[7][2]['hospital_num'] = $counts->get_no_medical_hospital();
            $units[8][2]['societies_num'] = $counts->get_no_scientific();

            $this->set_units($units);

            $this->save();
        }
    }
}
