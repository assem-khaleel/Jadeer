<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb;

/**
 * Description of aacsb_section_2_accounting_units_participants_standard_a4
 *
 * @author laith
 */
class Aacsb_Section_2_Accounting_Units_Participants_Standard_A4 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard A4';
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
        $property = new \Orm_Property_Fixedtext('info', '<strong>The accounting academic unit maintains and deploys a faculty sufficient to ensure quality outcomes across the range of degree programs it offers and to achieve other components of its mission. Students in all programs, disciplines, and locations have the opportunity to receive instruction from appropriately qualified faculty. [ACCOUNTING FACULTY SUFFICIENCY AND DEPLOYMENT—RELATED BUSINESS STANDARD 5]</strong> <br/> <br/>'
            . '<strong>Definitions</strong> <br/>'
            . '<ul type="circle">'
            . '<li>A participating faculty member actively and deeply engages in the activities of the school in matters beyond direct teaching responsibilities. Such matters might include policy decisions, educational directions, advising, research, and service commitments. The faculty member may participate in the governance of the academic unit and or business school, and be eligible to serve as a member on appropriate committees responsible for academic policymaking and/or other decisions. The individual may participate in a variety of non-class activities such as directing extracurricular activities, providing academic and career advising, and representing the unit on institutional committees. Normally, the academic unit considers participating faculty members to be long-term members of the faculty regardless of whether or not their appointments are of a full-time or part-time nature, whether or not their position with the academic unit is considered the faculty member’s principal employment, and whether or not the unit has tenure policies. The individual may be eligible for, and participate in, faculty development activities and have non-teaching assignments, such as advising, as appropriate to the faculty role that the unit has defined taking into consideration the depth and breadth of the non-teaching assignment.</li>'
            . '<li>A supporting faculty member does not, as a rule, participate in the intellectual or operational life of the unit beyond the direct performance of teaching responsibilities. Usually, a supporting faculty member does not have deliberative or involvement rights on faculty issues, membership on faculty committees, or responsibilities beyond direct teaching functions (e.g., classroom and office hours). Normally, a supporting faculty member’s appointment is on an ad hoc basis—for one term or one academic year without the expectation of continuation—and is exclusively for teaching responsibilities.</li>'
            . '</ul>'
            . '<br/> <br/><strong>Basis for Judgment</strong> <br/>'
            . '<ul type="circle">'
            . '<li>TThe unit adopts and applies criteria for documenting faculty members as "participating" or "supporting" that are consistent with its mission. The interpretive material in the standard provides guidance only. The accounting academic unit should adapt this guidance to its particular situation and mission by developing and implementing criteria that indicate how the unit is meeting the spirit and intent of the standard. The criteria should address:'
            . '<ul>'
            . '<li>The activities that are required to attain participating status.</li>'
            . '<li>The priority and value of different activity outcomes reflecting the mission and strategic management processes.</li>'
            . '<li>The quality standards required of each activity and the ways in which quality isassured.</li>'
            . '<li>The depth and breadth of activities expected within a typical AACSB accreditation review cycle to maintain participating status.</li>'
            . '</ul></li>'
            . '<br/>The criteria should be periodically reviewed and reflect a focus on continuous improvement over time.'
            . '<li>Depending on the teaching/learning models and associated division of labor across faculty and professional staff, the faculty is sufficient in numbers and presence to perform or oversee the following functions related to degree programs:'
            . '<ul>'
            . '<li>Curriculum development: A process exists to engage multidisciplinary expertise in the creation, monitoring, evaluation, and revision of curricula.</li>'
            . '<li>Course development: A process exists to engage content, technology, and assessment specialists in choosing and creating the learning goals, learning experiences, media, instructional materials, and learning assessments for each course, module, or session</li>'
            . '<li> Course delivery: A process exists for ensuring access to instruction from appropriately qualified faculty and staff at the course level.</li>'
            . '<li>Assessment and assurance of learning: The obligations specified in the assurance of learning processes for the unit are met.</li>'
            . '<li>Other activities that support the instructional goals of the units mission.</li>'
            . '</ul></li>'
            . '<li>Faculty also should be sufficient to ensure achievement of all other mission activities. This includes high-quality and impactful intellectual contributions and, when applicable, executive education, community service, institutional service, service in academic organizations, service that supports economic development, organizational consulting, and other expectations the unit holds for faculty members.</li>'
            . '<li>Normally, participating faculty members will deliver at least 75 percent of the accounting academic unit’s teaching (whether measured by credit hours, contact hours, or another metric appropriate to the academic unit).</li>'
            . '<li>Normally, participating faculty members will deliver at least 60 percent of the teaching in each discipline, academic program, and location.</li>'
            . '<li>Participating faculty are distributed across programs, disciplines, and locations consistent with the academic unit’s mission.</li>'
            . '<li>If the academic unit adopts a faculty model that relies on different levels of support or different means of deployment of faculty and professional staff for classroom instruction (e.g., senior faculty teaching large classes supported by a cadre of teaching assistants) the unit must document how the model supports high-quality academic programs and meets the student-faculty interaction standard.</li>'
            . '<li>In cases where a substantial proportion of the academic unit’s faculty resources hold primary faculty appointments with other institutions, the unit must provide documentation of how this faculty model supports mission achievement, overall high quality, and continuous improvement and how this model is consistent with the spirit and intent of this standard. In particular, the unit must show that the faculty model is consistent with achieving its research expectations.</li>'
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
        $property->set_description('For Standards A4 and A9, an accounting academic unit may refer the peer review team to documentation included in support of Business Standards 5 and 15 for the business school accreditation review, if that documentation contains sufficient detail for the team to conduct an in-depth review of accounting faculty sufficiency and qualifications. If this is not the case, separate tables must be provided. Provide the academic unit’s criteria for documenting faculty members as "participating" or "supporting" and demonstrate that the criteria are applied consistently with its mission');
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
        $property->set_description('Describe the division of labor across faculty and professional staff for each of the teaching/learning models employed. The division of labor should address the design, delivery/facilitation, assessment, and improvement of degree programs.');
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
        $property->set_description('Describe the faculty complement available to fulfill the academic unit’s mission and all instructional programs for the most recently completed academic year.');
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
        $property->set_description('Demonstrate that the faculty is sufficient to fulfill the functions of curriculum development, course development, course delivery, and assurance of learning for degree programs in the context of the teaching/learning models employed and division of labor across faculty and professional staff.');
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
        $property->set_description('Demonstrate that the faculty complement is also sufficient to ensure achievement of all other mission activities. This includes high-quality and impactful intellectual contributions and, when applicable, executive education, community service, institutional service, academic organizational service, service that supports economic development, organizational consulting, and other expectations the unit holds for faculty members. It also could include academic assistance, academic advising, career advising, and other related activities if applicable to the academic unit.');
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
        $property->set_description('Table A9-1 should be completed to document the deployment of participating and supporting faculty for the most recently completed, normal academic year. Peer review teams may request documentation for additional years; for individual terms; or by program, location, and/or disciplines.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea6()
    {
        return $this->get_property('textarea6')->get_value();
    }

}
