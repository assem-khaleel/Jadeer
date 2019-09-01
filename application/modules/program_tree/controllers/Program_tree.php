<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Program_tree
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * @author ADwairi
 * @author Hamzah
 * @author Laith
 */
class Program_tree extends MX_Controller
{

    protected $logged_user;
    private $view_params = array();

    /**
     * Program_tree constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if (!License::get_instance()->check_module('program_tree', true)) {
            show_404();
        }

        Orm_User::check_logged_in();

        $this->logged_user = Orm_User::get_logged_user();


        //
        //menu_tab
        //
        $this->view_params['menu_tab'] = 'program_tree';
        $this->breadcrumbs->push(lang('Program Tree'), '/program_tree');
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Program Tree'),
            'icon' => 'fa fa-tree'
        ), true);

        $this->view_params['category'] = 'general';
    }


    /**
     *the function get list
     * @return string the calling function
     */
    private function get_list(){
        $this->view_params['type'] = 1;
        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $filter = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        Orm_User::get_logged_user()->get_filters($filter);

        if (!empty($filter['college_id'])) {
            $filters['college_id'] = (int)$filter['college_id'];
        }
        if (!empty($filter['department_id'])) {
            $filters['department_id'] = (int)$filter['department_id'];
        }
        if (!empty($filter['program_id'])) {
            $filters['id'] = (int)$filter['program_id'];
        }
        if (!empty($filter['keyword'])) {
            $filters['keyword'] = trim($filter['keyword']);
        }

        $programs = Orm_Program::get_all($filters, $page, $per_page, array('p.department_id ASC', 'p.name_en ASC'));

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_program::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['programs'] = $programs;
        $this->view_params['fltr'] = $filter;
    }
    /**
     *this function index
     * @return string the html view
     * default controller action
     */
    public function index()
    {
        $this->get_list();
        $this->layout->view('program_tree/index', $this->view_params);
    }
    /**
     *this function filter
     * @return string the html view
     */
    public function filter(){
        if ($this->input->is_ajax_request()) {
            $this->get_list();
            $this->load->view('program_tree/data_table',$this->view_params);
        } else {
            $this->index();
        }
    }

