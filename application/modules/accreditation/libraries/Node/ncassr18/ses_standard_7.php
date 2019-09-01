<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ses_standard_7
 *
 * @author ahmadgx
 */
class Ses_Standard_7 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 7. Facilities and Equipment';
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
        $childrens[] = new Ses_Standard_7_1();
        $childrens[] = new Ses_Standard_7_2();
        $childrens[] = new Ses_Standard_7_3();
        $childrens[] = new Ses_Standard_7_4();
        $childrens[] = new Ses_Standard_7_Overall();

        return $childrens;
    }

    public function set_intoduction()
    {
        $property = new \Orm_Property_Fixedtext('intoduction', '<strong>Adequate facilities and equipment must be available for the teaching and learning requirements of the program.  Use of facilities and equipment should be monitored and regular assessments of adequacy made through consultations with faculty, staff and students</strong>'
            . ' <br/> <br/>The scales below ask you to indicate whether these practices are followed in your institution and to show how well this is done. Wherever possible evaluations should be based on valid evidence and interpretations supported by independent opinions');
        $this->set_property($property);
    }

    public function get_intoduction()
    {
        return $this->get_property('intoduction')->get_value();
    }

}
