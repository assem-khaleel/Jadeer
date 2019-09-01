<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb;

/**
 * Description of aacsb_section_2_accounting_academic_units
 *
 * @author laith
 */
class Aacsb_Section_2_Accounting_Academic_Units extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'STRATEGIC MANAGEMENT AND INNOVATION FOR ACCOUNTING ACADEMIC UNITS';
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
        $childrens[] = new Aacsb_Section_2_Accounting_Academic_Units_Standard_A1();
        $childrens[] = new Aacsb_Section_2_Accounting_Academic_Units_Standard_A2();
        $childrens[] = new Aacsb_Section_2_Accounting_Academic_Units_Standard_A3();

        return $childrens;
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'This section of the standards, which is focused on “Strategic Management,” is based on the principle that a quality accounting academic unit has a clear mission, acts on that mission, translates that mission into expected outcomes, and develops strategies for achieving those outcomes. It addresses three critical and related components: mission and strategy; scholarship and intellectual contributions; and financial strategies. <br/> <br/>'
            . 'AACSB believes that a wide range of missions are consistent with high quality, positive impact, and innovation. An accounting academic unit is most successful when it is clear about its priorities and when its mission, expected outcomes, and strategies are aligned and implemented across its activities. Under these conditions, the mission, expected outcomes, and strategies provide a context for an AACSB accounting accreditation review. That is, in applying the standards, the quality and success of a school is assessed in relation to its mission, expected outcomes, and supporting strategies. <br/> <br/>'
            . 'In this section, three criteria related to an accounting academic unit’s mission are of critical importance. First, the mission must be appropriate, descriptive, and transparent to constituents. Second, the mission must provide the unit with an overall direction for making decisions. Finally, the accounting unit’s strategies and intended outcomes must be aligned with the mission. The accreditation process seeks to take a holistic look at the accounting academic unit by reflecting on its many activities, actions, participants, strategies, resources, outcomes, innovations, and subsequent impact in the context of the specific culture, attitude, and philosophy of the unit and its larger institution as appropriate. A complete and accurate understanding of the context and environmental setting for the accounting academic unit is paramount in the accreditation peer review team’s ability to form a holistic view. <br/> <br/>'
            . 'The standards in this section reflect the dynamic environment of accounting academic units and business schools. These standards insist on the periodic, systematic review and possible revision of the unit’s mission, as well as on the engagement of appropriate stakeholders in developing and revising the mission, expected outcomes, and supporting strategies. Quality accounting academic units will have legacies of achievement, improvement, and impact. They implement forward-looking strategies to further their success, sustain their missions, and make an impact in the future. Central to the dynamic environment of accounting academic units are intellectual contributions and financial strategies that support change and innovation. <br/> <br/>'
            . 'Scholarship that fosters innovation and directly impacts the theory, practice, and teaching of accounting is a cornerstone of a quality accounting academic unit. A broad range of scholarly activities ensure intellectual vibrancy across and among faculty members and students; such activities contribute to the currency and relevancy of the unit’s educational programs and directly foster innovation in accounting practice and education. Intellectual contributions that arise from these scholarly activities ensure the accounting academic unit contributes to and is an integral part of an academic community of scholars within an institution and across the broader academic community of institutions in higher education. Outcomes of intellectual contributions are indicated by their impact or influence on the theory, practice, and teaching of accounting, business, and management rather than just by the number of articles published or documents produced. Schools should make their expectations regarding the impact of intellectual contributions clear and publicly transparent. <br/> <br/>'
            . 'Like an accounting academic unit’s intellectual contributions, its sound financial strategies and resources are essential for operational sustainability, improvement, and innovation. Sustaining quality accounting education and impactful research requires careful financial planning and an effective financial model. Accounting academic units cannot implement actions related to continuous improvement and innovation without sufficient funding, nor can they make effective strategic decisions without a clear understanding of the financial implications. <br/>');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
