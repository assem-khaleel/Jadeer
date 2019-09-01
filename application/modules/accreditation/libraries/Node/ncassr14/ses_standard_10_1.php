<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ses_standard_10_1
 *
 * @author ahmadgx
 */
class Ses_Standard_10_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '10.1 Teaching Staff and Student Involvement in Research';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_10_1_1('');
            $this->set_10_1_2('');
            $this->set_10_1_3('');
            $this->set_10_1_4('');
            $this->set_10_1_5('');
            $this->set_10_1_6('');
            $this->set_10_1_7('');
            $this->set_10_1_8('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Expectations for teaching staff involvement in research and scholarly activities must be made clear and provide for widespread participation.  Encouragement and support must be provided to encourage research activity by junior teaching staff and postgraduate students.</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_10_1_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_1_1', $value);
        $property->set_description('10.1.1 Expectations for teaching staff involvement in research and scholarly activities are clearly specified and considered in performance evaluation and promotion criteria. (For universities criteria require at least some research and/or appropriate scholarly activity of all full time teaching staff).');
        $this->set_property($property);
    }

    public function get_10_1_1()
    {
        return $this->get_property('10_1_1')->get_value();
    }

    public function set_10_1_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_1_2', $value);
        $property->set_description('10.1.2 Clear policies are established in the institution for defining what is recognized as research, consistent with international standards and established norms in the field of study of the program.  (This normally includes both self-generated and commissioned activity but requires creative original work, independently validated by peers, and published in media recognized internationally in the field of study)');
        $this->set_property($property);
    }

    public function get_10_1_2()
    {
        return $this->get_property('10_1_2')->get_value();
    }

    public function set_10_1_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_1_3', $value);
        $property->set_description('10.1.3 Support is provided for junior staff in the development of their research programs through mechanisms such as mentoring by senior colleagues, inclusion in project teams, assistance in developing research proposals, and seed funding.');
        $this->set_property($property);
    }

    public function get_10_1_3()
    {
        return $this->get_property('10_1_3')->get_value();
    }

    public function set_10_1_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_1_4', $value);
        $property->set_description('10.1.4 Postgraduate research students are given opportunities for participation in joint research projects.');
        $this->set_property($property);
    }

    public function get_10_1_4()
    {
        return $this->get_property('10_1_4')->get_value();
    }

    public function set_10_1_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_1_5', $value);
        $property->set_description('10.1.5 When research students are involved in joint research projects their contributions are appropriately acknowledged.  When a significant contribution has been made reports and publications carry joint authorship.');
        $this->set_property($property);
    }

    public function get_10_1_5()
    {
        return $this->get_property('10_1_5')->get_value();
    }

    public function set_10_1_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_1_6', $value);
        $property->set_description('10.1.6 Assistance is available for teaching staff  to develop collaborative research arrangements with colleagues in other institutions and in the international community');
        $this->set_property($property);
    }

    public function get_10_1_6()
    {
        return $this->get_property('10_1_6')->get_value();
    }

    public function set_10_1_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_1_7', $value);
        $property->set_description('10.1.7 Research and scholarly activities of teaching staff  that are relevant to courses they teach are reflected in their teaching together with other significant research developments in the field');
        $this->set_property($property);
    }

    public function get_10_1_7()
    {
        return $this->get_property('10_1_7')->get_value();
    }

    public function set_10_1_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_1_8', $value);
        $property->set_description('10.1.8 Strategies are developed for identifying and capitalizing on the expertise of faculty and postgraduate students in providing research and development services to the community and generating financial returns to the institution.');
        $this->set_property($property);
    }

    public function get_10_1_8()
    {
        return $this->get_property('10_1_8')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('10_1_1');
        $property->add_property_name('10_1_2');
        $property->add_property_name('10_1_3');
        $property->add_property_name('10_1_4');
        $property->add_property_name('10_1_5');
        $property->add_property_name('10_1_6');
        $property->add_property_name('10_1_7');
        $property->add_property_name('10_1_8');
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
