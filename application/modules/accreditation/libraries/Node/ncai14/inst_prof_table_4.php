<?php
/**
 * Created by PhpStorm.
 * User: ahmadgx
 * Date: 02/12/15
 * Time: 02:21 م
 */

namespace Node\ncai14;


class Inst_Prof_Table_4 extends \Orm_Node{

    protected $class_type = __CLASS__;
    protected $name = "Table 4. Summary of Programs' Teaching Staff";
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;
    protected $link_send_to_review = true;
    protected $orientation = 'landscape';

    public function init()
    {
        parent::init();

        $this->set_teaching_staff(array());
        $this->set_teaching_staff_note();
    }
    /*
    * Table 4. Summary of Programs' Teaching Staff
    */

    public function set_teaching_staff($value)
    {
        $property = new \Orm_Property_Table_Dynamic('teaching_staff', $value);
        $property->set_is_responsive(true);

        $program_name = new \Orm_Property_Text('program_name');
        $program_name->set_description('Program Name');
        $program_name->set_width(60);
        $property->add_property($program_name);

        $professor_m_ft = new \Orm_Property_Text('professor_m_ft');
        $professor_m_ft->set_description('FT');
        $professor_m_ft->set_group('Professor (M)');
        $professor_m_ft->set_width(40);
        $property->add_property($professor_m_ft);

        $professor_m_pt = new \Orm_Property_Text('professor_m_pt');
        $professor_m_pt->set_description('PT');
        $professor_m_pt->set_group('Professor (M)');
        $professor_m_pt->set_width(40);
        $property->add_property($professor_m_pt);

        $professor_f_ft = new \Orm_Property_Text('professor_f_ft');
        $professor_f_ft->set_description('FT');
        $professor_f_ft->set_group('Professor (F)');
        $professor_f_ft->set_width(40);
        $property->add_property($professor_f_ft);

        $professor_f_pt = new \Orm_Property_Text('professor_f_pt');
        $professor_f_pt->set_description('PT');
        $professor_f_pt->set_group('Professor (F)');
        $professor_f_pt->set_width(40);
        $property->add_property($professor_f_pt);

        $associate_professor_m_ft = new \Orm_Property_Text('associate_professor_m_ft');
        $associate_professor_m_ft->set_description('FT');
        $associate_professor_m_ft->set_group('Associate Professor (M)');
        $associate_professor_m_ft->set_width(40);
        $property->add_property($associate_professor_m_ft);

        $associate_professor_m_pt = new \Orm_Property_Text('associate_professor_m_pt');
        $associate_professor_m_pt->set_description('PT');
        $associate_professor_m_pt->set_group('Associate Professor (M)');
        $associate_professor_m_pt->set_width(40);
        $property->add_property($associate_professor_m_pt);

        $associate_professor_f_ft = new \Orm_Property_Text('associate_professor_f_ft');
        $associate_professor_f_ft->set_description('FT');
        $associate_professor_f_ft->set_group('Associate Professor (F)');
        $associate_professor_f_ft->set_width(40);
        $property->add_property($associate_professor_f_ft);

        $associate_professor_f_pt = new \Orm_Property_Text('associate_professor_f_pt');
        $associate_professor_f_pt->set_description('PT');
        $associate_professor_f_pt->set_group('Associate Professor (F)');
        $associate_professor_f_pt->set_width(40);
        $property->add_property($associate_professor_f_pt);

        $assistant_professor_m_ft = new \Orm_Property_Text('assistant_professor_m_ft');
        $assistant_professor_m_ft->set_description('FT');
        $assistant_professor_m_ft->set_group('Assistant Professor (M)');
        $assistant_professor_m_ft->set_width(40);
        $property->add_property($assistant_professor_m_ft);

        $assistant_professor_m_pt = new \Orm_Property_Text('assistant_professor_m_pt');
        $assistant_professor_m_pt->set_description('PT');
        $assistant_professor_m_pt->set_group('Assistant Professor (M)');
        $assistant_professor_m_pt->set_width(40);
        $property->add_property($assistant_professor_m_pt);

        $assistant_professor_f_ft = new \Orm_Property_Text('assistant_professor_f_ft');
        $assistant_professor_f_ft->set_description('FT');
        $assistant_professor_f_ft->set_group('Assistant Professor (F)');
        $assistant_professor_f_ft->set_width(40);
        $property->add_property($assistant_professor_f_ft);

        $assistant_professor_f_pt = new \Orm_Property_Text('assistant_professor_f_pt');
        $assistant_professor_f_pt->set_description('PT');
        $assistant_professor_f_pt->set_group('Assistant Professor (F)');
        $assistant_professor_f_pt->set_width(40);
        $property->add_property($assistant_professor_f_pt);

        $lecture_m_ft = new \Orm_Property_Text('lecture_m_ft');
        $lecture_m_ft->set_description('FT');
        $lecture_m_ft->set_group('Lecturer (M)');
        $lecture_m_ft->set_width(40);
        $property->add_property($lecture_m_ft);

        $lecture_m_pt = new \Orm_Property_Text('lecture_m_pt');
        $lecture_m_pt->set_description('PT');
        $lecture_m_pt->set_group('Lecturer (M)');
        $lecture_m_pt->set_width(40);
        $property->add_property($lecture_m_pt);

        $lecture_f_ft = new \Orm_Property_Text('lecture_f_ft');
        $lecture_f_ft->set_description('FT');
        $lecture_f_ft->set_group('Lecturer (F)');
        $lecture_f_ft->set_width(40);
        $property->add_property($lecture_f_ft);

        $lecture_f_pt = new \Orm_Property_Text('lecture_f_pt');
        $lecture_f_pt->set_description('PT');
        $lecture_f_pt->set_group('Lecturer (F)');
        $lecture_f_pt->set_width(40);
        $property->add_property($lecture_f_pt);

        $teaching_m_ft = new \Orm_Property_Text('teaching_m_ft');
        $teaching_m_ft->set_description('FT');
        $teaching_m_ft->set_group('Teaching Assistants / Language Instructors (M)');
        $teaching_m_ft->set_width(40);
        $property->add_property($teaching_m_ft);

        $teaching_m_pt = new \Orm_Property_Text('teaching_m_pt');
        $teaching_m_pt->set_description('PT');
        $teaching_m_pt->set_group('Teaching Assistants / Language Instructors (M)');
        $teaching_m_pt->set_width(40);
        $property->add_property($teaching_m_pt);

        $teaching_f_ft = new \Orm_Property_Text('teaching_f_ft');
        $teaching_f_ft->set_description('FT');
        $teaching_f_ft->set_group('Teaching Assistants / Language Instructors (F)');
        $teaching_f_ft->set_width(40);
        $property->add_property($teaching_f_ft);

        $teaching_f_pt = new \Orm_Property_Text('teaching_f_pt');
        $teaching_f_pt->set_description('PT');
        $teaching_f_pt->set_group('Teaching Assistants / Language Instructors (F)');
        $teaching_f_pt->set_width(40);
        $property->add_property($teaching_f_pt);

        $total_f = new \Orm_Property_Text('total_f');
        $total_f->set_description('F');
        $total_f->set_group('Total');
        $total_f->set_width(40);
        $property->add_property($total_f);

        $total_m = new \Orm_Property_Text('total_m');
        $total_m->set_description('M');
        $total_m->set_group('Total');
        $total_m->set_width(40);
        $property->add_property($total_m);

        $this->set_property($property);
    }

