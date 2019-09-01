<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ses_standard_8
 *
 * @author ahmadgx
 */
class Ses_Standard_8 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 8. Financial Planning and Management';
    protected $link_view = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_intoduction();
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $childrens = array();
        $childrens[] = new Ses_Standard_8_1();
        $childrens[] = new Ses_Standard_8_2();
        $childrens[] = new Ses_Standard_8_Overall();

        return $childrens;
    }

    public function set_intoduction()
    {
        $property = new \Orm_Property_Fixedtext('intoduction', '<strong>Financial resources must be sufficient for the effective delivery of the program.  Program requirements must be made known sufficiently far in advance to be considered in institutional budgeting. Budgetary processes should allow for long term planning over at least a three-year period.  Sufficient flexibility must be is provided for effective management and responses to unexpected events and this flexibility must be combined with appropriate accountability and reporting mechanisms.</strong>'
            . ' <br/> <br/>The scales below ask you to indicate whether these practices are followed in your institution and to show how well this is done. Wherever possible evaluations should be based on valid evidence and interpretations supported by independent opinions');
        $this->set_property($property);
    }

    public function get_intoduction()
    {
        return $this->get_property('intoduction')->get_value();
    }

}
