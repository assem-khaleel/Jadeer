<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb_business;

/**
 * Description of aacsb_business_section_2_standard_15
 *
 * @author ahmadgx
 */
class Aacsb_Business_Section_2_Standard_15 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 15';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;
    protected $orientation = 'landscape';

    public function init()
    {
        parent::init();

            $this->set_standard_name('');
            $this->set_definition('');
            $this->set_school_policies('');
            $this->set_qualification_status('');
            $this->set_faculty_sufficiency(array());
            $this->set_faculty_sufficiency_note('');
            $this->set_deployment_analysis('');
            $this->set_deployment_faculty(array());
            $this->set_information('');
            $this->set_faculty_member('');
    }

    public function set_standard_name()
    {
        $property = new \Orm_Property_Fixedtext('standard_name', "<b>The school maintains and strategically deploys participating and supporting faculty who collectively and individually demonstrate significant academic and professional engagement that sustains the intellectual capital necessary to support high-quality outcomes consistent with the school’s mission and strategies. [FACULTY QUALIFICATIONS AND ENGAGEMENT]</b>");
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
            . '<li>Initial academic preparation is assessed by earned degrees and other academic credentials. Initial professional experience is assessed by the nature, level, and duration of leadership and management position(s) in the practice of business and/or other types of organizational work.</li>'
            . '<li>Sustained academic and professional engagement is combined with initial academic preparation and initial professional experience to maintain and augment qualifications (i.e., currency and relevance in the field of teaching) of a faculty member over time.'
            . '<ul>'
            . '<li>Academic engagement reflects faculty scholarly development activities that support integration of relevant, current theory of business and management consistent with the school’s mission, expected outcomes, and supporting strategies.</li>'
            . '<li>Professional engagement reflects faculty practice-oriented development activities that support integration of relevant, current practice of business and management consistent with the school’s mission, expected outcomes, and supporting strategies.</li>'
            . '</ul></li>'
            . '<li>Qualified faculty status applies to faculty members who sustain intellectual capital in their fields of teaching, demonstrating currency and relevance of intellectual capital to support the academic unit’s mission, expected outcomes, and strategies, including teaching, scholarship, and other mission components. Categories for specifying qualified faculty status are based on the initial academic preparation, initial professional experience, and sustained academic and professional engagement as described below.<br/>'
            . '<table border="0" >'
            . '<tr>'
            . '<td rowspan="2"></td>'
            . '<td rowspan="2"></td>'
            . '<td colspan="2" style="padding: 2px;">Sustained engagement and professional interaction activities</td>'
            . '</tr>'
            . '<tr>'
            . '<td style="padding: 2px;">Academic (Research/Scholarly)</td>'
            . '<td style="padding: 2px;">Applied/Practice</td>'
            . '</tr>'
            . '<tr>'
            . '<td rowspan="2" style="padding: 2px;">Initial academic preparation and professional experience</td>'
            . '<td style="padding: 2px;">Professional experience, substantial in duration and level of responsibility</td>'
            . '<td colspan="2" rowspan="2" style="padding: 2px;">'
            . '<table border="1">'
            . '<tr>'
            . '<td style="padding: 2px;">Scholarly Practitioners (SP)</td>'
            . '<td style="padding: 2px;">Instructional Practitioners (IP)</td>'
            . '</tr>'
            . '<tr>'
            . '<td style="padding: 2px;">Scholarly Academics (SA)</td>'
            . '<td style="padding: 2px;">Practice Academics (PA)</td>'
            . '</tr>'
            . '</table>'
            . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td style="padding: 2px;">Doctoral degree</td>'
            . '</tr>'
            . '</table>'
            . '<br/>'
            . '<ul>'
            . '<li>Scholarly Academics (SA) sustain currency and relevance through scholarship and related activities. Normally, SA status is granted to newly hired faculty members who earned their research doctorates within the last five years prior to the review dates. Subsequent to hiring, SA status is sustained as outlined below.</li>'
            . '<li>Practice Academics (PA) sustain currency and relevance through professional engagement, interaction, and relevant activities. Normally, PA status applies to faculty members who augment their initial preparation as academic scholars with development and engagement activities that involve substantive linkages to practice, consulting, other forms of professional engagement, etc., based on the faculty members’ earlier work as an SA faculty member. PA status is sustained as outlined below.</li>'
            . '<li>Scholarly Practitioners (SP) sustain currency and relevance through continued professional experience, engagement, or interaction and scholarship related to their professional background and experience. Normally, SP status applies to practitioner faculty members who augment their experience with development and engagement activities involving substantive scholarly activities in their fields of teaching. SP status is sustained as outlined below.</li>'
            . '<li>Instructional Practitioners (IP) sustain currency and relevance through continued professional experience and engagement related to their professional backgrounds and experience. Normally, IP status is granted to newly hired faculty members who join the faculty with significant and substantive professional experience as outlined below. IP status is sustained as outlined below.</li>'
            . '</ul></li>'
            . '<li>Documenting faculty qualification status requires the school to demonstrate faculty members are either “Scholarly Academics,” “Practice Academics,” “Scholarly Practitioners” or “Instructional Practitioners”. Those individuals who do not meet the criteria for these categories will be classified as “Other.”</li>'
            . '<li>Total faculty resources - The aggregate or total faculty resources (SA, PA, SP, IP, and other) is the sum of all full and partial (based on a measure of percent-of-time devoted to the school’s mission) assignments. For example, if a school has 12 faculty members who are 100 percent devoted to the mission and seven faculty members who are only 50 percent devoted to mission, total faculty resources equal 15.5.</li>'
            . '</ul>'
            . '<br/><br/><strong>Basis for Judgments</strong> <br/>'
            . '<ul>'
            . '<li>The school must develop appropriate criteria consistent with its mission for the classification of faculty according to initial academic preparation, professional experience, ongoing scholarship, and ongoing professional engagement. The standard provides guidance only; each school should adapt this guidance to its particular situation and mission by developing and implementing criteria that indicate how the school is meeting the spirit and intent of the standard. The critical factor in determining whether faculty members bring current and relevant information is the alignment of their engagement activities with their primary teaching responsibilities and with the overall mission, expected outcomes and strategies of the school. Schools should develop specific policies to provide criteria by which qualifications status is granted and maintained. These criteria should address the following:'
            . '<ul>'
            . '<li>The combinations of academic preparation and professional experience required of faculty at the time of hiring, as well as the types of academic and professional development activities required of faculty after they have been hired in order for them to sustain their qualification status</li>'
            . '<li>How it assigns priority and value to different continuing academic and professional engagement activities; how such assignments support its portfolio of SA, PA, SP, and IP faculty; and how this portfolio of faculty supports its mission, expected outcomes, and strategies.</li>'
            . '<li>The qualitative standards it requires for various, specified development activities and illustrates the ways that it assures the quality of these activities.</li>'
            . '<li>The depth, breadth, and sustainability of academic and professional engagement (linked to reasonable outcomes) that faculty members are expected to undertake within the typical five-year AACSB review cycle in order to maintain their qualification status.</li>'
            . '</ul>'
            . '<p>These criteria may apply to the faculty resources as a whole or to segments of the faculty (e.g., by level of teaching responsibilities). Criteria for granting and for maintaining various qualifications for participating faculty who also hold significant administrative appointments (e.g., deans, associate deans, department head/chairs, or center directors) in the business school may reflect these important administrative roles.</p><br/></li>'
            . '<li>Normally, a doctoral degree emphasizing advanced foundational discipline-based research is appropriate initial academic preparation for SA and PA status, and there must be ongoing, sustained, and substantive academic and/or professional engagement activities supporting SA and PA status. Individuals with a graduate degree in law will be considered SA or PA for teaching business law and legal environment of business, subject to ongoing, sustained, and substantive academic and/or professional engagement activities demonstrating currency and relevance related to the teaching field.</li>'
            . '<li>Individuals with a graduate degree in taxation or an appropriate combination of graduate degrees in law and accounting will be considered SA or PA to teach taxation subject to continued, sustained academic and professional engagement that demonstrates relevance and currency in the field of teaching.</li>'
            . '<li>For SA and PA status, the less related faculty members’ doctoral degrees are to their fields of teaching, the more they must demonstrate higher levels of sustained, substantive academic and/or professional engagement to support their currency and relevance in their fields of teaching and their contributions to other mission components. In such cases, the burden of proof is on the school to make its case for SA or PA status.</li>'
            . '<li>If individuals have doctoral degrees that are less foundational disciplined-based research-oriented or if their highest degrees are not doctorates, then they must demonstrate higher levels of sustained, substantive academic and/or professional engagement activities to support their currency and relevance in their fields of teaching and their contributions to other mission components. The burden of proof is on the school to make its case for SA or PA status in such cases. AACSB expects that there will be only a limited number (normally not to exceed 10%) of cases in which individuals without doctoral degrees also have SA or PA status.</li>'
            . '<li>Academic and professional engagement activities must be substantive and sustained at levels that support currency and relevance for the school’s mission, expected outcomes, and strategies. Engagement can result from the work of a single faculty member, collaborations between and among multiple faculty, or collaborations between faculty and other scholars and/or practitioners.</li>'
            . '<li>other scholars and/or practitioners. Normally, faculty members may undertake a variety of academic engagement activities consistent with the school’s mission-linked research of business and management to support maintenance of SA status. A non-exhaustive list of academic engagement activities may include the following:'
            . '<ul>'
            . '<li>Scholarly activities leading to the production of scholarship outcomes as documented in Standard 2</li>'
            . '<li>Relevant, active editorships with academic journals or other business publications</li>'
            . '<li>Service on editorial boards or committees</li>'
            . '<li>Validation of SA status through leadership positions, participation in recognized academic societies and associations, research awards, academic fellow status, invited presentations, etc.</li>'
            . '</ul></li>'
            . '<li>Normally, faculty may undertake a variety of professional engagement activities to interact with business and management practice to support maintenance of PA status. A non-exhaustive list of professional engagement activities may include the following:'
            . '<ul>'
            . '<li>Consulting activities that are material in terms of time and substance</li>'
            . '<li>Faculty internships</li>'
            . '<li>Development and presentation of executive education programs</li>'
            . '<li>Sustained professional work supporting qualified status</li>'
            . '<li>Significant participation in business professional associations</li>'
            . '<li>Practice-oriented intellectual contributions detailed in Standard 2</li>'
            . '<li>Relevant, active service on boards of directors</li>'
            . '<li>Documented continuing professional education experiences</li>'
            . '<li>Participation in professional events that focus on the practice of business, management, and related issues</li>'
            . '<li>Participation in other activities that place faculty in direct contact with business or other organizational leaders</li>'
            . '</ul></li>'
            . '<li>Normally, at the time that a school hires an IP or SP faculty member, that faculty member’s professional experience is current, substantial in terms of duration and level of responsibility, and clearly linked to the field in which the person is expected to teach.</li>'
            . '<li>The less related the faculty member’s initial professional experience is to the field of teaching or the longer the time since the relevant experience occurred, the higher the expectation is for that faculty member to demonstrate sustained academic and/or professional engagement related to the field of teaching in order to maintain professional qualifications</li>'
            . '<li>Normally, IP and SP faculty members also have master’s degrees in disciplines related to their fields of teaching. In limited cases, IP or SP status may be appropriate for individuals without master’s degrees if the depth, duration, sophistication, and complexity of their professional experience at the time of hiring outweighs their lack of master’s degree qualifications. In such cases, the burden of proof is on the school to make its case.</li>'
            . '<li>For sustained SP status, a non-exhaustive list of academic and professional engagement activities may include the following:'
            . '<ul>'
            . '<li>Relevant scholarship outcomes as documented in Standard 2</li>'
            . '<li>Relevant, active editorships with academic, professional, or other business/management publications</li>'
            . '<li>Service on editorial boards or committees</li>'
            . '<li>Validation of SP status through leadership positions in recognized academic societies, research awards, academic fellow status, invited presentations, etc.</li>'
            . '<li>Development and presentation of continuing professional education activities or executive education programs</li>'
            . '<li>Substantive roles and participation in academic associations</li>'
            . '</ul></li>'
            . '<li>For sustained IP status, a non-exhaustive list of professional engagement activities and interactions may include the following:'
            . '<ul>'
            . '<li>Consulting activities that are material in terms of time and substance</li>'
            . '<li>Faculty internships</li>'
            . '<li>Development and presentation of executive education programs</li>'
            . '<li>Sustained professional work supporting IP status</li>'
            . '<li>Significant participation in business professional associations and societies</li>'
            . '<li>Relevant, active service on boards of director</li>'
            . '<li>Documented continuing professional education experiences</li>'
            . '<li>Documented professional certifications in the area of teaching</li>'
            . '<li>Participation in professional events that focus on the practice of business, management, and related issues</li>'
            . '<li>Participation in other activities that place faculty in direct contact with business and other organizational leaders</li>'
            . '</ul></li>'
            . '<li>The school’s blend of SA, PA, SP, and IP faculty members in support of degree programs, locations, and disciplines and other mission components must result from a strategic choice and be consistent with the school’s mission, expected outcomes, and strategies.</li>'
            . '<li>Normally, at least 90 percent of faculty resources are Scholarly Academics (SA), Practice Academics (PA), Scholarly Practitioners (SP), or Instructional Practitioners (IP).</li>'
            . '<li>Normally, at least 40 percent of faculty resources are Scholarly Academics (SA).Normally, at least 60 percent of faculty resources are Scholarly Academics (SA), Practice Academics (PA), or Scholarly Practitioners (SP).</li>'
            . '<li>In the aggregate, qualifications in the school’s portfolio of participating and supporting faculty members are sufficient to support high-quality performance in all activities in support of the school’s mission, expected outcomes, and strategies.</li>'
            . '<li>The school ensures students in all programs, disciplines, locations, and delivery modes are supported by high-quality learning experiences delivered or directed by an appropriate blend of qualified faculty that is strategically deployed and supported by an effective learning infrastructure. For example, schools with research doctoral and research master’s degree programs are expected to have higher percentages of SA and PA faculty, maintain a strong focus on SA faculty, and place high emphasis on faculty who possess research doctoral degrees and who undertake scholarly activities to maintain SA status. Schools that emphasize practice-oriented degrees may have a more balanced approach to the distribution of SA, PA, SP, IP, and other faculty members, subject to the limitations in the stated guidance and criteria that place high emphasis on a balance of theory and practice.</li>'
            . '<li>Qualified faculty are appropriately distributed across all programs, disciplines, locations, and delivery modes. The deployment of faculty resources is consistent with mission, expected outcomes, and strategies.</li>'
            . '<li>During the initial implementation period (2013-2016), schools are expected to make progress toward adjusting the deployment of faculty across the four categories. At the end of the implementation period, schools should fully satisfy the standard.</li>'
            . '</ul>'
            . '<br/> <br/><strong>Guidance for Documentation</strong>');
        $this->set_property($property);
    }

    public function get_definition()
    {
        return $this->get_property('definition')->get_value();
    }

    public function set_school_policies($value)
    {
        $property = new \Orm_Property_Textarea('school_policies', $value);
        $property->set_description('The school should provide its policies related to faculty qualifications, summarize its approach to the deployment of faculty resources across the business school, and explain how this approach is consistent with its mission, strategies, and expected outcomes.');
        $this->set_property($property);
    }

    public function get_school_policies()
    {
        return $this->get_property('school_policies')->get_value();
    }

    public function set_qualification_status()
    {
        $property = new \Orm_Property_Fixedtext('qualification_status', 'Table 15-1 must be completed to document the qualification status of participating and supporting faculty members, the percent of their time that is devoted to mission, and the ways their work aligns with the objective expectations detailed above. Graduate students or the equivalent with teaching responsibilities must be included in Table 15-1. Table 15-1 must not include faculty members who left prior to the normal academic year reflected in the table. Table 15-1 must include faculty members who joined the business school during the normal academic year reflected in the table. Peer review teams may request documentation for additional years; for individual terms; or by program, location, delivery mode, and/or disciplines.');
        $property->set_group('table_15_1');
        $this->set_property($property);
    }

    public function get_qualification_status()
    {
        return $this->get_property('qualification_status')->get_value();
    }

    public function set_faculty_sufficiency($value)
    {
        $property = new \Orm_Property_Table_Dynamic('faculty_sufficiency', $value);
        $property->set_description('TABLE 15-1: FACULTY SUFFICIENCY AND QUALIFICATIONS SUMMARY FOR THE MOST RECENTLY COMPLETED NORMAL ACADEMIC YEAR (RE: Standards 5 and 15) (1)');
        $property->set_group('table_15_1');

        $faculty_member = new \Orm_Property_Text('faculty_member');
        $faculty_member->set_description('Faculty Portfolio "Faculty Members Name (List individually in sections reflecting the schools faculty organizational structure (e.g., Departments and research groups)(1))"');
        $faculty_member->set_width(200);
        $property->add_property($faculty_member);

        $faculty_date = new \Orm_Property_Text('faculty_date');
        $faculty_date->set_description('Faculty Portfolio "Date of First Appointment to the School"');
        $faculty_date->set_width(100);
        $property->add_property($faculty_date);

        $faculty_degree = new \Orm_Property_Text('faculty_degree');
        $faculty_degree->set_description('Faculty Portfolio "Highest Degree, Year Earned"');
        $faculty_degree->set_width(200);
        $property->add_property($faculty_degree);

        $participating_faculty = new \Orm_Property_Text('participating_faculty');
        $participating_faculty->set_description('Faculty Sufficiency (Participating Faculty Productivity) (P) (2)');
        $participating_faculty->set_width(200);
        $property->add_property($participating_faculty);

        $supporting_faculty = new \Orm_Property_Text('supporting_faculty');
        $supporting_faculty->set_description('Faculty Sufficiency (Supporting Faculty Productivity) (S) (2)');
        $supporting_faculty->set_width(200);
        $property->add_property($supporting_faculty);

        $responsibilities = new \Orm_Property_Text('responsibilities');
        $responsibilities->set_description(' Faculty Sufficiency (Normal Professional Responsibilities)  (3)');
        $responsibilities->set_width(200);
        $property->add_property($responsibilities);

        $scholarly_percent = new \Orm_Property_Percentage('scholarly_percent');
        $scholarly_percent->set_description('Percent of Time Devoted to Mission for Each Faculty Qualification Group (5) " Scholarly Academic (SA) (4) "');
        $scholarly_percent->set_width(100);
        $property->add_property($scholarly_percent);

        $practice_percent = new \Orm_Property_Percentage('practice_percent');
        $practice_percent->set_description('Percent of Time Devoted to Mission for Each Faculty Qualification Group (5) " Practice Academic (PA) (4) "');
        $practice_percent->set_width(100);
        $property->add_property($practice_percent);


        $scholarly_practitioner = new \Orm_Property_Percentage('scholarly_practitioner');
        $scholarly_practitioner->set_description('Percent of Time Devoted to Mission for Each Faculty Qualification Group (5) " Scholarly Practitioner (SP)(4)"');
        $scholarly_practitioner->set_width(100);
        $property->add_property($scholarly_practitioner);

        $instructional_practitioner = new \Orm_Property_Percentage('instructional_practitioner');
        $instructional_practitioner->set_description('Percent of Time Devoted to Mission for Each Faculty Qualification Group (5) " Instructional Practitioner (IP)(4)"');
        $instructional_practitioner->set_width(100);
        $property->add_property($instructional_practitioner);


        $other = new \Orm_Property_Percentage('other');
        $other->set_description('Percent of Time Devoted to Mission for Each Faculty Qualification Group (5) " Other (O)(4)" ');
        $other->set_width(100);
        $property->add_property($other);


        $qualification = new \Orm_Property_Textarea('qualification');
        $qualification->set_description('Brief Description of Basis for Qualification (Enter brief Quantitative and/or qualitative information corresponding to the schools criteria for each category)');
        $qualification->set_width(230);
        $qualification->set_enable_tinymce(0);
        $property->add_property($qualification);

        $this->set_property($property);
    }

    public function get_faculty_sufficiency()
    {
        return $this->get_property('faculty_sufficiency')->get_value();
    }

    public function set_faculty_sufficiency_note()
    {
        $property = new \Orm_Property_Fixedtext('faculty_sufficiency_note', '<table border="1">'
            . '<tr><td style="padding: 5px;">Faculty Sufficiency Indicators 1 :'
            . '<ul><li>Overall: P/(P+S) > 75%</li>'
            . '<li>By discipline, location, delivery mode, or program: P/(P+S) > 60%</li></ul></td>'
            . '<td style="padding: 5px;">Faculty Qualifications Indicators 1 :'
            . '<ul><li>Minimum SA: (SA)/(SA +PA + SP + IP +O) > 40%</li>'
            . '<li>Minimum SA + PA + SP: (SA + PA + SP)/(SA + PA + SP + IP + O) >60%</li>'
            . '<li>Minimum SA + PA + SP + IP: (SA + PA + SP + IP)/(SA + PA + SP + IP + O) >90%</li></ul></td></tr></table> <br/>'
            . '<ol type="1"><li>This summary information is useful in assisting the peer review team in its initial assessment of alignment with Standards 5 and 15. The summary information allows the team to effectively focus its in-depth review of individual faculty vitae or other documents supporting the conclusions presented in the table. List all faculty contributing to the mission of the school including participating and supporting faculty, graduate students who have formal teaching responsibilities, and administrators holding faculty rank. For faculty not engaged in teaching, leave columns 4 and 5 (Faculty Sufficiency) blank. Faculty who left during the time frame represented in the table should not be included. Faculty members who joined the school for any part of the time frame are to be included. The school must explain the “normal academic year” format/schedule. Peer review teams may request documentation for additional years; for individual terms; or by programs, location, delivery mode, and/or discipline.</li>' . '<li>The measure of “teaching productivity” must reflect the operations of the business school, e.g., student credit hours (SCHs), European Credit Transfer Units (ECTUs), contact hours, individual courses, modules, or other designations that are appropriately indicative of the teaching contributions of each faculty member. Concurrence of the metric must be reached with the peer review team early in the review process. If a faculty member has no teaching responsibilities, he or she must be listed and reflected in the qualifications part of the table.</li>'
            . '<li>Indicate the normal professional responsibilities of each faculty member using the following guide: UT for undergraduate teaching; MT for master’s level teaching; DT for doctoral level teaching/mentoring; ADM for administration; RES for research; ED for executive education; SER for other service and outreach responsibilities. A faculty member may have more than one category assigned. Individuals who teach only in executive education programs should not be listed in this table.</li>'
            . '<li>For faculty qualifications based on engagement activities, faculty members may be Scholarly Academic (SA), Practice Academic (PA), Scholarly Practitioner (SP), Instructional Practitioner (IP), or Other (O). Faculty members should be assigned one of these designations based on the school’s criteria for initial qualifications and continuing engagement activities that support currency and relevance in the teaching field and to support other mission components. Faculty may be assigned in more than one category, but must be listed only once. Doctoral students who have obtained ABD status are considered SA or PA (depending on the nature of the doctoral degree) for 3 years. Faculty who have earned a doctoral degree will be considered SA or PA (depending on the nature of the doctoral degree) for 5 years from the date the degree is awarded. The “Other” category should be used for those individuals holding a faculty title but whose qualifications do not meet the criteria established by the school for SA, PA, SP, or IP status.</li>'
            . '<li>The “percent of time devoted to mission” reflects each faculty member’s contributions to the school’s overall mission during the period of evaluation. Reasons for less than 100 percent might include part-time employment, shared appointment with another academic unit, or other assignments that make the faculty member partially unavailable to the school. A full-time faculty member’s percent of time devoted to mission is 100 percent. For doctoral students who have formal teaching duties, the percent of time devoted to mission should reflect their teaching duties only and not any other activities associated with their roles as a student, e.g., work on a dissertation. For example, a doctoral student who teaches one class over the normal academic year and a part-time faculty member whose responsibilities are limited to the same level of activity should be assigned the same “percent of time devoted to mission.”</li></ol>');
        $property->set_group('table_15_1');
        $this->set_property($property);
    }

    public function get_faculty_sufficiency_note()
    {
        return $this->get_property('faculty_sufficiency_note')->get_value();
    }

    public function set_deployment_analysis()
    {
        $property = new \Orm_Property_Fixedtext('deployment_analysis', 'The school should provide an analysis of the deployment of SA, PA, SP, IP, and other faculty by aggregate degree program level (bachelor’s, master’s, doctoral). The school must complete Table 15-2 to demonstrate deployment of faculty resources across each degree program level. Deployment should be consistent with mission, expected outcomes, and strategies. Peer review teams may request more detail related to a discipline, program, delivery mode, and/or location.');
        $property->set_group('table_15_2');
        $this->set_property($property);
    }

    public function get_deployment_analysis()
    {
        return $this->get_property('deployment_analysis')->get_value();
    }

    public function set_deployment_faculty($value)
    {
        $bachelors = new \Orm_Property_Percentage('bachelors');
        $bachelors->set_width(100);
        $mba = new \Orm_Property_Percentage('mba');
        $mba->set_width(100);
        $master = new \Orm_Property_Percentage('master');
        $master->set_width(100);
        $doctoral = new \Orm_Property_Percentage('doctoral');
        $doctoral->set_width(100);
        $other = new \Orm_Property_Percentage('other');
        $other->set_width(100);

        $property = new \Orm_Property_Table('deployment_faculty', $value);
        $property->set_description('TABLE 15-2: DEPLOYMENT OF PARTICIPATING AND SUPPORTING FACULTY BY QUALIFICATION STATUS IN SUPPORT OF DEGREE PROGRAMS FOR THE MOST RECENTLY COMPLETED NORMAL ACADEMIC YEAR');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('empty', ''), 2, 0);
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('percent', 'Percent of teaching (Indicate metric used, credit hours, contact hours, courses taught, or another metric appropriate to the accounting academic unit)'), 0, 7);

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('scholarty', 'Scholarly Academic (SA) %'));
        $property->add_cell(2, 2, new \Orm_Property_Fixedtext('practice', 'Practice Academic (PA) %'));
        $property->add_cell(2, 3, new \Orm_Property_Fixedtext('practitioner', 'Scholarly Practitioner (SP) %'));
        $property->add_cell(2, 4, new \Orm_Property_Fixedtext('instructional_practitioner', 'Instructional Practitioner (IP) %'));
        $property->add_cell(2, 5, new \Orm_Property_Fixedtext('other', 'Other (O) %'));
        $property->add_cell(2, 6, new \Orm_Property_Fixedtext('total', 'Total % (1)'));

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('bachelors', 'Bachelor’s'));
        $property->add_cell(3, 2, $bachelors);
        $property->add_cell(3, 3, $bachelors);
        $property->add_cell(3, 4, $bachelors);
        $property->add_cell(3, 5, $bachelors);
        $property->add_cell(3, 6, $bachelors);
        $property->add_cell(3, 7, $bachelors);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('mba', 'MBA'));
        $property->add_cell(4, 2, $mba);
        $property->add_cell(4, 3, $mba);
        $property->add_cell(4, 4, $mba);
        $property->add_cell(4, 5, $mba);
        $property->add_cell(4, 6, $mba);
        $property->add_cell(4, 7, $mba);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('master', 'Specialized Master’s'));
        $property->add_cell(5, 2, $master);
        $property->add_cell(5, 3, $master);
        $property->add_cell(5, 4, $master);
        $property->add_cell(5, 5, $master);
        $property->add_cell(5, 6, $master);
        $property->add_cell(5, 7, $master);

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('doctor', 'Doctoral Program'));
        $property->add_cell(6, 2, $doctoral);
        $property->add_cell(6, 3, $doctoral);
        $property->add_cell(6, 4, $doctoral);
        $property->add_cell(6, 5, $doctoral);
        $property->add_cell(6, 6, $doctoral);
        $property->add_cell(6, 7, $doctoral);

        $property->add_cell(7, 1, new \Orm_Property_Fixedtext('other', 'Other (Specify)'));
        $property->add_cell(7, 2, $other);
        $property->add_cell(7, 3, $other);
        $property->add_cell(7, 4, $other);
        $property->add_cell(7, 5, $other);
        $property->add_cell(7, 6, $other);
        $property->add_cell(7, 7, $other);

        $property->set_group('table_15_2');
        $this->set_property($property);
    }

    public function get_deployment_faculty()
    {
        return $this->get_property('deployment_faculty')->get_value();
    }

    public function set_information()
    {
        $property = new \Orm_Property_Fixedtext('information', '1. Provide information for the most recently completed normal academic year. Each cell represents the percent of total teaching (whether measured by credit hours, contact hours, courses taught or another metric appropriate to the school) for each degree program level by faculty qualifications status. The sum across each row should total 100 percent. Provide a brief analysis that explains the deployment of faculty as noted above to mission, expected outcomes, and strategies.');
        $property->set_group('table_15_2');
        $this->set_property($property);
    }

    public function get_information()
    {
        return $this->get_property('information')->get_value();
    }

    public function set_faculty_member($value)
    {
        $property = new \Orm_Property_Textarea('faculty_member', $value);
        $property->set_description('The school should provide information on each faculty member. This information may be provided in the form of academic vitae or equivalent documents, but must include sufficient detail as to actions, impacts, and timing to support an understanding of faculty engagement activities and their impact on the deployment of qualified faculty resources.');
        $this->set_property($property);
    }

    public function get_faculty_member()
    {
        return $this->get_property('faculty_member')->get_value();
    }

}
