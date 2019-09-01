<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_2
 *
 * @author ahmadgx
 */
class Acpe_Section_2 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'SECTION II: STRUCTURE AND PROCESS TO PROMOTE ACHIEVEMENT OF EDUCATIONAL OUTCOMES';
    protected $link_pdf = true;
    protected $link_view = true;

    public function init()
    {
        parent::init();

            $this->set_introduction('');
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $childrens = array();
        $childrens[] = new Acpe_Section_2_Sub_A();
        $childrens[] = new Acpe_Section_2_Sub_B();
        $childrens[] = new Acpe_Section_2_Sub_C();
        $childrens[] = new Acpe_Section_2_Sub_D();


        return $childrens;
    }

    public function set_introduction()
    {
        $property = new \Orm_Property_Fixedtext('introduction', 'The Educational Outcomes articulated in Section I can only be fully achieved in an academic culture purposely designed to nurture learners and to support the administrators, faculty, preceptors, and staff who mentor them. The standards in Section II describe essential structures and processes that provide the organizational stability and potential for advancement critical to continuous quality improvement in pharmacy education.');
        $this->set_property($property);
    }

    public function get_introduction()
    {
        return $this->get_property('introduction')->get_value();
    }

}
