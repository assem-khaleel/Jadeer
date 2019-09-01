<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 11/10/18
 * Time: 12:33 م
 */

namespace Node\ncapm18;


class Program_Specifications_C extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $name = 'C. Mission, Objectives, and Outcomes';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

        $this->set_mission('');
        $this->set_objectives('');
        $this->set_graduation_attributes(array());
        $this->set_national_qualification(array());

    }

    public function set_mission($value){
        $property =  new \Orm_Property_Textarea('mission',$value);
        $property->set_description('1.Program Mission');
        $this->set_property($property);
    }
    public function get_mission(){
        return $this->get_property('mission')->get_value();
    }


    public function set_objectives($value){
        $property =  new \Orm_Property_Textarea('objectives',$value);
        $property->set_description('2.Program Objectives');
        $this->set_property($property);
    }
    public function get_objectives(){
        return $this->get_property('objectives')->get_value();
    }

    public function set_graduation_attributes($value){
        $property =  new \Orm_Property_Add_More('graduation_attributes',$value);
        $property->set_description("3.Graduates' Attribute");

        $attribute = new \Orm_Property_Text('attribute');
        $property->add_property($attribute);

        $this->set_property($property);
    }
    public function get_graduation_attributes(){
        return $this->get_property('graduation_attributes')->get_value();
    }

    public function set_national_qualification($value)
    {

        $nqf_property = new \Orm_Property_Table_Dynamic('national_qualifications', $value);

        $code = new \Orm_Property_Text('code');
        $code->set_description('Code #');
        $code->set_width(50);
        $nqf_property->add_property($code);

        $learning_domain = new \Orm_Property_Textarea('learning_outcome');
        $learning_domain->set_description('Program Learning Outcomes');
        $learning_domain->set_enable_tinymce(0);
        $nqf_property->add_property($learning_domain);


        $property = new \Orm_Property_Table('national_qualification', $value);
        $property->set_description('4.Program Learning Outcomes, including graduates’ attributes after casting them properly in the form of learning outcomes (i.e., measurable and/or observable)*');
        $property->set_is_responsive(1);
        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('text', '<i> 1.0 </i>', 'Knowledge'));
        $property->add_cell(2, 1, $nqf_property);
        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('text', '<i> 2.0 </i>', 'Skills'));
        $property->add_cell(4, 1, $nqf_property);
        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('text', '<i> 3.0 </i>', 'Competencies'));
        $property->add_cell(6, 1, $nqf_property);

        $this->set_property($property);
    }

    public function get_national_qualification()
    {
        return $this->get_property('national_qualification')->get_value();
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


                $this->set_mission($program_obj->get_mission('english'));

                $objectives = '';
                foreach($program_obj->get_objectives() as $objective) {
                    $objectives .= '<li>'.$objective->get_title('english').'</li>';
                }
                if($objectives) {
                    $this->set_objectives('<ul>'.$objectives.'</ul>');
                }

                if (\License::get_instance()->check_module('curriculum_mapping') && \Modules::load('curriculum_mapping')) {

                    $assessment_methods = \Orm_Cm_Program_Assessment_Method::get_all(array('program_id' => $program_obj->get_id()));

                    $methods = '<ul>';
                    foreach ($assessment_methods as $method) {
                        $methods .= "<li>{$method->get_assessment_method_obj()->get_title()}</li>";
                    }
                    $methods .= '</ul>';

                    $PLOs = \Orm_Cm_Program_Learning_Outcome::get_all(array('program_id' => $program_obj->get_id(),'ncaaa_code' => 6));
                    $knowledge = array();
                    $code = 0;
                    foreach ($PLOs as $key => $PLO) {
                        $knowledge[2][1]['national_qualifications'][] = array(
                            'code' => '1.'.(++$code),
                            'learning_outcome' => $PLO->get_text(),
                        );
                    }
                    $PLOs = \Orm_Cm_Program_Learning_Outcome::get_all(array('program_id' => $program_obj->get_id(),'ncaaa_code' => 7));
                    $code = 0;
                    foreach ($PLOs as $key => $PLO) {
                        $knowledge[4][1]['national_qualifications'][] = array(
                            'code' => '2.'.(++$code),
                            'learning_outcome' => $PLO->get_text(),
                        );
                    }

                    $PLOs = \Orm_Cm_Program_Learning_Outcome::get_all(array('program_id' => $program_obj->get_id(),'ncaaa_code' => 8));
                    $code = 0;
                    foreach ($PLOs as $key => $PLO) {
                        $knowledge[6][1]['national_qualifications'][] = array(
                            'code' => '3.'.(++$code),
                            'learning_outcome' => $PLO->get_text(),
                        );
                    }

                    $this->set_national_qualification($knowledge);
                }

            }
        }

        $this->save();
    }

}