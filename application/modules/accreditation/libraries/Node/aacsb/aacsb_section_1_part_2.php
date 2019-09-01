<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb;

/**
 * Description of aacsb_section_1_part_1
 *
 * @author laith
 */
class Aacsb_Section_1_Part_2 extends \Orm_Node
{

    //put your code here
    protected $class_type = __CLASS__;
    protected $name = 'Part 2: General Criteria';
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
        $childrens[] = new Aacsb_Section_1_part_2_D();
        $childrens[] = new Aacsb_Section_1_part_2_E();
        $childrens[] = new Aacsb_Section_1_part_2_F();

        return $childrens;
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'The accounting academic unit seeking AACSB accounting accreditation must also address the following general criteria. The accounting academic unit may refer to content in the business school documentation if that documentation provides sufficient detail regarding the unit’s alignment with these criteria.');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
