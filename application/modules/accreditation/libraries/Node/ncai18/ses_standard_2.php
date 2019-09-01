<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of Ses_Standard_2
 *
 * @author user
 */
class Ses_Standard_2 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 2. Governance and Administration';
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
        $childrens[] = new Ses_Standard_2_1();
        $childrens[] = new Ses_Standard_2_2();
        $childrens[] = new Ses_Standard_2_3();
        $childrens[] = new Ses_Standard_2_4();
        $childrens[] = new Ses_Standard_2_5();
        $childrens[] = new Ses_Standard_2_6();
        $childrens[] = new Ses_Standard_2_7();
        $childrens[] = new Ses_Standard_2_8();
        $childrens[] = new Ses_Standard_2_Overall();

        return $childrens;
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>The governing body must provide effective leadership in the interests of the institution as a whole and its clients through policy development and processes for accountability. Senior administrators must lead the activities of the institution effectively within a clearly defined governance structure. Their activities must be consistent with high standards of integrity and ethical practice.In sections for male and female students resources must be comparable in both sections, there must be effective communication between them, and full involvement in planning and decision making processes. Planning and management must occur within a framework of sound policies and regulations that ensure financial and administrative accountability, and provide an appropriate balance between coordinated planning and local initiative.</strong><br/><br/>
        The scales below ask you to indicate whether these practices are followed in your institution and to show how well this is done. Wherever possible evaluations should be based on valid evidence and interpretations supported by independent opinions');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
