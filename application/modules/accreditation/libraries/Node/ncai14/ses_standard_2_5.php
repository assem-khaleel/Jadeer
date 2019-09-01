<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of Ses_Standard_2_5
 *
 * @author user
 */
class Ses_Standard_2_5 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '2.5 Integrity';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_2_5_1('');
            $this->set_2_5_2('');
            $this->set_2_5_3('');
            $this->set_2_5_4('');
            $this->set_2_5_5('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', "<strong>The institution must meet high ethical standards of honesty and integrity including avoidance of conflicts of interest and avoidance of plagiarism in its teaching, research and service functions and take action to ensure that these standards are met by staff and students. These standards must be maintained in all of the institutions dealings with its students and teaching and other staff, and its relationships with external agencies including both government and non-government organizations.</strong><br/><br/>"
            . "The level of compliance with this standard is judged by the extent to which the following good practices are followed.");
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_2_5_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_5_1', $value);
        $property->set_description('2.5.1 Codes of practice for ethical and responsible behaviour have been developed that require that teaching and other staff and students, and all committees and organizations, act consistently with high standards of ethical conduct and avoidance of plagiarism in the conduct and reporting of research, in teaching, performance evaluation and assessment, and in the conduct of administrative and service activities.');
        $this->set_property($property);
    }

    public function get_2_5_1()
    {
        return $this->get_property('2_5_1')->get_value();
    }

    public function set_2_5_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_5_2', $value);
        $property->set_description('2.5.2 The institution regularly reviews and modifies its policies and procedures as necessary to ensure continuing high standards of ethical conduct.');
        $this->set_property($property);
    }

    public function get_2_5_2()
    {
        return $this->get_property('2_5_2')->get_value();
    }

    public function set_2_5_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_5_3', $value);
        $property->set_description('2.5.3 Administrators and others speaking on behalf of the institution represent it honestly and accurately to both internal and external agencies.  (Advertising and promotional material is always be truthful, avoids any actual or implied misrepresentations or exaggerated claims, or negative comments about other institutions.)');
        $this->set_property($property);
    }

    public function get_2_5_3()
    {
        return $this->get_property('2_5_3')->get_value();
    }

    public function set_2_5_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_5_4', $value);
        $property->set_description('2.5.4 Regulations are established and are consistently followed dealing with declarations of pecuniary interest or conflict of interest for faculty and staff at all levels of the institution . (The regulations apply to all staff, the governing board and to all committees and other decision making bodies in the institution.)');
        $this->set_property($property);
    }

    public function get_2_5_4()
    {
        return $this->get_property('2_5_4')->get_value();
    }

    public function set_2_5_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_5_5', $value);
        $property->set_description('2.5.5 Hiring, disciplinary and dismissal practices are clearly documented and administered in a way that ensures fair treatment for all Saudi Arabian and expatriate teaching and other staff, whether appointed on a full time or part time basis.');
        $this->set_property($property);
    }

    public function get_2_5_5()
    {
        return $this->get_property('2_5_5')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('2_5_1');
        $property->add_property_name('2_5_2');
        $property->add_property_name('2_5_3');
        $property->add_property_name('2_5_4');
        $property->add_property_name('2_5_5');

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
