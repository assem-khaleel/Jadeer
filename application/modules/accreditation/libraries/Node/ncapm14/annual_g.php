<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncapm14;

/**
 * Description of Annual_G
 *
 * @author user
 */
class Annual_G extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'G. Program Course Evaluation';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_list_courses(array());
            $this->set_attach_list('');
            $this->set_list_items('');
            /* levels */
            $this->set_curriculum_study_plan_levels(array());
            $this->set_nqf_table();
            $this->set_national_qualification(array());
            $this->set_analysis_program('');
            $this->set_info3_2();
            $this->set_kpi_table(array());
            $this->set_info_orientation();
            $this->set_orientation_program('');
            $this->set_offered('');
            $this->set_brief_description('');
            $this->set_list_recommendations('');
            $this->set_if_orientation('');
            $this->set_professional_development(array());
            $this->set_summary_analysis('');
    }

    public function set_list_courses($value)
    {

        $property = new \Orm_Property_Table_Dynamic('list_courses', $value);
        $property->set_description('1. List all program courses taught during the year. Indicate for each course whether student evaluations were undertaken and/or other evaluations made of quality of teaching. For each course indicate if action is planned to improve teaching.');

        $course_title_1 = new \Orm_Property_Text('course_title_1');
        $course_title_1->set_description('Course Title');
        $course_title_1->set_width(200);
        $property->add_property($course_title_1);

        $course_code_1 = new \Orm_Property_Text('course_code_1');
        $course_code_1->set_description('Course Code');
        $course_code_1->set_width(200);
        $property->add_property($course_code_1);

        $student_evaluations = new \Orm_Property_Radio('student_evaluations');
        $student_evaluations->set_options(array('Yes', 'No'));
        $student_evaluations->set_description('Student Evaluations');
        $student_evaluations->set_width(100);
        $property->add_property($student_evaluations);

        $other_evaluation = new \Orm_Property_Textarea('other_evaluation');
        $other_evaluation->set_description('Other Evaluation (specify)');
        $other_evaluation->set_enable_tinymce(0);
        $other_evaluation->set_width(200);
        $property->add_property($other_evaluation);

        $action_planned = new \Orm_Property_Radio('action_planned');
        $action_planned->set_options(array('Yes', 'No'));
        $action_planned->set_description('Action Planned');
        $action_planned->set_width(100);
        $property->add_property($action_planned);

        $this->set_property($property);
    }

    public function get_list_courses()
    {
        return $this->get_property('list_courses')->get_value();
    }

    public function set_attach_list($value)
    {
        $property = new \Orm_Property_Upload('attach_list', $value);
        $property->set_description('attach list if necessary');
        $this->set_property($property);
    }

    public function get_attach_list()
    {
        return $this->get_property('attach_list')->get_value();
    }

    public function set_list_items()
    {
        $property = new \Orm_Property_Fixedtext('list_items', '<strong>List courses taught by this program this year and for this program that are in other programs.</strong>');
        $this->set_property($property);
    }

    public function get_list_items()
    {
        return $this->get_property('list_items')->get_value();
    }

    public function set_curriculum_study_plan_levels($value)
    {

        $property_add_more = new \Orm_Property_Add_More('curriculum_study_plan_levels', $value);

        $level = new \Orm_Property_Text('level');
        $level->set_description('Level');
        $property_add_more->add_property($level);

        $property = new \Orm_Property_Table_Dynamic('curriculum_study_plan', $value);

        $course_code_2 = new \Orm_Property_Text('course_code_2');
        $course_code_2->set_description('Course Code');
        $course_code_2->set_width(100);
        $property->add_property($course_code_2);

        $course_title_2 = new \Orm_Property_Text('course_title_2');
        $course_title_2->set_description('Course Title');
        $course_title_2->set_width(180);
        $property->add_property($course_title_2);

        $required_or_elective = new \Orm_Property_Text('number_of_sections');
        $required_or_elective->set_description('Number of Sections');
        $required_or_elective->set_width(100);
        $property->add_property($required_or_elective);

        $credit_houre = new \Orm_Property_Text('credit_houre');
        $credit_houre->set_description('Credit Hours');
        $credit_houre->set_width(100);
        $property->add_property($credit_houre);

        $college_or_department = new \Orm_Property_Text('college_or_department');
        $college_or_department->set_description('College or Department');
        $college_or_department->set_width(180);
        $property->add_property($college_or_department);

        $property_add_more->add_property($property);

        $this->set_property($property_add_more);
    }

    public function get_curriculum_study_plan_levels()
    {
        return $this->get_property('curriculum_study_plan_levels')->get_value();
    }

    public function set_nqf_table()
    {
        $property = new \Orm_Property_Fixedtext('nqf_table', '3. Program Learning Outcomes Assessment. Provide a report on the program learning outcomes assessment plan using the NCAAA accreditation four year cycle. By the end of the four year cycle all program learning outcomes must be assessed using KPIs with benchmarks and analysis, national or international standardized testing (if available), rubrics, exams and grade analysis, or some alternative scientific measure of student performance.');
        $this->set_property($property);
    }

    public function get_nqf_table()
    {
        return $this->get_property('nqf_table')->get_value();
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

    public function set_analysis_program($value)
    {
        $property = new \Orm_Property_Textarea('analysis_program', $value);
        $property->set_description('Provide an analysis of the Four (five/six) Year Program Learning Outcome Assessment Cycle (List strengths and recommendations).');
        $this->set_property($property);
    }

    public function get_analysis_program()
    {
        return $this->get_property('analysis_program')->get_value();
    }

    public function set_info3_2()
    {
        $property = new \Orm_Property_Fixedtext('info3_2', 'Note:  Programs are to provide their own KPIs for directly measuring student performance.</strong> <br/>'
            . 'The KPI table is used to document directly assessed program learning outcomes. Assessments methods may include:  national or international standardized test results, rubrics, exams and grade analysis, or learning achievement using an alternative scientific assessment system (copy the <strong><i>KPI Assessment Table</i></strong> and paste to make additional tables as needed).'
            . '');
        $this->set_property($property);
    }

    public function get_info3_2()
    {
        return $this->get_property('info3_2')->get_value();
    }

    public function set_kpi_table($value)
    {
        $kpi_text = new \Orm_Property_Text('kpi_text');
        $kpi_editor = new \Orm_Property_Textarea('kpi_editor');
        $kpi_editor->set_enable_tinymce(0);

        $property = new \Orm_Property_Add_More('kpi_table', $value);
        $property->set_description('KPI Assessment Table(Institutionally approved for the program)');

        $kpi_num = new \Orm_Property_Text('kpi_num');
        $kpi_num->set_description('KPI # ');
        $property->add_property($kpi_num);

        $program_kpi = new \Orm_Property_Text('program_kpi');
        $program_kpi->set_description('Program KPI');
        $property->add_property($program_kpi);

        $assessment_year = new \Orm_Property_Text('assessment_year');
        $assessment_year->set_description('Assessment Year');
        $property->add_property($assessment_year);

        $program_learning_outcome = new \Orm_Property_Textarea('program_learning_outcome');
        $program_learning_outcome->set_description('Program Learning Outcome');
        $program_learning_outcome->set_enable_tinymce(0);
        $property->add_property($program_learning_outcome);

        $kpi_table = new \Orm_Property_Table('kpi_table');

        $kpi_table->add_cell(1, 1, new \Orm_Property_Fixedtext('nqf_learning_domain', 'NQF Learning Domains and Learning Outcomes'));
        $kpi_table->add_cell(1, 2, $kpi_text);

        $kpi_table->add_cell(2, 1, new \Orm_Property_Fixedtext('target', 'KPI Target Benchmark'));
        $kpi_table->add_cell(2, 2, $kpi_text);

        $kpi_table->add_cell(3, 1, new \Orm_Property_Fixedtext('actual', 'KPI Actual Benchmark'));
        $kpi_table->add_cell(3, 2, $kpi_text);

        $kpi_table->add_cell(4, 1, new \Orm_Property_Fixedtext('external', 'External Benchmark'));
        $kpi_table->add_cell(4, 2, $kpi_editor);

        $kpi_table->add_cell(5, 1, new \Orm_Property_Fixedtext('internal', 'Internal Benchmark'));
        $kpi_table->add_cell(5, 2, $kpi_editor);

        $kpi_table->add_cell(6, 1, new \Orm_Property_Fixedtext('new_target', 'New Target Benchmark'));
        $kpi_table->add_cell(6, 2, $kpi_text);
        $property->add_property($kpi_table);

        $kpi_analysis = new \Orm_Property_Textarea('kpi_analysis');
        $kpi_analysis->set_description('Analysis: (List strengths and recommendations)');
        $property->add_property($kpi_analysis);

        $this->set_property($property);
    }

    public function get_kpi_table()
    {
        return $this->get_property('kpi_table')->get_value();
    }

    public function set_info_orientation()
    {
        $property = new \Orm_Property_Fixedtext('info_orientation', '<strong>3. Orientation programs for new teaching staff</strong>');
        $this->set_property($property);
    }

    public function get_info_orientation()
    {
        return $this->get_property('info_orientation')->get_value();
    }

    public function set_orientation_program($value)
    {
        $property = new \Orm_Property_Radio('orientation_program', $value);
        $property->set_options(array('Yes', 'No'));
        $property->set_description('Orientation programs provided?');
        $this->set_property($property);
    }

    public function get_orientation_program()
    {
        return $this->get_property('orientation_program')->get_value();
    }

    public function set_offered($value)
    {
        $property = new \Orm_Property_Text('offered', $value);
        $property->set_description('If offered how many participated?');
        $this->set_property($property);
    }

    public function get_offered()
    {
        return $this->get_property('offered')->get_value();
    }

    public function set_brief_description($value)
    {
        $property = new \Orm_Property_Textarea('brief_description', $value);
        $property->set_description('a. Brief Description');
        $this->set_property($property);
    }

    public function get_brief_description()
    {
        return $this->get_property('brief_description')->get_value();
    }

    public function set_list_recommendations($value)
    {
        $property = new \Orm_Property_Textarea('list_recommendations', $value);
        $property->set_description('b. List recommendations for improvement by teaching staff.');
        $this->set_property($property);
    }

    public function get_list_recommendations()
    {
        return $this->get_property('list_recommendations')->get_value();
    }

    public function set_if_orientation($value)
    {
        $property = new \Orm_Property_Textarea('if_orientation', $value);
        $property->set_description('c. If orientation programs were not provided, give reasons.');
        $this->set_property($property);
    }

    public function get_if_orientation()
    {
        return $this->get_property('if_orientation')->get_value();
    }

    public function set_professional_development($value)
    {

        $property = new \Orm_Property_Table_Dynamic('professional_development', $value);
        $property->set_description('4. Professional Development Activities for Faculty, Teaching and Other Staff');

        $activities_provided = new \Orm_Property_Text('activities_provided');
        $activities_provided->set_description('a. Activities Provided');
        $activities_provided->set_width(300);
        $property->add_property($activities_provided);

        $teaching_staff = new \Orm_Property_Text('teaching_staff');
        $teaching_staff->set_description('Teaching Staff');
        $teaching_staff->set_group('How many Participated ');
        $teaching_staff->set_width(200);
        $property->add_property($teaching_staff);

        $other_staff = new \Orm_Property_Text('other_staff');
        $other_staff->set_description('Other Staff');
        $other_staff->set_group('How many Participated ');
        $other_staff->set_width(200);
        $property->add_property($other_staff);

        $this->set_property($property);
    }

    public function get_professional_development()
    {
        return $this->get_property('professional_development')->get_value();
    }

    public function set_summary_analysis($value)
    {
        $property = new \Orm_Property_Textarea('summary_analysis', $value);
        $property->set_description('b. Summary analysis on usefulness of activities based on participant’s evaluations or other evaluation methods.');
        $this->set_property($property);
    }

    public function get_summary_analysis()
    {
        return $this->get_property('summary_analysis')->get_value();
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
        parent::integration_processes();
        $program_node = $this->get_parent_program_node();
        if (!is_null($program_node) && $program_node->get_id()) {
            $program_obj = $program_node->get_item_obj(); /* @var $program_obj \Orm_Program */
            $department_obj = $program_obj->get_department_obj();
            $college_obj = $department_obj->get_college_obj();

            $courses = array();
            foreach ($program_obj->get_courses() as $course) {
                $courses[] = array(
                    'course_code_1' => $course->get_course_obj()->get_code('english'),
                    'course_title_1' =>$course->get_course_obj()->get_name('english'),
                    'student_evaluations' => 'Yes',
                    'other_evaluation' => '',
                    'action_planned' => 'No'
                );
            }
            $this->set_list_courses($courses);

            $intersect_courses = array();

            foreach (\Orm_Program_Plan::get_intersect_courses($program_obj->get_id()) as $intersect_course) {
                if (isset($intersect_course['id'])) {
                    $intersect_course_obj = \Orm_Program_Plan::get_instance($intersect_course['id']);
                    $intersect_courses[$intersect_course_obj->get_level()]['level'] = 'Level '.$intersect_course_obj->get_level();
                    $intersect_courses[$intersect_course_obj->get_level()]['curriculum_study_plan'][] = array(
                        'course_code_2' => $intersect_course_obj->get_course_obj()->get_code('english'),
                        'course_title_2' => $intersect_course_obj->get_course_obj()->get_name('english'),
                        'number_of_sections' => \Orm_Course_Section::get_count(array('course_id' => $intersect_course_obj->get_course_id())),
                        'credit_houre' => $intersect_course_obj->get_credit_hours(),
                        'college_or_department' => $intersect_course_obj->get_course_obj()->get_department_obj()->get_name('english') . '/' .$intersect_course_obj->get_course_obj()->get_department_obj()->get_college_obj()->get_name('english')
                    );
                }
            }

            $this->set_curriculum_study_plan_levels($intersect_courses);


            if (\Orm::get_ci()->config->item('integration_enabled')) {
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
                            'assessment_methods' => ''
                        );
                    }
                    $PLOs = \Orm_Cm_Program_Learning_Outcome::get_all(array('program_id' => $program_obj->get_id(),'ncaaa_code' => 2));
                    $code = 0;
                    foreach ($PLOs as $key => $PLO) {
                        $knowledge[4][1]['national_qualifications'][] = array(
                            'code' => '2.'.(++$code),
                            'learning_outcome' => $PLO->get_text(),
                            'teaching_strategies' => $methods,
                            'assessment_methods' => ''
                        );
                    }

                    $PLOs = \Orm_Cm_Program_Learning_Outcome::get_all(array('program_id' => $program_obj->get_id(),'ncaaa_code' => 3));
                    $code = 0;
                    foreach ($PLOs as $key => $PLO) {
                        $knowledge[6][1]['national_qualifications'][] = array(
                            'code' => '3.'.(++$code),
                            'learning_outcome' => $PLO->get_text(),
                            'teaching_strategies' => $methods,
                            'assessment_methods' => ''
                        );
                    }

                    $PLOs = \Orm_Cm_Program_Learning_Outcome::get_all(array('program_id' => $program_obj->get_id(),'ncaaa_code' => 4));
                    $code = 0;
                    foreach ($PLOs as $key => $PLO) {
                        $knowledge[8][1]['national_qualifications'][] = array(
                            'code' => '4.'.(++$code),
                            'learning_outcome' => $PLO->get_text(),
                            'teaching_strategies' => $methods,
                            'assessment_methods' => ''
                        );
                    }

                    $PLOs = \Orm_Cm_Program_Learning_Outcome::get_all(array('program_id' => $program_obj->get_id(),'ncaaa_code' => 5));
                    $code = 0;
                    foreach ($PLOs as $key => $PLO) {
                        $knowledge[10][1]['national_qualifications'][] = array(
                            'code' => '5.'.(++$code),
                            'learning_outcome' => $PLO->get_text(),
                            'teaching_strategies' => $methods,
                            'assessment_methods' => ''
                        );
                    }
                    $this->set_national_qualification($knowledge);
                }
            }
        }
        $this->save();
    }
}
