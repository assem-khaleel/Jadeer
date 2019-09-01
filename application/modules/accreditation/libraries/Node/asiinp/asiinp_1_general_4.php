<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\asiinp;

/**
 * Description of asiinp_1_general_4
 *
 * @author laith
 */
class Asiinp_1_General_4 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '1.4 Results oriented degree programmes and process oriented academic assessment';
    protected $link_view = true;

    public function init()
    {
        parent::init();

            $this->set_info();
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<b>Quality in degree programmes and relevant stakeholders</b>'
            . ' <br/> <br/>ASIIN’s understanding of quality is based on the stated goals and results of a qualification process. A programme is seen as a qualification process.'
            . ' <br/> <br/>The definition of the substantive aspects which constitute the quality of a programme is based on the goals and expectations set out by the higher education institution; they should take into account the political, legal and socio-economic context within which a programme is created and implemented. The quality of the qualification process is then established based on the combination of its elements and the extent to which it achieves its goals.'
            . ' <br/> <br/>Groups of people who may be involved in or affected by a programme, should be regarded as stakeholders. These are also the individuals who define which goals should be achieved. They include students, lecturers, managers and administrators of the higher education institution as well as other service providers within the institution. Stakeholders external to the organisation should also be considered. These include industry representatives and representatives of state institutions who are responsible for the financing and legal or professional supervision. Identifying stakeholders who are relevant for a given programme will depend on the institution’s strategic positioning, its guidelines in relation to this, and its development goals.'
            . ' <br/> <br/><b>ASIIN’s approach to assessment</b>'
            . ' <br/> <br/>The accreditation procedure examines the logic and effectiveness of the qualification process within a programme. Three phases are involved in creating a programme:'
            . ' <br/>'
            . '<ol type="1">'
            . '<li>Definition of goals: For each programme, the main focus lies on the learning outcomes that should be achieved by students during their studies. This means that the overall learning outcomes aimed at in the programme must be rigorously collated with the goals of the learning outcomes of the individual modules in the programme.</li>'
            . '<li>Implementation: Here, the focus is on the measures, instruments and resources which are the product of the supporting or organisational processes of a higher education institution that it invests in the implementation of a programme (input) in order to attain the defined goals (outcome).</li>'
            . '<li>Further development and checking results: The institution’s internal quality assurance process is considered at this juncture; its feedback mechanisms should lead to continuous improvements in the programme.</li>'
            . '</ol>'
            . ' <br/> <br/>ASIIN’s process-oriented perspective and underlying quality concept mean that the responsibility for quality and the process firmly lies with higher education institutions, which are, therefore, also responsible for defining the goals for a given programme. In this way, they give expression to their strategic orientation, the image they seek to create and their integration within the social context.');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
