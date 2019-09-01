<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of Eligibility_Requirements
 *
 * @author laith
 */
class Eligibility_Min_Requirements extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Minimum Institutional Requirements for Eligibility for Program Accreditation';
    protected $link_view = true;
    protected $link_pdf = true;
    protected $link_send_to_review = true;

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
        $childrens[] = new Eligibility_Min_Requirements_1();
        $childrens[] = new Eligibility_Min_Requirements_2();
        $childrens[] = new Eligibility_Min_Requirements_3();
        $childrens[] = new Eligibility_Min_Requirements_4();
        $childrens[] = new Eligibility_Min_Requirements_5();
        $childrens[] = new Eligibility_Min_Requirements_6();
        $childrens[] = new Eligibility_Min_Requirements_7();
        $childrens[] = new Eligibility_Min_Requirements_8();
        $childrens[] = new Eligibility_Min_Requirements_9();
        $childrens[] = new Eligibility_Requirements_Signature();
        return $childrens;
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'In the event that the institution is <strong>NOT</strong> accredited by NCAAA, there are extra-ordinary circumstances when special arrangements related to program eligibility for accreditation are made by the NCAAA. These institutional requirements are provided below. There may be additional flexible requirements that are determined according to individual situations.');

        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
