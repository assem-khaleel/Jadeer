<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of ssri_g_evaluation_2_administration
 *
 * @author ahmadgx
 */
class Ssri_G_Evaluation_2_Administration extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '2. Governance and Administration';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_overall_rating('');
            $this->set_provide_effective('');
            $this->set_explanatory_report('');
            $this->set_standard_description('');
            $this->set_report_on_sub_standards('');
            $this->set_2_1('');
            $this->set_2_2('');
            $this->set_2_3('');
            $this->set_2_4('');
            $this->set_2_5('');
            $this->set_2_6('');
            $this->set_2_7('');
            $this->set_2_8('');
            $this->set_quality_mission('');
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $standard = 2;
        $standard_obj = \Orm_Standard::get_one(['code' => 2]);

        $children = array();

        if(\License::get_instance()->check_module('kpi') && \Modules::load('kpi')) {
            $KPIs = \Orm_Kpi::get_all(array('standard_id' => $standard_obj->get_id(), 'college_id' => 0));
            if ($KPIs) {
                foreach ($KPIs as $kpi) {

                    $info = $kpi->get_info(\Orm_Kpi_Detail::TYPE_INSTITUTION);

                    $kpi_obj = new Kpi();
                    $kpi_obj->set_standard($standard);
                    $kpi_obj->set_kpi_id($kpi->get_id());
                    $kpi_obj->set_name("KPI {$info['code']}");
                    $kpi_obj->set_kpi_info($kpi->get_title());
                    $kpi_obj->set_kpi_ref_num($info['code']);
                    $kpi_obj->set_actual($info['actual_benchmarks']);
                    $kpi_obj->set_target($info['target_benchmarks']);
                    $kpi_obj->set_internal($info['internal_benchmarks']);
                    $kpi_obj->set_external($info['external_benchmarks']);
                    $kpi_obj->set_new_target($info['new_benchmarks']);
                    $children[] = $kpi_obj;
                }
            }
        } else {
            $kpi_1 = new kpi();
            $kpi_1->set_name('KPI S2.1');
            $kpi_1->set_kpi_info('2. Stakeholder evaluation of the Policy Handbook, including administrative flow chart and job responsibilities (Average rating on the adequacy of the Policy Handbook on a five- point scale in an annual survey of teaching staff and final year students).');
            $kpi_1->set_kpi_ref_num('S2.1');
            $children[] = $kpi_1;
        }

        $annexes = new Annexes_List();
        $annexes->set_standard($standard);
        $annexes->set_name("List of Annexes for standard {$standard}");
        $children[] = $annexes;

        return $children;
    }

    public function set_overall_rating($value)
    {
        $property = new \Orm_Property_Smart_Field('overall_rating', $value);
        $property->set_class('Node\ncai14\Ses_Standard_2_Overall');
        $property->set_function('get_combined_assessment');
        $property->add_filter('system_number', $this->get_system_obj()->get_system_number());
        $property->add_filter('parent_lft', $this->get_system_obj()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_system_obj()->get_parent_rgt());
        $property->set_description('Overall Rating');
        $this->set_property($property);
    }

    public function get_overall_rating()
    {
        return $this->get_property('overall_rating')->get_value();
    }

    public function set_provide_effective()
    {
        $property = new \Orm_Property_Fixedtext('provide_effective', 'The governing body must provide effective leadership in the interests of the institution as a whole and its clients, through policy development and processes for accountability.  Senior administrators must lead the activities of the institution effectively within a clearly defined governance structure. If there are separate sections for male and female students resources must be comparable in both sections, there must be effective communication between them, and full involvement in planning and decision making processes  Planning and management must occur within a framework of sound policies and regulations that ensure financial and administrative accountability, and provide an appropriate balance between coordinated planning and local initiative.');
        $this->set_property($property);
    }

    public function get_provide_effective()
    {
        return $this->get_property('provide_effective')->get_value();
    }

    public function set_explanatory_report($value)
    {
        $property = new \Orm_Property_Textarea('explanatory_report', $value);
        $property->set_description('Provide an explanatory report about aspects of governance and administration that are relevant to the matters referred to in this standard and are not already explained in the institutional profile. ');
        $this->set_property($property);
    }

    public function get_explanatory_report()
    {
        return $this->get_property('explanatory_report')->get_value();
    }

    public function set_standard_description($value)
    {
        $property = new \Orm_Property_Textarea('standard_description', $value);
        $property->set_description('Provide a description of the process for the preparation on this standard.');
        $this->set_property($property);
    }

    public function get_standard_description()
    {
        return $this->get_property('standard_description')->get_value();
    }

    public function set_report_on_sub_standards()
    {
        $property = new \Orm_Property_Fixedtext('report_on_sub_standard', "<strong>Report on sub-standards</strong> <br/> <br/>");
        $this->set_property($property);
    }

    public function get_report_on_sub_standards()
    {
        return $this->get_property('report_on_sub_standards')->get_value();
    }

    public function set_2_1($value)
    {
        $property = new \Orm_Property_Textarea('2_1', $value);
        $property->set_description('2.1 Governing Body');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				2.1.1 The governing body has as its primary objective the effective development of the institution in the interests of its students and the communities it serves.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.1.2  Membership of the governing body provides for the range of perspectives and expertise needed to guide the educational policies of the institution
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.1.3  Members of the governing body are familiar with the range of activities within the institution and the needs of the communities it serves.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.1.4  New members of the governing body are thoroughly inducted into their role with information about the institution and about the role and processes of the governing body  itself.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.1.5  The governing body periodically reviews the mission, goals and objectives of the institution.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.1.6  The governing body ensures that the mission goals and objectives of the institution are reflected in detailed planning and activities.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.1.7  The governing body monitors and accepts responsibility for the total operations of the institution, but avoids interference in management or academic affairs.  If there are concerns about detailed  academic matters these are referred back for further consideration but not changed by the governing body itself.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				 2.1.8  Sub committees of the governing body (including members of the governing body, senior faculty and staff, and outside persons as appropriate) are established to give detailed consideration to major responsibilities such as finance and budget, staffing policies and remuneration, strategic planning, and facilities.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.1.9  Responsibilities are defined in such a way that  the respective roles and responsibilities of the governing body for overall policy and accountability, the senior administration for management, and the academic decision making structures for academic  program development, are clearly differentiated, defined, and followed in practice.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.1.10  In a private institution the relative responsibilities of the owners or company directors and the governing body are clearly specified and avoid interference in academic matters.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.1.11  In their role as members of the governing body members who are also members of staff of the institution act in the interests of the institution as a whole rather than as representatives of sectional interests.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.1.12  The governing body regularly reviews its own effectiveness and develops plans for improvement in the way it operates.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_2_1()
    {
        return $this->get_property('2_1')->get_value();
    }

    public function set_2_2($value)
    {
        $property = new \Orm_Property_Textarea('2_2', $value);
        $property->set_description('2.2 Leadership');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				2.2.1  The responsibilities of administrators are clearly defined in position descriptions.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.2.2  Senior administrators (including the Rector or Dean and others throughout the institution) anticipate emerging issues and opportunities and exercise initiative in response.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.2.3  Administrators ensure that action needed in their area of responsibility is taken in an effective and timely manner.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.2.4 The levels of supervision and approval for academic affairs provide for monitoring of quality and approval of major changes by senior administrators and the senior academic committee while allowing appropriate flexibility at course and program levels. (eg. Departments  have delegated authority to change text and reference lists, modify planned teaching strategies, details of assessment tasks and updating of course content as far as possible subject to conditions set by the university council or other appropriate authority.) (see also section 4.1.3)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.2.5   Administrators encourage teamwork and cooperation in achievement of institutional goals and objectives within their area of responsibility.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.2.6  Administrators at all levels in the institution work cooperatively with colleagues in other sections of the institution to ensure effective overall functioning of the total institution.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.2.7 Administrators at all levels accept responsibility for the quality and effectiveness of activities within their area of responsibility regardless of whether those activities are undertaken by them personally or by others responsible to them.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				 2.2.8 When responsibilities are delegated to others this is done appropriately within a clearly defined reporting and accountability framework.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.2.9 Delegations are formally specified in documents signed by the person delegating and the person given delegated authority, and that describe clearly the limits of delegated responsibility and responsibility for reporting on decisions made.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.2.10 Regulations governing delegations of authority are established for the institution and approved by the governing board.  These regulations indicate key functions that cannot be delegated, and specify that delegation of authority to another person or organization does not remove responsibility for consequences of decisions made from the person giving the delegation.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.2.11  Administrators provide leadership and encourage and reward initiative on the part of subordinates within clear policy guidelines
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.2.12  Regular and constructive feedback is given on performance of subordinates in a manner that contributes to their personal and professional development
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.2.13 Senior administrators ensure that submissions to the governing body are fully documented and presented in a form that clearly identifies the policy issues for decision and the consequences of alternatives.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_2_2()
    {
        return $this->get_property('2_2')->get_value();
    }

    public function set_2_3($value)
    {
        $property = new \Orm_Property_Textarea('2_3', $value);
        $property->set_description('2.3 Planning Processes');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				2.3.1 A comprehensive strategic plan has been developed and provides a planning framework for all sections within the institution should be developed for the institution as a whole.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.3.2 Planning is strategic, incorporating priorities for development and appropriate sequencing of action to produce the most effective short-term and long term-results.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.3.3.Plans take full and realistic account of aspects of the external environment affecting development of the institution.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.3.4 The processes for developing major plans for the institution provide for involvement and understanding with stakeholders throughout the institutional community.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.3.5  When major planning decisions are announced they are effectively communicated to all concerned with impacts and requirements for different constituencies made clear.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.3.6 Implementation of plans is monitored in relation to short term and medium term targets and outcomes evaluated.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.3.7 Plans are reviewed, adapted and modified, and corrective action taken as required in response to operational developments, formative evaluation, and changing circumstances.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.3.8 Information management systems provide regular feedback on both ongoing routine activities and progress in strategic initiatives through key performance indicators and other information as required..
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.3.9 Risk management is included as an integral component of planning strategies with appropriate mechanisms developed for risk assessment and minimization.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.3.10  Strategic planning is integrated with annual and longer term budget processes with capacity for medium term adjustments as required.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_2_3()
    {
        return $this->get_property('2_3')->get_value();
    }

    public function set_2_4($value)
    {
        $property = new \Orm_Property_Textarea('2_4', $value);
        $property->set_description('2.4 Relationship Between Sections for Male and Female Students');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				2.4.1  Male and female sections are adequately represented in the membership of relevant committees and councils through processes that are consistent with bylaws and regulations of the Higher Council of Education.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.4.2 There is effective communication between members of committees and councils and between individuals in the different sections carrying out related activities.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.4.3 Programs, facilities and services are planned and resources provided that ensure comparable standards are achieved in each section, while taking account of variations appropriate for different needs.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.4.4 Quality indicators, evaluations and reports show results for both sections indicating similarities and differences as well as overall performance.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_2_4()
    {
        return $this->get_property('2_4')->get_value();
    }

    public function set_2_5($value)
    {
        $property = new \Orm_Property_Textarea('2_5', $value);
        $property->set_description('2.5 Institutional Integrity');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				2.5.1  Codes of practice for ethical and responsible behaviour have been developed that require that teaching and other staff and students, and all committees and organizations, act consistently with high standards of ethical conduct and avoidance of plagiarism in the conduct and reporting of research, in teaching, performance evaluation and assessment, and in the conduct of administrative and service activities.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.5.2  The institution regularly reviews and modifies its policies and procedures as necessary to ensure continuing high standards of ethical conduct.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.5.3  Administrators and others speaking on behalf of the institution represent it honestly and accurately to both internal and external agencies.  (Advertising and promotional material is always be truthful, avoids any actual or implied misrepresentations or exaggerated claims, or negative comments about other institutions.)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.5.4  Regulations are established and are consistently followed dealing with declarations of pecuniary interest or conflict of interest for faculty and staff at all levels of the institution . (The regulations apply to all staff,  the governing board and to all committees and other decision making bodies in the institution.)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.5.5  Hiring, disciplinary and dismissal practices are clearly documented and administered in a way that ensures fair treatment for all Saudi Arabian and expatriate teaching and other staff, whether appointed on a full time or part time basis.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_2_5()
    {
        return $this->get_property('2_5')->get_value();
    }

    public function set_2_6($value)
    {
        $property = new \Orm_Property_Textarea('2_6', $value);
        $property->set_description('2.6 Internal Policies and Regulations');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				2.6.1  A policy and procedures manual has been prepared setting out internal regulations  and procedures for dealing with major areas of activity within the institution.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.6.2  Terms of reference or statements of responsibility have been specified for major committees and administrative and academic positions and included in the policy and procedures manual.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.6.3  Policies and regulations are accessible to teaching and other staff and students including new members of staff, and members of committees. and effective strategies used to ensure they are understood and complied with.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.6.4 Student responsibilities, codes of conduct, and regulations affecting their behaviour are defined and made known to students when they begin studies at the institution.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.6.5 The institution has a program for the periodic review and amendment of all its policies and regulations over specified time periods.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_2_6()
    {
        return $this->get_property('2_6')->get_value();
    }

    public function set_2_7($value)
    {
        $property = new \Orm_Property_Textarea('2_7', $value);
        $property->set_description('2.7 Organizational Climate');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				2.7.1 A systematic approach is adopted by senior managers to develop and maintain a positive organizational climate.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.7.2  Opinions of staff on major initiatives are sought and information is provided on how those opinions have been considered and responded to.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.7.3   Significant achievements and contributions to the institution and the community by staff or students are recognized and appropriately acknowledged.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.7.4   Information about issues, plans and developments at the institution are regularly communicated to teaching and other staff through means such as newsletters, internal publications or electronic communications.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.7.5 Responsibility is given to a senior administrator or central unit to conduct periodic surveys dealing with issues relevant to organizational climate including such matters as job satisfaction, confidence in future development, sense of involvement in planning and development.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_2_7()
    {
        return $this->get_property('2_7')->get_value();
    }

    public function set_2_8($value)
    {
        $property = new \Orm_Property_Textarea('2_8', $value);
        $property->set_description('2.8 Associated Companies and Controlled Entities (if applicable)');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				2.8.1 The functions of the controlled entities are appropriate for and consistent with the charter and mission of the institution
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.8.2  The administrative and financial relationship between the controlled entities and the institution are clearly specified.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.8.3   Reporting mechanisms are established that ensure that the governing body has effective oversight of the purposes, functions, and activities of the controlled entities
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.8.4   Audited financial reports on the financial affairs of the controlled entities are reviewed regularly by the relevant committee of the governing body.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.8.5   Administrative arrangements and planning mechanisms for activities of the controlled entity should provide for adequate risk assessment including protection for the institution against financial or legal liabilities.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.8.6   In any arrangement under which an institution contracts out to another organization the provision of services to students or to future students (eg. a preparatory year program) the service contract should include requirements to meet all relevant quality standards.  (The institution will be held responsible for ensuring the standards are met.)
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_2_8()
    {
        return $this->get_property('2_8')->get_value();
    }

    public function set_quality_mission($value)
    {
        $property = new \Orm_Property_Textarea('quality_mission', $value);
        $property->set_description('Overall Evaluation of Quality of Standard 2.  Refer to evidence obtained and provide a report based on that evidence; including a list of particular strengths, recommendations for improvement, and priorities for action');
        $this->set_property($property);
    }

    public function get_quality_mission()
    {
        return $this->get_property('quality_mission')->get_value();
    }

}
