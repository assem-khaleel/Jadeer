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
class Aacsb_Section_1_Part_1 extends \Orm_Node
{

    //put your code here
    protected $class_type = __CLASS__;
    protected $name = 'Part 1: Core Values and Guiding Principles';
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
        $childrens[] = new Aacsb_Section_1_part_1_A();
        $childrens[] = new Aacsb_Section_1_part_1_B();
        $childrens[] = new Aacsb_Section_1_part_1_C();

        return $childrens;
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'The following three criteria represent core values and guiding principles of AACSB. There is nouniform measure for deciding whether each criterion has been met. Rather, the accounting unit must demonstrate that it has an ongoing commitment to pursue the spirit and intent of each criterion in ways that are consistent with its mission and context. If the accounting unit is part of a business academic unit holding or seeking AACSB accreditation, and if there are no unique factors or conditions that apply to the accounting academic unit, the accounting academic unit may refer to the business academic unit’s documents for documentation on these criteria.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
