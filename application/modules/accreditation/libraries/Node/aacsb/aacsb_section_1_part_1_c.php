<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb;

/**
 * Description of aacsb_section_1_part_1_c
 *
 * @author laith
 */
class Aacsb_Section_1_part_1_C extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard C';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_basis();
            $this->set_guide();
            $this->set_textarea1('');
            $this->set_textarea2('');
            $this->set_textarea3('');
            $this->set_textarea4('');
            $this->set_textarea5('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong> The accounting academic unit must demonstrate a commitment to address, engage, and respond to current and emerging corporate social responsibility issues (e.g., diversity, sustainable development, environmental sustainability, and globalization of economic activity across cultures) through its policies, procedures, curricula, research, and/or outreach activities. [COMMITMENT TO CORPORATE SOCIAL RESPONSIBILITY]</strong> <br/> <br/><strong>Basis for Judgment</strong>');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_basis()
    {
        $property = new \Orm_Property_Fixedtext('basis', '<ul type="circle"><li>Diversity in people and ideas enhances the educational experience in every management education program. At the same time, diversity is a culturally embedded concept rooted in historical and cultural traditions, legislative and regulatory concepts, economic conditions, ethnicity, gender, socioeconomic conditions, and experiences.</li>'
            . '<li>Diversity, sustainable development, environmental sustainability, and other emerging corporate and social responsibility issues are important and require responses from accounting academic units and accounting students.</li>'
            . '<li>The accounting academic unit fosters among participants sensitivity to, as well as an awareness and understanding of, diverse viewpoints related to current and emerging corporate social responsibility issues.</li>'
            . '<li>The accounting academic unit must foster sensitivity to cultural differences and global perspectives. Graduates should be prepared to pursue accounting, business, or management careers in a global context. Students should be exposed to cultural practices different than their own.</li></ul>');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_basis()
    {
        return $this->get_property('basis')->get_value();
    }

    public function set_guide()
    {
        $property = new \Orm_Property_Fixedtext('guide', '<strong>Guidance for Documentation</strong>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_guide()
    {
        return $this->get_property('guide')->get_value();
    }

    public function set_textarea1($value)
    {
        $property = new \Orm_Property_Textarea('textarea1', $value);
        $property->set_description('Describe how the accounting academic unit defines and supports the concept of diversity in ways appropriate to its culture, historical traditions, and legal and regulatory environment. Demonstrate that the unit is sensitive to cultural differences and global perspectives.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea1()
    {
        return $this->get_property('textarea1')->get_value();
    }

    public function set_textarea2($value)
    {
        $property = new \Orm_Property_Textarea('textarea2', $value);
        $property->set_description('Demonstrate the accounting academic unit values a rich variety of viewpoints in its learning community by seeking and supporting diversity among its students and faculty in alignment with its mission.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea2()
    {
        return $this->get_property('textarea2')->get_value();
    }

    public function set_textarea3($value)
    {
        $property = new \Orm_Property_Textarea('textarea3', $value);
        $property->set_description('Define the populations the unit serves and describe the unit’s role in fostering opportunity for underserved populations.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea3()
    {
        return $this->get_property('textarea3')->get_value();
    }

    public function set_textarea4($value)
    {
        $property = new \Orm_Property_Textarea('textarea4', $value);
        $property->set_description('Define the ways the school supports high-quality education by making an appropriate effort to diversify the participants in the educational process and guarantee that all activities include a wide variety of perspectives.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea4()
    {
        return $this->get_property('textarea4')->get_value();
    }

    public function set_textarea5($value)
    {
        $property = new \Orm_Property_Textarea('textarea5', $value);
        $property->set_description('Demonstrate that the accounting academic unit addresses current and emerging corporatesocial responsibility issues through its own activities, through collaborations with other units within its institution, and/or through partnerships with external constituencies.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea5()
    {
        return $this->get_property('textarea5')->get_value();
    }

}
