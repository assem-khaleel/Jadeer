<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of ses
 *
 * @author user
 */
class Ses extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Self Evaluation Scales (SES)';
    protected $link_pdf = true;
    protected $link_send_to_review = true;

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $childrens = array();
        $childrens[] = new Ses_Standard_1();
        $childrens[] = new Ses_Standard_2();
        $childrens[] = new Ses_Standard_3();
        $childrens[] = new Ses_Standard_4();
        $childrens[] = new Ses_Standard_5();
        $childrens[] = new Ses_Standard_6();
        $childrens[] = new Ses_Standard_7();
        $childrens[] = new Ses_Standard_8();
        $childrens[] = new Ses_Standard_9();
        $childrens[] = new Ses_Standard_10();
        $childrens[] = new Ses_Standard_11();

        return $childrens;
    }

    public function get_pdf_cover() {
        /** @var \Orm_Semester $semester */
        $semester = $this->get_system_obj()->get_item_obj();

        $background = '';
        if (file_exists(rtrim(FCPATH,'/').\Orm_Institution::get_instance()->get_sesr_cover())) {
            $background = 'background: url('.base_url(\Orm_Institution::get_instance()->get_sesr_cover()).') no-repeat fixed center top transparent; background-size: cover; ';
        }

        $cover = '<html>';
        $cover .= '<head>';
        $cover .= '<meta charset="utf-8">';
        $cover .= '</head>';
        $cover .= '<body style="'.$background.'padding-top:600px;">';
        $cover .= '<div style="padding:20px 0; display:block; position: relative; overflow: auto; text-align: center; font-family: \'Open Sans\', sans-serif; font-weight:bold; font-size: 18pt; color: #02577e; background-color: rgba(255,255,255,0.5);">';
        $cover .=  \Orm_Institution::get_instance()->get_name_en().' '. \Orm::get_ci()->config->item('university-code') .'<br>';
        $cover .= 'Academic Year ('.$semester->get_year().')<br>';
        $cover .= '</div>';
        $cover .= '</body>';
        $cover .= '</html>';

        return $cover;
    }
}
