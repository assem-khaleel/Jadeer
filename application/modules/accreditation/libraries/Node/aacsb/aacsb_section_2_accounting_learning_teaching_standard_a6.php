<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb;

/**
 * Description of Aacsb_Section_2_Accounting_Learning_Teaching_Standard_A6
 *
 * @author laith
 */
class Aacsb_Section_2_Accounting_Learning_Teaching_Standard_A6 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard A6';
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
        $property = new \Orm_Property_Fixedtext('info', '<strong> Curriculum content is appropriate to professional expectations and requirements for each accounting degree program and the related learning goals. [ACCOUNTING PROGRAM CURRICULA CONTENT—NO RELATED BUSINESS STANDARD]</strong> <br/> <br/>'
            . '<strong>Definitions :</strong> <br/>'
            . '<ul type="circle">'
            . '<li>Curriculum content refers to theories, ideas, concepts, skills, etc., that make up an accounting degree program. Content is not the same as learning goals. Learning goals describe the knowledge and skills students should develop in a program and set expectations for what students are expected to do with the knowledge and skills after completing a program. Not all content areas need to be included as learning goals.</li>'
            . '<li>Accounting program curricula content stems from the roles that accountants assume in society as they develop, collect, analyze, interpret, report, communicate, and ensure the integrity of financial, managerial, and other information</li>'
            . '</ul>'
            . ' <br/> <br/><strong>Basis for Judgment</strong> <br/>'
            . '<ul type="circle">'
            . '<li>The resulting curricula for all accounting degree programs demonstrate an alignment with the mission, expected outcomes, and strategies of the accounting academic unit.</li>'
            . '<li>If the accounting curricula are intended to provide students with the educational foundation for professional certification and/or licensure as a professional accountant, the program articulates how it aligns with these expectations in appropriate jurisdictions.</li>'
            . '<li>Normally, curricula management processes result in curricula that address the broadly-defined skill and knowledge content areas described in Business Standard 9. In addition, subject to mission, expected outcomes, and degree program portfolio, accounting degree programs address more specific expectations related to the accounting discipline and profession as outlined below. Such expectations may be integrated within a single degree program (e.g., bachelor’s or master’s) or distributed across blended programs that offer integrated undergraduate and graduate experiences. The content areas listed below are not intended to be exhaustive of all the areas that an accounting curriculum should cover and are purposely general. The accounting academic unit should translate these guidelines into expected competencies consistent with the academic unit’s mission,students, degree program learning goals, expected outcomes, and supporting strategies.</li>'
            . '</ul>'
            . 'The accounting learning experiences that an accounting academic unit offers should address the following areas:'
            . '<ul>'
            . '<li>The roles accountants play in society to provide and ensure the integrity of financial, managerial, and other information.</li>'
            . '<li>The ethical and regulatory environment for accountants.</li>'
            . '<li>The critical thinking and analytical skills that support professional skepticism, assessment, and assurance of accounting information.</li>'
            . '<li>Business processes and analysis.</li>'
            . '<li>Internal controls and security.</li>'
            . '<li>Risk assessment and assurance for financial and non-financial information.</li>'
            . '<li>Recording, analysis, and interpretation of historical and prospective financial and non-financial information.</li>'
            . '<li>Project and engagement management.</li>'
            . '<li>The design of technology for accounting, as well as its application to financial and non-financial information.</li>'
            . '<li>Tax policy, strategy, and compliance for individuals and enterprises.</li>'
            . '<li>International accounting issues and practices, including roles and responsibilitiesplayed by accountants in a global context.</li>'
            . '</ul> '
            . '<br/> <br/>'
            . '<strong>Bachelor’s Degrees in Accounting</strong> <br/>'
            . 'Participation in a bachelor’s degree program in accounting presupposes the foundations necessary for a bachelor’s degree program in business, as described in Business Standard 9, and appropriate accounting content based on mission, expected outcomes, and strategies. <br/> <br/>'
            . '<strong>Master’s Degrees in Accounting</strong> (i.e., specialized master’s programs including Master of Accountancy, Masters of Science in Accountancy, Masters of Taxation, and MBA programs with accounting concentrations) <br/>'
            . 'Participation in a master’s degree program in accounting presupposes that students have built a foundation of knowledge and skills appropriate for advanced study in accounting prior to entering a master’s program in accounting or that they will build this foundation as part of the learning experiences in the master’s program. In addition, master’s degree programs in accounting focus on learning that includes: <br/>'
            . '<ul>'
            . '<li>More integrative, intensive learning than undergraduate education offers, including more advanced and in-depth learning in topics related to the accounting discipline and its context for business.</li>'
            . '<li>Expanded understanding of professional responsibilities of accountants including the ethical and professional standards of the accounting profession.</li>'
            . '<li>Understanding of the strategic role accounting plays in business organizations and society.</li>'
            . '<li>Advanced development of critical and analytical thinking skills in support of professional skepticism, as well as sound decision making and good judgment in uncertain circumstances.</li>'
            . '<li>Integration of knowledge across fields and understanding of the accounting discipline from multiple perspectives.</li>'
            . '<li>Approaches to framing problems and developing creative solutions to accounting issues. Advanced design of technology for accounting, as well as advanced knowledge of its application to financial and non-financial information.</li>'
            . '<li>Application of specialized knowledge of accounting and business in a global context. </li>'
            . '</ul><br/> <br/>'
            . '<strong>Research Master’s Degrees in Accounting</strong> <br/>'
            . 'A research master’s degree in accounting normally includes learning experiences in the following areas:'
            . '<ul>'
            . '<li>Understanding and interpreting high-quality accounting research and its impact.</li>'
            . '<li>Participating in the conduct of high-quality accounting research activities.</li>'
            . '</ul> <br/> <br/>'
            . '<strong>Doctoral Degrees in Accounting</strong> <br/>'
            . 'In addition to the general skill areas and learning experiences included in specialized master’s degree programs in accounting, doctoral degree programs in accounting normally include: <br/>'
            . '<ul>'
            . '<li>Advanced research skills for the areas of specialization that lead to an original and substantive accounting-related research project.</li>'
            . '<li>Development of a deep understanding of managerial and organizational contexts for areas of specialization in accounting.</li>'
            . '<li>Preparation for faculty responsibilities in higher education including but not limited to teaching.</li>'
            . '</ul>'
            . 'Doctoral degrees normally also include learning experiences appropriate to the type of research emphasized. Programs emphasizing advanced, foundational discipline-based research in accounting must instill in students a deep knowledge and understanding of the scholarly literature in the accounting field. Programs emphasizing rigorous research for application to practice in accounting must instill in students an understanding of the scholarly literature across the range of business and management disciplines, particularly in accounting, and prepare them for careers in which they will perform applied accounting research.');
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
        $property->set_description('Describe learning experiences appropriate to the areas listed in the basis for judgment, including how the areas are defined and how they fit into the accounting degree program curriculum.');
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
        $property->set_description('If a curriculum does not include learning experiences normally expected for the degree program type, explain why.');
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
        $property->set_description('Describe how the degree programs align with professional certification and/or licensure requirements if this is an expectation for graduates of the unit’s degree programs.');
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
        $property->set_description('If the degree programs are intended to provide foundational preparation for professional certifications and/or licensure requirements, provide data on the success of graduates in completing such requirements');
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
        $property->set_description('For master’s programs in accounting, document that a significant proportion of the academic requirements are in classes designed exclusively for graduate students.');
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
        $property->set_description('For doctoral programs, document that doctoral candidates have mastered the subject matter of the professional competency in the field they intend to research and teach.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea6()
    {
        return $this->get_property('textarea6')->get_value();
    }

}
