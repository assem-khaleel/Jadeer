<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of eligibility_requirements_19
 *
 * @author laith
 */
class Eligibility_Requirements_19 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '19. Self Evaluation Scales (SES) and Self Study for Institutions (SSRI) (refer attachment 3 & 4 )';
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
        $property = new \Orm_Property_Fixedtext('info', 'The institution must have reviewed its activities in relation to the eleven standards specified by the NCAAA. This includes an initial draft of the SSRI and it involves a complete Self Evaluation Scales report for higher education institutions by a committee or committees with thorough knowledge of all parts of the organization. The Rector (for a university) or the Chair of the Board of Trustees (for a private college) must have certified that in its view the institution has achieved satisfactory performance on each of the eleven standards. (Satisfactory performance for the purpose of this item means an overall rating of at least three stars for each standard and sub-standard on the star rating system. <br/> <br/>'
            . '<ul><li>NOTE: It is not necessary for every single item within the sub-standards of each standard to be given three stars or more. However, the rating for each standard and sub-standard as a whole must be at that level.</li></ul>');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_attachment($value)
    {
        $property = new \Orm_Property_Upload('attachment', $value);
        $property->set_description('Complete a first draft of the Self Study Report Institution (SSRI) and Self Evaluation scales (SES) Refer attachment 3 &4');
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
