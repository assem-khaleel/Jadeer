<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb_business;

/**
 * Description of aacsb_business_section_2_standard_9
 *
 * @author ahmadgx
 */
class Aacsb_Business_Section_2_Standard_9 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 9';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_standard_name('');
            $this->set_definition('');
            $this->set_learning_experiences('');
            $this->set_curriculum('');
    }

    public function set_standard_name()
    {
        $property = new \Orm_Property_Fixedtext('standard_name', "<b>Curriculum content is appropriate to general expectations for the degree program type and learning goals. [CURRICULUM CONTENT]</b>");
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
            . '<li>Curriculum content refers to theories, ideas, concepts, skills, knowledge, etc., that make up a degree program. Content is not the same as learning goals. Learning goals describe the knowledge and skills students should develop in a program and set expectations for what students should do with the knowledge and skills after completing a program. Not all content areas need to be included as learning goals.</li>'
            . '</ul>'
            . '<br/> <br/><strong>Basis for Judgment</strong>'
            . '<ul>'
            . '<li>Contents of degree program curricula that result from effective curricula management processes normally include generally accepted sets of learning experiences to prepare graduates for business and management careers.</li>'
            . '<li>Normally, curricula management processes result in curricula that address the broadly-defined skill and knowledge content areas described by the program types listed below. The lists are not intended to be exhaustive of all the areas that a curriculum should cover; in fact, the lists below are purposely general. It is up to schools to translate these general areas into expected competencies consistent with the degree program learning goals, students served, etc.</li>'
            . '</ul>'
            . '<br/> <br/><strong>Bachelor’s Degree Programs and Higher</strong>'
            . '<br/> All general management and specialist degree programs at the bachelor’s, master’s, and doctoral level would normally include learning experiences that address the following general skill areas and general business and management skill areas (higher level of mastery for master’s and doctoral programs is expected):'
            . '<br/> <br/><strong>General Skill Areas</strong>'
            . '<ul>'
            . '<li>Written and oral communication (able to communicate effectively orally and in writing)</li>'
            . '<li>Ethical understanding and reasoning (able to identify ethical issues and address the issues in a socially responsible manner)</li>'
            . '<li>Analytical thinking (able to analyze and frame problems)</li>'
            . '<li>Information technology (able to use current technologies in business and management contexts)</li>'
            . '<li>Interpersonal relations and teamwork (able to work effectively with others and in team environments)</li>'
            . '<li>Diverse and multicultural work environments (able to work effectively in diverse environments)</li>'
            . '<li>Reflective thinking (able to understand oneself in the context of society)</li>'
            . '<li>Application of knowledge (able to translate knowledge of business and management into practice)</li>'
            . '</ul>'
            . '<br/> <br/><strong>General Business and Management Knowledge Areas</strong>'
            . '<ul>'
            . '<li>Economic, political, regulatory, legal, technological, and social contexts of organizations in a global society</li>'
            . '<li>Social responsibility, including sustainability, and ethical behavior and approaches to management</li>'
            . '<li>Financial theories, analysis, reporting, and markets</li>'
            . '<li>Systems and processes in organizations, including planning and design, production/operations, supply chains, marketing, and distribution</li>'
            . '<li>Group and individual behaviors in organizations and society</li>'
            . '<li>Information technology and statistics/quantitative methods impacts on business practices to include data creation, data sharing, data analytics, data mining, data reporting, and storage between and across organizations including related ethical issues</li>'
            . '<li>Other specified areas of study related to concentrations, majors, or emphasis areas</li>'
            . '</ul>'
            . '<br/> <br/><strong>General Business Master’s Degree Programs</strong>'
            . '<br/> <br/>In addition to the general skill and knowledge areas, general business master’s degree programs would normally include learning experiences in the following areas:'
            . '<br/><ul>'
            . '<li>Leading in organizational situations</li>'
            . '<li>Managing in a global context</li>'
            . '<li>Thinking creatively</li>'
            . '<li>Making sound decisions and exercising good judgment under uncertainty</li>'
            . '<li>Integrating knowledge across fields</li>'
            . '</ul> <br/>'
            . '<strong>Specialized Business Master’s Degree Programs</strong>'
            . '<br/> <br/>In addition to the general skill areas, specialized business master’s degree programs would normally include learning experiences in the following areas:'
            . '<br/><ul>'
            . '<li>Understanding the specified discipline from multiple perspectives</li>'
            . '<li>Framing problems and developing creative solutions in the specialized discipline</li>'
            . '<li>Applying specialized knowledge in a global context (for practice-oriented degrees) or</li>'
            . '<li>Conducting high-quality research (for research-oriented degrees)</li>'
            . '</ul>'
            . '<br/> <br/><strong>Doctorate Degree Programs</strong>'
            . '<br/>In addition to the general skill and knowledge areas and additional learning experiences for specialized master’s degrees, doctoral degree programs normally would include:'
            . '<ul>'
            . '<li>Advanced research skills for the areas of specialization leading to an original substantive research project</li>'
            . '<li>Understanding of managerial and organizational contexts for areas of specialization</li>'
            . '<li>Preparation for faculty responsibilities in higher education, including but not limited to teaching,</li></ul>'
            . '<br/>Doctoral degrees normally would also include learning experiences appropriate to the type of research emphasized, as follows:'
            . '<br/> <br/>Programs emphasizing advanced foundational discipline-based research in an area of specialization:'
            . '<ul><li>Deep knowledge of scholarly literature in areas of specialization</li>'
            . '</ul>'
            . '<br/> <br/>Programs emphasizing rigorous research for application to practice in a specified discipline:'
            . '<ul>'
            . '<li>Understanding the scholarly literature across a range of business and management disciplines</li>'
            . '<li>Preparation for careers applying research to practice</li>'
            . '</ul>'
            . '<br/><br/><strong>Guidance for Documentation</strong>');
        $this->set_property($property);
    }

    public function get_definition()
    {
        return $this->get_property('definition')->get_value();
    }

    public function set_learning_experiences($value)
    {
        $property = new \Orm_Property_Textarea('learning_experiences', $value);
        $property->set_description('Describe learning experiences appropriate to the areas listed in the basis for judgment, including how the areas are defined and fit into the curriculum.');
        $this->set_property($property);
    }

    public function get_learning_experiences()
    {
        return $this->get_property('learning_experiences')->get_value();
    }

    public function set_curriculum($value)
    {
        $property = new \Orm_Property_Textarea('curriculum', $value);
        $property->set_description('If a curriculum does not include learning experiences normally expected for the degree program type, explain why.');
        $this->set_property($property);
    }

    public function get_curriculum()
    {
        return $this->get_property('curriculum')->get_value();
    }

}
