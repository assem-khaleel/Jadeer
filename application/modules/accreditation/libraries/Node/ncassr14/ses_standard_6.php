<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ses_standard_6
 *
 * @author ahmadgx
 */
class Ses_Standard_6 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 6. Learning Resources';
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
        $childrens[] = new Ses_Standard_6_1();
        $childrens[] = new Ses_Standard_6_2();
        $childrens[] = new Ses_Standard_6_3();
        $childrens[] = new Ses_Standard_6_4();
        $childrens[] = new Ses_Standard_6_Overall();

        return $childrens;
    }

    public function set_intoduction()
    {
        $property = new \Orm_Property_Fixedtext('intoduction', 'Learning resource materials and associated services must be adequate for the requirements of the program and the courses offered within it and accessible when required for students in the program. Information about requirements must be made available by faculty in sufficient time for necessary provisions to be made for resources required, and faculty and students must be involved in evaluations of  what is provided.  Specific requirements for reference material and on-line data sources, and for computer terminals and assistance in using this equipment will vary according to the nature of the program and the approach to teaching.'
            . ' <br/> <br/>The scales below ask you to indicate whether these practices are followed in your institution and to show how well this is done. Wherever possible evaluations should be based on valid evidence and interpretations supported by independent opinions');
        $this->set_property($property);
    }

    public function get_intoduction()
    {
        return $this->get_property('intoduction')->get_value();
    }

}
