<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ssr_e
 *
 * @author ahmadgx
 */
class Ssr_E extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'E. Self-Study Process';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

        $this->set_self_study_process();
        $this->set_self_study('');


    }

    public function set_self_Study_process()
    {
        $property = new \Orm_Property_Fixedtext('self_Study_process', 'Provide the following:'
            . '<ul><li> A summary description of the procedures followed and administrative arrangements for the self- study.</li>'
            . '<li> A quality assurance organization flowchart.</li>'
            . '<li> Description of membership and terms of reference for committees and /or working parties.  </li></ul>');
        $this->set_property($property);
    }

    public function get_e_self_Study_process()
    {
        return $this->get_property('self_Study_process')->get_value();
    }

    public function set_self_study($value)
    {
        $property = new \Orm_Property_Textarea('self_study', $value);
        $this->set_property($property);
    }

    public function get_self_study()
    {
        return $this->get_property('self_study')->get_value();
    }

}
