<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of Ses_Standard_8
 *
 * @author user
 */
class Ses_Standard_8 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 8. Financial Planning and Management';
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
        $childrens[] = new Ses_Standard_8_1();
        $childrens[] = new Ses_Standard_8_2();
        $childrens[] = new Ses_Standard_8_3();
        $childrens[] = new Ses_Standard_8_Overall();

        return $childrens;
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Financial resources must be adequate for the programs and services offered and efficiently managed in keeping with program requirements and institutional priorities. Budgetary processes should allow for long term planning over at least a three year period. Effective systems must be used for budgeting and for financial delegations and accountability providing local flexibility, institutional oversight and effective risk management.</strong><br/><br/>
        The scales below ask you to indicate whether these practices are followed in your institution and to show how well this is done. Wherever possible evaluations should be based on valid evidence and interpretations supported by independent opinions.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
