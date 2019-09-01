<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 08/10/18
 * Time: 10:12 ص
 */

namespace Node\ncacm18;


class Course_Specifications_A extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'A. Course Identification';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;


    public function init()
    {
        parent::init();
        $this->set_credit_hour('');
        $this->set_course_type();
        $this->set_course_type_a('');
        $this->set_course_type_b('');
        $this->set_level_year('');
        $this->set_pre_requisites('');
        $this->set_co_requisites('');
        $this->set_course_component(array());


    }

    public function set_credit_hour($value){
        $property = new \Orm_Property_Text('credit_hour',$value);
        $property->set_description('1. Credit hours');
        $this->set_property($property);
    }
    public function get_credit_hour(){

        return $this->get_property('credit_hour')->get_value();
    }
    public function set_course_type(){
        $property = new \Orm_Property_Fixedtext('course_type','2. Course type');
        $property->set_group('types');
        $this->set_property($property);
    }
    public function get_course_type(){
        return $this->get_property('course_type')->get_value();

    }

    public function set_course_type_a($value){
        $property = new \Orm_Property_Radio('course_type_a',$value);
        $property->set_options(array('University','College','Department'));
        $property->set_description('A');
        $property->set_group('types');
        $this->set_property($property);
    }
    public function get_course_type_a(){
        return $this->get_property('course_type_a')->get_value();

    }
    public function set_course_type_b($value){
        $property = new \Orm_Property_Radio('course_type_b',$value);
        $property->set_options(array('Required','Elective'));
        $property->set_description('B');
        $property->set_group('types');
        $this->set_property($property);
    }
    public function get_course_type_b(){
        return $this->get_property('course_type_b')->get_value();

    }

    public function set_level_year($value){
        $property = new \Orm_Property_Text('Level_year',$value);
        $property->set_description('3. Level/year at which this course is offered');
        $this->set_property($property);
    }
    public function get_level_year(){

        return $this->get_property('Level_year')->get_value();
    }
    public function set_pre_requisites($value){
        $property = new \Orm_Property_Text('pre_requisites',$value);
        $property->set_description('4. Pre-requisites for this course (if any)');
        $this->set_property($property);
    }
    public function get_pre_requisites(){

        return $this->get_property('pre_requisites')->get_value();
    }
    public function set_co_requisites($value){
        $property = new \Orm_Property_Text('co_requisites',$value);
        $property->set_description('5. Co-requisites for this course (if any)');
        $this->set_property($property);
    }
    public function get_co_requisites(){

        return $this->get_property('co_requisites')->get_value();
    }
    public function set_course_component($value)
    {
        $lecture = new \Orm_Property_Text('lecture');
        $lecture->set_width(100);
        $tutorial = new \Orm_Property_Text('tutorial');
        $tutorial->set_width(100);
        $lab = new \Orm_Property_Text('lab');
        $lab->set_width(100);
        $practical = new \Orm_Property_Text('practical');
        $practical->set_width(100);
        $other = new \Orm_Property_Text('other');
        $other->set_width(150);
        $total = new \Orm_Property_Text('total');
        $total->set_width(100);

        $property = new \Orm_Property_Table('course_component', $value);
        $property->set_description('6. Course components');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('', ''));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('lecture', 'Lecture'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('tutorial', 'Tutorial'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('laboratory', 'Laboratory / Studio'));
        $property->add_cell(1, 5, new \Orm_Property_Fixedtext('practical', 'Practical'));
        $property->add_cell(1, 6, new \Orm_Property_Fixedtext('other', 'Others ( including self-study )'));
        $property->add_cell(1, 7, new \Orm_Property_Fixedtext('total', 'Total'));


        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('credit', 'Credit'));
        $property->add_cell(2, 2, $lecture);
        $property->add_cell(2, 3, $tutorial);
        $property->add_cell(2, 4, $lab);
        $property->add_cell(2, 5, $practical);
        $property->add_cell(2, 6, $other);
        $property->add_cell(2, 7, $total);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('contact_hours', 'Contact Hours/per week'));
        $property->add_cell(3, 2, $lecture);
        $property->add_cell(3, 3, $tutorial);
        $property->add_cell(3, 4, $lab);
        $property->add_cell(3, 5, $practical);
        $property->add_cell(3, 6, $other);
        $property->add_cell(3, 7, $total);


        $this->set_property($property);
    }

    public function get_course_component()
    {
        return $this->get_property('course_component')->get_value();
    }

    public function after_node_load()
    {
        parent::after_node_load();

        $course_node = $this->get_parent_course_node();
        if (!is_null($course_node) && $course_node->get_id()) {
            $course_obj = $course_node->get_item_obj();
            /* @var $course_obj \Orm_Course */


            $this->set_credit_hour($course_obj->get_credit_hour());
        }
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

    public function integration_processes() {
        parent::integration_processes();

        $course_node = $this->get_parent_course_node();

        $plans = \Orm_Program_Plan::get_all(array('course_id' => $course_node->get_item_id()));
        if (\Orm::get_ci()->config->item('integration_enabled')) {
            $pre_courses = \Orm_Data_Course_Pre::get_all(array('course_id' => $course_node->get_item_id()));
            $pre_text = array();
            foreach ($pre_courses as $pre) {
                $pre_text[] = $pre->get_program_obj()->get_name('english') . ' - ' . $pre->get_pre_course_obj()->get_name('english');
            }
            $this->set_pre_requisites(implode('/', $pre_text));
            $co_courses = \Orm_Data_Course_Pre::get_all(array('pre_course_id' => $course_node->get_item_id()));
            $co_text = array();
            foreach ($co_courses as $co) {
                $co_text[] = $co->get_program_obj()->get_name('english') . ' - ' . $co->get_course_obj()->get_name('english');
            }
            $this->set_co_requisites(implode('/', $co_text));
        }
        $credit_hours = array();
        $levels = array();
        foreach ($plans as $plan) {

            $credit_hours[] = $plan->get_program_obj()->get_code('english') . ' ('.$plan->get_credit_hours().' Hours)';
            $levels[] = $plan->get_program_obj()->get_code('english') . ' (Level '.$plan->get_level().' )';
        }
        $this->set_level_year(implode('/',$levels));
        $this->set_credit_hour(implode('/',$credit_hours));
        $this->save();
    }

}