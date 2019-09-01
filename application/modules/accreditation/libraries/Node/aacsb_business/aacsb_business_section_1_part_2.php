<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb_business;

/**
 * Description of aacsb_business_section_1_part_2
 *
 * @author ahmadgx
 */
class Aacsb_Business_Section_1_Part_2 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Part 2: General Criteria';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            /* Part D */
            $this->set_criteria_d('');
            $this->set_branding('');
            $this->set_external_market('');
            $this->set_financial_relation('');
            $this->set_business('');
            $this->set_aacsb_approval('');
            $this->set_limited_participation('');
            $this->set_distinctiveness('');
            $this->set_administrative_control('');
            $this->set_other_factor('');
            /* Part E */
            $this->set_criteria_e('');
            $this->set_organizational_structure('');
            $this->set_school_structure('');
            $this->set_financial_performance('');
            $this->set_resourcse('');
            $this->set_faculty_resources('');
            $this->set_teaching_model('');
            $this->set_school_resources('');
            /* Part F */
            $this->set_criteria_f('');
    }

    public function set_criteria_d()
    {
        $property = new \Orm_Property_Fixedtext('criteria_d', '<strong>D. An applicant for AACSB accreditation must be a well-defined, established entity and a member of AACSB International in good standing. The entity seeking AACSB accreditation may be an institution authorized to award bachelor’s degrees or higher (in business) or under certain circumstances a business academic unit within a larger institution. [ACCREDITATION SCOPE AND AACSB MEMBERSHIP] <br/> <br/>'
            . 'Definitions</strong> <br/>'
            . '<ul>'
            . '<li>An institution is a legal entity authorized to award bachelor’s degrees or higher.</li>'
            . '<li>An academic unit operates within an institution offering bachelor’s degrees or higher and may depend on the institution for authority to grant degrees and for financial, human, and physical resources.</li>'
            . '<li>A business academic unit is an academic unit in which business and management education is the predominant focus across degree programs, research, and outreach activities. The business academic unit may seek accreditation as outlined in these eligibility criteria.</li>'
            . '<li>Another (non-business) academic unit is an academic unit in which business and management education is not the predominant focus across degree programs, research, and outreach activities.</li>'
            . '</ul>'
            . '<strong>Basis for Judgment</strong> <br/>'
            . '<ul>'
            . '<li>The entity applying for accreditation is agreed upon through AACSB processes and meets the spirit and intent of the conditions and expectations as outlined in these eligibility criteria. The entity must be approved well in advance (normally two years) of the onsite visit of the accreditation peer review team.</li>'
            . '<li>Within the approved entity applying for accreditation, the programmatic scope of accreditation (i.e., degree programs and other programmatic activities to be included in the AACSB review process and subject to alignment with accreditation standards) is agreed upon through AACSB processes and meets the spirit and intent of the conditions and expectations outlined in these eligibility criteria. Program inclusions and exclusions are approved well in advance (normally two years) of the onsite visit of the accreditation peer review team.</li>'
            . '<li>The entity applying for accreditation agrees to use the AACSB accreditation brand and related statements about accreditation in its electronic and printed communications in accordance with AACSB policies and guidelines.</li>'
            . '</ul>'
            . '<strong>Guidance for Documentation</strong> <br/>'
            . '<ul>'
            . '<li>An applicant for AACSB accreditation must complete an AACSB Accreditation Eligibility Application, which identifies the applicant as either:'
            . '<ul>'
            . '<li>An institution that offers business and management education degree programs and related programmatic activities in one or more business academic units and other non-business academic units. In this case, all of the institution’s business and management activities and related programmatic activities are included in the scope of the AACSB accreditation review. An institution is the default entity applying for accreditation.</li>'
            . '<li>A single business academic unit within an institution that offers business and management education degree programs and other related programmatic activities. In this case, the applicant may request that this unit be considered an independent business academic unit for accreditation purposes. If approved, all business and management education degree programs and related programmatic activities operating within the independent business academic unit are included in the scope of the AACSB accreditation review. This approach to scope does not preclude more than one business academic unit within an institution from seeking AACSB accreditation as an independent business academic unit. A single business academic unit may apply for status as an independent business academic unit, in effect acting as the entity applying for accreditation.</li>'
            . '</ul>'
            . '</li></ul>'
            . 'All business and management degree and related programmatic activities operating within the business academic unit are to be included in the scope of the AACSB accreditation review (see below for guidance on programmatic scope). This approach to defining the accreditation entity is subject to the receipt of documentation that verifies that the business academic unit has a sufficient level of independence in four areas: (1) branding; (2) external market perception; (3) financial relationship; and (4) autonomy as it relates to the single business unit and the institution. The first two are necessary; the latter two are supplemental in making a determination about the unit of accreditation. This determination is made by the appropriate AACSB committee. The burden of proof is on the business academic unit to document its distinctiveness from the other academic units within the institution in the four areas noted above, which the association defines in the following ways:');
        $property->set_group('section_4');
        $this->set_property($property);
    }

    public function get_criteria_d()
    {
        return $this->get_property('criteria_d')->get_value();
    }

    public function set_branding($value)
    {
        $property = new \Orm_Property_Textarea('branding', $value);
        $property->set_description('Branding—Independent branding of the business academic unit relates to the following: (1) market positioning; (2) promotion (e.g., websites, electronic and print advertising, collateral materials, etc.) of the business and management degree programs and other programmatic activities offered within the business academic unit; (3) business school name, faculty, and degree titles; and (4) other brand differentiation between the business academic unit and other academic units within the institution.');
        $property->set_group('section_4');
        $this->set_property($property);
    }

    public function get_branding()
    {
        return $this->get_property('branding')->get_value();
    }

    public function set_external_market($value)
    {
        $property = new \Orm_Property_Textarea('external_market', $value);
        $property->set_description('External Market Perception—This criterion is focused on the extent to which the external markets (students, employers, other stakeholder groups, and the public) perceive that the business academic unit is differentiated from other academic units within the institution. This differentiation may include elements such as student admissions, graduate recruiting and placement histories, and starting salaries.');
        $property->set_group('section_4');
        $this->set_property($property);
    }

    public function get_external_market()
    {
        return $this->get_property('external_market')->get_value();
    }

    public function set_financial_relation($value)
    {
        $property = new \Orm_Property_Textarea('financial_relation', $value);
        $property->set_description('Financial Relationships with the Institution—Financial relationships relates to the following: (1) approval of operating and capital budgets for the business academic unit; (2) the business academic unit’s control over a large portion of the funds available to the unit; (3) subsidies to the institution; and (4) ownership or control of physical and financial assets.');
        $property->set_group('section_4');
        $this->set_property($property);
    }

    public function get_financial_relation()
    {
        return $this->get_property('financial_relation')->get_value();
    }

    public function set_business($value)
    {
        $property = new \Orm_Property_Textarea('business', $value);
        $property->set_description('Business Academic Unit Autonomy—Autonomy of the business academic unit is described in terms of its adherence to the policies and procedures of the larger institution or in terms of the source of approval of or constraints on its activities related to the following areas: (1) the strategic plan of the business academic unit; (2) approval of key decisions of the business academic unit; (3) appointment of the head or senior leader of the business academic unit; (4) geographic separation of the business academic unit and the larger institution; and (5) any other significant attribute of the relationship that affects the autonomy of the business academic unit.');
        $property->set_group('section_4');
        $this->set_property($property);
    }

    public function get_business()
    {
        return $this->get_property('business')->get_value();
    }

    public function set_aacsb_approval()
    {
        $property = new \Orm_Property_Fixedtext('aacsb_approval', '<ul>'
            . '<li>Based on AACSB approval of the entity that is applying for accreditation, the next step is to gain agreement on the programmatic scope of the accreditation review to include all business and management degree programs at the bachelor’s level or higher, research activities, and other mission components. Other mission components may include executive education or other mission-focused outreach activities if they are business related. Regardless of the entity seeking accreditation, the following guidelines establish factors that determine if a degree program should be included or excluded from the AACSB accreditation review process:'
            . '<ul>'
            . '<li>Normally, bachelor degree programs in which 25 percent or more of the teaching relates to traditional business subjects or graduate programs in which 50 percent or more of the teaching relates to traditional business subjects are considered business degree programs. Traditional business subjects include accounting, business law, decision sciences, economics, entrepreneurship, finance (including insurance, real estate, and banking), human resources, international business, management, management information systems, management science, marketing, operations management, organizational behavior, organizational development, strategic management, supply chain management (including transportation and logistics), and technology management. This list is not exhaustive and should be interpreted in the context of the school and mission. Normally, extensions of traditional business subjects, including interdisciplinary courses, majors, concentrations, and areas of emphasis will be included in an AACSB accreditation review. The above percentages are adjusted accordingly for bachelor’s degree programs requiring three years to complete.</li>'
            . '<li>Degree programs with business content below the thresholds noted above may be excluded from the AACSB review process if such programs are not marketed or otherwise represented as business degree programs and if such programs do not involve significant resources of the business academic units participating in the AACSB accreditation review process.</li>'
            . '<li>With the burden of proof on the entity applying for AACSB accreditation, degree programs with business content exceeding the minimum thresholds noted above may be excluded from the review process subject to approval by the appropriate AACSB committee based on that committee’s judgment regarding the following factors:</li>'
            . '</ul>'
            . '</li></ul>');
        $property->set_group('section_4');
        $this->set_property($property);
    }

    public function get_aacsb_approval()
    {
        return $this->get_property('aacsb_approval')->get_value();
    }

    public function set_limited_participation($value)
    {
        $property = new \Orm_Property_Textarea('limited_participation', $value);
        $property->set_description('Demonstration of limited or no participation in, and a high level of independence relative to, the development, delivery, and oversight of programs requested for exclusion.');
        $property->set_group('section_4');
        $this->set_property($property);
    }

    public function get_limited_participation()
    {
        return $this->get_property('limited_participation')->get_value();
    }

    public function set_distinctiveness($value)
    {
        $property = new \Orm_Property_Textarea('distinctiveness', $value);
        $property->set_description('Demonstration of branding distinctiveness such that students, faculty, and employers clearly distinguish such programs from those degree programs identified for inclusion in the accreditation review process. For example, degree programs must be included in the accreditation review if they are business programs announced and advertised in catalogs, brochures, websites, and other materials in conjunction with programs that are identified for inclusion. That is, to be excluded, degree programs must not be presented in conjunction with the included programs, either in the institution’s materials or in materials for programs for which the exclusion is sought. To be excluded, programs must be clearly distinguishable from the included programs by title; in published descriptions; and in representations to potential students, faculty, and employers. Exclusions will not be approved when such exclusion will create confusion about which programs within the institution have achieved AACSB accreditation.');
        $property->set_group('section_4');
        $this->set_property($property);
    }

    public function get_distinctiveness()
    {
        return $this->get_property('distinctiveness')->get_value();
    }

    public function set_administrative_control($value)
    {
        $property = new \Orm_Property_Textarea('administrative_control', $value);
        $property->set_description('Demonstration of a lack of administrative control and programmatic autonomy relative to program design, faculty hiring, development and promotion, student selection and services, curriculum design, and degree conferral. If the leadership of the entity applying for accreditation has influence over these factors or controls these factors relative to any business degree program, the program will be included in the scope of review.');
        $property->set_group('section_4');
        $this->set_property($property);
    }

    public function get_administrative_control()
    {
        return $this->get_property('administrative_control')->get_value();
    }

    public function set_other_factor()
    {
        $property = new \Orm_Property_Fixedtext('other_factor', '<ul>'
            . '<li>Other factors that may result in the exclusion of a degree program from an AACSB accreditation review are:'
            . '<ul><li>Degree programs subject to accreditation by other non-business accreditation organizations.</li>'
            . '<li>Specialized degree programs (e.g., hotel and restaurant management, engineering management, health care management, agribusiness, and public administration) that are not marketed in conjunction with the business program under AACSB review.</li>'
            . '<li>Degrees offered on a separate or independent campus.</li>'
            . '<li>Degree programs offered via a consortium of schools that do not carry the name of the applicant entity on the diploma or transcript.</li>'
            . '<li>Degree programs in secondary business education whether offered within the entity applying for accreditation or elsewhere.</li>'
            . '</ul></li>'
            . '<li>Degree programs offered by the entity applying for accreditation delivered jointly through partnership agreements, consortia, franchise arrangements, etc. are included in the scope of the review if there is any connotation that the entity applying for accreditation is recognized as one or more of the degree granting institutions.</li>'
            . '<li>Degree programs in business and management delivered by other (non-business) academic units are reviewed primarily against standards related to student selection and retention, deployment of qualified faculty and professional staff, and teaching and learning.</li>'
            . '<li>AACSB recognizes national systems and local cultural contexts, as well as regulatory environments in which an entity applying for accreditation operates. As a result, AACSB can vary the boundaries of what is considered traditional business subjects. AACSB will consider the definition of those boundaries in the local context in which the applicant entity operates. For AACSB to agree to vary its definition of a traditional business subject, the applicant entity must explain and document such variations within its local context.</li>'
            . '<li>AACSB International must ensure that its brand is applied strictly and only to the agreed upon entity applying for accreditation and the programs and programmatic activities included within the scope of its review. For that reason, the entity applying for accreditation must document its agreement and alignment with the following guidelines regarding the use of the AACSB International accreditation brand and related statements about accreditation:'
            . '<ul>'
            . '<li>In the case that the entity applying for accreditation is the institution, the AACSB accreditation brand applies to the institution (e.g., the University of Bagu), all business academic units (e.g., the College of Business, Graduate School of Business, or Bagu School of Management), all business and management degree programs delivered by the institution or business academic unit (e.g., BBA, MBA, or Masters of Science), and degree programs in business and management included in the review that are offered by other (non-business) academic units (e.g., BA in Management or MA in Organizational Leadership). Note the AACSB accreditation brand may not be applied to other (non-business) academic units, only to the business and management degree programs included in the accreditation review that they offer.</li>'
            . '<li>In the case where the entity applying for accreditation is an independent business academic unit within an institution, the AACSB accreditation brand applies only to the independent business academic unit and all business and management degree programs it is responsible for delivering. The AACSB accreditation brand may not be applied to the institution or to other (non-business) academic units or the business and management degree programs they offer.</li>'
            . '</ul></li>'
            . '<li>Applications for accreditation must be supported by the chief executive officer of the business school applicant and the chief academic officer of the institution regardless of the accreditation entity seeking AACSB accreditation. When the applicant entity is an independent business academic unit at the same institution as another entity that already holds AACSB accreditation, the applicant must clearly distinguish the business programs it delivers from the AACSB-accredited entity. In all cases, the institution and all business academic units agree to comply with AACSB policies that recognize the entity that holds AACSB accreditation.</li>'
            . '<li>For all AACSB-accredited entities, the list of degree programs included in the scope of accreditation review must be maintained continuously at AACSB. New programs introduced by business academic units that are AACSB-accredited may be indicated as AACSB-accredited until the next continuous improvement of accreditation review. New business degree programs delivered by other (non-business) academic units may not be indicated as accredited prior to the next review.</li>'
            . '</ul>');
        $property->set_group('section_4');
        $this->set_property($property);
    }

    public function get_other_factor()
    {
        return $this->get_property('other_factor')->get_value();
    }

    public function set_criteria_e()
    {
        $property = new \Orm_Property_Fixedtext('criteria_e', '<strong>E. The school must be structured to ensure proper oversight, accountability, and responsibility for the school’s operations; must be supported by continuing resources (human, financial, infrastructure, and physical); and must have policies and processes for continuous improvement. [OVERSIGHT, SUSTAINABILITY, AND CONTINUOUS IMPROVEMENT] <br/> <br/>'
            . 'Basis for Judgment</strong> <br/>'
            . '<ul>'
            . '<li>This criterion does not require a particular administrative structure or set of practices; however, the structure must be appropriate to sustain excellence and continuous improvement in management education within the context of a collegiate institution as described in the preamble to these standards.</li>'
            . '<li>The organizational structure must provide proper oversight and accountability for the components of the school’s mission that are related to business and management education.</li>'
            . '<li>The school must have policies and processes in place to support continuous improvement and accountability.</li>'
            . '<li>The school must demonstrate sufficient and sustained resources (financial, human, physical, infrastructural, etc.) to support the business academic unit (or units) seeking AACSB accreditation in its efforts to fulfill its mission, strategies, and expected outcomes.</li>'
            . '</ul><br/><br/>'
            . '<strong>Guidance for Documentation</strong>');
        $property->set_group('section_5');
        $this->set_property($property);
    }

    public function get_criteria_e()
    {
        return $this->get_property('criteria_e')->get_value();
    }

    public function set_organizational_structure($value)
    {
        $property = new \Orm_Property_Textarea('organizational_structure', $value);
        $property->set_description('Describe the organizational structure of the school, providing an organizational chart that identifies the school in the context of the larger institution (if applicable).');
        $property->set_group('section_5');
        $this->set_property($property);
    }

    public function get_organizational_structure()
    {
        return $this->get_property('organizational_structure')->get_value();
    }

    public function set_school_structure($value)
    {
        $property = new \Orm_Property_Textarea('school_structure', $value);
        $property->set_description('Provide an overview of the structure of the school, its policies, and processes to ensure continuous improvement and accountability related to the school’s operations. This overview also should include policies and processes that encourage and support intellectual contributions that influence the theory, practice, and/or teaching of business and management.');
        $property->set_group('section_5');
        $this->set_property($property);
    }

    public function get_school_structure()
    {
        return $this->get_property('school_structure')->get_value();
    }

    public function set_financial_performance($value)
    {
        $property = new \Orm_Property_Textarea('financial_performance', $value);
        $property->set_description('Summarize the budget and financial performance for the most recent academic year. Describe the financial resources of the school in relationship to the financial resources of the whole institution (e.g., compare business degree program enrollments as a fraction of the institution’s total enrollment).');
        $property->set_group('section_5');
        $this->set_property($property);
    }

    public function get_financial_performance()
    {
        return $this->get_property('financial_performance')->get_value();
    }

    public function set_resourcse($value)
    {
        $property = new \Orm_Property_Textarea('resourcse', $value);
        $property->set_description('Describe trends in resources available to the school, including those related to finances, facilities, information technology infrastructure, human, and library/information resources.'
            . 'Discuss the impact of resources on the school’s operations, outcomes (graduates, research, etc.), and potential for mission achievement going forward.');
        $property->set_group('section_5');
        $this->set_property($property);
    }

    public function get_resourcse()
    {
        return $this->get_property('resourcse')->get_value();
    }

    public function set_faculty_resources($value)
    {
        $property = new \Orm_Property_Textarea('faculty_resources', $value);
        $property->set_description('Describe the total faculty resources for the school, including the number of faculty members on staff, the highest degree level (doctoral, master’s, and bachelor’s) of each faculty member, and the disciplinary area of each faculty member.');
        $property->set_group('section_5');
        $this->set_property($property);
    }

    public function get_faculty_resources()
    {
        return $this->get_property('faculty_resources')->get_value();
    }

    public function set_teaching_model($value)
    {
        $property = new \Orm_Property_Textarea('teaching_model', $value);
        $property->set_description('For each degree program, describe the teaching/learning model (e.g., traditional classroom models, online or distance models, models that blend the traditional classroom with distance delivery, or other technology-supported approaches). In addition, describe the division of labor across faculty and professional staff, as well as the nature of participant interactions supported. Extend this analysis to each location and delivery mode.');
        $property->set_group('section_5');
        $this->set_property($property);
    }

    public function get_teaching_model()
    {
        return $this->get_property('teaching_model')->get_value();
    }

    public function set_school_resources($value)
    {
        $property = new \Orm_Property_Textarea('school_resources', $value);
        $property->set_description('Describe the school resources that are committed to other mission-related activities beyond business degree programs and intellectual contributions.');
        $property->set_group('section_5');
        $this->set_property($property);
    }

    public function get_school_resources()
    {
        return $this->get_property('school_resources')->get_value();
    }

    public function set_criteria_f()
    {
        $property = new \Orm_Property_Fixedtext('criteria_f', '<strong>F. All degree programs included in the AACSB accreditation review must demonstrate continuing adherence to AACSB accreditation standards. Schools are expected to maintain and provide timely, accurate information in support of each accreditation review. [POLICY ON CONTINUED ADHERENCE TO STANDARDS AND INTEGRITY OF SUBMISSIONS TO AACSB]</strong>'
            . ' <br/> <br/>All degree programs included in the AACSB accreditation review must demonstrate continuing adherence to the AACSB accreditation standards and policies.'
            . ' <br/> <br/>After a school achieves accreditation, AACSB reserves the right to request a review of that accredited institution’s or academic business unit’s programs at any time if questions arise concerning the continuation of educational quality as defined by the standards. In addition, schools are expected to maintain and provide accurate information in support of each accreditation review'
            . ' <br/> <br/>Any school that deliberately misrepresents information to AACSB in support of an accreditation review shall be subject to appropriate processes. Such misrepresentation is grounds for the immediate denial of a school’s initial application for accreditation or, in the case of a continuous improvement review, for revocation of a school’s membership in the Accreditation Council.');
        $this->set_property($property);
    }

    public function get_criteria_f()
    {
        return $this->get_property('criteria_f')->get_value();
    }

}
