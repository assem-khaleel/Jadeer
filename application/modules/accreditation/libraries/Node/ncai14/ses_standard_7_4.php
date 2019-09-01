<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of Ses_Standard_7_4
 *
 * @author user
 */
class Ses_Standard_7_4 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '7.4 Information Technology';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_7_4_1('');
            $this->set_7_4_2('');
            $this->set_7_4_3('');
            $this->set_7_4_4('');
            $this->set_7_4_5('');
            $this->set_7_4_6('');
            $this->set_7_4_7('');
            $this->set_7_4_8('');
            $this->set_7_4_9('');
            $this->set_7_4_10('');
            $this->set_7_4_11('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Computing equipment and software and related support services must be adequate for the institutions needs and managed in ways that ensure secure, efficient and effective utilization.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_7_4_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_4_1', $value);
        $property->set_description('7.4.1 Adequate computing equipment is available and accessible for teaching and other staff and students throughout the institution.');
        $this->set_property($property);
    }

    public function get_7_4_1()
    {
        return $this->get_property('7_4_1')->get_value();
    }

    public function set_7_4_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_4_2', $value);
        $property->set_description('7.4.2 The adequacy of provision of computer equipment and support services is regularly assessed (through surveys or other means and comparisons with other institutions).');
        $this->set_property($property);
    }

    public function get_7_4_2()
    {
        return $this->get_property('7_4_2')->get_value();
    }

    public function set_7_4_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_4_3', $value);
        $property->set_description('7.4.3 Policies are established and effectively implemented governing the use of personal computers by students.');
        $this->set_property($property);
    }

    public function get_7_4_3()
    {
        return $this->get_property('7_4_3')->get_value();
    }

    public function set_7_4_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_4_4', $value);
        $property->set_description('7.4.4 Technical support is available for staff and students using information and communications technology.');
        $this->set_property($property);
    }

    public function get_7_4_4()
    {
        return $this->get_property('7_4_4')->get_value();
    }

    public function set_7_4_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_4_5', $value);
        $property->set_description('7.4.5 Opportunities are available for teaching staff input into plans for acquisition and replacement of IT equipment.');
        $this->set_property($property);
    }

    public function get_7_4_5()
    {
        return $this->get_property('7_4_5')->get_value();
    }

    public function set_7_4_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_4_6', $value);
        $property->set_description('7.4.6 An institution-wide acquisitions and replacement policy is established for software and hardware to ensure that systems remain up to date and that compatibility is maintained as replacements are made.');
        $this->set_property($property);
    }

    public function get_7_4_6()
    {
        return $this->get_property('7_4_6')->get_value();
    }

    public function set_7_4_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_4_7', $value);
        $property->set_description('7.4.7 Security systems are in place to protect privacy of sensitive personal and institutional information, and to protect against externally introduced viruses.');
        $this->set_property($property);
    }

    public function get_7_4_7()
    {
        return $this->get_property('7_4_7')->get_value();
    }

    public function set_7_4_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_4_8', $value);
        $property->set_description('7.4.8 A code of conduct is established relating to inappropriate use of material on the Internet. Compliance with this code of conduct is checked and instances of inappropriate behavior dealt with appropriately.');
        $this->set_property($property);
    }

    public function get_7_4_8()
    {
        return $this->get_property('7_4_8')->get_value();
    }

    public function set_7_4_9($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_4_9', $value);
        $property->set_description('7.4.9 Training programs are provided for teaching and other staff to ensure effective use of computing equipment and appropriate software for teaching, student assessment, and administration.');
        $this->set_property($property);
    }

    public function get_7_4_9()
    {
        return $this->get_property('7_4_9')->get_value();
    }

    public function set_7_4_10($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_4_10', $value);
        $property->set_description('7.4.10 Effective use is made of information technology for administrative systems, reporting, and communications across the institution. Software systems are coordinated to ensure compatibility where relevant.');
        $this->set_property($property);
    }

    public function get_7_4_10()
    {
        return $this->get_property('7_4_10')->get_value();
    }

    public function set_7_4_11($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_4_11', $value);
        $property->set_description('7.4.11 Internal information systems are compatible and integrated with external reporting requirements.');
        $this->set_property($property);
    }

    public function get_7_4_11()
    {
        return $this->get_property('7_4_11')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('7_4_1');
        $property->add_property_name('7_4_2');
        $property->add_property_name('7_4_3');
        $property->add_property_name('7_4_4');
        $property->add_property_name('7_4_5');
        $property->add_property_name('7_4_6');
        $property->add_property_name('7_4_7');
        $property->add_property_name('7_4_8');
        $property->add_property_name('7_4_9');
        $property->add_property_name('7_4_10');
        $property->add_property_name('7_4_11');
        $this->set_property($property);
    }

    public function get_overall_assessment()
    {
        return $this->get_property('overall_assessment')->get_value();
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

    public function set_priorities_for_improvement($value)
    {
        $property = new \Orm_Property_Textarea('priorities_for_improvement', $value);
        $property->set_description('Priorities For Improvement');
        $this->set_property($property);
    }

    public function get_priorities_for_improvement()
    {
        return $this->get_property('priorities_for_improvement')->get_value();
    }

    public function set_independent_opinion($value)
    {
        $property = new \Orm_Property_Rank('independent_opinion', $value);
        $property->set_description('Independent Opinion');
        $this->set_property($property, true);
    }

    public function get_independent_opinion()
    {
        return $this->get_property('independent_opinion')->get_value();
    }

    public function set_independent_opinion_comment($value)
    {
        $property = new \Orm_Property_Textarea('independent_opinion_comment', $value);
        $property->set_description('Comment');
        $this->set_property($property, true);
    }

    public function get_independent_opinion_comment()
    {
        return $this->get_property('independent_opinion_comment')->get_value();
    }

}
