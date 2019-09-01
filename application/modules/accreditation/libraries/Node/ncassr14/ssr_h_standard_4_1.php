<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ssr_h_standard_4_1
 *
 * @author ahmadgx
 */
class Ssr_H_Standard_4_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Subsection 4.1 Student Learning Outcomes';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_rating('');
            $this->set_standard_description('');
            $this->set_note('');
            $this->set_national_qualification(array());
            $this->set_program_outcomes_discribtion('');
            $this->set_program_discribtion('');
            $this->set_process('');
            $this->set_process_list('');
            $this->set_evaluation_report('');
    }

    public function set_rating($value)
    {
        $property = new \Orm_Property_Smart_Field('rating', $value);
        $property->set_class('Node\ncassr14\Ses_Standard_4_1');
        $property->set_function('get_overall_assessment');
        $property->add_filter('system_number', $this->get_parent_program_node()->get_system_number());
        $property->add_filter('parent_lft', $this->get_parent_program_node()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_parent_program_node()->get_parent_rgt());
        $property->set_description('Overall Rating');
        $this->set_property($property);
    }

    public function get_rating()
    {
        return $this->get_property('rating')->get_value();
    }

    public function set_standard_description($value)
    {
        $property = new \Orm_Property_Textarea('standard_description', $value);
        $property->set_description('Describe the processes used for ensuring the appropriateness and adequacy of intended student learning outcomes from the program.   Include action taken to ensure consistency of the intended student learning outcomes with professional or occupational employment requirements as indicated by expert advice or requirements of professional bodies or relevant accrediting agencies with the National Qualifications Framework. (Note that evidence on the standards of student achievement of these intended learning outcomes should be considered in sub-standard 4.4 below)');
        $this->set_property($property);
    }

    public function get_standard_description()
    {
        return $this->get_property('standard_description')->get_value();
    }

    public function set_note()
    {
        $property = new \Orm_Property_Fixedtext('note', "Use the below table to <strong><i>provide all the program learning outcomes</i></strong> required for graduation with the appropriate assessment methods and teaching strategies in alignment. Use the learning outcomes in the NQF domains of learning, assessment methods, and teaching strategies identified in the Program Specifications. If there are no learning outcomes required for the psychomotor domain then omit the fifth learning domain.");
        $this->set_property($property);
    }

    public function get_note()
    {
        return $this->get_property('note')->get_value();
    }

    public function set_national_qualification($value)
    {

        $nqf_property = new \Orm_Property_Table_Dynamic('national_qualifications', $value);

        $code = new \Orm_Property_Text('code');
        $code->set_description('Code #');
        $code->set_width(50);
        $nqf_property->add_property($code);

        $learning_domain = new \Orm_Property_Textarea('learning_outcome');
        $learning_domain->set_description('Learning Outcomes');
        $learning_domain->set_enable_tinymce(0);
        $learning_domain->set_width(200);
        $nqf_property->add_property($learning_domain);

        $teaching_strategies = new \Orm_Property_Textarea('teaching_strategies');
        $teaching_strategies->set_description('Teaching Strategies');
        $teaching_strategies->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $teaching_strategies->set_width(200);
        $nqf_property->add_property($teaching_strategies);

        $assessment_methods = new \Orm_Property_Textarea('assessment_methods');
        $assessment_methods->set_description('Assessment Methods');
        $assessment_methods->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $assessment_methods->set_width(200);
        $nqf_property->add_property($assessment_methods);

        $property = new \Orm_Property_Table('national_qualification', $value);
        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('text', '<i> 1.0 </i>', 'Knowledge'));
        $property->add_cell(2, 1, $nqf_property);
        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('text', '<i> 2.0 </i>', 'Cognitive Skills'));
        $property->add_cell(4, 1, $nqf_property);
        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('text', '<i> 3.0 </i>', 'Interpersonal Skills and Responsibility'));
        $property->add_cell(6, 1, $nqf_property);
        $property->add_cell(7, 1, new \Orm_Property_Fixedtext('text', '<i> 4.0 </i>', 'Communication, Information Technology, Numerical'));
        $property->add_cell(8, 1, $nqf_property);
        $property->add_cell(9, 1, new \Orm_Property_Fixedtext('text', '<i> 5.0 </i>', 'Psychomotor'));
        $property->add_cell(10, 1, $nqf_property);

        $this->set_property($property);
    }

    public function get_national_qualification()
    {
        return $this->get_property('national_qualification')->get_value();
    }

    public function generate_ams_national_qualification(&$ams_form = array(), $ams_file = null, $class_type = null)
    {

        $national_qualification = $this->get_property('national_qualification');
        /** @var $national_qualification \Orm_Property_Table */

        $ams_table = array();
        $domain = '';

        $index = 0;
        for ($row = 1; $row <= count($national_qualification->get_cells()); $row++) {
            for ($column = 1; $column <= count($national_qualification->get_cells($row)); $column++) {
                $get_national_qualifications = $national_qualification->get_cell_property($row, $column);
                /** @var $get_national_qualifications \Orm_Property_Table_Dynamic */

                if ($get_national_qualifications instanceof \Orm_Property_Table_Dynamic) {
                    if ($get_national_qualifications->get_value()) {
                        foreach ($get_national_qualifications->get_value() as $key => $value) {

                            if ($get_national_qualifications->get_properties() && $value) {
                                foreach ($get_national_qualifications->get_properties() as $name => $property) {
                                    $property->set_value($get_national_qualifications->get_specific_value($key, $name));
                                    $property->generate_ams_property($ams_table[$index], $ams_file, $class_type);
                                }

                                $ams_table[$index][4] = array(
                                    'type' => 'simple',
                                    'field' => $national_qualification->get_ams_id($ams_file, $class_type, 'learning_domain'),
                                    'value' => $domain
                                );
                            }

                            $index++;
                        }
                    }
                } else {
                    /** @var $get_national_qualifications \Orm_Property_Fixedtext */
                    $domain = $get_national_qualifications->get_description();
                }
            }
        }

        $ams_form[] = array(
            'type' => 'table_dynamic',
            'field' => $national_qualification->get_ams_id($ams_file, $class_type),
            'value' => $ams_table
        );
    }

    public function set_program_outcomes_discribtion($value)
    {
        $property = new \Orm_Property_Textarea('program_outcomes_discribtion', $value);
        $property->set_description('Describe the general performance of the program learning outcomes; including external KPIs with benchmarks and analysis assessments from students and employer surveys and a summary of the direct assessment of student learning achievements (How well are the students learning?).');
        $this->set_property($property);
    }

    public function get_program_outcomes_discribtion()
    {
        return $this->get_property('program_outcomes_discribtion')->get_value();
    }

    public function set_program_discribtion($value)
    {
        $property = new \Orm_Property_Textarea('program_discribtion', $value);
        $property->set_description('Describe the process and steps used by the program learning outcome assessment system; including a description of the leaders, faculty, committees and responsibilities and the names of people who serve on each committee.');
        $this->set_property($property);
    }

    public function get_program_discribtion()
    {
        return $this->get_property('program_discribtion')->get_value();
    }

    public function set_process($value)
    {
        $property = new \Orm_Property_Textarea('process', $value);
        $property->set_description('Describe the results and provide an analysis for the complete assessment of all program learning outcomes (see the Annual Program Reports for the past four years)');
        $this->set_property($property);
    }

    public function get_process()
    {
        return $this->get_property('process')->get_value();
    }

    public function set_process_list($value)
    {
        $property = new \Orm_Property_Textarea('process_list', $value);
        $property->set_description('List the strengths and recommendations for improvement of the learning outcome assessment process (Based on the student performance results, how can the program improve?) (See Annual Program Reports for detailed data).');
        $this->set_property($property);
    }

    public function get_process_list()
    {
        return $this->get_property('process_list')->get_value();
    }

    public function set_evaluation_report($value)
    {
        $property = new \Orm_Property_Textarea('evaluation_report', $value);
        $property->set_description('Evaluation of intended student learning outcomes.  Refer to evidence about the appropriateness and adequacy of the intended learning outcomes for students in this program and provide a report including a list of strengths, recommendations for improvement, and priorities for action.');
        $this->set_property($property);
    }

    public function get_evaluation_report()
    {
        return $this->get_property('evaluation_report')->get_value();
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

                    $PLOs = \Orm_Cm_Program_Learning_Outcome::get_all(array('program_id' => $program_obj->get_id(),'ncaaa_code' => 1));
                    $knowledge = array();
                    $code = 0;
                    foreach ($PLOs as $key => $PLO) {
                        $knowledge[2][1]['national_qualifications'][] = array(
                            'code' => '1.'.(++$code),
                            'learning_outcome' => $PLO->get_text(),
                            'teaching_strategies' => $methods,
                            'assessment_methods' => $methods
                        );
                    }
                    $PLOs = \Orm_Cm_Program_Learning_Outcome::get_all(array('program_id' => $program_obj->get_id(),'ncaaa_code' => 2));
                    $code = 0;
                    foreach ($PLOs as $key => $PLO) {
                        $knowledge[4][1]['national_qualifications'][] = array(
                            'code' => '2.'.(++$code),
                            'learning_outcome' => $PLO->get_text(),
                            'teaching_strategies' => $methods,
                            'assessment_methods' => $methods
                        );
                    }

                    $PLOs = \Orm_Cm_Program_Learning_Outcome::get_all(array('program_id' => $program_obj->get_id(),'ncaaa_code' => 3));
                    $code = 0;
                    foreach ($PLOs as $key => $PLO) {
                        $knowledge[6][1]['national_qualifications'][] = array(
                            'code' => '3.'.(++$code),
                            'learning_outcome' => $PLO->get_text(),
                            'teaching_strategies' => $methods,
                            'assessment_methods' => $methods
                        );
                    }

                    $PLOs = \Orm_Cm_Program_Learning_Outcome::get_all(array('program_id' => $program_obj->get_id(),'ncaaa_code' => 4));
                    $code = 0;
                    foreach ($PLOs as $key => $PLO) {
                        $knowledge[8][1]['national_qualifications'][] = array(
                            'code' => '4.'.(++$code),
                            'learning_outcome' => $PLO->get_text(),
                            'teaching_strategies' => $methods,
                            'assessment_methods' => $methods
                        );
                    }

                    $PLOs = \Orm_Cm_Program_Learning_Outcome::get_all(array('program_id' => $program_obj->get_id(),'ncaaa_code' => 5));
                    $code = 0;
                    foreach ($PLOs as $key => $PLO) {
                        $knowledge[10][1]['national_qualifications'][] = array(
                            'code' => '5.'.(++$code),
                            'learning_outcome' => $PLO->get_text(),
                            'teaching_strategies' => $methods,
                            'assessment_methods' => $methods
                        );
                    }
                    $this->set_national_qualification($knowledge);
                }
            }
            $this->save();
        }
    }
}