    public function get_teaching_staff()
    {
        return $this->get_property('teaching_staff')->get_value();
    }

    public function set_teaching_staff_note(){
        $property = new \Orm_Property_Fixedtext('teaching_staff_note', '<strong>'
            . '<ul>'
            . '<li>FT: Full time</li>'
            . '<li>PT: Part time</li>'
            . '</ul>'
            . '</strong>');
        $this->set_property($property);
    }

    public function get_teaching_staff_note(){
        return $this->get_property('teaching_staff_note')->get_value();
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
            $table_4 = array();
            foreach (\Orm_Data_Faculty::get_all(array(),0,0,array('college_id')) as $faculty_count) {
                $table_4[] = array(
                    'program_name' => $faculty_count->get_program_obj()->get_name('english'),
                    'professor_m_ft' => $faculty_count->get_prof_male(),
                    'professor_m_pt' => 0,
                    'professor_f_ft' => $faculty_count->get_prof_female(),
                    'professor_f_pt' => 0,
                    'associate_professor_m_ft' => $faculty_count->get_associate_prof_male(),
                    'associate_professor_m_pt' => 0,
                    'associate_professor_f_ft' => $faculty_count->get_associate_prof_female(),
                    'associate_professor_f_pt' => 0,
                    'assistant_professor_m_ft' => $faculty_count->get_assistant_prof_male(),
                    'assistant_professor_m_pt' => 0,
                    'assistant_professor_f_ft' => $faculty_count->get_assistant_prof_female(),
                    'assistant_professor_f_pt' => 0,
                    'lecture_m_ft' => $faculty_count->get_instructor_male(),
                    'lecture_m_pt' => 0,
                    'lecture_f_ft' => $faculty_count->get_instructor_female(),
                    'lecture_f_pt' => 0,
                    'teaching_m_ft' => $faculty_count->get_teaching_assistant_male(),
                    'teaching_m_pt' => 0,
                    'teaching_f_ft' => $faculty_count->get_teaching_assistant_female(),
                    'teaching_f_pt' => 0,
                    'total_m' => $faculty_count->get_total(),
                    'total_f' => 0
                );
            }
            $this->set_teaching_staff($table_4);
            $this->save();
        }
    }

}