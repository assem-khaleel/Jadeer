<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_1
 *
 * @author ahmadgx
 */
class Acpe_Section_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'SECTION I: EDUCATIONAL OUTCOMES';
    protected $link_pdf = true;
    protected $link_view = true;

    public function init()
    {
        parent::init();

            $this->set_introduction('');
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $childrens = array();
        $childrens[] = new Acpe_Section_1_Standard_1();
        $childrens[] = new Acpe_Section_1_Standard_2();
        $childrens[] = new Acpe_Section_1_Standard_3();
        $childrens[] = new Acpe_Section_1_Standard_4();
        return $childrens;
    }

    public function set_introduction()
    {
        $property = new \Orm_Property_Fixedtext('introduction', 'The educational outcomes described herein have been deemed essential to the contemporary practice of pharmacy in a healthcare environment that demands interprofessional collaboration and professional accountability for holistic patient well-being.');
        $this->set_property($property);
    }

    public function get_introduction()
    {
        return $this->get_property('introduction')->get_value();
    }

}
