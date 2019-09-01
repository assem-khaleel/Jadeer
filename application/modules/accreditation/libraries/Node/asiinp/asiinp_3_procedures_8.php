<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\asiinp;

/**
 * Description of asiinp_3_procedures_8
 *
 * @author laith
 */
class Asiinp_3_Procedures_8 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '3.8 Changes during the accreditation period';
    protected $link_view = true;

    public function init()
    {
        parent::init();

            $this->set_info();
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'Changes to degree programmes during the accreditation period are in principle possible and are indeed essential if the quality of a programme improves or is further developed. However, significant changes may change the object of accreditation in such a way that the original accreditation decision and award of the seal no longer apply. <br/>'
            . 'It is therefore important to ASIIN to offer a fast and low-cost procedure which, in the event of significant changes, allows for the accreditation decision or the award of a seal to be maintained or to be extended to these changes. <br/>'
            . 'If an accreditation procedure has been completed by ASIIN, the higher education institution is contractually obliged to inform the agency of significant changes. If ASIIN learns of a significant change by other means, the higher education institution will be invited to comment within a specified time limit. The higher education institution is able in its comments to request that the accreditation is maintained in accordance with the procedure described below. It is generally up to the Accreditation Commission for Degree Programmes to decide whether the change decreases the quality of the programme and whether a new accreditation is necessary. <br/>'
            . ' <br/><b>Definition</b> <br/>In the event of significant changes to the concept or profile of a programme, the agency will decide whether the changes decrease the quality and therefore a reaccreditation is necessary <br/> <br/>'
            . '<b>This type of change has generally occurred if</b> <br/>'
            . '<ol type="1">'
            . '<li>The objectives of the programme are redefined in a form surpassing an update based on new knowledge from academic and professional sources;</li>'
            . '<li>Its characteristics as recorded in the accreditation certificate have changed (e.g. designation, programme classification (consecutive/continuing), type of degree);</li>'
            . '<li>The normal period of study has changed;</li>'
            . '<li>The enrolment cycle has changed;</li>'
            . '<li>The institution makes changes to the curriculum with the following consequences:'
            . '<ol type="a">'
            . '<li>Compulsory modules are removed and not replaced (including practical modules and the final thesis);</li>'
            . '<li>A complete change in the learning objectives of several compulsory modules (including practical modules and the final thesis);</li>'
            . '<li>Changes to the general study conditions, where the changes are not justified by improvements undertaken as a result of the quality assurance process;</li>'
            . '</ol>'
            . '</li>'
            . '<li>A new main focus or specialisation option is introduced;</li>'
            . '<li>A reduction in staff and/or infrastructure has been implemented;</li>'
            . '<li>The change would lead to a breach of applicable legal regulations or other binding statutory requirements.</li>'
            . '</ol>'
            . '<b>Principally, a significant change has not occurred if</b> <br/>'
            . '<ol type="1">'
            . '<li>Improvements arising from the institution’s quality assurance or quality management system are implemented – unless the changes are in breach of applicable legal regulations or other binding statutory requirements.</li>'
            . '<li>Modules are brought up-to-date with the latest research within the scope of the objectives of the programme.</li>'
            . '<li>Additional modules are added to the range of elective or compulsory elective modules, and their learning objectives are in accordance with the goals of the programme as a whole.</li>'
            . '<li>In individual cases, the designation of modules is altered in keeping with the latest research.</li>'
            . '<li>The credit points awarded for modules are adjusted to reflect the actual workload, as long as the total number of credits for the programme is not thereby changed.</li>'
            . '<li>Modifications are made to the quality assurance system in the course of its ongoing development.</li>'
            . '<li>Staff are replaced.</li>'
            . '</ol>'
            . 'These lists are not conclusive and may be expanded. If in doubt, higher education institutions are requested to report changes to the ASIIN office. <br/> <br/>'
            . '<b>Procedure</b> <br/>'
            . 'The procedure in the case of a significant change is organised as follows: <br/>'
            . '<ul type="circle">'
            . '<li>n the case of significant changes which are reported in the process of meeting a requirement, the change will be evaluated by the auditors, Technical Committees and the Accreditation Commission during the assessment of whether the requirement has been fulfilled.</li>'
            . '<li>For all subsequent changes, the following procedure is used:'
            . '<ol type="a">'
            . '<li>The higher education institution submits an informal request for the change to be assessed and for the accreditation to remain in force. This request includes a description of the change in question.</li>'
            . '<li>The documentation is assessed by the responsible Technical Committee(s). The Technical Committee chooses one of the following options on behalf of the Accreditation Commission and according to its instructions:'
            . '<ol type="1">'
            . '<li>The change is not significant.</li>'
            . '<li>Although the change is significant, there is no need to carry out a new accreditation procedure (i.e. the change does not compromise the existing accreditation).</li>'
            . '<li>The change is significant and it cannot be covered by the existing accreditation since it might lead to a decrease of quality. If the change is to be implemented or retained, a new accreditation procedure will need to be initiated (i.e. the existing accreditation will lose its validity if the change has already been implemented and is not revoked).</li>'
            . '</ol>'
            . '</li>'
            . '<li>In case (1), the institution is informed of the Technical Committee’s decision and the procedure is concluded.</li>'
            . '<li>In case (2), the Technical Committee may request a new assessment from all or some of the peers or, if required due to the nature of the change, new peers may be asked for their opinion. The Committee will then decide whether a new accreditation procedure is necessary. The Technical Committee forwards its recommendation, possibly including the opinion of the peers, to the Accreditation Commission, which then makes the final decision.</li>'
            . '<li>In case (3), a new accreditation procedure must be initiated.</li>'
            . '</ol>'
            . '</li>'
            . '</ul>'
            . 'The procedure for a significant change can also be carried out based on a higher education institution’s plans and concepts in order to give the institution the opportunity to assess consequences for the existing accreditation before implementing a change. <br/> <br/>Several proposed changes which affect the same programme of studies may be covered in a single procedure.');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
