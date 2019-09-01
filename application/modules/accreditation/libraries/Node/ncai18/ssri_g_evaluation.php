<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of ssri_g_evaluation
 *
 * @author ahmadgx
 */
class Ssri_G_Evaluation extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'G. Evaluation in Relation to Quality Standards';
    protected $link_view = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_introduction();
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $childrens = array();
        $childrens[] = new Ssri_G_Evaluation_1_Mission();
        $childrens[] = new Ssri_G_Evaluation_2_Administration();
        $childrens[] = new Ssri_G_Evaluation_3_Quality_Assurance();
        $childrens[] = new Ssri_G_Evaluation_4_Learning_And_Teaching();
        $childrens[] = new Ssri_G_Evaluation_5_Student_Administration();
        $childrens[] = new Ssri_G_Evaluation_6_Learning_Resources();
        $childrens[] = new Ssri_G_Evaluation_7_Facilities_And_Equipment();
        $childrens[] = new Ssri_G_Evaluation_8_Financial_Planning();
        $childrens[] = new Ssri_G_Evaluation_9_Employment_Processes();
        $childrens[] = new Ssri_G_Evaluation_10_Research();
        $childrens[] = new Ssri_G_Evaluation_11_Institutional_Relationships();

        return $childrens;
    }

    public function set_introduction()
    {
        $property = new \Orm_Property_Fixedtext('introduction', "The main branch/location campus must complete the entire SSRI together with the required information from all branch/location campuses. <br/> <br/>"
            . "Response reports should be provided under each of the quality sub-standards set out in the<strong><i> Standards for Quality Assurance and Accreditation of Higher Education Institutions.</i></strong> <br/> <br/> "
            . "<ul>"
            . "<li>To ensure a full understanding of the SSRI an explanatory report should be included; giving background information or explanations of processes relevant to the standard concerned. </li> <br/>"
            . "<li>The reports should summarize the processes followed in investigating performance in relation to each standard and sub-standard.</li> <br/>"
            . "<li>A vital element of the SSRI is to provide specific data, show trends, support conclusions, and make appropriate comparisons with other institutions selected to provide benchmarks for evaluation of performance.  This data can include key performance indicators, other statistical information, figures derived from survey results, student results or anything that provides clear evidence about the matter being evaluated.  A simple assertion that something is good, or needs improvement, is not sufficient without evidence to back it up.</li></ul>");
        $this->set_property($property);
    }

    public function get_introduction()
    {
        return $this->get_property('introduction')->get_value();
    }

}
