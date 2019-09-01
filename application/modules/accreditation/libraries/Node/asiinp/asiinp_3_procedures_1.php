<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\asiinp;

/**
 * Description of asiinp_3_procedures_1
 *
 * @author laith
 */
class Asiinp_3_Procedures_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '3.1 Procedure models and types';
    protected $link_view = true;

    public function init()
    {
        parent::init();

            $this->set_info();
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<b>Procedure models</b> <br/> <br/>'
            . 'The main difference between procedures is whether the final decision on accreditation is made by the ASIIN Accreditation Commission itself or whether it merely issues a recommendation. <br/> <br/>'
            . 'Only the ASIIN Accreditation Commission for Degree Programmes can decide whether the 1ASIIN seal is awarded. It is also authorised to decide on the award of European subject-related labels and the seal of the Accreditation Council in Germany. The accreditation procedures in Germany thus fall under procedure model I. <br/> <br/>'
            . 'The ASIIN accreditation procedure is organised in such a way that it can be implemented independently of the country in which the higher education institution is based, i.e. internationally. In all cases, the ASIIN seal and the subject-related labels are issued exclusively by the ASIIN Accreditation Commission for Degree Programmes. <br/> <br/>'
            . 'However, in some countries national accreditations are available which are sanctioned by the state; these can only be awarded by a central body, generally a commissioned authority. In these cases, ASIIN can carry out the procedure, but does not itself take the financial decision concerning national accreditation. <br/> <br/>'
            . 'The ASIIN Office will determine which model is appropriate and possible on request. <br/> <br/>'
            . '<b>Procedure types</b> <br/> <br/>'
            . 'With regard to the above-mentioned procedure models, ASIIN offers different types of procedure for the accreditation of programmes: <br/> <br/>'
            . '<table border ="1">'
            . '<tr>'
            . '<td>Type of procedure</td>'
            . '<td>Characteristics</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Individual procedure</td>'
            . '<td>The procedure is applied to a single Bachelor’s or Master’s degree programme or a consecutive Bachelors and Masters programme.</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Cluster procedure</td>'
            . '<td>The procedure is applied to a bundle of degree programmes (with related subjects). A group of peers assesses several programmes simultaneously.</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Two-stage procedure</td>'
            . '<td>1st stage: Initial check of structural characteristics or models related to the faculty or higher education institution as a whole.  <br/> 2nd stage: Cluster procedure for bundles of programmes (with related subjects) based on the evaluation from stage 1.</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Second tier accreditation procedure</td>'
            . '<td>Under certain conditions and based on the results of prior external evaluations (or similar), it may not be necessary to include an on-site visit in the accreditation procedure, depending on the seals being applied for.</td>'
            . '</tr>'
            . '<tr>'
            . '<td>International cooperation procedure</td>'
            . '<td>In the case of a programme involving two or more higher education institutions from different countries, a procedure based on cooperation with an agency in the other country may be carried out.</td>'
            . '</tr>'
            . '</table>'
            . 'Irrespective of the type of procedure being applied,the decision on whether or not to accredit each programme is made separately.If the application is successful, each programme receives an accreditation seal in its own right. <br/> <br/>'
            . 'Similarly, for combined programmes, the accreditation applies to the programme as a whole, and not a part of it.'
            . 'Depending on the circumstances and needs of a particular institution, the accreditation procedure for individual degree programmes may be carried out separately or jointly for bundles of programmes (cluster procedure). In each case, ASIIN’s responsible Technical Committees will decide if degree programmes may be bundled in this type of procedure as well as which programmes this applies to <br/> <br/>'
            . 'In a two-stage accreditation procedure, structures which apply to programmes throughout the institution, or a programme model, e.g. for combined programmes (teacher training or dual subject programmes), are initially checked by a group of specially appointed peers (stage 1). This may involve ASIIN cooperating with another accreditation agency to form a joint team in order to include subject areas not covered by ASIIN in the overall procedure. The end product of the first step of the procedure is an evaluation report. The report forms the foundation of the subject audits – generally in the form of bundled clusters of programmes or subjects – carried out in the second step of the procedure (stage 2). The procedure for stage 2 then follows the steps described in section 3.2. After the second stage of the procedure has been completed, a decision is made on whether to grant accreditation 30for the individual degree programmes. A two-stage accreditation process is particularly suitable for cases where the degree programmes to be accredited have common structural characteristics and are offered by more than one subject area or faculty in a higher education institution. <br/> <br/>'
            . 'A second tier accreditation procedure based on available, external results from evaluations (or similar) is possible if the evaluations cover all aspects relevant to the accreditation and were produced by an independent body. In such cases, the accreditation procedure can be slimmed down and it may not be necessary for peers to conduct an on-site visit. In each specific case, the responsible bodies within ASIIN will look into the circumstances and decide whether this variant may be used, depending on the rules for the seal which is being applied for. <br/> <br/>'
            . 'An international cooperation procedure is recommended when a programme is jointly offered and organised by two or more higher education institutions in two or more countries and requires accreditation in both or some of the countries involved. In this case, a coordinated procedure is specified for each case on the basis of the appropriate criteria. The requirements of each owner of the seals being applied for are applicable. Where appropriate, exemptions must be obtained from one or more seal owners. This is done during the preparatory stage.');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
