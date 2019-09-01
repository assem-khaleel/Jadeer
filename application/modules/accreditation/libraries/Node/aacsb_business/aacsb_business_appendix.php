<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb_business;

/**
 * Description of aacsb_business_appendix
 *
 * @author ahmadgx
 */
class Aacsb_Business_Appendix extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'APPENDIX EXAMPLES OF IMPACT METRICS IN SUPPORT OF DOCUMENTATION';
    protected $link_pdf = true;
    protected $link_view = true;
    protected $link_edit = true;

    public function init()
    {
        parent::init();

            $this->set_introduction('');
            /* Impact 1 */
            $this->set_mission_alignment('');
            $this->set_mission_impact('');
            /* Impact 2 */
            $this->set_academic('');
            $this->set_academic_impact('');
            /* Impact 3 */
            $this->set_teaching('');
            $this->set_teaching_impact('');
            /* Impact 4 */
            $this->set_education_level('');
            $this->set_education_impact('');
            /* Impact 5 */
            $this->set_doctoral_education('');
            $this->set_doctoral_impact('');
            /* Impact 6 */
            $this->set_practice('');
            $this->set_practice_impact('');
            /* Impact 7 */
            $this->set_executive_education('');
            $this->set_executive_education_impact('');
            /* Impact 8 */
            $this->set_research('');
            $this->set_research_impact('');
    }

    public function set_introduction()
    {
        $property = new \Orm_Property_Fixedtext('introduction', 'Examples of metrics that schools might use to assess the impact of their activities, including scholarship and the creation of intellectual contributions, are provided below. Some activities, including scholarship, may have multiple impacts, while others have limited or no impact. Sometimes the impact of an activity or intellectual contribution may not be known or identifiable for a number of years. It is also important to note that evidence that intellectual contribution outcomes have “made a difference” may result from a single outcome produced by one or more faculty members and/or students, a series or compilations of works, or collaborative work with colleagues at other institutions or in practice. The list of categories and examples provided below is not intended to be limiting or exhaustive. Schools may identify and report other examples not included below, including impact on constituencies such as society, community, business practitioners, students, alumni, etc.');
        $this->set_property($property);
    }

    public function get_introduction()
    {
        return $this->get_property('introduction')->get_value();
    }

    public function set_mission_alignment()
    {
        $property = new \Orm_Property_Fixedtext('mission_alignment', '<br/><strong>MISSION ALIGNMENT IMPACT</strong> <br/>'
            . '<ul>'
            . '<li>Alignment of intellectual contribution outcomes with themes or focus areas valued by the business school’s mission (e.g., global development, entrepreneurship, innovation)</li>'
            . '<li>Percentage of intellectual contribution outcomes that align with one or more “mission-related” focus areas for research</li>'
            . '<li>Percentage of faculty with one or more intellectual contribution outcomes that align with one or more mission-related focus areas</li>'
            . '<li>Research awards and recognition that document alignment with one or more “mission-related” focus areas for research</li>'
            . '<li>Substantive impact and carry-forward of mission as stated in Standard 1 and as referenced throughout the remaining accreditation standards</li>'
            . '<li>Linkage between mission as stated in Standard 1 and financial history and strategies as stated in Standard 3</li>'
            . '</ul>');
        $property->set_group('impact_1');
        $this->set_property($property);
    }

    public function get_mission_alignment()
    {
        return $this->get_property('mission_alignment')->get_value();
    }

    public function set_mission_impact($value)
    {
        $property = new \Orm_Property_Textarea('mission_impact', $value);
        $property->set_group('impact_1');
        $this->set_property($property);
    }

    public function get_mission_impact()
    {
        return $this->get_property('mission_impact')->get_value();
    }

    public function set_academic()
    {
        $property = new \Orm_Property_Fixedtext('academic', '<strong>ACADEMIC IMPACT</strong> <br/>'
            . '<ul>'
            . '<li>Publications in highly recognized, leading peer-review journals (journals in a designated journal list, Top 3, Top 10, etc.)</li>'
            . '<li>Citation counts</li>'
            . '<li>Download counts for electronic journals</li>'
            . '<li>Editorships, associate editorships, editorial board memberships, and/or invitations to act as journal reviewers for recognized, leading peer-review journals</li>'
            . '<li>Elections or appointments to leadership positions in academic and/or professional associations and societies</li>'
            . '<li>Recognitions for research (e.g., Best Paper Award), Fellow Status in an academic society, and other recognition by professional and/or academic societies for intellectual contribution outcomes</li>'
            . '<li>Invitations to participate in research conferences, scholarly programs, and/or international, national, or regional research forums</li>'
            . '<li>Inclusion of academic work in the syllabi of other professors’ courses</li>'
            . '<li>Use of academic work in doctoral seminars</li>'
            . '<li>Competitive grants awarded by major national and international agencies (e.g., NSF and NIH) or third-party funding for research projects</li>'
            . '<li>Patents awarded</li>'
            . '<li>Appointments as visiting professors or scholars in other schools or a set of schools</li>'
            . '</ul>');
        $property->set_group('impact_2');
        $this->set_property($property);
    }

    public function get_academic()
    {
        return $this->get_property('academic')->get_value();
    }

    public function set_academic_impact($value)
    {
        $property = new \Orm_Property_Textarea('academic_impact', $value);
        $property->set_group('impact_2');
        $this->set_property($property);
    }

    public function get_academic_impact()
    {
        return $this->get_property('academic_impact')->get_value();
    }

    public function set_teaching()
    {
        $property = new \Orm_Property_Fixedtext('teaching', '<strong>TEACHING/INSTRUCTIONAL IMPACT</strong> <br/>'
            . '<ul>'
            . '<li>Grants for research that influence teaching/pedagogical practices, materials, etc.</li>'
            . '<li>Case studies of research leading to the adoption of new teaching/learning practices</li>'
            . '<li>Textbooks, teaching manuals, etc., that are widely adopted (by number of editions, number of downloads, number of views, use in teaching, sales volume, etc.)</li>'
            . '<li>Publications that focus on research methods and teaching</li>'
            . '<li>Research-based learning projects with companies, institutions, and/or non-profit organizations</li>'
            . '<li>Instructional software (by number of programs developed, number of users, etc.)</li>'
            . '<li>Case study development (by number of studies developed, number of users, etc.)</li>'
            . '</ul>');
        $property->set_group('impact_3');
        $this->set_property($property);
    }

    public function get_teaching()
    {
        return $this->get_property('teaching')->get_value();
    }

    public function set_teaching_impact($value)
    {
        $property = new \Orm_Property_Textarea('teaching_impact', $value);
        $property->set_group('impact_3');
        $this->set_property($property);
    }

    public function get_teaching_impact()
    {
        return $this->get_property('teaching_impact')->get_value();
    }

    public function set_education_level()
    {
        $property = new \Orm_Property_Fixedtext('education_level', '<strong>BACHELOR’S/MASTER’S LEVEL EDUCATION IMPACT</strong> <br/>'
            . '<ul>'
            . '<li>Mentorship of student research reflected in the number of student papers produced under faculty supervision that lead to publications or formal presentations at academic or professional conferences</li>'
            . '<li>Documented improvements in learning outcomes that result from teaching innovations that incorporate research methods from learning/pedagogical research projects</li>'
            . '<li>Hiring/placement of students</li>'
            . '<li>Career success of graduates beyond initial placement</li>'
            . '<li>Placement of students in research-based graduate programs</li>'
            . '<li>Direct input from organizations that hire graduates regarding graduates preparedness for jobs and the roles they play in advancing the organization</li>'
            . '<li>Movement of graduates into positions of leadership in for-profit, non-profit, and professional and service organizations</li>'
            . '</ul>');
        $property->set_group('impact_4');
        $this->set_property($property);
    }

    public function get_education_level()
    {
        return $this->get_property('education_level')->get_value();
    }

    public function set_education_impact($value)
    {
        $property = new \Orm_Property_Textarea('education_impact', $value);
        $property->set_group('impact_4');
        $this->set_property($property);
    }

    public function get_education_impact()
    {
        return $this->get_property('education_impact')->get_value();
    }

    public function set_doctoral_education()
    {
        $property = new \Orm_Property_Fixedtext('doctoral_education', '<strong>DOCTORAL EDUCATION IMPACT</strong> <br/>'
            . '<ul>'
            . '<li>Hiring/placement of doctoral students, junior faculty, and post-doctoral research assistants</li>'
            . '<li>Publications of doctoral students and graduates</li>'
            . '<li>Invited conference attendance, as well as awards/nominations for doctoral students/graduates</li>'
            . '<li>Research fellowships awarded to doctoral students/graduates</li>'
            . '<li>Funding awards for students engaged in activities related to doctoral research</li>'
            . '<li>Case studies that document the results of doctoral research training activities, such as the transfer of knowledge to industry and impact on corporate or community practices</li>'
            . '<li>Research outputs of junior faculty members (including post-doctoral junior professors, assistant professors, doctoral research assistants, and doctoral students) that have been influenced by their mentors/supervisors</li>'
            . '</ul>');
        $property->set_group('impact_5');
        $this->set_property($property);
    }

    public function get_doctoral_education()
    {
        return $this->get_property('doctoral_education')->get_value();
    }

    public function set_doctoral_impact($value)
    {
        $property = new \Orm_Property_Textarea('doctoral_impact', $value);
        $property->set_group('impact_5');
        $this->set_property($property);
    }

    public function get_doctoral_impact()
    {
        return $this->get_property('doctoral_impact')->get_value();
    }

    public function set_practice()
    {
        $property = new \Orm_Property_Fixedtext('practice', '<strong>PRACTICE /COMMUNITY IMPACT</strong> <br/>'
            . '<ul>'
            . '<li>Media citations (e.g., number, distribution, and effect)</li>'
            . '<li>Requests from the practice community to utilize faculty expertise for consulting projects, broadcast forums, researcher-practitioner meetings, faculty/student consulting projects, etc.</li>'
            . '<li>Publications in practitioner journals or other venues aimed directly at improving management expertise and practice Consulting reports</li>'
            . '<li>Research income from various external sources such as industry and community/governmental agencies to support individual and collaborative research activities</li>'
            . '<li>Case studies based on research that has led to solutions to business problems</li>'
            . '<li>Adoption of new practices or operational approaches as a result of faculty scholarship</li>'
            . '<li>Presentations and workshops for business and management professionals</li>'
            . '<li>Invitations for faculty to serve as experts on policy formulation, witnesses at legislative hearings, members of special interest groups/roundtables, etc.</li>'
            . '<li>Tools/methods developed for companies</li>'
            . '<li>Memberships on boards of directors of corporate and non-profit organizations</li>'
            . '</ul>');
        $property->set_group('impact_6');
        $this->set_property($property);
    }

    public function get_practice()
    {
        return $this->get_property('practice')->get_value();
    }

    public function set_practice_impact($value)
    {
        $property = new \Orm_Property_Textarea('practice_impact', $value);
        $property->set_group('impact_6');
        $this->set_property($property);
    }

    public function get_practice_impact()
    {
        return $this->get_property('practice_impact')->get_value();
    }

    public function set_executive_education()
    {
        $property = new \Orm_Property_Fixedtext('executive_education', '<strong>EXECUTIVE EDUCATION IMPACT</strong> <br/>'
            . '<ul>'
            . '<li>Sustained and consistent involvement of research-active faculty in executive education programs</li>'
            . '<li>Sustained success of executive education programs based on demand, level of participation, and repeat business</li>'
            . '<li>Market research confirming value of executive education programs delivered by research-active faculty</li>'
            . '<li>Consulting activities of research active faculty that stem from participation in executive education activities</li>'
            . '<li>Inclusion of cases and other materials in degree programs that can be identified as resulting from executive education activity</li>'
            . '<li>Partnerships between the school and organizations that participate in executive education programs, which benefit the schools teaching, research, and other activities and programs</li>'
            . '<li>Involvement of executive education participants and their organizations in the teaching mission of the school (e.g., executive-in-residence program)</li>'
            . '<li>Linkage between organizations participating in executive education and student internships, as well as placement of graduates in entry-level positions</li>'
            . '</ul>');
        $property->set_group('impact_7');
        $this->set_property($property);
    }

    public function get_executive_education()
    {
        return $this->get_property('executive_education')->get_value();
    }

    public function set_executive_education_impact($value)
    {
        $property = new \Orm_Property_Textarea('executive_education_impact', $value);
        $property->set_group('impact_7');
        $this->set_property($property);
    }

    public function get_executive_education_impact()
    {
        return $this->get_property('executive_education_impact')->get_value();
    }

    public function set_research()
    {
        $property = new \Orm_Property_Fixedtext('research', '<strong>RESEARCH CENTER IMPACT</strong> <br/>'
            . '<ul>'
            . '<li>Invitations by governmental or other agencies/organizations for center representatives to serve on policy-making bodies</li>'
            . '<li>Center research projects funded by external governmental, business, or non-profit agencies</li>'
            . '<li>Continued funding (e.g., number of donors, scale of donations)</li>'
            . '<li>Number of web visits to research center website (e.g., tracking data from Google Analytics)</li>'
            . '<li>Number of attendees (representing academics, practitioners, policymakers, etc.) at center-sponsored events</li>'
            . '<li>Sustained research center publications that are funded by external sources or that are highly recognized as authoritative sources of analysis and perspectives related to the center’s core focus</li>'
            . '</ul>');
        $property->set_group('impact_8');
        $this->set_property($property);
    }

    public function get_research()
    {
        return $this->get_property('research')->get_value();
    }

    public function set_research_impact($value)
    {
        $property = new \Orm_Property_Textarea('research_impact', $value);
        $property->set_group('impact_8');
        $this->set_property($property);
    }

    public function get_research_impact()
    {
        return $this->get_property('research_impact')->get_value();
    }

}
