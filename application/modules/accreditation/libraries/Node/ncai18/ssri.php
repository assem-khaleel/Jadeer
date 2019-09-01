<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of ssri
 *
 * @author ahmadgx
 */
class Ssri extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Self Study Report for Institutions (SSRI)';
    protected $link_pdf = true;
    protected $link_view = true;
    protected $link_send_to_review = true;

    function init()
    {
        parent::init();

            $this->set_self_study_report_for_the_institution();
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $childrens = array();
        $childrens[] = new Ssri_A_General_Info();
        $childrens[] = new Ssri_B_Institutional_Pro();
        $childrens[] = new Ssri_C_Self_Study_Process();
        $childrens[] = new Ssri_D_Context_Of_The_Self_Study();
        $childrens[] = new Ssri_E_Mission_And_Goals();
        $childrens[] = new Ssri_F_Progress_Towards();
        $childrens[] = new Ssri_G_Evaluation();
        $childrens[] = new Ssri_H_Independent_Evaluations();
        $childrens[] = new Ssri_I_Conclusions();
        $childrens[] = new Ssri_J_Action_Recommendations();
        $childrens[] = new Ssri_Signatures();

        return $childrens;
    }

    public function set_self_study_report_for_the_institution()
    {
        $property = new \Orm_Property_Fixedtext('self_study_report_for_the_institution', 'An institutional self-study is a thorough examination of the quality of an institution. The mission and objectives of the institution and the extent to which they are being achieved are thoroughly analyzed according to the standards for quality assurance and accreditation defined by the NCAAA. <br/> <br/>'
            . 'A Self Study Report for the Institution (SSRI) should be considered as a research report on the quality of the institution. It should include sufficient profile information to inform a reader about the process of investigation and the evidence on which conclusions are based to have reasonable confidence that those conclusions are sound. Conclusions should be supported by evidence, with verification of analysis and advice from others able to offer informed and independent comments. <br/> <br/>'
            . 'This SSRI should include all the necessary information for it to be read as a complete self contained report on the quality of the institution. <br/> <br/>'
            . 'The SSRI template includes sections, headings, and tables to assist in preparing the report. Throughout the report evidence should be presented in tables or other forms of data presentation to support conclusions, with comparative data and reference made to other reports or surveys. <br/> <br/>'
            . 'Key performance indicators (KPIs) are integral to the SSRI. <br/> <br/>'
            . '<strong>Institutional KPIs for the SSRI have two purposes.</strong> The first purpose is to provide reasonable and scientific evidence that the institution meets NCAAA standards. The second purpose is for the institution to identify specific KPIs that are utilized to demonstrate quality assurance for each of its programs <br/> <br/>'
            . '<strong>First,</strong>  in order to successfully demonstrate that the institution meets NCAAA standards, KPI tables with benchmarking and analysis, are located throughout the SSRI. The KPI tables are aligned with specific NCAAA sub-standards and are used to show evidence that the institution meets or exceeds the expected quality assurance level. Institutions are required to use 70% or more of the suggested NCAAA KPIs and are encouraged to develop a reasonable number of their own KPIs that scientifically validate compliance to standards or a given sub-standard. Additional KPIs and KPI tables may be used as evidence to demonstrate quality performance throughout the SSRI (copy and paste a complete KPI table wherever it is appropriate).<br/> <br/>'
            . '<strong>Second,</strong> the institution is required to demonstrate that it has developed an administrative quality assurance system for all of its programs as part of the institutional requirements for Standard 3. In order to complete this requirement, institutions are to select 6 to 8 KPIs, with target benchmarks, that it requires all of its programs to separately complete by providing their own internal benchmarking and analysis. Each program is to return its KPI report to the institution’s quality assurance unit to be aggregated, analyzed, and included in the SSRI, Standard 3. <br/> <br/>'
            . 'Further details and instructions are in the SSRI template. <br/> <br/>'
            . 'The SSRI should be provided as a single page numbered document, single sided, with a table of contents.   A list of acronyms used in the report should be attached. <br/> <br/>'
            . 'For further guidance on the completion of this template, please refer to the NCAAA guidebooks and the Accreditation Management System (AIMS).');
        $this->set_property($property);
    }

    public function get_self_study_report_for_the_institution()
    {
        return $this->get_property('self_study_report_for_the_institution')->get_value();
    }

    public function get_pdf_cover() {

        /** @var \Orm_Semester $semester */
        $semester = $this->get_system_obj()->get_item_obj();

        $background = '';
        if (file_exists(rtrim(FCPATH,'/').\Orm_Institution::get_instance()->get_ssr_cover())) {
            $background = 'background: url('.base_url(\Orm_Institution::get_instance()->get_ssr_cover()).') no-repeat fixed center top transparent; background-size: cover; ';
        }

        $cover = '<html>';
        $cover .= '<head>';
        $cover .= '<meta charset="utf-8">';
        $cover .= '</head>';
        $cover .= '<body style="'.$background.'padding-top:600px;">';
        $cover .= '<div style="padding:20px 0; display:block; position: relative; overflow: auto; text-align: center; font-family: \'Open Sans\', sans-serif; font-weight:bold; font-size: 18pt; color: #02577e; background-color: rgba(255,255,255,0.5);">';
        $cover .= \Orm_Institution::get_instance()->get_name_en().' '. \Orm::get_ci()->config->item('university-code') .'<br>';
        $cover .= 'Academic Year ('.$semester->get_year().')<br>';
        $cover .= '</div>';
        $cover .= '</body>';
        $cover .= '</html>';

        return $cover;
    }
}
