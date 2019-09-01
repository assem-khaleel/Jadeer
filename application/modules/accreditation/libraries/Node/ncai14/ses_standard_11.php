<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of Ses_Standard_11
 *
 * @author user
 */
class Ses_Standard_11 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 11. Relationships with the Community';
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
        $childrens[] = new Ses_Standard_11_1();
        $childrens[] = new Ses_Standard_11_2();
        $childrens[] = new Ses_Standard_11_3();
        $childrens[] = new Ses_Standard_11_Overall();

        return $childrens;
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Contributing to the community must be recognized as an important institutional responsibility.  Facilities and services must be made available to assist with community developments. Teaching and other staff must be encouraged to be involved in the community and information about the institution and its activities made known to the community through public media and other appropriate mechanisms.  Community perceptions of the institution must be monitored and appropriate strategies adopted to improve understanding and enhance its reputation.</strong><br/><br/>
        The scales below ask you to indicate whether these practices are followed in your institution and to show how well this is done. Wherever possible evaluations should be based on valid evidence and interpretations supported by independent opinions.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
