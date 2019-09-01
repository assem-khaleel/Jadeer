<?php
/**
 * Created by PhpStorm.
 * User: dura
 * Date: 10/9/18
 * Time: 11:48 AM
 */

namespace Node\ncacm18;


class Course_Report_D extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'D. Course Content';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;


    public function init()
    {
        parent::init();

        $this->set_coverage(array());
        $this->set_topics(array());
        $this->set_recommendations('');



    }

    public function set_coverage($value)
    {
        $text = new \Orm_Property_Text('coverage');


        $property = new \Orm_Property_Table('coverage', $value);
        $property->set_description('1. Coverage of planned topics');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('topics_covered', 'Topics Covered'),2,0);
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('contact_hours', 'Contact Hours'),1,2);
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('reason', 'Reason for Variations'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('planed', 'Planed'));
        $property->add_cell(2, 2, new \Orm_Property_Fixedtext('actual', 'Actual'));


        $property->add_cell(3, 1, $text);
        $property->add_cell(3, 2, $text);
        $property->add_cell(3, 3, $text);
        $property->add_cell(3, 4, $text);


        $property->add_cell(4, 1, $text);
        $property->add_cell(4, 2, $text);
        $property->add_cell(4, 3, $text);
        $property->add_cell(4, 4, $text);

        $property->add_cell(5, 1, $text);
        $property->add_cell(5, 2, $text);
        $property->add_cell(5, 3, $text);
        $property->add_cell(5, 4, $text);

        $property->add_cell(6, 1, $text);
        $property->add_cell(6, 2, $text);
        $property->add_cell(6, 3, $text);
        $property->add_cell(6, 4, $text);

        $property->add_cell(7, 1, $text);
        $property->add_cell(7, 2, $text);
        $property->add_cell(7, 3, $text);
        $property->add_cell(7, 4, $text);

        $property->add_cell(8, 1, $text);
        $property->add_cell(8, 2, $text);
        $property->add_cell(8, 3, $text);
        $property->add_cell(8, 4, $text);

        $this->set_property($property);
    }

    public function get_coverage()
    {
        return $this->get_property('coverage')->get_value();
    }

    public function set_topics($value)
    {
        $text = new \Orm_Property_Text('topics');


        $property = new \Orm_Property_Table('topics', $value);
        $property->set_description('2. Topics not covered');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('topics_not_fully_covered', 'Topics not Fully Covered'));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('related_learning', 'Related learning outcomes'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('possible', 'Possible Compensating Action'));

        $property->add_cell(3, 1, $text);
        $property->add_cell(3, 2, $text);
        $property->add_cell(3, 3, $text);

        $property->add_cell(4, 1, $text);
        $property->add_cell(4, 2, $text);
        $property->add_cell(4, 3, $text);

        $property->add_cell(5, 1, $text);
        $property->add_cell(5, 2, $text);
        $property->add_cell(5, 3, $text);

        $property->add_cell(6, 1, $text);
        $property->add_cell(6, 2, $text);
        $property->add_cell(6, 3, $text);

        $property->add_cell(7, 1, $text);
        $property->add_cell(7, 2, $text);
        $property->add_cell(7, 3, $text);

        $this->set_property($property);
    }

    public function get_topics()
    {
        return $this->get_property('topics')->get_value();
    }

    public function set_recommendations($value){
        $property = new \Orm_Property_Textarea('recommendations',$value);
        $property->set_description('3.Recommendations');
        $this->set_property($property);
    }

    public function get_recommendations(){

        return $this->get_property('recommendations')->get_value();
    }

}