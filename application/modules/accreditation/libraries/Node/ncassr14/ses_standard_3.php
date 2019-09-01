<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ses_standard_3
 *
 * @author ahmadgx
 */
class Ses_Standard_3 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 3. Management of Program Quality Assurance';
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
        $childrens[] = new Ses_Standard_3_1();
        $childrens[] = new Ses_Standard_3_2();
        $childrens[] = new Ses_Standard_3_3();
        $childrens[] = new Ses_Standard_3_4();
        $childrens[] = new Ses_Standard_3_5();
        $childrens[] = new Ses_Standard_3_Overall();

        return $childrens;
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Teaching and other staff involved in the program  must regularly evaluate their own performance and be committed to improving both their own performance and the quality of the program as a whole.  Regular evaluations of quality must be undertaken within each course based on valid evidence and appropriate benchmarks, and plans for improvement made and implemented.  Quality must be assessed by reference to evidence and include consideration of specific performance indicators and challenging external benchmarks.  Central importance must be attached to student learning outcomes with each course contributing to the achievement of overall program objectives.</strong>'
            . 'The scales below ask you to indicate whether these practices are followed in your institution and to show how well this is done. Wherever possible evaluations should be based on valid evidence and interpretations supported by independent opinions');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
