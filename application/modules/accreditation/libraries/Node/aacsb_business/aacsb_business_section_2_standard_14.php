<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb_business;

/**
 * Description of aacsb_business_section_2_standard_14
 *
 * @author ahmadgx
 */
class Aacsb_Business_Section_2_Standard_14 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 14';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_standard_name('');
            $this->set_definition('');
            $this->set_portfolio('');
            $this->set_education_programs('');
            $this->set_education_participation('');
            $this->set_client_expectations('');
    }

    public function set_standard_name()
    {
        $property = new \Orm_Property_Fixedtext('standard_name', "<b>If applicable, executive education (activities not leading to a degree) complements teaching and learning in degree programs and intellectual contributions. The school has appropriate processes to ensure high quality in meeting client expectations and continuous improvement in executive education programs. [EXECUTIVE EDUCATION]</b>");
        $this->set_property($property);
    }

    public function get_standard_name()
    {
        return $this->get_property('standard_name')->get_value();
    }

    public function set_definition()
    {
        $property = new \Orm_Property_Fixedtext('definition', '<strong>Definitions</strong> <br/>'
            . '<ul>'
            . '<li>Executive education involves educational activities that do not lead to a degree but have educational objectives at a level consistent with higher education in management.</li>'
            . '</ul>'
            . '<br/><br/><br/><strong>Basis for Judgment</strong>'
            . '<ul>'
            . '<li>This standard is applicable if executive education is an important part of the mission, strategy, and educational activities of the school. Although there is no pre-established minimum to be considered “significant” or “material,” normally if five percent or more of total school annual resources are generated from executive education as defined above, this standard should be addressed. A school may request that executive education be included in the accreditation review if it is less than five percent or excluded from the accreditation review if it is more. A school should justify such a request.</li>'
            . '<li>The school’s involvement in executive education enhances the quality of student learning in degree programs and supports the generation of intellectual contributions from faculty. Similarly, executive education is enhanced by the degree program and scholarly activities.</li>'
            . '<li>As a significant point of professional engagement, the school has effective processes to determine the extent to which client expectations are met and to identify and develop opportunities for improvement.</li>'
            . '</ul>'
            . '<br/><br/><strong>Guidance for Documentation</strong>');
        $this->set_property($property);
    }

    public function get_definition()
    {
        return $this->get_property('definition')->get_value();
    }

    public function set_portfolio($value)
    {
        $property = new \Orm_Property_Textarea('portfolio', $value);
        $property->set_description('Describe the portfolio of executive education programs, identifying who the intended audiences are, what levels of education the members of this audience possess, how the program portfolio is aligned with the school’s mission and strategy, and how the executive education program makes a contribution to mission achievement.');
        $this->set_property($property);
    }

    public function get_portfolio()
    {
        return $this->get_property('portfolio')->get_value();
    }

    public function set_education_programs($value)
    {
        $property = new \Orm_Property_Textarea('education_programs', $value);
        $property->set_description('Discuss how the school’s executive education programs, degree programs, and intellectual contributions complement each other, giving examples when appropriate.');
        $this->set_property($property);
    }

    public function get_education_programs()
    {
        return $this->get_property('education_programs')->get_value();
    }

    public function set_education_participation($value)
    {
        $property = new \Orm_Property_Textarea('education_participation', $value);
        $property->set_description('Where executive education participation leads to opportunities for degree program admission, document the process and provide evidence of the success of degree program graduates admitted through this process.');
        $this->set_property($property);
    }

    public function get_education_participation()
    {
        return $this->get_property('education_participation')->get_value();
    }

    public function set_client_expectations($value)
    {
        $property = new \Orm_Property_Textarea('client_expectations', $value);
        $property->set_description('Describe processes for ensuring that client expectations are met consistently, summarize feedback from these processes, and demonstrate the impact of these processes on enhancing executive education programs.');
        $this->set_property($property);
    }

    public function get_client_expectations()
    {
        return $this->get_property('client_expectations')->get_value();
    }

}
