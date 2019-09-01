<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_2_sub_b_standard10
 *
 * @author ahmadgx
 */
class Acpe_Section_2_Sub_B_Standard10 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 10: Curriculum Design, Delivery, and Oversight';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_curriculum_design('');
            $this->set_key('');
            $this->set_program_duration('');
            $this->set_curricular_oversight('');
            $this->set_knowledge('');
            $this->set_skill_development('');
            $this->set_professional_attitude('');
            $this->set_faculty('');
            $this->set_breadth_and_depth('');
            $this->set_patient_care_process('');
            $this->set_electives('');
            $this->set_feedback('');
            $this->set_curriculum_review('');
            $this->set_teaching_method('');
            $this->set_diverse('');
            $this->set_course_syllabi('');
            $this->set_quality_assurance('');
            $this->set_employment('');
            $this->set_academic_integrity('');
    }

    public function set_curriculum_design()
    {
        $property = new \Orm_Property_Fixedtext('curriculum_design', 'The curriculum is designed, delivered, and monitored by faculty to ensure breadth and depth of requisite knowledge and skills, the maturation of professional attitudes and behaviors, and the'
            . 'opportunity to explore professional areas of interest. The curriculum also emphasizes active learning pedagogy, content integration, knowledge acquisition, skill development, and the application of knowledge and skills to therapeutic decision-making.');
        $this->set_property($property);
    }

    public function get_curriculum_design()
    {
        return $this->get_property('curriculum_design')->get_value();
    }

    public function set_key()
    {
        $property = new \Orm_Property_Fixedtext('key', '<b>Key Element:</b>');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_key()
    {
        return $this->get_property('key')->get_value();
    }

    public function set_program_duration($value)
    {
        $property = new \Orm_Property_Textarea('program_duration', $value);
        $property->set_description('10.1. Program duration – The professional curriculum is a minimum of four academic years of full-time study or the equivalent.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_program_duration()
    {
        return $this->get_property('program_duration')->get_value();
    }

    public function set_curricular_oversight($value)
    {
        $property = new \Orm_Property_Textarea('curricular_oversight', $value);
        $property->set_description('10.2. Curricular oversight – Curricular oversight involves collaboration between faculty and administration. The body/bodies charged with curricular oversight: (1) are representative of the faculty at large, (2) include student representation, (3) effectively communicate and coordinate efforts with body/bodies responsible for curricular assessment, and (4) are adequately resourced to ensure and continually advance curricular quality.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_curricular_oversight()
    {
        return $this->get_property('curricular_oversight')->get_value();
    }

    public function set_knowledge($value)
    {
        $property = new \Orm_Property_Textarea('knowledge', $value);
        $property->set_description('10.3. Knowledge application – Curricular expectations build on a pre-professional foundation of scientific and liberal studies. The professional curriculum is organized to allow for the logical building of a sound scientific and clinical knowledge base that culminates in the demonstrated ability of learners to apply knowledge to practice.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_knowledge()
    {
        return $this->get_property('knowledge')->get_value();
    }

    public function set_skill_development($value)
    {
        $property = new \Orm_Property_Textarea('skill_development', $value);
        $property->set_description('10.4. Skill development – The curriculum is rigorous, contemporary, and intentionally sequenced to promote integration and reinforcement of content and the demonstration of competency in skills required to achieve the Educational Outcomes articulated in Section I.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_skill_development()
    {
        return $this->get_property('skill_development')->get_value();
    }

    public function set_professional_attitude($value)
    {
        $property = new \Orm_Property_Textarea('professional_attitude', $value);
        $property->set_description('10.5. Professional attitudes and behaviors development – The curriculum inculcates professional attitudes and behaviors leading to personal and professional maturity consistent with the Oath of the Pharmacist.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_professional_attitude()
    {
        return $this->get_property('professional_attitude')->get_value();
    }

    public function set_faculty($value)
    {
        $property = new \Orm_Property_Textarea('faculty', $value);
        $property->set_description('10.6. Faculty and preceptor credentials/expertise – All courses in the curriculum are taught by individuals with academic credentials and expertise that are explicitly linked to their teaching responsibilities.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_faculty()
    {
        return $this->get_property('faculty')->get_value();
    }

    public function set_breadth_and_depth($value)
    {
        $property = new \Orm_Property_Textarea('breadth_and_depth', $value);
        $property->set_description('10.7. Content breadth and depth – Programs document, through mapping or other comparable methods, the breadth and depth of exposure to curricular content areas deemed essential to pharmacy education at the doctoral level (Appendices 1 and 2).');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_breadth_and_depth()
    {
        return $this->get_property('breadth_and_depth')->get_value();
    }

    public function set_patient_care_process($value)
    {
        $property = new \Orm_Property_Textarea('patient_care_process', $value);
        $property->set_description('10.8. Pharmacists’ Patient Care Process – The curriculum prepares students to provide patient-centered collaborative care as described in the Pharmacists’ Patient Care Process model endorsed by the Joint Commission of Pharmacy Practitioners.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_patient_care_process()
    {
        return $this->get_property('patient_care_process')->get_value();
    }

    public function set_electives($value)
    {
        $property = new \Orm_Property_Textarea('electives', $value);
        $property->set_description('10.9. Electives – Time is reserved within the core curriculum for elective didactic and experiential education courses that permit exploration of and/or advanced study in areas of professional interest.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_electives()
    {
        return $this->get_property('electives')->get_value();
    }

    public function set_feedback($value)
    {
        $property = new \Orm_Property_Textarea('feedback', $value);
        $property->set_description('10.10. Feedback – The curriculum allows for timely, formative performance feedback to students in both didactic and experiential education courses. Students are also provided the opportunity to give formative and/or summative feedback to faculty, including preceptors, on their perceptions of teaching/learning effectiveness.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_feedback()
    {
        return $this->get_property('feedback')->get_value();
    }

    public function set_curriculum_review($value)
    {
        $property = new \Orm_Property_Textarea('curriculum_review', $value);
        $property->set_description('10.11. Curriculum review and quality assurance – Curriculum design, delivery, and sequencing are regularly reviewed and, when appropriate, revised by program faculty to ensure optimal achievement of educational outcomes with reasonable student workload expectations.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_curriculum_review()
    {
        return $this->get_property('curriculum_review')->get_value();
    }

    public function set_teaching_method($value)
    {
        $property = new \Orm_Property_Textarea('teaching_method', $value);
        $property->set_description('10.12. Teaching and learning methods – The didactic curriculum is delivered via teaching/learning methods that: (1) facilitate achievement of learning outcomes, (2) actively engage learners, (3) promote student responsibility for self-directed learning, (4) foster collaborative learning, and (5) are appropriate for the student population (i.e., campus-based vs. distance-based).');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_teaching_method()
    {
        return $this->get_property('teaching_method')->get_value();
    }

    public function set_diverse($value)
    {
        $property = new \Orm_Property_Textarea('diverse', $value);
        $property->set_description('10.13. Diverse learners – The didactic curriculum incorporates teaching techniques and strategies that address the diverse learning needs of students.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_diverse()
    {
        return $this->get_property('diverse')->get_value();
    }

    public function set_course_syllabi($value)
    {
        $property = new \Orm_Property_Upload('course_syllabi', $value);
        $property->set_description('10.14. Course syllabi – Syllabi for didactic and experiential education courses, developed and updated through a faculty-approved process, contain information that supports curricular quality assurance assessment.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_course_syllabi()
    {
        return $this->get_property('course_syllabi')->get_value();
    }

    public function set_quality_assurance($value)
    {
        $property = new \Orm_Property_Textarea('quality_assurance', $value);
        $property->set_description('10.15. Experiential quality assurance – A quality assurance procedure for all pharmacy practice experiences is established and implemented to: (1) facilitate achievement of stated course expectations, (2) standardize key components of experiences across all sites offering the same experiential course, and (3) promote consistent assessment of student performance.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_quality_assurance()
    {
        return $this->get_property('quality_assurance')->get_value();
    }

    public function set_employment($value)
    {
        $property = new \Orm_Property_Textarea('employment', $value);
        $property->set_description('10.16. Remuneration/employment – Students do not receive payment for participating in curricular pharmacy practice experiences, nor are they placed in the specific practice area within a pharmacy practice site where they are currently employed.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_employment()
    {
        return $this->get_property('employment')->get_value();
    }

    public function set_academic_integrity($value)
    {
        $property = new \Orm_Property_Textarea('academic_integrity', $value);
        $property->set_description('10.17. Academic integrity* – To ensure the credibility of the degree awarded, the validity of individual student assessments, and the integrity of student work, the college or school ensures that assignments and examinations take place under circumstances that minimize opportunities for academic misconduct. The college or school ensures the correct identity of all students (including distance students) completing proctored assessments.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_academic_integrity()
    {
        return $this->get_property('academic_integrity')->get_value();
    }

}
