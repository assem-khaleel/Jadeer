<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 05/07/18
 * Time: 03:41 م
 */

namespace Node\ncacm18;


class Field_Report_E extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'E.  Evaluation of Field Experience Activity';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

        /*group 1 */
        $this->set_description('');
        $this->set_student_evalaution('');
        $this->set_student_recommendation('');
        $this->set_staff_evaluation('');
        $this->set_staff_recommendations('');
        $this->set_faculty_evaluation('');
        $this->set_faculty_recommendations('');
        $this->set_faculty_evaluation('');
        $this->set_faculty_recommendations('');

        /*group 2 */
        $this->set_studet_description('');
        $this->set_strengths('');
        $this->set_instructor('');

        /*group 3 */
        $this->set_other_evaluation('');
        $this->set_important_recommendations2('');
        $this->set_response_of_instructor2('');
    }

    public function set_description($value)
    {
        $property = new \Orm_Property_Textarea('description', $value);
        $property->set_description('1. Describe the evaluation process and list recommendations for improvement of field experience activities by:');
        $property->set_group('g1');
        $this->set_property($property);
    }

    public function get_description()
    {
        return $this->get_property('description')->get_value();
    }

    public function set_student_evalaution($value)
    {
        $property = new \Orm_Property_Textarea('student_evalaution', $value);
        $property->set_description('a. Students:  Describe evaluation process');
        $property->set_group('g1');
        $this->set_property($property);
    }

    public function get_student_evalaution()
    {
        return $this->get_property('student_evalaution')->get_value();
    }

    public function set_student_recommendation($value)
    {
        $property = new \Orm_Property_Textarea('student_recommendation', $value);
        $property->set_description('List recommendations for improvement.');
        $property->set_group('g1');
        $this->set_property($property);
    }

    public function get_student_recommendation()
    {
        return $this->get_property('student_recommendation')->get_value();
    }

    public function set_staff_evaluation($value)
    {
        $property = new \Orm_Property_Textarea('staff_evaluation', $value);
        $property->set_description('b. Supervising staff in the field setting:  Describe evaluation process.');
        $property->set_group('g1');
        $this->set_property($property);
    }

    public function get_staff_evaluation()
    {
        return $this->get_property('staff_evaluation')->get_value();
    }

    public function set_staff_recommendations($value)
    {
        $property = new \Orm_Property_Textarea('staff_recommendations', $value);
        $property->set_description('List recommendations for improvement.');
        $property->set_group('g1');
        $this->set_property($property);
    }

    public function get_staff_recommendations()
    {
        return $this->get_property('staff_recommendations')->get_value();
    }


    public function set_faculty_evaluation($value)
    {
        $property = new \Orm_Property_Textarea('faculty_evaluation', $value);
        $property->set_description('c. Supervising faculty from the institution:  Describe evaluation process.');
        $property->set_group('g1');
        $this->set_property($property);
    }

    public function get_faculty_evaluation()
    {
        return $this->get_property('faculty_evaluation')->get_value();
    }

    public function set_faculty_recommendations($value)
    {
        $property = new \Orm_Property_Textarea('faculty_recommendations', $value);
        $property->set_description('List recommendations for improvement.');
        $property->set_group('g1');
        $this->set_property($property);
    }

    public function get_faculty_recommendations()
    {
        return $this->get_property('faculty_recommendations')->get_value();
    }

    public function set_evaluator_evaluation($value)
    {
        $property = new \Orm_Property_Textarea('evaluator_evaluation', $value);
        $property->set_description('d. Others—(e.g. graduates, independent evaluator, etc.):  Describe evaluation process.');
        $property->set_group('g1');
        $this->set_property($property);
    }

    public function get_evaluator_evaluation()
    {
        return $this->get_property('evaluator_evaluation')->get_value();
    }

    public function set_evaluator_recommendations($value)
    {
        $property = new \Orm_Property_Textarea('evaluator_recommendations', $value);
        $property->set_description('List recommendations for improvement.');
        $property->set_group('g1');
        $this->set_property($property);
    }

    public function get_evaluator_recommendations()
    {
        return $this->get_property('evaluator_recommendations')->get_value();
    }

    public function set_studet_description($value)
    {
        $property = new \Orm_Property_Textarea('studet_description', $value);
        $property->set_description('2. Student evaluation of the field experience (Attach summary of survey results).	');
        $property->set_group('g2');
        $this->set_property($property);
    }

    public function get_studet_description()
    {
        return $this->get_property('studet_description')->get_value();
    }

    public function set_strengths($value)
    {
        $property = new \Orm_Property_Textarea('strengths', $value);
        $property->set_description('a. List the most important recommendations for improvement and strengths');
        $property->set_group('g2');
        $this->set_property($property);
    }

    public function get_strengths()
    {
        return $this->get_property('student_evalaution')->get_value();
    }

    public function set_instructor($value)
    {
        $property = new \Orm_Property_Textarea('instructor', $value);
        $property->set_description('b. Response of instructor and field staff to this evaluation');
        $property->set_group('g2');
        $this->set_property($property);
    }

    public function get_instructor()
    {
        return $this->get_property('instructor')->get_value();
    }


    public function set_other_evaluation($value)
    {
        $property = new \Orm_Property_Textarea('other_evaluation', $value);
        $property->set_description('3.  Other Evaluation (e.g. by head of department, peer observations, accreditation review, other stakeholders)');
        $property->set_group('g3');
        $this->set_property($property);
    }

    public function get_other_evaluation()
    {
        return $this->get_property('other_evaluation')->get_value();
    }

    public function set_important_recommendations2($value)
    {
        $property = new \Orm_Property_Textarea('important_recommendations2', $value);
        $property->set_description('a. List the most important  recommendations for improvement and strengths');
        $property->set_group('g3');
        $this->set_property($property);
    }

    public function get_important_recommendations2()
    {
        return $this->get_property('important_recommendations2')->get_value();
    }

    public function set_response_of_instructor2($value)
    {
        $property = new \Orm_Property_Textarea('response_of_instructor2', $value);
        $property->set_description('b. Response of instructor and field staff to this evaluation');
        $property->set_group('g3');
        $this->set_property($property);
    }

    public function get_response_of_instructor2()
    {
        return $this->get_property('response_of_instructor2')->get_value();
    }


}