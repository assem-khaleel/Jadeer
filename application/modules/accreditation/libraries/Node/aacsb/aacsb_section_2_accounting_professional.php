<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb;

/**
 * Description of aacsb_section_2__accounting_professional
 *
 * @author laith
 */
class Aacsb_Section_2_Accounting_Professional extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'ACCOUNTING ACADEMIC AND PROFESSIONAL ENGAGEMENT AND PROFESSIONAL INTERACTIONS';
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
        $childrens[] = new Aacsb_Section_2_Accounting_Professional_Standard_A8();
        $childrens[] = new Aacsb_Section_2_Accounting_Professional_Standard_A9();

        return $childrens;
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'Accounting academic units seeking AACSB accounting accreditation are professional schools in that they exist at the intersection of theory and practice. In this context, it is important for the accounting academic unit to be firmly grounded in both the academic study and professional practice of accounting, business, and management. Accounting academic units can achieve effective accounting education and impactful research by striking different balances between academic study and professional engagement. However, if units largely ignore one side or the other, both their degree programs and scholarly output will suffer. Accreditation should encourage an appropriate balance and integration of academic and professional engagement and professional interactions consistent with quality in the context of the accounting academic units mission. Sustained professional interactions among accounting faculty members, students, and accounting and business professionals are essential to share and explore emerging trends and challenges, develop rational questions for scholarly research, support current and relevant learning experiences for students, and advance the accounting profession. <br/> <br/>'
            . 'Most important, academic study, professional engagement, and professional interaction are not separate activities for an accounting academic unit; rather, they intersect in significant ways. This section of the AACSB accounting accreditation standards is designed to foster such integration and intersection appropriate to the mission of the accounting academic unit. It identifies critical activities that connect theory and practice through professional engagement and interactions. By encouraging appropriate interactions among faculty, students, and practitioners, these activities also support teaching and learning, promote experiential learning, engage students, and foster valuable contributions to accounting education and research. <br/>');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
