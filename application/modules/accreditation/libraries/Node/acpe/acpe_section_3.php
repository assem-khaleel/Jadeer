<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_3
 *
 * @author ahmadgx
 */
class Acpe_Section_3 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'SECTION III: ASSESSMENT OF STANDARDS AND KEY ELEMENTS';
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
        $childrens[] = new Acpe_Section_3_Standard_24();
        $childrens[] = new Acpe_Section_3_Standard_25();


        return $childrens;
    }

    public function set_introduction()
    {
        $property = new \Orm_Property_Fixedtext('introduction', 'In the spirit of continuous quality improvement and transparency, colleges and schools evaluate and report to constituents the extent to which they meet their programmatic goals. Insights gained from the valid and reliable assessment of outcomes related to mission, strategic planning, educational programs, and other key institutional initiatives are channeled into constructive change to enhance programmatic quality.');
        $this->set_property($property);
    }

    public function get_introduction()
    {
        return $this->get_property('introduction')->get_value();
    }

}
