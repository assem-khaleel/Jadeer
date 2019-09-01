<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of ses_standard_1
 *
 * @author user
 */
class Ses_Standard_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 1. Mission Goals and Objectives';
    protected $link_view = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $childrens = array();
        $childrens[] = new Ses_Standard_1_1();
        $childrens[] = new Ses_Standard_1_2();
        $childrens[] = new Ses_Standard_1_3();
        $childrens[] = new Ses_Standard_1_4();
        $childrens[] = new Ses_Standard_1_5();
        $childrens[] = new Ses_Standard_1_Overall();

        return $childrens;
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', "<strong>The institution's mission statement must clearly and appropriately define its principal purposes and priorities and be influential in guiding planning and action within the institution.</strong><br/><br/>
The scales below ask you to indicate whether these practices are followed in your institution and to show how well this is done. Wherever possible evaluations should be based on valid evidence and interpretations supported by independent opinions");
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
