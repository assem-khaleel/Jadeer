<?php
/**
 * Created by PhpStorm.
 * User: dura
 * Date: 10/8/18
 * Time: 12:15 PM
 */

namespace Node\ncacm18;


class Course_Specifications_F  extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $name = 'F. Learning Resources and Facilities';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;


    public function init()
    {
        parent::init();
        $this->set_learning_resources(array());
        $this->set_facilities_required(array());


    }
    public function set_learning_resources($value)
    {

        $resources = new \Orm_Property_Text('resources');
        $resources->set_width(100);


        $property = new \Orm_Property_Table('learning_resources', $value);
        $property->set_description('1.Learning Resources');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('item', 'Item'));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('resources', 'Resources'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('required_textbooks', 'Required Textbooks'));
        $property->add_cell(2, 2, $resources);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('essential_references_materials', 'Essential References Materials'));
        $property->add_cell(3, 2, $resources);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('electronic_materials', 'Electronic Materials,(Web Sites, Facebook, Twitter, etc)'));
        $property->add_cell(4, 2, $resources);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('other_learning_material', 'Other learning material ( Computer-based programs/CD, professional standards or regulations and software)'));
        $property->add_cell(5, 2, $resources);


        $this->set_property($property);
    }

    public function get_learning_resources ()
    {
        return $this->get_property('learning_resources')->get_value();
    }
    public function set_facilities_required($value)
    {

        $resources = new \Orm_Property_Text('item');
        $resources->set_width(100);


        $property = new \Orm_Property_Table('facilities_required', $value);
        $property->set_description('2. Facilities Required');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('item', 'Item'));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('resources', 'Resources'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('accommodation', 'Accommodation (Classrooms, laboratories, demonstration rooms/labs, etc.)'));
        $property->add_cell(2, 2, $resources);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('technology resources', 'Technology resources (AV, data show, Smart Board, software, etc.)'));
        $property->add_cell(3, 2, $resources);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('other resources', 'Other resources (Specify, e.g. if specific laboratory equipment is required, list requirements or attach list),'));
        $property->add_cell(4, 2, $resources);


        $this->set_property($property);
    }

    public function get_facilities_required ()
    {
        return $this->get_property('facilities_required')->get_value();
    }
}