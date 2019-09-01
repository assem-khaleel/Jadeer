<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of Ses_Standard_9
 *
 * @author user
 */
class Ses_Standard_9 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 9. Employment Processes';
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
        $childrens[] = new Ses_Standard_9_1();
        $childrens[] = new Ses_Standard_9_2();
        $childrens[] = new Ses_Standard_9_3();
        $childrens[] = new Ses_Standard_9_4();
        $childrens[] = new Ses_Standard_9_Overall();

        return $childrens;
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Teaching and other staff must have the qualifications and experience for effective exercise of their responsibilities. Professional development strategies must be followed  to ensure continuing improvement in the expertise of teaching and other staff.  Performance of all teaching and other staff should be periodically evaluated, with outstanding performance recognized and support provided for improvement when required.  Effective, fair, and  transparent processes must be available for the resolution of conflicts and disputes involving teaching or other staff. (Note:  Teaching staff refers to all staff with responsibility for teaching classes including full and part time staff, faculty, lecturers, and teaching assistants)</strong><br/><br/>
        The scales below ask you to indicate whether these practices are followed in your institution and to show how well this is done. Wherever possible evaluations should be based on valid evidence and interpretations supported by independent opinions');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
