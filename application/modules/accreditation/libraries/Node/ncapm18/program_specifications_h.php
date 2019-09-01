<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 11/10/18
 * Time: 12:33 م
 */

namespace Node\ncapm18;


class Program_Specifications_H extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $name = 'H. Learning Resources, Facilities and Equipment';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

        $this->set_learning_resource('');
        $this->set_equipment('');
        $this->set_health_save_env('');

    }

    public function set_learning_resource($value)
    {
        $property = new \Orm_Property_Textarea('learning_resource', $value);
        $property->set_description('1. Learning resources.  (Textbooks, reference and other resource material including electronic and web based resources ….etc.)');
        $this->set_property($property);

    }

    public function get_learning_resource()
    {
        return $this->get_property('learning_resource')->get_value();
    }

    public function set_equipment($value)
    {
        $property = new \Orm_Property_Textarea('equipment', $value);
        $property->set_description('2. Facilities and equipment (Library, laboratories, and classrooms ….etc.).');
        $this->set_property($property);

    }

    public function get_equipment()
    {
        return $this->get_property('equipment')->get_value();
    }

    public function set_health_save_env($value)
    {
        $property = new \Orm_Property_Textarea('health_save_env', $value);
        $property->set_description('3. Arrangements to maintain healthy and safe environment ( According to the nature of the program  )');
        $this->set_property($property);

    }

    public function get_health_save_env()
    {
        return $this->get_property('health_save_env')->get_value();
    }

}