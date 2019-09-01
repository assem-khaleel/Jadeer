<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ses_standard_10
 *
 * @author ahmadgx
 */
class Ses_Standard_10 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 10. Research';
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
        $childrens[] = new Ses_Standard_10_1();
        $childrens[] = new Ses_Standard_10_2();
        $childrens[] = new Ses_Standard_10_Overall();

        return $childrens;
    }

    public function set_intoduction()
    {
        $property = new \Orm_Property_Fixedtext('intoduction', '<strong>A research strategy that is consistent with the nature and mission of the institution should be developed All staff teaching higher education programs are expected to be involved in scholarly activities that ensure they remain up to date with developments in their field, and those developments should be reflected in their teaching.  Faculty teaching in post graduate programs or supervising higher degree research students must be actively involved in research in their field.  Adequate facilities and equipment must be available to support the research activities of faculty and postgraduate students in areas relevant to the program.  Staff research contributions must be recognized and reflected in evaluation and promotion criteria.</strong>'
            . ' <br/> <br/>The scales below ask you to indicate whether these practices are followed in your institution and to show how well this is done. Wherever possible evaluations should be based on valid evidence and interpretations supported by independent opinions.');
        $this->set_property($property);
    }

    public function get_intoduction()
    {
        return $this->get_property('intoduction')->get_value();
    }

}
