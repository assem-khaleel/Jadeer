<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 05/07/18
 * Time: 11:04 ص
 */

namespace Node\ncacm18;


class  Course_Report extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $code = 'Course_Report';
    protected $name = 'Course Report (CR)';
    protected $link_pdf = true;
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_send_to_review = true;

    function init()
    {
        parent::init();

        $this->set_course_report();
        $this->set_institution('');
        $this->set_date_of_course_report('');
        $this->set_college('');
        $this->set_department('');
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {
        $childrens = array();
        $childrens[] = new Course_Report_A();
        $childrens[] = new Course_Report_B();
        $childrens[] = new Course_Report_C();
        $childrens[] = new Course_Report_D();
        $childrens[] = new Course_Report_E();
        $childrens[] = new Course_Report_F();
        $childrens[] = new Course_Report_G();
        $childrens[] = new Course_Report_H();
        $childrens[] = new signature();



        return $childrens;
    }

    public function set_course_report()
    {
        $property = new \Orm_Property_Fixedtext('course_report', '<div style="border: 1px solid black; padding: 6px;">A separate Course Report (CR) should be submitted for every course and for each section or campus location where the course is taught, even if the course is taught by the same person. Each CR is to be completed by the course instructor at the end of each course and given to the program coordinator <br/>A combined, comprehensive CR should be prepared by the course coordinator and the separate location reports are to be attached.'
            . '</div> <br/><strong>Course Report</strong> <br/>For guidance on the completion of this template refer to the  EEC-HES handbooks.');
        $this->set_property($property);
    }

    public function get_course_report()
    {
        return $this->get_property('course_report')->get_value();
    }

    public function set_institution($value)
    {
        $property = new \Orm_Property_Text('institution', $value);
        $property->set_description("Institution");
        $this->set_property($property);
    }

    public function get_institution()
    {
        return $this->get_property('institution')->get_value();
    }

    public function set_date_of_course_report($value)
    {
        $property = new \Orm_Property_Text('date_of_course_report', $value);
        $property->set_description("Date of CR");
        $this->set_property($property);
    }

    public function get_date_of_course_report()
    {
        return $this->get_property('date_of_course_report')->get_value();
    }

    public function set_college($value)
    {
        $property = new \Orm_Property_Text('college', $value);
        $property->set_description('College ');
        $this->set_property($property);
    }

    public function get_college()
    {
        return $this->get_property('college')->get_value();
    }
    public function set_department($value)
    {
        $property = new \Orm_Property_Text('department', $value);
        $property->set_description('Department');
        $this->set_property($property);
    }

    public function get_department()
    {
        return $this->get_property('department')->get_value();
    }


    public function get_pdf_cover()
    {

        /** @var \Orm_Course $course */
        $course=$this->get_parent_course_node()->get_item_obj();

        /** @var \Orm_Semester $semester */
        $semester = $this->get_system_obj()->get_item_obj();

        $img = base_url(\Orm_Institution::get_instance()->get_univ_logo());
        if (file_exists(\Orm_Institution::get_instance()->get_pr_cover())) {
            $img = base_url(\Orm_Institution::get_instance()->get_pr_cover());
        }
        $programs_mapped = \Orm_Program_Plan::get_all(array('course_id'=>$course->get_id()));


        $cover = '<html>';
        $cover .= '<head>';
        $cover .= '<meta charset="utf-8">';
        $cover .= '</head>';
        $cover .= '<body style="padding:100px 0;">';
        $cover .= '<img src="' . $img . '" style="display: block; margin-left:auto; margin-right:auto; width:300px; height:200px">';
        $cover .= '<h1 style="display:block; position: relative; overflow: auto; text-align: center; color:#005c34">Course Report (CR)</h1>';
        $cover .= '<div style="padding:20px 0; display:block; position: relative; overflow: auto; text-align: center; font-family: \'Open Sans\', sans-serif; font-weight:bold; font-size: 16pt;">';
        $cover .= '<table style="border:4px solid #4e642e; width:55%; margin-left: auto;margin-right: auto; padding: 5px 5px;font-weight:bold; font-size: 15pt;">';
        $cover .= '<tr>';
        $cover .= '<td style="width: 40%"> Course Title: </td>';
        $cover .= '<td style="width: 60%">' . $course->get_name('english') . '</td>';
        $cover .= '</tr>';
        $cover .= '<tr>';
        $cover .= '<td style="width: 40%"> Code:</td>';
        $cover .= '<td style="width: 60%">' . $course->get_code('english') . '</td>';
        $cover .= '</tr>';
        $cover .= '<tr>';
        $cover .= '<td style="width: 40%"> Program: </td>';
        $cover .= '<td style="width: 60%">';
        $cover .= '<ul>';
        foreach ($programs_mapped as $program) {
            $cover .= '<li>'.$program->get_program_obj()->get_name('english').'</li>';
        }

        $cover .= '</ul>';
        $cover .= '</td>';
        $cover .= '</tr>';
        $cover .= '<tr>';
        $cover .= '<td style="width: 40%"> Department: </td>';
        $cover .= '<td style="width: 60%">' . $course->get_department_obj()->get_name('english') . '</td>';
        $cover .= '</tr>';
        $cover .= '<tr>';
        $cover .= '<td style="width: 40%"> Institution: </td>';
        $cover .= '<td style="width: 60%">' . \Orm_Institution::get_university_name('english') . '</td>';
        $cover .= '</tr>';
        $cover .= '<tr>';
        $cover .= '<td style="width: 40%"> Academic year: </td>';
        $cover .= '<td style="width: 60%">' . $semester->get_year() . '</td>';
        $cover .= '</tr>';
        $cover .= '<tr>';
        $cover .= '<td style="width: 40%"> Semester: </td>';
        $cover .= '<td style="width: 60%">' . $semester->get_name('english') . '</td>';
        $cover .= '</tr>';
        $cover .= '</table>';
        $cover .= '</div>';
        $cover .= '</body>';
        $cover .= '</html>';


        return $cover;
    }
    public function after_node_load()
    {
        parent::after_node_load();

        $this->set_institution(\Orm_Institution::get_university_name('english'));
        $this->set_date_of_course_report(date('Y-m-d', strtotime($this->get_date_added())));

    }

    public function tree_item_actions(\Orm_Tree_Item &$tree_item)
    {

        parent::tree_item_actions($tree_item);
    }

}