<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\asiinp;

/**
 * Description of asiinp_5_appendix_6
 *
 * @author laith
 */
class Asiinp_5_Appendix_6 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '5.6 Sample plan for an on-site visit';
    protected $link_view = true;

    public function init()
    {
        parent::init();

            $this->set_info();
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'An exemplary description of the elements and rounds of discussions of a visit by an ASIIN review team can be found below. In the case of a cluster procedure, an individual timetable is established on the basis of the general timetable. Timetables might also be adapted to take account of different procedure types and the sites of HEIs if applicable. Additional discussions may be necessary (e.g. with professional representatives, graduates or representatives of supervisory authorities) depending on the characteristics of the given programmes or local conditions.An exemplary description of the elements and rounds of discussions of a visit by an ASIIN review team can be found below. In the case of a cluster procedure, an individual timetable is established on the basis of the general timetable. Timetables might also be adapted to take account of different procedure types and the sites of HEIs if applicable. Additional discussions may be necessary (e.g. with professional representatives, graduates or representatives of supervisory authorities) depending on the characteristics of the given programmes or local conditions. <br/>'
            . '<br/>Components of a visit <br/>'
            . '<b>Discussion with the HEI management</b> <br/> <br/>'
            . 'focus: Resources, quality management, documentation, transparency, diversity and equal opportunities <br/> <br/>'
            . '<b>Discussion(s) with those responsible for programmes</b> <br/> <br/>'
            . 'focus: Integration within the curriculum; the programme: concept for content and implementation; the programme: structures, methods and implementation; examinations: organisation, concept and characteristics <br/> <br/>'
            . '<b>Discussion with students at various stages in their studies, including representatives of the student union or organised student representation</b> <br/> <br/>'
            . 'focus:The programme: concept for content and implementation; the programme: structures, methods and implementation; examinations: organisation, concept and characteristics; resources, quality management, documentation and transparency, diversity and equal opportunities <br/> <br/>'
            . '<b>Examination of documentation, tests, projects and thesis and any other material which can only be inspected on-site</b> <br/> <br/>'
            . 'focus: The programme: structures, methods and implementation; examinations: organisation, concept and characteristics (based on the quality and level of the available samples) <br/> <br/>'
            . '<b>Discussion with the programme’s teaching staff</b> <br/> <br/>'
            . 'focus: The programme: concept for content and implementation; the programme: structures, methods and implementation; examinations: organisation, concept and characteristics <br/> <br/>'
            . '<b>Tour of the institutions involved</b> <br/> <br/>'
            . 'focus: Resources, the programme: structures, methods and implementation <br/> <br/>'
            . '<b>Internal discussion by the review team</b> <br/> <br/>'
            . '<b>Concluding discussion with those responsible for the programmes and the HEI management</b> <br/> <br/>'
            . 'focus: The peers summarise their impressions from the day');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
