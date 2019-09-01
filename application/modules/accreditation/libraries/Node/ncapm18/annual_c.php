<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 09/10/18
 * Time: 11:14 ص
 */

namespace Node\ncapm18;


class Annual_C extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $name = 'C. Program Learning Outcomes Assessment';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();
        $this->set_national_qualification(array());
        $this->set_analysis_program('');
        $this->set_analysis(array());


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
        $learning_domain->set_width(200);
        $nqf_property->add_property($learning_domain);

        $assessment_methods = new \Orm_Property_Textarea('assessment_methods');
        $assessment_methods->set_description('Type of assessment methods(Direct and Indirect');
        $assessment_methods->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $assessment_methods->set_width(200);
        $nqf_property->add_property($assessment_methods);

        $benchmark = new \Orm_Property_Percentage('benchmark');
        $benchmark->set_description('Target Benchmark(percentage)');
        $benchmark->set_width(100);
        $nqf_property->add_property($benchmark);

        $result = new \Orm_Property_Percentage('result');
        $result->set_description('Evaluation result* (percentage)');
        $result->set_width(100);
        $nqf_property->add_property($result);

        $property = new \Orm_Property_Table('national_qualification', $value);
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


    public function set_analysis_program($value)
    {
        $property = new \Orm_Property_Textarea('analysis_program', $value);
        $property->set_description('Comment on the Program Learning Outcome Assessment results.');
        $this->set_property($property);
    }

    public function get_analysis_program()
    {
        return $this->get_property('analysis_program')->get_value();
    }

    public function set_analysis($value){
        $property = new \Orm_Property_Add_More('analysis',$value);
        $property->set_description('2. Analysis ( list of strength, points for improvements and recommendations for Program Learning Outcomes Assessment)');

        $strength = new \Orm_Property_Textarea('strength');
        $strength->set_description('Strengths');
        $property->add_property($strength);

        $points = new \Orm_Property_Textarea('points');
        $points->set_description('Points for improvements');
        $property->add_property($points);


        $recommendation = new \Orm_Property_Textarea('recommendation');
        $recommendation->set_description('Recommendations');
        $property->add_property($recommendation);

        $this->set_property($property);


    }
    public function get_analysis(){

        return $this->get_property('analysis')->get_value();
    }

    public function header_actions(&$actions = array()) {

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
        /*NOTE: make sure that all data are inserted in CM as ncaaa 3 learning domains */
        parent::integration_processes();
        $program_node = $this->get_parent_program_node();
        if (!is_null($program_node) && $program_node->get_id()) {
            $program_obj = $program_node->get_item_obj(); /* @var $program_obj \Orm_Program */
            $department_obj = $program_obj->get_department_obj();
            $college_obj = $department_obj->get_college_obj();


            if (\Orm::get_ci()->config->item('integration_enabled')) {
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
                            'assessment_methods' => $methods,
                            'benchmark' =>  $PLO->get_target_obj()->get_target()
                        );
                    }
                    $PLOs = \Orm_Cm_Program_Learning_Outcome::get_all(array('program_id' => $program_obj->get_id(),'ncaaa_code' => 7));
                    $code = 0;
                    foreach ($PLOs as $key => $PLO) {
                        $knowledge[4][1]['national_qualifications'][] = array(
                            'code' => '2.'.(++$code),
                            'learning_outcome' => $PLO->get_text(),
                            'assessment_methods' => $methods,
                            'benchmark' =>  $PLO->get_target_obj()->get_target()
                        );
                    }

                    $PLOs = \Orm_Cm_Program_Learning_Outcome::get_all(array('program_id' => $program_obj->get_id(),'ncaaa_code' => 8));
                    $code = 0;
                    foreach ($PLOs as $key => $PLO) {
                        $knowledge[6][1]['national_qualifications'][] = array(
                            'code' => '3.'.(++$code),
                            'learning_outcome' => $PLO->get_text(),
                            'assessment_methods' => $methods,
                            'benchmark' => $PLO->get_target_obj()->get_target()
                        );
                    }

                    $this->set_national_qualification($knowledge);
                }
            }
        }
        $this->save();
    }

}