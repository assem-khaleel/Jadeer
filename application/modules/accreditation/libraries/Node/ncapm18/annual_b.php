<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 08/10/18
 * Time: 12:52 م
 */

namespace Node\ncapm18;


class Annual_B extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'B. General Statistics';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

        $this->set_student();
        $this->set_student_started('');
        $this->set_student_graduated('');
        $this->set_major(array());
        $this->set_student_intermediate('');
        $this->set_completion_rate(array());
        $this->set_student_comment('');
        $this->set_cohort(array());
        $this->set_analysis(array());

    }

    public function set_student()
    {
        $property = new \Orm_Property_Fixedtext('student', '1. Students');
        $property->set_group('student');
        $this->set_property($property);

    }

    public function get_student()
    {
        return $this->get_property('student')->get_value();

    }

    public function set_student_started($value)
    {
        $property = new \Orm_Property_Text('student_started', $value);
        $property->set_description('1. Number of students who started the program in the year concerned');
        $property->set_group('student');
        $this->set_property($property);

    }

    public function get_student_started()
    {
        return $this->get_property('student_started')->get_value();

    }

    public function set_student_graduated($value)
    {
        $property = new \Orm_Property_Text('student_graduated', $value);
        $property->set_description('2. Number of students who graduated in the concerned year');
        $property->set_group('student');
        $this->set_property($property);

    }

    public function get_student_graduated()
    {
        return $this->get_property('student_graduated')->get_value();

    }

    public function set_major($value)
    {
        $property = new \Orm_Property_Add_More('major', $value);
        $property->set_description('3. Number of students who Completed major tracks within the program (if applicable)');
        $property->set_group('student');

        $title = new \Orm_Property_Text('title');
        $title->set_description('Title');
        $property->add_property($title);

        $number = new \Orm_Property_Text('number');
        $property->add_property($number);

        $this->set_property($property);

    }

    public function get_major()
    {
        return $this->get_property('major')->get_value();

    }

    public function set_student_intermediate($value)
    {
        $property = new \Orm_Property_Text('student_intermediate', $value);
        $property->set_description('4. Number of students who Completed an intermediate award specified as an early exit point  (if any)');
        $property->set_group('student');
        $this->set_property($property);

    }

    public function get_student_intermediate()
    {
        return $this->get_property('student_intermediate')->get_value();

    }


    public function set_completion_rate($value)
    {
        $property = new \Orm_Property_Table('completion_rate', $value);
        $property->set_description('5.Completion rate');
        $property->set_group('student');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('complete_min', 'a. Percentage of graduates students who completed the program in the minimal time ( Completion rate)'));
        $property->add_cell(1, 2, new \Orm_Property_Percentage('complete_min'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('complete_intermediate', 'b. Percentage of graduates students who completed an intermediate exit Points/awarded degree in the minimal time (if any)'));
        $property->add_cell(2, 2, new \Orm_Property_Percentage('complete_intermediate'));

        $this->set_property($property);

    }

    public function get_completion_rate()
    {
        return $this->get_property('completion_rate')->get_value();

    }

    public function set_student_comment($value)
    {
        $property = new \Orm_Property_Textarea('student_comment', $value);
        $property->set_description('Comment on any special or unusual factors that might have affected the apparent completion rates');
        $property->set_group('student');
        $this->set_property($property);

    }

    public function get_student_comment()
    {
        return $this->get_property('student_comment')->get_value();

    }

    public function set_cohort($value)
    {
        $semester = \Orm_Semester::get_active_semester();

        $total = new \Orm_Property_Text('total');
        $retained = new \Orm_Property_Text('retained');
        $withdrawn = new \Orm_Property_Text('withdrawn');
        $dropped = new \Orm_Property_Text('dropped');
        $graduated = new \Orm_Property_Text('graduated');

        $third_year = $semester->get_year() - 3;
        $second_year = $semester->get_year() - 2;
        $last_year = $semester->get_year() - 1;
        $year = $semester->get_year();


        $property = new \Orm_Property_Add_More('cohort', $value);
        $property->set_description('2 . Cohort Analysis of current graduate batch.');

        $branch = new \Orm_Property_Text('branch');
        $branch->set_description('Branch');
        $property->add_property($branch);

        $cohort_table = new \Orm_Property_Table('cohort_table');

        $cohort_table->add_cell(1, 1, new \Orm_Property_Fixedtext('category', 'Student Categories'));
        $cohort_table->add_cell(1, 2, new \Orm_Property_Fixedtext('total', 'Total cohort enrollment'));
        $cohort_table->add_cell(1, 3, new \Orm_Property_Fixedtext('retained', 'Retained till the end of year'));
        $cohort_table->add_cell(1, 4, new \Orm_Property_Fixedtext('withdrawn', 'Withdrawn'));
        $cohort_table->add_cell(1, 5, new \Orm_Property_Fixedtext('dropped', 'Dropped and Retained in the same year'));
        $cohort_table->add_cell(1, 6, new \Orm_Property_Fixedtext('graduated', 'Cohort graduated successfully'));

        $cohort_table->add_cell(2, 1, new \Orm_Property_Fixedtext('five_year', 'Five Years Ago (Optional)'));
        $cohort_table->add_cell(2, 2, $total);
        $cohort_table->add_cell(2, 3, $retained);
        $cohort_table->add_cell(2, 4, $withdrawn);
        $cohort_table->add_cell(2, 5, $dropped);
        $cohort_table->add_cell(2, 6, $graduated);

        $cohort_table->add_cell(3, 1, new \Orm_Property_Fixedtext('four_year', 'Four Years Ago (Optional)'));
        $cohort_table->add_cell(3, 2, $total);
        $cohort_table->add_cell(3, 3, $retained);
        $cohort_table->add_cell(3, 4, $withdrawn);
        $cohort_table->add_cell(3, 5, $dropped);
        $cohort_table->add_cell(3, 6, $graduated);

        $cohort_table->add_cell(4, 1, new \Orm_Property_Fixedtext('three_year', 'Three Years Ago'));
        $cohort_table->add_cell(4, 2, $total);
        $cohort_table->add_cell(4, 3, $retained);
        $cohort_table->add_cell(4, 4, $withdrawn);
        $cohort_table->add_cell(4, 5, $dropped);
        $cohort_table->add_cell(4, 6, $graduated);

        $cohort_table->add_cell(5, 1, new \Orm_Property_Fixedtext('two_year', 'Two Years Ago'));
        $cohort_table->add_cell(5, 2, $total);
        $cohort_table->add_cell(5, 3, $retained);
        $cohort_table->add_cell(5, 4, $withdrawn);
        $cohort_table->add_cell(5, 5, $dropped);
        $cohort_table->add_cell(5, 6, $graduated);

        $cohort_table->add_cell(6, 1, new \Orm_Property_Fixedtext('last_year', 'Last Year'));
        $cohort_table->add_cell(6, 2, $total);
        $cohort_table->add_cell(6, 3, $retained);
        $cohort_table->add_cell(6, 4, $withdrawn);
        $cohort_table->add_cell(6, 5, $dropped);
        $cohort_table->add_cell(6, 6, $graduated);

        $cohort_table->add_cell(7, 1, new \Orm_Property_Fixedtext('current', 'Current Year'));
        $cohort_table->add_cell(7, 2, $total);
        $cohort_table->add_cell(7, 3, $retained);
        $cohort_table->add_cell(7, 4, $withdrawn);
        $cohort_table->add_cell(7, 5, $dropped);
        $cohort_table->add_cell(7, 6, $graduated);

        $property->add_property($cohort_table);

        $comment = new \Orm_Property_Textarea('comment');
        $comment->set_description('Comment on the results');
        $property->add_property($comment);

        $this->set_property($property);


    }

    public function get_cohort()
    {
        return $this->get_property('cohort')->get_value();
    }

    public function set_analysis($value)
    {
        $property = new \Orm_Property_Add_More('analysis', $value);
        $property->set_description('3.Analysis ( list of strength, points for improvements and recommendations for General Statistics )');

        $strength = new \Orm_Property_Textarea('strength');
        $strength->set_description('Strengths');
        $property->add_property($strength);

        $points = new \Orm_Property_Textarea('points');
        $points->set_description('Points for improvements');
        $property->add_property($points);


        $recommendation = new \Orm_Property_Textarea('recommendation');
        $recommendation->set_description('Recommendations');
        $property->add_property($recommendation);

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
                $program_obj = $program_node->get_item_obj(); /* @var $program_obj \Orm_Program */
                $department_obj = $program_obj->get_department_obj();
                $college_obj = $department_obj->get_college_obj();
                $campuses_obj = $college_obj->get_campuses();

                $this->set_student_started(\Orm_Data_Graduate::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year()),'enrolled'));
                $this->set_student_graduated(\Orm_Data_Graduate::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year()),'graduate'));

                $numbers = array();
                foreach ($program_obj->get_majors() as $major) {
                    $numbers[] = array(
                        'title' => $major->get_name('english'),
                        'no' => \Orm_Data_Graduate::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year(),'major' => $major->get_id()),'graduate')
                    );
                }
                $this->set_major($numbers);

                $percentages = array();

                $percentage = \Orm_Data_Graduate::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year()),'enrolled') ? \Orm_Data_Graduate::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year()),'graduate') / \Orm_Data_Graduate::get_sum(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year()),'enrolled') * 100 : 0;

                $percentages[1][2]['complete_min'] = $percentage;

                $this->set_completion_rate($percentages);

                $majors = array();
                foreach ($campuses_obj as $campuse) {
                    $majors[] = array(
                        'branch' => $campuse->get_name('english'),
                    );
                }
                 $this->set_cohort($majors);

                }
            }

            $this->save();
        }


}