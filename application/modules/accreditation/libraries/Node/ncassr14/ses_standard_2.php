<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ses_standard_2
 *
 * @author ahmadgx
 */
class Ses_Standard_2 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 2. Program Administration';
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
        $childrens[] = new Ses_Standard_2_1();
        $childrens[] = new Ses_Standard_2_2();
        $childrens[] = new Ses_Standard_2_3();
        $childrens[] = new Ses_Standard_2_4();
        $childrens[] = new Ses_Standard_2_5();
        $childrens[] = new Ses_Standard_2_Overall();

        return $childrens;
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Program administration must provide effective leadership and reflect an appropriate balance between accountability to senior management and the governing board of the institution within which the program is offered, and flexibility to meet the specific requirements of the program concerned.  Planning processes must involve stakeholders (eg. students, professional bodies, industry representatives, faculty)  in establishing goals and objectives and reviewing and responding to results achieved.In sections for male and female students resources for the program must be comparable in both sections and there must be effective communication between them and equitable involvement in planning processes. The quality of delivery of courses and the program as a whole must be  regularly monitored  with adjustments made promptly in response to this feedback and developments in the external environment affecting the program.</strong> <br/>'
            . 'The scales below ask you to indicate whether these practices are followed in your institution and to show how well this is done. Wherever possible evaluations should be based on valid evidence and interpretations supported by independent opinions.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
