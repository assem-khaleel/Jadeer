<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 11/10/18
 * Time: 12:33 م
 */

namespace Node\ncapm18;


class  Program_Specifications_F extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $name = 'F. Student admission and support';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

        $this->set_admission_requirement('');
        $this->set_academic_career('');
        $this->set_orientation('');
        $this->set_support('');

    }

    public function set_admission_requirement($value){
        $property =  new \Orm_Property_Textarea('admission_requirement',$value);
        $property->set_description('1. Student admission requirements');
        $this->set_property($property);
    }
    public function get_admission_requirement(){
        return $this->get_property('admission_requirement')->get_value();
    }

    public function set_academic_career($value){
         $property =  new \Orm_Property_Textarea('academic_career',$value);
        $property->set_description('2. Academic and career guidance and counseling');
        $this->set_property($property);
    }
    public function get_academic_career(){
         return $this->get_property('academic_career')->get_value();
    }

    public function set_orientation($value){
        $property =  new \Orm_Property_Textarea('orientation',$value);
        $property->set_description('3. Student orientation program.');
        $this->set_property($property);
    }
    public function get_orientation(){
        return $this->get_property('orientation')->get_value();
    }

    public function set_support($value){
        $property =  new \Orm_Property_Textarea('support',$value);
        $property->set_description('4. Support for students of special needs students (low achievers, disabled,  gifted and talented)');
        $this->set_property($property);
    }
    public function get_support(){
        return $this->get_property('support')->get_value();
    }
}