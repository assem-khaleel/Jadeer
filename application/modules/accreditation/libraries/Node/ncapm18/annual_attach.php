<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 11/10/18
 * Time: 11:54 ص
 */

namespace Node\ncapm18;


class Annual_Attach extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $name = 'Attachments';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

        $this->set_attach('');

    }

    public function set_attach($value){
        $property = new \Orm_Property_Upload('attach',$value);
        $this->set_property($property);
    }
    public function get_attach(){
        return $this->get_property('attach')->get_value();
    }

}