<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb;

/**
 * Description of Aacsb_Section_2_Accounting_Learning_Teaching_Standard_A7
 *
 * @author laith
 */
class Aacsb_Section_2_Accounting_Learning_Teaching_Standard_A7 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard A7';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_guide();
            $this->set_textarea1('');
            $this->set_textarea2('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Consistent with mission, expected outcomes, and supporting strategies, accounting degree programs include learning experiences that develop skills and knowledge related to the integration of information technology in accounting and business. Included in these learning experiences is the development of skills and knowledge related to data creation, data sharing, data analytics, data mining, data reporting, and storage within and across organizations. [INFORMATION TECHNOLOGY SKILLS AND KNOWLEDGE FOR ACCOUNTING GRADUATES—NO RELATED BUSINESS STANDARD]</strong> <br/> <br/>'
            . '<strong>Basis for Judgment</strong> <br/>'
            . '<ul type="circle">'
            . '<li>Consistent with mission, accounting degree programs integrate current and emerging accounting and business statistical techniques, data management, data analytics and information technologies in the curricula. Learning experiences may be supported by business, accounting, and other academic units.</li>'
            . '<li>Student experiences integrate real-world business strategies, privacy and security concerns, ethical issues, data management, data analytics, technology-driven changes in the work environment, and the complexities of decision making.</li>'
            . '<li>Consistent with mission, graduates demonstrate the ability to effectively utilize data analytics tools, data management tools, and information technologies; graduates should understand the capabilities of these tools, along with their impact and the concomitant risks and opportunities.</li>'
            . '<li>Because the review process recognizes the dynamic, interdisciplinary nature of data analytics, data management and other information technologies, there will be a transitional period of three years, from 2013 to 2016, related to this standard. During the transition period, there should be evidence of substantive progress to address the spirit and intent of the standard.</li>'
            . '</ul>');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
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
        $property->set_description('Document the integration of data analytics, data management and other information technologies the impact of these technologies, and the concomitant risks and opportunities within accounting degree programs, including learning experiences from other business and non-business fields or disciplines.');
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
        $property->set_description('Document the learning strategies the unit has deployed to develop accounting graduate competencies in data analytics, data management, and other business information technologies and how they are consistent with the mission, expected outcomes and strategies.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea2()
    {
        return $this->get_property('textarea2')->get_value();
    }

}
