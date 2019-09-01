<?php
/**
 * Created by PhpStorm.
 * User: dura
 * Date: 10/9/18
 * Time: 10:01 AM
 */

namespace Node\ncacm18;


class Course_Report_B extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $name = 'B. Student Results';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;


    public function init()
    {
        parent::init();
        $this->set_distribution_of_grades(array());
        $this->set_comment('');
        $this->set_recommendations('');


    }
    public function set_distribution_of_grades($value)
    {
        $a_plus = new \Orm_Property_Text('a_plus');
        $a_plus->set_width(50);
        $a = new \Orm_Property_Text('a');
        $a->set_width(50);
        $b_plus = new \Orm_Property_Text('b_plus');
        $b_plus->set_width(50);
        $b = new \Orm_Property_Text('b');
        $b->set_width(50);
        $c_plus = new \Orm_Property_Text('c_plus');
        $c_plus->set_width(50);
        $c = new \Orm_Property_Text('c');
        $c->set_width(50);
        $d_plus = new \Orm_Property_Text('d_plus');
        $d_plus->set_width(50);
        $d = new \Orm_Property_Text('d');
        $d->set_width(50);
        $f = new \Orm_Property_Text('f');
        $f->set_width(50);


        $denied_entry = new \Orm_Property_Text('denied_entry');
        $denied_entry->set_width(100);
        $in_progress = new \Orm_Property_Text('in_progress');
        $in_progress->set_width(100);
        $incomplete = new \Orm_Property_Text('incomplete');
        $incomplete->set_width(100);
        $pass = new \Orm_Property_Text('pass');
        $pass->set_width(100);
        $fail = new \Orm_Property_Text('fail');
        $fail->set_width(100);
        $withdrawn = new \Orm_Property_Text('withdrawn');
        $withdrawn->set_width(100);


        $property = new \Orm_Property_Table('distribution_of_grades', $value);
        $property->set_description('1. Distribution of Grades');


        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('', ''),2.0);
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('grades', 'Grades'),1,9);
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('status_distributions', 'status distributions'),1,6);


        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('a_plus', 'A+'));
        $property->add_cell(2, 2, new \Orm_Property_Fixedtext('a', 'A'));
        $property->add_cell(2, 3, new \Orm_Property_Fixedtext('b_plus', 'B+'));
        $property->add_cell(2, 4, new \Orm_Property_Fixedtext('b', 'B'));
        $property->add_cell(2, 5, new \Orm_Property_Fixedtext('c_plus', 'C+'));
        $property->add_cell(2, 6, new \Orm_Property_Fixedtext('c', 'C'));
        $property->add_cell(2, 7, new \Orm_Property_Fixedtext('d_plus', 'D+'));
        $property->add_cell(2, 8, new \Orm_Property_Fixedtext('d', 'D'));
        $property->add_cell(2, 9, new \Orm_Property_Fixedtext('f', 'F'));

        $property->add_cell(2, 10, new \Orm_Property_Fixedtext('entry', 'Denied Entry'));
        $property->add_cell(2, 11, new \Orm_Property_Fixedtext('progress', 'In Progress'));
        $property->add_cell(2, 12, new \Orm_Property_Fixedtext('incomplete', 'Incomplete'));
        $property->add_cell(2, 13, new \Orm_Property_Fixedtext('pass', 'Pass'));
        $property->add_cell(2, 14, new \Orm_Property_Fixedtext('fail', 'Fail'));
        $property->add_cell(2, 15,new \Orm_Property_Fixedtext('withdrawn', 'Withdrawn'));



        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('number_of_Student', 'Number of Student'));
        $property->add_cell(3, 2, $a_plus);
        $property->add_cell(3, 3, $a);
        $property->add_cell(3, 4, $b_plus);
        $property->add_cell(3, 5, $b);
        $property->add_cell(3, 6, $c_plus);
        $property->add_cell(3, 7, $c);
        $property->add_cell(3, 8, $d_plus);
        $property->add_cell(3, 9, $d);
        $property->add_cell(3, 10, $f);


        $property->add_cell(3, 11, $denied_entry);
        $property->add_cell(3, 12, $in_progress);
        $property->add_cell(3, 13, $incomplete);
        $property->add_cell(3, 14, $pass);
        $property->add_cell(3, 15, $fail);
        $property->add_cell(3, 16, $withdrawn);




        $this->set_property($property);
    }

    public function get_distribution_of_grades()
    {
        return $this->get_property('distribution_of_grades')->get_value();
    }

    public function set_comment($value){
        $property = new \Orm_Property_Textarea('comment',$value);
        $property->set_description('2. Comment on student results (including special factors (if any) affecting the results)');
        $this->set_property($property);
    }

    public function get_comment(){

        return $this->get_property('comment')->get_value();
    }

    public function set_recommendations($value){
        $property = new \Orm_Property_Textarea('recommendations',$value);
        $property->set_description('3. Recommendations');
        $this->set_property($property);
    }

    public function get_recommendations(){

        return $this->get_property('recommendations')->get_value();
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
                $b_plus_grade= \Orm_Data_Course_Grade::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'b+'))->get_student_count();
                $b_grade = \Orm_Data_Course_Grade::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'b'))->get_student_count();
                $c_plus_grade = \Orm_Data_Course_Grade::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'c+'))->get_student_count();
                $c_grade = \Orm_Data_Course_Grade::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'c'))->get_student_count();
                $d_plus_grade = \Orm_Data_Course_Grade::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'd+'))->get_student_count();
                $d_grade = \Orm_Data_Course_Grade::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'd'))->get_student_count();
                $f_grade = \Orm_Data_Course_Grade::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'grade' => 'f'))->get_student_count();


                $denied_entry = \Orm_Data_Course_Status::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '1'))->get_student_count();
                $in_progress = \Orm_Data_Course_Status::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '2'))->get_student_count();
                $incomplete = \Orm_Data_Course_Status::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '3'))->get_student_count();
                $pass = \Orm_Data_Course_Status::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '4'))->get_student_count();
                $fail = \Orm_Data_Course_Status::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '5'))->get_student_count();
                $withdrawn = \Orm_Data_Course_Status::get_one(array('course_id' => $course_node,'section_id' => $course_section_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '6'))->get_student_count();


                $grades = array();
                $grades[3][2]['a_plus'] = $a_plus_grade;
                $grades[3][3]['a'] = $a_grade;
                $grades[3][4]['b_plus'] = $b_plus_grade;
                $grades[3][5]['b'] = $b_grade;
                $grades[3][6]['c_plus'] = $c_plus_grade;
                $grades[3][7]['c'] = $c_grade;
                $grades[3][8]['d_plus'] = $d_plus_grade;
                $grades[3][9]['d'] = $d_grade;
                $grades[3][10]['f'] = $f_grade;


                $grades[3][11]['denied_entry'] = $denied_entry;
                $grades[3][12]['in_progress'] = $in_progress;
                $grades[3][13]['incomplete'] = $incomplete;
                $grades[3][14]['pass'] = $pass;
                $grades[3][15]['fail'] = $fail;
                $grades[3][16]['withdrawn'] = $withdrawn;

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


                $denied_entry = \Orm_Data_Course_Status::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '1'));
                $in_progress = \Orm_Data_Course_Status::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '2'));
                $incomplete = \Orm_Data_Course_Status::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '3'));
                $pass = \Orm_Data_Course_Status::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '4'));
                $fail = \Orm_Data_Course_Status::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '5'));
                $withdrawn = \Orm_Data_Course_Status::get_sum(array('course_id' => $course_node,'semester_id' => $this->get_parent_semester_node()->get_item_id(),'status_id' => '6'));


                $grades = array();
                $grades[3][2]['a_plus'] = $a_plus_grade;
                $grades[3][3]['a'] = $a_grade;
                $grades[3][4]['b_plus'] = $b_plus_grade;
                $grades[3][5]['b'] = $b_grade;
                $grades[3][6]['c_plus'] = $c_plus_grade;
                $grades[3][7]['c'] = $c_grade;
                $grades[3][8]['d_plus'] = $d_plus_grade;
                $grades[3][9]['d'] = $d_grade;
                $grades[3][10]['f'] = $f_grade;


                $grades[3][11]['denied_entry'] = $denied_entry;
                $grades[3][12]['in_progress'] = $in_progress;
                $grades[3][13]['incomplete'] = $incomplete;
                $grades[3][14]['pass'] = $pass;
                $grades[3][15]['fail'] = $fail;
                $grades[3][16]['withdrawn'] = $withdrawn;

                $this->set_distribution_of_grades($grades);
            }

            $this->save();
        }
    }
}