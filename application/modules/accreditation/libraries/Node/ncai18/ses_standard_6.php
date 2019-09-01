<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of Ses_Standard_6
 *
 * @author user
 */
class Ses_Standard_6 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 6. Learning Resources';
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
        $childrens[] = new Ses_Standard_6_1();
        $childrens[] = new Ses_Standard_6_2();
        $childrens[] = new Ses_Standard_6_3();
        $childrens[] = new Ses_Standard_6_4();
        $childrens[] = new Ses_Standard_6_Overall();

        return $childrens;
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', "<strong>Learning resources including libraries and provisions for access to electronic and other reference material must be planned to meet the particular requirements of the institution's programs and provided at an adequate level. Library and associated IT facilities must be accessible at times to support independent learning, with assistance provided in finding material required. Facilities must be provided for individual and group study in an environment conducive to effective investigations and research. The services must be evaluated and should be improved in response to systematic feedback from teaching staff and students.</strong><br/><br/>
        The scales below ask you to indicate whether these practices are followed in your institution and to show how well this is done. Wherever possible evaluations should be based on valid evidence and interpretations supported by independent opinions.");
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
