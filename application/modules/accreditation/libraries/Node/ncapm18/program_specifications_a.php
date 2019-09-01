<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 11/10/18
 * Time: 12:32 م
 */

namespace Node\ncapm18;


class Program_Specifications_A extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $name = 'A. Program Identification and General Information';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

        $this->set_credit_hours('');
        $this->set_learning_point('');
        $this->set_occupations('');
        $this->set_branch(array());
        $this->set_major(array());
        $this->set_exit_points(array());

    }

    public function set_credit_hours($value){
        $property =  new \Orm_Property_Text('credit_hours',$value);
        $property->set_description('1. Total credit hours(Ch)');
        $this->set_property($property);
    }
    public function get_credit_hours(){
        return $this->get_property('credit_hours')->get_value();
    }

    public function set_learning_point($value){
        $property =  new \Orm_Property_Text('learning_point',$value);
        $property->set_description('2. Learning points(LP)');
        $this->set_property($property);
    }
    public function get_learning_point(){
        return $this->get_property('learning_point')->get_value();
    }

    public function set_occupations($value){
        $property =  new \Orm_Property_Textarea('occupations',$value);
        $property->set_description('3. Professional occupations');

        $this->set_property($property);
    }
    public function get_occupations(){
        return $this->get_property('occupations')->get_value();
    }

    public function set_branch($value){
        $property =  new \Orm_Property_Add_More('branch',$value);
        $property->set_description('4. Branches offering the program');

        $text = new \Orm_Property_Text('text');
        $property->add_property($text);

        $this->set_property($property);
    }
    public function get_branch(){
        return $this->get_property('branch')->get_value();
    }

    public function set_major($value){
        $property =  new \Orm_Property_Table_Dynamic('major',$value);
        $property->set_description('5. Major tracks/pathways (if any)');

        $pathways = new \Orm_Property_Text('pathways');
        $pathways->set_description('Major tracks/pathways');
        $property->add_property($pathways);

        $credit_hrs = new \Orm_Property_Text('credit_hrs');
        $credit_hrs->set_description('Credit hours(For each track)');
        $property->add_property($credit_hrs);

        $occupations = new \Orm_Property_Text('occupations');
        $occupations->set_description('Professional occupations(For each track)');
        $property->add_property($occupations);

        $this->set_property($property);
    }
    public function get_major(){
        return $this->get_property('major')->get_value();
    }

    public function set_exit_points($value){
        $property =  new \Orm_Property_Table_Dynamic('exit_points',$value);
        $property->set_description('6. Intermediate exit Points/awarded degree (if any):');

        $awarded_degree = new \Orm_Property_Text('awarded_degree');
        $awarded_degree->set_description('Intermediate exit Points/awarded degree');
        $property->add_property($awarded_degree);

        $credit_hrs = new \Orm_Property_Text('credit_hrs');
        $credit_hrs->set_description('Credit hours');
        $property->add_property($credit_hrs);

        $occupations = new \Orm_Property_Text('occupations');
        $occupations->set_description('Professional occupations');
        $property->add_property($occupations);

        $this->set_property($property);
    }
    public function get_exit_points(){
        return $this->get_property('exit_points')->get_value();
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

            $program_node = $this->get_parent_program_node();
            if (!is_null($program_node) && $program_node->get_id()) {
                $program_obj = $program_node->get_item_obj(); /* @var $program_obj \Orm_Program */
                $department_obj = $program_obj->get_department_obj();
                $college_obj = $department_obj->get_college_obj();
                $campuses_obj = $college_obj->get_campuses();


                $this->set_credit_hours($program_obj->get_credit_hours());

                $majors = array();
                foreach ($campuses_obj as $campuse) {
                    $majors[] = array(
                        'text' => $campuse->get_name('english'),
                    );
                }
                $this->set_branch($majors);

                $majors = array();
                foreach ($program_obj->get_majors() as $major){
                    $majors[] = array(
                        'pathways'=>$major->get_name('english')
                    );
                }
                $this->set_major($majors);
            }
        }

        $this->save();
    }



}