<?php
/**
 * Created by PhpStorm.
 * User: dura
 * Date: 10/9/18
 * Time: 9:17 AM
 */

namespace Node\ncacm18;


class Course_Report_A extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $name = 'A. Course Identification';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;


    public function init()
    {
        parent::init();
        $this->set_name_of_course('');
        $this->set_location('');
        $this->set_number_of_students();
        $this->set_starting_the_course('');
        $this->set_completing_the_course('');
        $this->set_course_components(array());


    }
    public function set_name_of_course($value){
        $property = new \Orm_Property_Text('name_of_course',$value);
        $property->set_description('1. Name of course instructor(s)');
        $this->set_property($property);
    }
    public function get_name_of_course(){

        return $this->get_property('name_of_course')->get_value();
    }
    public function set_location($value){
        $property = new \Orm_Property_Text('location',$value);
        $property->set_description('2. Location');
        $this->set_property($property);
    }
    public function get_location(){

        return $this->get_property('location')->get_value();
    }
    public function set_number_of_students(){
        $property = new \Orm_Property_Fixedtext('number_of_students','3. Number of students');
        $property->set_group('students');
        $this->set_property($property);
    }
    public function get_course_type(){
        return $this->get_property('number_of_students')->get_value();

    }

    public function set_starting_the_course($value){
        $property = new \Orm_Property_Text('starting_the_course',$value);
        $property->set_description('a. Starting the course');
        $property->set_group('students');
        $this->set_property($property);
    }
    public function get_starting_the_course(){
        return $this->get_property('starting_the_course')->get_value();

    }
    public function set_completing_the_course($value){
        $property = new \Orm_Property_Text('completing_the_course',$value);
        $property->set_description('b. Completing the course');
        $property->set_group('students');
        $this->set_property($property);
    }
    public function get_completing_the_course(){
        return $this->get_property('completing_the_course')->get_value();

    }
    public function set_course_components($value)
    {
        $credit = new \Orm_Property_Text('credit');

        $planned = new \Orm_Property_Text('planned');

        $actual = new \Orm_Property_Text('actual');


        $property = new \Orm_Property_Table('course_components', $value);
        $property->set_description('4. Course components (actual total contact and credits hours per semester)');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('', ''),0,2);
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('lecture', 'Lecture'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('tutorial', 'Tutorial'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('laboratory_studio', 'Laboratory/Studio'));
        $property->add_cell(1, 5, new \Orm_Property_Fixedtext('practical', 'Practical'));
        $property->add_cell(1, 6, new \Orm_Property_Fixedtext('others', 'Others ( including self-study )'));
        $property->add_cell(1, 7, new \Orm_Property_Fixedtext('total', 'Total'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('credit', 'Credit'),0,2);
        $property->add_cell(2, 2, $credit);
        $property->add_cell(2, 3, $credit);
        $property->add_cell(2, 4, $credit);
        $property->add_cell(2, 5, $credit);
        $property->add_cell(2, 6, $credit);
        $property->add_cell(2, 7, $credit);


        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('contact', 'Contact Hours / per week'),2,1);
        $property->add_cell(3, 2, new \Orm_Property_Fixedtext('planed', 'Planed'));
        $property->add_cell(3, 3, $planned);
        $property->add_cell(3, 4, $planned);
        $property->add_cell(3, 5, $planned);
        $property->add_cell(3, 6, $planned);
        $property->add_cell(3, 7, $planned);
        $property->add_cell(3, 8, $planned);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('actual', 'Actual'));
        $property->add_cell(4, 2, $actual);
        $property->add_cell(4, 3, $actual);
        $property->add_cell(4, 4, $actual);
        $property->add_cell(4, 5, $actual);
        $property->add_cell(4, 6, $actual);
        $property->add_cell(4, 7, $actual);

        $this->set_property($property);
    }

    public function get_course_components()
    {
        return $this->get_property('course_components')->get_value();
    }
    public function after_node_load()
    {
        parent::after_node_load();

    }

    public function header_actions(&$actions = array())
    {
        if ($this->check_if_editable()) {
            $actions[] = array(
                'class' => 'btn',
                'title' => '<i class="fa fa-database"></i> ' . lang('Integration'),
                'extra' => 'onclick="integration(this, ' . $this->get_id() . ');" ' . data_loading_text(true) . ' title="Extraction of data from other modules"'
            );
        }

        return parent::header_actions($actions);
    }

    public function integration_processes() {
        parent::integration_processes();

        $course_node = $this->get_parent_course_node();
        if (!is_null($course_node) && $course_node->get_id()) {
            /** @var \Orm_Course $course */

        }

        $course_section_node = $this->get_parent_course_section_node();

        if ($course_section_node->get_item_id()) {

            $instructors = \Orm_Course_Section_Teacher::get_all(array('section_id' => $course_section_node->get_item_id()));
            $instructors_text = array();
            foreach ($instructors as $instructor) {
                $instructors_text[] = $instructor->get_user_obj()->get_full_name();
            }
            $this->set_name_of_course(implode('-',$instructors_text));

            $course_students = \Orm_Data_Course_Students::get_sum(array('section_id' => $course_section_node->get_item_id()));
            $this->set_starting_the_course($course_students['starting']);
            $this->set_completing_the_course($course_students['completing']);

        } else {
            $sections = \Orm_Course_Section::get_all(array('course_id' => $course_node->get_item_id()));
            $sections_text = array();
            $instructors_text = array();
            foreach ($sections as $section) {
                $sections_text[] = $section->get_section_no();

                $instructors = \Orm_Course_Section_Teacher::get_all(array('section_id' => $section->get_id()));
                foreach ($instructors as $instructor) {
                    $instructors_text[] = $instructor->get_user_obj()->get_full_name();
                }
            }

            $this->set_name_of_course(implode('-',$instructors_text));

            $course_students = \Orm_Data_Course_Students::get_sum(array('section_id' => $course_section_node->get_item_id()));
            $this->set_starting_the_course($course_students['starting']);
            $this->set_completing_the_course($course_students['completing']);

        }

        $this->save();
    }
}