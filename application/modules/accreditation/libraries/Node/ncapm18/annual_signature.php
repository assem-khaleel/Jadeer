<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 11/10/18
 * Time: 11:40 ص
 */

namespace Node\ncapm18;


class Annual_Signature extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Authorized Signatures';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();
        $this->set_date_completed('');
        $this->set_date_department('');
        $this->set_auth(array());
        $this->set_attach('');


    }

    public function set_date_completed($value)
    {
        $property = new \Orm_Property_Date('date_completed',$value);
        $property->set_description('Date Report Completed');
        $this->set_property($property);
    }

    public function get_date_completed()
    {
        return $this->get_property('date_completed')->get_value();

    }

    public function set_date_department($value)
    {
        $property = new \Orm_Property_Date('date_department',$value);
        $property->set_description('Date of Department Council Approval');
        $this->set_property($property);
    }

    public function get_date_department()
    {
        return $this->get_property('date_department')->get_value();

    }

    public function set_auth($value){
        $name = new \Orm_Property_Text('name');
        $name->set_width(200);

        $signature  = new \Orm_Property_Text('signature');
        $signature->set_width(200);

        $date  = new \Orm_Property_Date('date');
        $date->set_width(100);

        $property = new \Orm_Property_Table('auth',$value);

        $property->add_cell(1,1,new \Orm_Property_Fixedtext('title','Title'));
        $property->add_cell(1,2,new \Orm_Property_Fixedtext('name','Name'));
        $property->add_cell(1,3,new \Orm_Property_Fixedtext('signature','Signature'));
        $property->add_cell(1,4,new \Orm_Property_Fixedtext('date','Date'));

        $property->add_cell(2,1,new \Orm_Property_Fixedtext('program_co','Program Chair/ Coordinator'));
        $property->add_cell(2,2,$name);
        $property->add_cell(2,3,$signature);
        $property->add_cell(2,4,$date);

        $property->add_cell(3,1,new \Orm_Property_Fixedtext('dean','Dean/Department Head'));
        $property->add_cell(3,2,$name);
        $property->add_cell(3,3,$signature);
        $property->add_cell(3,4,$date);

        $this->set_property($property);

    }
    public function get_auth(){
        return $this->get_property('auth')->get_value();
    }

    public function set_attach($value){
        $property = new \Orm_Property_Upload('attach',$value);
        $this->set_property($property);
    }
    public function get_attach(){
        return $this->get_property('attach')->get_value();
    }

}