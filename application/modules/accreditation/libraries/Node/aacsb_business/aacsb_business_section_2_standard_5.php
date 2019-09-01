<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb_business;

/**
 * Description of aacsb_business_section_2_standard_5
 *
 * @author ahmadgx
 */
class Aacsb_Business_Section_2_Standard_5 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 5';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_standard_name('');
            $this->set_definition('');
            $this->set_school_criteria('');
            $this->set_division('');
            $this->set_faculty_complement('');
            $this->set_faculty_sufficient('');
            $this->set_achievement('');
    }

    public function set_standard_name()
    {
        $property = new \Orm_Property_Fixedtext('standard_name', "<b>The school maintains and deploys a faculty sufficient to ensure quality outcomes across the range of degree programs it offers and to achieve other components of its mission. Students in all programs, disciplines, locations, and delivery modes have the opportunity to receive instruction from appropriately qualified faculty. [FACULTY SUFFICIENCY AND DEPLOYMENT]</b>");
        $this->set_property($property);
    }

    public function get_standard_name()
    {
        return $this->get_property('standard_name')->get_value();
    }

    public function set_definition()
    {
        $property = new \Orm_Property_Fixedtext('definition', '<strong>Definitions</strong>'
            . '<ul><li>A participating faculty member actively and deeply engages in the activities of the school in matters beyond direct teaching responsibilities. Such matters might include policy decisions, advising, research, and service commitments. The faculty member may participate in the governance of the school and be eligible to serve as a member on appropriate committees responsible for academic policymaking and/or other decisions. The individual may participate in a variety of non-class activities such as directing an extracurricular activity, providing academic and career advising, and representing the school on institutional committees. Normally, the school considers participating faculty members to be long-term members of the faculty regardless of whether or not their appointments are of a full-time or part-time nature, whether or not their position with the school is considered the faculty member’s principal employment, and whether or not the school has tenure policies. The individual may be eligible for, and participate in, faculty development activities and have non-teaching assignments, such as advising, as appropriate to the faculty role the school has defined taking into consideration the depth and breadth of the non-teaching assignment.</li>'
            . '<li>A supporting faculty member does not, as a rule, participate in the intellectual or operational life of the school beyond the direct performance of teaching responsibilities. Usually, a supporting faculty member does not have deliberative or involvement rights on faculty issues, membership on faculty committees, or assigned responsibilities beyond direct teaching functions (e.g., classroom and office hours). Normally, a supporting faculty member’s appointment is on an ad hoc basis—for one term or one academic year without the expectation of continuation—and is exclusively for teaching responsibilities.</li>'
            . '</ul><br/><br/>'
            . '<strong>Basis for Judgment</strong>'
            . '<ul>'
            . '<li>A school adopts and applies criteria for documenting faculty members as "participating" or "supporting" that are consistent with its mission. The interpretive material in the standard provides guidance only. Each school should adapt this guidance to its particular situation and mission by developing and implementing criteria that indicate how the school is meeting the spirit and intent of the standard. The criteria should address:'
            . '<ul>'
            . '<li>The activities that are required to attain participating status.</li>'
            . '<li>The priority and value of different activity outcomes reflecting the mission and strategic management processes.</li>'
            . '<li>Quality standards required of each activity and how quality is assured.</li>'
            . '<li>The depth and breadth of activities expected within a typical AACSB accreditation review cycle to maintain participating status.</li>'
            . '</ul>'
            . 'The criteria should be periodically reviewed and reflect a focus on continuous improvement.</li>'
            . '<li>Depending on the teaching and learning models and associated division of labor across faculty and professional staff, the faculty is sufficient in numbers and presence to perform or oversee the following functions related to degree programs:'
            . '<ul>'
            . '<li>Curriculum development: A process exists to engage multidisciplinary expertise in the creation, monitoring, evaluation, and revision of curricula.</li>'
            . '<li>Course development: A process exists to engage content specialists in choosing and creating the learning goals, learning experiences, media, instructional materials, and learning assessments for each course, module, or session.</li>'
            . '<li>Course delivery: A process exists for ensuring access to instruction from appropriately qualified faculty and staff at the course level.</li>'
            . '<li>Assessment and assurance of learning: The obligations specified in the assurance of learning processes for the school are met.</li>'
            . '<li>Other activities that support the instructional goals of the schools mission.</li>'
            . '</ul></li>'
            . '<li>Faculty also should be sufficient to ensure achievement of all other mission activities. This includes high-quality and impactful intellectual contributions and, when applicable, executive education, community service, institutional service, service in academic organizations, service that supports economic development, organizational consulting, and other expectations the school holds for faculty members.</li>'
            . '<li>Normally, participating faculty members will deliver at least 75 percent of the schools teaching (whether measured by credit hours, contact hours, or another metric appropriate to the school).</li>'
            . '<li>Normally, participating faculty members will deliver at least 60 percent of the teaching in each discipline, academic program, location, and delivery mode.</li>'
            . '<li>Participating faculty are distributed across programs, disciplines, locations, and delivery modes consistent with the school’s mission.</li>'
            . '<li>If the school adopts a faculty model that relies on different levels of support or different means of deployment of faculty and professional staff for classroom instruction (e.g., senior faculty teaching large classes supported by a cadre of teaching assistants) the school must document how the model supports high-quality academic programs and meets the student-faculty interaction standard</li>'
            . '<li>In cases where a substantial proportion of a business school’s faculty resources hold primary faculty appointments with other institutions, the school must provide documentation of how this faculty model supports mission achievement, overall high quality, and continuous improvement and how this model is consistent with the spirit and intent of this standard. In particular, the school must show that the faculty model is consistent with achieving the research expectations of the school.</li>'
            . '</ul><br/><br/>'
            . '<strong>Guidance for Documentation</strong>');
        $this->set_property($property);
    }

    public function get_definition()
    {
        return $this->get_property('definition')->get_value();
    }

    public function set_school_criteria($value)
    {
        $property = new \Orm_Property_Textarea('school_criteria', $value);
        $property->set_description('Provide the school’s criteria for documenting faculty members as "participating" or "supporting" and demonstrate that it is applied consistently in ways that align with its mission.');
        $this->set_property($property);
    }

    public function get_school_criteria()
    {
        return $this->get_property('school_criteria')->get_value();
    }

    public function set_division($value)
    {
        $property = new \Orm_Property_Textarea('division', $value);
        $property->set_description('Describe the division of labor across faculty and professional staff for each of the teaching and learning models employed. The division of labor should address the design, delivery/facilitation, assessment, and improvement of degree programs.');
        $this->set_property($property);
    }

    public function get_division()
    {
        return $this->get_property('division')->get_value();
    }

    public function set_faculty_complement($value)
    {
        $property = new \Orm_Property_Textarea('faculty_complement', $value);
        $property->set_description('Describe the faculty complement available to fulfill the school’s mission and all instructional programs they staff in the most recently completed academic year.');
        $this->set_property($property);
    }

    public function get_faculty_complement()
    {
        return $this->get_property('faculty_complement')->get_value();
    }

    public function set_faculty_sufficient($value)
    {
        $property = new \Orm_Property_Textarea('faculty_sufficient', $value);
        $property->set_description('Demonstrate that the faculty is sufficient to fulfill the functions of curriculum development, course development, course delivery, and assurance of learning for degree programs in the context of the teaching and learning models employed and division of labor across faculty and professional staff.');
        $this->set_property($property);
    }

    public function get_faculty_sufficient()
    {
        return $this->get_property('faculty_sufficient')->get_value();
    }

    public function set_achievement($value)
    {
        $property = new \Orm_Property_Textarea('achievement', $value);
        $property->set_description('Demonstrate that the faculty complement is also sufficient to ensure achievement of all other mission activities. This includes high-quality and impactful intellectual contributions and, when applicable, executive education, community service, institutional service, service in academic organizations, service that supports economic development, organizational consulting, and other expectations the school holds for faculty members. It also could include academic assistance, academic advising, career advising, and other related activities if applicable to the school.');
        $this->set_property($property);
    }

    public function get_achievement()
    {
        return $this->get_property('achievement')->get_value();
    }

}
