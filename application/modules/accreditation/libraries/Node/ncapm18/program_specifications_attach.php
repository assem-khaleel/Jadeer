<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 11/10/18
 * Time: 12:34 م
 */

namespace Node\ncapm18;


class Program_Specifications_Attach extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $name = 'Attachments';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();
        $this->set_attach_1('');
        $this->set_attach_2('');
        $this->set_attach_3('');
        $this->set_attach_4('');
        $this->set_attach_5('');
        $this->set_attach_6('');
        $this->set_attach_7('');

    }

    public function set_attach_1($value){
        $property = new \Orm_Property_Upload('attach_1',$value);
        $property->set_description('1. Assessment plan for program learning outcomes (PLOs)');
        $this->set_property($property);
    }
    public function get_attach_1(){
        return $this->get_property('attach_1')->get_value();
    }

    public function set_attach_2($value){
        $property = new \Orm_Property_Upload('attach_2',$value);
        $property->set_description('2. Program assessment regulations (link to on-line version)');
        $this->set_property($property);
    }
    public function get_attach_2(){
        return $this->get_property('attach_2')->get_value();
    }

    public function set_attach_3($value){
        $property = new \Orm_Property_Upload('attach_3',$value);
        $property->set_description('3. Course specifications for all courses including field experience specification if applicable.');
        $this->set_property($property);
    }
    public function get_attach_3(){
        return $this->get_property('attach_3')->get_value();
    }

    public function set_attach_4($value){
        $property = new \Orm_Property_Upload('attach_4',$value);
        $property->set_description('4. Regulations for student appeals on academic matters, including processes for consideration of those appeals.');
        $this->set_property($property);
    }
    public function get_attach_4(){
        return $this->get_property('attach_4')->get_value();
    }

    public function set_attach_5($value){
        $property = new \Orm_Property_Upload('attach_5',$value);
        $property->set_description('5. Program/Department/College/Institution policies on appointment of part time and visiting teaching staff.  (i.e., Approvals required, selection process, proportion of total teaching staff to students, etc.) ');
        $this->set_property($property);
    }
    public function get_attach_5(){
        return $this->get_property('attach_5')->get_value();
    }

    public function set_attach_6($value){
        $property = new \Orm_Property_Upload('attach_6',$value);
        $property->set_description('6. Students Handbooks');
        $this->set_property($property);
    }
    public function get_attach_6(){
        return $this->get_property('attach_6')->get_value();
    }

    public function set_attach_7($value){
        $property = new \Orm_Property_Upload('attach_7',$value);
        $property->set_description('7. Academic and Professional Development plan');
        $this->set_property($property);
    }
    public function get_attach_7(){
        return $this->get_property('attach_7')->get_value();
    }

}