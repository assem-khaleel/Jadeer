<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncacm14;

/**
 * Description of course_report_result
 *
 * @author ahmadgx
 */
class Course_Report_C extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'C. Results';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_distribution_of_grades(array());
            $this->set_special_factors('');
            $this->set_assessment_plan();
            $this->set_assessment_plan_table(array());
            $this->set_assessment_process_table(array());
            $this->set_student_grade(array());
    }

    public function set_distribution_of_grades($value)
    {
        $num_of_student = new \Orm_Property_Text('num_of_student');
        $num_of_student->set_width(100);
        $student_percent = new \Orm_Property_Percentage('student_percent');
        $student_percent->set_width(100);
        $analysis = new \Orm_Property_Textarea('analysis');
        $analysis->set_width(300);
        $analysis->set_enable_tinymce(0);

        $property = new \Orm_Property_Table('distribution_of_grades', $value);
        $property->set_description('1. Distribution of Grades');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('letter_grade', 'Letter Grade'));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('num_of_student', 'Number of Students'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('student_percent', 'Student Percentage'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('grade_distribution', 'Explanation of Distribution of Grades'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('a', 'A'));
        $property->add_cell(2, 2, $num_of_student);
        $property->add_cell(2, 3, $student_percent);
        $property->add_cell(2, 4, $analysis);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('b', 'B'));
        $property->add_cell(3, 2, $num_of_student);
        $property->add_cell(3, 3, $student_percent);
        $property->add_cell(3, 4, $analysis);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('c', 'C'));
        $property->add_cell(4, 2, $num_of_student);
        $property->add_cell(4, 3, $student_percent);
        $property->add_cell(4, 4, $analysis);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('d', 'D'));
        $property->add_cell(5, 2, $num_of_student);
        $property->add_cell(5, 3, $student_percent);
        $property->add_cell(5, 4, $analysis);

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('f', 'F'));
        $property->add_cell(6, 2, $num_of_student);
        $property->add_cell(6, 3, $student_percent);
        $property->add_cell(6, 4, $analysis);

        $property->add_cell(7, 1, new \Orm_Property_Fixedtext('denied_entry', 'Denied Entry'));
        $property->add_cell(7, 2, $num_of_student);
        $property->add_cell(7, 3, $student_percent);
        $property->add_cell(7, 4, $analysis);

        $property->add_cell(8, 1, new \Orm_Property_Fixedtext('in_progress', 'In Progress'));
        $property->add_cell(8, 2, $num_of_student);
        $property->add_cell(8, 3, $student_percent);
        $property->add_cell(8, 4, $analysis);

        $property->add_cell(9, 1, new \Orm_Property_Fixedtext('incomplete', 'Incomplete'));
        $property->add_cell(9, 2, $num_of_student);
        $property->add_cell(9, 3, $student_percent);
        $property->add_cell(9, 4, $analysis);

        $property->add_cell(10, 1, new \Orm_Property_Fixedtext('pass', 'Pass'));
        $property->add_cell(10, 2, $num_of_student);
        $property->add_cell(10, 3, $student_percent);
        $property->add_cell(10, 4, $analysis);

        $property->add_cell(11, 1, new \Orm_Property_Fixedtext('fail', 'Fail'));
        $property->add_cell(11, 2, $num_of_student);
        $property->add_cell(11, 3, $student_percent);
        $property->add_cell(11, 4, $analysis);

        $property->add_cell(12, 1, new \Orm_Property_Fixedtext('withdrawn', 'Withdrawn'));
        $property->add_cell(12, 2, $num_of_student);
        $property->add_cell(12, 3, $student_percent);
        $property->add_cell(12, 4, $analysis);

        $this->set_property($property);
    }

    public function get_distribution_of_grades()
    {
        return $this->get_property('distribution_of_grades')->get_value();
    }

    /*
     * 2.Analyze special factors (if any) affecting the  results'
     */

    public function set_special_factors($value)
    {
        $property = new \Orm_Property_Textarea('special_factors', $value);
        $property->set_description('2.Analyze special factors (if any) affecting the  results');
        $this->set_property($property);
    }

    public function get_special_factors()
    {
        return $this->get_property('special_factors')->get_value();
    }

    public function set_assessment_plan()
    {
        $property = new \Orm_Property_Fixedtext('assessment_plan', '<strong>3. Variations from planned student assessment processes (if any) (see Course Specifications).</strong>');
        $this->set_property($property);
    }

    public function get_assessment_plan()
    {
        return $this->get_property('assessment_plan')->get_value();
    }

    public function set_assessment_plan_table($value)
    {
        $property = new \Orm_Property_Table_Dynamic('assessment_plan_table', $value);
        $property->set_description('a. Variations (if any) from planned assessment schedule (see Course Specification)');

        $variation_a = new \Orm_Property_Textarea('variation_a');
        $variation_a->set_description('Variation');
        $variation_a->set_enable_tinymce(0);
        $variation_a->set_width(350);
        $property->add_property($variation_a);

        $reason_a = new \Orm_Property_Textarea('reason_a');
        $reason_a->set_description('Reason');
        $reason_a->set_enable_tinymce(0);
        $reason_a->set_width(350);
        $property->add_property($reason_a);

        $this->set_property($property);
    }

    public function get_assessment_plan_table()
    {
        return $this->get_property('assessment_plan_table')->get_value();
    }

    public function set_assessment_process_table($value)
    {
        $property = new \Orm_Property_Table_Dynamic('assessment_process_table', $value);
        $property->set_description('b. Variations (if any) from planned assessment processes in Domains of Learning (see Course Specification)');

        $variation_b = new \Orm_Property_Textarea('variation_b');
        $variation_b->set_description('Variation');
        $variation_b->set_enable_tinymce(0);
        $variation_b->set_width(350);
        $property->add_property($variation_b);

        $reason_b = new \Orm_Property_Textarea('reason_b');
        $reason_b->set_description('Reason');
        $reason_b->set_enable_tinymce(0);
        $reason_b->set_width(350);
        $property->add_property($reason_b);

        $this->set_property($property);
    }

    public function get_assessment_process_table()
    {
        return $this->get_property('assessment_process_table')->get_value();
    }

    /*
     * 4. Student Grade Achievement Verification (eg. cross-check of grade validity by independent evaluator).
     */

    public function set_student_grade($value)
    {
        $property = new \Orm_Property_Table_Dynamic('student_grade', $value);
        $property->set_description('4. Student Grade Achievement Verification (eg. cross-check of grade validity by independent evaluator).');

        $method = new \Orm_Property_Textarea('method');
        $method->set_description('Method(s) of Verification');
        $method->set_enable_tinymce(0);
        $method->set_width(350);
        $property->add_property($method);

        $conclusion = new \Orm_Property_Textarea('conclusion');
        $conclusion->set_description('Conclusion');
        $conclusion->set_enable_tinymce(0);
        $conclusion->set_width(350);
        $property->add_property($conclusion);

        $this->set_property($property);
    }

    public function get_student_grade()
    {
        return $this->get_property('student_grade')->get_value();
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
            $course_section_node = $this->get_parent_course_section_node()->get_item_id();
            $course_node = $this->get_parent_course_node()->get_item_id();
            if ($course_section_node) {

                $a_grade = \Orm_Data_Course_Grade::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'a'))->get_student_count();
                $b_grade = \Orm_Data_Course_Grade::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'b'))->get_student_count();
                $c_grade = \Orm_Data_Course_Grade::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'c'))->get_student_count();
                $d_grade = \Orm_Data_Course_Grade::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'd'))->get_student_count();
                $f_grade = \Orm_Data_Course_Grade::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'f'))->get_student_count();

                $total = $a_grade + $b_grade + $c_grade + $d_grade + $f_grade;

                $denied_entry = \Orm_Data_Course_Status::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '1'))->get_student_count();
                $in_progress = \Orm_Data_Course_Status::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '2'))->get_student_count();
                $incomplete = \Orm_Data_Course_Status::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '3'))->get_student_count();
                $pass = \Orm_Data_Course_Status::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '4'))->get_student_count();
                $fail = \Orm_Data_Course_Status::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '5'))->get_student_count();
                $withdrawn = \Orm_Data_Course_Status::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '6'))->get_student_count();

                $total_status = $denied_entry + $in_progress + $incomplete + $pass + $fail + $withdrawn;

                $grades = array();
                $grades[2][2]['num_of_student'] = $a_grade;
                $grades[2][3]['student_percent'] = $total ? ($a_grade / $total) : 0;
                $grades[3][2]['num_of_student'] = $b_grade;
                $grades[3][3]['student_percent'] = $total ? ($b_grade / $total) : 0;
                $grades[4][2]['num_of_student'] = $c_grade;
                $grades[4][3]['student_percent'] = $total ? ($c_grade / $total) : 0;
                $grades[5][2]['num_of_student'] = $d_grade;
                $grades[5][3]['student_percent'] = $total ? ($d_grade / $total) : 0;
                $grades[6][2]['num_of_student'] = $f_grade;
                $grades[6][3]['student_percent'] = $total ? ($f_grade / $total) : 0;
                $grades[7][2]['num_of_student'] = $denied_entry;
                $grades[7][3]['student_percent'] = $total_status ? ( $denied_entry / $total_status) : 0;
                $grades[8][2]['num_of_student'] = $in_progress;
                $grades[8][3]['student_percent'] = $total_status ? ($in_progress / $total_status) : 0;
                $grades[9][2]['num_of_student'] = $incomplete;
                $grades[9][3]['student_percent'] = $total_status ? ($incomplete / $total_status) : 0;
                $grades[10][2]['num_of_student'] = $pass;
                $grades[10][3]['student_percent'] = $total_status ? ($pass / $total_status) : 0;
                $grades[11][2]['num_of_student'] = $fail;
                $grades[11][3]['student_percent'] = $total_status ? ($fail / $total_status) : 0;
                $grades[12][2]['num_of_student'] = $withdrawn;
                $grades[12][3]['student_percent'] = $total_status ? ($withdrawn / $total_status) : 0;

                $this->set_distribution_of_grades($grades);
            } else {
                $a_grade = \Orm_Data_Course_Grade::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'a'));
                $b_grade = \Orm_Data_Course_Grade::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'b'));
                $c_grade = \Orm_Data_Course_Grade::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'c'));
                $d_grade = \Orm_Data_Course_Grade::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'd'));
                $f_grade = \Orm_Data_Course_Grade::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'f'));

                $total = $a_grade + $b_grade + $c_grade + $d_grade + $f_grade;

                $denied_entry = \Orm_Data_Course_Status::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '1'));
                $in_progress = \Orm_Data_Course_Status::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '2'));
                $incomplete = \Orm_Data_Course_Status::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '3'));
                $pass = \Orm_Data_Course_Status::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '4'));
                $fail = \Orm_Data_Course_Status::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '5'));
                $withdrawn = \Orm_Data_Course_Status::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '6'));

                $total_status = $denied_entry + $in_progress + $incomplete + $pass + $fail + $withdrawn;

                $grades = array();
                $grades[2][2]['num_of_student'] = $a_grade;
                $grades[2][3]['student_percent'] = $total ? ($a_grade / $total * 100) : 0;
                $grades[3][2]['num_of_student'] = $b_grade;
                $grades[3][3]['student_percent'] = $total ? ($b_grade / $total * 100) : 0;
                $grades[4][2]['num_of_student'] = $c_grade;
                $grades[4][3]['student_percent'] = $total ? ($c_grade / $total * 100) : 0;
                $grades[5][2]['num_of_student'] = $d_grade;
                $grades[5][3]['student_percent'] = $total ? ($d_grade / $total * 100) : 0;
                $grades[6][2]['num_of_student'] = $f_grade;
                $grades[6][3]['student_percent'] = $total ? ($f_grade / $total * 100) : 0;
                $grades[7][2]['num_of_student'] = $denied_entry;
                $grades[7][3]['student_percent'] = $total_status ? ($denied_entry / $total_status * 100) : 0;
                $grades[8][2]['num_of_student'] = $in_progress;
                $grades[8][3]['student_percent'] = $total_status ? ($in_progress / $total_status * 100) : 0;
                $grades[9][2]['num_of_student'] = $incomplete;
                $grades[9][3]['student_percent'] = $total_status ? ($incomplete / $total_status * 100) : 0;
                $grades[10][2]['num_of_student'] = $pass;
                $grades[10][3]['student_percent'] = $total_status ? ($pass / $total_status * 100) :0;
                $grades[11][2]['num_of_student'] = $fail;
                $grades[11][3]['student_percent'] = $total_status ? ($fail / $total_status * 100) : 0;
                $grades[12][2]['num_of_student'] = $withdrawn;
                $grades[12][3]['student_percent'] = $total_status ? ($withdrawn / $total_status * 100) : 0;

                $this->set_distribution_of_grades($grades);
            }

            $this->save();
        }
    }

}
