<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb_business;

/**
 * Description of aacsb_business_section_2_standard_1
 *
 * @author ahmadgx
 */
class Aacsb_Business_Section_2_Standard_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 1';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_standard_name('');
            $this->set_definition('');
            $this->set_mission_and_outcomes('');
            $this->set_mission_influences('');
            $this->set_school_mission('');
            $this->set_school_mission_relation('');
            $this->set_expected_outcomes('');
            $this->set_teaching_models('');
            $this->set_mission_creating('');
            $this->set_key_document('');
            $this->set_achievements('');
            $this->set_future_plans('');
    }

    public function set_standard_name()
    {
        $property = new \Orm_Property_Fixedtext('standard_name', '<b>The school articulates a clear and distinctive mission, the expected outcomes this mission implies, and strategies outlining how these outcomes will be achieved. The school has a history of achievement and improvement and specifies future actions for continuous improvement and innovation consistent with this mission, expected outcomes, and strategies. [MISSION, IMPACT, AND INNOVATION]</b>');
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
            . '<li>Mission is a single statement or set of statements serving as a guide for the school and its stakeholders. These statements capture the school’s core purposes, express its aspirations, and describe its distinguishing features. The mission is not usually described entirely by the mission statement. It is more completely encapsulated in a set of statements that describe the school, including the mission statement, vision statement, and statements of values.</li>'
            . '<li>The term distinctive refers to goals, characteristics, priorities, focus areas, or approaches of the school that are special or notable. These should be revealed by the mission of the school and evident in the expected outcomes and strategies. Distinctiveness does not imply that the school is different from all others.</li>'
            . '<li>Expected outcomes are conveyed as broad or high-level statements describing impacts the school expects to achieve in the business and academic communities it serves as it pursues its mission through educational activities, scholarship, and other endeavors. Expected outcomes translate the mission into overarching goals against which the school evaluates its success.</li>'
            . '<li>Strategies describe, in general, how the school intends to achieve its mission and expected outcomes, including how it finances activities to achieve its mission. Strategies are general, or overarching, statements of direction derived from the strategic management processes of the school.</li>'
            . '</ul><br/><br/>'
            . '<strong>Basis for Judgment</strong> <br/>'
            . '<ul>'
            . '<li>The mission guides decision making and identifies distinguishing characteristics, attributes, focus areas, priorities, etc., that indicate how the school positions itself among the international community of business schools. Distinctiveness does not imply that the business school must somehow be different from all other AACSB-accredited business schools. Rather, through the mission, expected outcomes, and strategies, the school clearly articulates those attributes that describe the school to its various constituencies and across the global community of business schools.</li>'
            . '<li>The business school’s mission, expected outcomes, and strategies are mutually consistent and reflect a realistic assessment of the changing environment of business schools. The alignment of a school’s mission and strategies with its expected outcomes signal that it is highly likely that the school can achieve those outcomes. In the dynamic environment of higher education and business schools, innovation and change are the norm rather than the exception.</li>'
            . '<li>The school’s mission, expected outcomes, and strategies clearly define the school’s focus on educational activities, including the range of degree and non-degree programs offered and the students, organizations, and communities those programs are intended to serve. The unit aligns its teaching/learning models with its mission, expected outcomes, and strategies.</li>'
            . '<li>The school’s mission, expected outcomes, and strategies clearly define the school’s focus on quality intellectual contributions that advance the knowledge, practice, and teaching/pedagogy of business and management.</li>'
            . '<li>The school’s mission, expected outcomes, and strategies clearly define the school’s focus on other applicable activities (e.g., civic engagement) and on the people, organizations, and/or communities they intend to serve.</li>'
            . '<li>The mission, expected outcomes, and strategies are appropriate to a collegiate school of business and consonant with the mission of any institution of which the school is a part. Accordingly, the mission, expected outcomes, and strategies address the level of education the school is targeting; the positive and significant impact the school intends to make on business and society; the stakeholders to whom the school is accountable; and the ways in which the school intends to advance the management education industry.</li>'
            . '<li>The school periodically reviews and revises the mission, expected outcomes, and strategies as appropriate and engages key stakeholders in the process.</li>'
            . '<li>The school’s mission and expected outcomes are transparent to all stakeholders.</li>'
            . '<li>The school systematically evaluates and documents its progress toward mission fulfillment. Past examples of continuous improvement and innovation are consistent with the mission, expected outcomes, and supporting strategies intended to support future mission fulfillment.</li>'
            . '<li>The school’s future actions for continuous improvement, its rationale for such actions, and its identification of potential areas of innovation are consistent with and demonstrate support for its mission, expected outcomes, and strategies.</li>'
            . '<li>The school has clearly defined its future strategies to maintain its resource needs, assign responsibilities to appropriate parties, and set time frames for the implementation of actions that support the mission. The school also has clearly defined how these actions promise to impact expected outcomes.</li>'
            . '</ul><br/><br/>'
            . '<strong>Guidance for Documentation</strong>');
        $this->set_property($property);
    }

    public function get_definition()
    {
        return $this->get_property('definition')->get_value();
    }

    public function set_mission_and_outcomes($value)
    {
        $property = new \Orm_Property_Textarea('mission_and_outcomes', $value);
        $property->set_description('Describe the mission, expected outcomes, and supporting strategies, including how the mission is encapsulated in supporting statements (e.g., mission statement, vision statement, values statements, and strategic plan) and how these statements are aligned.');
        $this->set_property($property);
    }

    public function get_mission_and_outcomes()
    {
        return $this->get_property('mission_and_outcomes')->get_value();
    }

    public function set_mission_influences($value)
    {
        $property = new \Orm_Property_Textarea('mission_influences', $value);
        $property->set_description('Describe how the mission influences decision making in the school, connects the actions of participants, and provides a common basis for achieving the mission and expected outcomes.');
        $this->set_property($property);
    }

    public function get_mission_influences()
    {
        return $this->get_property('mission_influences')->get_value();
    }

    public function set_school_mission($value)
    {
        $property = new \Orm_Property_Textarea('school_mission', $value);
        $property->set_description('Describe the appropriateness of the mission for the school’s constituencies, including students, employers, and other stakeholders; and discuss how the mission positively contributes to society, management education, and the success of graduates.');
        $this->set_property($property);
    }

    public function get_school_mission()
    {
        return $this->get_property('school_mission')->get_value();
    }

    public function set_school_mission_relation($value)
    {
        $property = new \Orm_Property_Textarea('school_mission_relation', $value);
        $property->set_description('Describe the mission of the school in relation to the mission of any larger organization of which it is a part.');
        $this->set_property($property);
    }

    public function get_school_mission_relation()
    {
        return $this->get_property('school_mission_relation')->get_value();
    }

    public function set_expected_outcomes($value)
    {
        $property = new \Orm_Property_Textarea('expected_outcomes', $value);
        $property->set_description('Describe how the mission, expected outcomes, and strategies clearly articulate the school’s areas of focus in regards to educational activities, intellectual contributions, and other activities.');
        $this->set_property($property);
    }

    public function get_expected_outcomes()
    {
        return $this->get_property('expected_outcomes')->get_value();
    }

    public function set_teaching_models($value)
    {
        $property = new \Orm_Property_Textarea('teaching_models', $value);
        $property->set_description('Describe how teaching/learning models in degree programs are aligned and consistent with the mission, expected outcomes, and strategy of the school.');
        $this->set_property($property);
    }

    public function get_teaching_models()
    {
        return $this->get_property('teaching_models')->get_value();
    }

    public function set_mission_creating($value)
    {
        $property = new \Orm_Property_Textarea('mission_creating', $value);
        $property->set_description('Describe processes for creating and revising the mission, determining expected outcomes, developing strategies, and establishing how these strategies relate to each other.');
        $this->set_property($property);
    }

    public function get_mission_creating()
    {
        return $this->get_property('mission_creating')->get_value();
    }

    public function set_key_document($value)
    {
        $property = new \Orm_Property_Textarea('key_document', $value);
        $property->set_description('Summarize and document key continuous improvement successes, innovations, and achievements since the last AACSB accreditation review or for at least the past five years.');
        $this->set_property($property);
    }

    public function get_key_document()
    {
        return $this->get_property('key_document')->get_value();
    }

    public function set_achievements($value)
    {
        $property = new \Orm_Property_Textarea('achievements', $value);
        $property->set_description('Describe how past achievements are aligned with the mission, expected outcomes, and supporting strategies.');
        $this->set_property($property);
    }

    public function get_achievements()
    {
        return $this->get_property('achievements')->get_value();
    }

    public function set_future_plans($value)
    {
        $property = new \Orm_Property_Textarea('future_plans', $value);
        $property->set_description('Identify future plans for continuous improvement and potential opportunities for innovation; indicate how they are linked to mission, expected outcomes, and strategies; and outline the resources, responsible parties, and time frame needed to implement the action.');
        $this->set_property($property);
    }

    public function get_future_plans()
    {
        return $this->get_property('future_plans')->get_value();
    }

}
