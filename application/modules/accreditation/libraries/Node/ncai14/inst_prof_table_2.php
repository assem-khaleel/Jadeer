<?php
/**
 * Created by PhpStorm.
 * User: ahmadgx
 * Date: 02/12/15
 * Time: 02:13 م
 */

namespace Node\ncai14;


class Inst_Prof_Table_2 extends \Orm_Node{

    protected $class_type = __CLASS__;
    protected $name = 'Table 2. Preparatory or Foundation Program';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;
    protected $link_send_to_review = true;
    protected $orientation = 'landscape';

    public function init()
    {
        parent::init();

        $this->set_table_2_note();
        $this->set_program_foundation(array());
        $this->set_note();
    }

    public function set_table_2_note(){
        $property = new \Orm_property_Fixedtext('table_2_note','<strong>*Full time equivalent (FTE) for faculty members: 1 FTE equals what MOE defines as a full-time load for faculty members.</strong>');
        $this->set_property($property);

    }
    public function get_table_2_note(){
        return $this->get_property('table_2_note')->get_value();
    }



    /*
     * program foundation
     */

    public function set_program_foundation($value)
    {
        $property = new \Orm_Property_Table_Dynamic('program_foundation', $value);
        $property->set_description('Table 2. Preparatory or Foundation Program1');
        $property->set_is_responsive(true);

        $stream_or_sections = new \Orm_Property_Text('stream_or_sections');
        $stream_or_sections->set_description('Streams or Sections');
        $stream_or_sections->set_width(100);
        $property->add_property($stream_or_sections);

        $male_student_saudi = new \Orm_Property_Text('male_student_saudi');
        $male_student_saudi->set_description('Saudi');
        $male_student_saudi->set_group('Male Students');
        $male_student_saudi->set_width(40);
        $property->add_property($male_student_saudi);

        $male_student_other = new \Orm_Property_Text('male_student_other');
        $male_student_other->set_description('others');
        $male_student_other->set_group('Male Students');
        $male_student_other->set_width(40);
        $property->add_property($male_student_other);

        $female_student_saudi= new \Orm_Property_Text('female_student_saudi');
        $female_student_saudi->set_description('Saudi');
        $female_student_saudi->set_group('Female Students');
        $female_student_saudi->set_width(40);
        $property->add_property($female_student_saudi);

        $female_student_other = new \Orm_Property_Text('female_student_other');
        $female_student_other->set_description('others');
        $female_student_other->set_group('Female Students');
        $female_student_other->set_width(40);
        $property->add_property($female_student_other);

        $total_student_saudi = new \Orm_Property_Text('total_student_saudi');
        $total_student_saudi->set_description('Saudi');
        $total_student_saudi->set_group('Total  Students');
        $total_student_saudi->set_width(40);
        $property->add_property($total_student_saudi);

        $total_student_other = new \Orm_Property_Text('total_student_other');
        $total_student_other->set_description('others');
        $total_student_other->set_group('Total  Students');
        $total_student_other->set_width(40);
        $property->add_property($total_student_other);

        $teaching_staff_m = new \Orm_Property_Text('teaching_staff_m');
        $teaching_staff_m->set_description('M');
        $teaching_staff_m->set_group('Number of full time equivalent teaching staff *');
        $teaching_staff_m->set_width(40);
        $property->add_property($teaching_staff_m);

        $teaching_staff_f = new \Orm_Property_Text('teaching_staff_f');
        $teaching_staff_f->set_description('F');
        $teaching_staff_f->set_group('Number of full time equivalent teaching staff *');
        $teaching_staff_f->set_width(40);
        $property->add_property($teaching_staff_f);

        $ratio_m = new \Orm_Property_Text('ratio_m');
        $ratio_m->set_description('M');
        $ratio_m->set_group('Student to Teaching Self Ratio');
        $ratio_m->set_width(40);
        $property->add_property($ratio_m);

        $ratio_f = new \Orm_Property_Text('ratio_f');
        $ratio_f->set_description('F');
        $ratio_f->set_group('Student to Teaching Self Ratio');
        $ratio_f->set_width(40);
        $property->add_property($ratio_f);

        $retention_rate_m = new \Orm_Property_Text('retention_rate_m');
        $retention_rate_m->set_description('M');
        $retention_rate_m->set_group('Retention Rate**');
        $retention_rate_m->set_width(40);
        $property->add_property($retention_rate_m);

        $retention_rate_f = new \Orm_Property_Text('retention_rate_f');
        $retention_rate_f->set_description('F');
        $retention_rate_f->set_group('Retention Rate**');
        $retention_rate_f->set_width(40);
        $property->add_property($retention_rate_f);

        $completion_rate_m = new \Orm_Property_Text('completion_rate_m');
        $completion_rate_m->set_description('M');
        $completion_rate_m->set_group('Completion Rate in Minimum Required Time***');
        $completion_rate_m->set_width(40);
        $property->add_property($completion_rate_m);

        $completion_rate_f = new \Orm_Property_Text('completion_rate_f');
        $completion_rate_f->set_description('F');
        $completion_rate_f->set_group('Completion Rate in Minimum Required Time***');
        $completion_rate_f->set_width(40);
        $property->add_property($completion_rate_f);


        $this->set_property($property);
    }

