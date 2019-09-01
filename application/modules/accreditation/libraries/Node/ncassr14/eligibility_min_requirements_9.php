<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of Eligibility_Requirements_2
 *
 * @author laith
 */
class Eligibility_Min_Requirements_9 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '9. Institutional Storage of statistical data';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_attachment('');
            $this->set_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'A system should be in place within the Institution for providing summary statistical data to departments, colleges, and central committees (Quality Committee and Curriculum Committee or equivalent). This data must include at least the following information and be available for purposes of benchmarking and analysis of programs throughout the Institution: <br/>'
            . '<ol type="a">'
            . '<li>Grade distributions for all courses.</li>'
            . '<li>Mean grade distributions for all courses for each department (or program), college, and the Institution as a whole (desirably provided for courses at each year level).</li>'
            . '<li>Completion rates for all courses</li>'
            . '<li>Mean completion rates for all courses for each department (or program), college, and the Institution as a whole (desirably provided for courses at each year level).</li>'
            . '<li>Year to year progression rates for all year levels, and total program completion rates for all programs.</li>'
            . '<li>Data on employment outcomes of graduates</li>'
            . '</ol>'
            . ' <br/> <br/>'
            . 'If programs are offered in sections for male and female students the statistical data must be available for both sections as well as in aggregated form for both sections. <br/> <br/>'
            . '<strong>Note</strong>:  Accreditation by the NCAAA is based on all the standards for higher education programs and will apply regardless of whether services are managed by the college or department concerned or by institutional level organizational units. For NCAAA program accreditation, judgments place particular emphasis to standard 4 and all of its sub-standards.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_attachment($value)
    {
        $property = new \Orm_Property_Upload('attachment', $value);
        $property->set_description('Provide copies of the last two institutional reports on program performance.');
        $this->set_property($property);
    }

    public function get_attachment()
    {
        return $this->get_property('attachment')->get_value();
    }

    public function set_comment($value)
    {
        $property = new \Orm_Property_Textarea('comment', $value);
        $property->set_description('Comment');
        $this->set_property($property);
    }

    public function get_comment()
    {
        return $this->get_property('comment')->get_value();
    }

}