    /**
     * this function download by its program id
     * @param int $program_id the program id of the view to be viewed
     * @return string the html view
     */
    public function view($program_id)
    {
        $this->breadcrumbs->push(lang('View').' '.lang('Tree'), '/program_tree/view');
        $filters['id'] = (int)$program_id;
        $programs = Orm_Program::get_one($filters);
        $this->view_params['pdf'] =false;
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Program Tree'),
            'icon' => 'fa fa-tree',
            'link_attr' => ' href="/program_tree/download/' . $program_id . '"',
            'link_title' => lang('Download'),
            'menu_view' => 'program_tree/sub_menu',

            'menu_params' => array('type' => 'view', 'programs' => $programs, 'id' => $program_id)
        ), true);


        $institution = Orm_Institution::get_one();
        $college_id = Orm_Program::get_one($filters)->get_department_obj()->get_college_id();
        $college = Orm_College::get_one(['id' => $college_id]);

        $data = [
            "copiesArrays" => true,
            "copiesArrayObjects" => true,
        ];
        $dataArray = [];
        $dataRelationsArray = [];
        $keys = [];


        $uni_col_relations = Orm_Pt_Keyword_Uni::get_all();
        foreach ($uni_col_relations as $uni_col_relation) {
            $keyUni = 'uni' . $uni_col_relation->get_id();

            if (!in_array($keyUni, $keys)) {
                $dataArray[] = [
                    'key' => $keyUni,
                    'text' => Orm_Pt_Keyword_Uni::get_one(['id' => $uni_col_relation->get_id()])->get_title(),
                    "category" => "DesiredEvents"
                ];
                $keys[] = $keyUni;
            }
            $dataRelationsArray [] = [
                "from" => 0,
                "to" => $keyUni
            ];
        }

        $uni_col_relations = Orm_Pt_Uni_College_Relation::get_all(['college_id'=>$college_id]);
        foreach ($uni_col_relations as $uni_col_relation) {
            $keyUni = 'uni' . $uni_col_relation->get_kuni_id();
            $keyCol = 'col' . $uni_col_relation->get_kcollege_id();

            if (!in_array($keyCol, $keys)) {
                $dataArray[] = [
                    'key' => $keyCol,
                    'text' => Orm_Pt_Keyword_College::get_one(['id' => $uni_col_relation->get_kcollege_id()])->get_title(),
                    "category" => "DesiredEvent"
                ];
                $keys[] = $keyCol;
            }
            $dataRelationsArray [] = [
                "from" => $keyUni,
                "to" => $keyCol
            ];
        }


        // Institution

            $dataArray[] = [
                'key' => 0,
                'text' => $institution->get_name(),
                "category" => "Source"
            ];


        // College
        $pro_col_relations = Orm_Pt_College_Program_Relation::get_all(['program_id' => $program_id]);
        foreach ($pro_col_relations as $pro_col_relation) {
            $keyCol = 'col' . $pro_col_relation->get_kcollege_id();
            $keyProg = 'prog' . $pro_col_relation->get_kprogram_id();
            if (!in_array($keyProg, $keys)) {
                $dataArray[] = [
                    'key' => 'prog' . $pro_col_relation->get_kprogram_id(),
                    'text' => Orm_Pt_Keyword_Program::get_one(['id' => $pro_col_relation->get_kprogram_id()])->get_title(),
                    "category" => "DesiredEventss"
                ];
                $keys[] = $keyProg;
            }

            $dataRelationsArray [] = [
                "from" => $keyCol,
                "to" => $keyProg
            ];

        }


        // Objectives
        $relationsObjProgTemp = Orm_Pt_Obj_Program_Relation::get_all(['program_id' => $program_id]);
        $objectives = [];
        foreach ($relationsObjProgTemp as $relationsObjProg) {
            $keyobj = 'obj' . $relationsObjProg->get_obj_id();
            $keyProg = 'prog' . $relationsObjProg->get_kprogram_id();

            if (!in_array($keyobj, $keys)) {
                $objectives[] = Orm_Program_Objective::get_one(['id' => $relationsObjProg->get_obj_id()]);

                $dataArray[] = [
                    'key' => $keyobj,
                    'text' => 'Objective ' . $relationsObjProg->get_obj_id(),
                    "category" => "UndesiredEvent"
                ];
                $keys[] = $keyobj;
            }
            $dataRelationsArray [] = [
                "from" => $keyProg,
                "to" => $keyobj
            ];
        }


        $objIDs = [];
        foreach ($relationsObjProgTemp as $relation) {
            $objIDs[] = $relation->get_obj_id();
        }

        // PLO
        $relationsObjPloTemp = Orm_Pt_Obj_Plo_Relation::get_all(['program_id' => $program_id, 'in_obj_id' => $objIDs]);
        $ploIDs = [];
        foreach ($relationsObjPloTemp as $relation) {
            $dataRelationsArray [] = [
                "from" => 'obj' . $relation->get_obj_id(),
                "to" => 'plo' . $relation->get_plo_id(),
            ];
            $ploIDs[] = $relation->get_plo_id();
        }

        if (License::get_instance()->check_module('curriculum_mapping')){
            Modules::load('curriculum_mapping');
            $PLOs = [];
            if (count($ploIDs)) {
                $PLOs = Orm_Cm_Program_Learning_Outcome::get_all(['in_id' => $ploIDs]);
            }

            foreach ($PLOs as $key => $PLO) {
                if (!in_array('plo' . $PLO->get_id(), $keys)) {
                    $dataArray[] = [
                        'key' => 'plo' . $PLO->get_id(),
                        'text' => 'PLO ' . ($key + 1),
                        "category" => "Comment"
                    ];
                    $keys[] = 'plo' . $PLO->get_id();
                }
            }
            $this->view_params['plo'] = $PLOs;
        }
        $data['nodeDataArray'] = $dataArray;
        $data['linkDataArray'] = $dataRelationsArray;

        $chartData = json_encode($data);

        $this->view_params['programs'] = $programs;
        $this->view_params['program_id'] = $program_id;
        $this->view_params['chartData'] = $chartData;
        $this->view_params['objectives'] = $objectives;
        $this->view_params['institution_mission'] = $institution->get_mission();
        $this->view_params['college_mission'] = $college->get_mission();
        $this->view_params['program_mission'] = $programs->get_mission();

        $this->layout->view('program_tree/view', $this->view_params);
    }

    /**
     * this function download by its program id
     * @param int $program_id the program id of downloadManuals to be viewed
     * @redirect pdf
     */
    public function download($program_id)
    {
        $filters['id'] = (int)$program_id;
        $programs = Orm_Program::get_one($filters);
        $institution = Orm_Institution::get_one();
        $college_id = Orm_Program::get_one($filters)->get_department_obj()->get_college_id();
        $college = Orm_College::get_one(['id' => $college_id]);

        $data = [
            "copiesArrays" => true,
            "copiesArrayObjects" => true,
        ];
        $dataArray = [];
        $dataRelationsArray = [];
        $keys = [];
        $keyUni = '';

        $uni_col_relations = Orm_Pt_Uni_College_Relation::get_all();
        foreach ($uni_col_relations as $uni_col_relation) {
            $keyUni = 'uni' . $uni_col_relation->get_kuni_id();
            $keyCol = 'col' . $uni_col_relation->get_kcollege_id();

            if (!in_array($keyCol, $keys)) {
                $dataArray[] = [
                    'key' => $keyCol,
                    'text' => Orm_Pt_Keyword_College::get_one(['id' => $uni_col_relation->get_kcollege_id()])->get_title()
//                "category" => "DesiredEvent"
                ];
                $keys[] = $keyCol;
            }
            $dataRelationsArray [] = [
                "from" => $keyUni,
                "to" => $keyCol
            ];
        }


        // Institution
        if (!in_array($keyUni, $keys)) {
            $dataArray[] = [
                'key' => $keyUni,
                'text' => $institution->get_name(),
                "category" => "Source"
            ];
            $keys[] = $keyUni;
        }


        // College
        $pro_col_relations = Orm_Pt_College_Program_Relation::get_all(['program_id' => $program_id]);
        foreach ($pro_col_relations as $pro_col_relation) {
            $keyCol = 'col' . $pro_col_relation->get_kcollege_id();
            $keyProg = 'prog' . $pro_col_relation->get_kprogram_id();
            if (!in_array($keyProg, $keys)) {
                $dataArray[] = [
                    'key' => 'prog' . $pro_col_relation->get_kprogram_id(),
                    'text' => Orm_Pt_Keyword_Program::get_one(['id' => $pro_col_relation->get_kprogram_id()])->get_title(),
                    "category" => "DesiredEvent"
                ];
                $keys[] = $keyProg;
            }

            $dataRelationsArray [] = [
                "from" => $keyCol,
                "to" => $keyProg
            ];

        }


        // Objectives
        $relationsObjProgTemp = Orm_Pt_Obj_Program_Relation::get_all(['program_id' => $program_id]);
        $objectives = [];
        foreach ($relationsObjProgTemp as $relationsObjProg) {
            $keyobj = 'obj' . $relationsObjProg->get_obj_id();
            $keyProg = 'prog' . $relationsObjProg->get_kprogram_id();

            if (!in_array($keyobj, $keys)) {
                $objectives[] = Orm_Program_Objective::get_one(['id' => $relationsObjProg->get_obj_id()]);

                $dataArray[] = [
                    'key' => $keyobj,
                    'text' => 'Objective ' . $relationsObjProg->get_obj_id(),
                    "category" => "UndesiredEvent"
                ];
                $keys[] = $keyobj;
            }
            $dataRelationsArray [] = [
                "from" => $keyProg,
                "to" => $keyobj
            ];
        }


        $objIDs = [];
        foreach ($relationsObjProgTemp as $relation) {
            $objIDs[] = $relation->get_obj_id();
        }

        // PLO
        $relationsObjPloTemp = Orm_Pt_Obj_Plo_Relation::get_all(['program_id' => $program_id, 'in_obj_id' => $objIDs]);
        $ploIDs = [];
        foreach ($relationsObjPloTemp as $relation) {
            $dataRelationsArray [] = [
                "from" => 'obj' . $relation->get_obj_id(),
                "to" => 'plo' . $relation->get_plo_id(),
            ];
            $ploIDs[] = $relation->get_plo_id();
        }
        if (License::get_instance()->check_module('curriculum_mapping')) {
            Modules::load('curriculum_mapping');
            $PLOs = [];
            if (count($ploIDs)) {
                $PLOs = Orm_Cm_Program_Learning_Outcome::get_all(['in_id' => $ploIDs]);
            }

            foreach ($PLOs as $key => $PLO) {
                if (!in_array('plo' . $PLO->get_id(), $keys)) {
                    $dataArray[] = [
                        'key' => 'plo' . $PLO->get_id(),
                        'text' => 'PLO ' . ($key + 1),
                        "category" => "Comment"
                    ];
                    $keys[] = 'plo' . $PLO->get_id();
                }
            }
            $this->view_params['plo'] = $PLOs;
        }
        $data['nodeDataArray'] = $dataArray;
        $data['linkDataArray'] = $dataRelationsArray;

        $chartData = json_encode($data);
        $path = Orm_Semester::get_active_semester()->get_year();
        $program = Orm_Program::get_instance($program_id);
        $path .= '/'.$program->get_department_obj()->get_college_obj()->get_name('english');
        $path .= '/'.$program->get_name('english');
        $path .= '/Program Tree';
        $files_dir = '/files/Documents/' . $path;

        $this->view_params['programs'] = $programs;
        $this->view_params['chartData'] = $chartData;
        $this->view_params['objectives'] = $objectives;
        $this->view_params['institution_mission'] = $institution->get_mission();
        $this->view_params['college_mission'] = $college->get_mission();
        $this->view_params['program_mission'] = $programs->get_mission();

        $this->view_params['pdf'] = true;
        $this->view_params['path'] = file_get_contents(FCPATH.$files_dir."/tree.png");

        Orm_Pt_Keyword::generate_pdf($programs, $this->view_params);
    }

    /**
     * this function edit by its program id and level
     * @param int $program_id the program id of the edit to be viewed
     * @param string $level the level of the edit to be viewed
     * @return string the html view
     */
    public function edit($program_id, $level = '')
    {

        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY],false, 'program_tree-manage');

        $program = Orm_Program::get_instance($program_id);

        $this->breadcrumbs->push(lang('Edit').' '.lang('Tree'), '/program_tree/edit');

        $filters['id'] = $program->get_id();

        $programs = Orm_Program::get_one($filters);

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Program Tree'),
            'icon' => 'fa fa-tree',
            'menu_view' => 'program_tree/sub_menu',
            'menu_params' => array('type' => 'edit', 'programs' => $programs, 'id' => $program->get_id())
        ), true);

        if (!$program->get_id()) {
            redirect("/program_tree/");
        }

        switch ($level) {
            case "college":
                $this->_college($programs, $level);
                break;
            case "program":
                $this->_program($programs, $level);
                break;
            case "objective":
                $this->_objective($programs, $level);
                break;
            case "plo":
                $this->_plo($programs, $level);
                break;
            default:

                if (Orm_User::get_logged_user()->get_institution_role() == Orm_Role::ROLE_INSTITUTION_ADMIN) {
                    $this->_university($programs, 'university');
                }
                if (Orm_User::get_logged_user()->get_institution_role() == Orm_Role::ROLE_COLLEGE_ADMIN) {
                    $this->_college($programs, 'college');
                }
                if (Orm_User::get_logged_user()->get_institution_role() == Orm_Role::ROLE_PROGRAM_ADMIN) {
                    $this->_college($programs, 'program');
                }
                break;
        }
    }


    /*  Created By: Ali Dwairi
        Date: 27/12/2016
        CURD university keywords
    */
    /**
     * this function _university by its programs and level
     * @param Orm_Program $programs the level of _university to be function call
     * @param int $level the level of _university to be function call
     * @return bool|void
     */
    private function _university(Orm_Program $programs, $level)
    {
        $keywordUni = new Orm_Pt_Keyword_Uni();
        $method = strtolower($this->input->method());

        if ($method == 'post') {

            $edit = $this->input->post('edit');
            $del = $this->input->post('delete');
            $kwID = $this->input->post('keywordID');

            if ((isset($edit) || isset($del)) && isset($kwID)) {
                $keywordEditObj = $keywordUni::get_one(["id" => $kwID]);
                if ($keywordEditObj->get_id()) {
                    $keywordEditObj->delete();
                }
            }

            if (!isset($del)) {
                $missionEn = $this->input->post('mission_en');
                $missionAr = $this->input->post('mission_ar');
                Validator::not_empty_field_validator('mission_en', $missionEn,
                    lang('Please enter University Mission Keyword').' '.lang('English'));
                Validator::not_empty_field_validator('mission_ar', $missionAr,
                    lang('Please enter University Mission Keyword').' '.lang('Arabic'));
                if (Validator::success()) {
                    $keyword = new Orm_Pt_Keyword();
                    $keywordExistObj = $keyword::get_one(["title" => [$missionEn, $missionAr]]);
                    if ($keywordExistObj->get_id()) {
                        $keywordID = $keywordExistObj->get_id();
                    } else {
                        $keyword->set_title_en($missionEn);
                        $keyword->set_title_ar($missionAr);
                        $keyword->save();
                        $keywordID = $keyword->get_id();
                    }
                    if (isset($kwID)) {
                        $obj = $keywordUni::get_one(["id" => $kwID]);
                    } else {
                        $kwExist = $keywordUni::get_one(["keyword_id" => $keywordID]);
                        if (!$kwExist->get_id()) {
                            $obj = $keywordUni;
                        }
                    }

                    if (isset($obj)) {
                        $obj->set_keyword_id($keywordID);
                        $obj->set_title_en($missionEn);
                        $obj->set_title_ar($missionAr);
                        $obj->save();
                    }

                }
            }
        }


        $institution = Orm_Institution::get_one();

        $this->view_params['programs'] = $programs;
        $this->view_params['keywords'] = $keywordUni::get_all();
        $this->view_params['institution_mission'] = $institution->get_mission();
        $this->view_params['active'] = $level;
        $this->layout->view('program_tree/university', $this->view_params);
    }


    /*  Created By: Ali Dwairi
        Date: 27/12/2016
        CURD college keywords, and build relation with university
    */
    /**
     * this function _college by its programs and level
     * @param Orm_Program $programs the level of _college to be function call
     * @param int $level the level of _college to be function call
     * @return bool|void
     */
    private function _college(Orm_Program $programs, $level)
    {
        /** @var @var $college_id Orm_Program */
        $college_id = $programs->get_department_obj()->get_college_id();
        $keywordCollegeObj = new Orm_Pt_Keyword_College();

        $method = strtolower($this->input->method());
        if ($method == 'post') {
            $del = $this->input->post('delete');
            $kwID = $this->input->post('keywordID');

            if (isset($del) && isset($kwID)) {
                $keywordDelObj = $keywordCollegeObj::get_one(["id" => $kwID,'college_id' =>$college_id]);
                if ($keywordDelObj->get_id()) {
                    $keywordDelObj->delete();
                }
                $keywordDelRelationObjArray = Orm_Pt_Uni_College_Relation::get_all(['kcollege_id' => $kwID,'college_id' =>$college_id]);
                if (count($keywordDelRelationObjArray)) {
                    foreach ($keywordDelRelationObjArray as $keywordDelRelationObj) {
                        $keywordDelRelationObj->delete();
                    }
                }
            }

            if (!isset($del)) {
                $missionEn = $this->input->post('mission_en');
                $missionAr = $this->input->post('mission_ar');
                $relations = $this->input->post('relation');

                Validator::not_empty_field_validator('mission_en', $missionEn,
                    lang('Please enter College Mission Keyword ').' '.lang('English'));
                Validator::not_empty_field_validator('mission_ar', $missionAr,
                    lang('Please enter College Mission Keyword ').' '.lang('Arabic'));
                if (Validator::success()) {
                    $keyword = new Orm_Pt_Keyword();
                    $keywordExistObj = $keyword::get_one(['title_en' => $missionEn, 'title_ar' => $missionAr]);
                    if ($keywordExistObj->get_id()) {
                        $keywordID = $keywordExistObj->get_id();
                    } else {
                        $keyword->set_title_en($missionEn);
                        $keyword->set_title_ar($missionAr);
                        $keyword->save();
                        $keywordID = $keyword->get_id();
                    }


                    if (isset($kwID)) {
                        $obj = $keywordCollegeObj::get_one(["id" => $kwID,'college_id' =>$college_id]);
                    } else {
                        $kwExist = $keywordCollegeObj::get_one(["keyword_id" => $keywordID,'college_id' =>$college_id]);
                        if (!$kwExist->get_id()) {
                            $obj = $keywordCollegeObj;
                        }
                    }

                    if (isset($obj)) {
                        $obj->set_keyword_id($keywordID);
                        $obj->set_title_en($missionEn);
                        $obj->set_title_ar($missionAr);
                        $obj->set_college_id($college_id);
                        $obj->save();
                    }
                }

                $kwColUniRelationObj = new Orm_Pt_Uni_College_Relation();
                $relationsToDel = $kwColUniRelationObj::get_all(['college_id' => $college_id]);
                foreach ($relationsToDel as $relationToDel) {
                    $relationToDel->delete();
                }

                if (!empty($relations)):
                if (count($relations)) {
                    foreach ($relations as $kwCol => $kwUniArray) {
                        foreach ($kwUniArray as $kwUni) {
                            $kwColUniRelationObj = new Orm_Pt_Uni_College_Relation();
                            $kwColUniRelationObj->set_kuni_id($kwUni);
                            $kwColUniRelationObj->set_kcollege_id($kwCol);
                            $kwColUniRelationObj->set_college_id($college_id);
                            $kwColUniRelationObj->save();
                        }
                    }
                }
                endif;
            }
        }

        $relations = array();
        $relationsTemp = Orm_Pt_Uni_College_Relation::get_all(['college_id' => $college_id], 0, 0, [],
            Orm::FETCH_ARRAY);
        foreach ($relationsTemp as $relation) {
            $relations[$relation['kcollege_id'] . '-' . $relation['kuni_id']] = 1;
        }

        $college = Orm_College::get_one(['id' => $college_id]);
        $this->view_params['keywordsUni'] = Orm_Pt_Keyword_Uni::get_all();
        $this->view_params['keywordsCollege'] = $keywordCollegeObj::get_all(['college_id' => $college_id]);
        $this->view_params['relations'] = $relations;

        $this->view_params['programs'] = $programs;
        $this->view_params['college_mission'] = $college->get_mission();
        $this->view_params['active'] = $level;
        $this->layout->view('program_tree/college', $this->view_params);
    }


    /*  Created By: Ali Dwairi
        Date: 27/12/2016
        CURD program keywords, and build relation with college
    */
    /**
     * this function _program by its programs and level
     * @param Orm_Program $programs the level of _program to be function call
     * @param int $level the level of _program to be function call
     * @return bool|void
     */
    private function _program(Orm_Program $programs, $level)
    {
        $keywordProgramObj = new Orm_Pt_Keyword_Program();
        $college_id = $programs->get_department_obj()->get_college_id();
        $program_id = $programs->get_id();
        $method = strtolower($this->input->method());
        if ($method == 'post') {
            $del = $this->input->post('delete');
            $kwID = $this->input->post('keywordID');

            if (isset($del) && isset($kwID)) {
                $keywordDelObj = $keywordProgramObj::get_one(["id" => $kwID,'program_id' =>$program_id]);
                if ($keywordDelObj->get_id()) {
                    $keywordDelObj->delete();
                }
                $keywordDelRelationObjArray = $keywordProgramObj::get_all(['kprogram_id' => $kwID,'program_id' =>$program_id]);
                if (count($keywordDelRelationObjArray)) {
                    foreach ($keywordDelRelationObjArray as $keywordDelRelationObj) {
                        $keywordDelRelationObj->delete();
                    }
                }
            }

            if (!isset($del)) {
                $missionEn = $this->input->post('mission_en');
                $missionAr = $this->input->post('mission_ar');
                $relations = $this->input->post('relation');

                Validator::not_empty_field_validator('mission_en', $missionEn,
                    lang('Please enter Program Mission Keyword').' '.lang('English'));
                Validator::not_empty_field_validator('mission_ar', $missionAr,
                    lang('Please enter Program Mission Keyword').' '.lang('Arabic'));
                if (Validator::success()) {
                    $keyword = new Orm_Pt_Keyword();
                    $keywordExistObj = $keyword::get_one(['title_en' => $missionEn, 'title_ar' => $missionAr]);
                    if ($keywordExistObj->get_id()) {
                        $keywordID = $keywordExistObj->get_id();
                    } else {
                        $keyword->set_title_en($missionEn);
                        $keyword->set_title_ar($missionAr);
                        $keyword->save();
                        $keywordID = $keyword->get_id();
                    }


                    if (isset($kwID)) {
                        $obj = $keywordProgramObj::get_one(["id" => $kwID,'program_id' =>$program_id]);
                    } else {
                        $kwExist = $keywordProgramObj::get_one(["keyword_id" => $keywordID,'program_id' =>$program_id]);
                        if (!$kwExist->get_id()) {
                            $obj = $keywordProgramObj;
                        }
                    }

                    if (isset($obj)) {
                        $obj->set_keyword_id($keywordID);
                        $obj->set_title_en($missionEn);
                        $obj->set_title_ar($missionAr);

                        $obj->set_program_id($program_id);
                        $obj->save();
                    }
                }
                $kwProgramColRelationObj = new Orm_Pt_College_Program_Relation();
                $relationsToDel = $kwProgramColRelationObj::get_all(['program_id' => $program_id]);
                foreach ($relationsToDel as $relationToDel) /** @var $relationToDel Orm_Pt_College_Program_Relation */ {
                    $relationToDel->delete();
                }
                if (!empty($relations)):
                if (count($relations)) {
                    foreach ($relations as $kwProgram => $kwUniArray) {
                        foreach ($kwUniArray as $kwCol) {
                            $kwProgramColRelationObj = new Orm_Pt_College_Program_Relation();
                            $kwProgramColRelationObj->set_kcollege_id($kwCol);
                            $kwProgramColRelationObj->set_kprogram_id($kwProgram);
                            $kwProgramColRelationObj->set_program_id($program_id);
                            $kwProgramColRelationObj->save();
                        }
                    }
                }
                endif;
            }
        }

        $relations = array();
        $relationsTemp = Orm_Pt_College_Program_Relation::get_all(['program_id' => $program_id], 0, 0, [],
            Orm::FETCH_ARRAY);
        foreach ($relationsTemp as $relation) {
            $relations[$relation['kprogram_id'] . '-' . $relation['kcollege_id']] = 1;
        }

        $this->view_params['keywordsCollege'] = Orm_Pt_Keyword_College::get_all(['college_id' => $college_id]);
        $this->view_params['keywordsProgram'] = Orm_Pt_Keyword_Program::get_all(['program_id' => $program_id]);
        $this->view_params['relations'] = $relations;

        $this->view_params['programs'] = $programs;
        $this->view_params['program_mission'] = $programs->get_mission();
        $this->view_params['active'] = $level;
        $this->layout->view('program_tree/program', $this->view_params);
    }


    /*  Created By: Ali Dwairi
        Date: 27/12/2016
        Build relation between objectives and program
    */
    /**
     * this function _objective by its programs and level
     * @param Orm_Program $programs the level of _objective to be function call
     * @param int $level the level of _objective to be function call
     * @return bool|void
     */
    private function _objective(Orm_Program $programs, $level)
    {

        $obj_filters['program_id'] = $programs->get_id();

        $objectives = Orm_Program_Objective::get_all($obj_filters);
        $keywordProgramObj = new Orm_Pt_Keyword_Program();


        $method = strtolower($this->input->method());
        if ($method == 'post') {
            $relations = $this->input->post('relation');
            $kwProgramObjRelationObj = new Orm_Pt_Obj_Program_Relation();
            $relationsToDel = $kwProgramObjRelationObj::get_all(['program_id' => $obj_filters['program_id']]);
            foreach ($relationsToDel as $relationToDel) /** @var $relationToDel Orm_Pt_Obj_Program_Relation */ {
                $relationToDel->delete();
            }

            if (!empty($relations)):
            if (count($relations)) {

                foreach ($relations as $kwProgram => $kwObjArray) {
                    foreach ($kwObjArray as $kwObj) {
                        $kwProgramObjRelationObj = new Orm_Pt_Obj_Program_Relation();
                        $kwProgramObjRelationObj->set_obj_id($kwObj);
                        $kwProgramObjRelationObj->set_kprogram_id($kwProgram);
                        $kwProgramObjRelationObj->set_program_id($obj_filters['program_id']);
                        $kwProgramObjRelationObj->save();
                    }
                }
            }
            endif;
        }

        $relations = array();
        $relationsTemp = Orm_Pt_Obj_Program_Relation::get_all(['program_id' => $obj_filters['program_id']], 0, 0, [],
            Orm::FETCH_ARRAY);
        foreach ($relationsTemp as $relation) {
            $relations[$relation['kprogram_id'] . '-' . $relation['obj_id']] = 1;
        }

        $this->view_params['programs'] = $programs;
        $this->view_params['program_mission'] = $programs->get_mission();
        $this->view_params['objectives'] = $objectives;
        $this->view_params['relations'] = $relations;
        $this->view_params['keywordsProgram'] = $keywordProgramObj::get_all(['program_id' => $obj_filters['program_id']]);
        $this->view_params['active'] = $level;
        $this->layout->view('program_tree/objective', $this->view_params);

    }


    /*  Created By: Ali Dwairi
        Date: 27/12/2016
        Build relation between PLO and program
    */
    /**
     * this function _plo by its programs and level
     * @param Orm_Program $programs the level of _plo to be function call
     * @param int $level the level of _plo to be function call
     * @return bool|void
     */
    private function _plo(Orm_Program $programs, $level)
    {

        $obj_filters['program_id'] = $programs->get_id();

        Modules::load('curriculum_mapping');
        $PLOs = Orm_Cm_Program_Learning_Outcome::get_all(['program_id' => $obj_filters['program_id']]);
        $objectives = Orm_Program_Objective::get_all($obj_filters);

        $method = strtolower($this->input->method());
        if ($method == 'post') {
            $relations = $this->input->post('relation');
            $kwPloObjRelationObj = new Orm_Pt_Obj_Plo_Relation();
            $relationsToDel = $kwPloObjRelationObj::get_all(['program_id' => $obj_filters['program_id']]);
            foreach ($relationsToDel as $relationToDel) {
                $relationToDel->delete();
            }

            if (!empty($relations)):
            if (count($relations)) {

                foreach ($relations as $obj_id => $kwUniArray) {
                    foreach ($kwUniArray as $plo_id) {
                        $kwPloObjRelationObj = new Orm_Pt_Obj_Plo_Relation();
                        $kwPloObjRelationObj->set_obj_id($obj_id);
                        $kwPloObjRelationObj->set_plo_id($plo_id);
                        $kwPloObjRelationObj->set_program_id($obj_filters['program_id']);
                        $kwPloObjRelationObj->save();
                    }
                }
            }
            endif;
        }
        $relations = array();
        $relationsTemp = Orm_Pt_Obj_Plo_Relation::get_all(['program_id' => $obj_filters['program_id']], 0, 0, [],
            Orm::FETCH_ARRAY);
        foreach ($relationsTemp as $relation) {
            $relations[$relation['obj_id'] . '-' . $relation['plo_id']] = 1;
        }

        $this->view_params['programs'] = $programs;
        $this->view_params['program_mission'] = $programs->get_mission();
        $this->view_params['objectives'] = $objectives;
        $this->view_params['plos'] = $PLOs;
        $this->view_params['relations'] = $relations;
        $this->view_params['active'] = $level;
        $this->layout->view('program_tree/plo', $this->view_params);
    }

    /**
     * this function saveImage by its id
     * @param int $id the id of the saveImage to be viewed
     * @redirect success or error
     */
    public function saveImage($id){
        $data=$this->input->post('data');
        if(intval($id)!=0 && !empty($data) ){
            $path = Orm_Semester::get_active_semester()->get_year();
            $program = Orm_Program::get_instance($id);
            $path .= '/'.$program->get_department_obj()->get_college_obj()->get_name('english');
            $path .= '/'.$program->get_name('english');
            $path .= '/Program Tree';
            $files_dir = '/files/Documents/' . $path;

            //check if file exists or not
            $files_full_dir = rtrim(FCPATH, '/') . $files_dir;
            if (!is_dir($files_full_dir)) {
                mkdir($files_full_dir, 0777, true);
            }

            var_dump(file_put_contents(FCPATH."$files_dir/tree.png",$data));
        }
    }
}
