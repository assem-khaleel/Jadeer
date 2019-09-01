<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncacm14;

/**
 * Description of field_experience_specification_b
 *
 * @author laith
 */
class Field_Experience_Specification_B extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'B. Learning Outcomes';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_note();
            $this->set_national_qualification(array());
    }

    public function set_note()
    {
        $property = new \Orm_Property_Fixedtext('note', ' <br/><strong>1. Learning Outcomes for Field Experience in Domains of Learning, Assessment Methods and Teaching Strategy</strong> <br/> <br/>'
            . 'Program Learning Outcomes, Assessment Methods, and Teaching Strategy work together and are aligned. They are joined together as one, coherent, unity that collectively articulate a consistent agreement between student learning and teaching. <br/> <br/>'
            . 'The <strong><i>National Qualification Framework</i></strong> provides five learning domains. Learning outcomes are required in the first four domains and sometimes are also required in the Psychomotor Domain. <br/>'
            . 'On the table below are the five NQF Learning Domains, numbered in the left column. <br/>'
            . '<strong>First</strong>, insert the suitable and measurable learning outcomes required in each of the learning domains (see suggestions below the table).'
            . '<strong>Second</strong>, insert supporting teaching strategies that fit and align with the assessment methods and intended learning outcomes.'
            . '<strong>Third</strong>, insert appropriate assessment methods that accurately measure and evaluate the learning outcome. Each program learning outcomes, assessment method, and teaching strategy ought to reasonably fit and flow together as an integrated learning and teaching process.');
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
        $learning_domain->set_description('Course Learning Outcomes');
        $learning_domain->set_enable_tinymce(0);
        $learning_domain->set_width(200);
        $nqf_property->add_property($learning_domain);

        $teaching_strategies = new \Orm_Property_Textarea('teaching_strategies');
        $teaching_strategies->set_description('Course Teaching Strategies');
        $teaching_strategies->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $teaching_strategies->set_width(200);
        $nqf_property->add_property($teaching_strategies);

        $assessment_methods = new \Orm_Property_Textarea('assessment_methods');
        $assessment_methods->set_description('Course Assessment Methods');
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
                $assessment_schedule = [];
                foreach (\Orm_Cm_Course_Assessment_Method::get_all(array('course_id' => $course_node)) as $key => $method) {
                    $assessment_schedule[$key] = array(
                        'assessment_task' => $method->get_text(true),
                        'week_due' => isset($assessment_schedule[$key]['week_due']) ? $assessment_schedule[$key]['week_due'] : '',
                        'total' => isset($assessment_schedule[$key]['total']) ? $assessment_schedule[$key]['total'] : ''
                    );
                }

                $CLOs = \Orm_Cm_Course_Learning_Outcome::get_all(array('course_id' => $course_node,'ncaaa_code' => 1));
                $code = 0;
                $knowledge = array();
                foreach ($CLOs as $key => $CLO) {
                    $methods = array();
                    $methods_list = '';

                    foreach (\Orm_Cm_Course_Mapping_Matrix::get_all(['course_learning_outcome_id' => $CLO->get_id()]) as $method) {
                        $methods[$method->get_id()] = $method->get_course_assessment_component_obj()->get_program_assessment_method_obj()->get_assessment_method_obj()->get_title();
                    }

                    foreach ($methods as $method_key => $method) {
                        $methods_list .= '<li>'.$method.'</li>';
                    }
                    $knowledge[2][1]['national_qualifications'][] = array(
                        'code' => '1.'.(++$code),
                        'learning_outcome' => $CLO->get_text(),
                        'teaching_strategies' => '<ol>'.$methods_list.'</ol>',
                        'assessment_methods' => '<ol>'.$methods_list.'</ol>'
                    );
                }
                $CLOs = \Orm_Cm_Course_Learning_Outcome::get_all(array('course_id' => $course_node,'ncaaa_code' => 2));
                $code = 0;
                foreach ($CLOs as $key => $CLO) {
                    $methods = array();
                    $methods_list = '';

                    foreach (\Orm_Cm_Course_Mapping_Matrix::get_all(['course_learning_outcome_id' => $CLO->get_id()]) as $method) {
                        $methods[$method->get_id()] = $method->get_course_assessment_component_obj()->get_program_assessment_method_obj()->get_assessment_method_obj()->get_title();
                    }

                    foreach ($methods as $method_key => $method) {
                        $methods_list .= '<li>'.$method.'</li>';
                    }
                    $knowledge[4][1]['national_qualifications'][] = array(
                        'code' => '2.'.(++$code),
                        'learning_outcome' => $CLO->get_text(),
                        'teaching_strategies' => '<ol>'.$methods_list.'</ol>',
                        'assessment_methods' => '<ol>'.$methods_list.'</ol>'
                    );
                }

                $CLOs = \Orm_Cm_Course_Learning_Outcome::get_all(array('course_id' => $course_node,'ncaaa_code' => 3));
                $code = 0;
                foreach ($CLOs as $key => $CLO) {
                    $methods = array();
                    $methods_list = '';

                    foreach (\Orm_Cm_Course_Mapping_Matrix::get_all(['course_learning_outcome_id' => $CLO->get_id()]) as $method) {
                        $methods[$method->get_id()] = $method->get_course_assessment_component_obj()->get_program_assessment_method_obj()->get_assessment_method_obj()->get_title();
                    }

                    foreach ($methods as $method_key => $method) {
                        $methods_list .= '<li>'.$method.'</li>';
                    }
                    $knowledge[6][1]['national_qualifications'][] = array(
                        'code' => '3.'.(++$code),
                        'learning_outcome' => $CLO->get_text(),
                        'teaching_strategies' => '<ol>'.$methods_list.'</ol>',
                        'assessment_methods' => '<ol>'.$methods_list.'</ol>'
                    );
                }

                $CLOs = \Orm_Cm_Course_Learning_Outcome::get_all(array('course_id' => $course_node,'ncaaa_code' => 4));
                $code = 0;
                foreach ($CLOs as $key => $CLO) {
                    $methods = array();
                    $methods_list = '';

                    foreach (\Orm_Cm_Course_Mapping_Matrix::get_all(['course_learning_outcome_id' => $CLO->get_id()]) as $method) {
                        $methods[$method->get_id()] = $method->get_course_assessment_component_obj()->get_program_assessment_method_obj()->get_assessment_method_obj()->get_title();
                    }

                    foreach ($methods as $method_key => $method) {
                        $methods_list .= '<li>'.$method.'</li>';
                    }
                    $knowledge[8][1]['national_qualifications'][] = array(
                        'code' => '4.'.(++$code),
                        'learning_outcome' => $CLO->get_text(),
                        'teaching_strategies' => '<ol>'.$methods_list.'</ol>',
                        'assessment_methods' => '<ol>'.$methods_list.'</ol>'
                    );
                }

                $CLOs = \Orm_Cm_Course_Learning_Outcome::get_all(array('course_id' => $course_node,'ncaaa_code' => 5));
                $code = 0;
                foreach ($CLOs as $key => $CLO) {
                    $methods = array();
                    $methods_list = '';

                    foreach (\Orm_Cm_Course_Mapping_Matrix::get_all(['course_learning_outcome_id' => $CLO->get_id()]) as $method) {
                        $methods[$method->get_id()] = $method->get_course_assessment_component_obj()->get_program_assessment_method_obj()->get_assessment_method_obj()->get_title();
                    }

                    foreach ($methods as $method_key => $method) {
                        $methods_list .= '<li>'.$method.'</li>';
                    }
                    $knowledge[10][1]['national_qualifications'][] = array(
                        'code' => '5.'.(++$code),
                        'learning_outcome' => $CLO->get_text(),
                        'teaching_strategies' => '<ol>'.$methods_list.'</ol>',
                        'assessment_methods' => '<ol>'.$methods_list.'</ol>'
                    );
                }
                $this->set_national_qualification($knowledge);

                $outcomes = array();
                foreach (\Orm_Cm_Course_Learning_Outcome::get_all(array('course_id' => $course_node)) as $outcome) {
                    $outcomes[] = array(
                        'course_lo' => $outcome->get_text(),
                        'program_map' => array(
                            array(
                                'program_lo' => $outcome->get_program_learning_outcome_obj()->get_text()
                            )
                        )
                    );
                }
            }
            $this->save();
        }
    }

}
