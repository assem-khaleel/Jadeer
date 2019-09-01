<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\asiinp;

/**
 * Description of asiinp_5_appendix_2
 *
 * @author laith
 */
class Asiinp_5_Appendix_2 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '5.2 Example: Model Objectives Matrix';
    protected $link_view = true;
    protected $orientation = 'landscape';

    public function init()
    {
        parent::init();

            $this->set_info();
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<b>Allocation of overall intended learning outcomes and module objectives (cf. section 1.4 and 2.2)</b> <br/> <br/>'
            . 'To help assess the congruence of objectives within a programme of studies, it is best to make transparent how individual modules contribute to the realisation of the overall learning outcomes. <br/> <br/>'
            . 'The relationship between the intended learning outcomes and the individual modules which implement them can be presented using the following table. Individual learning outcomes or modules can be assigned and combined in various ways. The following tables are intended as examples. <br/> <br/>'
            . 'Table 1: Objectives matrix, example 1 <br/>'
            . '<table border="1">'
            . '<tr>'
            . '<td><b>Intended learning outcomes for the programme as a whole (competence profile/learning outcomes)</b>'
            . '<ul>'
            . '<li>Knowledge</li>'
            . '<li>Skills</li>'
            . '<li>Competences</li>'
            . '</ul></td>'
            . '<td>Corresponding module objectives/modules (operationalisation)</td>'
            . '</tr>'
            . '<tr>'
            . '<td></td>'
            . '<td>Module designations should be clear</td>'
            . '</tr>'
            . '<tr>'
            . '<td></td>'
            . '<td></td>'
            . '</tr>'
            . '<tr>'
            . '<td></td>'
            . '<td></td>'
            . '</tr>'
            . '<tr>'
            . '<td></td>'
            . '<td></td>'
            . '</tr>'
            . '<tr>'
            . '<td></td>'
            . '<td></td>'
            . '</tr>'
            . '</table>'
            . '<br/>Table 2: Objectives matrix, example 2<br/>'
            . '<table border="1">'
            . '<tr>'
            . '<td></td>'
            . '<td>knowledge a</td>'
            . '<td>knowledge b</td>'
            . '<td>Skill a</td>'
            . '<td>Skill b</td>'
            . '<td>Competence a</td>'
            . '<td>Competence b</td>'
            . '<td>Etc.</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Module A</td>'
            . '<td>**</td>'
            . '<td></td>'
            . '<td></td>'
            . '<td></td>'
            . '<td></td>'
            . '<td></td>'
            . '<td></td>'
            . '</tr>'
            . '<tr>'
            . '<td>Module B</td>'
            . '<td></td>'
            . '<td></td>'
            . '<td></td>'
            . '<td></td>'
            . '<td></td>'
            . '<td></td>'
            . '<td></td>'
            . '</tr>'
            . '<tr>'
            . '<td>Module C</td>'
            . '<td></td>'
            . '<td></td>'
            . '<td></td>'
            . '<td></td>'
            . '<td></td>'
            . '<td></td>'
            . '<td></td>'
            . '</tr>'
            . '<tr>'
            . '<td>Module D</td>'
            . '<td></td>'
            . '<td></td>'
            . '<td></td>'
            . '<td></td>'
            . '<td></td>'
            . '<td></td>'
            . '<td></td>'
            . '</tr>'
            . '<tr>'
            . '<td>Etc.</td>'
            . '<td></td>'
            . '<td></td>'
            . '<td></td>'
            . '<td></td>'
            . '<td></td>'
            . '<td></td>'
            . '<td></td>'
            . '</tr>'
            . '</table>'
            . '** Classification of the module’s contribution, e.g. “high”/“medium”/“low” or other categories depending on the institution’s needs.');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
