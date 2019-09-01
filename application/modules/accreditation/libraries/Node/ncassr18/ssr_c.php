<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ssr_c
 *
 * @author duaa
 */
class Ssr_C extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'C. Program Profile analysis Information';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

        $this->set_note();

        /* Student Enrollment */
        $this->set_student_enrollment(array());
        /* End Student Enrollment */

        /* PHD Faculty */
        $this->set_phd_faculty(array());
        /* End PHD Faculty */

        /* Faculty and Student  Ratio */
        $this->set_faculty(array());
        $this->set_faculty_note();
        /* End Faculty and Student  Ratio*/

        /* faculty_ratio & Teaching Staff */
        $this->set_faculty_ratio(array());
        /* End PHD Faculty */

        /* Student Completion Rate */
        $this->set_completion_rate();
        $this->set_male_std(array());
        $this->set_female_std(array());
        /* End Student Completion Rate */

        /* Graduates */
        $this->set_graduate(array());
        /* End Graduates */

        /* Mode of Instruction*/
        $this->set_moi(array());
        /* End Mode of Instruction*/

    }

    public function set_note()
    {
        $property = new \Orm_Property_Fixedtext('note', '<strong>FOR ALL ANALYSIS SECTIONS A SEPARATE TABLE MUST BE USED FOR EACH BRANCH/LOCATION CAMPUS.</strong><br/><br/>'
            . 'Program profile information and data require analysis and projections that provide predictive knowledge. By anticipating and projecting future information and data, quality improvement can be sustained through appropriate interventions and action plans.');
        $this->set_property($property);

    }

    public function get_note()
    {
        return $this->get_property('note')->get_value();
    }

    /* Student Enrollment */
    public function set_student_enrollment($value)
    {
        $year = $this->get_year();
        $two_year_ago = new \Orm_Property_Text('two_year_ago');
        $one_year_ago = new \Orm_Property_Text('one_year_ago');
        $current = new \Orm_Property_Text('current');
        $next_year = new \Orm_Property_Text('next_year');
        $two_year_later = new \Orm_Property_Text('two_year_later');
        $three_year_later = new \Orm_Property_Text('three_year_later');

        $property = new \Orm_Property_Add_More('student_enrollment', $value);
        $property->set_description('1. Student Enrollment Analysis and Projections');

        $campus = new \Orm_Property_Text('campus');
        $campus->set_description('Campus');
        $property->add_property($campus);


        $table = new \Orm_Property_Table('table');

        $table->add_cell(1, 1, new \Orm_Property_Fixedtext('', ''));
        $table->add_cell(1, 2, new \Orm_Property_Fixedtext('two_year', $year - 2));
        $table->add_cell(1, 3, new \Orm_Property_Fixedtext('one_year', $year - 1));
        $table->add_cell(1, 4, new \Orm_Property_Fixedtext('current_year', $year));
        $table->add_cell(1, 5, new \Orm_Property_Fixedtext('year_one', $year + 1));
        $table->add_cell(1, 6, new \Orm_Property_Fixedtext('year_two', $year + 2));
        $table->add_cell(1, 7, new \Orm_Property_Fixedtext('year_three', $year + 3));

        $table->add_cell(2, 1, new \Orm_Property_Fixedtext('total', 'Total Enrolment'));
        $table->add_cell(2, 2, $two_year_ago);
        $table->add_cell(2, 3, $one_year_ago);
        $table->add_cell(2, 4, $current);
        $table->add_cell(2, 5, $next_year);
        $table->add_cell(2, 6, $two_year_later);
        $table->add_cell(2, 7, $three_year_later);

        $property->add_property($table);



        $strength = new \Orm_Property_Textarea('strength');
        $strength->set_description('Strengths');
        $property->add_property($strength);

        $recommendation = new \Orm_Property_Textarea('recommendation');
        $recommendation->set_description('Recommendations for Improvement');
        $property->add_property($recommendation);

        $predictions = new \Orm_Property_Textarea('predictions');
        $predictions->set_description('Predictions');
        $property->add_property($predictions);

        $interventions= new \Orm_Property_Textarea('interventions');
        $interventions->set_description('Interventions');
        $property->add_property($interventions);

        $action = new \Orm_Property_Textarea('action');
        $action->set_description('Action Plans');
        $property->add_property($action);

        $this->set_property($property);

    }

    public function get_student_enrollment()
    {
        return $this->get_property('student_enrollment')->get_value();
    }

    /* End Student Enrollment */

    /* PhD Faculty */
    public function set_phd_faculty($value)
    {

        $year = $this->get_year();
        $two_year_ago = new \Orm_Property_Text('two_year_ago');
        $one_year_ago = new \Orm_Property_Text('one_year_ago');
        $current = new \Orm_Property_Text('current');
        $next_year = new \Orm_Property_Text('next_year');
        $two_year_later = new \Orm_Property_Text('two_year_later');
        $three_year_later = new \Orm_Property_Text('three_year_later');

        $property = new \Orm_Property_Add_More('phd_faculty', $value);
        $property->set_description('2. PhD Faculty Analysis and Projections');

        $campus = new \Orm_Property_Text('campus');
        $campus->set_description('Campus');
        $property->add_property($campus);

        $table = new \Orm_Property_Table('table');

        $table->add_cell(1, 1, new \Orm_Property_Fixedtext('', ''));
        $table->add_cell(1, 2, new \Orm_Property_Fixedtext('two_year', $year - 2));
        $table->add_cell(1, 3, new \Orm_Property_Fixedtext('one_year', $year - 1));
        $table->add_cell(1, 4, new \Orm_Property_Fixedtext('current_year', $year));
        $table->add_cell(1, 5, new \Orm_Property_Fixedtext('year_one', $year + 1));
        $table->add_cell(1, 6, new \Orm_Property_Fixedtext('year_two', $year + 2));
        $table->add_cell(1, 7, new \Orm_Property_Fixedtext('year_three', $year + 3));

        $table->add_cell(2, 1, new \Orm_Property_Fixedtext('total', 'Total PhD Faculty'));
        $table->add_cell(2, 2, $two_year_ago);
        $table->add_cell(2, 3, $one_year_ago);
        $table->add_cell(2, 4, $current);
        $table->add_cell(2, 5, $next_year);
        $table->add_cell(2, 6, $two_year_later);
        $table->add_cell(2, 7, $three_year_later);

        $property->add_property($table);
//
        $strength = new \Orm_Property_Textarea('strength');
        $strength->set_description('Strengths');
        $property->add_property($strength);

        $recommendation = new \Orm_Property_Textarea('recommendation');
        $recommendation->set_description('Recommendations for Improvement');
        $property->add_property($recommendation);

        $predictions = new \Orm_Property_Textarea('predictions');
        $predictions->set_description('Predictions');
        $property->add_property($predictions);

        $interventions= new \Orm_Property_Textarea('interventions');
        $interventions->set_description('Interventions');
        $property->add_property($interventions);

        $action = new \Orm_Property_Textarea('action');
        $action->set_description('Action Plans');
        $property->add_property($action);

        $this->set_property($property);

    }

    public function get_phd_faculty()
    {
        return $this->get_property('phd_faculty')->get_value();
    }

    /* End PhD Faculty */


    /* Faculty  and teachnig staff */
    public function set_faculty($value)
    {

        $year = $this->get_year();

        $two_year_ago = new \Orm_Property_Text('two_year_ago');
        $one_year_ago = new \Orm_Property_Text('one_year_ago');
        $current = new \Orm_Property_Text('current');
        $next_year = new \Orm_Property_Text('next_year');
        $two_year_later = new \Orm_Property_Text('two_year_later');
        $three_year_later = new \Orm_Property_Text('three_year_later');

        $property = new \Orm_Property_Add_More('faculty', $value);
        $property->set_description('3. Faculty Teaching Analysis and Projections (Calculate the average number of credit hours taught by the full-time faculty and calculate the average number of students enrolled per class taught)');


        $campus = new \Orm_Property_Text('campus');
        $campus->set_description('Campus');
        $property->add_property($campus);


        $table = new \Orm_Property_Table('table');

        $table->add_cell(1, 1, new \Orm_Property_Fixedtext('', ''));
        $table->add_cell(1, 2, new \Orm_Property_Fixedtext('two_year', $year - 2));
        $table->add_cell(1, 3, new \Orm_Property_Fixedtext('one_year', $year - 1));
        $table->add_cell(1, 4, new \Orm_Property_Fixedtext('current_year', $year));
        $table->add_cell(1, 5, new \Orm_Property_Fixedtext('year_one', $year + 1));
        $table->add_cell(1, 6, new \Orm_Property_Fixedtext('year_two', $year + 2));
        $table->add_cell(1, 7, new \Orm_Property_Fixedtext('year_three', $year + 3));

        $table->add_cell(2, 1, new \Orm_Property_Fixedtext('avg_class_size', 'Average Class Size'));
        $table->add_cell(2, 2, $two_year_ago);
        $table->add_cell(2, 3, $one_year_ago);
        $table->add_cell(2, 4, $current);
        $table->add_cell(2, 5, $next_year);
        $table->add_cell(2, 6, $two_year_later);
        $table->add_cell(2, 7, $three_year_later);

        $table->add_cell(3, 1, new \Orm_Property_Fixedtext('avg_teaching_load', 'Average Teaching Load'));
        $table->add_cell(3, 2, $two_year_ago);
        $table->add_cell(3, 3, $one_year_ago);
        $table->add_cell(3, 4, $current);
        $table->add_cell(3, 5, $next_year);
        $table->add_cell(3, 6, $two_year_later);
        $table->add_cell(3, 7, $three_year_later);
        $property->add_property($table);


        $strength = new \Orm_Property_Textarea('strength');
        $strength->set_description('Strengths');
        $property->add_property($strength);

        $recommendation = new \Orm_Property_Textarea('recommendation');
        $recommendation->set_description('Recommendations for Improvement');
        $property->add_property($recommendation);

        $predictions = new \Orm_Property_Textarea('predictions');
        $predictions->set_description('Predictions');
        $property->add_property($predictions);

        $interventions= new \Orm_Property_Textarea('interventions');
        $interventions->set_description('Interventions');
        $property->add_property($interventions);

        $action = new \Orm_Property_Textarea('action');
        $action->set_description('Action Plans');
        $property->add_property($action);

        $this->set_property($property);

    }

    public function get_faculty()
    {
        return $this->get_property('faculty')->get_value();
    }

    public function set_faculty_note()
    {
        $property = new \Orm_Property_Fixedtext('faculty_note', '<strong>Average Credit Workload </strong> – Add the total number of credit hours taught by each individual teaching faculty member, add them all together, and divide by the full-time or part-time number of faculty members.<br/>'
            . '<strong>Average Class Enrollment</strong> – Add the total number of students enrolled in all of the classes taught by each individual teaching faculty member and divide the total by the number of classes taught. Add all the totals together and divide by the total number of faculty members.');
        $this->set_property($property);

    }

    public function get_faculty_note()
    {
        return $this->get_property('faculty_note')->get_value();
    }
    /* End Faculty  and teachnig staff */


    /* Faculty and Student  Ratio*/
    public function set_faculty_ratio($value)
    {

        $year = $this->get_year();
        $two_year_ago = new \Orm_Property_Text('two_year_ago');
        $one_year_ago = new \Orm_Property_Text('one_year_ago');
        $current = new \Orm_Property_Text('current');
        $next_year = new \Orm_Property_Text('next_year');
        $two_year_later = new \Orm_Property_Text('two_year_later');
        $three_year_later = new \Orm_Property_Text('three_year_later');


        $property = new \Orm_Property_Add_More('faculty_ratio', $value);
        $property->set_description('4. Faculty to Student Ratio Analysis and Projections');


        $campus = new \Orm_Property_Text('campus');
        $campus->set_description('Campus');
        $property->add_property($campus);


        $table = new \Orm_Property_Table('table');

        $table->add_cell(1, 1, new \Orm_Property_Fixedtext('', ''));
        $table->add_cell(1, 2, new \Orm_Property_Fixedtext('two_year', $year - 2));
        $table->add_cell(1, 3, new \Orm_Property_Fixedtext('one_year', $year - 1));
        $table->add_cell(1, 4, new \Orm_Property_Fixedtext('current_year', $year));
        $table->add_cell(1, 5, new \Orm_Property_Fixedtext('year_one', $year + 1));
        $table->add_cell(1, 6, new \Orm_Property_Fixedtext('year_two', $year + 2));
        $table->add_cell(1, 7, new \Orm_Property_Fixedtext('year_three', $year + 3));


        $table->add_cell(2, 1, new \Orm_Property_Fixedtext('phd_per_std', 'PhD per Student'));
        $table->add_cell(2, 2, $two_year_ago);
        $table->add_cell(2, 3, $one_year_ago);
        $table->add_cell(2, 4, $current);
        $table->add_cell(2, 5, $next_year);
        $table->add_cell(2, 6, $two_year_later);
        $table->add_cell(2, 7, $three_year_later);

        $table->add_cell(3, 1, new \Orm_Property_Fixedtext('male_std', 'Male Student to Faculty'));
        $table->add_cell(3, 2, $two_year_ago);
        $table->add_cell(3, 3, $one_year_ago);
        $table->add_cell(3, 4, $current);
        $table->add_cell(3, 5, $next_year);
        $table->add_cell(3, 6, $two_year_later);
        $table->add_cell(3, 7, $three_year_later);


        $table->add_cell(4, 1, new \Orm_Property_Fixedtext('female_std', 'Female Student to Faculty'));
        $table->add_cell(4, 2, $two_year_ago);
        $table->add_cell(4, 3, $one_year_ago);
        $table->add_cell(4, 4, $current);
        $table->add_cell(4, 5, $next_year);
        $table->add_cell(4, 6, $two_year_later);
        $table->add_cell(4, 7, $three_year_later);

        $table->add_cell(5, 1, new \Orm_Property_Fixedtext('total_std', 'Total Student to Faculty'));
        $table->add_cell(5, 2, $two_year_ago);
        $table->add_cell(5, 3, $one_year_ago);
        $table->add_cell(5, 4, $current);
        $table->add_cell(5, 5, $next_year);
        $table->add_cell(5, 6, $two_year_later);
        $table->add_cell(5, 7, $three_year_later);

        $property->add_property($table);


        $strength = new \Orm_Property_Textarea('strength');
        $strength->set_description('Strengths');
        $property->add_property($strength);

        $recommendation = new \Orm_Property_Textarea('recommendation');
        $recommendation->set_description('Recommendations for Improvement');
        $property->add_property($recommendation);

        $predictions = new \Orm_Property_Textarea('predictions');
        $predictions->set_description('Predictions');
        $property->add_property($predictions);

        $interventions= new \Orm_Property_Textarea('interventions');
        $interventions->set_description('Interventions');
        $property->add_property($interventions);

        $action = new \Orm_Property_Textarea('action');
        $action->set_description('Action Plans');
        $property->add_property($action);

        $this->set_property($property);

    }

    public function get_faculty_ratio()
    {
        return $this->get_property('faculty_ratio')->get_value();
    }


    /* End Faculty and Student  Ratio */

    /* Student Completion Rate */

    public function set_completion_rate()
    {
        $property = new \Orm_Property_Fixedtext('completion_rate', '<strong>5. Apparent Student Completion Rate/Graduation Rate Analysis and Projections <br/><br/>Apparent Student Completion Rate:  </strong>The number of students who graduated in the most recent year as a percentage of those who commenced those programs in that cohort four, five, or six years previously (e.g. for a four year program the number of students who graduated as a percentage who commenced the program four years previously)');

        $this->set_property($property);

    }

    public function get_complition_rate()
    {
        return $this->get_property('completion_rate')->get_value();
    }

    public function set_male_std($value)
    {

        $year = $this->get_year();

        $property = new \Orm_Property_Add_More('male_std', $value);
        $property->set_description('Male students');
        $property->set_group('completion_rate');

        $campus = new \Orm_Property_Text('campus');
        $campus->set_description('Campus');
        $property->add_property($campus);


        $four_year_ago = new \Orm_Property_Text('four_year_ago');
        $three_year_ago = new \Orm_Property_Text('three_year_ago');
        $two_year_ago = new \Orm_Property_Text('two_year_ago');
        $past_year = new \Orm_Property_Text('past_year');
        $current = new \Orm_Property_Text('current');

        $table = new \Orm_Property_Table('table');

        $table->add_cell(1, 1, new \Orm_Property_Fixedtext('std', '<p style="text-align: right;">Graduation year</p><p style="text-align: left;">Students</p>'));
        $table->add_cell(1, 2, new \Orm_Property_Fixedtext('four', $year - 4));
        $table->add_cell(1, 3, new \Orm_Property_Fixedtext('three', $year - 3));
        $table->add_cell(1, 4, new \Orm_Property_Fixedtext('two', $year - 2));
        $table->add_cell(1, 5, new \Orm_Property_Fixedtext('one', $year - 1));
        $table->add_cell(1, 6, new \Orm_Property_Fixedtext('current', $year));

        $table->add_cell(2, 1, new \Orm_Property_Fixedtext('std_enrolled', 'Students enrolled 4, 5, or 6 years ago. (According to duration of the program)'));
        $table->add_cell(2, 2, $four_year_ago);
        $table->add_cell(2, 3, $three_year_ago);
        $table->add_cell(2, 4, $two_year_ago);
        $table->add_cell(2, 5, $past_year);
        $table->add_cell(2, 6, $current);

        $table->add_cell(3, 1, new \Orm_Property_Fixedtext('std_graduate', 'Number of students that graduated in the specified time.'));
        $table->add_cell(3, 2, $four_year_ago);
        $table->add_cell(3, 3, $three_year_ago);
        $table->add_cell(3, 4, $two_year_ago);
        $table->add_cell(3, 5, $past_year);
        $table->add_cell(3, 6, $current);

        $table->add_cell(4, 1, new \Orm_Property_Fixedtext('program_completion_rate', 'Apparent program completion rate'));
        $table->add_cell(4, 2, $four_year_ago);
        $table->add_cell(4, 3, $three_year_ago);
        $table->add_cell(4, 4, $two_year_ago);
        $table->add_cell(4, 5, $past_year);
        $table->add_cell(4, 6, $current);

        $property->add_property($table);


        $strength = new \Orm_Property_Textarea('strength');
        $strength->set_description('Strengths');
        $property->add_property($strength);

        $recommendation = new \Orm_Property_Textarea('recommendation');
        $recommendation->set_description('Recommendations for Improvement');
        $property->add_property($recommendation);

        $predictions = new \Orm_Property_Textarea('predictions');
        $predictions->set_description('Predictions');
        $property->add_property($predictions);

        $interventions= new \Orm_Property_Textarea('interventions');
        $interventions->set_description('Interventions');
        $property->add_property($interventions);

        $action = new \Orm_Property_Textarea('action');
        $action->set_description('Action Plans');
        $property->add_property($action);

        $this->set_property($property);
    }

    public function get_male_std()
    {
        return $this->get_property('male_std')->get_value();
    }

    public function set_female_std($value)
    {

        $year = $this->get_year();

        $four_year_ago = new \Orm_Property_Text('four_year_ago');
        $three_year_ago = new \Orm_Property_Text('three_year_ago');
        $two_year_ago = new \Orm_Property_Text('two_year_ago');
        $past_year = new \Orm_Property_Text('past_year');
        $current = new \Orm_Property_Text('current');

        $property = new \Orm_Property_Add_More('female_std', $value);
        $property->set_description('Female students');
        $property->set_group('completion_rate');

        $campus = new \Orm_Property_Text('campus');
        $campus->set_description('Campus');
        $property->add_property($campus);

        $table = new \Orm_Property_Table('table');

        $table->add_cell(1, 1, new \Orm_Property_Fixedtext('std', '<p style="text-align: right;">Graduation year</p><p style="text-align: left;">Students</p>'));
        $table->add_cell(1, 2, new \Orm_Property_Fixedtext('four', $year - 4));
        $table->add_cell(1, 3, new \Orm_Property_Fixedtext('three', $year - 3));
        $table->add_cell(1, 4, new \Orm_Property_Fixedtext('two', $year - 2));
        $table->add_cell(1, 5, new \Orm_Property_Fixedtext('one', $year - 1));
        $table->add_cell(1, 6, new \Orm_Property_Fixedtext('current', $year));

        $table->add_cell(2, 1, new \Orm_Property_Fixedtext('std_enrolled', 'Students enrolled 4, 5, or 6 years ago. (According to duration of the program)'));
        $table->add_cell(2, 2, $four_year_ago);
        $table->add_cell(2, 3, $three_year_ago);
        $table->add_cell(2, 4, $two_year_ago);
        $table->add_cell(2, 5, $past_year);
        $table->add_cell(2, 6, $current);

        $table->add_cell(3, 1, new \Orm_Property_Fixedtext('std_graduate', 'Number of students that graduated in the specified time.'));
        $table->add_cell(3, 2, $four_year_ago);
        $table->add_cell(3, 3, $three_year_ago);
        $table->add_cell(3, 4, $two_year_ago);
        $table->add_cell(3, 5, $past_year);
        $table->add_cell(3, 6, $current);

        $table->add_cell(4, 1, new \Orm_Property_Fixedtext('program_completion_rate', 'Apparent program completion rate'));
        $table->add_cell(4, 2, $four_year_ago);
        $table->add_cell(4, 3, $three_year_ago);
        $table->add_cell(4, 4, $two_year_ago);
        $table->add_cell(4, 5, $past_year);
        $table->add_cell(4, 6, $current);

        $property->add_property($table);

        $strength = new \Orm_Property_Textarea('strength');
        $strength->set_description('Strengths');
        $property->add_property($strength);

        $recommendation = new \Orm_Property_Textarea('recommendation');
        $recommendation->set_description('Recommendations for Improvement');
        $property->add_property($recommendation);

        $predictions = new \Orm_Property_Textarea('predictions');
        $predictions->set_description('Predictions');
        $property->add_property($predictions);

        $interventions= new \Orm_Property_Textarea('interventions');
        $interventions->set_description('Interventions');
        $property->add_property($interventions);

        $action = new \Orm_Property_Textarea('action');
        $action->set_description('Action Plans');
        $property->add_property($action);

        $this->set_property($property);

    }

    public function get_female_std()
    {
        return $this->get_property('female_std')->get_value();
    }


    /* End Student Completion Rate */

    /* Graduates*/
    public function set_graduate($value)
    {

        $year = $this->get_year();
        $two_year_ago = new \Orm_Property_Text('two_year_ago');
        $one_year_ago = new \Orm_Property_Text('one_year_ago');
        $current = new \Orm_Property_Text('current');
        $next_year = new \Orm_Property_Text('next_year');
        $two_year_later = new \Orm_Property_Text('two_year_later');
        $three_year_later = new \Orm_Property_Text('three_year_later');

        $property = new \Orm_Property_Add_More('graduate', $value);
        $property->set_description('6. Number of Graduates Analysis and Projections');

        $campus = new \Orm_Property_Text('campus');
        $campus->set_description('Campus');
        $property->add_property($campus);

        $table = new \Orm_Property_Table('table ');
        $table->add_cell(1, 1, new \Orm_Property_Fixedtext('', ''));
        $table->add_cell(1, 2, new \Orm_Property_Fixedtext('two_year', $year - 2));
        $table->add_cell(1, 3, new \Orm_Property_Fixedtext('one_year', $year - 1));
        $table->add_cell(1, 4, new \Orm_Property_Fixedtext('current_year', $year));
        $table->add_cell(1, 5, new \Orm_Property_Fixedtext('year_one', $year + 1));
        $table->add_cell(1, 6, new \Orm_Property_Fixedtext('year_two', $year + 2));
        $table->add_cell(1, 7, new \Orm_Property_Fixedtext('year_three', $year + 3));


        $table->add_cell(2, 1, new \Orm_Property_Fixedtext('diploma', 'Diploma'));
        $table->add_cell(2, 2, $two_year_ago);
        $table->add_cell(2, 3, $one_year_ago);
        $table->add_cell(2, 4, $current);
        $table->add_cell(2, 5, $next_year);
        $table->add_cell(2, 6, $two_year_later);
        $table->add_cell(2, 7, $three_year_later);

        $table->add_cell(3, 1, new \Orm_Property_Fixedtext('bachelor', 'Bachelor'));
        $table->add_cell(3, 2, $two_year_ago);
        $table->add_cell(3, 3, $one_year_ago);
        $table->add_cell(3, 4, $current);
        $table->add_cell(3, 5, $next_year);
        $table->add_cell(3, 6, $two_year_later);
        $table->add_cell(3, 7, $three_year_later);

        $table->add_cell(4, 1, new \Orm_Property_Fixedtext('high_diploma', 'Higher Diploma'));
        $table->add_cell(4, 2, $two_year_ago);
        $table->add_cell(4, 3, $one_year_ago);
        $table->add_cell(4, 4, $current);
        $table->add_cell(4, 5, $next_year);
        $table->add_cell(4, 6, $two_year_later);
        $table->add_cell(4, 7, $three_year_later);

        $table->add_cell(5, 1, new \Orm_Property_Fixedtext('master', 'Master'));
        $table->add_cell(5, 2, $two_year_ago);
        $table->add_cell(5, 3, $one_year_ago);
        $table->add_cell(5, 4, $current);
        $table->add_cell(5, 5, $next_year);
        $table->add_cell(5, 6, $two_year_later);
        $table->add_cell(5, 7, $three_year_later);

        $table->add_cell(5, 1, new \Orm_Property_Fixedtext('phd', 'Ph.D.'));
        $table->add_cell(5, 2, $two_year_ago);
        $table->add_cell(5, 3, $one_year_ago);
        $table->add_cell(5, 4, $current);
        $table->add_cell(5, 5, $next_year);
        $table->add_cell(5, 6, $two_year_later);
        $table->add_cell(5, 7, $three_year_later);

        $table->add_cell(5, 1, new \Orm_Property_Fixedtext('total', 'Total'));
        $table->add_cell(5, 2, $two_year_ago);
        $table->add_cell(5, 3, $one_year_ago);
        $table->add_cell(5, 4, $current);
        $table->add_cell(5, 5, $next_year);
        $table->add_cell(5, 6, $two_year_later);
        $table->add_cell(5, 7, $three_year_later);

        $property->add_property($table);

        $strength = new \Orm_Property_Textarea('strength');
        $strength->set_description('Strengths');
        $property->add_property($strength);

        $recommendation = new \Orm_Property_Textarea('recommendation');
        $recommendation->set_description('Recommendations for Improvement');
        $property->add_property($recommendation);

        $predictions = new \Orm_Property_Textarea('predictions');
        $predictions->set_description('Predictions');
        $property->add_property($predictions);

        $interventions= new \Orm_Property_Textarea('interventions');
        $interventions->set_description('Interventions');
        $property->add_property($interventions);

        $action = new \Orm_Property_Textarea('action');
        $action->set_description('Action Plans');
        $property->add_property($action);

        $this->set_property($property);


    }

    public function get_graduate()
    {
        return $this->get_property('graduate')->get_value();
    }


    /* End Graduates */


    /* Mode of Instruction*/
    public function set_moi($value)
    {

        $year = $this->get_year();
        $two_year_ago = new \Orm_Property_Text('two_year_ago');
        $one_year_ago = new \Orm_Property_Text('one_year_ago');
        $current = new \Orm_Property_Text('current');
        $next_year = new \Orm_Property_Text('next_year');
        $two_year_later = new \Orm_Property_Text('two_year_later');
        $three_year_later = new \Orm_Property_Text('three_year_later');

        $property = new \Orm_Property_Add_More('moi', $value);
        $property->set_description('7. Student Mode of Instruction Analysis and Projections');

        $campus = new \Orm_Property_Text('campus');
        $campus->set_description('Campus');
        $property->add_property($campus);

        $table = new \Orm_Property_Table('table');

        $table->add_cell(1, 1, new \Orm_Property_Fixedtext('', ''));
        $table->add_cell(1, 2, new \Orm_Property_Fixedtext('two_year', $year - 2));
        $table->add_cell(1, 3, new \Orm_Property_Fixedtext('one_year', $year - 1));
        $table->add_cell(1, 4, new \Orm_Property_Fixedtext('current_year', $year));
        $table->add_cell(1, 5, new \Orm_Property_Fixedtext('year_one', $year + 1));
        $table->add_cell(1, 6, new \Orm_Property_Fixedtext('year_two', $year + 2));
        $table->add_cell(1, 7, new \Orm_Property_Fixedtext('year_three', $year + 3));


        $table->add_cell(2, 1, new \Orm_Property_Fixedtext('on_campus_f', 'On Campus Female'));
        $table->add_cell(2, 2, $two_year_ago);
        $table->add_cell(2, 3, $one_year_ago);
        $table->add_cell(2, 4, $current);
        $table->add_cell(2, 5, $next_year);
        $table->add_cell(2, 6, $two_year_later);
        $table->add_cell(2, 7, $three_year_later);

        $table->add_cell(3, 1, new \Orm_Property_Fixedtext('distance_Education_f', 'Distance Education Female'));
        $table->add_cell(3, 2, $two_year_ago);
        $table->add_cell(3, 3, $one_year_ago);
        $table->add_cell(3, 4, $current);
        $table->add_cell(3, 5, $next_year);
        $table->add_cell(3, 6, $two_year_later);
        $table->add_cell(3, 7, $three_year_later);


        $table->add_cell(4, 1, new \Orm_Property_Fixedtext('on_campus_m', 'On Campus Male'));
        $table->add_cell(4, 2, $two_year_ago);
        $table->add_cell(4, 3, $one_year_ago);
        $table->add_cell(4, 4, $current);
        $table->add_cell(4, 5, $next_year);
        $table->add_cell(4, 6, $two_year_later);
        $table->add_cell(4, 7, $three_year_later);

        $table->add_cell(5, 1, new \Orm_Property_Fixedtext('distance_Education_m', 'Distance Education Male'));
        $table->add_cell(5, 2, $two_year_ago);
        $table->add_cell(5, 3, $one_year_ago);
        $table->add_cell(5, 4, $current);
        $table->add_cell(5, 5, $next_year);
        $table->add_cell(5, 6, $two_year_later);
        $table->add_cell(5, 7, $three_year_later);

        $table->add_cell(6, 1, new \Orm_Property_Fixedtext('on_campus_t', 'Total On Campus'));
        $table->add_cell(6, 2, $two_year_ago);
        $table->add_cell(6, 3, $one_year_ago);
        $table->add_cell(6, 4, $current);
        $table->add_cell(6, 5, $next_year);
        $table->add_cell(6, 6, $two_year_later);
        $table->add_cell(6, 7, $three_year_later);

        $table->add_cell(7, 1, new \Orm_Property_Fixedtext('distance_Education_t', 'Total Distance Education'));
        $table->add_cell(7, 2, $two_year_ago);
        $table->add_cell(7, 3, $one_year_ago);
        $table->add_cell(7, 4, $current);
        $table->add_cell(7, 5, $next_year);
        $table->add_cell(7, 6, $two_year_later);
        $table->add_cell(7, 7, $three_year_later);
        $property->add_property($table);

        $strength = new \Orm_Property_Textarea('strength');
        $strength->set_description('Strengths');
        $property->add_property($strength);

        $recommendation = new \Orm_Property_Textarea('recommendation');
        $recommendation->set_description('Recommendations for Improvement');
        $property->add_property($recommendation);

        $predictions = new \Orm_Property_Textarea('predictions');
        $predictions->set_description('Predictions');
        $property->add_property($predictions);

        $interventions= new \Orm_Property_Textarea('interventions');
        $interventions->set_description('Interventions');
        $property->add_property($interventions);

        $action = new \Orm_Property_Textarea('action');
        $action->set_description('Action Plans');
        $property->add_property($action);

        $this->set_property($property);

    }

    public function get_moi()
    {
        return $this->get_property('moi')->get_value();
    }

    /* End  Mode of Instruction */

}
