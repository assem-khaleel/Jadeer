<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ses_standard_4
 *
 * @author ahmadgx
 */
class Ses_Standard_4 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 4. Learning and Teaching';
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
        $childrens[] = new Ses_Standard_4_1();
        $childrens[] = new Ses_Standard_4_2();
        $childrens[] = new Ses_Standard_4_3();
        $childrens[] = new Ses_Standard_4_4();
        $childrens[] = new Ses_Standard_4_5();
        $childrens[] = new Ses_Standard_4_6();
        $childrens[] = new Ses_Standard_4_7();
        $childrens[] = new Ses_Standard_4_8();
        $childrens[] = new Ses_Standard_4_9();
        $childrens[] = new Ses_Standard_4_10();
        $childrens[] = new Ses_Standard_4_Overall();

        return $childrens;
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Student learning outcomes must be clearly specified, consistent with the National Qualifications Framework and requirements for employment or professional practice. Standards of learning must be assessed through appropriate processes and benchmarked against demanding and relevant external reference points. Teaching staff must be appropriately qualified and experienced for their particular teaching responsibilities, use teaching strategies suitable for different kinds of learning outcomes, and participate in activities to improve their teaching effectiveness. Teaching quality and the effectiveness of programs must be evaluated through student assessments and graduate and employer surveys, with feedback used as a basis for plans for improvement.Required standards for male and female sections must be the same, equivalent resources provided, and evaluations must include data for each section.</strong> <br/> <br/>'
            . 'The scales below ask you to indicate whether these practices are followed in your institution and to show how well this is done. Wherever possible evaluations should be based on valid evidence and interpretations supported by independent opinions');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
