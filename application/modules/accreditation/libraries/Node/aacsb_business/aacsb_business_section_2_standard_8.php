<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb_business;

/**
 * Description of aacsb_business_section_2_standard_8
 *
 * @author ahmadgx
 */
class Aacsb_Business_Section_2_Standard_8 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 8';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_standard_name('');
            $this->set_definition('');
            $this->set_revising_learning_goals('');
            $this->set_curricula_management('');
            $this->set_faculty_evidence('');
            $this->set_business_degree('');
            $this->set_assessment('');
            $this->set_formalized_regulation('');
    }

    public function set_standard_name()
    {
        $property = new \Orm_Property_Fixedtext('standard_name', "<b>The school uses well-documented, systematic processes for determining and revising degree program learning goals; designing, delivering, and improving degree program curricula to achieve learning goals; and demonstrating that degree program learning goals have been met. [CURRICULA MANAGEMENT AND ASSURANCE OF LEARNING]</b>");
        $this->set_property($property);
    }

    public function get_standard_name()
    {
        return $this->get_property('standard_name')->get_value();
    }

    public function set_definition()
    {
        $property = new \Orm_Property_Fixedtext('definition', '<strong>Definitions</strong>'
            . '<ul>'
            . '<li>Learning goals state the educational expectations for each degree program. They specify the intellectual and behavioral competencies a program is intended to instill. In defining these goals, the faculty members clarify how they intend for graduates to be competent and effective as a result of completing the program.</li>'
            . '<li>A curriculum maps out how the school facilitates achievement of program learning goals. It is defined by content (theories, concepts, skills, etc.), pedagogies (teaching methods, delivery modes), and structures (how the content is organized and sequenced to create a systematic, integrated program of teaching and learning). A curriculum is also influenced by the mission, values, and culture of the school.</li>'
            . '<li>Assurance of learning refers to processes for demonstrating that students achieve learning expectations for the programs in which they participate. Schools use assurance of learning to demonstrate accountability and assure external constituents such as potential students, trustees, public officials, supporters, and accrediting organizations that the school meets its goals. Assurance of learning also assists the school and faculty members to improve programs and courses. By measuring learning, the school can evaluate its students’ success at achieving learning goals, use the measures to plan improvement efforts, and (depending on the type of measures) provide feedback and guidance for individual students. For assurance of learning purposes, AACSB accreditation is concerned with broad, program-level focused learning goals for each degree program, rather than detailed learning goals by course or topic, which must be the responsibility of individual faculty members.</li>'
            . '<li>Curricula management refers to the school’s processes and organization for development, design, and implementation of each degree program’s structure, organization, content, assessment of outcomes, pedagogy, etc. Curricula management captures input from key business school stakeholders and is influenced by assurance of learning results, new developments in business practices and issues, revision of mission and strategy that relate to new areas of instruction, etc.</li>'
            . '</ul><br/><br/>'
            . '<strong>Basis for Judgment</strong> <br/>'
            . '<ul>'
            . '<li>Learning goals derive from and are consonant with the schools mission, expected outcomes, and strategies. Curricula management processes are guided by the school’s mission, expected outcomes, and strategies. Curricula management processes align curricula for all programs with the school’s mission, expected outcomes, and strategies.</li>'
            . '<li>Learning goals and curricula reflect currency of knowledge. Appropriately qualified faculty members are involved in all aspects of curricula management, including the determination of learning goals and the design and ongoing revision of degree program content, pedagogies, and structure to achieve learning goals. The peer review team expects to see evidence of curricula improvement based on new knowledge.</li>'
            . '<li>Depending on the teaching/learning models and the division of labor, curricula management facilitates faculty-faculty and faculty-staff interactions and engagement to support development and management of both curricula and the learning process.</li>'
            . '<li>Learning goals and curricula reflect expectations of stakeholders. Schools incorporate perspectives from stakeholders, including organizations employing graduates, alumni, students, the university community, policy makers, etc., into curricula management processes.</li>'
            . '<li>Learning goals are achieved. Systematic processes support assurance of learning and produce a portfolio of evidence demonstrating achievement of learning goals. These processes also produce a portfolio of documented improvements based on collected evidence. The school provides a portfolio of evidence for each business degree program to demonstrate that students meet the learning goals. Or, if assessment demonstrates that students are not meeting the learning goals, the school has instituted efforts to eliminate the discrepancy.</li>'
            . '<li>Evidence of recent curricula development, review, or revision demonstrates the effectiveness of curricula/program management.</li>'
            . '</ul><br/><br/>'
            . ' <br/><strong>Guidance for Documentation</strong>');
        $this->set_property($property);
    }

    public function get_definition()
    {
        return $this->get_property('definition')->get_value();
    }

    public function set_revising_learning_goals($value)
    {
        $property = new \Orm_Property_Textarea('revising_learning_goals', $value);
        $property->set_description('Describe processes for determining and revising learning goals, curricula management, and assurance of learning. Discuss mission, faculty, and stakeholder involvement in these processes');
        $this->set_property($property);
    }

    public function get_revising_learning_goals()
    {
        return $this->get_property('revising_learning_goals')->get_value();
    }

    public function set_curricula_management($value)
    {
        $property = new \Orm_Property_Textarea('curricula_management', $value);
        $property->set_description('Show how curricula management processes have produced new or revised curricula for degree programs, describing the source of information that supports the new or revised program development.');
        $this->set_property($property);
    }

    public function get_curricula_management()
    {
        return $this->get_property('curricula_management')->get_value();
    }

    public function set_faculty_evidence($value)
    {
        $property = new \Orm_Property_Textarea('faculty_evidence', $value);
        $property->set_description('Discuss and provide evidence of faculty-faculty and faculty-staff interaction in curricula management processes.');
        $this->set_property($property);
    }

    public function get_faculty_evidence()
    {
        return $this->get_property('faculty_evidence')->get_value();
    }

    public function set_business_degree($value)
    {
        $property = new \Orm_Property_Textarea('business_degree', $value);
        $property->set_description('List the learning goals for each business degree program—this list should include both conceptual and operational definitions.');
        $this->set_property($property);
    }

    public function get_business_degree()
    {
        return $this->get_property('business_degree')->get_value();
    }

    public function set_assessment($value)
    {
        $property = new \Orm_Property_Textarea('assessment', $value);
        $property->set_description('Provide a portfolio of evidence, including direct assessment of student learning, that shows that students meet all of the learning goals for each business degree program. Or, if assessment demonstrates that students are not meeting learning goals, describe efforts that the unit has instituted to eliminate the discrepancy. Indirect assessments may be used as part of the portfolio of evidence to provide contextual information for direct assessment or information for continuous improvement.');
        $this->set_property($property);
    }

    public function get_assessment()
    {
        return $this->get_property('assessment')->get_value();
    }

    public function set_formalized_regulation($value)
    {
        $property = new \Orm_Property_Textarea('formalized_regulation', $value);
        $property->set_description('If the business school is subject to formalized regulations or quality assessment processes focused on the evaluation of student performance, and these processes are consistent with AACSB expectations and best practices, they may be applied to demonstrate assurance of learning. The burden of proof is on the school to document that these systems support effective continuous improvement in student performance and outcomes.');
        $this->set_property($property);
    }

    public function get_formalized_regulation()
    {
        return $this->get_property('formalized_regulation')->get_value();
    }

}
