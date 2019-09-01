<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 05/07/18
 * Time: 12:19 م
 */

namespace Node\ncacm18;


class Course_Specifications extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $code = 'Course_Specification';
    protected $name = 'Course Specifications (CS)';
    protected $link_pdf = true;
    protected $link_send_to_review = true;

    public function init()
    {
        parent::init();

    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $childrens = array();
        $childrens[] = new Course_Specifications_A();
        $childrens[] = new Course_Specifications_B();
        $childrens[] = new Course_Specifications_C();
        $childrens[] = new Course_Specifications_D();
        $childrens[] = new Course_Specifications_E();
        $childrens[] = new Course_Specifications_F();
        $childrens[] = new Course_Specifications_G();
        $childrens[] = new Course_Specifications_H();



        return $childrens;
    }

    public function get_pdf_cover()
    {

        /** @var \Orm_Course $course */
        $course=$this->get_parent_course_node()->get_item_obj();


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
        $cover .= '<h1 style="display:block; position: relative; overflow: auto; text-align: center; color:#005c34">Course Specifications (CS)</h1>';
        $cover .= '<div style="padding:20px 0; display:block; position: relative; overflow: auto; text-align: center; font-family: \'Open Sans\', sans-serif; font-weight:bold; font-size: 16pt;">';
        $cover .= '<table style="border:4px solid #4e642e; width:55%; margin-left: auto;margin-right: auto; padding: 5px 5px;font-weight:bold; font-size: 15pt;">';
        $cover .= '<tr>';
        $cover .= '<td style="width: 40%"> Course Title: </td>';
        $cover .= '<td style="width: 60%">' . $course->get_name('english') . '</td>';
        $cover .= '</tr>';
        $cover .= '<tr>';
        $cover .= '<td style="width: 40%"> Course Code:</td>';
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
        $cover .= '<td style="width: 40%"> Approval date: </td>';
        $cover .= '<td style="width: 60%">' . date('Y.M.D') . '</td>';
        $cover .= '</tr>';
        $cover .= '</table>';
        $cover .= '</div>';
        $cover .= '</body>';
        $cover .= '</html>';


        return $cover;
    }
}