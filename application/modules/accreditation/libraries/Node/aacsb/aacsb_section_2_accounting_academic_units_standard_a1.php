<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb;

/**
 * Description of aacsb_section_2_accounting_academic_units_standard_a1
 *
 * @author laith
 */
class Aacsb_Section_2_Accounting_Academic_Units_Standard_A1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard A1';
    protected $link_pdf = false;
    protected $link_view = true;
    protected $link_edit = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_guide();
            $this->set_textarea1('');
            $this->set_textarea2('');
            $this->set_textarea3('');
            $this->set_textarea4('');
            $this->set_textarea5('');
            $this->set_textarea6('');
            $this->set_textarea7('');
            $this->set_textarea8('');
            $this->set_textarea9('');
            $this->set_textarea10('');
            $this->set_textarea11('');
            $this->set_textarea12('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong> The accounting academic unit articulates a clear and distinctive mission, the expected outcomes this mission implies, and the strategies it will employ to achieve these outcomes. The unit has a history of achievement and improvement and specifies future actions for continuous improvement and innovation consistent with its mission, expected outcomes, and strategies. [ACCOUNTING ACADEMIC UNIT MISSION, IMPACT, AND INNOVATION—RELATED BUSINESS STANDARD 1]</strong> <br/> <br/>'
            . '<strong>Definitions</strong> <br/>'
            . '<ul type="circle">'
            . '<li>Mission is a single statement or set of statements serving as a guide for the unit and its stakeholders. These statements capture the unit’s core purposes, express its aspirations, and describe its distinguishing features. The mission is not usually described entirely by the mission statement. It is more completely encapsulated in a set of statements that describe the unit, including the mission statement, vision statement, and statements of values. In addition, the relationship of the accounting academic unit to the institutional entity and/or business school should be reflected in the mission.</li>'
            . '<li>The term distinctive refers to goals, characteristics, priorities, focus areas, or approaches of the unit that are special or notable. These should be revealed by the unit’s mission and evident in its expected outcomes and strategies. Distinctiveness does not imply that the unit is different from all others.</li>'
            . '<li>Expected outcomes are conveyed s broad or high-level statements describing impacts the unit expects to achieve in the accounting, business, and academic communities it serves as it pursues its mission through educational activities, scholarship, and other endeavors. Expected outcomes translate the mission into overarching goals against which the accounting academic unit evaluates its success.</li>'
            . '<li>Strategies describe, in general, how the accounting academic unit intends to achieve its mission and expected outcomes, including how it finances activities to achieve its mission. Strategies are general, or overarching, statements of direction derived from the strategic management of the unit.</li>'
            . '</ul>'
            . '<br/> <br/><strong>Basis for Judgment</strong><br/>'
            . '<ul type="circle">'
            . '<li>The accounting academic unit’s mission guides decision making and identifies distinguishing characteristics, attributes, focus areas, priorities, etc., that indicate how the unit positions itself among the international community of accounting units. Distinctiveness does not imply that the unit must somehow be different from all other AACSB-accredited accounting academic units. Rather, through its mission, expected outcomes, and strategies, the unit clearly articulates those attributes that describe the unit to its various constituencies and across the global community of accounting programs.</li>'
            . '<li>The unit’s mission, expected outcomes, and strategies are mutually consistent and reflect a realistic assessment of the changing environment of accounting programs. The alignment of a unit’s mission and strategies with the expected outcomes signal that it is highly likely that the unit can achieve those outcomes. In the dynamic environment of higher education and accounting education, innovation and change are the norm rather than exception.</li>'
            . '<li>The unit’s mission, expected outcomes, and strategies clearly define the unit’s focus on educational activities, including the range of degree and non-degree programs offered and the students, organizations, and communities those programs serve. The unit aligns its teaching/learning models with its mission, expected outcomes, and strategies.</li>'
            . '<li>The unit’s mission, expected outcomes, and strategies clearly define the unit’s focus on quality intellectual contributions that advance the knowledge, practice, and teaching/pedagogy of accounting, business, and management.</li>'
            . '<li>The unit’s mission, expected outcomes, and strategies clearly define the unit’s focus on other applicable activities (e.g., civic engagement) and on the people, organizations, and/or communities they serve.</li>'
            . '<li>The mission, expected outcomes, and strategies are appropriate to accounting education and consonant with the mission of any institution and business school of which the accounting academic unit is a part. Accordingly, the unit’s mission, expected outcomes, and strategies address the level of education the unit is targeting; the positive and significant impact the unit makes on the accounting profession, business and society; the stakeholders to whom the unit is accountable; and the ways in which the unit advances accounting education.</li>'
            . '<li>The unit periodically reviews and revises the mission, expected outcomes, and strategies as appropriate and engages key stakeholders in the process.</li>'
            . '<li>The unit’s mission and expected outcomes are transparent to all stakeholders.</li>'
            . '<li>The unit systematically evaluates and documents its progress toward mission fulfillment. Past examples of continuous improvement and innovation are consistent with the mission, expected outcomes, and supporting strategies intended to support mission fulfillment.</li>'
            . '<li>The unit’s future actions for continuous improvement, its rationale for such actions, and its identification of potential areas of innovation are consistent with and demonstrate support for its mission, expected outcomes, and strategies. The unit has clearly defined its future strategies to maintain its resource needs, assign responsibilities to appropriate parties, and set time frames for the implementation of actions that support the mission. The school also has clearly defined how these actions promise to impact expected outcomes.</li>'
            . '<li>If the accounting academic unit’s mission, expected outcomes, and strategies include the preparation of graduates of any accounting degree program for professional certification examinations and/or license to practice in accordance with professional organizations that offer such certifications and/or with state, provincial, or national regulations or laws, these accounting graduates must demonstrate success on such certification exams at or above state, provincial, or national norms and among peer institutions.</li>'
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
        $property->set_description('Describe the mission, expected outcomes, and supporting strategies including how the mission is encapsulated in supporting statements (e.g., mission statement, vision statement, values statements) and how these statements are aligned.');
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
        $property->set_description('Describe how the mission influences decision making in the accounting academic unit, connects the actions of participants, and provides a common basis for achieving the mission and expected outcomes.');
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
        $property->set_description('Describe the appropriateness of the mission for the unit’s constituencies including students, employers, and other stakeholders; and discuss how the mission positively contributes to society, accounting and management education, and the success of graduates.');
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
        $property->set_description('Describe the mission of the accounting academic unit in relation to the mission of any larger organization of which it is a part.');
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
        $property->set_description('Describe how the mission, expected outcomes, and strategies clearly articulate the unit’s areas of focus in regards to educational activities, intellectual contributions, and other activities.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea5()
    {
        return $this->get_property('textarea5')->get_value();
    }

    public function set_textarea6($value)
    {
        $property = new \Orm_Property_Textarea('textarea6', $value);
        $property->set_description('Describe how teaching/learning models in degree programs are aligned and consistent with the mission, expected outcomes, and strategy of the unit.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea6()
    {
        return $this->get_property('textarea6')->get_value();
    }

    public function set_textarea7($value)
    {
        $property = new \Orm_Property_Textarea('textarea7', $value);
        $property->set_description('Describe processes for creating and revising the mission, determining expected outcomes, developing strategies, and establishing how the mission, outcomes, and strategies relate to each other.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea7()
    {
        return $this->get_property('textarea7')->get_value();
    }

    public function set_textarea8($value)
    {
        $property = new \Orm_Property_Textarea('textarea8', $value);
        $property->set_description('If applicable, summarize accounting graduates’ performance on professional certification/licensure examinations, and compare those results with those from peer institutions and against national norms.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea8()
    {
        return $this->get_property('textarea8')->get_value();
    }

    public function set_textarea9($value)
    {
        $property = new \Orm_Property_Textarea('textarea9', $value);
        $property->set_description('Summarize and document key continuous improvements successes, innovations, and achievements since the last AACSB accreditation review or for at least the past five years.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea9()
    {
        return $this->get_property('textarea9')->get_value();
    }

    public function set_textarea10($value)
    {
        $property = new \Orm_Property_Textarea('textarea10', $value);
        $property->set_description('Describe how past achievements are aligned with the mission, expected outcomes, and supporting strategies.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea10()
    {
        return $this->get_property('textarea10')->get_value();
    }

    public function set_textarea11($value)
    {
        $property = new \Orm_Property_Textarea('textarea11', $value);
        $property->set_description('Identify future plans for continuous improvement and potential opportunities for innovation; indicate how these plans are linked to mission, expected outcomes, and strategies; and outline the resources, responsible parties, and timeframe needed to implement these actions.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea11()
    {
        return $this->get_property('textarea11')->get_value();
    }

    public function set_textarea12($value)
    {
        $property = new \Orm_Property_Textarea('textarea12', $value);
        $property->set_description('Identify past and future experiments and/or entrepreneurial actions the accounting academic unit has pursued. For past efforts, identify outcomes the unit has achieved and provide assessments of the success to date.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea12()
    {
        return $this->get_property('textarea12')->get_value();
    }

}
