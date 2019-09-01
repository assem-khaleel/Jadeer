<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 08/07/18
 * Time: 12:02 ص
 */

namespace Node\ncapm18;


class Program_Specifications extends \Orm_Node
{

    protected $class_type = __class__;
    protected $code = 'Program_Specification';
    protected $name = 'Program Specifications (PS)';
    protected $link_pdf = true;
    protected $link_send_to_review = true;

    function init()
    {
        parent::init();


    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {
        $childrens = array();
           $childrens[] = new Program_Specifications_A();
           $childrens[] = new Program_Specifications_B();
           $childrens[] = new Program_Specifications_C();
           $childrens[] = new Program_Specifications_D();
           $childrens[] = new Program_Specifications_E();
           $childrens[] = new Program_Specifications_F();
           $childrens[] = new Program_Specifications_G();
           $childrens[] = new Program_Specifications_H();
           $childrens[] = new Program_Specifications_I();
           $childrens[] = new Program_Specifications_J();
           $childrens[] = new Program_Specifications_Signature();
           $childrens[] = new Program_Specifications_Attach();

        return $childrens;
    }


    public function get_pdf_cover() {

        /** @var \Orm_Program $program */
        $program = $this->get_parent_program_node()->get_item_obj();

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
        $cover .= '<h1 style="display:block; position: relative; overflow: auto; text-align: center; color:#005c34">Program Specifications</h1>';
        $cover .= '<div style="padding:20px 0; display:block; position: relative; overflow: auto; text-align: center; font-family: \'Open Sans\', sans-serif; font-weight:bold; font-size: 18pt;">';
        $cover .= '<table style="border:4px solid #4e642e; width:55%; margin-left: auto;margin-right: auto; padding: 5px 5px;font-weight:bold; font-size: 16pt;">';
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
        $cover .= '<td> University: </td>';
        $cover .= '<td>' . \Orm_Institution::get_university_name('english') . '</td>';
        $cover .= '</tr>';
        $cover .= '<tr>';
        $cover .= '<td> Approval date: </td>';
        $cover .= '<td>' . date('Y.M.D') . '</td>';
        $cover .= '</tr>';
        $cover .= '</table>';
        $cover .= '</div>';
        $cover .= '</body>';
        $cover .= '</html>';

        return $cover;
    }

}