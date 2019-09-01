<?php
/**
 * Created by PhpStorm.
 * User: dura
 * Date: 10/8/18
 * Time: 11:09 AM
 */
namespace Node\ncacm18;


class Course_Specifications_B extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'B. Course Objectives and Learning Outcomes';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;


    public function init()
    {
        parent::init();
        $this->set_course_description('');
        $this->set_course_objectives('');
        $this->set_course_learning_outcomes(array());
        $this->set_note();

    }

    public function set_course_description($value){
        $property = new \Orm_Property_Textarea('course_description',$value);
        $property->set_description('1. Course description (General description in the form used in bulletin or handbook)');
        $this->set_property($property);
    }
    public function get_course_description(){

        return $this->get_property('course_description')->get_value();
    }
    public function set_course_objectives($value){
        $property = new \Orm_Property_Textarea('course_objectives',$value);
        $property->set_description('2. Course objectives :The main objectives of the course');
        $this->set_property($property);
    }
    public function get_course_objectives(){

        return $this->get_property('course_objectives')->get_value();
    }

    public function set_course_learning_outcomes($value)
    {

        $nqf_property = new \Orm_Property_Table_Dynamic('course_learning_outcome', $value);

        $code = new \Orm_Property_Text('code');
        $code->set_description('Code #');
        $code->set_width(50);
        $nqf_property->add_property($code);

        $learning_domain = new \Orm_Property_Textarea('clos');
        $learning_domain->set_description('CLOs');
        $learning_domain->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $learning_domain->set_width(200);
        $nqf_property->add_property($learning_domain);


        $assessment_methods = new \Orm_Property_Textarea('assessment_method');
        $assessment_methods->set_description('PLO’s code');
        $assessment_methods->set_group('Allied Program Learning Outcomes (PLO’s)');
        $assessment_methods->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $assessment_methods->set_width(200);
        $nqf_property->add_property($assessment_methods);


        $level = new \Orm_Property_Textarea('level');
        $level->set_description('level of instruction*');
        $level->set_group('Allied Program Learning Outcomes (PLO’s)');
        $level->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $level->set_width(200);
        $nqf_property->add_property($level);


        $property = new \Orm_Property_Table('course_learning_outcomes', $value);
        $property->set_description('3. Course Learning Outcomes');
        $property->set_is_responsive(true);
        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('text', '<i> 1.0 </i>', 'Knowledge'));
        $property->add_cell(2, 1, $nqf_property);
        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('text', '<i> 2.0 </i>', 'Skills'));
        $property->add_cell(4, 1, $nqf_property);
        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('text', '<i> 3.0 </i>', 'Competencies'));
        $property->add_cell(6, 1, $nqf_property);

        $this->set_property($property);
    }

    public function get_course_learning_outcomes()
    {
        return $this->get_property('course_learning_outcomes')->get_value();
    }

    public function set_note(){

        $property = new \Orm_Property_Fixedtext('note','*level of instruction ( I = Introduced, P = Practiced, M= Mastery, and A = Assessed ).');
        $this->set_property($property);

    }

    public function get_note(){
        return $this->get_property('note')->get_value();
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

        if (\Orm::get_ci()->config->item('integration_enabled')) {

            $course_node = $this->get_parent_course_node()->get_item_id();

            if (\License::get_instance()->check_module('curriculum_mapping') && \Modules::load('curriculum_mapping')) {


                $CLOs = \Orm_Cm_Course_Learning_Outcome::get_all(array('course_id' => $course_node,'ncaaa_code' => 6));
                $code = 0;
                $knowledge = array();
                foreach ($CLOs as $key => $CLO) {

                    $knowledge[2][1]['course_learning_outcome'][] = array(
                        'code' => '1.'.(++$code),
                        'clos' => $CLO->get_text(),
                    );
                }
                $CLOs = \Orm_Cm_Course_Learning_Outcome::get_all(array('course_id' => $course_node,'ncaaa_code' => 7));
                $code = 0;
                foreach ($CLOs as $key => $CLO) {
                    $knowledge[4][1]['course_learning_outcome'][] = array(
                        'code' => '2.'.(++$code),
                        'clos' => $CLO->get_text(),
                    );
                }

                $CLOs = \Orm_Cm_Course_Learning_Outcome::get_all(array('course_id' => $course_node,'ncaaa_code' => 8));
                $code = 0;
                foreach ($CLOs as $key => $CLO) {

                    $knowledge[6][1]['course_learning_outcome'][] = array(
                        'code' => '3.'.(++$code),
                        'clos' => $CLO->get_text(),
                    );
                }

                $this->set_course_learning_outcomes($knowledge);

            }
            $this->save();
        }
    }

}