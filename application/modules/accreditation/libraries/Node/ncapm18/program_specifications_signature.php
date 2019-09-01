<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 11/10/18
 * Time: 12:34 م
 */

namespace Node\ncapm18;


class Program_Specifications_Signature extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $name = 'Authorized Signatures';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

        $this->set_signature(array());
        $this->set_attach('');

    }

    public function set_signature($value){
        $property = new \Orm_Property_Table_Dynamic('signature',$value);
        $property->set_is_responsive(true);

        $dean = new \Orm_Property_Text('dean');
        $dean->set_description('Dean/Chair');
        $dean->set_width(200);
        $property->add_property($dean);

        $name = new \Orm_Property_Text('name');
        $name->set_description('Name');
        $name->set_width(200);
        $property->add_property($name);

        $title = new \Orm_Property_Text('title');
        $title->set_description('Title');
        $title->set_width(200);
        $property->add_property($title);

        $sign = new \Orm_Property_Text('sign');
        $sign->set_description('Signature');
        $sign->set_width(200);
        $property->add_property($sign);

        $date = new \Orm_Property_Text('date');
        $date->set_description('Date');
        $date->set_width(200);
        $property->add_property($date);

        $this->set_property($property);

    }
    public function get_signature(){
        return $this->get_property('signature')->get_value();
    }

    public function set_attach($value){
        $property = new \Orm_Property_Upload('attach',$value);
        $this->set_property($property);
    }
    public function get_attach(){
        return $this->get_property('attach')->get_value();
    }


}