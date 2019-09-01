<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of Ses_Standard_7
 *
 * @author user
 */
class Ses_Standard_7 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 7. Facilities and Equipment';
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
        $childrens[] = new Ses_Standard_7_1();
        $childrens[] = new Ses_Standard_7_2();
        $childrens[] = new Ses_Standard_7_3();
        $childrens[] = new Ses_Standard_7_4();
        $childrens[] = new Ses_Standard_7_5();
        $childrens[] = new Ses_Standard_7_Overall();

        return $childrens;
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Facilities must be designed or adapted to meet the particular requirements for teaching and learning in the programs offered by the college, and offer a safe and healthy environment for high quality education.  Use of facilities must be monitored and user surveys used to assist in planning for improvement.  Adequate provision must be made for classrooms and laboratories, use of computer technology and research equipment by teaching staff and students. Appropriate provision must be made for facilities for associated services such as food services, extra-curricular activities, and where relevant, student accommodation.</strong><br/><br/>
        The scales below ask you to indicate whether these practices are followed in your institution and to show how well this is done. Wherever possible evaluations should be based on valid evidence and interpretations supported by independent opinions.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
