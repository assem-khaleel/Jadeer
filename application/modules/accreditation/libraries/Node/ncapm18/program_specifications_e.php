<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 11/10/18
 * Time: 12:33 م
 */

namespace Node\ncapm18;


class  Program_Specifications_E extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $name = 'E. Program Structure';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

        $this->set_structure(array());
        $this->set_program_learning_outcome();
        /* Knowledge */
        $this->set_program_outcomes_knowledge(array());
        /* Skills */
        $this->set_program_outcomes_skills(array());
        /* Competence */
        $this->set_program_outcomes_competence(array());

        $this->set_curriculum_study_plan_levels(array());

    }

    public function set_structure($value)
    {

        $required_elective = new \Orm_Property_Radio('required_elective');
        $required_elective->set_options(array('Required', 'Elective'));
        $required_elective->set_width(200);

        $courses = new \Orm_Property_Text('courses');
        $courses->set_width(100);

        $credit_hrs = new \Orm_Property_Text('credit_hrs');
        $credit_hrs->set_width(100);

        $percentage = new \Orm_Property_Text('percentage');
        $percentage->set_width(100);

        $property = new \Orm_Property_Table('structure', $value);
        $property->set_description('1.Curriculum structure');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('structure', 'Program Structure'));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('required_elective', 'Required/ Elective'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('courses_num', 'No. of courses'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('credit_hrs', 'Credit Hours'));
        $property->add_cell(1, 5, new \Orm_Property_Fixedtext('percentage', 'Percentage'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('university', 'University Requirements'));
        $property->add_cell(2, 2, $required_elective);
        $property->add_cell(2, 3, $courses);
        $property->add_cell(2, 4, $credit_hrs);
        $property->add_cell(2, 5, $percentage);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('college', 'College Requirements'));
        $property->add_cell(3, 2, $required_elective);
        $property->add_cell(3, 3, $courses);
        $property->add_cell(3, 4, $credit_hrs);
        $property->add_cell(3, 5, $percentage);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('program', 'Program Requirements'));
        $property->add_cell(4, 2, $required_elective);
        $property->add_cell(4, 3, $courses);
        $property->add_cell(4, 4, $credit_hrs);
        $property->add_cell(4, 5, $percentage);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('project', 'Project'));
        $property->add_cell(5, 2, $required_elective);
        $property->add_cell(5, 3, $courses);
        $property->add_cell(5, 4, $credit_hrs);
        $property->add_cell(5, 5, $percentage);

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('internship', 'Field Experience/ Internship'));
        $property->add_cell(6, 2, $required_elective);
        $property->add_cell(6, 3, $courses);
        $property->add_cell(6, 4, $credit_hrs);
        $property->add_cell(6, 5, $percentage);

        $property->add_cell(7, 1, new \Orm_Property_Fixedtext('others', 'Others'));
        $property->add_cell(7, 2, $required_elective);
        $property->add_cell(7, 3, $courses);
        $property->add_cell(7, 4, $credit_hrs);
        $property->add_cell(7, 5, $percentage);

        $property->add_cell(8, 1, new \Orm_Property_Fixedtext('total', 'Total'));
        $property->add_cell(8, 2, $required_elective);
        $property->add_cell(8, 3, $courses);
        $property->add_cell(8, 4, $credit_hrs);
        $property->add_cell(8, 5, $percentage);

        $this->set_property($property);
    }

    public function get_structure()
    {
        return $this->get_property('structure')->get_value();
    }

    public function set_program_learning_outcome()
    {
        $property = new \Orm_Property_Fixedtext('program_learning_outcome', '<strong>2. Program Learning Outcomes Mapping Matrix</strong> <br/>'
            . 'Align the courses’ LOs with the program learning outcomes. according to the level of instruction ( I = Introduced, P = Practiced, M= Mastery, and A = Assessed ).');
        $this->set_property($property);
    }

    public function get_program_learning_outcome()
    {
        return $this->get_property('program_learning_outcome')->get_value();
    }

    private $course_options = array();

    private function get_course_options()
    {

        if ($this->get_id()) {
            $program_id = $this->get_parent_program_node()->get_item_obj()->get_id();

            if (!isset($this->course_options[$program_id])) {
                $course_options = array('' => 'Select One');

                $plans = \Orm_Program_Plan::get_all(array('program_id' => $program_id));
                foreach ($plans as $plan) {
                    $course = $plan->get_course_obj();
                    $course_options[$course->get_number('english')] = $course->get_name('english');
                }

                $this->course_options[$program_id] = $course_options;
            }

            return $this->course_options[$program_id];
        }

        return array();
    }

    /*
   * Knowledge
   */
    public function set_program_outcomes_knowledge($value)
    {

        $property_add_more = new \Orm_Property_Add_More('program_outcomes_knowledge', $value);
        $property_add_more->set_description('Knowledge');

        $learning_outcomes = new \Orm_Property_Text('learning_outcomes');
        $learning_outcomes->set_description('Learning Outcome (Knowledge)');
        $property_add_more->add_property($learning_outcomes);

        $property = new \Orm_Property_Table_Dynamic('course_levels');

        $course_code = new \Orm_Property_Select('course_code');
        $course_code->set_description('Course code & No.');
        $course_code->set_width(400);
        $course_code->set_is_key_value(true);
        $course_code->set_options($this->get_course_options());
        $property->add_property($course_code);

        $levels = new \Orm_Property_Select('level');
        $levels->set_description('Level');
        $levels->set_width(200);
        $levels->set_is_key_value(true);
        $levels->set_options(array(
            'I' => 'Introduction',
            'P' => 'Proficient',
            'M' => 'Mastery',
            'A' => 'Advanced'
        ));

        $property->add_property($levels);

        $property_add_more->add_property($property);

        $this->set_property($property_add_more);
    }

    public function get_program_outcomes_knowledge()
    {
        return $this->get_property('program_outcomes_knowledge')->get_value();
    }

    /*
     * Skills
     */

    public function set_program_outcomes_skills($value)
    {

        $property_add_more = new \Orm_Property_Add_More('program_outcomes_skills', $value);
        $property_add_more->set_description('Skills');

        $learning_outcomes = new \Orm_Property_Text('learning_outcomes');
        $learning_outcomes->set_description('Learning Outcome (Skills)');
        $property_add_more->add_property($learning_outcomes);

        $property = new \Orm_Property_Table_Dynamic('course_levels');

        $course_code = new \Orm_Property_Select('course_code');
        $course_code->set_description('Course code & No.');
        $course_code->set_width(400);
        $course_code->set_is_key_value(true);
        $course_code->set_options($this->get_course_options());
        $property->add_property($course_code);

        $levels = new \Orm_Property_Select('level');
        $levels->set_description('Level');
        $levels->set_width(200);
        $levels->set_is_key_value(true);
        $levels->set_options(array(
            'I' => 'Introduction',
            'P' => 'Proficient',
            'M' => 'Mastery',
            'A' => 'Advanced'
        ));

        $property->add_property($levels);

        $property_add_more->add_property($property);

        $this->set_property($property_add_more);
    }

    public function get_program_outcomes_skills()
    {
        return $this->get_property('program_outcomes_skills')->get_value();
    }

    /*
     * Competence
     */
    public function set_program_outcomes_competence($value)
    {

        $property_add_more = new \Orm_Property_Add_More('program_outcomes_competence', $value);
        $property_add_more->set_description('Competence');

        $learning_outcomes = new \Orm_Property_Text('learning_outcomes');
        $learning_outcomes->set_description('Learning Outcome (Skills)');
        $property_add_more->add_property($learning_outcomes);

        $property = new \Orm_Property_Table_Dynamic('course_levels');

        $course_code = new \Orm_Property_Select('course_code');
        $course_code->set_description('Course code & No.');
        $course_code->set_width(400);
        $course_code->set_is_key_value(true);
        $course_code->set_options($this->get_course_options());
        $property->add_property($course_code);

        $levels = new \Orm_Property_Select('level');
        $levels->set_description('Level');
        $levels->set_width(200);
        $levels->set_is_key_value(true);
        $levels->set_options(array(
            'I' => 'Introduction',
            'P' => 'Proficient',
            'M' => 'Mastery',
            'A' => 'Advanced'
        ));

        $property->add_property($levels);

        $property_add_more->add_property($property);

        $this->set_property($property_add_more);
    }

    public function get_program_outcomes_competence()
    {
        return $this->get_property('program_outcomes_competence')->get_value();
    }

    public function set_curriculum_study_plan_levels($value)
    {

        $property_add_more = new \Orm_Property_Add_More('curriculum_study_plan_levels', $value);
//        $property_add_more->set_group('set_curriculum_study_plan');
        $property_add_more->set_description('3. Program courses');

        $level = new \Orm_Property_Text('level');
        $level->set_description('Level');
        $property_add_more->add_property($level);

        $property = new \Orm_Property_Table_Dynamic('curriculum_study_plan', $value);

        $property->set_is_responsive(true);

        $course_code = new \Orm_Property_Text('course_code');
        $course_code->set_description('Course Code');
        $course_code->set_width(100);
        $property->add_property($course_code);

        $course_title = new \Orm_Property_Text('course_title');
        $course_title->set_description('Course Title');
        $course_title->set_width(200);
        $property->add_property($course_title);


        $prerequired_or_elective = new \Orm_Property_Text('prerequired_or_elective');
        $prerequired_or_elective->set_description('Pre- Requisite Courses');
        $prerequired_or_elective->set_width(200);
        $property->add_property($prerequired_or_elective);

        $credit_houre = new \Orm_Property_Text('credit_houre');
        $credit_houre->set_description('Credit Hours');
        $credit_houre->set_width(100);
        $property->add_property($credit_houre);

        $required_or_elective = new \Orm_Property_Radio('required_or_elective');
        $required_or_elective->set_description('Required or Elective');
        $required_or_elective->set_width(100);
        $required_or_elective->set_group('Course type');
        $required_or_elective->set_options(array('Required', 'Elective'));
        $property->add_property($required_or_elective);

        $college_or_department = new \Orm_Property_Text('college_or_department');
        $college_or_department->set_description('University, College or Departmen');
        $college_or_department->set_width(200);
        $college_or_department->set_group('Course type');
        $property->add_property($college_or_department);

        $property_add_more->add_property($property);

        $this->set_property($property_add_more);
    }

    public function get_curriculum_study_plan_levels()
    {
        return $this->get_property('curriculum_study_plan_levels')->get_value();
    }

    public function draw_report_program_outcomes_map($property, $pdf = false)
    {

        $html = '<div class="form-group">';

        if (is_array($property->get_value())) {

            $cols = array();
            foreach ($property->get_value() as $col) {
                if(!empty($col['course_levels']) && is_array($col['course_levels'])) {
                    foreach ($col['course_levels'] as $course_level) {
                        $course_code = trim(strtoupper(isset($course_level['course_code']) ? $course_level['course_code'] : ''));
                        if ($course_code) {
                            $cols[$course_code] = $course_code;
                        }
                    }
                }
            }

            if ($cols) {
                $html .= '<div class="table-primary table-responsive" >';
                $html .= '<table class="table table-striped table-bordered" border="1">';
                $html .= '<thead>';
                $html .= '<tr>';
                $html .= '<td>';
                $html .= $property->get_description();
                $html .= '</td>';
                foreach ($cols as $col) {
                    $html .= '<td>';
                    $html .= $col;
                    $html .= '</td>';
                }
                $html .= '</tr>';
                $html .= '</thead>';
                $html .= '<tbody>';
                foreach ($property->get_value() as $row) {
                    $html .= '<tr>';
                    $html .= '<td>';
                    $html .= (isset($row['learning_outcomes']) ? $row['learning_outcomes'] : '');
                    $html .= '</td>';
                    foreach ($cols as $col) {
                        $html .= '<td>';
                        foreach ($property->get_value() as $row1) {
                            if(!empty($row1['course_levels']) && is_array($row1['course_levels'])) {
                                foreach ($row1['course_levels'] as $course_level) {
                                    $course_code = trim(strtoupper(isset($course_level['course_code']) ? $course_level['course_code'] : ''));
                                    if(isset($row['learning_outcomes']) && isset($row1['learning_outcomes'])) {
                                        if ($row['learning_outcomes'] == $row1['learning_outcomes'] && $col == $course_code) {
                                            $html .= (isset($course_level['level']) ? $course_level['level'] : '');
                                        }
                                    }
                                }
                            }
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
                $html .= 'There is No ' . $property->get_description() . ' Learning Outcomes  Mapping Matrix';
                $html .= '</div>';
            }
        } else {
            $html .= '<div class="label label-danger">';
            $html .= 'There is No ' . $property->get_description() . ' Learning Outcomes  Mapping Matrix';
            $html .= '</div>';
        }

        $html .= '</div>';

        return $html;
    }

    public function draw_report_program_outcomes_knowledge($pdf = false)
    {
        $property = $this->get_property('program_outcomes_knowledge');
        return $this->draw_report_program_outcomes_map($property, $pdf);
    }

    public function draw_report_program_outcomes_skills($pdf = false)
    {
        $property = $this->get_property('program_outcomes_skills');
        return $this->draw_report_program_outcomes_map($property, $pdf);
    }

    public function draw_report_program_outcomes_competence($pdf = false)
    {
        $property = $this->get_property('program_outcomes_competence');
        return $this->draw_report_program_outcomes_map($property, $pdf);
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

                $program_plan = \Orm_Program_Plan::get_all(array('program_id' => $program_obj->get_id()),0,0,array('pp.level'));

                if (\License::get_instance()->check_module('curriculum_mapping') && \Modules::load('curriculum_mapping')) {
                    $assessment_methods = \Orm_Cm_Program_Assessment_Method::get_all(array('program_id' => $program_obj->get_id()));

                    //Knowledge Mapping Matrix
                    $knowledge_mapping = array();
                    $knowledge_plo = \Orm_Cm_Program_Learning_Outcome::get_all(array('ncaaa_code' => 1,'program_id' => $program_obj->get_id()));
                    foreach ($knowledge_plo as $plo)
                    {
                        $courses = \Orm_Cm_Program_Mapping_Matrix::get_all(array('program_learning_outcome_id' => $plo->get_id()));
                        if (count($courses)) {
                            $mapped_courses = array();
                            foreach ($courses as $course)
                            {
                                $mapped_courses[] = array(
                                    'course_code' => $course->get_course_obj()->get_code('english'),
                                    'level' => mb_strtoupper($course->get_ipa())
                                );
                            }
                            $knowledge_mapping[] = array(
                                'learning_outcomes' => $plo->get_text(),
                                'course_levels' => $mapped_courses
                            );
                        }
                    }

                    $this->set_program_outcomes_knowledge($knowledge_mapping);

                    //Cognitive Mapping Matrix
                    $cognitive_mapping = array();
                    $cognitive_plo = \Orm_Cm_Program_Learning_Outcome::get_all(array('ncaaa_code' => 2,'program_id' => $program_obj->get_id()));
                    foreach ($cognitive_plo as $plo)
                    {
                        $courses = \Orm_Cm_Program_Mapping_Matrix::get_all(array('program_learning_outcome_id' => $plo->get_id()));
                        if (count($courses)) {
                            $mapped_courses = array();
                            foreach ($courses as $course)
                            {
                                $mapped_courses[] = array(
                                    'course_code' => $course->get_course_obj()->get_code('english'),
                                    'level' => mb_strtoupper($course->get_ipa())
                                );
                            }
                            $cognitive_mapping[] = array(
                                'learning_outcomes' => $plo->get_text(),
                                'course_levels' => $mapped_courses
                            );
                        }
                    }

                    $this->set_program_outcomes_skills($cognitive_mapping);

                    //Interpersonal Skills & Responsibility Mapping Matrix
                    $ethics_mapping = array();
                    $interpersonal_plo = \Orm_Cm_Program_Learning_Outcome::get_all(array('ncaaa_code' => 3,'program_id' => $program_obj->get_id()));
                    foreach ($interpersonal_plo as $plo)
                    {
                        $courses = \Orm_Cm_Program_Mapping_Matrix::get_all(array('program_learning_outcome_id' => $plo->get_id()));
                        if (count($courses)) {
                            $mapped_courses = array();
                            foreach ($courses as $course)
                            {
                                $mapped_courses[] = array(
                                    'course_code' => $course->get_course_obj()->get_code('english'),
                                    'level' => mb_strtoupper($course->get_ipa())
                                );
                            }
                            $ethics_mapping[] = array(
                                'learning_outcomes' => $plo->get_text(),
                                'course_levels' => $mapped_courses
                            );
                        }
                    }

                    $this->set_program_outcomes_competence($ethics_mapping);

                }

                $levels = array();

                foreach ($program_plan as $course) {
                    $pre = \Orm_Data_Course_Pre::get_all(array('course_id' => $course->get_id(),'program_id' => $program_obj->get_id()));
                    $pre_courses = array();
                    foreach ($pre as $c) {
                        $pre_courses[] = $c->get_pre_course_obj()->get_name('name');
                    }
                    $levels[$course->get_level()]['level'] = 'Level '.$course->get_level();
                    $levels[$course->get_level()]['curriculum_study_plan'][] = array(
                        'course_code' => $course->get_course_obj()->get_code('english'),
                        'course_title' => $course->get_course_obj()->get_name('english'),
                        'prerequired_or_elective' => implode(' / ',$pre_courses),
                        'credit_houre' => $course->get_credit_hours(),
                        'required_or_elective' => $course->get_is_required() ? 'Required' : 'Elective',
                        'college_or_department' => $course->get_course_obj()->get_department_obj()->get_name('english') . '/' .$course->get_course_obj()->get_department_obj()->get_college_obj()->get_name('english')
                    );
                }

                $this->set_curriculum_study_plan_levels($levels);
            }
            $this->save();
        }
    }




}