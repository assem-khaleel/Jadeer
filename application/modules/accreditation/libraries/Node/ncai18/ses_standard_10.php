<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of Ses_Standard_10
 *
 * @author user
 */
class Ses_Standard_10 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 10. Research';
    protected $link_view = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $childrens = array();
        $childrens[] = new Ses_Standard_10_1();
        $childrens[] = new Ses_Standard_10_2();
        $childrens[] = new Ses_Standard_10_3();
        $childrens[] = new Ses_Standard_10_4();
        $childrens[] = new Ses_Standard_10_Overall();

        return $childrens;
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>The institution should develop a research strategy consistent with its nature (eg. as a university with research obligations or as an undergraduate college) and its mission All staff teaching higher education programs must be involved in sufficient appropriate scholarly activities to ensure they remain up to date with developments in their field, and those developments should be reflected in their teaching. Staff teaching in post graduate programs or supervising higher degree research students must be actively involved in research in their field. Adequate facilities and equipment must be available to support the research activities of teaching staff and post graduate students to meet these requirements. In universities and other institutions with research responsibility, teaching staff must be encouraged to pursue research interests and to publish the results of that research. Their research contributions must be recognized and reflected in evaluation and promotion criteria The research output of the institution must be monitored and reported, and benchmarked against that of other similar institutions. Clear and equitable policies must be established for ownership and commercialization of intellectual property.</strong><br/><br/>
        The scales below ask you to indicate whether these practices are followed in your institution and to show how well this is done. Wherever possible evaluations should be based on valid evidence and interpretations supported by independent opinions');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
