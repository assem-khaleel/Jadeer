<?php
/**
 * Created by PhpStorm.
 * User: dura
 * Date: 10/9/18
 * Time: 12:45 PM
 */

namespace Node\ncacm18;


class Course_Report_E extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'E. Teaching and Assessment';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;


    public function init()
    {
        parent::init();
        $this->set_effectiveness(array());
        $this->set_variations_from_planned(array());
        $this->set_verification_of_student(array());
        $this->set_recommendations('');

    }

    public function set_effectiveness($value)
    {
        $text = new \Orm_Property_Text('effectiveness');


        $property = new \Orm_Property_Table('effectiveness', $value);
        $property->set_description('1. Effectiveness of teaching strategies ');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('teaching_strategies', 'Teaching Strategies'),2,0);
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('were_they_effective', 'Were They Effective?'),1,2);
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('difficulties', 'Difficulties Experienced(if any) in Using the Strateg'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('suggested_action', 'Suggested Action'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('yes', 'Yes'));
        $property->add_cell(2, 2, new \Orm_Property_Fixedtext('no', 'No'));

        $property->add_cell(3, 1, $text);
        $property->add_cell(3, 2, $text);
        $property->add_cell(3, 3, $text);
        $property->add_cell(3, 4, $text);
        $property->add_cell(3, 5, $text);

        $property->add_cell(4, 1, $text);
        $property->add_cell(4, 2, $text);
        $property->add_cell(4, 3, $text);
        $property->add_cell(4, 4, $text);
        $property->add_cell(4, 5, $text);

        $property->add_cell(5, 1, $text);
        $property->add_cell(5, 2, $text);
        $property->add_cell(5, 3, $text);
        $property->add_cell(5, 4, $text);
        $property->add_cell(5, 5, $text);

        $property->add_cell(6, 1, $text);
        $property->add_cell(6, 2, $text);
        $property->add_cell(6, 3, $text);
        $property->add_cell(6, 4, $text);
        $property->add_cell(6, 5, $text);

        $property->add_cell(7, 1, $text);
        $property->add_cell(7, 2, $text);
        $property->add_cell(7, 3, $text);
        $property->add_cell(7, 4, $text);
        $property->add_cell(7, 5, $text);



        $this->set_property($property);
    }

    public function get_effectiveness()
    {
        return $this->get_property('effectiveness')->get_value();
    }

    public function set_variations_from_planned($value)
    {
        $text = new \Orm_Property_Text('variations_from_planned');


        $property = new \Orm_Property_Table('variations_from_planned', $value);
        $property->set_description('2. Variations from planned student assessment processes (if any) ');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('variation', 'Variation'));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('reason', 'Reason'));

        $property->add_cell(2, 1, $text);
        $property->add_cell(2, 2, $text);

        $property->add_cell(3, 1, $text);
        $property->add_cell(3, 2, $text);

        $property->add_cell(4, 1, $text);
        $property->add_cell(4, 2, $text);

        $this->set_property($property);
    }

    public function get_variations_from_planned()
    {
        return $this->get_property('variations_from_planned')->get_value();
    }

    public function set_verification_of_student($value)
    {
        $text = new \Orm_Property_Text('verification_of_student');


        $property = new \Orm_Property_Table('verification_of_student', $value);
        $property->set_description('3. Verification of student grade achievement');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('method', 'Method(s) of Verification'));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('conclusion', 'Conclusion'));

        $property->add_cell(3, 1, $text);
        $property->add_cell(3, 2, $text);

        $property->add_cell(4, 1, $text);
        $property->add_cell(4, 2, $text);

        $property->add_cell(5, 1, $text);
        $property->add_cell(5, 2, $text);



        $this->set_property($property);
    }

    public function set_recommendations($value){
        $property = new \Orm_Property_Textarea('recommendations',$value);
        $property->set_description('4.Recommendations');
        $this->set_property($property);
    }

    public function get_recommendations(){

        return $this->get_property('recommendations')->get_value();
    }

    public function get_verification_of_student()
    {
        return $this->get_property('verification_of_student')->get_value();
    }
}