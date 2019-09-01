<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_2_sub_c_standard15
 *
 * @author ahmadgx
 */
class Acpe_Section_2_Sub_C_Standard15 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 15: Academic Environment';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_college('');
            $this->set_key('');
            $this->set_student_information('');
            $this->set_compliants_policy('');
            $this->set_student_misconduct('');
            $this->set_student_representation('');
            $this->set_learning_policies('');
    }

    public function set_college()
    {
        $property = new \Orm_Property_Fixedtext('college', 'The college or school develops, implements, and assesses its policies and procedures that promote student success and well-being.');
        $this->set_property($property);
    }

    public function get_college()
    {
        return $this->get_property('college')->get_value();
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

    public function set_student_information($value)
    {
        $property = new \Orm_Property_Textarea('student_information', $value);
        $property->set_description('15.1. Student information – The college or school produces and makes available to enrolled and prospective students updated information of importance, such as governance documents, policies and procedures, handbooks, and catalogs.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_student_information()
    {
        return $this->get_property('student_information')->get_value();
    }

    public function set_compliants_policy($value)
    {
        $property = new \Orm_Property_Textarea('compliants_policy', $value);
        $property->set_description('15.2. Complaints policy – The college or school develops, implements, and makes available to students a complaints policy that includes procedures for how students may file complaints within the college or school and also directly to ACPE regarding their college or school’s adherence to ACPE standards. The college or school maintains a chronological record of such student complaints, including how each complaint was resolved.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_compliants_policy()
    {
        return $this->get_property('compliants_policy')->get_value();
    }

    public function set_student_misconduct($value)
    {
        $property = new \Orm_Property_Textarea('student_misconduct', $value);
        $property->set_description('15.3. Student misconduct – The college or school develops and implements policies regarding academic and non-academic misconduct of students that clearly outline the rights and responsibilities of, and ensures due process for, all parties involved.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_student_misconduct()
    {
        return $this->get_property('student_misconduct')->get_value();
    }

    public function set_student_representation($value)
    {
        $property = new \Orm_Property_Textarea('student_representation', $value);
        $property->set_description('.15.4. Student representation – The college or school considers student perspectives and includes student representation, where appropriate, on committees, in policy- development bodies, and in assessment and evaluation activities.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_student_representation()
    {
        return $this->get_property('student_representation')->get_value();
    }

    public function set_learning_policies($value)
    {
        $property = new \Orm_Property_Textarea('learning_policies', $value);
        $property->set_description('15.5. Distance learning policies* – For colleges and schools offering distance learning opportunities, admissions information clearly explains the conditions and requirements related to distance learning, including full disclosure of any requirements that cannot be completed at a distance.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_learning_policies()
    {
        return $this->get_property('learning_policies')->get_value();
    }

}
