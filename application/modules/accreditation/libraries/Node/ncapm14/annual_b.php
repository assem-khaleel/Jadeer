<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncapm14;

/**
 * Description of Annual_B
 *
 * @author user
 */
class Annual_B extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'B. Statistical Information';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_num_of_students_started_program('');
            $this->set_num_of_students_completed_program();
            $this->set_info('');
            $this->set_major_tracks_completed();
            $this->set_major_tracks(array());
            $this->set_early_exit_point('');
            $this->set_info3();
            $this->set_percentage_students_completed('');
            $this->set_percentage_completed();
            $this->set_percentage_students_completed_intermediate('');
            $this->set_percentage_completed_intermediate();
            $this->set_comment('');
            $this->set_info4();
            $this->set_cohort_a(array());
            $this->set_cohort_b(array());
            $this->set_cohort_c(array());
            $this->set_cohort_d(array());
            $this->set_info_table();
            $this->set_info7();
            $this->set_date_of_survey('');
            $this->set_number_surveyed('');
            $this->set_number_responded('');
            $this->set_response_rate('');
            $this->set_destination_of_graduates(array());
            $this->set_list_strengths('');
    }

    public function set_num_of_students_started_program($value)
    {
        $property = new \Orm_Property_Text('num_of_students_started_program', $value);
        $property->set_description('1. Number of students who started the program in the year concerned:');
        $this->set_property($property);
    }

    public function get_num_of_students_started_program()
    {
        return $this->get_property('num_of_students_started_program')->get_value();
    }

    public function set_num_of_students_completed_program()
    {
        $property = new \Orm_Property_Fixedtext('num_of_students_completed_program', '<strong>2. (a) Number of students who completed the program in the year concerned:</strong>');
        $property->set_group('student_complete');
        $this->set_property($property);
    }

    public function get_num_of_students_completed_program()
    {
        return $this->get_property('num_of_students_completed_program')->get_value();
    }

    public function set_info($value)
    {
        $property = new \Orm_Property_Text('info', $value);
        $property->set_description('Completed the final year of the program:');
        $property->set_group('student_complete');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_major_tracks_completed()
    {
        $property = new \Orm_Property_Fixedtext('major_tracks_completed', '<strong>Completed major tracks within the program (if applicable)</strong>');
        $property->set_group('student_complete');
        $this->set_property($property);
    }

    public function get_major_tracks_completed()
    {
        return $this->get_property('major_tracks_completed')->get_value();
    }

    public function set_major_tracks($value)
    {
        $property = new \Orm_Property_Table_Dynamic('major_tracks', $value);

        $title = new \Orm_Property_Text('title');
        $title->set_description('Title');
        $property->add_property($title);

        $no = new \Orm_Property_Text('no');
        $no->set_description('NO:');
        $property->add_property($no);
        $property->set_group('student_complete');
        $this->set_property($property);
    }

    public function get_major_tracks()
    {
        return $this->get_property('major_tracks')->get_value();
    }

    public function set_early_exit_point($value)
    {
        $property = new \Orm_Property_Text('early_exit_point', $value);
        $property->set_description('2. (b) Completed an intermediate award specified as an early exit point  (if any)');
        $property->set_group('student_complete');
        $this->set_property($property);
    }

    public function get_early_exit_point()
    {
        return $this->get_property('early_exit_point')->get_value();
    }

    public function set_info3()
    {
        $property = new \Orm_Property_Fixedtext('info3', '3. Apparent completion rate.');
        $property->set_group('question_3');
        $this->set_property($property);
    }

    public function get_info3()
    {
        return $this->get_property('info3')->get_value();
    }

    public function set_percentage_students_completed($value)
    {
        $property = new \Orm_Property_Percentage('percentage_students_completed', $value);
        $property->set_description("(a)  Percentage of students who completed the program,");
        $property->set_group('question_3');
        $this->set_property($property);
    }

    public function get_percentage_students_completed()
    {
        return $this->get_property('percentage_students_completed')->get_value();
    }

    public function set_percentage_completed()
    {
        $property = new \Orm_Property_Fixedtext('percentage_completed', '(Number shown in 2 (a) as a percentage of the number that started the program in that student intake.)');
        $property->set_group('question_3');
        $this->set_property($property);
    }

    public function get_percentage_completed()
    {
        return $this->get_property('percentage_completed')->get_value();
    }

    public function set_percentage_students_completed_intermediate($value)
    {
        $property = new \Orm_Property_Percentage('percentage_students_completed_intermediate', $value);
        $property->set_description("(b)  Percentage of students who completed an intermediate award (if any)(e.g. Associate degree within a bachelor degree program)");
        $property->set_group('question_3');
        $this->set_property($property);
    }

    public function get_percentage_students_completed_intermediate()
    {
        return $this->get_property('percentage_students_completed_intermediate')->get_value();
    }

    public function set_percentage_completed_intermediate()
    {
        $property = new \Orm_Property_Fixedtext('percentage_completed_intermediate', '(Number shown in 2 (b) as a percentage of the number that started the program leading to that award in that student intake).');
        $property->set_group('question_3');
        $this->set_property($property);
    }

    public function get_percentage_completed_intermediate()
    {
        return $this->get_property('percentage_completed_intermediate')->get_value();
    }

    public function set_comment($value)
    {
        $property = new \Orm_Property_Textarea('comment', $value);
        $property->set_description('Comment on any special or unusual factors that might have affected the apparent completion rates (e.g. Transfers between intermediate and full program, transfers to or from other programs).');
        $property->set_group('question_3');
        $this->set_property($property);
    }

    public function get_comment()
    {
        return $this->get_property('comment')->get_value();
    }

    public function set_info4()
    {
        $property = new \Orm_Property_Fixedtext('info4', '4. Enrollment Management and Cohort Analysis (Table 1) <br/> <br/>'
            . '<strong>Cohort Analysis</strong> refers to tracking a specific group of students who begin a given year in a program and following them until they graduate (How many students actually start a program and stay in the program until completion). <br/> <br/> '
            . 'A <strong>cohort</strong> here refers to the total number of students enrolled in the program at the beginning of each academic year, immediately after the preparatory year. No new students may be added or transfer into a given cohort. Any students that withdraw from a cohort may not return or be added again to the cohort. <br/> <br/> '
            . '<strong>Cohort Analysis </strong> (Illustration): <strong>Table 1 </strong>provides complete tracking information for the most recent cohort to complete the program, beginning with their first year and tracking them until graduation (students that withdraw are subtracted and no new students are added). The report is to cover the past four years. Update the years as needed <br/> <br/>'
            . '<strong>Enrollment Management and Cohort Analysis (Table 1)</strong>');
        $property->set_group('question_4');
        $this->set_property($property);
    }

    public function get_info4()
    {
        return $this->get_property('info4')->get_value();
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
        $property->set_description('A. Provide an analysis for the cohort that started PYP on ' . ($year - 6) . '-' . substr($year - 5, 2, 2));
        $property->set_group('question_4');

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

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('withdrawn_during', 'Withdrawn during the year and re-enrolled the following year'));
        $property->add_cell(4, 2, $first_year);
        $property->add_cell(4, 3, $second_year);
        $property->add_cell(4, 4, $third_year);
        $property->add_cell(4, 5, $fourth_year);
        $property->add_cell(4, 6, $fifth_year);
        $property->add_cell(4, 7, $sixth_year);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('withdrawn_for_good', 'Withdrawn for good'));
        $property->add_cell(5, 2, $first_year);
        $property->add_cell(5, 3, $second_year);
        $property->add_cell(5, 4, $third_year);
        $property->add_cell(5, 5, $fourth_year);
        $property->add_cell(5, 6, $fifth_year);
        $property->add_cell(5, 7, $sixth_year);

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('graduated_successfully', 'Graduated successfully'));
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
        $property->set_description('B. Provide an analysis for the cohort that started PYP on ' . ($year - 5) . '-' . substr($year - 4, 2, 2));
        $property->set_group('question_4');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('student_category', '<strong>Student Category</strong>'));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('first_year', '<strong>' . ($year - 5) . '-' . substr($year - 4, 2, 2) . '</strong>'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('second_year', '<strong>' . ($year - 4) . '-' . substr($year - 3, 2, 2) . '</strong>'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('third_year', '<strong>' . ($year - 3) . '-' . substr($year - 2, 2, 2) . '</strong>'));
        $property->add_cell(1, 5, new \Orm_Property_Fixedtext('forth_year', '<strong>' . ($year - 2) . '-' . substr($year - 1, 2, 2) . '</strong>'));
        $property->add_cell(1, 6, new \Orm_Property_Fixedtext('fivth_year', '<strong>' . ($year - 1) . '-' . substr($year, 2, 2) . '</strong>'));

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

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('withdrawn_during', 'Withdrawn during the year and re-enrolled the following year'));
        $property->add_cell(4, 2, $first_year);
        $property->add_cell(4, 3, $second_year);
        $property->add_cell(4, 4, $third_year);
        $property->add_cell(4, 5, $fourth_year);
        $property->add_cell(4, 6, $fifth_year);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('withdrawn_for_good', 'Withdrawn for good'));
        $property->add_cell(5, 2, $first_year);
        $property->add_cell(5, 3, $second_year);
        $property->add_cell(5, 4, $third_year);
        $property->add_cell(5, 5, $fourth_year);
        $property->add_cell(5, 6, $fifth_year);

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('graduated_successfully', 'Graduated successfully'));
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

    public function set_cohort_c($value)
    {
        $first_year = new \Orm_Property_Text('first_year');
        $first_year->set_placeholder('*PYP');
        $second_year = new \Orm_Property_Text('second_year');
        $third_year = new \Orm_Property_Text('third_year');
        $fourth_year = new \Orm_Property_Text('fourth_year');

        $year = $this->get_year();

        $property = new \Orm_Property_Table('cohort_c', $value);
        $property->set_description('C. Provide an analysis for the cohort that started PYP on ' . ($year - 4) . '-' . substr($year - 3, 2, 2));
        $property->set_group('question_4');

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

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('withdrawn_during', 'Withdrawn during the year and re-enrolled the following year'));
        $property->add_cell(4, 2, $first_year);
        $property->add_cell(4, 3, $second_year);
        $property->add_cell(4, 4, $third_year);
        $property->add_cell(4, 5, $fourth_year);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('withdrawn_for_good', 'Withdrawn for good'));
        $property->add_cell(5, 2, $first_year);
        $property->add_cell(5, 3, $second_year);
        $property->add_cell(5, 4, $third_year);
        $property->add_cell(5, 5, $fourth_year);

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('graduated_successfully', 'Graduated successfully'));
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

    public function set_cohort_d($value)
    {
        $first_year = new \Orm_Property_Text('first_year');
        $first_year->set_placeholder('*PYP');
        $second_year = new \Orm_Property_Text('second_year');
        $third_year = new \Orm_Property_Text('third_year');

        $year = $this->get_year();

        $property = new \Orm_Property_Table('cohort_d', $value);
        $property->set_description('D. Provide an analysis for the cohort that started PYP on ' . ($year - 3) . '-' . substr($year - 2, 2, 2));
        $property->set_group('question_4');

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

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('withdrawn_during', 'Withdrawn during the year and re-enrolled the following year'));
        $property->add_cell(4, 2, $first_year);
        $property->add_cell(4, 3, $second_year);
        $property->add_cell(4, 4, $third_year);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('withdrawn_for_good', 'Withdrawn for good'));
        $property->add_cell(5, 2, $first_year);
        $property->add_cell(5, 3, $second_year);
        $property->add_cell(5, 4, $third_year);

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('graduated_successfully', 'Graduated successfully'));
        $property->add_cell(6, 2, $first_year);
        $property->add_cell(6, 3, $second_year);
        $property->add_cell(6, 4, $third_year);

        $this->set_property($property);
    }

    public function get_cohort_d()
    {
        return $this->get_property('cohort_d')->get_value();
    }

    public function set_info_table()
    {
        $property = new \Orm_Property_Fixedtext('info_table', '<strong>* PYP  - Preparatory Year Program</strong>');
        $property->set_group('question_4');
        $this->set_property($property);
    }

    public function get_info_table()
    {
        return $this->get_property('info_table')->get_value();
    }

    public function set_info7()
    {
        $property = new \Orm_Property_Fixedtext('info7', '7. Destination of graduates as shown in survey of graduating students (Include this information in years in which a survey of employment outcomes for graduating students is conducted).');
        $property->set_group('question_7');
        $this->set_property($property);
    }

    public function get_info7()
    {
        return $this->get_property('info7')->get_value();
    }

    public function set_date_of_survey($value)
    {
        $property = new \Orm_Property_Text('date_of_survey', $value);
        $property->set_description('Date of Survey');
        $property->set_group('question_7');
        $this->set_property($property);
    }

    public function get_date_of_survey()
    {
        return $this->get_property('date_of_survey')->get_value();
    }

    public function set_number_surveyed($value)
    {
        $property = new \Orm_Property_Text('number_surveyed', $value);
        $property->set_description('Number Surveyed');
        $property->set_group('question_7');
        $this->set_property($property);
    }

    public function get_number_surveyed()
    {
        return $this->get_property('number_surveyed')->get_value();
    }

    public function set_number_responded($value)
    {
        $property = new \Orm_Property_Text('number_responded', $value);
        $property->set_description('Number Responded');
        $property->set_group('question_7');
        $this->set_property($property);
    }

    public function get_number_responded()
    {
        return $this->get_property('number_responded')->get_value();
    }

    public function set_response_rate($value)
    {
        $property = new \Orm_Property_Percentage('response_rate', $value);
        $property->set_description('Response Rate %');
        $property->set_group('question_7');
        $this->set_property($property);
    }

    public function get_response_rate()
    {
        return $this->get_property('response_rate')->get_value();
    }

    public function set_destination_of_graduates($value)
    {
        $number = new \Orm_Property_Text('number');
        $percents = new \Orm_Property_Percentage('percents');

        $property = new \Orm_Property_Table('destination_of_graduates', $value);
        $property->set_group('question_7');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('destination', 'Destination'), 2, 0);
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('not_available', 'Not Available for Employment'), 0, 2);
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('available_for_employment', 'Available for Employment'), 0, 3);

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('further_study', 'Further Study'));
        $property->add_cell(2, 2, new \Orm_Property_Fixedtext('other_reasons', 'Other Reasons'));
        $property->add_cell(2, 3, new \Orm_Property_Fixedtext('employed_in_subject', 'Employed in Subject Field'));
        $property->add_cell(2, 4, new \Orm_Property_Fixedtext('other_employment', 'Other Employment'));
        $property->add_cell(2, 5, new \Orm_Property_Fixedtext('unemployed', 'Unemployed'));

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('number', 'Number'));
        $property->add_cell(3, 2, $number);
        $property->add_cell(3, 3, $number);
        $property->add_cell(3, 4, $number);
        $property->add_cell(3, 5, $number);
        $property->add_cell(3, 6, $number);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('percent_of_respondents', 'Percent of Respondents'));
        $property->add_cell(4, 2, $percents);
        $property->add_cell(4, 3, $percents);
        $property->add_cell(4, 4, $percents);
        $property->add_cell(4, 5, $percents);
        $property->add_cell(4, 6, $percents);

        $this->set_property($property);
    }

    public function get_destination_of_graduates()
    {
        return $this->get_property('destination_of_graduates')->get_value();
    }

    public function set_list_strengths($value)
    {
        $property = new \Orm_Property_Textarea('list_strengths', $value);
        $property->set_description('Analysis:  List the strengths and recommendations');
        $property->set_group('question_7');
        $this->set_property($property);
    }

    public function get_list_strengths()
    {
        return $this->get_property('list_strengths')->get_value();
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

                $this->set_num_of_students_started_program(\Orm_Data_Graduate::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year()),'enrolled'));
                $this->set_info(\Orm_Data_Graduate::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year()),'graduate'));

                $numbers = array();
                foreach ($program_obj->get_majors() as $major) {
                    $numbers[] = array(
                        'title' => $major->get_name('english'),
                        'no' => \Orm_Data_Graduate::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year(),'major' => $major->get_id()),'graduate')
                    );
                }
                $this->set_major_tracks($numbers);

                $percentage = \Orm_Data_Graduate::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year()),'enrolled') ? \Orm_Data_Graduate::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year()),'graduate') / \Orm_Data_Graduate::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year()),'enrolled') * 100 : 0;

                $this->set_percentage_students_completed($percentage);

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

                $starting_year = $this->get_year() - $duration + 4;

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

                $starting_year = $this->get_year() - $duration + 5;

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

                if (\License::get_instance()->check_module('survey') && \Modules::load('survey')) {
                    /** @var \Orm_User_Alumni[] $alumni */
                    $alumni = \Orm_User_Alumni::get_all(array('program_id' => $program_obj->get_id()));
                    $responded = 0;
                    $further_study = 0;
                    $other_reason = 0;
                    $employed = 0;
                    $unemployed = 0;
                    $surveyed = count($alumni);
                    $date = '';


                    foreach ($alumni as $item)
                    {
                        $alumni_evaluation = \Orm_Survey_Evaluator::get_one(array('user_id' => $item->get_id(),'semester_id' => \Orm_Semester::get_active_semester()->get_id()));
                        $date = $alumni_evaluation->get_survey_evaluation_obj();
                        if ($alumni_evaluation->get_response_status())
                        {
                            $responded++;
                            if ($item->get_job_status() == \Orm_User_Alumni::JOB_STATUS_CONTINUING)
                            {
                                $further_study++;
                            }
                            elseif ($item->get_job_status() == \Orm_User_Alumni::JOB_STATUS_LOOKING)
                            {
                                $unemployed++;
                                $other_reason++;
                            }
                            else
                            {
                                $employed++;
                                $other_reason++;
                            }
                        }
                    }
                    $this->set_number_surveyed($surveyed);
                    $this->set_number_responded($responded);
                    $this->set_response_rate($surveyed ? ($responded / $surveyed * 100) : 0);

                    if ($date)
                    {
                        $this->set_date_of_survey($date);
                    }

                    $table = $this->get_destination_of_graduates();

                    $table[3][2]['number'] = $further_study;
                    $table[3][3]['number'] = $other_reason;
                    $table[3][4]['number'] = $employed;
                    $table[3][5]['number'] = 0;
                    $table[3][6]['number'] = $unemployed;

                    $table[3][2]['number'] = $responded ? $further_study / $responded * 100 : 0;
                    $table[3][3]['number'] = 0;
                    $table[3][4]['number'] = $responded ? $employed / $responded * 100 : 0;
                    $table[3][5]['number'] = 0;
                    $table[3][6]['number'] = $responded ? $unemployed / $responded * 100 : 0;

                    $this->set_destination_of_graduates($table);
                }
            }

            $this->save();
        }
    }
}
