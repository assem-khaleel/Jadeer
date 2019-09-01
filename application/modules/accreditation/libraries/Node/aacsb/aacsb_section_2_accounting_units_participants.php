<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb;

/**
 * Description of aacsb_section_2__accounting_units_participants
 *
 * @author laith
 */
class Aacsb_Section_2_Accounting_Units_Participants extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'ACCOUNTING UNIT PARTICIPANTS – STUDENTS, PROFESSIONAL STAFF, AND FACULTY';
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
        $childrens[] = new Aacsb_Section_2_Accounting_Units_Participants_Standard_A4();

        return $childrens;
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'Participants (the students, faculty, and professional staff of the accounting academic unit) are critical to the achievement of a unit’s mission. Students who are matched to the expectations of accounting degree programs—as well as prepared to achieve those expectations—are essential for successful educational programs. Professional staff members facilitate and support learning and provide essential services for students and faculty. Faculty resources develop and manage curricula and teach students, as well as produce intellectual contributions that advance the knowledge, practice, and teaching of accounting, business, and management. Accordingly, the following standards focus on the admission, support, and progression of students, as well as on the (deployment of sufficient faculty and professional staff to support mission achievement of the accounting academic unit. <br/> <br/>'
            . 'In identifying faculty resources, the accounting academic unit should focus on the participation and work of faculty members. Faculty contractual relationships, title, tenure status, full-time or part-time status, etc., can help to explain and document the work of faculty, but these factors are not perfectly correlated with participation or with the most critical variables in assessing faculty sufficiency, deployment, and qualifications. What is most important is that the production and maintenance of faculty’s intellectual capital (as framed in Standard 15) bring currency and relevance to the accounting academic unit’s programs and support its mission, expected outcomes, and strategies. <br/> <br/>'
            . 'These standards also recognize that with the advent of different program delivery models, certain responsibilities once managed exclusively by those traditionally considered “faculty” may now be shared or managed by others. That is, developing curricula, creating instructional materials, delivering classroom lectures regardless of the medium, tutoring small groups of students, conducting and grading student papers, etc., may be conducted by traditional faculty, by non-traditional faculty, or by a team of individuals. Regardless of the blend of faculty and other key members of the accounting academic unit’s team, the key issue is that the unit ensures quality outcomes. Therefore, the unit under review must make its case that its division of labor across faculty and staff, as well as its supporting policies, procedures, and infrastructure, deliver high-quality learning outcomes in the context of the teaching/learning models it employs. In addition, the unit must ensure that faculty and professional staff are sufficient to support research outcomes and other mission-related activities, and that policies, procedures, and feedback mechanisms exist to provide evidence that all participants in these activities produce quality outcomes and embrace continuous improvement. Where there are problems, evidence of corrective actions is essential. <br/> <br/>');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
