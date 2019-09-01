<?php
/**
 * Created by PhpStorm.
 * User: dura
 * Date: 10/8/18
 * Time: 12:11 PM
 */

namespace Node\ncacm18;


class Course_Specifications_E extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $name = 'E. Student Academic Counseling and Support';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;


    public function init()
    {
        parent::init();
        $this->set_arrangements('');


    }
    public function set_arrangements($value){
        $property = new \Orm_Property_Textarea('arrangements',$value);
        $property->set_description('Arrangements for availability of faculty and teaching staff for individual student consultations and academic advice.');
        $this->set_property($property);
    }
    public function get_arrangements(){

        return $this->get_property('arrangements')->get_value();
    }
}