<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb_business;

/**
 * Description of aacsb_business_section_2_academic
 *
 * @author ahmadgx
 */
class Aacsb_Business_Section_2_Academic extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'ACADEMIC AND PROFESSIONAL ENGAGEMENT';
    protected $link_view = true;
    protected $link_pdf = true;

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
        $childrens[] = new Aacsb_Business_Section_2_Standard_13();
        $childrens[] = new Aacsb_Business_Section_2_Standard_14();
        $childrens[] = new aacsb_business_section_2_standard_15();

        return $childrens;
    }

    public function set_introduction()
    {
        $property = new \Orm_Property_Fixedtext('introduction', "Business schools are professional schools in that they exist at the intersection of theory and practice. In this context, it is important for a school to be firmly grounded in both the academic study and the professional practice of business and management. Business schools can achieve effective business education and impactful research by striking different balances between academic study and professional engagement. However, if schools largely ignore one side or the other, both their degree programs and scholarly output will suffer. Accreditation should encourage an appropriate balance and integration of academic and professional engagement consistent with quality in the context of a school's mission."
            . " <br/> <br/>Most important, academic study and professional engagement within a business school are not separate activities; rather, they intersect in significant ways. This section of the accreditation standards is designed to foster such integration and intersection in ways that are appropriate to the mission of the school. It identifies three critical activities that help schools connect theory and practice: (a) the teaching and learning activities fostered by degree program curricula that highlight the importance of student engagement and experiential learning; (b) executive education activities; and (c) the initial preparation, development, and ongoing engagement activities of faculty.");
        $this->set_property($property);
    }

    public function get_introduction()
    {
        return $this->get_property('introduction')->get_value();
    }

}
