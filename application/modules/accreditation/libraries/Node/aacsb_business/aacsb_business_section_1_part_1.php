<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb_business;

/**
 * Description of aacsb_business_section_1_part_1
 *
 * @author ahmadgx
 */
class Aacsb_Business_Section_1_Part_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Part 1: Core Values and Guiding Principles';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_introduction('');
            /* Part A */
            $this->set_criteria_a('');
            $this->set_policies_and_procedure('');
            $this->set_educate('');
            $this->set_detecting_and_addressing('');
            /* Part B */
            $this->set_criteria_b('');
            $this->set_programs_degree('');
            $this->set_environment('');
            $this->set_governance_process('');
            $this->set_documents('');
            /* Part C */
            $this->set_criteria_c('');
            $this->set_school_support('');
            $this->set_school_values('');
            $this->set_school_service('');
            $this->set_high_quality_education('');
            $this->set_school_addresses('');
    }

    public function set_introduction()
    {
        $property = new \Orm_Property_Fixedtext('introduction', 'The following three criteria represent core values of AACSB. There is no uniform measure for deciding whether each criterion has been met. Rather, the school must demonstrate that it has an ongoing commitment to pursue the spirit and intent of each criterion consistent with its mission and context.');
        $this->set_property($property);
    }

    public function get_introduction()
    {
        return $this->get_property('introduction')->get_value();
    }

    public function set_criteria_a()
    {
        $property = new \Orm_Property_Fixedtext('criteria_a', '<strong>A. The school must encourage and support ethical behavior by students, faculty, administrators, and professional staff. [ETHICAL BEHAVIOR]'
            . ' <br/> <br/> Basis for Judgment</strong> <br/>'
            . '<ul>'
            . '<li>The school has appropriate systems, policies, and procedures that reflect the school’s support for and importance of ethical behavior for students, faculty, administrators, and professional staff in their professional and personal actions.</li>'
            . '<li>The systems, policies, and procedures must provide appropriate mechanisms for addressing breaches of ethical behavior.</li>'
            . '<li>This criterion relates to the general procedures of a school. In no instance will AACSB become involved in the adjudication or review of individual cases of alleged misconduct, whether by administrators, faculty, professional staff, students, or the school.</li>'
            . '</ul> <br/> <br/>'
            . '<strong>Guidance for Documentation</strong>');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_criteria_a()
    {
        return $this->get_property('criteria_a')->get_value();
    }

    public function set_policies_and_procedure($value)
    {
        $property = new \Orm_Property_Textarea('policies_and_procedure', $value);
        $property->set_description('Provide published policies and procedures to support legal and ethical behaviors.');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_policies_and_procedure()
    {
        return $this->get_property('policies_and_procedure')->get_value();
    }

    public function set_educate($value)
    {
        $property = new \Orm_Property_Textarea('educate', $value);
        $property->set_description('Describe programs to educate participants about ethical policies and procedures.');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_educate()
    {
        return $this->get_property('educate')->get_value();
    }

    public function set_detecting_and_addressing($value)
    {
        $property = new \Orm_Property_Textarea('detecting_and_addressing', $value);
        $property->set_description('Describe systems for detecting and addressing breaches of ethical behaviors, such as honor codes and disciplinary systems to manage inappropriate behavior.');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_detecting_and_addressing()
    {
        return $this->get_property('detecting_and_addressing')->get_value();
    }

    public function set_criteria_b()
    {
        $property = new \Orm_Property_Fixedtext('criteria_b', '<strong>B. The school maintains a collegiate environment in which students, faculty, administrators, professional staff, and practitioners interact and collaborate in support of learning, scholarship, and community engagement. [COLLEGIATE ENVIRONMENT] <br/> <br/>'
            . 'Basis for Judgment</strong> <br/>'
            . '<ul>'
            . '<li>Collegiate environments are characterized by scholarship, scholarly approaches to business and management, and a focus on advanced learning. Schools must provide scholarly education at a level consistent with higher education in management.</li>'
            . '<li>In collegiate environments, students, faculty, administrators, professional staff, and practitioners interact as a community. Schools must provide an environment supporting interaction and engagement among students, administrators, faculty, and practitioners.</li>'
            . '<li>Collegiate environments are characterized by faculty involvement in governance and university service. Schools must have governance processes that include faculty input and engagement.</li>'
            . '</ul> <br/> <br/>'
            . '<strong>Guidance for Documentation</strong>');
        $property->set_group('section_2');
        $this->set_property($property);
    }

    public function get_criteria_b()
    {
        return $this->get_property('criteria_b')->get_value();
    }

    public function set_programs_degree($value)
    {
        $property = new \Orm_Property_Textarea('programs_degree', $value);
        $property->set_description('Provide an overview of the degree programs offered and evidence that the quality of these programs is at a level consistent with higher education in management.');
        $property->set_group('section_2');
        $this->set_property($property);
    }

    public function get_programs_degree()
    {
        return $this->get_property('programs_degree')->get_value();
    }

    public function set_environment($value)
    {
        $property = new \Orm_Property_Textarea('environment', $value);
        $property->set_description('Describe the environment in which students, faculty, administrators, professional staff, and practitioners interact; provide examples of activities that demonstrate the ways they interact; and show how the school supports such interactions.');
        $property->set_group('section_2');
        $this->set_property($property);
    }

    public function get_environment()
    {
        return $this->get_property('environment')->get_value();
    }

    public function set_governance_process($value)
    {
        $property = new \Orm_Property_Textarea('governance_process', $value);
        $property->set_description('Discuss the governance process, indicating how faculty are engaged or how faculty otherwise inform decisions.');
        $property->set_group('section_2');
        $this->set_property($property);
    }

    public function get_governance_process()
    {
        return $this->get_property('governance_process')->get_value();
    }

    public function set_documents($value)
    {
        $property = new \Orm_Property_Textarea('documents', $value);
        $property->set_description('Provide documents that characterize the culture and environment of the school, including statement of values, faculty and student handbooks, etc.');
        $property->set_group('section_2');
        $this->set_property($property);
    }

    public function get_documents()
    {
        return $this->get_property('documents')->get_value();
    }

    public function set_criteria_c()
    {
        $property = new \Orm_Property_Fixedtext('criteria_c', '<strong>C. The school must demonstrate a commitment to address, engage, and respond to current and emerging corporate social responsibility issues (e.g., diversity, sustainable development, environmental sustainability, and globalization of economic activity across cultures) through its policies, procedures, curricula, research, and/or outreach activities. [COMMITMENT TO CORPORATE AND SOCIAL RESPONSIBILITY] <br/> <br/>'
            . 'Basis for Judgment</strong> <br/>'
            . '<ul>'
            . '<li>Diversity in people and ideas enhances the educational experience in every management education program. At the same time, diversity is a culturally embedded concept rooted in historical and cultural traditions, legislative and regulatory concepts, economic conditions, ethnicity, gender, socioeconomic conditions, and experiences.</li>'
            . '<li>Diversity, sustainable development, environmental sustainability, and other emerging corporate and social responsibility issues are important and require responses from business schools and business students.</li>'
            . '<li>The school fosters sensitivity to, as well as awareness and understanding of, diverse viewpoints among participants related to current and emerging corporate social responsibility issues.</li>'
            . '<li>The school fosters sensitivity toward and greater understanding of cultural differences and global perspectives. Graduates should be prepared to pursue business or management careers in a global context. Students should be exposed to cultural practices different than their own.</li>'
            . '</ul><br/><br/>'
            . '<strong>Guidance for Documentation</strong>');
        $property->set_group('section_3');
        $this->set_property($property);
    }

    public function get_criteria_c()
    {
        return $this->get_property('criteria_c')->get_value();
    }

    public function set_school_support($value)
    {
        $property = new \Orm_Property_Textarea('school_support', $value);
        $property->set_description('Describe how the school defines and supports the concept of diversity in ways appropriate to its culture, historical traditions, and legal and regulatory environment. Demonstrate that the school fosters sensitivity and flexibility toward cultural differences and global perspectives.');
        $property->set_group('section_3');
        $this->set_property($property);
    }

    public function get_school_support()
    {
        return $this->get_property('school_support')->get_value();
    }

    public function set_school_values($value)
    {
        $property = new \Orm_Property_Textarea('school_values', $value);
        $property->set_description('Demonstrate that the school values a rich variety of viewpoints in its learning community by seeking and supporting diversity among its students and faculty in alignment with its mission.');
        $property->set_group('section_3');
        $this->set_property($property);
    }

    public function get_school_values()
    {
        return $this->get_property('school_values')->get_value();
    }

    public function set_school_service($value)
    {
        $property = new \Orm_Property_Textarea('school_service', $value);
        $property->set_description("Define the populations the school serves and describe the school's role in fostering opportunity for underserved populations.");
        $property->set_group('section_3');
        $this->set_property($property);
    }

    public function get_school_service()
    {
        return $this->get_property('school_service')->get_value();
    }

    public function set_high_quality_education($value)
    {
        $property = new \Orm_Property_Textarea('high_quality_education', $value);
        $property->set_description('Define the ways the school supports high-quality education by making appropriate effort to diversify the participants in the educational process and to guarantee that a wide variety of perspectives is included in all activities.');
        $property->set_group('section_3');
        $this->set_property($property);
    }

    public function get_high_quality_education()
    {
        return $this->get_property('high_quality_education')->get_value();
    }

    public function set_school_addresses($value)
    {
        $property = new \Orm_Property_Textarea('school_addresses', $value);
        $property->set_description('Demonstrate that the school addresses current and emerging corporate social responsibility issues through its own activities, through collaborations with other units within its institution, and/or through partnerships with external constituencies.');
        $property->set_group('section_3');
        $this->set_property($property);
    }

    public function get_school_addresses()
    {
        return $this->get_property('school_addresses')->get_value();
    }

}
