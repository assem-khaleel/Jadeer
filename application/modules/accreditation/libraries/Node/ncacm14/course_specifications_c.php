<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncacm14;

/**
 * Description of course_specifications_c
 *
 * @author laith
 */
class Course_Specifications_C extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'C. Course Description';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_general();
            $this->set_topic(array());
            $this->set_component(array());
            $this->set_additional_hours('');
            $this->set_note();
            $this->set_national_qualification(array());
            $this->set_course_map(array());
            $this->set_schedule(array());
    }

    public function set_general()
    {
        $property = new \Orm_Property_Fixedtext('general', 'Note: General description in the form to be used for the Bulletin handbook should be attached');
        $this->set_property($property);
    }

    public function get_general()
    {
        return $this->get_property('general')->get_value();
    }

    public function set_course_Description($value)
    {
        $property = new \Orm_Property_Textarea('course_Description', $value);
        $property->set_description('Course Description:');
        $this->set_property($property);
    }

    public function get_course_Description()
    {
        return $this->get_property('course_Description')->get_value();
    }

    public function set_topic($value)
    {
        $property = new \Orm_Property_Table_Dynamic('topic', $value);
        $property->set_description('1. Topics to be covered');

        $list_of_topic = new \Orm_Property_Textarea('list_of_topic');
        $list_of_topic->set_description('List of Topics');
        $list_of_topic->set_enable_tinymce(0);
        $list_of_topic->set_width(230);
        $property->add_property($list_of_topic);


        $no_of_weeks = new \Orm_Property_Text('no_of_weeks');
        $no_of_weeks->set_description('No. of weeks');
        $no_of_weeks->set_width(230);
        $property->add_property($no_of_weeks);

        $contact_hours = new \Orm_Property_Text('contact_hours');
        $contact_hours->set_description('Contact Hours');
        $contact_hours->set_width(100);
        $property->add_property($contact_hours);

        $this->set_property($property);
    }

    public function get_topic()
    {
        return $this->get_property('topic')->get_value();
    }

    public function set_component($value)
    {
        $contact_hour = new \Orm_Property_Text('contact_hour');
        $contact_hour->set_width(80);
        $credit = new \Orm_Property_Text('credit');
        $credit->set_width(80);

        $property = new \Orm_Property_Table('component', $value);
        $property->set_description('2. Course components (total contact hours and credits per semester):');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('column_1', ''));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('column_2', 'Lecture'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('column_3', 'Tutorial'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('column_4', 'Laboratory'));
        $property->add_cell(1, 5, new \Orm_Property_Fixedtext('column_5', 'Practical'));
        $property->add_cell(1, 6, new \Orm_Property_Fixedtext('column_6', 'Other'));
        $property->add_cell(1, 7, new \Orm_Property_Fixedtext('column_7', 'Total'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('contact_hour', 'Contact Hours'));
        $property->add_cell(2, 2, $contact_hour);
        $property->add_cell(2, 3, $contact_hour);
        $property->add_cell(2, 4, $contact_hour);
        $property->add_cell(2, 5, $contact_hour);
        $property->add_cell(2, 6, $contact_hour);
        $property->add_cell(2, 7, $contact_hour);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('credit', 'Credit'));
        $property->add_cell(3, 2, $credit);
        $property->add_cell(3, 3, $credit);
        $property->add_cell(3, 4, $credit);
        $property->add_cell(3, 5, $credit);
        $property->add_cell(3, 6, $credit);
        $property->add_cell(3, 7, $credit);

        $this->set_property($property);
    }

    public function get_component()
    {
        return $this->get_property('component')->get_value();
    }

    public function set_additional_hours($value)
    {
        $property = new \Orm_Property_Text('additional_hours', $value);
        $property->set_description('3. Additional private study/learning hours expected for students per week.');
        $this->set_property($property);
    }

    public function get_additional_hours()
    {
        return $this->get_property('additional_hours')->get_value();
    }

    public function set_note()
    {
        $property = new \Orm_Property_Fixedtext('note', ' <strong>4. Course Learning Outcomes in NQF Domains of Learning and Alignment with Assessment Methods and Teaching Strategy</strong><br/><br/>On the table below are the five NQF Learning Domains, numbered in the left column.'
            . '<br/><strong>First</strong>, insert the suitable and measurable course learning outcomes required in the appropriate learning domains (see suggestions below the table).
               <br/><strong>Second</strong>, insert supporting teaching strategies that fit and align with the assessment methods and intended learning outcomes.
               <br/><strong>Third</strong>, insert appropriate assessment methods that accurately measure and evaluate the learning outcome. Each course learning outcomes, assessment method, and teaching strategy ought to reasonably fit and flow together as an integrated learning and teaching process. (Courses are not required to include learning outcomes from each domain.)');
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
        $code->set_width(60);
        $nqf_property->add_property($code);

        $learning_domain = new \Orm_Property_Textarea('learning_outcome');
        $learning_domain->set_description('Course Learning Outcomes');
        $learning_domain->set_enable_tinymce(0);
        $learning_domain->set_width(180);
        $nqf_property->add_property($learning_domain);

        $teaching_strategies = new \Orm_Property_Textarea('teaching_strategies');
        $teaching_strategies->set_description('Course Teaching Strategies');
        $teaching_strategies->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $teaching_strategies->set_width(180);
        $nqf_property->add_property($teaching_strategies);

        $assessment_methods = new \Orm_Property_Textarea('assessment_methods');
        $assessment_methods->set_description('Course Assessment Methods');
        $assessment_methods->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $assessment_methods->set_width(180);
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


    /*
     * course_map
     */
    public function set_course_map($value)
    {
        $course_lo = new \Orm_Property_Text('course_lo');
        $course_lo->set_description('Course LO Code #');

        $program_los = array();
//        if ($this->get_id()) {
//            $active_program_node = \Orm_Node::get_active_program_node();
//            if ($active_program_node->get_id()) {
//                $parent_program_node = $this->get_parent_program_node();
//                if ($parent_program_node->get_id()) {
//                    $program_node = \Orm_Node::get_one(array('system_number' => $active_program_node->get_system_number(), 'class_type' => \Orm_Node::PROGRAM_PROGRAM, 'item_id' => $parent_program_node->get_item_id()));
//                    if ($program_node->get_id()) {
//                        $class_type = str_replace('Program', 'Program_Specifications_D', \Orm_Node::PROGRAM_PROGRAM);
//                        $program_specifications_d_node = \Orm_Node::get_one(array('parent_lft' => $program_node->get_parent_lft(), 'parent_rgt' => $program_node->get_parent_rgt(), 'class_type' => $class_type));
//                        if ($program_specifications_d_node->get_id()) {
//                            $national_qualification = $program_specifications_d_node->get_national_qualification();
//                            if (!empty($national_qualification) && is_array($national_qualification)) {
//                                foreach ($national_qualification as $domains) {
//                                    if (!empty($domains) && is_array($domains)) {
//                                        foreach ($domains as $domain) {
//                                            if (!empty($domain['nqf_property']) && is_array($domain['nqf_property'])) {
//                                                foreach ($domain['nqf_property'] as $property) {
//                                                    if (!empty($property['code'])) {
//                                                        $program_lo = strtoupper(str_replace(' ', '_', trim($property['code'])));
//                                                        $program_los[$program_lo] = $property['code'];
//                                                    }
//                                                }
//                                            }
//                                        }
//                                    }
//                                }
//                            }
//                        }
//                    }
//                }
//            }
//        }

        if ($program_los) {
            $program_lo = new \Orm_Property_Select('program_lo');
            $program_lo->set_options($program_los);
        } else {
            $program_lo = new \Orm_Property_Text('program_lo');
        }
        $program_lo->set_description('Program LO Code #');

        $program_map = new \Orm_Property_Table_Dynamic('program_map');
        $program_map->set_description('Program LOs');
        $program_map->add_property($program_lo);

        $course_map = new \Orm_Property_Table_Dynamic('course_map', $value);
        $course_map->set_description('5. Map course LOs with the program LOs. (Use Program LO Code # provided in the  Program Specifications)');
        $course_map->add_property($course_lo);
        $course_map->add_property($program_map);

        $this->set_property($course_map);
    }

    public function get_course_map()
    {
        return $this->get_property('course_map')->get_value();
    }

    public function generate_ams_course_map(&$ams_form = array(), $ams_file = null, $class_type = null)
    {

        $course_map = $this->get_property('course_map');

        $ams_table = array();
        $index = 0;
        if ($course_map->get_value()) {
            foreach ($course_map->get_value() as $key_clo => $value_clo) {
                if ($course_map->get_properties() && $value_clo) {
                    $tmp_clo = array();
                    foreach ($course_map->get_properties() as $name_clo => $property_clo) {
                        $property_clo->set_value($course_map->get_specific_value($key_clo, $name_clo));

                        if ($property_clo instanceof \Orm_Property_Table_Dynamic) {
                            foreach ($property_clo->get_value() as $key_plo => $value_plo) {
                                if ($property_clo->get_properties() && $value_plo) {
                                    foreach ($property_clo->get_properties() as $name_plo => $property_plo) {
                                        $ams_table[$index] = $tmp_clo;

                                        $property_plo->set_value($property_clo->get_specific_value($key_plo, $name_plo));
                                        $property_plo->generate_ams_property($ams_table[$index], $ams_file, $class_type);
                                    }
                                }

                                $index++;
                            }
                        } else {
                            $property_clo->generate_ams_property($tmp_clo, $ams_file, $class_type);
                        }
                    }
                }
            }
        }

        $ams_form[] = array(
            'type' => 'table_dynamic',
            'field' => $course_map->get_ams_id($ams_file, $class_type),
            'value' => $ams_table
        );
    }

    public function draw_report_course_map($pdf = false)
    {
        $property = $this->get_property('course_map');

        $html = '<div class="form-group">';

        $html .= '<label class="control-label" for="property_schedule">' . $property->get_description() . '</label>';

        if (is_array($property->get_value())) {

            $maps = array();
            $course_los = array();
            $program_los = array();
            foreach ($property->get_value() as $course_map) {
                $course_lo = strtoupper(str_replace(' ', '_', trim($course_map['course_lo'])));
                if ($course_lo) {
                    $course_los[$course_lo] = $course_map['course_lo'];
                }

                foreach ($course_map['program_map'] as $program_map) {
                    $program_lo = strtoupper(str_replace(' ', '_', trim($program_map['program_lo'])));
                    if ($program_lo) {
                        $program_los[$program_lo] = $program_map['program_lo'];
                    }

                    if ($course_lo && $program_lo) {
                        $maps[$course_lo][$program_lo] = true;
                    }
                }
            }


            if ($maps) {
                $html .= '<div class="table-primary table-responsive">';
                $html .= '<table class="table table-striped table-bordered">';
                $html .= '<tbody>';

                $html .= '<tr>';
                $html .= '<td rowspan="2">';
                $html .= '<div class="form-group">';
                $html .= '<strong>Course LOs #</strong>';
                $html .= '</div>';
                $html .= '</td>';
                $html .= '<td colspan="' . count($program_los) . '">';
                $html .= '<div class="form-group">';
                $html .= '<strong>Program Learning Outcomes <br>(Use Program LO Code # provided in the  Program Specifications)</strong>';
                $html .= '</div>';
                $html .= '</td>';
                $html .= '</tr>';

                $html .= '<tr>';
                foreach ($program_los as $program_lo) {
                    $html .= '<td>';
                    $html .= '<div class="form-group">' . $program_lo . '</div>';
                    $html .= '</td>';
                }
                $html .= '</tr>';

                foreach ($course_los as $course_key => $course_lo) {
                    $html .= '<tr>';
                    $html .= '<td>';
                    $html .= '<div class="form-group">' . $course_lo . '</div>';
                    $html .= '</td>';
                    foreach ($program_los as $program_key => $program_lo) {
                        $html .= '<td>';
                        if (isset($maps[$course_key][$program_key])) {
                            $html .= '*';
                        }
                        $html .= '</td>';
                    }
                    $html .= '</tr>';
                }

                $html .= '</tbody>';
                $html .= '</table>';
                $html .= '</div>';
            } else {
                $html .= '<div class="label label-danger">';
                $html .= 'There is No Learning Outcomes Map';
                $html .= '</div>';
            }
        } else {
            $html .= '<div class="label label-danger">';
            $html .= 'There is No Learning Outcomes Map';
            $html .= '</div>';
        }

        $html .= '</div>';

        return $html;
    }

    public function set_schedule($value)
    {
        $property = new \Orm_Property_Table_Dynamic('schedule', $value);
        $property->set_description('6. Schedule of Assessment Tasks for Students During the Semester');

        $assessment_task = new \Orm_Property_Text('assessment_task');
        $assessment_task->set_description('Assessment task (e.g. essay, test, group project, examination, speech, oral presentation, etc.)');
        $assessment_task->set_width(200);
        $property->add_property($assessment_task);

        $week_due = new \Orm_Property_Text('week_due');
        $week_due->set_description('Week Due');
        $week_due->set_width(200);

        $property->add_property($week_due);

        $total = new \Orm_Property_Text('total');
        $total->set_description('Proportion of Total Assessment');
        $total->set_width(200);
        $property->add_property($total);

        $this->set_property($property);
    }

    public function get_schedule()
    {
        return $this->get_property('schedule')->get_value();
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
                $assessment_schedule = $this->get_schedule();
                foreach (\Orm_Cm_Course_Assessment_Method::get_all(array('course_id' => $course_node)) as $key => $method) {
                    $assessment_schedule[$key] = array(
                        'assessment_task' => $method->get_text(true),
                        'week_due' => isset($assessment_schedule[$key]['week_due']) ? $assessment_schedule[$key]['week_due'] : '',
                        'total' => isset($assessment_schedule[$key]['total']) ? $assessment_schedule[$key]['total'] : ''
                    );
                }
                $this->set_schedule($assessment_schedule);

                $CLOs = \Orm_Cm_Course_Learning_Outcome::get_all(array('course_id' => $course_node,'ncaaa_code' => 1));
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
                        $method_name = $method->get_course_assessment_component_obj()->get_program_assessment_method_obj()->get_assessment_method_obj()->get_title();
                        $methods[$method_name] = $method_name;
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
                        $method_name = $method->get_course_assessment_component_obj()->get_program_assessment_method_obj()->get_assessment_method_obj()->get_title();
                        $methods[$method_name] = $method_name;
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
                        $method_name = $method->get_course_assessment_component_obj()->get_program_assessment_method_obj()->get_assessment_method_obj()->get_title();
                        $methods[$method_name] = $method_name;
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
                        $method_name = $method->get_course_assessment_component_obj()->get_program_assessment_method_obj()->get_assessment_method_obj()->get_title();
                        $methods[$method_name] = $method_name;
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
                $this->set_course_map($outcomes);

            }
            $this->save();
        }
    }

}
