<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of eligibility_requirements_12
 *
 * @author laith
 */
class Eligibility_Requirements_12 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '12. Self Evaluation Scales – D2.P';
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
        $property = new \Orm_Property_Fixedtext('info', 'The <strong>Self Evaluation Scales for Higher Education Programs</strong> must have been completed with a rating of at least (3 stars) on all standards and sub-standards applicable to the Program. (Note: It is not necessary for every single item within the scales to be given three stars or more. However, the rating for each group of items must be at the 3 stars level and the Commission may specify certain individual items on which a minimum three star rating is required).');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_attachment($value)
    {
        $property = new \Orm_Property_Upload('attachment', $value);
        $property->set_description('Complete the Self Evaluation Scales for Programs (click → D2.P).');
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
