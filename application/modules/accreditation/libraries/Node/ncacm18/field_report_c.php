<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 05/07/18
 * Time: 03:37 م
 */

namespace Node\ncacm18;


class  Field_Report_C extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'C. Results';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

        $this->set_number_of_students('');
        $this->set_student_completing('');
        $this->set_distribution_of_grades(array());
        $this->set_analyze_spcial('');
    }

    public function set_number_of_students($value)
    {
        $property = new \Orm_Property_Text('number_of_students', $value);
        $property->set_description('1. Number of students starting field experience:');
        $this->set_property($property);
    }

    public function get_number_of_students()
    {
        return $this->get_property('number_of_students')->get_value();
    }

    public function set_student_completing($value)
    {
        $property = new \Orm_Property_Text('student_completing', $value);
        $property->set_description('Student completing');
        $this->set_property($property);
    }

    public function get_student_completing()
    {
        return $this->get_property('student_completing')->get_value();
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
        $property->set_description('2. Distribution of Grades');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('letter_grade', 'Letter Grade'));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('num_of_student', 'Number of Students'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('student_percent', 'Student Percentage'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('grade_distribution', 'Explanation of Distribution of Grades'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('a', 'A+'));
        $property->add_cell(2, 2, $num_of_student);
        $property->add_cell(2, 3, $student_percent);
        $property->add_cell(2, 4, $analysis);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('a', 'A'));
        $property->add_cell(3, 2, $num_of_student);
        $property->add_cell(3, 3, $student_percent);
        $property->add_cell(3, 4, $analysis);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('b', 'B+'));
        $property->add_cell(4, 2, $num_of_student);
        $property->add_cell(4, 3, $student_percent);
        $property->add_cell(4, 4, $analysis);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('b', 'B'));
        $property->add_cell(5, 2, $num_of_student);
        $property->add_cell(5, 3, $student_percent);
        $property->add_cell(5, 4, $analysis);

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('c', 'C+'));
        $property->add_cell(6, 2, $num_of_student);
        $property->add_cell(6, 3, $student_percent);
        $property->add_cell(6, 4, $analysis);

        $property->add_cell(7, 1, new \Orm_Property_Fixedtext('c', 'C'));
        $property->add_cell(7, 2, $num_of_student);
        $property->add_cell(7, 3, $student_percent);
        $property->add_cell(7, 4, $analysis);

        $property->add_cell(8, 1, new \Orm_Property_Fixedtext('d', 'D+'));
        $property->add_cell(8, 2, $num_of_student);
        $property->add_cell(8, 3, $student_percent);
        $property->add_cell(8, 4, $analysis);

        $property->add_cell(9, 1, new \Orm_Property_Fixedtext('d', 'D'));
        $property->add_cell(9, 2, $num_of_student);
        $property->add_cell(9, 3, $student_percent);
        $property->add_cell(9, 4, $analysis);

        $property->add_cell(10, 1, new \Orm_Property_Fixedtext('f', 'F'));
        $property->add_cell(10, 2, $num_of_student);
        $property->add_cell(10, 3, $student_percent);
        $property->add_cell(10, 4, $analysis);

        $property->add_cell(11, 1, new \Orm_Property_Fixedtext('denied_entry', 'Denied Entry'));
        $property->add_cell(11, 2, $num_of_student);
        $property->add_cell(11, 3, $student_percent);
        $property->add_cell(11, 4, $analysis);

        $property->add_cell(12, 1, new \Orm_Property_Fixedtext('in_progress', 'In Progress'));
        $property->add_cell(12, 2, $num_of_student);
        $property->add_cell(12, 3, $student_percent);
        $property->add_cell(12, 4, $analysis);

        $property->add_cell(13, 1, new \Orm_Property_Fixedtext('incomplete', 'Incomplete'));
        $property->add_cell(13, 2, $num_of_student);
        $property->add_cell(13, 3, $student_percent);
        $property->add_cell(13, 4, $analysis);

        $property->add_cell(14, 1, new \Orm_Property_Fixedtext('pass', 'Pass'));
        $property->add_cell(14, 2, $num_of_student);
        $property->add_cell(14, 3, $student_percent);
        $property->add_cell(14, 4, $analysis);

        $property->add_cell(15, 1, new \Orm_Property_Fixedtext('fail', 'Fail'));
        $property->add_cell(15, 2, $num_of_student);
        $property->add_cell(15, 3, $student_percent);
        $property->add_cell(15, 4, $analysis);

        $property->add_cell(16, 1, new \Orm_Property_Fixedtext('withdrawn', 'Withdrawn'));
        $property->add_cell(16, 2, $num_of_student);
        $property->add_cell(16, 3, $student_percent);
        $property->add_cell(16, 4, $analysis);

        $this->set_property($property);
    }

    public function get_distribution_of_grades()
    {
        return $this->get_property('distribution_of_grades')->get_value();
    }

    public function set_analyze_spcial($value)
    {
        $property = new \Orm_Property_Textarea('analyze_spcial', $value);
        $property->set_description('3. Analyze special factors (if any) affecting the  results');
        $this->set_property($property);
    }

    public function get_analyze_spcial()
    {
        return $this->get_property('analyze_spcial')->get_value();
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

                $a_plus_grade = \Orm_Data_Course_Grade::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'a+'))->get_student_count();
                $a_grade = \Orm_Data_Course_Grade::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'a'))->get_student_count();
                $b_plus_grade = \Orm_Data_Course_Grade::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'b+'))->get_student_count();
                $b_grade = \Orm_Data_Course_Grade::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'b'))->get_student_count();
                $c_plus_grade = \Orm_Data_Course_Grade::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'c+'))->get_student_count();
                $c_grade = \Orm_Data_Course_Grade::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'c'))->get_student_count();
                $d_plus_grade = \Orm_Data_Course_Grade::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'd+'))->get_student_count();
                $d_grade = \Orm_Data_Course_Grade::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'd'))->get_student_count();
                $f_grade = \Orm_Data_Course_Grade::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'f'))->get_student_count();

                $total = $a_grade + $a_plus_grade + $b_grade + $b_plus_grade + $c_grade + $c_plus_grade + $d_grade + $d_plus_grade + $f_grade;

                $denied_entry = \Orm_Data_Course_Status::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '1'))->get_student_count();
                $in_progress = \Orm_Data_Course_Status::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '2'))->get_student_count();
                $incomplete = \Orm_Data_Course_Status::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '3'))->get_student_count();
                $pass = \Orm_Data_Course_Status::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '4'))->get_student_count();
                $fail = \Orm_Data_Course_Status::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '5'))->get_student_count();
                $withdrawn = \Orm_Data_Course_Status::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '6'))->get_student_count();

                $total_status = $denied_entry + $in_progress + $incomplete + $pass + $fail + $withdrawn;

                $grades = array();
                $grades[2][2]['num_of_student'] = $a_plus_grade;
                $grades[2][3]['student_percent'] = $total ? ($a_plus_grade / $total) : 0;
                $grades[3][2]['num_of_student'] = $a_grade;
                $grades[3][3]['student_percent'] = $total ? ($a_grade / $total) : 0;
                $grades[4][2]['num_of_student'] = $b_plus_grade;
                $grades[4][3]['student_percent'] = $total ? ($b_plus_grade / $total) : 0;
                $grades[5][2]['num_of_student'] = $b_grade;
                $grades[5][3]['student_percent'] = $c_plus_grade ? ($b_grade / $total) : 0;
                $grades[6][2]['num_of_student'] = $c_grade;
                $grades[6][3]['student_percent'] = $total ? ($c_plus_grade / $total) : 0;
                $grades[7][2]['num_of_student'] = $c_grade;
                $grades[7][3]['student_percent'] = $total ? ($c_grade / $total) : 0;
                $grades[8][2]['num_of_student'] = $d_plus_grade;
                $grades[8][3]['student_percent'] = $total ? ($d_plus_grade / $total) : 0;
                $grades[9][2]['num_of_student'] = $d_grade;
                $grades[9][3]['student_percent'] = $total ? ($d_grade / $total) : 0;
                $grades[10][2]['num_of_student'] = $f_grade;
                $grades[10][3]['student_percent'] = $total ? ($f_grade / $total) : 0;
                $grades[11][2]['num_of_student'] = $denied_entry;
                $grades[11][3]['student_percent'] = $total_status ? ( $denied_entry / $total_status) : 0;
                $grades[12][2]['num_of_student'] = $in_progress;
                $grades[12][3]['student_percent'] = $total_status ? ($in_progress / $total_status) : 0;
                $grades[13][2]['num_of_student'] = $incomplete;
                $grades[13][3]['student_percent'] = $total_status ? ($incomplete / $total_status) : 0;
                $grades[14][2]['num_of_student'] = $pass;
                $grades[14][3]['student_percent'] = $total_status ? ($pass / $total_status) : 0;
                $grades[15][2]['num_of_student'] = $fail;
                $grades[15][3]['student_percent'] = $total_status ? ($fail / $total_status) : 0;
                $grades[16][2]['num_of_student'] = $withdrawn;
                $grades[16][3]['student_percent'] = $total_status ? ($withdrawn / $total_status) : 0;

                $this->set_distribution_of_grades($grades);
            } else {
                $a_plus_grade = \Orm_Data_Course_Grade::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'a+'));
                $a_grade = \Orm_Data_Course_Grade::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'a'));
                $b_plus_grade = \Orm_Data_Course_Grade::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'b+'));
                $b_grade = \Orm_Data_Course_Grade::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'b'));
                $c_plus_grade = \Orm_Data_Course_Grade::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'c+'));
                $c_grade = \Orm_Data_Course_Grade::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'c'));
                $d_plus_grade = \Orm_Data_Course_Grade::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'd+'));
                $d_grade = \Orm_Data_Course_Grade::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'd'));
                $f_grade = \Orm_Data_Course_Grade::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'f'));

                $total = $a_grade +$a_plus_grade + $b_grade + $b_plus_grade + $c_grade + $c_plus_grade + $d_grade + $d_plus_grade + $f_grade;

                $denied_entry = \Orm_Data_Course_Status::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '1'));
                $in_progress = \Orm_Data_Course_Status::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '2'));
                $incomplete = \Orm_Data_Course_Status::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '3'));
                $pass = \Orm_Data_Course_Status::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '4'));
                $fail = \Orm_Data_Course_Status::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '5'));
                $withdrawn = \Orm_Data_Course_Status::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '6'));

                $total_status = $denied_entry + $in_progress + $incomplete + $pass + $fail + $withdrawn;

                $grades = array();
                $grades[2][2]['num_of_student'] = $a_plus_grade;
                $grades[2][3]['student_percent'] = $total ? ($a_plus_grade / $total * 100) : 0;
                $grades[3][2]['num_of_student'] = $a_grade;
                $grades[3][3]['student_percent'] = $total ? ($a_grade / $total * 100) : 0;
                $grades[4][2]['num_of_student'] = $b_plus_grade;
                $grades[4][3]['student_percent'] = $total ? ($b_plus_grade / $total * 100) : 0;
                $grades[5][2]['num_of_student'] = $b_grade;
                $grades[5][3]['student_percent'] = $total ? ($b_grade / $total * 100) : 0;
                $grades[6][2]['num_of_student'] = $c_plus_grade;
                $grades[6][3]['student_percent'] = $total ? ($c_plus_grade / $total * 100) : 0;
                $grades[7][2]['num_of_student'] = $c_grade;
                $grades[7][3]['student_percent'] = $total ? ($c_grade / $total * 100) : 0;
                $grades[8][2]['num_of_student'] = $d_plus_grade;
                $grades[8][3]['student_percent'] = $total ? ($d_plus_grade / $total * 100) : 0;
                $grades[9][2]['num_of_student'] = $d_grade;
                $grades[9][3]['student_percent'] = $total ? ($d_grade / $total * 100) : 0;
                $grades[10][2]['num_of_student'] = $f_grade;
                $grades[10][3]['student_percent'] = $total ? ($f_grade / $total * 100) : 0;
                $grades[11][2]['num_of_student'] = $denied_entry;
                $grades[11][3]['student_percent'] = $total_status ? ($denied_entry / $total_status * 100) : 0;
                $grades[12][2]['num_of_student'] = $in_progress;
                $grades[12][3]['student_percent'] = $total_status ? ($in_progress / $total_status * 100) : 0;
                $grades[13][2]['num_of_student'] = $incomplete;
                $grades[13][3]['student_percent'] = $total_status ? ($incomplete / $total_status * 100) : 0;
                $grades[14][2]['num_of_student'] = $pass;
                $grades[14][3]['student_percent'] = $total_status ? ($pass / $total_status * 100) :0;
                $grades[15][2]['num_of_student'] = $fail;
                $grades[15][3]['student_percent'] = $total_status ? ($fail / $total_status * 100) : 0;
                $grades[16][2]['num_of_student'] = $withdrawn;
                $grades[16][3]['student_percent'] = $total_status ? ($withdrawn / $total_status * 100) : 0;

                $this->set_distribution_of_grades($grades);
            }

            $this->save();
        }
    }


}