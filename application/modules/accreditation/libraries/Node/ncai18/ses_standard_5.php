<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of Ses_Standard_5
 *
 * @author user
 */
class Ses_Standard_5 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 5. Student Administration and Support Services';
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
        $childrens[] = new Ses_Standard_5_1();
        $childrens[] = new Ses_Standard_5_2();
        $childrens[] = new Ses_Standard_5_3();
        $childrens[] = new Ses_Standard_5_4();
        $childrens[] = new Ses_Standard_5_5();
        $childrens[] = new Ses_Standard_5_6();
        $childrens[] = new Ses_Standard_5_Overall();

        return $childrens;
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', "<strong>Administration of admissions and student record systems must be reliable and responsive, with confidentiality of records maintained in keeping with stated policies. Students' rights and responsibilities must be clearly defined and understood, with transparent and fair procedures available for discipline and appeals. Mechanisms for academic advice, counselling and support services must be accessible and responsive to student needs. Support services for students must go  beyond formal academic requirements and include extra curricular provisions for religious, cultural, sporting, and other activities relevant to the needs of the student body.</strong><br/><br/>
        The scales below ask you to indicate whether these practices are followed in your institution and to show how well this is done. Wherever possible evaluations should be based on valid evidence and interpretations supported by independent opinions.");
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
