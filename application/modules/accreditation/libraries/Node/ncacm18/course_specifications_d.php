<?php
/**
 * Created by PhpStorm.
 * User: dura
 * Date: 10/8/18
 * Time: 11:34 AM
 */

namespace Node\ncacm18;


class Course_Specifications_D extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $name = 'D. Teaching and Assessment';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;


    public function init()
    {
        parent::init();
        $this->set_mode_of_instruction(array());
        $this->set_alignment_of_course(array());
        $this->set_assessment_tasks(array());
        $this->set_task_note();
    }

    public function set_mode_of_instruction($value)
    {

        $contact = new \Orm_Property_Text('contact');
        $contact->set_width(100);
        $percentage = new \Orm_Property_Text('percentage');
        $percentage->set_width(100);


        $property = new \Orm_Property_Table('mode_of_instruction', $value);
        $property->set_description('1. Mode of Instruction (mark all that apply)');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('hash', '#'));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('mode', 'Mode of Instruction'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('contact', 'Contact hours'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('percentage', 'Percentage'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('one', '1'));
        $property->add_cell(2, 2, new \Orm_Property_Fixedtext('traditional classroom', 'Traditional classroom'));
        $property->add_cell(2, 3, $contact);
        $property->add_cell(2, 4, $percentage);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('tow', '2'));
        $property->add_cell(3, 2, new \Orm_Property_Fixedtext('blended', 'Blended (traditional and online)'));
        $property->add_cell(3, 3, $contact);
        $property->add_cell(3, 4, $percentage);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('three', '3'));
        $property->add_cell(4, 2, new \Orm_Property_Fixedtext('e-learning', 'E-learning'));
        $property->add_cell(4, 3, $contact);
        $property->add_cell(4, 4, $percentage);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('four', '4'));
        $property->add_cell(5, 2, new \Orm_Property_Fixedtext('correspondence', 'Correspondence'));
        $property->add_cell(5, 3, $contact);
        $property->add_cell(5, 4, $percentage);

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('five', '5'));
        $property->add_cell(6, 2, new \Orm_Property_Fixedtext('other', 'Other'));
        $property->add_cell(6, 3, $contact);
        $property->add_cell(6, 4, $percentage);


        $this->set_property($property);
    }

    public function get_mode_of_instruction()
    {
        return $this->get_property('mode_of_instruction')->get_value();
    }

    public function set_alignment_of_course($value)
    {

        $nqf_property = new \Orm_Property_Table_Dynamic('alignment_of_course', $value);

        $code = new \Orm_Property_Text('code');
        $code->set_description('Code #');
        $code->set_width(50);
        $nqf_property->add_property($code);

        $learning_domain = new \Orm_Property_Textarea('course');
        $learning_domain->set_description('Course Learning Outcomes');
        $learning_domain->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $learning_domain->set_width(200);
        $nqf_property->add_property($learning_domain);

        $assessment_methods = new \Orm_Property_Textarea('teaching');
        $assessment_methods->set_description('Teaching Strategies');
        $assessment_methods->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $assessment_methods->set_width(200);
        $nqf_property->add_property($assessment_methods);

        $benchmark = new \Orm_Property_Textarea('assessment');
        $benchmark->set_description('Assessment Methods');
        $benchmark->set_tinymce_toolbars(array('bullist numlist outdent indent'));

        $benchmark->set_width(200);
        $nqf_property->add_property($benchmark);


        $property = new \Orm_Property_Table('alignment_of_course', $value);
        $property->set_description('2. Alignment of course Learning Outcomes with Teaching Strategy and Assessment Methods');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('text', '<i> 1.0 </i>', 'Knowledge'));
        $property->add_cell(2, 1, $nqf_property);
        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('text', '<i> 2.0 </i>', 'Skills'));
        $property->add_cell(4, 1, $nqf_property);
        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('text', '<i> 3.0 </i>', 'Competencies'));
        $property->add_cell(6, 1, $nqf_property);

        $this->set_property($property);
    }

    public function get_alignment_of_course()
    {
        return $this->get_property('alignment_of_course')->get_value();
    }


    public function set_assessment_tasks($value)
    {
        $property = new \Orm_Property_Table_Dynamic('assessment_tasks', $value);
        $property->set_description('3. Assessment Tasks for Students During the course');
        $property->set_group('task');

        $hash = new \Orm_Property_Text('hash');
        $hash->set_description('#');
        $hash->set_width(50);
        $property->add_property($hash);

        $assessment_task = new \Orm_Property_Text('assessment_task');
        $assessment_task->set_description('Assessment task*');
        $assessment_task->set_width(100);
        $property->add_property($assessment_task);

        $week_due = new \Orm_Property_Text('week_due');
        $week_due->set_description('Week Due');
        $week_due->set_width(300);
        $property->add_property($week_due);

        $proportion = new \Orm_Property_Text('proportion');
        $proportion->set_description('Proportion of Total Assessment');
        $proportion->set_width(300);
        $property->add_property($proportion);

        $this->set_property($property);

    }


    public function get_assessment_tasks()
    {
        return $this->get_property('assessment_tasks')->get_value();
    }


    public function set_task_note(){
        $property = new \Orm_Property_Fixedtext('task_note','<i><strong>*Assessment task</strong></i> (i.e., essay, test, quizzes, group project, examination, speech, oral presentation, etc.)');
        $property->set_group('task');
        $this->set_property($property);
    }


    public function get_task_note(){
        return $this->get_property('task_note')->get_value();

    }


    public function get_topics()
    {

        return $this->get_property('topics')->get_value();
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

    public function integration_processes()
    {
        parent::integration_processes();
        if (\Orm::get_ci()->config->item('integration_enabled')) {
            $course_node = $this->get_parent_course_node()->get_item_id();

            if (\License::get_instance()->check_module('curriculum_mapping') && \Modules::load('curriculum_mapping')) {


                $CLOs = \Orm_Cm_Course_Learning_Outcome::get_all(array('course_id' => $course_node, 'ncaaa_code' => 6));
                $code = 0;
                $knowledge = array();
                foreach ($CLOs as $key => $CLO) {
                    $methods = array();
                    $methods_list = '';

                    foreach (\Orm_Cm_Course_Mapping_Matrix::get_all(['course_learning_outcome_id' => $CLO->get_id()]) as $method) {
                        $method_name = $method->get_course_assessment_component_obj()->get_program_assessment_method_obj()->get_assessment_method_obj()->get_title();
                        $methods[$method_name] = $method_name;
                    }

                    foreach ($methods as $method_key => $method) {
                        $methods_list .= '<li>' . $method . '</li>';
                    }

                    $knowledge[3][1]['alignment_of_course'][] = array(
                        'code' => '1.' . (++$code),
                        'course' => $CLO->get_text(),
                        'teaching' => '<ol>' . $methods_list . '</ol>',
                        'assessment' => '<ol>' . $methods_list . '</ol>'
                    );
                }
                $CLOs = \Orm_Cm_Course_Learning_Outcome::get_all(array('course_id' => $course_node, 'ncaaa_code' => 7));
                $code = 0;
                foreach ($CLOs as $key => $CLO) {
                    $methods = array();
                    $methods_list = '';

                    foreach (\Orm_Cm_Course_Mapping_Matrix::get_all(['course_learning_outcome_id' => $CLO->get_id()]) as $method) {
                        $method_name = $method->get_course_assessment_component_obj()->get_program_assessment_method_obj()->get_assessment_method_obj()->get_title();
                        $methods[$method_name] = $method_name;
                    }

                    foreach ($methods as $method_key => $method) {
                        $methods_list .= '<li>' . $method . '</li>';
                    }
                    $knowledge[5][1]['alignment_of_course'][] = array(
                        'code' => '2.' . (++$code),
                        'course' => $CLO->get_text(),
                        'teaching' => '<ol>' . $methods_list . '</ol>',
                        'assessment' => '<ol>' . $methods_list . '</ol>'
                    );
                }

                $CLOs = \Orm_Cm_Course_Learning_Outcome::get_all(array('course_id' => $course_node, 'ncaaa_code' => 8));
                $code = 0;
                foreach ($CLOs as $key => $CLO) {
                    $methods = array();
                    $methods_list = '';

                    foreach (\Orm_Cm_Course_Mapping_Matrix::get_all(['course_learning_outcome_id' => $CLO->get_id()]) as $method) {
                        $method_name = $method->get_course_assessment_component_obj()->get_program_assessment_method_obj()->get_assessment_method_obj()->get_title();
                        $methods[$method_name] = $method_name;
                    }

                    foreach ($methods as $method_key => $method) {
                        $methods_list .= '<li>' . $method . '</li>';
                    }
                    $knowledge[7][1]['alignment_of_course'][] = array(
                        'code' => '3.' . (++$code),
                        'course' => $CLO->get_text(),
                        'teaching' => '<ol>' . $methods_list . '</ol>',
                        'assessment' => '<ol>' . $methods_list . '</ol>'
                    );
                }

                $this->set_alignment_of_course($knowledge);

            }
            $this->save();
        }

    }

}