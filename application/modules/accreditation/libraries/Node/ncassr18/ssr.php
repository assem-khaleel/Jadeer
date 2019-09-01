<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ssr
 *
 * @author duaa
 */
class Ssr extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Self-Study Report for Programs (SSRP)';
    protected $link_pdf = true;
    protected $link_view = true;
    protected $link_send_to_review = true;

    function init()
    {
        parent::init();

        if (true) {
            $this->set_introduction();
        }
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $childrens = array();
        $childrens[] = new Ssr_A();
        $childrens[] = new Ssr_B();
        $childrens[] = new Ssr_C();
        $childrens[] = new Ssr_D();
        $childrens[] = new Ssr_E();
        $childrens[] = new Ssr_F();
        $childrens[] = new Ssr_G();
        $childrens[] = new Ssr_H();
        $childrens[] = new Ssr_I();
        $childrens[] = new Ssr_J();
        $childrens[] = new Ssr_K();
        $childrens[] = new Ssr_Signatures();


        return $childrens;
    }

    public function set_introduction()
    {
        $property = new \Orm_Property_Fixedtext('introduction', '<strong>Introductory Comments</strong> <br/> <br/>'
            . 'A program self-study is a thorough examination of the quality of a program. The mission and objectives of the program and the extent to which they are being achieved are thoroughly analyzed according to the standards for quality assurance and accreditation defined by the NCAAA. <br/> <br/>'
            . 'A Self Study Report for Programs (SSRP) should be considered as a research report on the quality of the program. It should include sufficient information to inform a reader who is unfamiliar with the program about the process of investigation and the evidence on which conclusions are based to have reasonable confidence that those conclusions are sound. <br/> <br/>'
            . 'Conclusions should be supported by evidence, with verification of analysis and advice from others able to offer informed and independent comments. <br/> <br/>'
            . 'This SSRP should include all the necessary information for it to be read as a complete self-contained report on the quality of the program. <br/> <br/>'
            . '<strong>The main branch/location campus must complete the entire SSRP together with the required information from all branch/location campuses that offer the program. <br/> <br/>'
            . 'Each branch/location campus must complete an abridged, short version, of the SSRP; including the Periodic Program Profile, Profile sections (A-H) and standards 3, 4, and 11. After analysis and inclusion of required information, the main branch campus will submit the complete SSRP with the abridged versions to NCAAA. <br/> <br/></strong>'
            . '<strong>The Self Study Report for Programs template is for an Undergraduate Program. </strong>or guidance on the completion of this template, please refer to the Handbook for Quality Assurance and Accreditation and to the Guidelines for Using the Template for a Program Self-Study.</i>');
        $this->set_property($property);
    }

    public function get_introduction()
    {
        return $this->get_property('introduction')->get_value();
    }

    public function get_pdf_cover() {

        /** @var \Orm_Program $program */
        $program = $this->get_parent_program_node()->get_item_obj();
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
        $cover .= $program->get_code('english') .' '. $program->get_name('english').'<br>';
        $cover .= 'Academic Year ('.$semester->get_year().')<br>';
        $cover .= $program->get_department_obj()->get_name('english') .'<br>';
        $cover .= $program->get_department_obj()->get_college_obj()->get_name('english') .'<br>';
        $cover .= '</div>';
        $cover .= '</body>';
        $cover .= '</html>';

        return $cover;
    }
}
