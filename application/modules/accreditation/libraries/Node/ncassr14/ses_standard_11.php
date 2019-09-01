<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ses_standard_11
 *
 * @author ahmadgx
 */
class Ses_Standard_11 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 11. Relationships with the Community';
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
        $childrens[] = new Ses_Standard_11_1();
        $childrens[] = new Ses_Standard_11_2();
        $childrens[] = new Ses_Standard_11_Overall();

        return $childrens;
    }

    public function set_intoduction()
    {
        $property = new \Orm_Property_Fixedtext('intoduction', '<strong>Significant and appropriate contributions must be made to the community within which the institution is established drawing on the knowledge and experience of staff and the needs of the community for that expertise.  Community contributions should include both activities initiated and carried out by individuals and more formal programs of assistance arranged by the institution or by program administrators.  Activities should be documented and made known in the institution and the community, and staff contributions appropriately recognized within the institution.</strong>'
            . ' <br/> <br/>The scales below ask you to indicate whether these practices are followed in your institution and to show how well this is done. Wherever possible evaluations should be based on valid evidence and interpretations supported by independent opinions');
        $this->set_property($property);
    }

    public function get_intoduction()
    {
        return $this->get_property('intoduction')->get_value();
    }

}
