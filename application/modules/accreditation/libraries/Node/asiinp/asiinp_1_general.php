<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\asiinp;

/**
 * Description of asiinp_1_general
 *
 * @author laith
 */
class Asiinp_1_General extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '1. General';
    protected $link_pdf = true;
    protected $link_view = true;

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
        $childrens[] = new Asiinp_1_General_1();
        $childrens[] = new Asiinp_1_General_2();
        $childrens[] = new Asiinp_1_General_3();
        $childrens[] = new Asiinp_1_General_4();

        return $childrens;
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'Any gender-specific terms used in this document apply to both women and men.');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