    public function get_program_foundation()
    {
        return $this->get_property('program_foundation')->get_value();
    }



    public function set_note(){
        $property = new \Orm_property_Fixedtext('note','1 Table A1 is to be completed once per campus/Institution.<br/><br/><strong>* Full time equivalent (FTE) of teaching staff:</strong>1 FTE equals what MOE defines as a full-time load for teaching staff.<br/><br/><strong> ** Preparatory Retention rate:</strong> is the percentage of an institution’s first-time, preparatory year program students who continue at that institution the following year (ie., 1 semester, 1 year, 3 semesters, 2 years).<br/><br/><strong>*** Preparatory Graduation rate:</strong>is the percentage of an institution’s first-time, preparatory year program students who complete their program within the published time for the program.<br/><br/><strong>Note:</strong>Teaching staff include teaching assistants, language instructors, lecturers, and assistant, associate and full professors. This does not include research or laboratory assistants. Academic staff who oversee the planning and delivery of teaching programs are included (e.g., head of department, dean for a college, rector and vice rectors).');
        $this->set_property($property);

    }
    public function get_note(){
        return $this->get_property('note')->get_value();
    }
    public function header_actions(&$actions = array()) {

        if (\Orm::get_ci()->config->item('integration_enabled')) {
            if ($this->check_if_editable()) {
                $actions[] = array(
                    'class' => 'btn',
                    'title' => '<i class="fa fa-database"></i> ' . lang('Integration'),
                    'extra' => 'onclick="integration(this, ' . $this->get_id() . ');" ' . data_loading_text(true) . ' title="Extraction of data from other modules"'
                );
            }
        }

        return parent::header_actions($actions);
    }

    public function integration_processes() {
        parent::integration_processes();

        if (\Orm::get_ci()->config->item('integration_enabled')) {
            $preparatory = \Orm_Data_Preparatory_Year::get_by_year($this->get_year());

            $data = array();
            foreach ($preparatory as $key => $item) {

                $faculty_male = \Orm_Data_Preparatory_Year_Faculty::get_one(array('stream' => $item['stream'],'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_MALE))->get_teacher_count();
                $faculty_female = \Orm_Data_Preparatory_Year_Faculty::get_one(array('stream' => $item['stream'],'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_FEMALE))->get_teacher_count();

                $total_male = $item['SAUDI_MALE'] + $item['NONESAUDI_MALE'];
                $total_female = $item['SAUDI_FEMALE'] + $item['NONESAUDI_FEMALE'];

                $data[$key]['stream_or_sections'] = $item['stream'];
                $data[$key]['male_student_saudi'] = $item['SAUDI_MALE'];
                $data[$key]['male_student_other'] = $item['NONESAUDI_MALE'];
                $data[$key]['female_student_saudi'] = $item['SAUDI_FEMALE'];
                $data[$key]['female_student_other'] = $item['NONESAUDI_FEMALE'];
                $data[$key]['total_student_saudi'] = $item['SAUDI_TOTAL'];
                $data[$key]['total_student_other'] = $item['NONESAUDI_TOTAL'];
                $data[$key]['teaching_staff_m'] = $faculty_male;
                $data[$key]['teaching_staff_f'] = $faculty_female;
                $data[$key]['ratio_m'] = ($faculty_male ? round($total_male / $faculty_male) : '0' ) . ' : ' . '1';
                $data[$key]['ratio_f'] = ($faculty_female ? round($total_female / $faculty_female) : '0' ) . ' : ' . '1';
                $data[$key]['retention_rate_m'] = round($item['COMPLETION_RATE_MALE'],2);
                $data[$key]['retention_rate_f'] = round($item['COMPLETION_RATE_FEMALE'],2);
                $data[$key]['completion_rate_m'] = round($item['COMPLETION_RATE_MALE'],2);
                $data[$key]['completion_rate_f'] = round($item['COMPLETION_RATE_FEMALE'],2);
            }

            $this->set_program_foundation($data);
            $this->save();
        }
    }
}