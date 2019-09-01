<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb;

/**
 * Description of Aacsb_Section_2_Accounting_Learning_Teaching_Standard_A5
 *
 * @author laith
 */
class Aacsb_Section_2_Accounting_Learning_Teaching_Standard_A5 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard A5';
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
            $this->set_textarea3('');
            $this->set_textarea4('');
            $this->set_textarea5('');
            $this->set_textarea6('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>The accounting academic unit uses well-documented, systematic processes for determining and revising degree program learning goals; designing, delivering, and improving degree program curricula to achieve learning goals; and demonstrating that degree program learning goals have been met. [ACCOUNTING CURRICULA MANAGEMENT AND ASSURANCE OF LEARNING—RELATED BUSINESS STANDARD 8]</strong> <br/> <br/>'
            . '<strong>Definitions</strong> <br/>'
            . '<ul type="circle">'
            . '<li>Learning goals state the educational expectations for each degree program. They specify the intellectual and behavioral competencies a program is intended to instill. In defining these goals, the faculty members clarify how they intend for graduates to be competent and effective as a result of completing the program.</li>'
            . '<li>A curriculum maps out how the unit facilitates achievement of program learning goals. It is defined by content (theories, concepts, skills, etc.), pedagogies (teaching methods, delivery modes), and structures (organization and sequence of content to create a systematic, integrated program of teaching and learning). A curriculum is also influenced by the mission, values, and culture of the unit.</li>'
            . '<li>Assurance of learningrefers to processes for demonstrating that students achieve learning expectations for the programs in which they participate. Accounting academic units use assurance of learning to demonstrate accountability and assure external constituents such as potential students, trustees, public officials, supporters, and accrediting organizations, that the unit meets its goals. Assurance of learning also assists the academic unit and faculty members to improve programs and courses. By measuring learning the school can evaluate its students’ success at achieving learning goals, use the measures to plan improvement efforts, and (depending on the type of measures) provide feedback and guidance for individual students. For assurance of learning purposes, AACSB accounting accreditation is concerned with broad learning goals for each degree program, rather than detailed learning goals by course or topic, which must be the responsibility of individual faculty members.</li>'
            . '<li>Curricula management refers to the academic unit’s processes and organization for development, design, and implementation of each degree program’s structure, organization. content, assessment of outcomes, pedagogy, etc. Curricula management captures input from key business school and accounting academic unit stakeholders and is influenced by assurance of learning results, new developments in business practices and issues, revision of mission and strategy that relate to new areas of instruction, etc.</li>'
            . '</ul>'
            . ' <br/> <br/><strong>Basis for Judgment</strong> <br/>'
            . '<ul type="circle">'
            . '<li>Learning goals derive from and are consonant with the academic unit’s mission, expected outcomes, and strategies. Curricula management processes are guided by the unit’s mission, expected outcomes, and strategies. Curricula management processes align curricula for all programs with the academic unit’s mission, expected outcomes, and strategies.</li>'
            . '<li>Learning goals and curricula reflect currency of knowledge. Appropriately qualified faculty members are involved in all aspects of curricula management, including the determination of learning goals and the design and ongoing revision of degree program content, pedagogies, and structure to achieve learning goals. The peer review team expects to see evidence of curricula improvement based on new knowledge.</li>'
            . '<li>Depending on the teaching/learning models and the division of labor, curricula management facilitates faculty-faculty and faculty-staff interactions and engagement to support development and management of both curricula and the learning process.</li>'
            . '<li>Learning goals and curricula reflect expectations of stakeholders. The academic unit incorporates perspectives from stakeholders, including organizations employing graduates, alumni, students, the university community, policy makers, etc., into curriculum management processes.</li>'
            . '<li>Learning goals are achieved. Systematic processes support assurance of learning and produce a portfolio of evidence demonstrating achievement of learning goals. These processes also produce a portfolio of documented improvements based on collected evidence. The unit provides a portfolio of evidence for each accounting degree program to demonstrate that students meet the learning goals. Or, if assessment demonstrates that students are not meeting the learning goals, the accounting academic unit has instituted efforts to eliminate the discrepancy.</li>'
            . '<li>Evidence of recent curricula development, review, or revision demonstrates the effectiveness of curricula/program management.</li>'
            . '<li>The assurance of learning strategies of the accounting academic unit may rely on major components of the business school assurance learning strategies as long as accounting student outcomes are identifiable. However, direct assessments of student outcomes relative to learning goals in the field of accounting must be part of the unit’s curricula management process.</li>'
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
        $property->set_description('Describe processes for determining and revising learning goals, curricula management, and assurance of learning. Discuss mission, faculty, and stakeholder involvement in these processes.');
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
        $property->set_description('Show how curricula management processes have produced new or revised curricula for degree programs, describing the source of information that supports the new or revised program development.');
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
        $property->set_description('Discuss and provide evidence of faculty-to-faculty and faculty-to-staff interaction in curricula management processes.');
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
        $property->set_description('List the learning goals for each accounting degree program—this list should include both conceptual and operational definitions.');
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
        $property->set_description('Provide a portfolio of evidence, including direct assessment of student learning, that shows that students meet all of the learning goals for each accounting degree program. Or, if assessment demonstrates that students are not meeting the learning goals, describe efforts that the unit has instituted to eliminate the discrepancy. Indirect assessments may be used as part of the portfolio of evidence to provide contextual information for direct assessment or information for continuous improvement.');
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
        $property->set_description('If the accounting academic unit is subject to formalized regulations or quality assessment processes focused on the evaluation of student performance, and these processes are consistent with AACSB expectations and best practices, they may be applied to demonstrate assurance of learning. The burden of proof is on the accounting academic unit to document that these systems support effective continuous improvement in student performance and outcomes');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea6()
    {
        return $this->get_property('textarea6')->get_value();
    }

}
