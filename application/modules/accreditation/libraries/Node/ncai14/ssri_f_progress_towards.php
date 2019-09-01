<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of ssri_f_progress_towards
 *
 * @author ahmadgx
 */
class Ssri_F_Progress_Towards extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'F. Progress towards Quality Objectives';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_assessment('');
    }

    public function set_assessment($value)
    {
        $property = new \Orm_Property_Textarea('assessment', $value);
        $property->set_description('Provide an assessment of institutional performance in relation to plans or any major quality improvement initiatives in the period under review.  These may have been undertaken in response to a previous self study, recommendations or requirements following an external review, or for other reasons.');
        $this->set_property($property);
    }

    public function get_assessment()
    {
        return $this->get_property('assessment')->get_value();
    }

}
