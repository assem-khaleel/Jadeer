<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 11/10/18
 * Time: 12:33 م
 */

namespace Node\ncapm18;


class Program_Specifications_D extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $name = 'D. Teaching, Learning and Assessment';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

        $this->set_learning_strategy('');
        $this->set_assessment_method('');

    }

    public function set_learning_strategy($value){
        $property =  new \Orm_Property_Textarea('learning_strategy',$value);
        $property->set_description('1. Teaching and learning strategies to achieve program learning outcomes (including curricular and extra-curricular activities).');
        $this->set_property($property);
    }
    public function get_learning_strategy(){
        return $this->get_property('learning_strategy')->get_value();
    }


    public function set_assessment_method($value){
        $property =  new \Orm_Property_Textarea('assessment_method',$value);
        $property->set_description('2. Assessment methods for program learning outcomes.');
        $this->set_property($property);
    }
    public function get_assessment_method(){
        return $this->get_property('assessment_method')->get_value();
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


                if (\License::get_instance()->check_module('curriculum_mapping') && \Modules::load('curriculum_mapping')) {

                    $assessment_methods = \Orm_Cm_Program_Assessment_Method::get_all(array('program_id' => $program_obj->get_id()));

                    $methods = '<ul>';
                    foreach ($assessment_methods as $method) {
                        $methods .= "<li>{$method->get_assessment_method_obj()->get_title()}</li>";
                    }
                    $methods .= '</ul>';

                    $this->set_learning_strategy($methods);
                    $this->set_assessment_method($methods);

                }

            }
        }

        $this->save();
    }

}