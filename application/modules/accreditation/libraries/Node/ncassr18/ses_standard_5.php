<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ses_standard_5
 *
 * @author ahmadgx
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
        $childrens[] = new Ses_Standard_5_Overall();

        return $childrens;
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Admission processes must be efficient, fair, and responsive to the needs of students entering the program.  Clear information about program requirements and criteria for admission  and program completion must be readily available for prospective students and when required at later stages during the program.  Mechanisms for student appeals and dispute resolution are clearly described, made known, and fairly administered.  Career advice must be provided in relation to occupations related to the fields of study dealt with in the program</strong> <br/>'
            . 'The scales below ask you to indicate whether these practices are followed in your institution and to show how well this is done. Wherever possible evaluations should be based on valid evidence and interpretations supported by independent opinions');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
