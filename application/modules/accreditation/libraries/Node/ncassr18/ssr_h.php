<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ssr_h
 *
 * @author ahmadgx
 */
class Ssr_H extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'H. Evaluation in Relation to Quality Standards';
    protected $link_view = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_introduction();
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $childrens = array();
        $childrens[] = new Ssr_H_Standard_1();
        $childrens[] = new Ssr_H_Standard_2();
        $childrens[] = new Ssr_H_Standard_3();
        $childrens[] = new Ssr_H_Standard_4();
        $childrens[] = new Ssr_H_Standard_5();
        $childrens[] = new Ssr_H_Standard_6();
        $childrens[] = new Ssr_H_Standard_7();
        $childrens[] = new Ssr_H_Standard_8();
        $childrens[] = new Ssr_H_Standard_9();
        $childrens[] = new Ssr_H_Standard_10();
        $childrens[] = new Ssr_H_Standard_11();
        $childrens[] = new Ssr_H_Courses_Review();


        return $childrens;
    }

    public function set_introduction()
    {
        $property = new \Orm_Property_Fixedtext('introduction', "<i>(Refer to Standards for Quality Assurance and Accreditation of Higher Education Programs)</i> <br/> <br/>"
            . "<strong>NOTE for section h </strong> <br/>Response reports should be provided under each of the quality sub-standards set out in the<strong><i>Standards for Quality Assurance and Accreditation of Higher Education Programs.</i></strong> <br/> <br/>"
            . "<strong>NOTE: </strong>  Programs are required to use 70% or more of the suggested NCAAA KPI’s. KPI tables are provided throughout the SSRP and directly apply to the entire standard or a specific sub-standard, depending on where they are located. Copy additional KPI tables as needed and paste them under the standard or sub-standard where the evidence applies.");
        $this->set_property($property);
    }

    public function get_introduction()
    {
        return $this->get_property('introduction')->get_value();
    }

}
