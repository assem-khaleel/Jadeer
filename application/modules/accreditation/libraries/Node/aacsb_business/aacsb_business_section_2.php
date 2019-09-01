<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb_business;

/**
 * Description of aacsb_business_section_2
 *
 * @author ahmadgx
 */
class Aacsb_Business_Section_2 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'SECTION 2: STANDARDS FOR BUSINESS ACCREDITATION';
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
        $childrens[] = new aacsb_business_section_2_Standard_1();
        $childrens[] = new aacsb_business_section_2_Standard_2();
        $childrens[] = new aacsb_business_section_2_Standard_3();
        $childrens[] = new Aacsb_Business_Section_2_Participants();
        $childrens[] = new Aacsb_Business_Section_2_Learning();
        $childrens[] = new Aacsb_Business_Section_2_Academic();

        return $childrens;
    }

    public function set_introduction()
    {
        $property = new \Orm_Property_Fixedtext('introduction', '<strong>STRATEGIC MANAGEMENT AND INNOVATION</strong> <br/> <br/>'
            . 'This section’s focus on “Strategic Management” is based on the principle that a quality business school has a clear mission, acts on that mission, translates that mission into expected outcomes, and develops strategies for achieving those outcomes. It addresses three critical and related components: mission and strategy; scholarship and intellectual contributions; and financial strategies. <br/> <br/>'
            . 'AACSB believes that a wide range of missions can be consistent with high quality, positive impact, and innovation. Such success is achieved when schools are clear about their priorities and when the mission, expected outcomes, and strategies are aligned and implemented across the school’s activities. Under these conditions, the mission, expected outcomes, and strategies provide a context for the AACSB accreditation review. That is, in applying the standards, the quality and success of a school is assessed in relation to its mission, expected outcomes, and supporting strategies. <br/> <br/>'
            . 'In this section, three criteria related to a school’s mission are of critical importance. First, the mission must be appropriate, descriptive, and transparent to the school’s constituents. Second, the mission must provide the school with an overall direction for making decisions. Finally, the school’s strategies and intended outcomes must be aligned with the mission. The accreditation process takes a strategic, holistic look at the business school by reflecting on its mission, strategies, actions, participants, stakeholders, resources, expected outcomes, and impacts in the context of the culture of the school and its larger institution as appropriate. A complete and accurate understanding of the context and environmental setting for the school is paramount in the accreditation peer review team’s ability to form a holistic view. <br/> <br/>'
            . 'The standards in this section reflect the dynamic environment of business schools. These standards insist on the periodic, systematic review and possible revision of a school’s mission, as well as on the engagement of appropriate stakeholders in developing and revising the mission, expected outcomes, and supporting strategies. Quality business schools have legacies of achievement, improvement, and impact. They implement forward-looking strategies to further their success, sustain their missions, and make an impact in the future. Central to the dynamic environment of business schools are intellectual contributions and financial strategies that support change and innovation. <br/> <br/>'
            . 'Scholarship that fosters innovation and directly impacts the theory, practice, and teaching of business and management is a cornerstone of a quality business school. A broad range of scholarly activities ensures intellectual vibrancy across and among faculty members and students; such activities contribute to the currency and relevance of the school’s educational programs and directly foster innovation in business enterprises and academic institutions. Intellectual contributions that arise from these scholarly activities ensure the business school contributes to and is an integral part of an academic community of scholars within an institution and across the broader academic community of institutions in higher education. Outcomes of intellectual contributions are indicated by their impact or influence on the theory, practice, and teaching of business and management rather than just by the number of articles published or documents produced. Schools should make their expectations regarding the impact of intellectual contributions clear and publicly transparent. <br/> <br/>'
            . 'Like intellectual contributions, sound financial models and strategies are essential for operational sustainability, improvement, and innovation in a business school. Sustaining quality management education and impactful research requires careful financial planning and an effective financial model. Schools cannot implement actions related to continuous improvement and innovation without sufficient resources. In addition, schools cannot make effective strategic decisions without a clear understanding of the financial implications.');
        $this->set_property($property);
    }

    public function get_introduction()
    {
        return $this->get_property('introduction')->get_value();
    }

}
