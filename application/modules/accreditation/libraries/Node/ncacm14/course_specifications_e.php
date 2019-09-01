<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncacm14;

/**
 * Description of course_specifications_e
 *
 * @author laith
 */
class Course_Specifications_E extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'E. Learning Resources';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_required_textbook('');
            $this->set_reference_material('');
            $this->set_recommended_textbook('');
            $this->set_electronic_material('');
            $this->set_learning_material('');
    }

    public function set_required_textbook($value)
    {
        $property = new \Orm_Property_Textarea('required_textbook', $value);
        $property->set_description('1. List Required Textbooks');
        $this->set_property($property);
    }

    public function get_required_textbook()
    {
        return $this->get_property('required_textbook')->get_value();
    }

    public function set_reference_material($value)
    {
        $property = new \Orm_Property_Textarea('reference_material', $value);
        $property->set_description('2. List Essential References Materials (Journals, Reports, etc.)');
        $this->set_property($property);
    }

    public function get_reference_material()
    {
        return $this->get_property('reference_material')->get_value();
    }

    public function set_recommended_textbook($value)
    {
        $property = new \Orm_Property_Textarea('recommended_textbook', $value);
        $property->set_description('3. List Recommended Textbooks and Reference Material (Journals, Reports, etc)');
        $this->set_property($property);
    }

    public function get_recommended_textbook()
    {
        return $this->get_property('recommended_textbook')->get_value();
    }

    public function set_electronic_material($value)
    {
        $property = new \Orm_Property_Textarea('electronic_material', $value);
        $property->set_description('4. List Electronic Materials, Web Sites, Facebook, Twitter, etc.');
        $this->set_property($property);
    }

    public function get_electronic_material()
    {
        return $this->get_property('electronic_material')->get_value();
    }

    public function set_learning_material($value)
    {
        $property = new \Orm_Property_Textarea('learning_material', $value);
        $property->set_description('5. Other learning material such as computer-based programs/CD, professional standards or regulations and software.');
        $this->set_property($property);
    }

    public function get_learning_material()
    {
        return $this->get_property('learning_material')->get_value();
    }

}
