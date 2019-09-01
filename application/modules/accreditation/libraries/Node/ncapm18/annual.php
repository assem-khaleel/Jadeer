<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 05/07/18
 * Time: 04:25 م
 */

namespace Node\ncapm18;


class Annual extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $code = 'Program_Report';
    protected $name = 'Annual Program Report (APR)';
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
        $childrens[] = new Annual_A();
        $childrens[] = new Annual_B();
        $childrens[] = new Annual_C();
        $childrens[] = new Annual_D();
        $childrens[] = new Annual_E();
        $childrens[] = new Annual_F();
        $childrens[] = new Annual_G();
        $childrens[] = new Annual_H();
        $childrens[] = new Annual_Signature();
        $childrens[] = new Annual_Attach();

        return $childrens;
    }


    public function get_pdf_cover()
    {

        /** @var \Orm_Program $program */
        $program = $this->get_parent_program_node()->get_item_obj();
        /** @var \Orm_Semester $semester */
        $semester = $this->get_system_obj()->get_item_obj();
        $campuses_obj = $program->get_department_obj()->get_college_obj()->get_campuses();

        $img = base_url(\Orm_Institution::get_instance()->get_univ_logo());
        if (file_exists(\Orm_Institution::get_instance()->get_pr_cover())) {
            $img = base_url(\Orm_Institution::get_instance()->get_pr_cover());
        }


        $cover = '<html>';
        $cover .= '<head>';
        $cover .= '<meta charset="utf-8">';
        $cover .= '</head>';
        $cover .= '<body style="padding:100px 0;">';
        $cover .= '<img src="' . $img . '" style="display: block; margin-left:auto; margin-right:auto; width:300px; height:200px">';
        $cover .= '<h1 style="display:block; position: relative; overflow: auto; text-align: center; color:#005c34">Annual Program Report</h1>';
        $cover .= '<div style="padding:20px 0; display:block; position: relative; overflow: auto; text-align: center; font-family: \'Open Sans\', sans-serif; font-weight:bold; font-size: 18pt;">';
        $cover .= '<table style="width:55%;border:4px solid #4e642e; margin-left: auto;margin-right: auto; padding: 5px 5px;font-weight:bold; font-size: 16pt;">';
        $cover .= '<tr>';
        $cover .= '<td> Program Name: </td>';
        $cover .= '<td>' . $program->get_name('english') . '</td>';
        $cover .= '</tr>';
        $cover .= '<tr>';
        $cover .= '<td> Degree Title: </td>';
        $cover .= '<td>' . $program->get_degree_obj()->get_name('english') . '</td>';
        $cover .= '</tr>';
        $cover .= '<tr>';
        $cover .= '<td> Program Code: </td>';
        $cover .= '<td>' . $program->get_code('english') . '</td>';
        $cover .= '</tr>';
        $cover .= '<tr>';
        $cover .= '<td> Department: </td>';
        $cover .= '<td>' . $program->get_department_obj()->get_name('english') . '</td>';
        $cover .= '</tr>';
        $cover .= '<tr>';
        $cover .= '<td> College: </td>';
        $cover .= '<td>' . $program->get_department_obj()->get_college_obj()->get_name('english') . '</td>';
        $cover .= '</tr>';
        $cover .= '<tr>';
        $cover .= '<td> Institution: </td>';
        $cover .= '<td>' . \Orm_Institution::get_university_name('english') . '</td>';
        $cover .= '</tr>';
        $cover .= '<tr>';
        $cover .= '<td> Academic year: </td>';
        $cover .= '<td>' . $semester->get_year() . '</td>';
        $cover .= '</tr>';
        $cover .= '<tr>';
        $cover .= '<td> Branches offering the program: </td>';
        $cover .= '<td>';
        if ($campuses_obj) {
            $cover .= '<ul>';
            foreach ($campuses_obj as $campus_obj) {
                $cover .= '<li>' . $campus_obj->get_name('english') . '</li>';
            }
            $cover .= '</ul>';

        } else {
            $cover .= '<span> Main </span>';
        }

        $cover .= '</td>';
        $cover .= '</tr>';
        $cover .= '</table>';
        $cover .= '</div>';
        $cover .= '</body>';
        $cover .= '</html>';

        return $cover;
    }
}