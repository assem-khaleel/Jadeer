<?php
/**
 * Created by PhpStorm.
 * User: dura
 * Date: 10/9/18
 * Time: 1:20 PM
 */

namespace Node\ncacm18;


class Course_Report_G extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'G. Challenges and difficulties';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;


    public function init()
    {
        parent::init();
        $this->set_challenges('');


    }

    public function set_challenges($value)
    {
        $text = new \Orm_Property_Text('challenges');


        $property = new \Orm_Property_Table('challenges', $value);

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('difficulties', 'Difficulties (if any)'));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('consequences', 'Consequences'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('proposed', 'proposed action to overcome'));


        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('administrative', 'Administrative Issues'),1,4);


        $property->add_cell(3, 1, $text);
        $property->add_cell(3, 2, $text);
        $property->add_cell(3, 3, $text);

        $property->add_cell(4, 1, $text);
        $property->add_cell(4, 2, $text);
        $property->add_cell(4, 3, $text);

        $property->add_cell(5, 1, $text);
        $property->add_cell(5, 2, $text);
        $property->add_cell(5, 3, $text);


        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('learning', 'Learning resources'),1,4);

        $property->add_cell(7, 1, $text);
        $property->add_cell(7, 2, $text);
        $property->add_cell(7, 3, $text);

        $property->add_cell(8, 1, $text);
        $property->add_cell(8, 2, $text);
        $property->add_cell(8, 3, $text);

        $property->add_cell(9, 1, $text);
        $property->add_cell(9, 2, $text);
        $property->add_cell(9, 3, $text);

        $property->add_cell(10, 1, new \Orm_Property_Fixedtext('facilities', 'Facilities'),1,4);

        $property->add_cell(11, 1, $text);
        $property->add_cell(11, 2, $text);
        $property->add_cell(11, 3, $text);

        $property->add_cell(12, 1, $text);
        $property->add_cell(12, 2, $text);
        $property->add_cell(12, 3, $text);

        $property->add_cell(13, 1, $text);
        $property->add_cell(13, 2, $text);
        $property->add_cell(13, 3, $text);


        $this->set_property($property);
    }

    public function get_challenges()
    {
        return $this->get_property('challenges')->get_value();
    }
}