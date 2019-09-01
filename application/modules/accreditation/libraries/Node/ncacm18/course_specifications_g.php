<?php
/**
 * Created by PhpStorm.
 * User: dura
 * Date: 10/8/18
 * Time: 12:30 PM
 */

namespace Node\ncacm18;


class Course_Specifications_G extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $name = 'G. Course Quality Management';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;


    public function init()
    {
        parent::init();
        $this->set_course_management_structure('');
        $this->set_course_evaluation(array());
        $this->set_evaluation_areas();
        $this->set_evaluators();


    }
    public function set_course_management_structure($value){
        $property = new \Orm_Property_Textarea('course_management_structure',$value);
        $property->set_description('1. Course management structure (including Coordinator , committees, units, boards, ...)');
        $this->set_property($property);
    }
    public function get_course_management_structure(){

        return $this->get_property('course_management_structure')->get_value();
    }

    public function set_course_evaluation($value){
        $property = new \Orm_Property_Table_Dynamic('course_evaluation',$value);
        $property->set_description('2. Course Evaluation (Describe the strategies used for obtaining assessments of the overall quality of the course and achievement of its intended learning outcomes)');

        $areas = new \Orm_Property_Text('Evaluation_areas');
        $areas->set_description('Evaluation areas/issues  ');
        $areas->set_width(300);
        $property->add_property($areas);

        $evaluators = new \Orm_Property_Text('evaluators');
        $evaluators->set_description('Evaluators');
        $evaluators->set_width(100);
        $property->add_property($evaluators);

        $methods= new \Orm_Property_Text('evaluation_methods');
        $methods->set_description('Evaluation methods');
        $methods->set_width(300);
        $property->add_property($methods);



        $this->set_property($property);

    }


    public function get_course_evaluation(){

        return $this->get_property('topics')->get_value();
    }


    public function set_evaluation_areas(){
        $property = new \Orm_Property_Fixedtext('evaluation_areas','Evaluation areas (e.g., Effectiveness of Teaching and assessment, Achievement of course learning outcomes and Learning resources, etc.)');
        $property->set_group('types');
        $this->set_property($property);
    }


    public function get_evaluation_areas(){
        return $this->get_property('evaluation_areas')->get_value();

    }


    public function set_evaluators(){
        $property = new \Orm_Property_Fixedtext('evaluators','Evaluators (Students, faculty, Program leaders, peer review, Independent reviewers, Others (specify)');
        $property->set_group('evaluators');
        $this->set_property($property);
    }


    public function get_evaluators(){
        return $this->get_property('evaluators')->get_value();

    }

}