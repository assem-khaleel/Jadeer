<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Migration_Initial
*
* @property CI_DB_forge $dbforge
* @property CI_Config $config
* @property CI_Loader $load
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Migration_Data_Standards extends CI_Migration {

    const KPI_QUALITATIVE = 1;
    const KPI_QUANTITATIVE = 2;
    
    public function up() {

        $standards = [
            [
                'code' => '1',
                'title' => 'Mission Goals and Objectives',
                'criteria' => [
                    [
                        'code' => '1.1',
                        'title' => 'Appropriateness of the Mission',
                        'items' => [
                            ['code' => '1.1.1', 'title' => 'The mission should be consistent with the establishment charter of the institution. (including any objectives or purposes in by-laws or regulations, company objectives or comparable documents.)'],
                            ['code' => '1.1.2', 'title' => 'The mission should be appropriate for an institution of its type (for example a small private college, a research university, a women’s college in a regional community, etc.)'],
                            ['code' => '1.1.3', 'title' => 'The mission should be consistent with Islamic beliefs and values.'],
                            ['code' => '1.1.4', 'title' => 'The mission should be relevant to the needs of the community or communities served by the institution.'],
                            ['code' => '1.1.5', 'title' => 'The mission should be consistent with the economic and cultural requirements of the Kingdom of Saudi Arabia.'],
                            ['code' => '1.1.6', 'title' => 'The appropriateness of the mission should be explained to stakeholders in an accompanying written statement commenting on significant aspects of the environment within which the institution operates. (which may relate to local, national or international issues)']
                        ]
                    ],
                    [
                        'code' => '1.2',
                        'title' => 'Usefulness of the Mission Statement',
                        'items' => [
                            ['code' => '1.2.1', 'title' => 'The mission statement should be sufficiently specific to provide an effective guide for decision-making and choices among alternative planning strategies.'],
                            ['code' => '1.2.2', 'title' => 'The mission should be relevant to all of the institution’s important activities.'],
                            ['code' => '1.2.3', 'title' => 'The mission should be achievable through effective strategies that can be implemented within the level of resources expected to be available.'],
                            ['code' => '1.2.4', 'title' => 'The mission statement should be clear enough to provide criteria for evaluation of progress towards the institutions goals and objectives.'],
                        ]
                    ],
                    [
                        'code' => '1.3',
                        'title' => 'Development and Review of the Mission',
                        'items' => [
                            ['code' => '1.3.1', 'title' => 'The mission should be defined in consultation with and with the support of major stakeholders in the institution and its community'],
                            ['code' => '1.3.2', 'title' => 'The mission should be formally approved by the governing body of the institution.'],
                            ['code' => '1.3.3', 'title' => 'The mission should be periodically reviewed and reaffirmed or amended as appropriate in the light of changing circumstances.'],
                            ['code' => '1.3.4', 'title' => 'Stakeholders should be kept informed about the mission and any changes in it.']
                        ]
                    ],
                    [
                        'code' => '1.4',
                        'title' => 'Use Made of the Mission',
                        'items' => [
                            ['code' => '1.4.1', 'title' => 'The mission should be used as the basis for a strategic plan over a specified medium term (eg. 5 year) planning period.'],
                            ['code' => '1.4.2', 'title' => 'The mission should be publicised widely within the institution and action taken to ensure that it is known about and supported by teaching and other staff and students.'],
                            ['code' => '1.4.3', 'title' => 'The mission should be consistently used as a guide in resource allocation and major program, project or policy decisions.']
                        ]
                    ],
                    [
                        'code' => '1.5',
                        'title' => 'Relationship Between Mission, Goals and Objectives',
                        'items' => [
                            ['code' => '1.5.1', 'title' => 'Medium and long term goals for the development of the institution and its programs and organizational units should be consistent with and support the mission.'],
                            ['code' => '1.5.2', 'title' => 'Goals should be stated clearly enough to guide planning and decision making in ways that are consistent with the mission.'],
                            ['code' => '1.5.3', 'title' => 'The goals for development should be periodically reviewed in the light of changing circumstances to ensure that they continue to be appropriate and support the mission.'],
                            ['code' => '1.5.4', 'title' => 'Specific objectives established for total institutional initiatives and for activities of organizational units within it should be consistent with the mission and broader goals for development derived from it.'],
                            ['code' => '1.5.5', 'title' => 'Statements of major objectives should be accompanied by specification of clearly defined and measurable indicators that are used to judge the extent to which objectives are being achieved.']
                        ]
                    ],
                    [
                        'code' => '1.5',
                        'title' => 'Relationship Between Mission, Goals and Objectives',
                        'items' => [
                            ['code' => '1.5.1', 'title' => 'Medium and long term goals for the development of the institution and its programs and organizational units should be consistent with and support the mission.'],
                            ['code' => '1.5.2', 'title' => 'Goals should be stated clearly enough to guide planning and decision making in ways that are consistent with the mission.'],
                            ['code' => '1.5.3', 'title' => 'The goals for development should be periodically reviewed in the light of changing circumstances to ensure that they continue to be appropriate and support the mission.'],
                            ['code' => '1.5.4', 'title' => 'Specific objectives established for total institutional initiatives and for activities of organizational units within it should be consistent with the mission and broader goals for development derived from it.'],
                            ['code' => '1.5.5', 'title' => 'Statements of major objectives should be accompanied by specification of clearly defined and measurable indicators that are used to judge the extent to which objectives are being achieved.']
                        ]
                    ],
                    [
                        'code' => '1.6',
                        'title' => 'KPIs',
                        'type' => '2',
                        'kpis' => [
                            ['code' => 'S1.1', 'type' => self::KPI_QUALITATIVE, 'title' => 'Stakeholders\' awareness ratings of the Mission Statement and Objectives (Average rating on how well the mission is known to teaching staff, and undergraduate and graduate students, respectively, on a five- point scale in an annual survey).']
                        ]
                    ],
                    [
                        'code' => '1.7',
                        'title' => 'College KPIs',
                        'type' => '3',
                        'kpis' => [
                        ]
                    ]
                ]
            ],
            [
                'code' => '2',
                'title' => 'Governance and Administration',
                'criteria' => [
                    [
                        'code' => '2.1',
                        'title' => 'Governing Body',
                        'items' => [
                            ['code' => '2.1.1', 'title' => 'The governing body should have as its primary objective the effective development of the institution in the interests of its students and the communities it serves.'],
                            ['code' => '2.1.2', 'title' => 'Membership of the governing body should include individuals with the range of perspectives and expertise needed to guide the educational policies of the institution.'],
                            ['code' => '2.1.3', 'title' => 'The members of the governing body should be familiar with the range of activities of the institution and the needs of the communities it serves.'],
                            ['code' => '2.1.4', 'title' => 'New members of the governing body should be thoroughly inducted into their role with information about the institution, and the role and processes of the governing body itself.'],
                            ['code' => '2.1.5', 'title' => 'The governing body should periodically review the mission, goals and objectives of the institution through processes that give all sections of the community an opportunity to contribute their views.'],
                            ['code' => '2.1.6', 'title' => 'The governing body should ensure that the mission, goals and objectives of the institution are reflected in detailed planning and activities.'],
                            ['code' => '2.1.7', 'title' => 'The governing body should monitor and accept responsibility for the total operations of the institution, but avoid interference in management or academic affairs. If there are concerns about academic matters these should be referred back for further consideration but not changed by the governing body itself.'],
                            ['code' => '2.1.8', 'title' => 'The governing body should establish sub committees (including members of the governing body, senior faculty and staff, and outside persons as appropriate) to give detailed consideration to major responsibilities such as finance and budget, staffing policies and remuneration, strategic planning, and facilities.'],
                            ['code' => '2.1.9', 'title' => 'The responsibilities of the governing body should be defined in such a way that the respective roles and responsibilities of the governing body for overall policy and accountability, the senior administration for management, and the academic decision making structures for academic program development, are clearly differentiated, defined, and followed in practice.'],
                            ['code' => '2.1.10', 'title' => 'In a private institution, the relative responsibilities of the governing body and the owners or company directors should be clearly defined and avoid interference in academic matters.'],
                            ['code' => '2.1.11', 'title' => 'In their role as members of the governing body, those who are also members of faculty or staff of the institution should act in the interests of the institution as a whole rather than as representatives of sectional interests.'],
                            ['code' => '2.1.12', 'title' => 'The governing body should regularly review its own effectiveness and develop and implement plans for improvement in the way it operates.'],
                        ]
                    ],
                    [
                        'code' => '2.2',
                        'title' => 'Leadership',
                        'items' => [
                            ['code' => '2.2.1', 'title' => 'The responsibilities of administrators should be clearly defined in position descriptions.'],
                            ['code' => '2.2.2', 'title' => 'Administrators should anticipate issues and opportunities and exercise initiative in response.'],
                            ['code' => '2.2.3', 'title' => 'Administrators should ensure that action needed in their area of responsibility is taken in an effective and timely manner.'],
                            ['code' => '2.2.4', 'title' => 'The levels of supervision and approval for academic affairs should provide for monitoring of quality and approval of major changes by senior administrators and the senior academic committee while allowing appropriate flexibility at course and program levels. (eg. departments should have delegated authority to change text and reference lists, modify planned teaching strategies, details of assessment tasks and updating of course content as far as possible subject to conditions set by the university council or other responsible authority.)(see also section 4.1.3)'],
                            ['code' => '2.2.5', 'title' => 'Administrators should encourage teamwork and cooperation in achievement of institutional goals and objectives within their areas of responsibility.'],
                            ['code' => '2.2.6', 'title' => 'Administrators at all levels in the institution should work cooperatively with colleagues in other sections of the institution to ensure effective overall functioning of the total institution.'],
                            ['code' => '2.2.7', 'title' => 'Administrators at all levels should accept responsibility for the quality and effectiveness of activities within their area of responsibility regardless of whether those activities are undertaken by them personally or by others responsible to them.'],
                            ['code' => '2.2.8', 'title' => 'When responsibilities are delegated to others this should be done appropriately within a clearly defined reporting and accountability framework.'],
                            ['code' => '2.2.9', 'title' => 'Delegations should be formally specified in documents signed by the person delegating and the person given delegated authority, that describe clearly the limits of delegated responsibility and responsibility for reporting on decisions made.'],
                            ['code' => '2.2.10', 'title' => 'Regulations governing delegations of authority should be established for the institution and approved by the governing board. These regulations should indicate key functions that cannot be delegated, and specify that delegation of authority to another person or organization does not remove responsibility for consequences of decisions made from the person giving the delegation.'],
                            ['code' => '2.2.11', 'title' => 'Administrators should provide leadership, and encourage and reward initiative on the part of subordinates within clearly defined policy guidelines.'],
                            ['code' => '2.2.12', 'title' => 'Regular and constructive feedback should be given on performance of subordinates in a manner that contributes to their personal and professional development'],
                            ['code' => '2.2.13', 'title' => 'Senior administrators should ensure that submissions to the governing body are fully documented and presented in a form that clearly identifies policy issues for decision and the consequences of alternatives.'],
                        ]
                    ],
                    [
                        'code' => '2.3',
                        'title' => 'Planning Processes',
                        'items' => [
                            ['code' => '2.3.1', 'title' => 'A comprehensive strategic plan that provides a planning framework for all sections within the institution should be developed for the institution as a whole.'],
                            ['code' => '2.3.2', 'title' => 'Planning throughout the institution should be strategic, incorporating priorities for development and appropriate sequencing of action to produce the most effective short-term and long-term results.'],
                            ['code' => '2.3.3', 'title' => 'Plans should take full and realistic account of aspects of the internal and external environment affecting development of the institution.'],
                            ['code' => '2.3.4', 'title' => 'Planning processes should provide for appropriate levels of involvement and understanding with stakeholders throughout the institutional community.'],
                            ['code' => '2.3.5', 'title' => 'Plans should be effectively communicated to all concerned, with impacts and requirements made clear for different constituencies.'],
                            ['code' => '2.3.6', 'title' => 'Implementation of plans should be monitored with checks made against short term and medium term targets and outcomes evaluated.'],
                            ['code' => '2.3.7', 'title' => 'Plans should be reviewed, adapted and modified, with corrective action taken as required in response to operational developments, formative evaluation, and changing circumstances.'],
                            ['code' => '2.3.8', 'title' => 'Plans should be directly linked to information management systems that provide regular feedback on both ongoing routine activities and progress in strategic initiatives through key performance indicators and other information as required.'],
                            ['code' => '2.3.9', 'title' => 'Risk assessment and management should be an integral component of planning strategies with appropriate mechanisms developed for risk assessment and minimization.'],
                            ['code' => '2.3.10', 'title' => 'Strategic planning should be integrated with annual and longer term budget processes that provide for medium term adjustments as required.']
                        ]
                    ],
                    [
                        'code' => '2.4',
                        'title' => 'Relationship Between Sections for Male and Female Students',
                        'items' => [
                            ['code' => '2.4.1', 'title' => 'Male and female sections should be adequately represented in the membership of relevant committees and councils and participate fully in decision making through processes that are consistent with bylaws and regulations of the Higher Council of Education.'],
                            ['code' => '2.4.2', 'title' => 'There should be effective communication between members from each section on these committees and councils, and individuals in the different sections carrying out related activities should be fully involved in planning, evaluations and decision making.'],
                            ['code' => '2.4.3', 'title' => 'Planning processes and mechanisms for performance evaluation should lead to comparable standards in each section while taking account of differing needs.'],
                            ['code' => '2.4.4', 'title' => 'Quality indicators, evaluations and reports should show results for both sections indicating similarities and differences as well as overall performance.']
                        ]
                    ],
                    [
                        'code' => '2.5',
                        'title' => 'Integrity',
                        'items' => [
                            ['code' => '2.5.1', 'title' => 'Codes of practice for ethical and responsible behaviour should be established to require that teaching and other staff and students, and all committees and organizations, act consistently with high standards of ethical conduct and avoidance of plagiarism in the conduct and reporting of research, in teaching, performance evaluation and assessment, and in the conduct of administrative and service activities.'],
                            ['code' => '2.5.2', 'title' => 'Policies and procedures should be regularly reviewed and modified as necessary to ensure continuing high standards of ethical conduct.'],
                            ['code' => '2.5.3', 'title' => 'The institution should represent itself honestly and accurately to internal constituencies and external agencies and the general public. (Advertising and promotional material should always be truthful, provide complete information, and avoid any actual or implied misrepresentations or exaggerated claims, or negative comments about other institutions.)'],
                            ['code' => '2.5.4', 'title' => 'Regulations should be established to provide for declarations of pecuniary interest and avoidance of conflict of interest and these regulations should be consistently followed. The regulations should apply to all staff, to the governing board and to all committees and other decision making bodies in the institution.'],
                            ['code' => '2.5.5', 'title' => 'Hiring, disciplinary and dismissal practices should be clearly documented and administered in a way that ensures fair treatment for all Saudi Arabian and expatriate teaching and other staff, whether appointed on a full time or part time basis.']
                        ]
                    ],
                    [
                        'code' => '2.6',
                        'title' => 'Internal Policies and Regulations',
                        'items' => [
                            ['code' => '2.6.1', 'title' => 'The institution should establish and maintain a policy and procedures manual setting out internal regulations and procedures for dealing with all major areas of activity within the institution.'],
                            ['code' => '2.6.2', 'title' => 'Terms of reference or statements of responsibility should be established for major committees and administrative and academic positions within the institution and included in the policy and procedures manual.'],
                            ['code' => '2.6.3', 'title' => 'Policies, regulations and related documents should be made available and kept in locations that are readily accessible to all teaching and other staff and students who are affected by them, including new members of teaching and other staff, and members of committees.'],
                            ['code' => '2.6.4', 'title' => 'Student responsibilities, codes of conduct, and regulations affecting their behaviour should be specified and made known to students before they begin their studies at the institution and regularly thereafter.'],
                            ['code' => '2.6.5', 'title' => 'A systemic program of review should be followed through which all policies, regulations, terms of reference and statements of responsibility are periodically reviewed.']
                        ]
                    ],
                    [
                        'code' => '2.7',
                        'title' => 'Organizational Climate',
                        'items' => [
                            ['code' => '2.7.1', 'title' => 'Developing and maintaining a positive organizational climate should be taken seriously by senior administrators and appropriate strategies adopted and disseminated throughout the institution to achieve this result.'],
                            ['code' => '2.7.2', 'title' => 'Opinions of teaching and other staff should be sought on major initiatives and information provided on how those opinions have been considered and responded to.'],
                            ['code' => '2.7.3', 'title' => 'Significant achievements and contributions to the institution or the community by teaching and other staff or students should be recognized and appropriately acknowledged.'],
                            ['code' => '2.7.4', 'title' => 'Information about issues, plans and developments at the institution should be regularly communicated to teaching and other staff through means such as newsletters, internal publications or electronic communications.'],
                            ['code' => '2.7.5', 'title' => 'Responsibility should be given to a senior administrator or central unit to conduct periodic surveys dealing with issues relevant to organizational climate including such matters as job satisfaction, confidence in future development, sense of involvement in planning and development.']
                        ]
                    ],
                    [
                        'code' => '2.8',
                        'title' => 'Associated Companies and Controlled Entities',
                        'items' => [
                            ['code' => '2.8.1', 'title' => 'The institution should ensure that there is consistency between the functions of any associated companies or controlled entities and the establishment charter and mission of the institution.'],
                            ['code' => '2.8.2', 'title' => 'Policies affecting the controlled entity including administrative and financial relationships with the institution should be clearly specified.'],
                            ['code' => '2.8.3', 'title' => 'Reporting mechanisms should be established that ensure that the governing body has effective oversight of the activities of the controlled entity.'],
                            ['code' => '2.8.4', 'title' => 'Audited financial reports on the financial affairs of the controlled entity should be reviewed regularly by the relevant committee of the governing body.'],
                            ['code' => '2.8.5', 'title' => 'Administrative arrangements and planning mechanisms for activities of the controlled entity should provide for adequate risk assessment including protection for the institution against financial or legal liabilities.'],
                            ['code' => '2.8.6', 'title' => 'In any arrangement under which an institution contracts out to another organization the provision of services to students or to future students (eg. a preparatory year program) the service contract should include requirements to meet all relevant quality standards. (The institution will be held responsible for ensuring the standards are met.)']
                        ]
                    ],
                    [
                        'code' => '2.9',
                        'title' => 'KPIs',
                        'type' => '2',
                        'kpis' => [
                            ['code' => 'S2.1', 'type' => self::KPI_QUALITATIVE, 'title' => 'Stakeholder evaluation of the Policy Handbook, including administrative flow chart and job responsibilities (Average rating on the adequacy of the Policy Handbook on a five- point scale in an annual survey of teaching staff and final year students).'],
                        ]
                    ],
                    [
                        'code' => '2.10',
                        'title' => 'College KPIs',
                        'type' => '3',
                        'kpis' => [
                        ]
                    ]
                ]
            ],
            [
                'code' => '3',
                'title' => 'Management of Quality Assurance and Improvement',
                'criteria' => [
                    [
                        'code' => '3.1',
                        'title' => 'Institutional Commitment to Quality Improvement',
                        'items' => [
                            ['code' => '3.1.1', 'title' => 'The Rector or Dean should give strong support for quality assurance improvement activities.'],
                            ['code' => '3.1.2', 'title' => 'Adequate resources should be provided for the leadership and management of quality assurance processes.'],
                            ['code' => '3.1.3', 'title' => 'All teaching and other staff should participate in self-evaluations and cooperate with reporting and improvement processes in their sphere of activity.'],
                            ['code' => '3.1.4', 'title' => 'Innovation and creativity should be encouraged at all levels in the organization within a framework of clear policy guidelines and accountability processes.'],
                            ['code' => '3.1.5', 'title' => 'Mistakes and weaknesses should be recognized by those responsible and used as a basis for planning for improvement.'],
                            ['code' => '3.1.6', 'title' => 'Improvements in performance and outstanding achievements should be recognized'],
                            ['code' => '3.1.7', 'title' => 'Evaluation and planning for improvement should be integrated into normal planning processes.']
                        ]
                    ],
                    [
                        'code' => '3.2',
                        'title' => 'Scope of Quality Assurance Processes',
                        'items' => [
                            ['code' => '3.2.1', 'title' => 'All academic and administrative units within the institution (including the governing body and senior management) should participate in the processes of quality assurance and improvement'],
                            ['code' => '3.2.2', 'title' => 'Regular evaluations should be carried out and reports prepared that provide an overview of performance for the institution as a whole and for organizational units and major functions within it'],
                            ['code' => '3.2.3', 'title' => 'Evaluations should consider inputs and processes and outcomes but give particular attention to quality of outcomes.'],
                            ['code' => '3.2.4', 'title' => 'Evaluations should deal with performance in relation to continuing routine activities as well as to strategic objectives.'],
                            ['code' => '3.2.5', 'title' => 'Evaluations should ensure that required standards are met, and also that there is continuing improvement in performance.'],
                            ['code' => '3.2.6', 'title' => 'Institutional research relevant to the achievement of the institution’s goals and objectives and the monitoring and improvement of quality should be carried out and the results made known to senior management and the institutional community.']
                        ]
                    ],
                    [
                        'code' => '3.3',
                        'title' => 'Administration of Quality Assurance Processes',
                        'items' => [
                            ['code' => '3.3.1', 'title' => 'Responsibility should be assigned and sufficient time given for a senior member of faculty to provide guidance and support for the quality processes within the institution.'],
                            ['code' => '3.3.2', 'title' => 'A quality center should be established within the institution’s central administration and sufficient staff, resources and administrative support given for the center to operate effectively.'],
                            ['code' => '3.3.3', 'title' => 'A quality committee should be formed with members drawn from all major sections of the institution. (as a general guideline this might involve 12 to 15 members and in a large institution might require representatives from groups of colleges in similar fields rather than from each college)'],
                            ['code' => '3.3.4', 'title' => 'A member of the institution’s senior administration should be appointed to chair the committee. (This person should normally be at the level of a vice rector in a university or a deputy dean in a college and work closely with the director of the quality center in leading and supporting quality initiatives throughout the institution.)'],
                            ['code' => '3.3.5', 'title' => 'The roles and responsibilities of the quality center and committee, and the relationship of these to other administrative and planning units should be clearly specified.'],
                            ['code' => '3.3.6', 'title' => 'If quality assurance functions are managed by more than one organizational unit, their activities should be effectively coordinated under the supervision of a senior administrator'],
                            ['code' => '3.3.7', 'title' => 'Quality assurance functions throughout the organization should be fully integrated into normal planning and development strategies in a defined cycle of planning, implementation, assessment and review.'],
                            ['code' => '3.3.8', 'title' => 'Evaluations should be (i) based on evidence, (ii) linked to appropriate standards, (iii) include predetermined performance indicators, and (iv) take account of independent verification of interpretations.'],
                            ['code' => '3.3.9', 'title' => 'Common forms and survey instruments should be used for similar activities across the institution (eg. courses, programs, libraries, etc) and responses used in independent analyses of results including trends over time. (This does not preclude additional questions relevant to different programs or special instruments dealing with particular functions eg. specialized libraries or student services) Survey data should be collected from students and analysed for individual courses, the program as a whole, and also from graduates and employers of those graduates.'],
                            ['code' => '3.3.10', 'title' => 'Statistical data (including pass rates, progression and completion rates and other data required for indicators) should be retained in an accessible central data base and provided routinely and promptly to colleges and departments (normally each semester or at least annually) for their use in preparation of reports on indicators and other tasks in monitoring quality.'],
                            ['code' => '3.3.11', 'title' => 'The quality assurance arrangements should themselves be regularly evaluated, reported on and improved in a comparable manner to other functions within the institution. As part of these reviews unnecessary requirements should be removed to streamline the system and avoid unnecessary work.'],
                            ['code' => '3.3.12', 'title' => 'Processes for evaluation of quality should be transparent with criteria for judgments and evidence considered made clear.']
                        ]
                    ],
                    [
                        'code' => '3.4',
                        'title' => 'Use of Performance Indicators and Benchmarks',
                        'items' => [
                            ['code' => '3.4.1', 'title' => 'A limited number of key performance indicators that are capable of objective measurement should be identified for monitoring and evaluation of the performance of sections within the institution (including colleges and departments) and of the institution as a whole.'],
                            ['code' => '3.4.2', 'title' => 'Additional key performance indicators should be selected for monitoring the performance of different academic and administrative units within the institution.'],
                            ['code' => '3.4.3', 'title' => 'When functions are carried out in a number of different academic or administrative units there should be some common indicators and these should be used for comparisons of performance within the institution as well as for overall institutional evaluation.'],
                            ['code' => '3.4.4', 'title' => 'Benchmarks for comparing quality of performance should be established for the institution as a whole, and for academic and administrative units. These benchmarks should include past performance at the institution but must also include appropriate external comparisons for selected important items'],
                            ['code' => '3.4.5', 'title' => 'Key performance indicators and benchmarks identified for major organizational units or functions should be approved by the appropriate senior committee or council within the institution (eg. senior academic committee, university council)'],
                            ['code' => '3.4.6', 'title' => 'The format for specifying indicators and benchmarks should be consistent across the institution.']
                        ]
                    ],
                    [
                        'code' => '3.5',
                        'title' => 'Independent Verification of Evaluations',
                        'items' => [
                            ['code' => '3.5.1', 'title' => 'Self-evaluations of quality of performance should whenever possible be based on several related sources of evidence including feedback through user surveys and opinions of stakeholders such as students and teaching staff, graduates and employers.'],
                            ['code' => '3.5.2', 'title' => 'Conclusions based on interpretations of evidence should be verified through independent advice. This advice should be provided by persons familiar with the type of activity '],
                            ['code' => '3.5.3', 'title' => 'Standards of learning outcomes achieved by students should be checked in relation to the requirements of the National Qualifications Framework and standards at other comparable institutions']

                        ]
                    ],
                    [
                        'code' => '3.6',
                        'title' => 'KPIs',
                        'type' => '2',
                        'kpis' => [
                            ['code' => 'S3.1', 'type' => self::KPI_QUALITATIVE, 'title' => 'Students\' overall evaluation on the quality of their learning experiences. (Average rating of the overall quality on a five point scale in an annual survey of final year students.)'],
                            ['code' => 'S3.2', 'type' => self::KPI_QUANTITATIVE, 'title' => 'Proportion of courses in which student evaluations were conducted during the year.'],
                            ['code' => 'S3.3', 'type' => self::KPI_QUANTITATIVE, 'title' => 'Proportion of programs in which there was an independent verification, within the institution, of standards of student achievement during the year.'],
                            ['code' => 'S3.4', 'type' => self::KPI_QUANTITATIVE, 'title' => 'Proportion of programs in which there was an independent verification of standards of student achievement by people (evaluators) external to the institution during the year.'],
                        ]
                    ],
                    [
                        'code' => '3.7',
                        'title' => 'College KPIs',
                        'type' => '3',
                        'kpis' => [
                        ]
                    ]
                ]
            ],
            [
                'code' => '4',
                'title' => 'Learning and Teaching',
                'criteria' => [
                    [
                        'code' => '4.1',
                        'title' => 'Institutional Oversight of Quality of Learning and Teaching',
                        'items' => [
                            ['code' => '4.1.1', 'title' => 'New program proposals and proposals for major changes in programs should be thoroughly evaluated and approved by the institution’s senior academic committee.'],
                            ['code' => '4.1.2', 'title' => 'The evaluation of new programs or major changes in programs by the senior academic committee should include consideration of the matters described in the standard for learning and teaching, including any special requirements applicable to the field of study concerned, and requirements for graduates in that field in Saudi Arabia.'],
                            ['code' => '4.1.3', 'title' => 'Guidelines should be established defining the levels for reviewing indicators and reports on courses and programs. (for example a head of department might review and approve course reports for all courses and a departmental committee approve minor changes to keep courses up to date. A dean might review and approve program reports that include summary information about courses. The vice rector responsible for academic affairs, the quality committee and the senior academic committee might review and approve a general summary of program reports and data on key performance indicators, and approve more significant changes in programs.'],
                            ['code' => '4.1.4', 'title' => 'Senior academic committees should delegate and establish guidelines defining the levels for approval of changes in courses and programs. Minor changes required to keep programs up to date and respond to course and program evaluations should be made flexibly and rapidly at departmental level and more substantial changes referred to the relevant senior committees for approval'],
                            ['code' => '4.1.5', 'title' => 'Data on key performance indicators for all programs should be reviewed at least annually by senior administrators responsible for academic affairs, the institution’s quality committee and the institution’s senior academic committee, with overall institutional performance reported to the governing board.'],
                            ['code' => '4.1.6', 'title' => 'The institution should ensure that annual reports for all programs are prepared, and reviewed by department/college committees, and appropriate action taken in response to action recommendations in those reports.'],
                            ['code' => '4.1.7', 'title' => 'The institution should ensure that self evaluations using the self evaluation scales for higher education programs are undertaken periodically (eg. every two or three years) for each program and reports prepared for consideration by the quality committee and the relevant academic committees.'],
                            ['code' => '4.1.8', 'title' => 'Reports on the overall quality of programs for the institution as a whole should be prepared periodically (eg. every three years) for consideration within the institution indicating common strengths and weaknesses, and significant variations in quality between programs/departments and sections.'],
                            ['code' => '4.1.9', 'title' => 'Reports by departments to their college, or by departments or colleges to the central administration should be appropriately acknowledged with responses made to any queries or proposals made.'],
                            ['code' => '4.1.10', 'title' => 'The senior administrator responsible for academic affairs should take responsibility, in cooperation with the quality committee and deans/heads of department, for developing and implementing strategies for improvement when required, to deal with common issues affecting programs across the institution.'],
                            ['code' => '4.1.11', 'title' => 'Colleges/departments should cooperate with and support participation in general institutional strategies for improvement, and take additional initiatives to deal with quality issues found in their own programs.'],
                            ['code' => '4.1.12', 'title' => 'If programs are offered in different sections, including sections for male and female students, or in branch campuses, the standards of learning outcomes, the resources provided (including learning resources and staffing provisions and resources to undertake research) should be comparable in all sections. Data used for evaluations and performance indicators should be provided for all sections as well as for the programs in total.']
                        ]
                    ],
                    [
                        'code' => '4.2',
                        'title' => 'Student Learning Outcomes',
                        'items' => [
                            ['code' => '4.2.1', 'title' => 'Relevant academic and professional advice should be considered when defining intended learning outcomes.'],
                            ['code' => '4.2.2', 'title' => 'Intended learning outcomes should be consistent with the National Qualifications Framework. (covering all of the domains of learning at the standards required).'],
                            ['code' => '4.2.3', 'title' => 'Programs leading to professional qualifications should develop learning outcomes that meet requirements for professional practice in the Kingdom of Saudi Arabia in the fields concerned. (These requirements should include local accreditation requirements and also take account of international accreditation requirements for that field of study, and any Saudi Arabian regulations or regional needs.)'],
                            ['code' => '4.2.4', 'title' => 'Any special student attributes specified by the institution for its graduates should be incorporated as intended learning outcomes in all programs offered and appropriate teaching strategies and forms of student assessment used for them.'],
                            ['code' => '4.2.5', 'title' => 'Appropriate program evaluation mechanisms, including graduating student surveys, employment outcome data, employer feedback and subsequent performance of graduates, should be used to provide evidence about the appropriateness of intended learning outcomes and the extent to which they are achieved.']
                        ]
                    ],
                    [
                        'code' => '4.3',
                        'title' => 'Program Development Processes',
                        'items' => [
                            ['code' => '4.3.1', 'title' => 'Plans for delivery and evaluation of programs should be set out in detailed program specifications that include knowledge and skills to be acquired, and strategies for teaching and assessment for the progressive development of learning in all the domains of learning.'],
                            ['code' => '4.3.2', 'title' => 'Plans for courses should be set out in course specifications that include knowledge and skills to be acquired and strategies for teaching and assessment for the domains of learning to be addressed in each course.'],
                            ['code' => '4.3.3', 'title' => 'The content and strategies set out in course specifications should be coordinated and followed in practice to ensure effective progressive development of learning for the total program in all the domains of learning. '],
                            ['code' => '4.3.4', 'title' => 'Planning should include any action necessary to ensure that teaching staff are familiar with and are able to use the strategies included in the program and course specifications.'],
                            ['code' => '4.3.5', 'title' => 'The academic or professional fields for which students are being prepared should be monitored on a continuing basis with necessary adjustments made in programs and in text and reference materials to ensure continuing relevance and quality.'],
                            ['code' => '4.3.6', 'title' => 'In all professional programs continuing advisory panels with membership that includes leading practitioners from the relevant occupations or professions should be used to monitor and advise on content and quality of programs.'],
                            ['code' => '4.3.7', 'title' => 'New program proposals or major changes in programs should be assessed and approved or rejected by the institution’s senior academic committee using criteria that ensure thorough and appropriate consultation in planning and capacity for effective implementation.']
                        ]
                    ],
                    [
                        'code' => '4.4',
                        'title' => 'Program Evaluation and Review Processes',
                        'items' => [
                            ['code' => '4.4.1', 'title' => 'Courses and programs should be evaluated and reported on annually and reports should include information about the effectiveness of planned strategies and the extent to which intended learning outcomes are being achieved.'],
                            ['code' => '4.4.2', 'title' => 'When changes are made as a result of evaluations details of those changes and the reasons for them should be retained in course and program portfolios.'],
                            ['code' => '4.4.3', 'title' => 'Quality indicators that include learning outcome measures should be established for all courses and programs.'],
                            ['code' => '4.4.4', 'title' => 'Records of student completion rates should be kept for all courses and for programs as a whole and included among quality indicators.'],
                            ['code' => '4.4.5', 'title' => 'Reports on programs should be reviewed annually by senior administrators and quality committees'],
                            ['code' => '4.4.6', 'title' => 'Systems should be established for central recording and analysis of course completion and program progression and completion rates and student course and program evaluations, with summaries and comparative data distributed automatically to departments, colleges, senior administrators and relevant committees at least once each year.'],
                            ['code' => '4.4.7', 'title' => 'If problems are found through program evaluations appropriate action should be taken to make improvements, either within the program concerned or through institutional action as appropriate.'],
                            ['code' => '4.4.8', 'title' => 'In addition to annual evaluations a comprehensive reassessment of every program should be conducted at least once every five years. Policies and procedures for conducting these reassessments should be published within the institution.'],
                            ['code' => '4.4.9', 'title' => 'Program reviews should involve experienced people from relevant industries and professions, and experienced faculty from other institutions.'],
                            ['code' => '4.4.10', 'title' => 'In program reviews opinions about the quality of the program including the extent to which intended learning outcomes are achieved should be sought from students and graduates through surveys and interviews, discussions with faculty, and other stakeholders such as employers.']
                        ]
                    ],
                    [
                        'code' => '4.5',
                        'title' => 'Student Assessment',
                        'items' => [
                            ['code' => '4.5.1', 'title' => 'Student assessment mechanisms should be appropriate for the different forms of learning sought.'],
                            ['code' => '4.5.2', 'title' => 'Assessment practices should be clearly communicated to students at the beginning of courses.'],
                            ['code' => '4.5.3', 'title' => 'Appropriate, valid and reliable mechanisms should be used in programs throughout the institution for verifying standards of student achievement in relation to relevant internal and external benchmarks. The standard of work required for different grades should be consistent over time, comparable in courses offered within a program and college and the institution as a whole, and in comparison with other highly regarded institutions. (Arrangements for verifying standards may include measures such as check marking of random samples of student work by teaching staff at other institutions, and independent comparisons of standards achieved with other comparable institutions within Saudi Arabia, and internationally.)'],
                            ['code' => '4.5.4', 'title' => 'Grading of students tests, assignments and projects should be assisted by the use of matrices or other means to ensure that the planned range of domains of student learning outcomes are addressed.'],
                            ['code' => '4.5.5', 'title' => 'Arrangements should be made within the institution for training of teaching staff in the theory and practice of student assessment.'],
                            ['code' => '4.5.6', 'title' => 'Policies and procedures should include action to be taken to deal with situations where standards of student achievement are inadequate or inconsistently assessed.'],
                            ['code' => '4.5.7', 'title' => 'Effective procedures should be used to ensure that work submitted by students is actually done by the students concerned.'],
                            ['code' => '4.5.8', 'title' => 'Feedback to students on their performance and results of assessments during each semester should be given promptly and accompanied by mechanisms for assistance if needed.'],
                            ['code' => '4.5.9', 'title' => 'Assessments of student work should be conducted fairly and objectively.'],
                            ['code' => '4.5.10', 'title' => 'Criteria and processes for academic appeals are made known to students and administered equitably'],

                        ]
                    ],
                    [
                        'code' => '4.6',
                        'title' => 'Educational Assistance for Students',
                        'items' => [
                            ['code' => '4.6.1', 'title' => 'Teaching staff should be available at sufficient scheduled times for both full time and part time students as appropriate for consultation and advice to students. (this should be confirmed, not assumed because of planned arrangements).'],
                            ['code' => '4.6.2', 'title' => 'Teaching resources (including staffing, learning resources and equipment, and clinical or other field placements) should be sufficient to ensure achievement of the intended learning outcomes.'],
                            ['code' => '4.6.3', 'title' => 'If arrangements for student academic counselling and advice include electronic communications through email or other means the effectiveness of those processes should be evaluated through means such as analysis of response times and student evaluations.'],
                            ['code' => '4.6.4', 'title' => 'Adequate tutorial assistance should be provided to ensure understanding and ability to apply learning.'],
                            ['code' => '4.6.5', 'title' => 'Appropriate preparatory and orientation mechanisms should be used to prepare students for study in a higher education environment. Particular attention should be given to preparation for the language of instruction, self directed learning, and transition programs if necessary for students transferring to the institution with credit for previous studies. Preparatory studies must not be counted within the minimum credit hour requirements for programs.'],
                            ['code' => '4.6.6', 'title' => 'For any programs in which the language of instruction isother than Arabic, action should be taken to ensure that language skills are adequate for instruction in that language when students begin their studies. (This may be done through language training prior to admission to the program. Language skills expected on entry should be benchmarked against other highly regarded institutions with the objective of skills at least comparable to minimum requirements for admission of international students in universities in countries where that language is the native language. The benchmarking process should involve testing of at least a representative sample of students on major recognized language tests)'],
                            ['code' => '4.6.7', 'title' => 'If preparatory programs in other languages or other areas of learning are required and outsourced to other providers the institution offering the higher education program to which they are admitted must still accept responsibility for the effectiveness of those services and for ensuring the required standards for admission are met.'],
                            ['code' => '4.6.8', 'title' => 'Systems should be established within each program for monitoring and coordinating student workload across courses.'],
                            ['code' => '4.6.9', 'title' => 'Systems should be in place for monitoring the progress of individual students with assistance and/or counselling given to those facing difficulties.'],
                            ['code' => '4.6.10', 'title' => 'Year to year progression rates and program completion rates should be monitored and analysed to identify and provide assistance to any categories of students who may be having difficulty.'],
                            ['code' => '4.6.11', 'title' => 'Adequate facilities should be provided for private study, with access to computer terminals and other necessary equipment.'],
                            ['code' => '4.6.12', 'title' => 'Teaching staff should be familiar with the range of support services available in the institution for students, and should refer them to appropriate sources of assistance when required.'],
                            ['code' => '4.6.13', 'title' => 'The adequacy of arrangements for assistance to students should be periodically assessed through processes that include, but are not restricted to, feedback from students.'],

                        ]
                    ],
                    [
                        'code' => '4.7',
                        'title' => 'Student Assessment',
                        'items' => [
                            ['code' => '4.7.1', 'title' => 'Effective orientation and training programs should be provided within the institution for new, short term and part time staff. (To be effective these programs should ensure that teaching staff are fully briefed on required learning outcomes, on planned teaching and assessment strategies, and the contribution of their course to the program as a whole.)'],
                            ['code' => '4.7.2', 'title' => 'Teaching strategies should be appropriate for the different types of learning outcomes programs are intended to develop.'],
                            ['code' => '4.7.3', 'title' => 'Strategies of teaching and assessment set out in program and course specifications should be followed by teaching staff with flexibility to meet the needs of different groups of students.'],
                            ['code' => '4.7.4', 'title' => 'Students should be fully informed about course requirements in advance through course descriptions that include knowledge and skills to be developed, work requirements and assessment processes.'],
                            ['code' => '4.7.5', 'title' => 'The conduct of courses should be consistent with the outlines provided to students and with the course specifications.'],
                            ['code' => '4.7.6', 'title' => 'Textbooks and reference material should be up to date and incorporate the latest developments in the field of study.'],
                            ['code' => '4.7.7', 'title' => 'Textbooks and other required materials should be available in sufficient quantities before classes commence.'],
                            ['code' => '4.7.8', 'title' => 'Attendance requirements in courses should be made clear to students and compliance with these requirements monitored and enforced.'],
                            ['code' => '4.7.9', 'title' => 'Effective systems including but not limited to student surveys should be used for evaluation of courses and of teaching.'],
                            ['code' => '4.7.10', 'title' => 'The effectiveness of planned teaching strategies in achieving different types of learning outcomes should be regularly assessed and adjustments should be made in response to evidence about their effectiveness.'],
                            ['code' => '4.7.11', 'title' => 'Reports should be provided to program administrators on the delivery of each course and these should include details if any planned content could not be dealt with and any difficulties found in using planned strategies.'],
                            ['code' => '4.7.12', 'title' => 'Appropriate adjustments should be made in plans for teaching after consideration of course reports.']

                        ]
                    ],
                    [
                        'code' => '4.8',
                        'title' => 'Support for Improvements in Quality of Teaching',
                        'items' => [
                            ['code' => '4.8.1', 'title' => 'Training programs in teaching skills should be provided within the institution for both new and continuing teaching staff including those with part time teaching responsibilities.'],
                            ['code' => '4.8.2', 'title' => 'Training programs in teaching should include effective use of new and emerging technology.'],
                            ['code' => '4.8.3', 'title' => 'Adequate opportunities should be provided for additional professional and academic development of teaching staff, with special assistance given to any who are facing difficulties.'],
                            ['code' => '4.8.4', 'title' => 'The extent to which teaching staff are involved in professional development to improve quality of teaching should be monitored.'],
                            ['code' => '4.8.5', 'title' => 'Teaching staff should be encouraged to develop strategies for improvement of their own teaching and to maintain a portfolio of evidence of evaluations and strategies for improvement.'],
                            ['code' => '4.8.6', 'title' => 'Formal recognition should be given to outstanding teaching, and encouragement given for innovation and creativity.'],
                            ['code' => '4.8.7', 'title' => 'Strategies for improving quality of teaching should include improving the quality of learning materials and the teaching strategies incorporated in them.']

                        ]
                    ],
                    [
                        'code' => '4.9',
                        'title' => 'Qualifications and Experience of Teaching Staff',
                        'items' => [
                            ['code' => '4.9.1', 'title' => 'Teaching staff should have appropriate qualifications and experience for the courses they teach. (For undergraduate and masters degree programs this would normally require academic qualifications in their specific teaching area at least one level above that of the program in which they teach.)'],
                            ['code' => '4.9.2', 'title' => 'If part time teaching staff are appointed there should be an appropriate mix of full time and part time teaching staff. (As a general guideline at least 75 % of teaching staff should be employed on a full time basis).'],
                            ['code' => '4.9.3', 'title' => 'All teaching staff should be involved on a continuing basis in scholarly activities that ensure they remain up to date with the latest developments in their field and can involve their students in learning that incorporates those developments.'],
                            ['code' => '4.9.4', 'title' => 'Full time staff teaching post-graduate courses should be active in scholarship and research in the fields of study they teach.'],
                            ['code' => '4.9.5', 'title' => 'In professional programs teaching teams should include some experienced and highly skilled professionals in the field.']

                        ]
                    ],
                    [
                        'code' => '4.10',
                        'title' => 'Field Experience Activities',
                        'items' => [
                            ['code' => '4.10.1', 'title' => 'In programs that include field experience the intended student learning outcomes from the field experience should be clearly specified and effective processes followed to ensure that those learning outcomes, and strategies to develop that learning, are understood by students and supervising staff in the field setting.'],
                            ['code' => '4.10.2', 'title' => 'Supervising staff in field locations should be thoroughly briefed on their role and the relationship of the field experience to the program as a whole.'],
                            ['code' => '4.10.3', 'title' => 'Teaching staff from the institution should visit the field setting for observations and consultations with students and field supervisors often enough to provide proper oversight and support. (Normally at least twice during a field experience activity)'],
                            ['code' => '4.10.4', 'title' => 'Students should be thoroughly prepared for participation in the field experience through briefings and descriptive material.'],
                            ['code' => '4.10.5', 'title' => 'Students should be required to prepare a report on their field experience that is appropriate for the nature of the activity and the learning outcomes expected.'],
                            ['code' => '4.10.6', 'title' => 'Arrangements should be made through follow up meetings or classes for students to reflect on and generalize from their experience, applying that experience to situations likely to be faced in later employment.'],
                            ['code' => '4.10.7', 'title' => 'Field experience placements that are selected should have the capacity to develop the learning outcomes sought and their effectiveness in developing that learning should be evaluated.'],
                            ['code' => '4.10.8', 'title' => 'If supervisors in the field setting and teaching staff from the institution are both involved in student assessments, criteria for assessment should be clearly specified and explained, and procedures established for reconciling differing opinions.'],
                            ['code' => '4.10.9', 'title' => 'Provision should be made for evaluations of the field experience activity by students, by supervising staff in the field setting, and by teaching staff of the institution, and the results of those evaluations considered in subsequent planning.'],
                            ['code' => '4.10.10', 'title' => 'Preparations for the field experience should include a thorough risk assessment for all parties involved, and plans for responsible staff to minimize and deal with those risks.']

                        ]
                    ],
                    [
                        'code' => '4.11',
                        'title' => 'Partnership Arrangements With Other Institutions',
                        'items' => [
                            ['code' => '4.11.1', 'title' => 'The respective responsibilities of the local institution and the partner should be clearly defined in formal agreements enforceable under the laws of Saudi Arabia.'],
                            ['code' => '4.11.2', 'title' => 'The effectiveness of the partnership arrangements should be regularly reviewed.'],
                            ['code' => '4.11.3', 'title' => 'Briefings and consultations on course and program requirements should be adequate, and effective mechanisms should be available for ongoing consultation on emerging issues.'],
                            ['code' => '4.11.4', 'title' => 'Teaching staff from the partner institution who are familiar with the content of courses offered under the partnership arrangement should visit the local institution regularly for consultation about course details and standards of assessments.'],
                            ['code' => '4.11.5', 'title' => 'If arrangements involve assessment of student work by the partner institution in addition to assessments within the local institution, procedures should be used that ensure that final assessments are completed promptly and results made available to students within the time specified for reporting of student results under Saudi Arabian regulations.'],
                            ['code' => '4.11.6', 'title' => 'If programs are based on those of partner institutions, courses, assignments and examinations should be adapted to the local environment, avoid unfamiliar colloquial expressions, and use examples and illustrations relevant to the local setting where the programs are to be offered. This may require amended and/or supplementary materials, and special tutorial assistance to apply learning to the local environment'],
                            ['code' => '4.11.7', 'title' => 'Programs and courses should be consistent with the requirements of the Qualifications Framework for Saudi Arabia, and in vocational or professional programs, include regulations and conventions relevant to the Saudi Arabian environment.'],
                            ['code' => '4.11.8', 'title' => 'If courses or programs developed by a partner institution are delivered in Saudi Arabia adequate processes should be followed to ensure that standards of student achievement are at least equal to those achieved elsewhere by the partner institution as well as by other appropriate institutions selected for benchmarking purposes.'],
                            ['code' => '4.11.9', 'title' => ' If an international institution or other organization is invited to provide programs, or to assist in the development of programs for use in Saudi Arabia full information should be provided in advance about relevant Ministry regulations and NCAAA requirements for the National Qualifications Framework and requirements for program and course specifications and reports.']

                        ]
                    ],
                    [
                        'code' => '4.12',
                        'title' => 'KPIs',
                        'type' => '2',
                        'kpis' => [
                            ['code' => 'S4.1', 'type' => self::KPI_QUANTITATIVE, 'title' => 'Ratio of students to teaching staff. (Based on full time equivalents)'],
                            ['code' => 'S4.2', 'type' => self::KPI_QUALITATIVE, 'title' => 'Students overall rating on the quality of their courses. (Average rating of students on a five point scale on overall evaluation of courses.)'],
                            ['code' => 'S4.3', 'type' => self::KPI_QUANTITATIVE, 'title' => 'Proportion of teaching staff with verified doctoral qualifications.'],
                            ['code' => 'S4.4', 'type' => self::KPI_QUANTITATIVE, 'title' => 'Retention Rate; Percentage of students entering programs who successfully complete first year.'],
                            ['code' => 'S4.5', 'type' => self::KPI_QUANTITATIVE, 'title' => 'Graduation Rate for Undergraduate Students: Proportion of students entering undergraduate programs who complete those programs in minimum time.'],
                            ['code' => 'S4.6', 'type' => self::KPI_QUANTITATIVE, 'title' => 'Graduation Rates for Post Graduate Students: Proportion of students entering post graduate programs who complete those programs in specified time.'],
                            ['code' => 'S4.7', 'type' => self::KPI_QUANTITATIVE, 'title' => "Proportion of graduates from undergraduate programs who within six months of graduation are: \n(a) employed \n(b) enrolled in further study \n(c) not seeking employment or further study"],
                        ]
                    ],
                    [
                        'code' => '4.13',
                        'title' => 'College KPIs',
                        'type' => '3',
                        'kpis' => [
                        ]
                    ]
                ]
            ],
            [
                'code' => '5',
                'title' => 'Student Administration and Support Services',
                'criteria' => [
                    [
                        'code' => '5.1',
                        'title' => 'Institutional Oversight of Quality of Learning and Teaching',
                        'items' => [
                            ['code' => '5.1.1', 'title' => 'Student registration processes should not be unduly time consuming and should be simple for students to use'],
                            ['code' => '5.1.2', 'title' => 'Computerized systems used for admission processes should be linked to data recording and retrieval systems. (For example to fee payment requirements if applicable, the issue of student identity cards, program and course registrations, and statistical reporting requirements.)'],
                            ['code' => '5.1.3', 'title' => 'Admissions requirements should be clearly specified and appropriate for the institution and its programs'],
                            ['code' => '5.1.4', 'title' => 'Admission requirements should be consistently and fairly applied.'],
                            ['code' => '5.1.5', 'title' => 'If programs or courses include components offered by distance education, or use of e-learning in blended programs information should be provided before enrolment about any special skills or resources needed to study in these modes. (For distance education programs a separate set of standards that include requirements for that mode of program delivery are set out in a a different document, Standards for Quality Assurance and Accreditation of Higher Education Programs Offered by Distance Education.)'],
                            ['code' => '5.1.6', 'title' => 'Student fees, if required, should be paid at the time of registration unless specific approval has been given in advance for deferral of payments.'],
                            ['code' => '5.1.7', 'title' => 'If the institution’s regulations provide for deferral of payments, the conditions and dates for payment should be clearly specified in a formal agreement signed by the student and witnessed, and opportunities for financial counselling provided.'],
                            ['code' => '5.1.8', 'title' => 'Student advisors familiar with details of course requirements should be available to provide assistance prior to and during the student registration process.'],
                            ['code' => '5.1.9', 'title' => 'Rules governing admission with credit for previous studies should be clearly specified.'],
                            ['code' => '5.1.10', 'title' => 'Decisions on credit for previous studies should be made known to students by qualified faculty or authorized staff before classes commence.'],
                            ['code' => '5.1.11', 'title' => 'Complete information about the institution, including the range of courses and programs, program requirements, costs, services and other relevant information should be publicly available to potential students and families prior to applications for admission.'],
                            ['code' => '5.1.12', 'title' => 'A comprehensive orientation program should be available for beginning students to ensure thorough understanding of the range of services and facilities available to them, and of their obligations and responsibilities.']
                        ]
                    ],
                    [
                        'code' => '5.2',
                        'title' => 'Student Records',
                        'items' => [
                            ['code' => '5.2.1', 'title' => 'Effective security should be provided for student records. (Central files containing cumulative records of student’s enrolment and performance should be maintained in a secure area with back up files kept in a different and secure location, preferably in a different building or off campus).'],
                            ['code' => '5.2.2', 'title' => 'Formal policies should be developed to specify the content of permanent student records and their retention and disposal.'],
                            ['code' => '5.2.3', 'title' => 'The student record system should regularly provide statistical data required for planning, reporting and quality assurance to departments, colleges, the quality center and senior managers.'],
                            ['code' => '5.2.4', 'title' => 'Clear rules should be established and maintained governing privacy of information and controlling access to individual student records.'],
                            ['code' => '5.2.5', 'title' => 'Automated procedures should be in place for monitoring student progress throughout their programs.'],
                            ['code' => '5.2.6', 'title' => 'Timelines for reporting and recording results and updating records should be clearly defined and adhered to.'],
                            ['code' => '5.2.7', 'title' => 'Results should be finalized, officially approved, and communicated to students within times specified in institutional and Ministry requirements.'],
                            ['code' => '5.2.8', 'title' => 'Eligibility for graduation should be formally verified in relation to program and course requirements.']
                        ]
                    ],
                    [
                        'code' => '5.3',
                        'title' => 'Student Management',
                        'items' => [
                            ['code' => '5.3.1', 'title' => 'A code of behaviour should be approved by the governing body and made widely available within the institution, specifying rights and responsibilities of students.'],
                            ['code' => '5.3.2', 'title' => 'Regulations should specify action to be taken for breaches of student discipline including the responsibilities of relevant officers and committees, and penalties, which may be imposed.'],
                            ['code' => '5.3.3', 'title' => 'Disciplinary action should be taken promptly, and full documentation including details of evidence should be retained in secure institutional records.'],
                            ['code' => '5.3.4', 'title' => 'Student appeal and grievance procedures should be specified in regulations, published, and made widely known within the institution. The regulations should make clear the grounds on which academic appeals may be based, the criteria for decisions, and the remedies available.'],
                            ['code' => '5.3.5', 'title' => 'Appeal and grievance procedures should protect against time wasting on trivial issues, but still provide adequate opportunity for matters of concern to students to be fairly dealt with and supported by student counselling provisions.'],
                            ['code' => '5.3.6', 'title' => 'Appeal and grievance procedures should guarantee impartial consideration by persons or committees independent of the parties involved in the issue, or who made a decision or imposed a penalty that is being appealed against.'],
                            ['code' => '5.3.7', 'title' => 'Procedures should be established to ensure that students are protected against subsequent punitive action or discrimination following consideration of a grievance or appeal.'],
                            ['code' => '5.3.8', 'title' => 'Appropriate policies and procedures should be in place to deal with academic misconduct, including plagiarism and other forms of cheating.']
                        ]
                    ],
                    [
                        'code' => '5.5',
                        'title' => 'Planning and Evaluation of Student Services',
                        'items' => [
                            ['code' => '5.4.1', 'title' => 'The range of services provided and the resources devoted to them should reflect the mission of the institution and any special requirements of the student population.'],
                            ['code' => '5.4.2', 'title' => 'Formal plans should be developed for the provision and improvement of student services and the implementation and effectiveness of those plans should be monitored on a regular basis.'],
                            ['code' => '5.4.3', 'title' => 'A senior member of teaching or other staff should be assigned responsibility for oversight and development of student services.'],
                            ['code' => '5.4.4', 'title' => 'The effectiveness and relevance of services should be regularly monitored through processes that include surveys of student usage and satisfaction. Services should be modified in response to evaluation and feedback.'],
                            ['code' => '5.4.5', 'title' => 'Adequate facilities and financial support should be provided for the student services that are needed.'],
                            ['code' => '5.4.6', 'title' => 'If services are provided through student organizations, assistance should be given in management and organization if required, and there should be effective oversight of financial management and reporting.'],
                            ['code' => '5.4.7', 'title' => 'If student newspapers or other student documents are published there should be clear guidelines defining publication standards and editorial policy and the extent and nature of oversight by the institution.']
                        ]
                    ],
                    [
                        'code' => '5.5',
                        'title' => 'Medical and Counselling Services',
                        'items' => [
                            ['code' => '5.5.1', 'title' => 'Student medical services should be staffed by people with the necessary professional qualifications.'],
                            ['code' => '5.5.2', 'title' => 'Medical services should be readily accessible with provision made for emergency assistance when required. (Fees for services may be charged and they may be provided on a part time basis.)'],
                            ['code' => '5.5.3', 'title' => 'Provision should be made for academic counselling and for career planning and employment advice in colleges, departments or other appropriate locations within the institution.'],
                            ['code' => '5.5.4', 'title' => 'Personal or psychological counselling services should be made available with easy access for students from any part of the institution.'],
                            ['code' => '5.5.5', 'title' => 'Adequate protection should be provided, and supported by regulations or a code of conduct, to protect the confidentiality of academic or personal issues discussed with teaching or other staff or students.'],
                            ['code' => '5.5.6', 'title' => 'Effective mechanisms should be established for follow up to ensure student welfare and to evaluate quality of service. '],

                        ]
                    ],
                    [
                        'code' => '5.6',
                        'title' => 'Extra-curricular Activities for Students',
                        'items' => [
                            ['code' => '5.6.1', 'title' => 'Opportunities should be provided for participation in religious observances consistent with Islamic beliefs and traditions.'],
                            ['code' => '5.6.2', 'title' => 'Arrangements should be made to organize and encourage student participation in cultural activities such as clubs and societies, and special events in the arts and other fields appropriate to their interests and needs.'],
                            ['code' => '5.6.3', 'title' => 'Opportunities should be provided through appropriate facilities and organizational arrangements for informal social interaction among students.'],
                            ['code' => '5.6.4', 'title' => 'Participation in sports should be encouraged, both for skilled athletes and for others, and appropriate competitive and non-competitive physical activities in which they can be involved should be arranged.'],
                            ['code' => '5.6.5', 'title' => 'The extent of student participation in extra-curricular activities should be monitored and benchmarked against other comparable institutions, and where necessary strategies developed to improve levels of participation']

                        ]
                    ],
                    [
                        'code' => '5.7',
                        'title' => 'KPIs',
                        'type' => '2',
                        'kpis' => [
                            ['code' => 'S5.1', 'type' => self::KPI_QUANTITATIVE, 'title' => 'Ratio of students to administrative staff.'],
                            ['code' => 'S5.2', 'type' => self::KPI_QUANTITATIVE, 'title' => 'Proportion of total operating funds (other than accommodation and student allowances) allocated to provision of student services.'],
                            ['code' => 'S5.3', 'type' => self::KPI_QUALITATIVE, 'title' => 'Student evaluation of academic and career counselling. (Average rating on the adequacy of academic and career counselling on a five- point scale in an annual survey of final year students.)']
                        ]
                    ],
                    [
                        'code' => '5.8',
                        'title' => 'College KPIs',
                        'type' => '3',
                        'kpis' => [
                        ]
                    ]
                ]
            ],
            [
                'code' => '6',
                'title' => 'Learning Resources',
                'criteria' => [
                    [
                        'code' => '6.1',
                        'title' => 'Planning and Evaluation',
                        'items' => [
                            ['code' => '6.1.1', 'title' => 'Policies guiding the provision of library/resource center services should give special attention to support for the particular educational programs and research requirements of the institution.'],
                            ['code' => '6.1.2', 'title' => 'A learning resource strategy should be developed which is directly linked to strategic priorities for program development, and adjusted as required as new programs are introduced.'],
                            ['code' => '6.1.3', 'title' => 'The adequacy of library and resource center materials should be monitored continually and formally evaluated at least once every two years.'],
                            ['code' => '6.1.4', 'title' => 'Evaluation procedures should include user surveys dealing with effectiveness in meeting user needs (considering teaching staff and student satisfaction, extent of usage, consistency with requirements of teaching and learning at the institution, range of services provided, and comparisons with other comparable institutions).'],
                            ['code' => '6.1.5', 'title' => 'Evaluation processes include analysis of data on usage of resources in relation to teaching and learning requirements for different programs in the institution.'],
                            ['code' => '6.1.6', 'title' => 'Advice should be obtained from teaching staff responsible for courses and programs about requirements to support teaching and learning in sufficient time for appropriate provision to be made.'],
                            ['code' => '6.1.7', 'title' => 'Reserve book collections and other reference materials should be regularly reviewed with advice from teaching staff to ensure adequate access to necessary materials for courses on offer at any time.']

                        ]
                    ],
                    [
                        'code' => '6.2',
                        'title' => 'Organization',
                        'items' => [
                            ['code' => '6.2.1', 'title' => 'Library and resource centers and associated facilities and services should be available for extended hours beyond normal class time to ensure access when required by users.'],
                            ['code' => '6.2.2', 'title' => 'Collections should be arranged catalogued according to internationally recognized good library practice.'],
                            ['code' => '6.2.3', 'title' => 'Agreements should be made for cooperation with other libraries and resource centers for interlibrary loans and sharing of resources and services. '],
                            ['code' => '6.2.4', 'title' => 'Reliable systems should be used for recording loans and returns, with efficient follow up for overdue material.'],
                            ['code' => '6.2.5', 'title' => 'Heavy-demand and required reading materials should be held in in a reserve collection.'],
                            ['code' => '6.2.6', 'title' => 'There should be reliable and efficient access to on-line data-bases and research and journal material relevant to the institution’s programs.'],
                            ['code' => '6.2.7', 'title' => 'Rules for behaviour within the library should be established and enforced to ensure maintenance of an environment conducive to effective study and student and staff research.'],
                            ['code' => '6.2.8', 'title' => 'Effective security systems should be used to prevent loss of materials and inappropriate use of the internet.']
                        ]
                    ],
                    [
                        'code' => '6.4',
                        'title' => 'Resources and Facilities',
                        'items' => [
                            ['code' => '6.4.1', 'title' => 'Adequate financial resources must be provided for acquisitions, cataloguing, equipment, and for services and system development.'],
                            ['code' => '6.4.2', 'title' => 'The availability of on line access and inter library loan facilities should not be used to reduce commitment to providing adequate physical resources on-site.'],
                            ['code' => '6.4.3', 'title' => 'Adequate facilities should be provided to house collections in a way that makes them readily accessible.'],
                            ['code' => '6.4.4', 'title' => 'Up to date computer equipment and software should be provided to support electronic access to resources and reference material. '],
                            ['code' => '6.4.5', 'title' => 'Copying facilities supported by efficient payment mechanisms for users should be provided.'],
                            ['code' => '6.4.6', 'title' => 'Facilities should be available for using personal laptop computers.'],
                            ['code' => '6.4.7', 'title' => 'Books, journals and other materials should be available in Arabic and English (or other languages) as required for programs taught and research undertaken in the institution.'],
                            ['code' => '6.4.8', 'title' => 'Facilities should be provided for both individual and small group study and research.'],
                            ['code' => '6.4.9', 'title' => 'The level of provision of facilities and resources (numbers of books, seats, group study facilities etc) should be benchmarked against good quality similar institutions and be adequate for the size of the institution and the programs offered.']
                        ]
                    ],
                    [
                        'code' => '6.5',
                        'title' => 'KPIs',
                        'type' => '2',
                        'kpis' => [
                            ['code' => 'S6.1', 'type' => self::KPI_QUALITATIVE, 'title' => "Stakeholder evaluation of library and media center. (Average overall rating of the adequacy of the library & media center, including:\n a) Staff assistance,\nb) Current and up-to-date\nc) Copy & print facilities,\nd) Functionality of equipment,\ne) Atmosphere or climate for studying\nf) Availability of study sites, and\ng) Any other quality indicators of service on a five- point scale of an annual survey.) ."],
                            ['code' => 'S6.2', 'type' => self::KPI_QUANTITATIVE, 'title' => 'Number of web site publication and journal subscriptions as a proportion of the number of programs offered.'],
                            ['code' => 'S6.3', 'type' => self::KPI_QUALITATIVE, 'title' => "Stakeholder evaluation of the digital library. (Average overall rating of the adequacy of the digital library, including: \n a) User friendly website\nb) Availability of the digital databases,\nc) Accessibility for users,\nd) Library skill training and\ne) Any other quality indicators of service on a five- point scale of an annual survey.)"]
                        ]
                    ],
                    [
                        'code' => '6.6',
                        'title' => 'College KPIs',
                        'type' => '3',
                        'kpis' => [
                        ]
                    ]
                ]
            ],
            [
                'code' => '7',
                'title' => 'Facilities and Equipment',
                'criteria' => [
                    [
                        'code' => '7.1',
                        'title' => 'Policy and Planning',
                        'items' => [
                            ['code' => '7.1.1', 'title' => 'A long-term master plan that provides for capital developments and maintenance of facilities and equipment should be approved by the governing body.'],
                            ['code' => '7.1.2', 'title' => 'Equipment planning should provide plans and schedules for major equipment acquisition, servicing and replacement.'],
                            ['code' => '7.1.3', 'title' => 'Future users of facilities or major equipment should be involved in detailed consultations prior to acquisitions or development to ensure that current and anticipated future needs are met.'],
                            ['code' => '7.1.4', 'title' => 'Equipment policies should ensure to the greatest feasible extent, compatibility of equipment and systems across the institution.'],
                            ['code' => '7.1.5', 'title' => 'Business plans should be prepared prior to major equipment acquisitions, with evaluation of alternatives of leasing or shared use with other agencies.'],
                            ['code' => '7.1.6', 'title' => 'Proposals for leasing of major facilities and for outsourced building and management of facilities should be fully evaluated in the long-term interests of the institution and managed in a way that ensures effective quality control and financial benefits.']
                        ]
                    ],
                    [
                        'code' => '7.2',
                        'title' => 'Quality and Adequacy of Facilities and Equipment',
                        'items' => [
                            ['code' => '7.2.1', 'title' => 'A clean, attractive and well maintained physical environment of both buildings and grounds should be maintained.'],
                            ['code' => '7.2.2', 'title' => 'Facilities should fully meet health and safety requirements.'],
                            ['code' => '7.2.3', 'title' => 'Quality assessment processes used should include both feedback from principal users about the adequacy and quality of facilities, and mechanisms for considering and responding to their views.'],
                            ['code' => '7.2.4', 'title' => 'Standards of provision of teaching, laboratory and research facilities should be benchmarked through comparisons with equivalent provisions at other comparable institutions. (This includes such things as classroom space, laboratory facilities and equipment, access to computing facilities and associated software, private study facilities, and research equipment.'],
                            ['code' => '7.2.5', 'title' => 'Adequate facilities should be available for confidential consultations between teaching staff and students)'],
                            ['code' => '7.2.6', 'title' => 'Appropriate facilities should be provided for religious observances.'],
                            ['code' => '7.2.7', 'title' => 'Food service facilities should be adequate and appropriate for the needs of staff and students.'],
                            ['code' => '7.2.8', 'title' => 'Appropriate provision should be made for students and staff with physical disabilities or other special needs.'],
                            ['code' => '7.2.9', 'title' => 'Facilities should be provided for cultural, sporting and other extra curricular activities that are appropriate for the needs of the students attending the institution.']
                        ]
                    ],
                    [
                        'code' => '7.3',
                        'title' => 'Management and Administration of Facilities and Equipment',
                        'items' => [
                            ['code' => '7.3.1', 'title' => 'Complete inventories should be maintained of equipment owned or controlled by the institution including equipment assigned to individual staff for teaching and research. '],
                            ['code' => '7.3.2', 'title' => 'Services such as cleaning, waste disposal, minor maintenance, safety, and environmental management should be maintained efficiently and effectively under the supervision of a senior administrative officer.'],
                            ['code' => '7.3.3', 'title' => 'Regular condition assessments should be carried out and provision made for preventative and corrective maintenance and replacement when required.'],
                            ['code' => '7.3.4', 'title' => 'Effective security should be provided for specialized facilities and equipment for teaching and research, with responsibility between individual members of staff, departments or colleges, or central administration clearly defined.'],
                            ['code' => '7.3.5', 'title' => 'Effective systems should be used to ensure the personal security of teaching and other staff and students, with appropriate provisions for the security of their personal property.'],
                            ['code' => '7.3.6', 'title' => 'Space utilization should be monitored and when appropriate facilities reallocated in response to changing requirements.'],
                            ['code' => '7.3.7', 'title' => 'Scheduling of general-purpose facilities should be managed through an electronic booking and reservation system, and reports made to senior management on the extent and efficiency of use.'],
                            ['code' => '7.3.8', 'title' => 'Arrangements should be made for shared use of underutilized facilities with adequate mechanisms for security of equipment.']
                        ]
                    ],
                    [
                        'code' => '7.4',
                        'title' => 'Information Technology',
                        'items' => [
                            ['code' => '7.4.1', 'title' => 'Adequate computer equipment should be available and accessible for teaching and other staff and students throughout the institution.'],
                            ['code' => '7.4.2', 'title' => 'The adequacy of provision of computer equipment should be regularly assessed through surveys or other means and comparisons with other institutions.'],
                            ['code' => '7.4.3', 'title' => 'Policies governing the use of personal computers by students should be established and provision made for facilities to support their use in keeping with these policies.'],
                            ['code' => '7.4.4', 'title' => 'Technical support should be available for teaching and other staff and students using information and communications technology.'],
                            ['code' => '7.4.5', 'title' => 'Opportunities should be provided for teaching staff input into plans for acquisition and replacement of computing equipment and software.'],
                            ['code' => '7.4.6', 'title' => 'Institution-wide acquisitions and replacement policies for software and hardware should be established to ensure that systems remain up to date and that compatibility is maintained as replacements are made.'],
                            ['code' => '7.4.7', 'title' => 'Security systems should be established to protect privacy of personal and institutional information, and to protect against externally introduced viruses.'],
                            ['code' => '7.4.8', 'title' => 'A code of conduct relating to inappropriate use of material on the internet should be established. Compliance with this code of conduct should be checked and instances of inappropriate behaviour appropriately dealt with'],
                            ['code' => '7.4.9', 'title' => 'Training programs should be provided for teaching and other staff to ensure effective use of computing equipment and appropriate software for teaching, student assessment, and administration.'],
                            ['code' => '7.4.10', 'title' => 'Effective use should be made of information technology for administrative systems, reporting, and communications across the institution with secure access where appropriate.'],
                            ['code' => '7.4.11', 'title' => 'Internal information systems should be compatible with external reporting requirements.']
                        ]
                    ],
                    [
                        'code' => '7.5',
                        'title' => 'Student Residences',
                        'items' => [
                            ['code' => '7.5.1', 'title' => 'Accommodation should be of appropriate standard, providing a healthy, safe and secure environment for students.'],
                            ['code' => '7.5.2', 'title' => 'Facilities should make adequate provision for privacy and individual study.'],
                            ['code' => '7.5.3', 'title' => 'Facilities for social, cultural and physical activities should be adequate and appropriate for the students attending the institution'],
                            ['code' => '7.5.4', 'title' => 'Clearly defined codes of behaviour should be established and be formally agreed to by students.'],
                            ['code' => '7.5.5', 'title' => 'Effective supervision should be provided by staff with the experience, expertise and authority to manage the facility as a secure and supportive learning environment.'],
                            ['code' => '7.5.6', 'title' => 'Adequate food services, maintenance and medical facilities should be available or readily accessible.'],
                            ['code' => '7.5.7', 'title' => 'Provision should be made for adequate and appropriate religious facilities.'],
                            ['code' => '7.5.8', 'title' => 'If accommodation is provided it should be on or close to the campus or transport facilities provided to ensure easy access']

                        ]
                    ],
                    [
                        'code' => '7.6',
                        'title' => 'KPIs',
                        'type' => '2',
                        'kpis' => [
                            ['code' => 'S7.1', 'type' => self::KPI_QUANTITATIVE, 'title' => "Annual expenditure on IT budget, including: \na) Percentage of the total Institution, or College, or Program budget allocated for IT; \nb) Percentage of IT budget allocated per program for institutional or per student for programmatic; \nc) Percentage of IT budget allocated for software licences; \nd) Percentage of IT budget allocated for IT security; \ne) Percentage of IT budge allocated for IT maintenance"],
                            ['code' => 'S7.2', 'type' => self::KPI_QUALITATIVE, 'title' => "Stakeholder evaluation of the IT services (Average overall rating of the adequacy of on a five- point scale of an annual survey). \na) IT availability, \nb) Website, \nc) e-learning services \nd) IT Security, \ne) Maintenance (hardware & software), \nf) Accessibility \ng) Support systems, \nh) Hardware, software & up-dates, and Web-based electronic data management system or electronic resources (for example: institutional website providing resource sharing, networking & relevant information, including e-learning, interactive learning & teaching between students & faculty)."],
                            ['code' => 'S7.3', 'type' => self::KPI_QUALITATIVE, 'title' => "Stakeholder evaluation of facilities & equipment: \na) Classrooms, \nb) Laboratories, \nc) Bathrooms (cleanliness & maintenance), \nd) Campus security, \ne) Parking & access, \nf) Safety (first aide, fire extinguishers & alarm systems, secure chemicals) \ng) Access for those with disabilities or handicaps (ramps, lifts, bathroom furnishings), \nh) Sporting facilities & equipment."]
                        ]
                    ],
                    [
                        'code' => '7.7',
                        'title' => 'College KPIs',
                        'type' => '3',
                        'kpis' => [
                        ]
                    ]
                ]
            ],
            [
                'code' => '8',
                'title' => 'Financial Planning and Management',
                'criteria' => [
                    [
                        'code' => '8.1',
                        'title' => 'Financial Planning and Budgeting',
                        'items' => [
                            ['code' => '8.1.1', 'title' => 'Budgeting and resource allocations should be aligned with the mission and goals of the institution and strategic planning to achieve those goals.'],
                            ['code' => '8.1.2', 'title' => 'Annual budgets should be established within a framework of long term revenue and expenditure projections, which are progressively adjusted in the light of experience.'],
                            ['code' => '8.1.3', 'title' => 'Budget proposals should be developed by senior academic and administrative staff in consultation with cost center managers, carefully reviewed, and presented to the governing body for approval.'],
                            ['code' => '8.1.4', 'title' => 'Proposals for new programs or major activities, equipment or facilities should be accompanied by business plans that include independently verified cost estimates and cost impacts on other services and activities.'],
                            ['code' => '8.1.5', 'title' => 'If new projects or activities are cross-subsidized from existing funding sources the cost sharing strategy should be made explicit and intermediate and long term costs and benefits assessed.'],
                            ['code' => '8.1.6', 'title' => 'If loans are used debt and liquidity ratios should be monitored and benchmarked against commercial practice and equivalent ratios in other higher education institutions.'],
                            ['code' => '8.1.7', 'title' => 'Ratios of expenditure on salaries and other major expense categories relative to total expenditure should be planned and monitored, allowing appropriate variations for colleges or departments with different cost structures.'],
                            ['code' => '8.1.8', 'title' => 'Borrowing and other long term financing schemes should be used sparingly as a strategic financing strategy to improve capacity rather than to meet unanticipated short term operating costs, and financial planning should ensure that obligations can be met from projected additional revenue or from known existing revenue sources.'],
                            ['code' => '8.1.9', 'title' => 'Strategies should be developed to diversify revenue through a range of activities, which, while consistent with the charter and mission of the institution, reduce its dependence on a single funding source.']
                        ]
                    ],
                    [
                        'code' => '8.2',
                        'title' => 'Financial Management',
                        'items' => [
                            ['code' => '8.2.1', 'title' => 'Oversight and management of the institution’s budgeting and accounting functions should be carried out by a business or financial office responsible to a senior administrator.'],
                            ['code' => '8.2.2', 'title' => 'Sufficient delegations of spending authority should be given to managers of organizational units within the institution for effective and efficient administration.'],
                            ['code' => '8.2.3', 'title' => 'Details of any financial delegations should be clearly specified, and conformity with regulations and reporting requirements confirmed through audit processes.'],
                            ['code' => '8.2.4', 'title' => 'Cost center managers should be involved in the budget planning process, and be held accountable for expenditure within approved budgets.'],
                            ['code' => '8.2.5', 'title' => 'There should be accurate monitoring of expenditure and commitments against budgets with reports prepared for each cost center and for the institution as a whole at least once each semester.'],
                            ['code' => '8.2.6', 'title' => 'Any discrepancies from expenditure estimates should be explained and their impact on annual budget projections assessed.'],
                            ['code' => '8.2.7', 'title' => 'Accounting systems should comply with accepted professional accounting standards and as far as possible attribute total cost to particular activities.'],
                            ['code' => '8.2.8', 'title' => 'Funds provided for particular purposes should be used for those purposes and the accounting systems should verify that this has occurred.'],
                            ['code' => '8.2.9', 'title' => 'Where possibilities of conflict of interest exist or may be perceived to exist the persons concerned should declare their interest and refrain from participation in decisions.'],
                            ['code' => '8.2.10', 'title' => 'Financial processes should be managed so that allowable carry-forward provisions are sufficiently flexible to avoid rushed end of year expenditure or disincentives for long term planning.']
                        ]
                    ],
                    [
                        'code' => '8.3',
                        'title' => 'Auditing and Risk assessment',
                        'items' => [
                            ['code' => '8.3.1', 'title' => 'Financial planning processes should include independently verified risk assessment.'],
                            ['code' => '8.3.2', 'title' => 'Risk minimization strategies should be in place and adequate reserves maintained to meet realistically assessed financial risks.'],
                            ['code' => '8.3.3', 'title' => 'Internal audit processes should operate independently of accounting and business managers, and report directly to the Rector or Dean or chair of the relevant governing board committee.'],
                            ['code' => '8.3.4', 'title' => 'External audits should be conducted annually by an independent government agency or a reputable external audit firm that is independent of the institution, its financial or other senior staff and members of the governing body.']
                        ]
                    ],
                    [
                        'code' => '8.4',
                        'title' => 'KPIs',
                        'type' => '2',
                        'kpis' => [
                            ['code' => 'S8.1', 'type' => self::KPI_QUANTITATIVE, 'title' => 'Total operating expenditure (other than accommodation and student allowances) per student.']
                        ]
                    ],
                    [
                        'code' => '8.5',
                        'title' => 'College KPIs',
                        'type' => '3',
                        'kpis' => [
                        ]
                    ]
                ]
            ],
            [
                'code' => '9',
                'title' => 'Employment Processes',
                'criteria' => [
                    [
                        'code' => '9.1',
                        'title' => 'Policy and Administration',
                        'items' => [
                            ['code' => '9.1.1', 'title' => 'A desired staffing profile appropriate to the mission and nature of the institution should be approved by the governing body. (The profile should include matters such as age structure, gender balance where relevant, classification levels, qualifications, cultural mix and educational background, and objectives for Saudization.)'],
                            ['code' => '9.1.2', 'title' => 'Regular comparisons should be made of current provision of teaching and other staff with the desired staffing profile and progress towards it should be monitored.'],
                            ['code' => '9.1.3', 'title' => 'A comprehensive set of policies and regulations should be included in an employment handbook or manual and accessible to teaching and other staff. (It should include rights and responsibilities of teaching and other staff, recruitment processes, supervision, performance evaluation, promotion, counselling and support processes, professional development, and complaints, discipline and appeal procedures.)'],
                            ['code' => '9.1.4', 'title' => 'Effective strategies should be used for succession planning in relation to leadership positions.'],
                            ['code' => '9.1.5', 'title' => 'Teaching loads should be equitable across the institution, taking account of the nature of teaching requirements in different fields of study'],
                            ['code' => '9.1.6', 'title' => 'Promotion policies and processes should be clearly documented and implemented fairly.'],
                            ['code' => '9.1.7', 'title' => 'There should be appropriate delegations relating to employment processes across the institution and the exercise of these delegations should be monitored to ensure equitable treatment. (These delegations may relate to matters such as junior appointments, junior promotions, rewards for outstanding performance, and professional development opportunities.)'],
                            ['code' => '9.1.8', 'title' => 'Indicators of successful administration of staffing and employment policies and teaching and other staff performance should be established and compared with successful practice elsewhere.'],
                            ['code' => '9.1.9', 'title' => 'The governing board should receive and consider annual reports from the responsible senior manager on implementation of policies and staffing and employment practices.']
                        ]
                    ],
                    [
                        'code' => '9.2',
                        'title' => 'Recruitment',
                        'items' => [
                            ['code' => '9.2.1', 'title' => 'Recruitment processes should ensure that teaching staff have the specific areas of expertise, and the personal qualities, experience and skill to meet teaching requirements and that other staff are appropriately qualified and experienced for their work.'],
                            ['code' => '9.2.2', 'title' => 'When appointments are to be made through promotion or transfer within the institution rather than by external appointment, the appointments made should meet qualifications and skill requirements, and contribute to achievement of the desired staffing profile.'],
                            ['code' => '9.2.3', 'title' => 'If a particular appointment can be made either from within or from outside the institution procedures should be used that ensure equitable treatment of all applicants (For example positions should be publicly advertised, internal candidates should be given adequate opportunity to apply, and judgments made should be equitable considering the experience, qualifications, and current levels of performance of the applicants.)'],
                            ['code' => '9.2.4', 'title' => 'Candidates for employment should be provided with full position descriptions and conditions of employment, together with general information about the institution and its mission and programs. (The information provided should include details of employment expectations, indicators of performance, and processes of performance evaluation.)'],
                            ['code' => '9.2.5', 'title' => 'References should be checked, and claims of experience and qualifications verified before appointments are made.'],
                            ['code' => '9.2.6', 'title' => 'The legitimacy of qualifications claimed by applicants should be checked through processes that consider the standing and reputation of the institutions from which they were obtained, taking account of recognition of qualifications by the Ministry of Higher Education.'],
                            ['code' => '9.2.7', 'title' => 'In professional programs there should be sufficient teaching staff with successful experience in the relevant profession to provide practical advice and guidance to students about work place requirements. '],
                            ['code' => '9.2.8', 'title' => 'New teaching staff should be given an effective orientation to ensure familiarity with the institution and its services, programs and student development strategies, and institutional priorities for development.'],
                            ['code' => '9.2.9', 'title' => 'The level of provision of teaching staff in all departments and colleges (ie the ratio of students per teaching staff member calculated as full time equivalents) should be adequate for the programs offered and benchmarked against comparable student/teaching staff ratios at good quality Saudi Arabian and international institutions.']
                        ]
                    ],
                    [
                        'code' => '9.3',
                        'title' => 'Personal and Career Development',
                        'items' => [
                            ['code' => '4.3.1', 'title' => 'Criteria and processes for performance evaluation should be clearly specified and made known in advance to teaching and other staff.'],
                            ['code' => '4.3.2', 'title' => 'Consultations about work performance by supervisors (including deans, heads of department, administrative supervisors etc) should be confidential and supportive and occur on a formal basis at least once each year.'],
                            ['code' => '4.3.3', 'title' => 'If performance is considered less than satisfactory clear requirements should be established for improvement.'],
                            ['code' => '4.3.4', 'title' => 'Performance assessments of teaching and other staff should be kept confidential but should be documented and retained. Teaching and other staff should have the opportunity to include on file their own comments relating to these assessments, including points of disagreement.'],
                            ['code' => '4.3.5', 'title' => 'Outstanding academic or administrative performance at any level of the institution should be recognized and rewarded.'],
                            ['code' => '4.3.6', 'title' => 'All teaching and other staff should be given appropriate and fair opportunities for personal and career development.'],
                            ['code' => '4.3.7', 'title' => 'Junior teaching and other staff with leadership potential should be identified and given a range of experiences to prepare them for future career development.'],
                            ['code' => '4.3.8', 'title' => 'Promotion criteria should include contributions to the mission of the institution, and in the case of teaching staff include proper recognition of quality of teaching and efforts to improve it, and service to the institution and the community as well as research.'],
                            ['code' => '4.3.9', 'title' => 'Assistance should be given in arranging professional development activities to improve skills and upgrade qualifications.'],
                            ['code' => '4.3.10', 'title' => 'Appropriate training and professional development activities should be provided to assist with new programs or policy initiatives.'],
                            ['code' => '4.3.11', 'title' => 'Teaching staff should be expected to participate in activities that ensure they keep up to date with developments in their field and the extent to which they do so should be monitored.']
                        ]
                    ],
                    [
                        'code' => '9.4',
                        'title' => 'Discipline, Complaints and Dispute Resolution',
                        'items' => [
                            ['code' => '9.4.1', 'title' => 'Procedures for dealing with complaints about or by teaching or other staff, and resolving disputes among them, should be clearly specified in policies and regulations.'],
                            ['code' => '9.4.2', 'title' => 'Procedures for resolving disputes (that cannot be settled by those directly involved) should include an initial step of conciliation by a person independent of the issue, with the possibility of referral to a committee or senior officer for determination if required.'],
                            ['code' => '9.4.3', 'title' => 'Disciplinary processes for neglect of responsibilities, failure to comply with instructions, or inappropriate behaviour should be specified in regulations and consistently followed.'],
                            ['code' => '9.4.4', 'title' => 'Appropriate provision should be made in regulations for rights of appeal against disciplinary decisions.'],
                            ['code' => '9.4.5', 'title' => 'Serious disputes should be dealt with through quasi-judicial processes that include provision and verification of evidence, and impartial judgments by a person or persons experienced in such procedures.']
                        ]
                    ],
                    [
                        'code' => '9.5',
                        'title' => 'KPIs',
                        'type' => '2',
                        'kpis' => [
                            ['code' => 'S9.1', 'type' => self::KPI_QUANTITATIVE, 'title' => 'Proportion of teaching staff leaving the institution in the past year for reasons other than age retirement.'],
                            ['code' => 'S9.2', 'type' => self::KPI_QUANTITATIVE, 'title' => 'Proportion of teaching staff participating in professional development activities during the past year.']
                        ]
                    ],
                    [
                        'code' => '9.6',
                        'title' => 'College KPIs',
                        'type' => '3',
                        'kpis' => [
                        ]
                    ]
                ]
            ],
            [
                'code' => '10',
                'title' => 'Research',
                'criteria' => [
                    [
                        'code' => '10.1',
                        'title' => 'Institutional Research Policies',
                        'items' => [
                            ['code' => '10.1.1', 'title' => 'A research development plan that is consistent with the nature and mission of the institution and the economic and cultural development needs of the region should be prepared and made widely available.'],
                            ['code' => '10.1.2', 'title' => 'The research development plan should include clearly specified indicators and benchmarks for performance targets.'],
                            ['code' => '10.1.3', 'title' => 'What is recognized as research should be clearly specified and consistent with international standards. (This normally includes both self-generated and commissioned activity, but requires creative original work, independently validated by peers, and published in media that are highly regarded by scholars in the field.)'],
                            ['code' => '10.1.4', 'title' => 'Annual reports should be published on institutional research performance and records maintained of the research activities of individuals, departments and colleges.'],
                            ['code' => '10.1.5', 'title' => 'Cooperation with local industry and with other research agencies should be encouraged. When appropriate these forms of cooperation should involve joint research projects, shared use of equipment, and cooperative strategies for development.'],
                            ['code' => '10.1.6', 'title' => 'Mechanisms should be established to support collaboration and cooperation with international universities and research networks.'],
                            ['code' => '10.1.7', 'title' => 'Policies should provide for the establishment, accountability, and periodic review of research institutes or centers.'],
                            ['code' => '10.1.8', 'title' => 'The establishment of research institutes or centers should not inhibit research activity by others not involved in those organizations.'],
                            ['code' => '10.1.9', 'title' => 'A high level committee should be established to monitor compliance with ethical standards and approve research projects with potential impact on ethical issues.'],
                            ['code' => '10.1.10', 'title' => 'The institution should develop an adequate research budget to enable the achievement of its research plan.']
                        ]
                    ],
                    [
                        'code' => '10.2',
                        'title' => 'Teaching Staff and Student Involvement in Research',
                        'items' => [
                            ['code' => '10.2.1', 'title' => 'Expectations for teaching staff involvement in research and scholarly activities should be specified and performance in relation to these expectations considered in performance evaluation and promotion criteria. (For universities, criteria should require at least some research and/or appropriate scholarly activity of all full time teaching staff).'],
                            ['code' => '10.2.2', 'title' => 'Support should be provided for junior teaching staff in the development of their research programs through mechanisms such as mentoring by senior colleagues, inclusion in project teams, assistance in developing research proposals, and start up funding to help initiate new research projects.'],
                            ['code' => '10.2.3', 'title' => 'Support should be provided for junior teaching staff in the development of their research programs through mechanisms such as mentoring by senior colleagues, inclusion in project teams, assistance in developing research proposals, and seed funding.'],
                            ['code' => '10.2.4', 'title' => 'Opportunities should be provided for postgraduate research students to participate in joint research projects.'],
                            ['code' => '10.2.5', 'title' => 'Participation by research students in joint research projects should be appropriately acknowledged. When a significant contribution has been made reports and publications should indicate joint authorship.'],
                            ['code' => '10.2.6', 'title' => 'Assistance should be given for teaching staff to develop collaborative research arrangements with colleagues in other institutions and in the international community.'],
                            ['code' => '10.2.7', 'title' => 'Teaching staff should be encouraged to include information about their research and scholarly activities that are relevant to courses they teach in their teaching, together with other significant research developments in the field.'],
                            ['code' => '10.2.8', 'title' => 'Strategies should be introduced for identifying and capitalizing on the expertise of teaching staff and postgraduate students in providing research and development services to the community and generating financial returns to the institution.']
                        ]
                    ],
                    [
                        'code' => '10.3',
                        'title' => 'Commercialization of Research',
                        'items' => [
                            ['code' => '10.3.1', 'title' => 'A research development unit or center should be established with capacity to identify and publicize institutional expertise and commercial development opportunities, assist in developing proposals and business plans, help with preparation of contracts, and when appropriate, help with the development of spin off companies.'],
                            ['code' => '10.3.2', 'title' => 'Ideas with potential for commercial development should be critically evaluated, and advice obtained from experienced persons from industry and relevant professions before investment by the institution is authorized.'],
                            ['code' => '10.3.3', 'title' => 'Policies should be established for ownership of intellectual property and clear procedures set out for commercialization of ideas developed by staff and students. The policies should specify scales for equitable sharing of returns to the inventor(s), and the institution.'],
                            ['code' => '10.3.4', 'title' => 'A culture of entrepreneurship should be encouraged throughout the institution, with particular emphasis on teaching staff and postgraduate students'],
                            ['code' => '10.3.5', 'title' => 'Regulations should be established that require disclosure of pecuniary interest and avoidance of conflict of interest in activities related to research.']
                        ]
                    ],
                    [
                        'code' => '10.4',
                        'title' => 'Research Facilities and Equipment',
                        'items' => [
                            ['code' => '10.4.1', 'title' => 'Adequate laboratory space and equipment, library and information systems and resources should be provided to support the research activities of teaching staff and students in the fields in which programs are offered.'],
                            ['code' => '10.4.2', 'title' => 'In a university an adequate budget should be available for conduct of research (including research equipment and facilities) in all departments and colleges.'],
                            ['code' => '10.4.3', 'title' => 'Advantage should be taken of opportunities for joint ownership or shared access to major equipment items within the institution, and with other organizations.'],
                            ['code' => '10.4.4', 'title' => 'Effective security systems should be established to ensure safety for researchers and their activities, and for others in the institutional community and the surrounding area.'],
                            ['code' => '10.4.5', 'title' => 'Policies should be established that make clear the ownership and responsibility for maintenance of equipment obtained through research grant applications, commissioned research or other cooperative ventures with industry or other external sources.']
                        ]
                    ],
                    [
                        'code' => '10.5',
                        'title' => 'KPIs',
                        'type' => '2',
                        'kpis' => [
                            ['code' => 'S10.1', 'type' => self::KPI_QUANTITATIVE, 'title' => 'Number of refereed publications in the previous year per full time equivalent teaching staff. (Publications based on the formula in the Higher Council Bylaw excluding conference presentations)'],
                            ['code' => 'S10.2', 'type' => self::KPI_QUANTITATIVE, 'title' => 'Number of citations in refereed journals in the previous year per full time equivalent faculty members.'],
                            ['code' => 'S10.3', 'type' => self::KPI_QUANTITATIVE, 'title' => 'Proportion of full time member of teaching staff with at least one refereed publication during the previous year.'],
                            ['code' => 'S10.4', 'type' => self::KPI_QUANTITATIVE, 'title' => 'Number of papers or reports presented at academic conferences during the past year per full time equivalent faculty members.'],
                            ['code' => 'S10.5', 'type' => self::KPI_QUANTITATIVE, 'title' => 'Research income from external sources in the past year as a proportion of the number of full time faculty members.'],
                            ['code' => 'S10.6', 'type' => self::KPI_QUANTITATIVE, 'title' => 'Proportion of the total, annual operational budget dedicated to research.']
                        ]
                    ],
                    [
                        'code' => '10.6',
                        'title' => 'College KPIs',
                        'type' => '3',
                        'kpis' => [
                        ]
                    ]
                ]
            ],
            [
                'code' => '11',
                'title' => 'Relationships with the Community',
                'criteria' => [
                    [
                        'code' => '11.1',
                        'title' => 'Institutional Policies on Community Relationships',
                        'items' => [
                            ['code' => '11.1.1', 'title' => 'The service commitment of the institution should be relevant to the community or communities within which it operates and included in its mission.'],
                            ['code' => '11.1.2', 'title' => 'Policies on the institution’s service role should be approved by the governing body and these policies should be supported in decisions made by senior administrators'],
                            ['code' => '11.1.3', 'title' => 'Annual reports should be prepared on the institution’s contributions to the community'],
                            ['code' => '11.1.4', 'title' => 'Contributions to the community should be included in promotion criteria and staff assessments.'],
                            ['code' => '11.1.5', 'title' => 'Websites providing details of institutional structures and activities, including news items of potential interest to potential students and members of the wider community, should be provided and kept up to date.']
                        ]
                    ],
                    [
                        'code' => '11.2',
                        'title' => 'Interactions With the Community',
                        'items' => [
                            ['code' => '11.2.1', 'title' => 'Teaching and other staff should be encouraged to participate in forums in which significant community issues are discussed and plans for community development considered.'],
                            ['code' => '11.2.2', 'title' => 'The institution and its colleges and departments should cooperate in the establishment of community support or professional service agencies relevant to the needs of the community, drawing on the expertise of staff members.'],
                            ['code' => '11.2.3', 'title' => 'A range of community education courses should be provided in areas of interest and need.'],
                            ['code' => '11.2.4', 'title' => 'Relationships should be established with local industries and employers to assist program delivery. (These may include, for example, placement of students for work-study programs, part time employment opportunities, and identification of issues for analysis in student project activities.)'],
                            ['code' => '11.2.5', 'title' => 'Local employers and members of professions should be invited to join appropriate advisory committees considering programs and other institutional activities'],
                            ['code' => '11.2.6', 'title' => 'Continuing contact should be maintained with schools in the community, offering assistance and support in areas of specialization, providing information about the institution’s programs and activities and subsequent career opportunities, and arranging enrichment activities for the schools'],
                            ['code' => '11.2.7', 'title' => 'Regular contact should be maintained with alumni, keeping them informed about institutional developments, inviting their participation in activities, and encouraging their financial and other support for new developments.'],
                            ['code' => '11.2.8', 'title' => 'Advantage should be taken of opportunities to seek funding support from individuals and organizations in the community for research and other developments in the institution.'],
                            ['code' => '11.2.9', 'title' => 'A central data-base should be maintained in which records are maintained of community services undertaken by individuals and organizations throughout the institution.']
                        ]
                    ],
                    [
                        'code' => '11.3',
                        'title' => 'Interactions With the Community',
                        'items' => [
                            ['code' => '11.3.1', 'title' => 'A comprehensive strategy should be developed for monitoring and improving the reputation of the institution in the local and other relevant communities.'],
                            ['code' => '11.3.2', 'title' => 'Clear guidelines should be established for public comments on behalf of the institution, normally restricting such comments to the Rector or Dean or a media office responsible to the Rector or Dean.'],
                            ['code' => '11.3.3', 'title' => 'Guidelines should be established for public comments on community issues by members of staff, where such comments could be associated with the institution'],
                            ['code' => '11.3.4', 'title' => 'An institutional media office should be established with responsibility for managing media communications, seeking information about activities of the institution of potential interest to the community, and arranging for publication.'],
                            ['code' => '11.3.5', 'title' => 'Community views about the institution and its activities should be sought and strategies developed for improving perceptions.'],
                            ['code' => '11.3.6', 'title' => 'If issues or concerns about operational issues involving the institution are raised in public forums these should be dealt with immediately and objectively by the Rector or Dean or other designated senior members of faculty or staff.']
                        ]
                    ],
                    [
                        'code' => '11.4',
                        'title' => 'KPIs',
                        'type' => '2',
                        'kpis' => [
                            ['code' => 'S11.1', 'type' => self::KPI_QUANTITATIVE, 'title' => 'Proportion of full time teaching and other staff actively engaged in community service activities.'],
                            ['code' => 'S11.2', 'type' => self::KPI_QUANTITATIVE, 'title' => 'Number of community education programs provided as a proportion of the number of departments.']
                        ]
                    ],
                    [
                        'code' => '11.5',
                        'title' => 'College KPIs',
                        'type' => '3',
                        'kpis' => [
                        ]
                    ]
                ]
            ]
        ];

        foreach ($standards as $standard) {

            $this->db->set('code', $standard['code']);
            $this->db->set('title', $standard['title']);
            $this->db->insert('standard');
            $standard_id = $this->db->insert_id();

            foreach ($standard['criteria'] as $criterion) {

                $this->db->set('code', $criterion['code']);
                $this->db->set('title', $criterion['title']);
                $this->db->set('standard_id', $standard_id);
                $this->db->set('type', isset($criterion['type']) ? $criterion['type'] : 1);
                $this->db->insert('criteria');
                $criteria_id = $this->db->insert_id();

                if (isset($criterion['items'])) {
                    foreach ($criterion['items'] as $item) {

                        $this->db->set('code', $item['code']);
                        $this->db->set('title', $item['title']);
                        $this->db->set('criteria_id', $criteria_id);
                        $this->db->insert('item');
                        $this->db->insert_id();
                    }
                } elseif (isset($criterion['kpis'])) {
                    foreach ($criterion['kpis'] as $kpi) {

                        $this->db->set('code', $kpi['code']);
                        $this->db->set('title', $kpi['title']);
                        $this->db->set('criteria_id', $criteria_id);
                        $this->db->set('is_semester', 0);
                        $this->db->set('ncaaa', 1);
                        $this->db->set('category_id', 0);
                        $this->db->set('kpi_type', $kpi['type']);
                        $this->db->insert('kpi');
                        $this->db->insert_id();
                    }
                }
            }
        }
    }
    
    public function down() {

        $this->db->truncate('standard');
        $this->db->truncate('criteria');
        $this->db->truncate('item');
        $this->db->truncate('kpi');

    }
    
}
