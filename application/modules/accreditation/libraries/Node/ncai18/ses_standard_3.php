<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of Ses_Standard_3
 *
 * @author user
 */
class Ses_Standard_3 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 3. Management of Quality Assurance and Improvement Processes';
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
        $property = new \Orm_Property_Fixedtext('info', "<strong>Quality assurance processes must involve all sections of the institution and be effectively integrated into normal planning and administrative processes. Criteria for assessment of quality must include inputs, processes and outcomes with a particular focus on outcomes. Processes must be established to ensure that teaching and other staff and students are committed to improvement and regularly evaluate their own performance. Quality must be assessed by reference to evidence based on indicators of performance and challenging external benchmarks. Specific requirements in the institution's quality assurance system should be periodically reviewed to ensure that unnecessary requirements are not included and that data that is provided is actually used in an effective way.</strong><br/><br/>"
            . "The scales below ask you to indicate whether these practices are followed in your institution and to show how well this is done. Wherever possible evaluations should be based on valid evidence and interpretations supported by independent opinions.");
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
