<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ses_standard_9
 *
 * @author ahmadgx
 */
class Ses_Standard_9 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 9. Employment Processes';
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
        $childrens[] = new Ses_Standard_9_1();
        $childrens[] = new Ses_Standard_9_2();
        $childrens[] = new Ses_Standard_9_Overall();

        return $childrens;
    }

    public function set_intoduction()
    {
        $property = new \Orm_Property_Fixedtext('intoduction', '<strong>Teaching and other staff must have the knowledge and experience needed for their particular teaching responsibilities and their qualifications and experience must be verified before appointment.  New teaching staff must be thoroughly briefed about the program and their responsibilities before they begin. Performance of all faculty and staff must be periodically evaluated, with outstanding performance recognized and support provided for professional development and improvement in teaching skills.   (Note:  Teaching staff refers to all staff with responsibility for teaching classes including full and part time staff, faculty, lecturers, and teaching assistants)</strong>'
            . ' <br/> <br/>The scales below ask you to indicate whether these practices are followed in your institution and to show how well this is done. Wherever possible evaluations should be based on valid evidence and interpretations supported by independent opinions.');
        $this->set_property($property);
    }

    public function get_intoduction()
    {
        return $this->get_property('intoduction')->get_value();
    }

}
