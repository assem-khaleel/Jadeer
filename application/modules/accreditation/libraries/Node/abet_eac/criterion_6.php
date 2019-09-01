<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\abet_eac;

/**
 * Description of criterion_6
 *
 * @author ahmadgx
 */
class Criterion_6 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'CRITERION 6. FACULTY';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;
    protected $orientation = 'landscape';

    public function init()
    {
        parent::init();

            $this->set_faculty('');
            $this->set_program_name('');
            $this->set_faculty_qualifications(array());
            $this->set_faculty_qualifications_notes('');
            $this->set_faculty_vitae('');
            $this->set_faculty_workload('');
            $this->set_program_name_for_faculty('');
            $this->set_summary(array());
            $this->set_summary_note('');
            $this->set_faculty_size('');
            $this->set_faculty_size_discussion('');
            $this->set_professional_development('');
            $this->set_professional_development_details('');
            $this->set_authority('');
            $this->set_authority_faculty('');
    }

    public function set_faculty()
    {
        $property = new \Orm_Property_Fixedtext('faculty', '<b>A. Faculty Qualifications</b> <br/>'
            . 'Describe the qualifications of the faculty and how they are adequate to cover all the curricular areas of the program and also meet any applicable program criteria.  This description should include the composition, size, credentials, and experience of the faculty.  Complete Table 6-1.  Include faculty resumes in Appendix B. <br/>');
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_faculty()
    {
        return $this->get_property('faculty')->get_value();
    }

    public function set_program_name($value)
    {
        $property = new \Orm_Property_Text('program_name', $value);
        $property->set_description('Name of Program');
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_program_name()
    {
        return $this->get_property('program_name')->get_value();
    }

    public function set_faculty_qualifications($value)
    {
        $property = new \Orm_Property_Table_Dynamic('faculty_qualifications', $value);
        $property->set_description('Table 6-1.  Faculty Qualifications');
        $property->set_group('group_a');
        $property->set_is_responsive(true);

        $name = new \Orm_Property_Text('name');
        $name->set_description('Faculty Name');
        $name->set_width(200);
        $property->add_property($name);

        $degree = new \Orm_Property_Text('degree');
        $degree->set_description('Highest Degree Earned- Field and Year');
        $degree->set_width(200);
        $property->add_property($degree);

        $rank = new \Orm_Property_Text('rank');
        $rank->set_description('Rank (1)');
        $rank->set_width(200);
        $property->add_property($rank);

        $academin_appointment = new \Orm_Property_Text('academin_appointment');
        $academin_appointment->set_description('Type of Academic Appointment (2) T, TT, NTT');
        $academin_appointment->set_width(200);
        $property->add_property($academin_appointment);

        $full_or_part = new \Orm_Property_Radio('full_or_part');
        $full_or_part->set_description('FT or PT (3)');
        $full_or_part->set_options(array('FT', 'PT'));
        $full_or_part->set_width(200);
        $property->add_property($full_or_part);

        $practice = new \Orm_Property_Text('practice');
        $practice->set_description('Years of Experience (Govt./Ind. Practice)');
        $practice->set_width(200);
        $property->add_property($practice);

        $teaching = new \Orm_Property_Text('teaching');
        $teaching->set_description('Years of Experience (Teaching)');
        $teaching->set_width(200);
        $property->add_property($teaching);

        $institution = new \Orm_Property_Text('institution');
        $institution->set_description('Years of Experience (This Institution)');
        $institution->set_width(200);
        $property->add_property($institution);

        $registration = new \Orm_Property_Text('registration');
        $registration->set_description('Professional Registration/ Certification');
        $registration->set_width(200);
        $property->add_property($registration);

        $professional = new \Orm_Property_Text('professional');
        $professional->set_description('Level of Activity (4) H, M, or L (Professional Organizations)');
        $professional->set_width(200);
        $property->add_property($professional);

        $professional_development = new \Orm_Property_Text('professional_development');
        $professional_development->set_description('Level of Activity (4) H, M, or L (Professional Development)');
        $professional_development->set_width(200);
        $property->add_property($professional_development);


        $summer = new \Orm_Property_Text('summer');
        $summer->set_description('Level of Activity (4) H, M, or L (Consulting/summer work in industry)');
        $summer->set_width(200);
        $property->add_property($summer);


        $this->set_property($property);
    }

    public function get_faculty_qualifications()
    {
        return $this->get_property('faculty_qualifications')->get_value();
    }

    public function set_faculty_qualifications_notes()
    {
        $property = new \Orm_Property_Fixedtext('faculty_qualifications_notes', 'Instructions:  Complete table for each member of the faculty in the program.  Add additional rows or use additional sheets if necessary.  Updated information is to be provided at the time of the visit.'
            . '<ol type="1">'
            . '<li>Code:  P = Professor    ASC = Associate Professor   AST = Assistant Professor   I = Instructor   A = Adjunct   O = Other</li>'
            . '<li>Code:  TT = Tenure Track      T = Tenured      NTT = Non Tenure Track</li>'
            . '<li>At the institution</li>'
            . '<li>The level of activity, high, medium or low, should reflect an average over the year prior to the visit plus the two previous years</li>');
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_faculty_qualifications_notes()
    {
        return $this->get_property('faculty_qualifications_notes')->get_value();
    }

    public function set_faculty_vitae($value)
    {
        $property = new \Orm_Property_Textarea('faculty_vitae', $value);
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_faculty_vitae()
    {
        return $this->get_property('faculty_vitae')->get_value();
    }

    public function set_faculty_workload()
    {
        $property = new \Orm_Property_Fixedtext('faculty_workload', '<b>B. Faculty Workload</b> <br/>Complete Table 6-2, Faculty Workload Summary and describe this information in terms of workload expectations or requirements.');
        $property->set_group('group_b');
        $this->set_property($property);
    }

    public function get_faculty_workload()
    {
        return $this->get_property('faculty_workload')->get_value();
    }

    public function set_program_name_for_faculty($value)
    {
        $property = new \Orm_Property_Text('program_name_for_faculty', $value);
        $property->set_description('Name of Program');
        $property->set_group('group_b');
        $this->set_property($property);
    }

    public function get_program_name_for_faculty()
    {
        return $this->get_property('program_name_for_faculty')->get_value();
    }

    public function set_summary($value)
    {
        $property = new \Orm_Property_Table_Dynamic('summary', $value);
        $property->set_description('Table 6-2.  Faculty Workload Summary');
        $property->set_group('group_b');
        $property->set_is_responsive(true);

        $name = new \Orm_Property_Text('name');
        $name->set_description('Faculty Member (name)');
        $name->set_width(200);
        $property->add_property($name);

        $time = new \Orm_Property_Radio('time');
        $time->set_options(array('PT', 'FT'));
        $time->set_description('PT or FT( 1)');
        $time->set_width(200);
        $property->add_property($time);

        $classes = new \Orm_Property_Textarea('classes');
        $classes->set_description('Classes Taught (Course No./Credit Hrs.) Term and Year (2)');
        $classes->set_width(500);
        $classes->set_enable_tinymce(0);
        $property->add_property($classes);

        $teaching = new \Orm_Property_Text('teaching');
        $teaching->set_description('Program Activity Distribution (3) (Teaching)');
        $teaching->set_width(200);
        $property->add_property($teaching);

        $research = new \Orm_Property_Text('research');
        $research->set_description('Program Activity Distribution (3) (Research or Scholarship)');
        $research->set_width(200);
        $property->add_property($research);

        $other = new \Orm_Property_Text('other');
        $other->set_description('Program Activity Distribution (3) (Other (4))');
        $other->set_width(200);
        $property->add_property($other);

        $percent = new \Orm_Property_Percentage('percent');
        $percent->set_description('% of Time Devoted to the Program (5)');
        $percent->set_width(200);
        $property->add_property($percent);

        $this->set_property($property);
    }

    public function get_summary()
    {
        return $this->get_property('summary')->get_value();
    }

    public function set_summary_note()
    {
        $property = new \Orm_Property_Fixedtext('summary_note', '<ol type="1">'
            . '<li>FT = Full Time Faculty or PT = Part Time Faculty, at the institution</li>'
            . '<li>For the academic year for which the Self-Study Report is being prepared.</li>'
            . '<li>Program activity distribution should be in percent of effort in the program and should total 100%.</li>'
            . '<li>Indicate sabbatical leave, etc., under "Other."</li>'
            . '<li>Out of the total time employed at the institution.</li>'
            . '</ol>');
        $property->set_group('group_b');
        $this->set_property($property);
    }

    public function get_summary_note()
    {
        return $this->get_property('summary_note')->get_value();
    }

    public function set_faculty_size()
    {
        $property = new \Orm_Property_Fixedtext('faculty_size', '<b>C. Faculty Size</b>');
        $property->set_group('group_c');
        $this->set_property($property);
    }

    public function get_faculty_size()
    {
        return $this->get_property('faculty_size')->get_value();
    }

    public function set_faculty_size_discussion($value)
    {
        $property = new \Orm_Property_Textarea('faculty_size_discussion', $value);
        $property->set_description('Discuss the adequacy of the size of the faculty and describe the extent and quality of faculty involvement in interactions with students, student advising and counseling, university service activities, professional development, and interactions with industrial and professional practitioners including employers of students.');
        $property->set_group('group_c');
        $this->set_property($property);
    }

    public function get_faculty_size_discussion()
    {
        return $this->get_property('faculty_size_discussion')->get_value();
    }

    public function set_professional_development()
    {
        $property = new \Orm_Property_Fixedtext('professional_development', '<b>D. Professional Development</b>');
        $property->set_group('group_d');
        $this->set_property($property);
    }

    public function get_professional_development()
    {
        return $this->get_property('professional_development')->get_value();
    }

    public function set_professional_development_details($value)
    {
        $property = new \Orm_Property_Textarea('professional_development_details', $value);
        $property->set_description('Provide detailed descriptions of professional development activities for each faculty member.');
        $property->set_group('group_d');
        $this->set_property($property);
    }

    public function get_professional_development_details()
    {
        return $this->get_property('professional_development_details')->get_value();
    }

    public function set_authority()
    {
        $property = new \Orm_Property_Fixedtext('authority', '<b>E. Authority and Responsibility of Faculty</b>');
        $property->set_group('group_e');
        $this->set_property($property);
    }

    public function get_authority()
    {
        return $this->get_property('authority')->get_value();
    }

    public function set_authority_faculty($value)
    {
        $property = new \Orm_Property_Textarea('authority_faculty', $value);
        $property->set_description('Describe the role played by the faculty with respect to course creation, modification, and evaluation, their role in the definition and revision of program educational objectives and student outcomes, and their role in the attainment of the student outcomes.  Describe the roles of others on campus, e.g., dean or provost, with respect to these areas.');
        $property->set_group('group_e');
        $this->set_property($property);
    }

    public function get_authority_faculty()
    {
        return $this->get_property('authority_faculty')->get_value();
    }

    public function after_node_load()
    {
        parent::after_node_load();

        $program_node = $this->get_parent_program_node();
        if (!is_null($program_node) && $program_node->get_id()) {
            $program_obj = $program_node->get_item_obj();

            $this->set_program_name($program_obj->get_name('english'));
            $this->set_program_name_for_faculty($program_obj->get_name('english'));
        }
    }

}
