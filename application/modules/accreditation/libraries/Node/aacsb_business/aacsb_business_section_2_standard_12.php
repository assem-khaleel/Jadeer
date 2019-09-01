<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb_business;

/**
 * Description of aacsb_business_section_2_standard_12
 *
 * @author ahmadgx
 */
class Aacsb_Business_Section_2_Standard_12 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 12';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_standard_name('');
            $this->set_definition('');
            $this->set_faculty('');
            $this->set_teaching_performance('');
            $this->set_continuous_improvement('');
            $this->set_other_recognitions('');
            $this->set_innovative('');
    }

    public function set_standard_name()
    {
        $property = new \Orm_Property_Fixedtext('standard_name', "<b>The school has policies and processes to enhance the teaching effectiveness of faculty and professional staff involved with teaching across the range of its educational programs and delivery modes. [TEACHING EFFECTIVENESS]</b>");
        $this->set_property($property);
    }

    public function get_standard_name()
    {
        return $this->get_property('standard_name')->get_value();
    }

    public function set_definition()
    {
        $property = new \Orm_Property_Fixedtext('definition', '<strong>Basis for Judgment</strong>'
            . '<br/><ul>'
            . '<li>The school has a systematic process for evaluating quality as an integral component of the faculty and professional staff performance review process. This process should extend beyond student evaluations of teaching and include expectations for continuous improvement.</li>'
            . '<li>The school provides development activities focused on teaching enhancement to all faculty members, appropriate professional staff, and graduate students who have teaching responsibilities across all delivery modes.</li>'
            . '<li>Faculty are adequately prepared to teach while employing the modalities and pedagogies of degree programs.</li>'
            . '<li>Faculty and professional staff substantially participate in teaching enhancement activities.</li>'
            . '</ul>'
            . '<br/><br/><strong>Guidance for Documentation</strong>');
        $this->set_property($property);
    }

    public function get_definition()
    {
        return $this->get_property('definition')->get_value();
    }

    public function set_faculty($value)
    {
        $property = new \Orm_Property_Textarea('faculty', $value);
        $property->set_description('Describe how faculty and professional staff teach while employing the modalities and pedagogies of degree programs, as well as provide evidence of the effectiveness of their delivery and preparation. Discuss how the school ensures that the faculty and professional staff engaged in different teaching/learning models have the competencies required for achieving quality.');
        $this->set_property($property);
    }

    public function get_faculty()
    {
        return $this->get_property('faculty')->get_value();
    }

    public function set_teaching_performance($value)
    {
        $property = new \Orm_Property_Textarea('teaching_performance', $value);
        $property->set_description('Describe how the school evaluates teaching performance across its various program delivery models and how this process affects faculty and related professional staff.');
        $this->set_property($property);
    }

    public function get_teaching_performance()
    {
        return $this->get_property('teaching_performance')->get_value();
    }

    public function set_continuous_improvement($value)
    {
        $property = new \Orm_Property_Textarea('continuous_improvement', $value);
        $property->set_description('Describe continuous improvement and development initiatives for faculty and professional staff that focus on teaching enhancement and student learning. Document faculty and staff participation in these initiatives over the past five years.');
        $this->set_property($property);
    }

    public function get_continuous_improvement()
    {
        return $this->get_property('continuous_improvement')->get_value();
    }

    public function set_other_recognitions($value)
    {
        $property = new \Orm_Property_Textarea('other_recognitions', $value);
        $property->set_description('Summarize awards or other recognitions that faculty and professional staff have received for outstanding teaching and professional support of student learning.');
        $this->set_property($property);
    }

    public function get_other_recognitions()
    {
        return $this->get_property('other_recognitions')->get_value();
    }

    public function set_innovative($value)
    {
        $property = new \Orm_Property_Textarea('innovative', $value);
        $property->set_description('Document innovative and/or effective teaching practices that have had significant, positive impact on student learning.');
        $this->set_property($property);
    }

    public function get_innovative()
    {
        return $this->get_property('innovative')->get_value();
    }

}
