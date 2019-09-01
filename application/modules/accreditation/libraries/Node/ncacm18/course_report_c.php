<?php
/**
 * Created by PhpStorm.
 * User: dura
 * Date: 10/9/18
 * Time: 11:45 AM
 */

namespace Node\ncacm18;


class Course_Report_C extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'C. Course learning outcomes';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;


    public function init()
    {
        parent::init();

        $this->set_course_learning(array());
        $this->set_recommendations('');

    }

    public function set_course_learning($value)
    {

        $nqf_property = new \Orm_Property_Table_Dynamic('course_learning_outcomes', $value);

        $code = new \Orm_Property_Text('code');
        $code->set_description('Code #');
        $code->set_width(50);
        $nqf_property->add_property($code);

        $course = new \Orm_Property_Textarea('course');
        $course->set_description('Course learning outcomes (CLOs)');
        $course->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $course->set_width(200);
        $nqf_property->add_property($course);

        $assessment_methods = new \Orm_Property_Textarea('assessment_method');
        $assessment_methods->set_description('Methods of assessment');
        $assessment_methods->set_group('CLOs Assessment');
        $assessment_methods->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $assessment_methods->set_width(200);
        $nqf_property->add_property($assessment_methods);


        $result = new \Orm_Property_Textarea('result');
        $result->set_description('Assessment result (percentage)');
        $result->set_group('CLOs Assessment');
        $result->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $result->set_width(200);
        $nqf_property->add_property($result);

        $comment = new \Orm_Property_Textarea('comment');
        $comment->set_description('Comment on assessment results');
        $comment->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $comment->set_width(200);
        $nqf_property->add_property($comment);


        $property = new \Orm_Property_Table('course_learning', $value);
        $property->set_description( '1. Course learning outcomes assessment results.');
        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('text', '<i> 1.0 </i>', 'Knowledge'));
        $property->add_cell(2, 1, $nqf_property);
        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('text', '<i> 2.0 </i>', 'Skills'));
        $property->add_cell(4, 1, $nqf_property);
        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('text', '<i> 3.0 </i>', 'Competencies'));
        $property->add_cell(6, 1, $nqf_property);

        $this->set_property($property);
    }

    public function get_course_learning()
    {
        return $this->get_property('course_learningn')->get_value();
    }
    public function set_recommendations($value){
        $property = new \Orm_Property_Textarea('recommendations',$value);
        $property->set_description('2.Recommendations');
        $this->set_property($property);
    }

    public function get_recommendations(){

        return $this->get_property('recommendations')->get_value();
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
                    $methods = array();
                    $methods_list = '';

                    foreach (\Orm_Cm_Course_Mapping_Matrix::get_all(['course_learning_outcome_id' => $CLO->get_id()]) as $method) {
                        $method_name = $method->get_course_assessment_component_obj()->get_program_assessment_method_obj()->get_assessment_method_obj()->get_title();
                        $methods[$method_name] = $method_name;
                    }

                    foreach ($methods as $method_key => $method) {
                        $methods_list .= '<li>'.$method.'</li>';
                    }

                    $knowledge[2][1]['course_learning_outcomes'][] = array(
                        'code' => '1.'.(++$code),
                        'course' => $CLO->get_text(),
                        'assessment_method' => '<ol>'.$methods_list.'</ol>',
                    );
                }
                $CLOs = \Orm_Cm_Course_Learning_Outcome::get_all(array('course_id' => $course_node,'ncaaa_code' => 7));
                $code = 0;
                foreach ($CLOs as $key => $CLO) {
                    $methods = array();
                    $methods_list = '';

                    foreach (\Orm_Cm_Course_Mapping_Matrix::get_all(['course_learning_outcome_id' => $CLO->get_id()]) as $method) {
                        $method_name = $method->get_course_assessment_component_obj()->get_program_assessment_method_obj()->get_assessment_method_obj()->get_title();
                        $methods[$method_name] = $method_name;
                    }

                    foreach ($methods as $method_key => $method) {
                        $methods_list .= '<li>'.$method.'</li>';
                    }
                    $knowledge[4][1]['course_learning_outcomes'][] = array(
                        'code' => '2.'.(++$code),
                        'course' => $CLO->get_text(),
                        'assessment_method' => '<ol>'.$methods_list.'</ol>',
                    );
                }

                $CLOs = \Orm_Cm_Course_Learning_Outcome::get_all(array('course_id' => $course_node,'ncaaa_code' => 8));
                $code = 0;
                foreach ($CLOs as $key => $CLO) {
                    $methods = array();
                    $methods_list = '';

                    foreach (\Orm_Cm_Course_Mapping_Matrix::get_all(['course_learning_outcome_id' => $CLO->get_id()]) as $method) {
                        $method_name = $method->get_course_assessment_component_obj()->get_program_assessment_method_obj()->get_assessment_method_obj()->get_title();
                        $methods[$method_name] = $method_name;
                    }

                    foreach ($methods as $method_key => $method) {
                        $methods_list .= '<li>'.$method.'</li>';
                    }
                    $knowledge[6][1]['course_learning_outcomes'][] = array(
                        'code' => '3.'.(++$code),
                        'course' => $CLO->get_text(),
                        'assessment_method' => '<ol>'.$methods_list.'</ol>',
                    );
                }


                $this->set_course_learning($knowledge);
            }
            $this->save();
        }
    }

}