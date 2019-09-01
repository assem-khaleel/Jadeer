<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_2_sub_d_standard22
 *
 * @author ahmadgx
 */
class Acpe_Section_2_Sub_D_Standard22 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 22: Practice Facilities';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_college('');
            $this->set_key('');
            $this->set_quality_criteria('');
            $this->set_affiliation_agreement('');
            $this->set_evaluation('');
    }

    public function set_college()
    {
        $property = new \Orm_Property_Fixedtext('college', 'The college or school has the appropriate number and mix of facilities in which required and elective practice experiences are conducted to accommodate all students. Practice sites are appropriately licensed and selected based on quality criteria to ensure the effective and timely delivery of the experiential component of the curriculum.');
        $this->set_property($property);
    }

    public function get_college()
    {
        return $this->get_property('college')->get_value();
    }

    public function set_key()
    {
        $property = new \Orm_Property_Fixedtext('key', '<b>Key Element:</b>');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_key()
    {
        return $this->get_property('key')->get_value();
    }

    public function set_quality_criteria($value)
    {
        $property = new \Orm_Property_Textarea('quality_criteria', $value);
        $property->set_description('22.1. Quality criteria – The college or school employs quality criteria for practice facility recruitment and selection, as well as setting forth expectations and evaluation based on student opportunity to achieve the required Educational Outcomes as articulated in Standards 1–4.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_quality_criteria()
    {
        return $this->get_property('quality_criteria')->get_value();
    }

    public function set_affiliation_agreement($value)
    {
        $property = new \Orm_Property_Textarea('affiliation_agreement', $value);
        $property->set_description('22.2. Affiliation agreements – The college or school secures and maintains signed affiliation agreements with the practice facilities it utilizes for the experiential component of the curriculum. At a minimum, each affiliation agreement ensures that all experiences are conducted in accordance with state and federal laws.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_affiliation_agreement()
    {
        return $this->get_property('affiliation_agreement')->get_value();
    }

    public function set_evaluation($value)
    {
        $property = new \Orm_Property_Textarea('evaluation', $value);
        $property->set_description('22.3. Evaluation – Practice sites are regularly evaluated. Quality enhancement initiatives and processes are established, as needed, to improve student learning outcomes.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_evaluation()
    {
        return $this->get_property('evaluation')->get_value();
    }

}
