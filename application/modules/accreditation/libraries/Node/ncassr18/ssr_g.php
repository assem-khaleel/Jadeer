<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ssr_g
 *
 * @author ahmadgx
 */
class Ssr_G extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'G. PROGRAM CONTEXT AND DEVELOPMENTS';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_list('');
        $this->set_info();
        $this->set_cohort_a(array());
        $this->set_cohort_a_analysis('');
        $this->set_cohort_b(array());
        $this->set_cohort_b_analysis('');
        $this->set_cohort_c(array());
        $this->set_cohort_c_analysis('');
        $this->set_cohort_d(array());
        $this->set_cohort_d_analysis('');
        $this->set_note();
        $this->set_period_list('');
        $this->set_comparison(array());
        $this->set_analysis('');

    }

    public function set_list($value)
    {
        $property = new \Orm_Property_Textarea('list', $value);
        $property->set_description('1. Describe the significant elements in the external environment (including any important recent changes)');
        $this->set_property($property);
    }

    public function get_list()
    {
        return $this->get_property('list')->get_value();
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '2. Enrollment Management and Cohort Analysis Table <br/> <br/>'
            . '<strong>Cohort Analysis </strong> refers to tracking a specific group of students who begin a given year in a program and following them until they graduate (How many students actually start a program and stay in the program until completion).  <br/> <br/>'
            . '<strong>A cohort </strong> here refers to the total number of students enrolled in the program at the beginning of each academic year, immediately after the preparatory year. No new students may be added or transfer into a given cohort. Any students that withdraw from a cohort may not return or be added again to the cohort.<br/> <br/>'
            . '<strong>Cohort Analysis (Illustration): Table 1</strong>provides complete tracking information for the most recent cohort to complete the program, beginning with their first year and tracking them until graduation (students that withdraw are subtracted and no new students are added). The report is to cover the past four years. Update the years as needed.<br/> <br/>'
            . '<strong>Enrollment Management and Cohort Analysis Tabl </strong>');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_cohort_a($value)
    {
        $first_year = new \Orm_Property_Text('first_year');
        $first_year->set_placeholder('*PYP');
        $second_year = new \Orm_Property_Text('second_year');
        $third_year = new \Orm_Property_Text('third_year');
        $fourth_year = new \Orm_Property_Text('fourth_year');
        $fifth_year = new \Orm_Property_Text('fifth_year');
        $sixth_year = new \Orm_Property_Text('sixth_year');

        $year = $this->get_year();

        $property = new \Orm_Property_Table('cohort_a', $value);
        $property->set_description('Cohort of the Academic Year (' . ($year - 6) . '-' . ($year - 5) . ')');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('student_category', '<strong>Student Category</strong>'));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('first_year', '<strong>' . ($year - 6) . '-' . substr($year - 5, 2, 2) . '</strong>'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('second_year', '<strong>' . ($year - 5) . '-' . substr($year - 4, 2, 2) . '</strong>'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('third_year', '<strong>' . ($year - 4) . '-' . substr($year - 3, 2, 2) . '</strong>'));
        $property->add_cell(1, 5, new \Orm_Property_Fixedtext('fourth_year', '<strong>' . ($year - 3) . '-' . substr($year - 2, 2, 2) . '</strong>'));
        $property->add_cell(1, 6, new \Orm_Property_Fixedtext('fifth_year', '<strong>' . ($year - 2) . '-' . substr($year - 1, 2, 2) . '</strong>'));
        $property->add_cell(1, 7, new \Orm_Property_Fixedtext('sixth_year', '<strong>' . ($year - 1) . '-' . substr($year, 2, 2) . '</strong>'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('total_cohort', 'Total cohort enrollment'));
        $property->add_cell(2, 2, $first_year);
        $property->add_cell(2, 3, $second_year);
        $property->add_cell(2, 4, $third_year);
        $property->add_cell(2, 5, $fourth_year);
        $property->add_cell(2, 6, $fifth_year);
        $property->add_cell(2, 7, $sixth_year);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('retained_till', 'Retained till year end'));
        $property->add_cell(3, 2, $first_year);
        $property->add_cell(3, 3, $second_year);
        $property->add_cell(3, 4, $third_year);
        $property->add_cell(3, 5, $fourth_year);
        $property->add_cell(3, 6, $fifth_year);
        $property->add_cell(3, 7, $sixth_year);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('withdrawn_during', 'Withdrawn'));
        $property->add_cell(4, 2, $first_year);
        $property->add_cell(4, 3, $second_year);
        $property->add_cell(4, 4, $third_year);
        $property->add_cell(4, 5, $fourth_year);
        $property->add_cell(4, 6, $fifth_year);
        $property->add_cell(4, 7, $sixth_year);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('withdrawn_for_good', 'Cohort graduated successfully'));
        $property->add_cell(5, 2, $first_year);
        $property->add_cell(5, 3, $second_year);
        $property->add_cell(5, 4, $third_year);
        $property->add_cell(5, 5, $fourth_year);
        $property->add_cell(5, 6, $fifth_year);
        $property->add_cell(5, 7, $sixth_year);

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('graduated_successfully', 'Total graduated successfully'));
        $property->add_cell(6, 2, $first_year);
        $property->add_cell(6, 3, $second_year);
        $property->add_cell(6, 4, $third_year);
        $property->add_cell(6, 5, $fourth_year);
        $property->add_cell(6, 6, $fifth_year);
        $property->add_cell(6, 7, $sixth_year);

        $this->set_property($property);
    }

    public function get_cohort_a()
    {
        return $this->get_property('cohort_a')->get_value();
    }

    public function set_cohort_a_analysis($value)
    {
        $property = new \Orm_Property_Textarea('cohort_a_analysis', $value);
        $property->set_description('Provide a Cohort Analysis');
        $this->set_property($property);
    }

    public function get_cohort_a_analysis()
    {
        return $this->get_property('cohort_a_analysis')->get_value();
    }

    public function set_data()
    {
        $property = new \Orm_Property_Fixedtext('data', '<strong>* PYP  - Preparatory Year Program</strong>');
        $this->set_property($property);
    }

    public function get_data()
    {
        return $this->get_property('data')->get_value();
    }

    public function set_cohort_b($value)
    {
        $first_year = new \Orm_Property_Text('first_year');
        $first_year->set_placeholder('*PYP');
        $second_year = new \Orm_Property_Text('second_year');
        $third_year = new \Orm_Property_Text('third_year');
        $fourth_year = new \Orm_Property_Text('fourth_year');
        $fifth_year = new \Orm_Property_Text('fifth_year');


        $year = $this->get_year();

        $property = new \Orm_Property_Table('cohort_b', $value);
        $property->set_description('Cohort of the Academic Year (' . ($year - 5) . '-' . ($year - 4) . ')');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('student_category', '<strong>Student Category</strong>'));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('first_year', '<strong>' . ($year - 5) . '-' . substr($year - 4, 2, 2) . '</strong>'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('second_year', '<strong>' . ($year - 4) . '-' . substr($year - 3, 2, 2) . '</strong>'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('third_year', '<strong>' . ($year - 3) . '-' . substr($year - 2, 2, 2) . '</strong>'));
        $property->add_cell(1, 5, new \Orm_Property_Fixedtext('forth_year', '<strong>' . ($year - 2) . '-' . substr($year - 1, 2, 2) . '</strong>'));
        $property->add_cell(1, 6, new \Orm_Property_Fixedtext('fifth_year', '<strong>' . ($year - 1) . '-' . substr($year, 2, 2) . '</strong>'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('total_cohort', 'Total cohort enrollment'));
        $property->add_cell(2, 2, $first_year);
        $property->add_cell(2, 3, $second_year);
        $property->add_cell(2, 4, $third_year);
        $property->add_cell(2, 5, $fourth_year);
        $property->add_cell(2, 6, $fifth_year);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('retained_till', 'Retained till year end'));
        $property->add_cell(3, 2, $first_year);
        $property->add_cell(3, 3, $second_year);
        $property->add_cell(3, 4, $third_year);
        $property->add_cell(3, 5, $fourth_year);
        $property->add_cell(3, 6, $fifth_year);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('withdrawn_during', 'Withdrawn'));
        $property->add_cell(4, 2, $first_year);
        $property->add_cell(4, 3, $second_year);
        $property->add_cell(4, 4, $third_year);
        $property->add_cell(4, 5, $fourth_year);
        $property->add_cell(4, 6, $fifth_year);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('withdrawn_for_good', 'Cohort graduated successfully'));
        $property->add_cell(5, 2, $first_year);
        $property->add_cell(5, 3, $second_year);
        $property->add_cell(5, 4, $third_year);
        $property->add_cell(5, 5, $fourth_year);
        $property->add_cell(5, 6, $fifth_year);

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('graduated_successfully', 'Total graduated successfully'));
        $property->add_cell(6, 2, $first_year);
        $property->add_cell(6, 3, $second_year);
        $property->add_cell(6, 4, $third_year);
        $property->add_cell(6, 5, $fourth_year);
        $property->add_cell(6, 6, $fifth_year);

        $this->set_property($property);
    }

    public function get_cohort_b()
    {
        return $this->get_property('cohort_b')->get_value();
    }

    public function set_cohort_b_analysis($value)
    {
        $property = new \Orm_Property_Textarea('cohort_b_analysis', $value);
        $property->set_description('Provide Analysis');
        $this->set_property($property);
    }

    public function get_cohort_b_analysis()
    {
        return $this->get_property('cohort_b_analysis')->get_value();
    }

    public function set_cohort_c($value)
    {
        $first_year = new \Orm_Property_Text('first_year');
        $first_year->set_placeholder('*PYP');
        $second_year = new \Orm_Property_Text('second_year');
        $third_year = new \Orm_Property_Text('third_year');
        $fourth_year = new \Orm_Property_Text('fourth_year');

        $year = $this->get_year();

        $property = new \Orm_Property_Table('cohort_c', $value);
        $property->set_description('Cohort of the Academic Year (' . ($year - 4) . '-' . ($year - 3) . ')');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('student_category', '<strong>Student Category</strong>'));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('first_year', '<strong>' . ($year - 4) . '-' . substr($year - 3, 2, 2) . '</strong>'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('second_year', '<strong>' . ($year - 3) . '-' . substr($year - 2, 2, 2) . '</strong>'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('third_year', '<strong>' . ($year - 2) . '-' . substr($year - 1, 2, 2) . '</strong>'));
        $property->add_cell(1, 5, new \Orm_Property_Fixedtext('forth_year', '<strong>' . ($year - 1) . '-' . substr($year, 2, 2) . '</strong>'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('total_cohort', 'Total cohort enrollment'));
        $property->add_cell(2, 2, $first_year);
        $property->add_cell(2, 3, $second_year);
        $property->add_cell(2, 4, $third_year);
        $property->add_cell(2, 5, $fourth_year);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('retained_till', 'Retained till year end'));
        $property->add_cell(3, 2, $first_year);
        $property->add_cell(3, 3, $second_year);
        $property->add_cell(3, 4, $third_year);
        $property->add_cell(3, 5, $fourth_year);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('withdrawn_during', 'Withdrawn'));
        $property->add_cell(4, 2, $first_year);
        $property->add_cell(4, 3, $second_year);
        $property->add_cell(4, 4, $third_year);
        $property->add_cell(4, 5, $fourth_year);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('withdrawn_for_good', 'Cohort graduated successfully'));
        $property->add_cell(5, 2, $first_year);
        $property->add_cell(5, 3, $second_year);
        $property->add_cell(5, 4, $third_year);
        $property->add_cell(5, 5, $fourth_year);

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('graduated_successfully', 'Total graduated successfully'));
        $property->add_cell(6, 2, $first_year);
        $property->add_cell(6, 3, $second_year);
        $property->add_cell(6, 4, $third_year);
        $property->add_cell(6, 5, $fourth_year);


        $this->set_property($property);
    }

    public function get_cohort_c()
    {
        return $this->get_property('cohort_c')->get_value();
    }

    public function set_cohort_c_analysis($value)
    {
        $property = new \Orm_Property_Textarea('cohort_c_analysis', $value);
        $property->set_description('Provide Analysis');
        $this->set_property($property);
    }

    public function get_cohort_c_analysis()
    {
        return $this->get_property('cohort_c_analysis')->get_value();
    }

    public function set_cohort_d($value)
    {
        $first_year = new \Orm_Property_Text('first_year');
        $first_year->set_placeholder('*PYP');
        $second_year = new \Orm_Property_Text('second_year');
        $third_year = new \Orm_Property_Text('third_year');

        $year = $this->get_year();

        $property = new \Orm_Property_Table('cohort_d', $value);
        $property->set_description('Cohort of the Academic Year (' . ($year - 3) . '-' . ($year - 2) . ')');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('student_category', '<strong>Student Category</strong>'));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('first_year', '<strong>' . ($year - 3) . '-' . substr($year - 2, 2, 2) . '</strong>'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('second_year', '<strong>' . ($year - 2) . '-' . substr($year - 1, 2, 2) . '</strong>'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('third_year', '<strong>' . ($year - 1) . '-' . substr($year, 2, 2) . '</strong>'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('total_cohort', 'Total cohort enrollment'));
        $property->add_cell(2, 2, $first_year);
        $property->add_cell(2, 3, $second_year);
        $property->add_cell(2, 4, $third_year);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('retained_till', 'Retained till year end'));
        $property->add_cell(3, 2, $first_year);
        $property->add_cell(3, 3, $second_year);
        $property->add_cell(3, 4, $third_year);


        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('withdrawn_during', 'Withdrawn'));
        $property->add_cell(4, 2, $first_year);
        $property->add_cell(4, 3, $second_year);
        $property->add_cell(4, 4, $third_year);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('withdrawn_for_good', 'Cohort graduated successfully'));
        $property->add_cell(5, 2, $first_year);
        $property->add_cell(5, 3, $second_year);
        $property->add_cell(5, 4, $third_year);

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('graduated_successfully', 'Total graduated successfully'));
        $property->add_cell(6, 2, $first_year);
        $property->add_cell(6, 3, $second_year);
        $property->add_cell(6, 4, $third_year);


        $this->set_property($property);
    }

    public function get_cohort_d()
    {
        return $this->get_property('cohort_d')->get_value();
    }

    public function set_cohort_d_analysis($value)
    {
        $property = new \Orm_Property_Textarea('cohort_d_analysis', $value);
        $property->set_description('Provide Analysis');
        $this->set_property($property);
    }


    public function get_cohort_d_analysis()
    {
        return $this->get_property('cohort_d_analysis')->get_value();
    }

    public function set_note(){
        $property = new \Orm_Property_Fixedtext('note', '<strong>Program Developments </strong>');
        $this->set_property($property);

    }
    public function get_note(){
        return $this->get_property('note')->get_value();
    }

    public function set_period_list($value)
    {
        $property = new \Orm_Property_Textarea('period_list', $value);
        $property->set_description('1. Provide a list of changes made in the program in the period since the previous self-study or since the program was introduced.  This should include such things as courses added or deleted or significant changes in their content, changes in approaches to teaching or student assessment, or program evaluation processes etc.');
        $this->set_property($property);
    }

    public function get_period_list()
    {
        return $this->get_property('period_list')->get_value();
    }

    public function set_comparison($value)
    {
        $property = new \Orm_Property_Table_Dynamic('comparison', $value);
        $property->set_description('2. Comparison of planned and actual enrollments table.');

        $year = new \Orm_Property_Text('year');
        $year->set_description('Year');
        $year->set_width(230);
        $property->add_property($year);

        $planned_enrollment = new \Orm_Property_Text('planned_enrollment');
        $planned_enrollment->set_description('Planned Enrollment');
        $planned_enrollment->set_width(230);
        $property->add_property($planned_enrollment);

        $actual_enrollment = new \Orm_Property_Text('actual_enrollment');
        $actual_enrollment->set_description('Actual Enrollment');
        $actual_enrollment->set_width(230);
        $property->add_property($actual_enrollment);

        $this->set_property($property);
    }

    public function get_comparison()
    {
        return $this->get_property('comparison')->get_value();
    }

    public function set_analysis($value)
    {
        $property = new \Orm_Property_Textarea('analysis', $value);
        $property->set_description('Provide analysis and an explanation report if there are significant differences between planned and actual numbers.');
        $this->set_property($property);
    }

    public function get_analysis()
    {
        return $this->get_property('analysis')->get_value();
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

                /* @var $program_obj \Orm_Program */
                $program_obj = $program_node->get_item_obj();
                $cohort_a = array();
                $cohort_b = array();
                $cohort_c = array();
                $cohort_d = array();

                $duration = $program_obj->get_duration();
                $starting_year = $this->get_year() - $duration + 2;

                $first_year = \Orm_Data_Cohort_Table::get_one(array('program_id' => $program_obj->get_id(),'report_year' => $starting_year,'level_year' => 1,'start_year' => $starting_year));
                $second_year = \Orm_Data_Cohort_Table::get_one(array('program_id' => $program_obj->get_id(),'report_year' => $starting_year+1,'level_year' => 2,'start_year' => $starting_year));
                $third_year = \Orm_Data_Cohort_Table::get_one(array('program_id' => $program_obj->get_id(),'report_year' => $starting_year+2,'level_year' => 3,'start_year' => $starting_year));
                $forth_year = \Orm_Data_Cohort_Table::get_one(array('program_id' => $program_obj->get_id(),'report_year' => $starting_year+3,'level_year' => 4,'start_year' => $starting_year));
                $fifth_year = \Orm_Data_Cohort_Table::get_one(array('program_id' => $program_obj->get_id(),'report_year' => $starting_year+4,'level_year' => 5,'start_year' => $starting_year));

                if ($duration == 4) {
                    //ENROLLED
                    $cohort_a[2][3]['second_year'] = 0;
                    $cohort_a[2][4]['third_year'] = 'PYP';
                    $cohort_a[2][5]['fourth_year'] = $first_year->get_cohort_enroll();
                    $cohort_a[2][6]['fifth_year'] = $second_year->get_cohort_enroll();
                    $cohort_a[2][7]['sixth_year'] = $third_year->get_cohort_enroll();

                    //RETAIN
                    $cohort_a[3][3]['second_year'] = 0;
                    $cohort_a[3][4]['third_year'] = 'PYP';
                    $cohort_a[3][5]['fourth_year'] = $first_year->get_retain_till_year();
                    $cohort_a[3][6]['fifth_year'] = $second_year->get_retain_till_year();
                    $cohort_a[3][7]['sixth_year'] = $third_year->get_retain_till_year();

                    //WITHDRAWN ENROLLED
                    $cohort_a[4][3]['second_year'] = 0;
                    $cohort_a[4][4]['third_year'] = 'PYP';
                    $cohort_a[4][5]['fourth_year'] = $first_year->get_withdrawn_enrolled();
                    $cohort_a[4][6]['fifth_year'] = $second_year->get_withdrawn_enrolled();
                    $cohort_a[4][7]['sixth_year'] = $third_year->get_withdrawn_enrolled();

                    //WITHDRAWN GOOD
                    $cohort_a[5][3]['second_year'] = 0;
                    $cohort_a[5][4]['third_year'] = 'PYP';
                    $cohort_a[5][5]['fourth_year'] = $first_year->get_withdrawn_good();
                    $cohort_a[5][6]['fifth_year'] = $second_year->get_withdrawn_good();
                    $cohort_a[5][7]['sixth_year'] = $third_year->get_withdrawn_good();

                    //GRADUATED
                    $cohort_a[6][3]['second_year'] = 0;
                    $cohort_a[6][4]['third_year'] = 'PYP';
                    $cohort_a[6][5]['fourth_year'] = $first_year->get_graduated();
                    $cohort_a[6][6]['fifth_year'] = $second_year->get_graduated();
                    $cohort_a[6][7]['sixth_year'] = $third_year->get_graduated();

                } elseif ($duration == 5) {
                    $cohort_a[2][3]['second_year'] = 'PYP';
                    $cohort_a[2][4]['third_year'] = $first_year->get_cohort_enroll();
                    $cohort_a[2][5]['fourth_year'] = $second_year->get_cohort_enroll();
                    $cohort_a[2][6]['fifth_year'] = $third_year->get_cohort_enroll();
                    $cohort_a[2][7]['sixth_year'] = $forth_year->get_cohort_enroll();

                    //RETAIN
                    $cohort_a[3][3]['second_year'] = 'PYP';
                    $cohort_a[3][4]['third_year'] = $first_year->get_retain_till_year();
                    $cohort_a[3][5]['fourth_year'] = $second_year->get_retain_till_year();
                    $cohort_a[3][6]['fifth_year'] = $third_year->get_retain_till_year();
                    $cohort_a[3][7]['sixth_year'] = $forth_year->get_retain_till_year();

                    //WITHDRAWN ENROLLED
                    $cohort_a[4][3]['second_year'] = 'PYP';
                    $cohort_a[4][4]['third_year'] = $first_year->get_withdrawn_enrolled();
                    $cohort_a[4][5]['fourth_year'] = $second_year->get_withdrawn_enrolled();
                    $cohort_a[4][6]['fifth_year'] = $third_year->get_withdrawn_enrolled();
                    $cohort_a[4][7]['sixth_year'] = $forth_year->get_withdrawn_enrolled();

                    //WITHDRAWN GOOD
                    $cohort_a[5][3]['second_year'] = 'PYP';
                    $cohort_a[5][4]['third_year'] = $first_year->get_withdrawn_good();
                    $cohort_a[5][5]['fourth_year'] = $second_year->get_withdrawn_good();
                    $cohort_a[5][6]['fifth_year'] = $third_year->get_withdrawn_good();
                    $cohort_a[5][7]['sixth_year'] = $forth_year->get_withdrawn_good();

                    //GRADUATED
                    $cohort_a[6][3]['second_year'] = 'PYP';
                    $cohort_a[6][4]['third_year'] = $first_year->get_graduated();
                    $cohort_a[6][5]['fourth_year'] = $second_year->get_graduated();
                    $cohort_a[6][6]['fifth_year'] = $third_year->get_graduated();
                    $cohort_a[6][7]['sixth_year'] = $forth_year->get_graduated();
                } elseif ($duration == 6) {
                    $cohort_a[2][3]['second_year'] = $first_year->get_cohort_enroll();
                    $cohort_a[2][4]['third_year'] = $second_year->get_cohort_enroll();
                    $cohort_a[2][5]['fourth_year'] = $third_year->get_cohort_enroll();
                    $cohort_a[2][6]['fifth_year'] = $forth_year->get_cohort_enroll();
                    $cohort_a[2][7]['sixth_year'] = $fifth_year->get_cohort_enroll();

                    //RETAIN
                    $cohort_a[3][3]['second_year'] = $first_year->get_retain_till_year();
                    $cohort_a[3][4]['third_year'] = $second_year->get_retain_till_year();
                    $cohort_a[3][5]['fourth_year'] = $third_year->get_retain_till_year();
                    $cohort_a[3][6]['fifth_year'] = $forth_year->get_retain_till_year();
                    $cohort_a[3][7]['sixth_year'] = $fifth_year->get_retain_till_year();

                    //WITHDRAWN ENROLLED
                    $cohort_a[4][3]['second_year'] = $fifth_year->get_withdrawn_enrolled();
                    $cohort_a[4][4]['third_year'] = $second_year->get_withdrawn_enrolled();
                    $cohort_a[4][5]['fourth_year'] = $third_year->get_withdrawn_enrolled();
                    $cohort_a[4][6]['fifth_year'] = $forth_year->get_withdrawn_enrolled();
                    $cohort_a[4][7]['sixth_year'] = $fifth_year->get_withdrawn_enrolled();

                    //WITHDRAWN GOOD
                    $cohort_a[5][3]['second_year'] = $first_year->get_withdrawn_good();
                    $cohort_a[5][4]['third_year'] = $second_year->get_withdrawn_good();
                    $cohort_a[5][5]['fourth_year'] = $third_year->get_withdrawn_good();
                    $cohort_a[5][6]['fifth_year'] = $forth_year->get_withdrawn_good();
                    $cohort_a[5][7]['sixth_year'] = $fifth_year->get_withdrawn_good();

                    //GRADUATED
                    $cohort_a[6][3]['second_year'] = $first_year->get_graduated();
                    $cohort_a[6][4]['third_year'] = $second_year->get_graduated();
                    $cohort_a[6][5]['fourth_year'] = $third_year->get_graduated();
                    $cohort_a[6][6]['fifth_year'] = $forth_year->get_graduated();
                    $cohort_a[6][7]['sixth_year'] = $fifth_year->get_graduated();
                }

                $starting_year = $this->get_year() - $duration + 3;

                $first_year = \Orm_Data_Cohort_Table::get_one(array('program_id' => $program_obj->get_id(),'report_year' => $starting_year,'level_year' => 1,'start_year' => $starting_year));
                $second_year = \Orm_Data_Cohort_Table::get_one(array('program_id' => $program_obj->get_id(),'report_year' => $starting_year+1,'level_year' => 2,'start_year' => $starting_year));
                $third_year = \Orm_Data_Cohort_Table::get_one(array('program_id' => $program_obj->get_id(),'report_year' => $starting_year+2,'level_year' => 3,'start_year' => $starting_year));
                $forth_year = \Orm_Data_Cohort_Table::get_one(array('program_id' => $program_obj->get_id(),'report_year' => $starting_year+3,'level_year' => 4,'start_year' => $starting_year));


                if ($duration == 4) {
                    //ENROLLED
                    $cohort_b[2][3]['second_year'] = 0;
                    $cohort_b[2][4]['third_year'] = 'PYP';
                    $cohort_b[2][5]['fourth_year'] = $first_year->get_cohort_enroll();
                    $cohort_b[2][6]['fifth_year'] = $second_year->get_cohort_enroll();

                    //RETAIN
                    $cohort_b[3][3]['second_year'] = 0;
                    $cohort_b[3][4]['third_year'] = 'PYP';
                    $cohort_b[3][5]['fourth_year'] = $first_year->get_retain_till_year();
                    $cohort_b[3][6]['fifth_year'] = $second_year->get_retain_till_year();

                    //WITHDRAWN ENROLLED
                    $cohort_b[4][3]['second_year'] = 0;
                    $cohort_b[4][4]['third_year'] = 'PYP';
                    $cohort_b[4][5]['fourth_year'] = $first_year->get_withdrawn_enrolled();
                    $cohort_b[4][6]['fifth_year'] = $second_year->get_withdrawn_enrolled();

                    //WITHDRAWN GOOD
                    $cohort_b[5][3]['second_year'] = 0;
                    $cohort_b[5][4]['third_year'] = 'PYP';
                    $cohort_b[5][5]['fourth_year'] = $first_year->get_withdrawn_good();
                    $cohort_b[5][6]['fifth_year'] = $second_year->get_withdrawn_good();

                    //GRADUATED
                    $cohort_b[6][3]['second_year'] = 0;
                    $cohort_b[6][4]['third_year'] = 'PYP';
                    $cohort_b[6][5]['fourth_year'] = $first_year->get_graduated();
                    $cohort_b[6][6]['fifth_year'] = $second_year->get_graduated();

                } elseif ($duration == 5) {
                    $cohort_b[2][3]['second_year'] = 'PYP';
                    $cohort_b[2][4]['third_year'] = $first_year->get_cohort_enroll();
                    $cohort_b[2][5]['fourth_year'] = $second_year->get_cohort_enroll();
                    $cohort_b[2][6]['fifth_year'] = $third_year->get_cohort_enroll();

                    //RETAIN
                    $cohort_b[3][3]['second_year'] = 'PYP';
                    $cohort_b[3][4]['third_year'] = $first_year->get_retain_till_year();
                    $cohort_b[3][5]['fourth_year'] = $second_year->get_retain_till_year();
                    $cohort_b[3][6]['fifth_year'] = $third_year->get_retain_till_year();

                    //WITHDRAWN ENROLLED
                    $cohort_b[4][3]['second_year'] = 'PYP';
                    $cohort_b[4][4]['third_year'] = $first_year->get_withdrawn_enrolled();
                    $cohort_b[4][5]['fourth_year'] = $second_year->get_withdrawn_enrolled();
                    $cohort_b[4][6]['fifth_year'] = $third_year->get_withdrawn_enrolled();

                    //WITHDRAWN GOOD
                    $cohort_b[5][3]['second_year'] = 'PYP';
                    $cohort_b[5][4]['third_year'] = $first_year->get_withdrawn_good();
                    $cohort_b[5][5]['fourth_year'] = $second_year->get_withdrawn_good();
                    $cohort_b[5][6]['fifth_year'] = $third_year->get_withdrawn_good();

                    //GRADUATED
                    $cohort_b[6][3]['second_year'] = 'PYP';
                    $cohort_b[6][4]['third_year'] = $first_year->get_graduated();
                    $cohort_b[6][5]['fourth_year'] = $second_year->get_graduated();
                    $cohort_b[6][6]['fifth_year'] = $third_year->get_graduated();
                } elseif ($duration == 6) {
                    $cohort_b[2][3]['second_year'] = $first_year->get_cohort_enroll();
                    $cohort_b[2][4]['third_year'] = $second_year->get_cohort_enroll();
                    $cohort_b[2][5]['fourth_year'] = $third_year->get_cohort_enroll();
                    $cohort_b[2][6]['fifth_year'] = $forth_year->get_cohort_enroll();

                    //RETAIN
                    $cohort_b[3][3]['second_year'] = $first_year->get_retain_till_year();
                    $cohort_b[3][4]['third_year'] = $second_year->get_retain_till_year();
                    $cohort_b[3][5]['fourth_year'] = $third_year->get_retain_till_year();
                    $cohort_b[3][6]['fifth_year'] = $forth_year->get_retain_till_year();

                    //WITHDRAWN ENROLLED
                    $cohort_b[4][3]['second_year'] = $fifth_year->get_withdrawn_enrolled();
                    $cohort_b[4][4]['third_year'] = $second_year->get_withdrawn_enrolled();
                    $cohort_b[4][5]['fourth_year'] = $third_year->get_withdrawn_enrolled();
                    $cohort_b[4][6]['fifth_year'] = $forth_year->get_withdrawn_enrolled();

                    //WITHDRAWN GOOD
                    $cohort_b[5][3]['second_year'] = $first_year->get_withdrawn_good();
                    $cohort_b[5][4]['third_year'] = $second_year->get_withdrawn_good();
                    $cohort_b[5][5]['fourth_year'] = $third_year->get_withdrawn_good();
                    $cohort_b[5][6]['fifth_year'] = $forth_year->get_withdrawn_good();

                    //GRADUATED
                    $cohort_b[6][3]['second_year'] = $first_year->get_graduated();
                    $cohort_b[6][4]['third_year'] = $second_year->get_graduated();
                    $cohort_b[6][5]['fourth_year'] = $third_year->get_graduated();
                    $cohort_b[6][6]['fifth_year'] = $forth_year->get_graduated();
                }

                $starting_year = $this->get_year() - $duration + 3;

                $first_year = \Orm_Data_Cohort_Table::get_one(array('program_id' => $program_obj->get_id(),'report_year' => $starting_year,'level_year' => 1,'start_year' => $starting_year));
                $second_year = \Orm_Data_Cohort_Table::get_one(array('program_id' => $program_obj->get_id(),'report_year' => $starting_year+1,'level_year' => 2,'start_year' => $starting_year));
                $third_year = \Orm_Data_Cohort_Table::get_one(array('program_id' => $program_obj->get_id(),'report_year' => $starting_year+2,'level_year' => 3,'start_year' => $starting_year));

                if ($duration == 4) {
                    //ENROLLED
                    $cohort_c[2][3]['second_year'] = 0;
                    $cohort_c[2][4]['third_year'] = 'PYP';
                    $cohort_c[2][5]['fourth_year'] = $first_year->get_cohort_enroll();

                    //RETAIN
                    $cohort_c[3][3]['second_year'] = 0;
                    $cohort_c[3][4]['third_year'] = 'PYP';
                    $cohort_c[3][5]['fourth_year'] = $first_year->get_retain_till_year();

                    //WITHDRAWN ENROLLED
                    $cohort_c[4][3]['second_year'] = 0;
                    $cohort_c[4][4]['third_year'] = 'PYP';
                    $cohort_c[4][5]['fourth_year'] = $first_year->get_withdrawn_enrolled();

                    //WITHDRAWN GOOD
                    $cohort_c[5][3]['second_year'] = 0;
                    $cohort_c[5][4]['third_year'] = 'PYP';
                    $cohort_c[5][5]['fourth_year'] = $first_year->get_withdrawn_good();

                    //GRADUATED
                    $cohort_c[6][3]['second_year'] = 0;
                    $cohort_c[6][4]['third_year'] = 'PYP';
                    $cohort_c[6][5]['fourth_year'] = $first_year->get_graduated();

                } elseif ($duration == 5) {
                    $cohort_c[2][3]['second_year'] = 'PYP';
                    $cohort_c[2][4]['third_year'] = $first_year->get_cohort_enroll();
                    $cohort_c[2][5]['fourth_year'] = $second_year->get_cohort_enroll();

                    //RETAIN
                    $cohort_c[3][3]['second_year'] = 'PYP';
                    $cohort_c[3][4]['third_year'] = $first_year->get_retain_till_year();
                    $cohort_c[3][5]['fourth_year'] = $second_year->get_retain_till_year();

                    //WITHDRAWN ENROLLED
                    $cohort_c[4][3]['second_year'] = 'PYP';
                    $cohort_c[4][4]['third_year'] = $first_year->get_withdrawn_enrolled();
                    $cohort_c[4][5]['fourth_year'] = $second_year->get_withdrawn_enrolled();

                    //WITHDRAWN GOOD
                    $cohort_c[5][3]['second_year'] = 'PYP';
                    $cohort_c[5][4]['third_year'] = $first_year->get_withdrawn_good();
                    $cohort_c[5][5]['fourth_year'] = $second_year->get_withdrawn_good();

                    //GRADUATED
                    $cohort_c[6][3]['second_year'] = 'PYP';
                    $cohort_c[6][4]['third_year'] = $first_year->get_graduated();
                    $cohort_c[6][5]['fourth_year'] = $second_year->get_graduated();
                } elseif ($duration == 6) {
                    $cohort_c[2][3]['second_year'] = $first_year->get_cohort_enroll();
                    $cohort_c[2][4]['third_year'] = $second_year->get_cohort_enroll();
                    $cohort_c[2][5]['fourth_year'] = $third_year->get_cohort_enroll();

                    //RETAIN
                    $cohort_c[3][3]['second_year'] = $first_year->get_retain_till_year();
                    $cohort_c[3][4]['third_year'] = $second_year->get_retain_till_year();
                    $cohort_c[3][5]['fourth_year'] = $third_year->get_retain_till_year();

                    //WITHDRAWN ENROLLED
                    $cohort_c[4][3]['second_year'] = $fifth_year->get_withdrawn_enrolled();
                    $cohort_c[4][4]['third_year'] = $second_year->get_withdrawn_enrolled();
                    $cohort_c[4][5]['fourth_year'] = $third_year->get_withdrawn_enrolled();

                    //WITHDRAWN GOOD
                    $cohort_c[5][3]['second_year'] = $first_year->get_withdrawn_good();
                    $cohort_c[5][4]['third_year'] = $second_year->get_withdrawn_good();
                    $cohort_c[5][5]['fourth_year'] = $third_year->get_withdrawn_good();

                    //GRADUATED
                    $cohort_c[6][3]['second_year'] = $first_year->get_graduated();
                    $cohort_c[6][4]['third_year'] = $second_year->get_graduated();
                    $cohort_c[6][5]['fourth_year'] = $third_year->get_graduated();
                }

                $starting_year = $this->get_year() - $duration + 4;

                $first_year = \Orm_Data_Cohort_Table::get_one(array('program_id' => $program_obj->get_id(),'report_year' => $starting_year,'level_year' => 1,'start_year' => $starting_year));
                $second_year = \Orm_Data_Cohort_Table::get_one(array('program_id' => $program_obj->get_id(),'report_year' => $starting_year+1,'level_year' => 2,'start_year' => $starting_year));

                if ($duration == 4) {
                    //ENROLLED
                    $cohort_d[2][3]['second_year'] = 0;
                    $cohort_d[2][4]['third_year'] = 'PYP';

                    //RETAIN
                    $cohort_d[3][3]['second_year'] = 0;
                    $cohort_d[3][4]['third_year'] = 'PYP';

                    //WITHDRAWN ENROLLED
                    $cohort_d[4][3]['second_year'] = 0;
                    $cohort_d[4][4]['third_year'] = 'PYP';

                    //WITHDRAWN GOOD
                    $cohort_d[5][3]['second_year'] = 0;
                    $cohort_d[5][4]['third_year'] = 'PYP';

                    //GRADUATED
                    $cohort_d[6][3]['second_year'] = 0;
                    $cohort_d[6][4]['third_year'] = 'PYP';

                } elseif ($duration == 5) {
                    $cohort_d[2][3]['second_year'] = 'PYP';
                    $cohort_d[2][4]['third_year'] = $first_year->get_cohort_enroll();

                    //RETAIN
                    $cohort_d[3][3]['second_year'] = 'PYP';
                    $cohort_d[3][4]['third_year'] = $first_year->get_retain_till_year();

                    //WITHDRAWN ENROLLED
                    $cohort_d[4][3]['second_year'] = 'PYP';
                    $cohort_d[4][4]['third_year'] = $first_year->get_withdrawn_enrolled();

                    //WITHDRAWN GOOD
                    $cohort_d[5][3]['second_year'] = 'PYP';
                    $cohort_d[5][4]['third_year'] = $first_year->get_withdrawn_good();

                    //GRADUATED
                    $cohort_d[6][3]['second_year'] = 'PYP';
                    $cohort_d[6][4]['third_year'] = $first_year->get_graduated();
                } elseif ($duration == 6) {
                    $cohort_d[2][3]['second_year'] = $first_year->get_cohort_enroll();
                    $cohort_d[2][4]['third_year'] = $second_year->get_cohort_enroll();

                    //RETAIN
                    $cohort_d[3][3]['second_year'] = $first_year->get_retain_till_year();
                    $cohort_d[3][4]['third_year'] = $second_year->get_retain_till_year();

                    //WITHDRAWN ENROLLED
                    $cohort_d[4][3]['second_year'] = $fifth_year->get_withdrawn_enrolled();
                    $cohort_d[4][4]['third_year'] = $second_year->get_withdrawn_enrolled();

                    //WITHDRAWN GOOD
                    $cohort_d[5][3]['second_year'] = $first_year->get_withdrawn_good();
                    $cohort_d[5][4]['third_year'] = $second_year->get_withdrawn_good();

                    //GRADUATED
                    $cohort_d[6][3]['second_year'] = $first_year->get_graduated();
                    $cohort_d[6][4]['third_year'] = $second_year->get_graduated();
                }

                $this->set_cohort_a($cohort_a);
                $this->set_cohort_b($cohort_b);
                $this->set_cohort_c($cohort_c);
                $this->set_cohort_d($cohort_d);

                $this->set_cohort_a($cohort_a);
                $this->set_cohort_b($cohort_b);
                $this->set_cohort_c($cohort_c);
                $this->set_cohort_d($cohort_d);
            }
            $this->save();
        }
    }

}
