<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb;

/**
 * Description of aacsb_appendix
 *
 * @author laith
 */
class Aacsb_Appendix extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'APPENDIX EXAMPLES OF IMPACT METRICS IN SUPPORT OF DOCUMENTATION';
    protected $link_pdf = true;
    protected $link_view = true;
    protected $link_edit = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_mission();
            $this->set_textarea1('');
            $this->set_academic_impact();
            $this->set_textarea2('');
            $this->set_teaching();
            $this->set_textarea3('');
            $this->set_bachelor();
            $this->set_textarea4('');
            $this->set_doctoral();
            $this->set_textarea5('');
            $this->set_practice();
            $this->set_textarea6('');
            $this->set_executive();
            $this->set_textarea7('');
            $this->set_research();
            $this->set_textarea8('');
    }

    /**
     * @return \Orm_Node[]
     */
    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'Examples of metrics that accounting academic units might use to assess the impact of their activities, including scholarship and the creation of intellectual contributions, are provided below. Some activities, including scholarship, may have multiple impacts, while others may have limited or no impact. Sometimes the impact of an activity or intellectual contribution may not be known or identifiable for a number of years. It is also important to note that evidence that intellectual contribution outcomes have “made a difference” may result from a single outcome produced by one or more faculty members and/or students, a series or compilations of works, or collaborative work with colleagues at other institutions or in practice. The categories and examples provided below are not intended to be limiting or exhaustive. Accounting academic units may identify or report other examples not listed below, including impact on constituencies such as society, community, business practitioners, students, alumni, etc. <br/> <br/>');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_mission()
    {
        $property = new \Orm_Property_Fixedtext('mission', '<strong>MISSION ALIGNMENT IMPACT</strong> <br/> <br/>'
            . '<ul type="circle">'
            . '<li>Alignment of intellectual contribution outcomes with themes or focus areas valued by the accounting academic unit’s mission (e.g., social justice, global development, and innovation)</li>'
            . '<li>Percentage of intellectual contribution outcomes that align with one or more “mission-related” focus areas for research</li>'
            . '<li>Percentage of faculty with one or more intellectual contribution outcomes that align with one or more mission-related focus areas</li>'
            . '<li>Research awards and recognition that document alignment with one or more “mission-related” focus areas for research</li>'
            . '<li>Substantive impact and carry-forward of mission as stated in Standard 1A and as referenced throughout the remaining accreditation standards</li>'
            . '<li>Linkage between mission as stated in Standard 1A and financial history and strategies as stated in Standard 3A</li>'
            . '</ul>');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_mission()
    {
        return $this->get_property('mission')->get_value();
    }

    public function set_textarea1($value)
    {
        $property = new \Orm_Property_Textarea('textarea1', $value);
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_textarea1()
    {
        return $this->get_property('textarea1')->get_value();
    }

    public function set_academic_impact()
    {
        $property = new \Orm_Property_Fixedtext('academic_impact', '<strong>ACADEMIC IMPACT</strong> <br/> <br/>'
            . '<ul type="circle">'
            . '<li>Publications in highly recognized, leading peer-review journals (a designated journal list, Top 3, Top 10, etc.)</li>'
            . '<li>Citation counts</li>'
            . '<li>Download counts for electronic journals</li>'
            . '<li>Editorships, associate editorships, editorial board memberships, and/or invitations to act as reviewers for recognized, leading peer-review journals</li>'
            . '<li>Elections or appointments to leadership positions in academic or professional associations and societies</li>'
            . '<li>Recognitions for research (e.g., Best Paper Award), Fellow Status in an academic society, and other recognition by professional or academic societies for intellectual contribution outcomes</li>'
            . '<li>Invitations to participate in research conferences, scholarly programs, or international, national, or regional research forums</li>'
            . '<li>Inclusion of academic work in the syllabi of other professors’ courses</li>'
            . '<li>Use of academic work in doctoral seminars</li>'
            . '<li>Competitive grants awarded by major national and international agencies (e.g., NSF and NIH) or third-party funding for research projects</li>'
            . '<li>Patents awarded</li>'
            . '<li>Appointments as visiting professors or scholars in other schools or a set of schools</li>'
            . '</ul>');
        $property->set_group('section_2');
        $this->set_property($property);
    }

    public function get_academic_impact()
    {
        return $this->get_property('academic_impact')->get_value();
    }

    public function set_textarea2($value)
    {
        $property = new \Orm_Property_Textarea('textarea2', $value);
        $property->set_group('section_2');
        $this->set_property($property);
    }

    public function get_textarea2()
    {
        return $this->get_property('textarea2')->get_value();
    }

    public function set_teaching()
    {
        $property = new \Orm_Property_Fixedtext('teaching', '<strong>TEACHING/INSTRUCTIONAL IMPACT</strong> <br/> <br/>'
            . '<ul type="circle">'
            . '<li>Grants for research that influence teaching/pedagogical practices, materials, etc.</li>'
            . '<li>Case studies of research leading to the adoption of new teaching/learning practices</li>'
            . '<li>Textbooks, teaching manuals, teaching materials, etc., that are widely adopted by peers and/or practitioners (by number of editions, number of downloads, number of views, use in teaching, sales volume, etc.)</li>'
            . '<li>Publications that focus on research methods and teaching</li>'
            . '<li>Research-based learning projects with companies, institutions, or non-profit organizations</li>'
            . '<li>Instructional software (by number of programs developed, number of users, etc.)</li>'
            . '<li>Case study development (by number of studies developed, number of users, etc.)</li>'
            . '</ul>');
        $property->set_group('section_3');
        $this->set_property($property);
    }

    public function get_teaching()
    {
        return $this->get_property('teaching')->get_value();
    }

    public function set_textarea3($value)
    {
        $property = new \Orm_Property_Textarea('textarea3', $value);
        $property->set_group('section_3');
        $this->set_property($property);
    }

    public function get_textarea3()
    {
        return $this->get_property('textarea3')->get_value();
    }

    public function set_bachelor()
    {
        $property = new \Orm_Property_Fixedtext('bachelor', '<strong>BACHELOR’S/MASTER’S LEVEL EDUCATION IMPACT</strong> <br/> <br/>'
            . '<ul type="circle">'
            . '<li>Mentorship of student research reflected in the number of student papers produced under faculty supervision that lead to publications or formal presentations at academic or professional conferences</li>'
            . '<li>Documented improvements in learning outcomes that result from teaching innovations that incorporate research methods from learning/pedagogical research projects</li>'
            . '<li>Hiring/placement of students</li>'
            . '<li>Career success of graduates beyond initial placement</li>'
            . '<li>Placement of students in research-based graduate programs</li>'
            . '<li>Direct input from organizations that hire graduates regarding graduates preparedness for jobs and the roles they play in advancing the organization</li>'
            . '<li>Movement of graduates into positions of leadership in for-profit, non-profit, and professional and service organizations</li>'
            . '</ul>');
        $property->set_group('section_4');
        $this->set_property($property);
    }

    public function get_bachelor()
    {
        return $this->get_property('bachelor')->get_value();
    }

    public function set_textarea4($value)
    {
        $property = new \Orm_Property_Textarea('textarea4', $value);
        $property->set_group('section_4');
        $this->set_property($property);
    }

    public function get_textarea4()
    {
        return $this->get_property('textarea4')->get_value();
    }

    public function set_doctoral()
    {
        $property = new \Orm_Property_Fixedtext('doctoral', '<strong>DOCTORAL EDUCATION IMPACT</strong> <br/> <br/>'
            . '<ul type="circle">'
            . '<li>Hiring/placement of doctoral students, junior faculty, and post-doctoral research assistants.</li>'
            . '<li>Publications of doctoral students and graduates</li>'
            . '<li>Invited conference attendance, as well as awards/nominations for doctoral students/graduates</li>'
            . '<li>Research fellowships awarded to doctoral students/graduates</li>'
            . '<li>Funding awards for students engaged in activities related to doctoral research</li>'
            . '<li>Case studies that document the results of doctoral research training activities, such as the transfer of knowledge to industry and impact on corporate or community practices</li>'
            . '<li>Research outputs of junior faculty members (including post-doctoral junior professors, assistant professors, doctoral research assistants, and doctoral students) that have been influenced by their mentors/supervisors</li>'
            . '</ul>');
        $property->set_group('section_5');
        $this->set_property($property);
    }

    public function get_doctoral()
    {
        return $this->get_property('doctoral')->get_value();
    }

    public function set_textarea5($value)
    {
        $property = new \Orm_Property_Textarea('textarea5', $value);
        $property->set_group('section_5');
        $this->set_property($property);
    }

    public function get_textarea5()
    {
        return $this->get_property('textarea5')->get_value();
    }

    public function set_practice()
    {
        $property = new \Orm_Property_Fixedtext('practice', '<strong>PRACTICE /COMMUNITY IMPACT</strong> <br/> <br/>'
            . '<ul type="circle">'
            . '<li>Media citations (number, distribution, and effect)</li>'
            . '<li>Requests from the practice community to utilize faculty expertise for consulting projects, broadcast forums, researcher-practitioner meetings, faculty/student consulting projects, etc.)</li>'
            . '<li>Development and delivery of training or continuing professional education materials</li>'
            . '<li>Publications in practitioner journals or other venues aimed directly at improving accounting and management expertise and practice</li>'
            . '<li>Consulting reports</li>'
            . '<li>Research income from various external sources such as industry and community/governmental agencies to support individual and collaborative research activities</li>'
            . '<li>Case studies based on research that has led to solutions to accounting and business problems</li>'
            . '<li>Adoption of new practices or operational approaches as a result of faculty scholarship</li>'
            . '<li>Presentations and workshops for accounting, business, and management professionals</li>'
            . '<li>Invitations for faculty to serve as experts on policy formulation, witnesses at legislative hearing, members of special interest groups/roundtables, etc.</li>'
            . '<li>Tools/methods developed for companies</li>'
            . '<li>Memberships on boards of directors of corporate and non-profit organizations</li>'
            . '</ul>');
        $property->set_group('section_6');
        $this->set_property($property);
    }

    public function get_practice()
    {
        return $this->get_property('practice')->get_value();
    }

    public function set_textarea6($value)
    {
        $property = new \Orm_Property_Textarea('textarea6', $value);
        $property->set_group('section_6');
        $this->set_property($property);
    }

    public function get_textarea6()
    {
        return $this->get_property('textarea6')->get_value();
    }

    public function set_executive()
    {
        $property = new \Orm_Property_Fixedtext('executive', '<strong>EXECUTIVE EDUCATION IMPACT</strong> <br/> <br/>'
            . '<ul type="circle">'
            . '<li>Sustained and consistent involvement of research-active faculty in executive education programs</li>'
            . '<li>Sustained success of executive education programs based on demand, level of participation, and repeat business</li>'
            . '<li>Market research confirming value of executive education programs delivered by research-active faculty</li>'
            . '<li>Consulting activities of research-active faculty that stem from participation in executive education activities</li>'
            . '<li>Inclusion of cases and other materials in degree programs that can be identified as resulting from executive education activity</li>'
            . '<li>Partnerships between the accounting academic unit and organizations that participate in executive education programs, which benefit the schools teaching, research, and other activities and programs</li>'
            . '<li>Involvement of executive education participants and their organizations in the teaching mission of the accounting academic unit (e.g., executive-in-residence program)</li>'
            . '<li>Linkage between organizations participating in executive education and student internships, as well as placement of graduates in entry-level positions</li>'
            . '</ul>');
        $property->set_group('section_7');
        $this->set_property($property);
    }

    public function get_executive()
    {
        return $this->get_property('executive')->get_value();
    }

    public function set_textarea7($value)
    {
        $property = new \Orm_Property_Textarea('textarea7', $value);
        $property->set_group('section_7');
        $this->set_property($property);
    }

    public function get_textarea7()
    {
        return $this->get_property('textarea7')->get_value();
    }

    public function set_research()
    {
        $property = new \Orm_Property_Fixedtext('research', '<strong>RESEARCH CENTER IMPACT</strong> <br/> <br/>'
            . '<ul type="circle">'
            . '<li>Invitations by governmental or other agencies/organizations for center representatives to serve on policy-making bodies</li>'
            . '<li>Center research projects funded by external governmental, or business, or non-profit agencies</li>'
            . '<li>Continued funding (e.g., number of donors, scale of donations)</li>'
            . '<li>Number of visits to research center website (e.g., tracking data from Google Analytics)</li>'
            . '<li>Number of attendees (representing academics, practitioners, policymakers, etc.) at center-sponsored events</li>'
            . '<li>Sustained research center publications that are funded by external sources or that are highly recognized as authoritative sources of analysis and perspectives related to the center’s core focus</li>'
            . '</ul>');
        $property->set_group('section_8');
        $this->set_property($property);
    }

    public function get_research()
    {
        return $this->get_property('research')->get_value();
    }

    public function set_textarea8($value)
    {
        $property = new \Orm_Property_Textarea('textarea8', $value);
        $property->set_group('section_8');
        $this->set_property($property);
    }

    public function get_textarea8()
    {
        return $this->get_property('textarea8')->get_value();
    }

}
