<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ssr_d
 *
 * @author duaa
 */
class Ssr_D extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'D. Program Profile Data';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            /* Historical Summary */
            $this->set_historical_summary_note();
            $this->set_historical_summary('');
            /* Foundation Program */
            $this->set_foundation_program_note();
            $this->set_foundation_program_offer('');
            $this->set_foundation_program_out_sourced('');
            $this->set_foundation_program('');
            $this->set_foundation_program_analysis('');
            $this->set_foundation_program_analysis_required('');
            $this->set_foundation_program_analysis_required_note();
            $this->set_foundation_program_course_list('');
            /* Statistical Summary */
            $this->set_statistical_summary_note();
            $this->set_student_enrollment(array());
            $this->set_statistical_summary_info();
            /* Confirmed enrollment */
            $this->set_confirmed_enrollment(array());
            /* Faculty */
            $this->set_faculty(array());
            $this->set_faculty_note();
            /* Faculty and Teaching Staff */
            $this->set_faculty_and_Teaching_staff(array());
            /* Average Faculty Workload */
            $this->set_average_faculty_workload_info();
            $this->set_average_faculty_workload_a(array());
            $this->set_average_faculty_workload_a_analysis();
            $this->set_average_faculty_workload_a_analysis_1('');
            $this->set_average_faculty_workload_a_analysis_2('');
            $this->set_average_faculty_workload_a_analysis_3('');
            $this->set_average_faculty_workload_a_analysis_notes();
            $this->set_average_faculty_workload_b(array());
            $this->set_average_faculty_workload_b_analysis();
            $this->set_average_faculty_workload_b_analysis_1('');
            $this->set_average_faculty_workload_b_analysis_2('');
            $this->set_average_faculty_workload_b_analysis_3('');
            $this->set_average_faculty_workload_c(array());
            $this->set_average_faculty_workload_c_analysis();
            $this->set_average_faculty_workload_c_analysis_1('');
            $this->set_average_faculty_workload_c_analysis_2('');
            $this->set_average_faculty_workload_c_analysis_3('');
            $this->set_average_faculty_workload_d(array());
            $this->set_average_faculty_workload_d_analysis();
            $this->set_average_faculty_workload_d_analysis_1('');
            $this->set_average_faculty_workload_d_analysis_2('');
            $this->set_average_faculty_workload_d_analysis_3('');
            $this->set_e_self_Study_process();
            $this->set_self_Study_process('');
    }

    /*
     * Historical Summary 
     */

    public function set_historical_summary_note()
    {
        $property = new \Orm_Property_Fixedtext('historical_summary_note', '<strong>Historical Summary</strong> <br/> <br/>Provide a brief historical summary of the program including such things as: <br/>'
            . '<ul><li>when and why it was introduced</li>'
            . '<li>student enrollment history</li>'
            . '<li>relationships with industry or professional advisory groups</li>'
            . '<li>graduate employment outcomes</li>'
            . '<li>major program changes.</li></ul> <br/>'
            . 'Include brief comments about what are believed to be the programs main strengths and accomplishments and any significant problems or concerns that are being addressed.');
        $this->set_property($property);
    }

    public function get_historical_summary_note()
    {
        return $this->get_property('historical_summary_note')->get_value();
    }

    public function set_historical_summary($value)
    {
        $property = new \Orm_Property_Textarea('historical_summary', $value);
        $this->set_property($property);
    }

    public function get_historical_summary()
    {
        return $this->get_property('historical_summary')->get_value();
    }

    /*
     * Foundation Program
     */

    public function set_foundation_program_note()
    {
        $property = new \Orm_Property_Fixedtext('foundation_program_note', '<strong>Preparatory or Foundation Program</strong>');
        $this->set_property($property);
    }

    public function get_foundation_program_note()
    {
        return $this->get_property('foundation_program_note')->get_value();
    }

    public function set_foundation_program_offer($value)
    {
        $property = new \Orm_Property_Radio('foundation_program_offer', $value);
        $property->set_description('Do you offer a preparatory program');
        $property->set_options(array('yes', 'no'));
        $this->set_property($property);
    }

    public function get_foundation_program_offer()
    {
        return $this->get_property('foundation_program_offer')->get_value();
    }

    public function set_foundation_program_out_sourced($value)
    {
        $property = new \Orm_Property_Radio('foundation_program_out_sourced', $value);
        $property->set_description('If yes, is the preparatory program is offered is it out-sourced?');
        $property->set_options(array('yes', 'no'));
        $this->set_property($property);
    }

    public function get_foundation_program_out_sourced()
    {
        return $this->get_property('foundation_program_out_sourced')->get_value();
    }

    public function set_foundation_program($value)
    {
        $property = new \Orm_Property_Radio('foundation_program', $value);
        $property->set_description('If a preparatory or foundation year program is provided prior to entry to this program, are all students required to take that program?');
        $property->set_options(array('yes', 'no'));
        $this->set_property($property);
    }

    public function get_foundation_program()
    {
        return $this->get_property('foundation_program')->get_value();
    }

    public function set_foundation_program_analysis($value)
    {
        $property = new \Orm_Property_Text('foundation_program_analysis', $value);
        $property->set_description('If yes, how many Academic credits are granted into the program and included in the * GPA');
        $this->set_property($property);
    }

    public function get_foundation_program_analysis()
    {
        return $this->get_property('foundation_program_analysis')->get_value();
    }

    public function set_foundation_program_analysis_required($value)
    {
        $property = new \Orm_Property_Text('foundation_program_analysis_required', $value);
        $property->set_description('What is the total number of credits required by the program?');
        $this->set_property($property);
    }

    public function get_foundation_program_analysis_required()
    {
        return $this->get_property('foundation_program_analysis_required')->get_value();
    }

    public function set_foundation_program_analysis_required_note()
    {
        $property = new \Orm_Property_Fixedtext('foundation_program_analysis_required_note', '<strong>NOTE:  * Credits granted into the program must be included in the GPA </strong>');
        $this->set_property($property);
    }

    public function get_foundation_program_analysis_required_note()
    {
        return $this->get_property('foundation_program_analysis_required_note')->get_value();
    }

    public function set_foundation_program_course_list($value)
    {
        $property = new \Orm_Property_Textarea('foundation_program_course_list', $value);
        $property->set_description('List the courses that are granted into the program.');
        $this->set_property($property);
    }

    public function get_foundation_program_course_list()
    {
        return $this->get_property('foundation_program_course_list')->get_value();
    }

    /*
     *  Statistical Summary   
     */

    public function set_statistical_summary_note()
    {
        $property = new \Orm_Property_Fixedtext('statistical_summary_note', '<strong> Statistical Summary <br/> <br/>NOTE: For all tables in this section A separate table must be used for each branch/location campus.</strong>');
        $this->set_property($property);
    }

    public function get_statistical_summary_note()
    {
        return $this->get_property('statistical_summary_note')->get_value();
    }

    public function set_student_enrollment($value)
    {
        $full_time = new \Orm_Property_Fixedtext('full_time', 'Full time');
        $part_time = new \Orm_Property_Fixedtext('part_time', 'Part time');
        $fte = new \Orm_Property_Fixedtext('fte', '*FTE');

        $on_campus_fulltime = new \Orm_Property_Text('on_campus_fulltime');
        $on_campus_parttime = new \Orm_Property_Text('on_campus_parttime');
        $on_campus_fte = new \Orm_Property_Text('on_campus_fte');
        $eLearning_education_programs_fulltime = new \Orm_Property_Text('eLearning_education_programs_fulltime');
        $eLearning_education_programs_parttime = new \Orm_Property_Text('eLearning_education_programs_parttime');
        $eLearning_education_programs_fte = new \Orm_Property_Text('eLearning_education_programs_fte');

        $property = new \Orm_Property_Table('student_enrollment', $value);
        $property->set_description('Student Enrollment (Not including preparatory or foundation programs)');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('student', 'Students'), 2, 0);
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('on_campus', 'On Campus Programs'), 0, 3);
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('eLearning_education_programs', 'Elearning  Education Programs'), 0, 3);

        $property->add_cell(2, 1, $full_time);
        $property->add_cell(2, 2, $part_time);
        $property->add_cell(2, 3, $fte);
        $property->add_cell(2, 4, $full_time);
        $property->add_cell(2, 5, $part_time);
        $property->add_cell(2, 6, $fte);


        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('male', 'Male'));
        $property->add_cell(3, 2, $on_campus_fulltime);
        $property->add_cell(3, 3, $on_campus_parttime);
        $property->add_cell(3, 4, $on_campus_fte);
        $property->add_cell(3, 5, $eLearning_education_programs_fulltime);
        $property->add_cell(3, 6, $eLearning_education_programs_parttime);
        $property->add_cell(3, 7, $eLearning_education_programs_fte);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('female', 'Female'));
        $property->add_cell(4, 2, $on_campus_fulltime);
        $property->add_cell(4, 3, $on_campus_parttime);
        $property->add_cell(4, 4, $on_campus_fte);
        $property->add_cell(4, 5, $eLearning_education_programs_fulltime);
        $property->add_cell(4, 6, $eLearning_education_programs_parttime);
        $property->add_cell(4, 7, $eLearning_education_programs_fte);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('total', 'Total'));
        $property->add_cell(5, 2, $on_campus_fulltime);
        $property->add_cell(5, 3, $on_campus_parttime);
        $property->add_cell(5, 4, $on_campus_fte);
        $property->add_cell(5, 5, $eLearning_education_programs_fulltime);
        $property->add_cell(5, 6, $eLearning_education_programs_parttime);
        $property->add_cell(5, 7, $eLearning_education_programs_fte);

        $this->set_property($property);
    }

    public function get_student_Enrollment()
    {
        return $this->get_property('student_Enrollment')->get_value();
    }

    public function set_statistical_summary_info()
    {
        $property = new \Orm_Property_Fixedtext('statistical_summary_info', '<strong>NOTE :</strong>To calculate effective full time equivalents (FTE) for part time students assume a notional full time load is 15 credit hours and divide the number of credit hours taken by each student by 15.  (Use this formula only for part time students)');
        $this->set_property($property);
    }

    public function get_statistical_summary_info()
    {
        return $this->get_property('statistical_summary_info')->get_value();
    }

    /*
     * Confirmed enrollment
     */

    public function set_confirmed_enrollment($value)
    {
        $male = new \Orm_Property_Text('male');
        $female = new \Orm_Property_Text('female');
        $total = new \Orm_Property_Text('total');

        $property = new \Orm_Property_Table('confirmed_enrollment', $value);
        $property->set_description('Confirmed enrollment at the beginning of the current academic year');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('level', 'Level/Year of Study'));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('male', 'Male'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('female', 'Female'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('total', 'Total'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('first_year', 'First Year'));
        $property->add_cell(2, 2, $male);
        $property->add_cell(2, 3, $female);
        $property->add_cell(2, 4, $total);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('second_year', 'Second Year'));
        $property->add_cell(3, 2, $male);
        $property->add_cell(3, 3, $female);
        $property->add_cell(3, 4, $total);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('third_year', 'Third Year'));
        $property->add_cell(4, 2, $male);
        $property->add_cell(4, 3, $female);
        $property->add_cell(4, 4, $total);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('fourth_year', 'Fourth Year'));
        $property->add_cell(5, 2, $male);
        $property->add_cell(5, 3, $female);
        $property->add_cell(5, 4, $total);

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('fifth_year', 'Fifth Year (if applicable)'));
        $property->add_cell(6, 2, $male);
        $property->add_cell(6, 3, $female);
        $property->add_cell(6, 4, $total);

        $property->add_cell(7, 1, new \Orm_Property_Fixedtext('sixth_year', 'Sixth Year (if applicable)'));
        $property->add_cell(7, 2, $male);
        $property->add_cell(7, 3, $female);
        $property->add_cell(7, 4, $total);

        $property->add_cell(8, 1, new \Orm_Property_Fixedtext('total', 'Total'));
        $property->add_cell(8, 2, $male);
        $property->add_cell(8, 3, $female);
        $property->add_cell(8, 4, $total);

        $this->set_property($property);
    }

    public function get_confirmed_Enrollment()
    {
        return $this->get_property('confirmed_Enrollment')->get_value();
    }

    /*
     * Faculty
     */

    public function set_faculty($value)
    {
        $full_time = new \Orm_Property_Fixedtext('full_time', 'Full time');
        $part_time = new \Orm_Property_Fixedtext('part_time', 'Part time');
        $fte = new \Orm_Property_Fixedtext('fte', 'FTE');

        $on_campus_fulltime = new \Orm_Property_Text('on_campus_fulltime');
        $on_campus_parttime = new \Orm_Property_Text('on_campus_parttime');
        $on_campus_fte = new \Orm_Property_Text('on_campus_fte');
        $elearning_education_fulltime = new \Orm_Property_Text('elearning_fulltime');
        $elearning_education_parttime = new \Orm_Property_Text('elearning_parttime');
        $elearning_education_fte = new \Orm_Property_Text('elearning_fte');


        $property = new \Orm_Property_Table('faculty', $value);
        $property->set_description('Faculty: FTE is calculated as 12 credit hours. The number should not include research, teaching or laboratory assistants.');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('no_staff', 'No. of Staff'), 2, 0);
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('on_campus', 'On Campus Programs'), 0, 3);
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('elearning_education', 'eLearning Education'), 0, 3);

        $property->add_cell(2, 1, $full_time);
        $property->add_cell(2, 2, $part_time);
        $property->add_cell(2, 3, $fte);
        $property->add_cell(2, 4, $full_time);
        $property->add_cell(2, 5, $part_time);
        $property->add_cell(2, 6, $fte);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('faculty', 'Faculty'));
        $property->add_cell(3, 2, $on_campus_fulltime);
        $property->add_cell(3, 3, $on_campus_parttime);
        $property->add_cell(3, 4, $on_campus_fte);
        $property->add_cell(3, 5, $elearning_education_fulltime);
        $property->add_cell(3, 6, $elearning_education_parttime);
        $property->add_cell(3, 7, $elearning_education_fte);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('teaching_staffe', 'Teaching staff'));
        $property->add_cell(4, 2, $on_campus_fulltime);
        $property->add_cell(4, 3, $on_campus_parttime);
        $property->add_cell(4, 4, $on_campus_fte);
        $property->add_cell(4, 5, $elearning_education_fulltime);
        $property->add_cell(4, 6, $elearning_education_parttime);
        $property->add_cell(4, 7, $elearning_education_fte);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('total', 'Totals'));
        $property->add_cell(5, 2, $on_campus_fulltime);
        $property->add_cell(5, 3, $on_campus_parttime);
        $property->add_cell(5, 4, $on_campus_fte);
        $property->add_cell(5, 5, $elearning_education_fulltime);
        $property->add_cell(5, 6, $elearning_education_parttime);
        $property->add_cell(5, 7, $elearning_education_fte);

        $this->set_property($property);
    }

    public function get_faculty()
    {
        return $this->get_property('faculty')->get_value();
    }

    public function set_faculty_note()
    {
        $property = new \Orm_Property_Fixedtext('faculty_note', '<strong>NOTE : </strong>The number of faculty and teaching academic staff should include: <br/>'
            . '<ul><li>Faculty:  Assistant, Associate and Full Professors whether involved with teaching, research or both teaching and research.</li>'
            . '<li>student enrollment history</li>'
            . '<li>Teaching staff:  Lectures, Teaching Assistants, Practical Preceptors</li>'
            . '<li>The number should not include Technicians and Laboratory Assistants.</li></ul>');
        $this->set_property($property);
    }

    public function get_faculty_note()
    {
        return $this->get_property('faculty_note')->get_value();
    }

    /*
     * Faculty and Teaching Staff 
     */

    public function set_faculty_and_Teaching_staff($value)
    {
        $num = new \Orm_Property_Fixedtext('num', 'No.');
        $percent = new \Orm_Property_Fixedtext('percent', 'Percent');
        $phd_no = new \Orm_Property_Text('phd_no');
        $phd_no->set_width(100);
        $phd_percent = new \Orm_Property_Percentage('phd_percent');
        $phd_percent->set_width(100);
        $master_no = new \Orm_Property_Text('master_no');
        $master_no->set_width(100);
        $master_percent = new \Orm_Property_Percentage('master_percent');
        $master_percent->set_width(100);
        $other_no = new \Orm_Property_Text('other_no');
        $other_no->set_width(100);
        $other_percent = new \Orm_Property_Percentage('other_percent');
        $other_percent->set_width(100);
        $total_no = new \Orm_Property_Text('total_no');
        $total_no->set_width(100);
        $total_percent = new \Orm_Property_Percentage('total_percent');
        $total_percent->set_width(100);

        $property = new \Orm_Property_Table('faculty_and_Teaching_staff', $value);
        $property->set_description('Faculty and Teaching Staff Highest Qualifications');
        $property->set_is_responsive(true);

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('student', ''), 2, 0);
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('phd', 'Ph.D.'), 0, 2);
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('master', 'Masters'), 0, 2);
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('other', 'Others'), 0, 2);
        $property->add_cell(1, 5, new \Orm_Property_Fixedtext('total', 'Total'), 0, 2);

        $property->add_cell(2, 1, $num);
        $property->add_cell(2, 2, $percent);
        $property->add_cell(2, 3, $num);
        $property->add_cell(2, 4, $percent);
        $property->add_cell(2, 5, $num);
        $property->add_cell(2, 6, $percent);
        $property->add_cell(2, 7, $num);
        $property->add_cell(2, 8, $percent);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('male', 'Male'));
        $property->add_cell(3, 2, $phd_no);
        $property->add_cell(3, 3, $phd_percent);
        $property->add_cell(3, 4, $master_no);
        $property->add_cell(3, 5, $master_percent);
        $property->add_cell(3, 6, $other_no);
        $property->add_cell(3, 7, $other_percent);
        $property->add_cell(3, 8, $total_no);
        $property->add_cell(3, 9, $total_percent);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('female', 'Female'));
        $property->add_cell(4, 2, $phd_no);
        $property->add_cell(4, 3, $phd_percent);
        $property->add_cell(4, 4, $master_no);
        $property->add_cell(4, 5, $master_percent);
        $property->add_cell(4, 6, $other_no);
        $property->add_cell(4, 7, $other_percent);
        $property->add_cell(4, 8, $total_no);
        $property->add_cell(4, 9, $total_percent);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('total', 'Total'));
        $property->add_cell(5, 2, $phd_no);
        $property->add_cell(5, 3, $phd_percent);
        $property->add_cell(5, 4, $master_no);
        $property->add_cell(5, 5, $master_percent);
        $property->add_cell(5, 6, $other_no);
        $property->add_cell(5, 7, $other_percent);
        $property->add_cell(5, 8, $total_no);
        $property->add_cell(5, 9, $total_percent);

        $this->set_property($property);
    }

    public function get_faculty_and_Teaching_staff()
    {
        return $this->get_property('faculty_and_Teaching_staff')->get_value();
    }

    /*
     * Average Faculty Workload
     */

    public function set_average_faculty_workload_info()
    {
        $property = new \Orm_Property_Fixedtext('average_faculty_workload_info', '<strong>Average Faculty Workload and Class Enrollment</strong>');
        $this->set_property($property);
    }

    public function get_average_faculty_workload_info()
    {
        return $this->get_property('average_faculty_workload_info')->get_value();
    }

    public function set_average_faculty_workload_a($value)
    {
        $credit_workload_first_Semester = new \Orm_Property_Text('credit_workload_first_Semester');
        $credit_workload_second_semester = new \Orm_Property_Text('credit_workload_second_semester');
        $class_enrollment_first_Semester = new \Orm_Property_Text('class_enrollment_first_Semester');
        $class_enrollment_second_semester = new \Orm_Property_Text('class_enrollment_second_semester');

        $property = new \Orm_Property_Table('average_faculty_workload_a', $value);
        $property->set_description('A. Calculate the average number of credit hours taught by the full-time faculty for the past year and calculate the average number of students enrolled per class taught.');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('full_time', 'Full-time Faculty'));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('credit_workload_first_Semester', 'Average Credit Workload 1st Semester'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('credit_workload_second_semester', 'Average Credit Workload 2nd Semester'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('class_enrollment_first_Semester', 'Average Class Enrollment 1st Semester'));
        $property->add_cell(1, 5, new \Orm_Property_Fixedtext('class_enrollment_second_semester', 'Average Class Enrollment 2nd Semester'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('male', 'Male'));
        $property->add_cell(2, 2, $credit_workload_first_Semester);
        $property->add_cell(2, 3, $credit_workload_second_semester);
        $property->add_cell(2, 4, $class_enrollment_first_Semester);
        $property->add_cell(2, 5, $class_enrollment_second_semester);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('female', 'Female'));
        $property->add_cell(3, 2, $credit_workload_first_Semester);
        $property->add_cell(3, 3, $credit_workload_second_semester);
        $property->add_cell(3, 4, $class_enrollment_first_Semester);
        $property->add_cell(3, 5, $class_enrollment_second_semester);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('total', 'Average'));
        $property->add_cell(4, 2, $credit_workload_first_Semester);
        $property->add_cell(4, 3, $credit_workload_second_semester);
        $property->add_cell(4, 4, $class_enrollment_first_Semester);
        $property->add_cell(4, 5, $class_enrollment_second_semester);

        $this->set_property($property);
    }

    public function get_average_faculty_workload_a()
    {
        return $this->get_property('average_faculty_workload_a')->get_value();
    }

    public function set_average_faculty_workload_a_analysis()
    {
        $property = new \Orm_Property_Fixedtext('average_faculty_workload_a_analysis', '<strong>Provide Analysis – Analyse the entire table and provide detailed class enrollment analysis of the different instructional levels.</strong>');
        $this->set_property($property);
    }

    public function get_average_faculty_workload_a_analysis()
    {
        return $this->get_property('average_faculty_workload_a_analysis_note')->get_value();
    }

    public function set_average_faculty_workload_a_analysis_1($value)
    {
        $property = new \Orm_Property_Textarea('average_faculty_workload_a_analysis_1', $value);
        $property->set_description('1. Workload Analysis:');
        $this->set_property($property);
    }

    public function get_average_faculty_workload_a_analysis_1()
    {
        return $this->get_property('average_faculty_workload_a_analysis_1')->get_value();
    }

    public function set_average_faculty_workload_a_analysis_2($value)
    {
        $property = new \Orm_Property_Textarea('average_faculty_workload_a_analysis_2', $value);
        $property->set_description('2. Class Enrollment Analysis:');
        $this->set_property($property);
    }

    public function get_average_faculty_workload_a_analysis_2()
    {
        return $this->get_property('average_faculty_workload_a_analysis_2')->get_value();
    }

    public function set_average_faculty_workload_a_analysis_3($value)
    {
        $property = new \Orm_Property_Textarea('average_faculty_workload_a_analysis_3', $value);
        $property->set_description('3. Class Enrollment Level Analysis (Level means post or under graduate levels and year to year levels):');
        $this->set_property($property);
    }

    public function get_average_faculty_workload_a_analysis_3()
    {
        return $this->get_property('average_faculty_workload_a_analysis_3')->get_value();
    }

    public function set_average_faculty_workload_a_analysis_notes()
    {
        $property = new \Orm_Property_Fixedtext('average_faculty_workload_a_analysis_notes', '<strong>Average Credit Workload </strong>– Add the total number of credit hours taught by each individual teaching faculty member, add them all together, and divide by the full-time or part-time number of faculty members. <br/> <br/>'
            . '<strong>Average Class Enrollment</strong>– Add the total number of students enrolled in all of the classes taught by each individual teaching faculty member and divide the total by the number of classes taught. Add all the totals together and divide by the total number of faculty members.');
        $this->set_property($property);
    }

    public function get_average_faculty_workload_a_analysis_notes()
    {
        return $this->get_property('average_faculty_workload_a_analysis_notes')->get_value();
    }

    public function set_average_faculty_workload_b($value)
    {
        $credit_workload_first_Semester = new \Orm_Property_Text('credit_workload_first_Semester');
        $credit_workload_second_semester = new \Orm_Property_Text('credit_workload_second_semester');
        $class_enrollment_first_Semester = new \Orm_Property_Text('class_enrollment_first_Semester');
        $class_enrollment_second_semester = new \Orm_Property_Text('class_enrollment_second_semester');

        $property = new \Orm_Property_Table('average_faculty_workload_b', $value);
        $property->set_description('B. Calculate the average number of credit hours taught by the part-time faculty for the past year and calculate the average number of students enrolled per class taught.');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('part_time', 'Part-time Faculty'));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('credit_workload_first_Semester', 'Average Credit Workload 1st Semester'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('credit_workload_second_semester', 'Average Credit Workload 2nd Semester'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('class_enrollment_first_Semester', 'Average Class Enrollment 1st Semester'));
        $property->add_cell(1, 5, new \Orm_Property_Fixedtext('class_enrollment_second_semester', 'Average Class Enrollment 2nd Semester'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('male', 'Male'));
        $property->add_cell(2, 2, $credit_workload_first_Semester);
        $property->add_cell(2, 3, $credit_workload_second_semester);
        $property->add_cell(2, 4, $class_enrollment_first_Semester);
        $property->add_cell(2, 5, $class_enrollment_second_semester);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('female', 'Female'));
        $property->add_cell(3, 2, $credit_workload_first_Semester);
        $property->add_cell(3, 3, $credit_workload_second_semester);
        $property->add_cell(3, 4, $class_enrollment_first_Semester);
        $property->add_cell(3, 5, $class_enrollment_second_semester);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('total', 'Average'));
        $property->add_cell(4, 2, $credit_workload_first_Semester);
        $property->add_cell(4, 3, $credit_workload_second_semester);
        $property->add_cell(4, 4, $class_enrollment_first_Semester);
        $property->add_cell(4, 5, $class_enrollment_second_semester);

        $this->set_property($property);
    }

    public function get_average_faculty_workload_b()
    {
        return $this->get_property('average_faculty_workload_b')->get_value();
    }

    public function set_average_faculty_workload_b_analysis()
    {
        $property = new \Orm_Property_Fixedtext('average_faculty_workload_b_analysis', '<strong>Provide Analysis – Analyse the entire table and provide detailed class enrollment analysis of the different instructional levels.</strong>');
        $this->set_property($property);
    }

    public function get_average_faculty_workload_b_analysis()
    {
        return $this->get_property('average_faculty_workload_b_analysis_note')->get_value();
    }

    public function set_average_faculty_workload_b_analysis_1($value)
    {
        $property = new \Orm_Property_Textarea('average_faculty_workload_b_analysis_1', $value);
        $property->set_description('1. Workload Analysis:');
        $this->set_property($property);
    }

    public function get_average_faculty_workload_b_analysis_1()
    {
        return $this->get_property('average_faculty_workload_b_analysis_1')->get_value();
    }

    public function set_average_faculty_workload_b_analysis_2($value)
    {
        $property = new \Orm_Property_Textarea('average_faculty_workload_b_analysis_2', $value);
        $property->set_description('2. Class Enrollment Analysis:');
        $this->set_property($property);
    }

    public function get_average_faculty_workload_b_analysis_2()
    {
        return $this->get_property('average_faculty_workload_b_analysis_2')->get_value();
    }

    public function set_average_faculty_workload_b_analysis_3($value)
    {
        $property = new \Orm_Property_Textarea('average_faculty_workload_b_analysis_3', $value);
        $property->set_description('3. Class Enrollment Level Analysis (Level means post or under graduate levels and year to year levels):');
        $this->set_property($property);
    }

    public function get_average_faculty_workload_b_analysis_3()
    {
        return $this->get_property('average_faculty_workload_b_analysis_3')->get_value();
    }

    public function set_average_faculty_workload_c($value)
    {
        $credit_workload_first_Semester = new \Orm_Property_Text('credit_workload_first_Semester');
        $credit_workload_second_semester = new \Orm_Property_Text('credit_workload_second_semester');
        $class_enrollment_first_Semester = new \Orm_Property_Text('class_enrollment_first_Semester');
        $class_enrollment_second_semester = new \Orm_Property_Text('class_enrollment_second_semester');

        $property = new \Orm_Property_Table('average_faculty_workload_c', $value);
        $property->set_description('C. Calculate the average number of credit hours taught by the full-time teaching staff for the past year and calculate the average number of students enrolled per class taught.');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('full_time_teaching_staff', 'Full-time Teaching Staff'));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('credit_workload_first_Semester', 'Average Credit Workload 1st Semester'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('credit_workload_second_semester', 'Average Credit Workload 2nd Semester'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('class_enrollment_first_Semester', 'Average Class Enrollment 1st Semester'));
        $property->add_cell(1, 5, new \Orm_Property_Fixedtext('class_enrollment_second_semester', 'Average Class Enrollment 2nd Semester'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('male', 'Male'));
        $property->add_cell(2, 2, $credit_workload_first_Semester);
        $property->add_cell(2, 3, $credit_workload_second_semester);
        $property->add_cell(2, 4, $class_enrollment_first_Semester);
        $property->add_cell(2, 5, $class_enrollment_second_semester);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('female', 'Female'));
        $property->add_cell(3, 2, $credit_workload_first_Semester);
        $property->add_cell(3, 3, $credit_workload_second_semester);
        $property->add_cell(3, 4, $class_enrollment_first_Semester);
        $property->add_cell(3, 5, $class_enrollment_second_semester);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('total', 'Average'));
        $property->add_cell(4, 2, $credit_workload_first_Semester);
        $property->add_cell(4, 3, $credit_workload_second_semester);
        $property->add_cell(4, 4, $class_enrollment_first_Semester);
        $property->add_cell(4, 5, $class_enrollment_second_semester);

        $this->set_property($property);
    }

    public function get_average_faculty_workload_c()
    {
        return $this->get_property('average_faculty_workload_c')->get_value();
    }

    public function set_average_faculty_workload_c_analysis()
    {
        $property = new \Orm_Property_Fixedtext('average_faculty_workload_c_analysis', '<strong>Provide Analysis – Analyse the entire table and provide detailed class enrollment analysis of the different instructional levels.</strong>');
        $this->set_property($property);
    }

    public function get_average_faculty_workload_c_analysis()
    {
        return $this->get_property('average_faculty_workload_c_analysis_note')->get_value();
    }

    public function set_average_faculty_workload_c_analysis_1($value)
    {
        $property = new \Orm_Property_Textarea('average_faculty_workload_c_analysis_1', $value);
        $property->set_description('1. Workload Analysis:');
        $this->set_property($property);
    }

    public function get_average_faculty_workload_c_analysis_1()
    {
        return $this->get_property('average_faculty_workload_c_analysis_1')->get_value();
    }

    public function set_average_faculty_workload_c_analysis_2($value)
    {
        $property = new \Orm_Property_Textarea('average_faculty_workload_c_analysis_2', $value);
        $property->set_description('2. Class Enrollment Analysis:');
        $this->set_property($property);
    }

    public function get_average_faculty_workload_c_analysis_2()
    {
        return $this->get_property('average_faculty_workload_c_analysis_2')->get_value();
    }

    public function set_average_faculty_workload_c_analysis_3($value)
    {
        $property = new \Orm_Property_Textarea('average_faculty_workload_c_analysis_3', $value);
        $property->set_description('3. Class Enrollment Level Analysis (Level means post or under graduate levels and year to year levels):');
        $this->set_property($property);
    }

    public function get_average_faculty_workload_c_analysis_3()
    {
        return $this->get_property('average_faculty_workload_c_analysis_3')->get_value();
    }

    public function set_average_faculty_workload_d($value)
    {
        $credit_workload_first_Semester = new \Orm_Property_Text('credit_workload_first_Semester');
        $credit_workload_second_semester = new \Orm_Property_Text('credit_workload_second_semester');
        $class_enrollment_first_Semester = new \Orm_Property_Text('class_enrollment_first_Semester');
        $class_enrollment_second_semester = new \Orm_Property_Text('class_enrollment_second_semester');

        $property = new \Orm_Property_Table('average_faculty_workload_d', $value);
        $property->set_description('D. Calculate the average number of credit hours taught by the part-time teaching staff for the past year and calculate the average number of students enrolled per class taught.');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('part_time_teaching_staff', 'Part-time Teaching Staff'));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('credit_workload_first_Semester', 'Average Credit Workload 1st Semester'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('credit_workload_second_semester', 'Average Credit Workload 2nd Semester'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('class_enrollment_first_Semester', 'Average Class Enrollment 1st Semester'));
        $property->add_cell(1, 5, new \Orm_Property_Fixedtext('class_enrollment_second_semester', 'Average Class Enrollment 2nd Semester'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('male', 'Male'));
        $property->add_cell(2, 2, $credit_workload_first_Semester);
        $property->add_cell(2, 3, $credit_workload_second_semester);
        $property->add_cell(2, 4, $class_enrollment_first_Semester);
        $property->add_cell(2, 5, $class_enrollment_second_semester);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('female', 'Female'));
        $property->add_cell(3, 2, $credit_workload_first_Semester);
        $property->add_cell(3, 3, $credit_workload_second_semester);
        $property->add_cell(3, 4, $class_enrollment_first_Semester);
        $property->add_cell(3, 5, $class_enrollment_second_semester);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('total', 'Total'));
        $property->add_cell(4, 2, $credit_workload_first_Semester);
        $property->add_cell(4, 3, $credit_workload_second_semester);
        $property->add_cell(4, 4, $class_enrollment_first_Semester);
        $property->add_cell(4, 5, $class_enrollment_second_semester);

        $this->set_property($property);
    }

    public function get_average_faculty_workload_d()
    {
        return $this->get_property('average_faculty_workload_d')->get_value();
    }

    public function set_average_faculty_workload_d_analysis()
    {
        $property = new \Orm_Property_Fixedtext('average_faculty_workload_d_analysis', '<strong>Provide Analysis – Analyse the entire table and provide detailed class enrollment analysis of the different instructional levels.</strong>');
        $this->set_property($property);
    }

    public function get_average_faculty_workload_d_analysis()
    {
        return $this->get_property('average_faculty_workload_d_analysis_note')->get_value();
    }

    public function set_average_faculty_workload_d_analysis_1($value)
    {
        $property = new \Orm_Property_Textarea('average_faculty_workload_d_analysis_1', $value);
        $property->set_description('1. Workload Analysis:');
        $this->set_property($property);
    }

    public function get_average_faculty_workload_d_analysis_1()
    {
        return $this->get_property('average_faculty_workload_d_analysis_1')->get_value();
    }

    public function set_average_faculty_workload_d_analysis_2($value)
    {
        $property = new \Orm_Property_Textarea('average_faculty_workload_d_analysis_2', $value);
        $property->set_description('2. Class Enrollment Analysis:');
        $this->set_property($property);
    }

    public function get_average_faculty_workload_d_analysis_2()
    {
        return $this->get_property('average_faculty_workload_d_analysis_2')->get_value();
    }

    public function set_average_faculty_workload_d_analysis_3($value)
    {
        $property = new \Orm_Property_Textarea('average_faculty_workload_d_analysis_3', $value);
        $property->set_description('3. Class Enrollment Level Analysis (Level means post or under graduate levels and year to year levels):');
        $this->set_property($property);
    }

    public function get_average_faculty_workload_d_analysis_3()
    {
        return $this->get_property('average_faculty_workload_d_analysis_3')->get_value();
    }

    public function set_e_self_Study_process()
    {
        $property = new \Orm_Property_Fixedtext('e_self_Study_process', '<strong>E Self-Study Process</strong> <br/> <br/> Provide the following:'
            . '<ul><li>Provide a summary description of the procedures followed and administrative arrangements for the self-study.</li>'
            . '<li>Provide a quality assurance organization flowchart.</li>'
            . '<li>Provide a Description membership and terms of reference for committees and /or working parties.</li></ul>');
        $this->set_property($property);
    }

    public function get_e_self_Study_process()
    {
        return $this->get_property('e_self_Study_process')->get_value();
    }

    public function set_self_Study_process($value)
    {
        $property = new \Orm_Property_Textarea('self_Study_process', $value);
        $this->set_property($property);
    }

    public function get_self_Study_process()
    {
        return $this->get_property('self_Study_process')->get_value();
    }

    public function after_node_load()
    {
        /** @var \Orm_Program $program_obj */
        $program_obj = $this->get_parent_program_node()->get_item_obj();
        $this->set_foundation_program_analysis_required($program_obj->get_credit_hours());
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


                $enrolled = array();

                $enrolled[3][2]['on_campus_fulltime'] = \Orm_Data_Graduate::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_MALE),'enrolled');
                $enrolled[3][3]['on_campus_parttime'] = 0;
                $enrolled[3][4]['on_campus_fte'] = 0;
                $enrolled[3][5]['eLearning_education_programs_fulltime'] = 0;
                $enrolled[3][6]['eLearning_education_programs_parttime'] = 0;
                $enrolled[3][7]['eLearning_education_programs_fte'] = 0;
                $enrolled[4][2]['on_campus_fulltime'] = \Orm_Data_Graduate::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_FEMALE),'enrolled');
                $enrolled[4][3]['on_campus_parttime'] = 0;
                $enrolled[4][4]['on_campus_fte'] = 0;
                $enrolled[4][5]['eLearning_education_programs_fulltime'] = 0;
                $enrolled[4][6]['eLearning_education_programs_parttime'] = 0;
                $enrolled[4][7]['eLearning_education_programs_fte'] = 0;
                $enrolled[5][2]['on_campus_fulltime'] = \Orm_Data_Graduate::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year()),'enrolled');
                $enrolled[5][3]['on_campus_parttime'] = 0;
                $enrolled[5][4]['on_campus_fte'] = 0;
                $enrolled[5][5]['eLearning_education_programs_fulltime'] = 0;
                $enrolled[5][6]['eLearning_education_programs_parttime'] = 0;
                $enrolled[5][7]['eLearning_education_programs_fte'] = 0;

                $this->set_student_enrollment($enrolled);

                $confirmed = array();

                $confirmed[2][2]['male'] = \Orm_Data_Level_Enrolled::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year(),'level' => 1,'gender' => \Orm_User::GENDER_MALE));
                $confirmed[2][3]['female'] = \Orm_Data_Level_Enrolled::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year(),'level' => 1,'gender' => \Orm_User::GENDER_FEMALE));
                $confirmed[2][4]['total'] = \Orm_Data_Level_Enrolled::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year(),'level' => 1));
                $confirmed[3][2]['male'] = \Orm_Data_Level_Enrolled::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year(),'level' => 2,'gender' => \Orm_User::GENDER_MALE));
                $confirmed[3][3]['female'] = \Orm_Data_Level_Enrolled::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year(),'level' => 2,'gender' => \Orm_User::GENDER_FEMALE));
                $confirmed[3][4]['total'] = \Orm_Data_Level_Enrolled::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year(),'level' => 2));
                $confirmed[4][2]['male'] = \Orm_Data_Level_Enrolled::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year(),'level' => 3,'gender' => \Orm_User::GENDER_MALE));
                $confirmed[4][3]['female'] = \Orm_Data_Level_Enrolled::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year(),'level' => 3,'gender' => \Orm_User::GENDER_FEMALE));
                $confirmed[4][4]['total'] = \Orm_Data_Level_Enrolled::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year(),'level' => 3));
                $confirmed[5][2]['male'] = \Orm_Data_Level_Enrolled::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year(),'level' => 4,'gender' => \Orm_User::GENDER_MALE));
                $confirmed[5][3]['female'] = \Orm_Data_Level_Enrolled::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year(),'level' => 4,'gender' => \Orm_User::GENDER_FEMALE));
                $confirmed[5][4]['total'] = \Orm_Data_Level_Enrolled::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year(),'level' => 4));
                $confirmed[6][2]['male'] = \Orm_Data_Level_Enrolled::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year(),'level' => 5,'gender' => \Orm_User::GENDER_MALE));
                $confirmed[6][3]['female'] = \Orm_Data_Level_Enrolled::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year(),'level' => 5,'gender' => \Orm_User::GENDER_FEMALE));
                $confirmed[6][4]['total'] = \Orm_Data_Level_Enrolled::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year(),'level' => 5));
                $confirmed[7][2]['male'] = \Orm_Data_Level_Enrolled::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year(),'level' => 6,'gender' => \Orm_User::GENDER_MALE));
                $confirmed[7][3]['female'] = \Orm_Data_Level_Enrolled::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year(),'level' => 6,'gender' => \Orm_User::GENDER_FEMALE));
                $confirmed[7][4]['total'] = \Orm_Data_Level_Enrolled::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year(),'level' => 6));
                $confirmed[8][2]['male'] = \Orm_Data_Level_Enrolled::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_MALE));
                $confirmed[8][3]['female'] = \Orm_Data_Level_Enrolled::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_FEMALE));
                $confirmed[8][4]['total'] = \Orm_Data_Level_Enrolled::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year()));

                $this->set_confirmed_enrollment($confirmed);

                $teaching_staff = array();

                $teaching_staff[3][2]['on_campus_fulltime'] = \Orm_User_Faculty::get_count(array('program_id' => $program_obj->get_id(),'gender' => \Orm_User::GENDER_MALE));
                $teaching_staff[3][3]['on_campus_parttime'] = 0;
                $teaching_staff[3][4]['on_campus_fte'] = 0;
                $teaching_staff[3][5]['elearning_fulltime'] = 0;
                $teaching_staff[3][6]['elearning_parttime'] = 0;
                $teaching_staff[3][7]['elearning_fte'] = 0;

                $teaching_staff[4][2]['on_campus_fulltime'] = \Orm_User_Faculty::get_count(array('program_id' => $program_obj->get_id(),'gender' => \Orm_User::GENDER_FEMALE));
                $teaching_staff[4][3]['on_campus_parttime'] = 0;
                $teaching_staff[4][4]['on_campus_fte'] = 0;
                $teaching_staff[4][5]['elearning_fulltime'] = 0;
                $teaching_staff[4][6]['elearning_parttime'] = 0;
                $teaching_staff[4][7]['elearning_fte'] = 0;

                $teaching_staff[5][2]['on_campus_fulltime'] = \Orm_User_Faculty::get_count(array('program_id' => $program_obj->get_id()));
                $teaching_staff[5][3]['on_campus_parttime'] = 0;
                $teaching_staff[5][4]['on_campus_fte'] = 0;
                $teaching_staff[5][5]['elearning_fulltime'] = 0;
                $teaching_staff[5][6]['elearning_parttime'] = 0;
                $teaching_staff[5][7]['elearning_fte'] = 0;

                $this->set_faculty($teaching_staff);

                $phd_no = new \Orm_Property_Text('phd_no');
                $phd_no->set_width(100);
                $phd_percent = new \Orm_Property_Percentage('phd_percent');
                $phd_percent->set_width(100);
                $master_no = new \Orm_Property_Text('master_no');
                $master_no->set_width(100);
                $master_percent = new \Orm_Property_Percentage('master_percent');
                $master_percent->set_width(100);
                $other_no = new \Orm_Property_Text('other_no');
                $other_no->set_width(100);
                $other_percent = new \Orm_Property_Percentage('other_percent');
                $other_percent->set_width(100);
                $total_no = new \Orm_Property_Text('total_no');
                $total_no->set_width(100);
                $total_percent = new \Orm_Property_Percentage('total_percent');
                $total_percent->set_width(100);

                $prof_m = 0;
                $prof_f = 0;
                $masters_m = 0;
                $masters_f = 0;
                $others_m = 0;
                $others_f = 0;
                $total_m = 0;
                $total_f = 0;

                foreach (\Orm_User_Faculty::get_all(array('program_id' => $program_obj->get_id())) as $faculty) {
                    switch ($faculty->get_academic_rank()) {
                        case \Orm_User_Faculty::ACADEMIC_RANK_PROFESSOR:
                        case \Orm_User_Faculty::ACADEMIC_RANK_ASSISTANT_PROF:
                        case \Orm_User_Faculty::ACADEMIC_RANK_ASSOCIATE_PROF:
                            if ($faculty->get_gender() == \Orm_User::GENDER_MALE) {
                                $prof_m++;
                                $total_m++;
                            } else {
                                $prof_f++;
                                $total_f++;
                            }
                            break;
                        case \Orm_User_Faculty::ACADEMIC_RANK_LECTURER:
                        case \Orm_User_Faculty::ACADEMIC_RANK_TEACHING_ASSISTANT:
                            if ($faculty->get_gender() == \Orm_User::GENDER_MALE) {
                                $masters_m++;
                                $total_m++;
                            } else {
                                $masters_f++;
                                $total_f++;
                            }
                            break;
                        default:
                            if ($faculty->get_gender() == \Orm_User::GENDER_MALE) {
                                $others_m++;
                                $total_m++;
                            } else {
                                $others_f++;
                                $total_f++;
                            }
                            break;
                    }
                }

                $qualifications = array();

                $total = $total_m + $total_f;

                $qualifications[3][2]['phd_no'] = $prof_m;
                $qualifications[3][3]['phd_percent'] = $total_m ?( $prof_m / $total_m * 100) : 0;
                $qualifications[3][4]['master_no'] = $masters_m;
                $qualifications[3][5]['master_percent'] = $total_m ? ( $masters_m / $total_m * 100) : 0;
                $qualifications[3][6]['other_no'] = $others_m;
                $qualifications[3][7]['other_percent'] = $total_m ?( $others_m / $total_m * 100) : 0;
                $qualifications[3][8]['total_no'] = $total_m;
                $qualifications[3][9]['total_percent'] = $total_m ? ($total_m / $total_m * 100) : 0;

                $qualifications[4][2]['phd_no'] = $prof_f;
                $qualifications[4][3]['phd_percent'] = $total_f ? ($prof_f / $total_f * 100) : 0;
                $qualifications[4][4]['master_no'] = $masters_f;
                $qualifications[4][5]['master_percent'] = $total_f ? ($masters_f / $total_f * 100) : 0;
                $qualifications[4][6]['other_no'] = $others_f;
                $qualifications[4][7]['other_percent'] = $total_f ? ($others_f / $total_f * 100) : 0;
                $qualifications[4][8]['total_no'] = $total_f;
                $qualifications[4][9]['total_percent'] = $total_f ? ($total_f / $total_f * 100) : 0;

                $qualifications[5][2]['phd_no'] = $prof_m + $prof_f;
                $qualifications[5][3]['phd_percent'] = ($total_m + $total_f) ? (($prof_m + $prof_f) / $total * 100) : 0;
                $qualifications[5][4]['master_no'] = $masters_m + $masters_f;
                $qualifications[5][5]['master_percent'] = $total_m + $total_f ? (($masters_m + $masters_f) / $total * 100) : 0;
                $qualifications[5][6]['other_no'] = $others_m + $others_f;
                $qualifications[5][7]['other_percent'] = ($total_m + $total_f) ? (($others_m + $others_f) / $total * 100) : 0;
                $qualifications[5][8]['total_no'] = $total_m + $total_f;
                $qualifications[5][9]['total_percent'] = ($total_m + $total_f) ? ($total / $total * 100) : 0;

                $this->set_faculty_and_Teaching_staff($qualifications);
            }
            $this->save();
        }
    }

}
