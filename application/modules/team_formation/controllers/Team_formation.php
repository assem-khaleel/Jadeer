<?php

/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 7/9/17
 * Time: 5:02 PM
 */
class Team_formation extends MX_Controller
{
    private $view_params = array();
    private $current_user;

    /**
     * Team_formation constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if (!License::get_instance()->check_module('team_formation', true)) {

            show_404();
        }

        Orm_User::check_logged_in();

        $this->current_user = Orm_User::get_logged_user_id();

        Orm_Tf_Club::check_if_can_view();


        $this->layout->add_javascript('/assets/jadeer/js/add_more.js');
        $this->layout->add_javascript('/assets/jadeer/js/jquery.iframe-transport.js');
        $this->layout->add_javascript('/assets/jadeer/js/tinymce/tinymce.min.js', false);

        $this->breadcrumbs->push(lang('Team formation'), '/team_formation');
        $this->view_params['menu_tab'] = 'team_formation';

        $this->view_params['type'] = 'club';

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Team formation'),
            'icon' => 'fa fa-comments',
        ), true);

    }

    /**
     *this function index
     * @return string the html view
     */
    public function index()
    {

        $searchMyClub = $this->input->get('text_my_club');
        $searchInvitedClub = $this->input->get('text_invited_club');
        $searchSubscribeClub = $this->input->get('text_Subscribe_club');
        $searchMemberClub = $this->input->get('text_Member_club');

        /*  status are 4 type :
        0 group that created by me
        1 group user invited to join
        2 group join request for my club
        3 group the user are a member in it */


        if ($searchMyClub != '') {
            $filterMy = ['search' => $searchMyClub, 'creator' => $this->current_user];
        } else {
            $filterMy = ['creator' => $this->current_user];
        }
        $clubs = Orm_Tf_Club::get_all($filterMy,1,5 );
        $count_Myclubs = Orm_Tf_Club::get_count($filterMy);

        if ($searchMemberClub != '') {
            $filterMember = ['search' => $searchMemberClub, 'user_id' => $this->current_user, 'status' => Orm_Tf_User_Club::CLUB_MEMEBER , 'not_creator' => $this->current_user];
        } else {
            $filterMember = ['status' => Orm_Tf_User_Club::CLUB_MEMEBER, 'user_id' => $this->current_user , 'not_creator' => $this->current_user];
        }
        $memberClubs = Orm_Tf_Club::get_all($filterMember,1,5);
        $count_Membership = Orm_Tf_Club::get_count($filterMember);

        if ($searchInvitedClub != '') {
            $filterInvited = ['search' => $searchInvitedClub,'user_id' => $this->current_user, 'status' => Orm_Tf_User_Club::CLUB_FOR_JOIN , 'not_creator' => $this->current_user];
        } else {
            $filterInvited = ['status' => Orm_Tf_User_Club::CLUB_FOR_JOIN, 'user_id' => $this->current_user , 'not_creator' => $this->current_user];
        }
        $invitedClubs = Orm_Tf_Club::get_all($filterInvited,1,5);
        $count_Invittation = Orm_Tf_Club::get_count($filterInvited);


        if ($searchSubscribeClub != '') {
            $filterJoin = ['search' => $searchSubscribeClub,  'status' => Orm_Tf_User_Club::CLUB_SUBSCRIBE, 'club_creator' => $this->current_user];
        } else {
            $filterJoin = ['status' => Orm_Tf_User_Club::CLUB_SUBSCRIBE, 'club_creator' => $this->current_user];
        }

        $subscribeClubs = Orm_Tf_User_Club::get_all($filterJoin,1,5);

        $count_Suscriber= Orm_Tf_User_Club::get_count($filterJoin);

        $activeClubs = array();
        foreach ($clubs as $club){
            $activeClubs[] = $club->get_id();
        }
        foreach ($memberClubs as $club){
            $activeClubs[] = $club->get_id();
        }
        if(!empty($activeClubs)){
            $mostActive = Orm_Tf_Post::get_all(['in_club_id' => $activeClubs] , 1 , 6);
        }else{
            $mostActive ="";
        }

        $this->view_params['text_my_club'] = $searchMyClub;
        $this->view_params['text_invited_club'] = $searchInvitedClub;
        $this->view_params['text_Subscribe_club'] = $searchSubscribeClub;
        $this->view_params['text_Member_club'] = $searchMemberClub;

        $this->view_params['clubs'] = $clubs;
        $this->view_params['inviteClubs'] = $invitedClubs;
        $this->view_params['memberClubs'] = $memberClubs;
        $this->view_params['subscribeClubs'] = $subscribeClubs;
        $this->view_params['activeClubs'] = $mostActive;

        $this->view_params['count_clubs'] = $count_Myclubs;
        $this->view_params['count_inviteClubs'] = $count_Invittation;
        $this->view_params['count_memberClubs'] = $count_Membership;
        $this->view_params['count_subscribeClubs'] = $count_Suscriber;


        $this->view_params['more_club'] = Orm_Tf_Club::get_more_club($filterMy);

        $this->view_params['more_invite_club'] = Orm_Tf_Club::get_more_club($invitedClubs);
        $this->view_params['more_memeber_club'] =  Orm_Tf_Club::get_more_club($memberClubs);
        $this->view_params['more_subscribe_club'] =  Orm_Tf_Club::get_more_club($subscribeClubs);

        $this->view_params['user_id'] = $this->current_user;
        $this->view_params['sub_menu'] = 'team_formation/sub_menu';


        $this->layout->view('home', $this->view_params);

    }

    /**
     * this function load more club by its status
     * @param int $status the status of the load more club to be viewed
     * @return string the html view
     */
    public function load_more_club($status = 0){

        if(!isset($status)){
            Validator::set_error_flash_message("There's no clubs to display.");
            redirect('/team_formation');
        }
        if(!in_array($status , [Orm_Tf_User_Club::CLUB_FOR_ME,Orm_Tf_User_Club::CLUB_FOR_JOIN,Orm_Tf_User_Club::CLUB_SUBSCRIBE,Orm_Tf_User_Club::CLUB_MEMEBER])){
            Validator::set_error_flash_message("There's no clubs belong to this status.");
            redirect('/team_formation');
        }

        $this->breadcrumbs->push( "View All", '/team_formation/');


        $searchClub = $this->input->get('text_my_club');

        if($status == 0){
            if ($searchClub != '') {
                $fillter = ['search' => $searchClub, 'creator' => $this->current_user];
            } else {
                $fillter = ['creator' => $this->current_user];
            }
            $clubs = Orm_Tf_Club::get_all($fillter,1,6 );
        }elseif($status == 1){
            if ($searchClub != '') {
                $filterInvited = ['search' => $searchClub,'user_id' => $this->current_user, 'status' => Orm_Tf_User_Club::CLUB_FOR_JOIN , 'not_creator' => $this->current_user];
            } else {
                $filterInvited = ['status' => Orm_Tf_User_Club::CLUB_FOR_JOIN, 'user_id' => $this->current_user , 'not_creator' => $this->current_user];
            }
            $clubs = Orm_Tf_Club::get_all($filterInvited,1,6);
        }elseif($status == 3){
            if ($searchClub != '') {
                $filterMember = ['search' => $searchClub, 'user_id' => $this->current_user, 'status' => Orm_Tf_User_Club::CLUB_MEMEBER , 'not_creator' => $this->current_user];
            } else {
                $filterMember = ['status' => Orm_Tf_User_Club::CLUB_MEMEBER, 'user_id' => $this->current_user , 'not_creator' => $this->current_user];
            }
            $clubs = Orm_Tf_Club::get_all($filterMember,1,6);
        }else{
            if ($searchClub != '') {
                $filterJoin = ['search' => $searchClub,  'status' => Orm_Tf_User_Club::CLUB_SUBSCRIBE, 'club_creator' => $this->current_user];
            } else {
                $filterJoin = ['status' => Orm_Tf_User_Club::CLUB_SUBSCRIBE, 'club_creator' => $this->current_user];
            }
            $clubs_to_join = Orm_Tf_User_Club::get_all($filterJoin,1,6);
        }


        $which_status = ($status == 0 ? "My Clubs" : ($status == 1 ? "Invite Clubs" : ($status == 2 ? "Subscribe Clubs" : "Member Clubs")));

        $this->view_params['clubs_stats'] = $which_status;

        $this->view_params['text_my_club'] = $searchClub;

        $this->view_params['current_status'] = $status;

        if(isset($clubs)){
            $this->view_params['clubs'] = $clubs;
            $this->layout->view('view_all_clubs', $this->view_params);
        }else{
            $this->view_params['clubs_to_join'] = $clubs_to_join;
            $this->layout->view('view_all_request', $this->view_params);
        }
    }

    /**
     * this function get more clubs
     * @return string the html view
     */
    public function get_more_clubs(){
        $page = $this->input->get('page');
        $status = $this->input->get('status');
        $searchClub = $this->input->get('search_feild');

        if(!isset($status)){
            Validator::set_error_flash_message("There's no clubs to display.");
            redirect('/team_formation');
        }
        if(!in_array($status , [Orm_Tf_User_Club::CLUB_FOR_ME,Orm_Tf_User_Club::CLUB_FOR_JOIN,Orm_Tf_User_Club::CLUB_SUBSCRIBE,Orm_Tf_User_Club::CLUB_MEMEBER])){
            Validator::set_error_flash_message("There's no clubs belong to this status.");
            redirect('/team_formation');
        }
        if($status == 0){
            if ($searchClub != '') {
                $fillter = ['search' => $searchClub, 'creator' => $this->current_user];
            } else {
                $fillter = ['creator' => $this->current_user];
            }
            $clubs = Orm_Tf_Club::get_all($fillter,$page,6 );
        }elseif($status == 1){
            if ($searchClub != '') {
                $filterInvited = ['search' => $searchClub,'user_id' => $this->current_user, 'status' => Orm_Tf_User_Club::CLUB_FOR_JOIN , 'not_creator' => $this->current_user];
            } else {
                $filterInvited = ['status' => Orm_Tf_User_Club::CLUB_FOR_JOIN, 'user_id' => $this->current_user , 'not_creator' => $this->current_user];
            }
            $clubs = Orm_Tf_Club::get_all($filterInvited,$page,6);
        }elseif($status == 3){
            if ($searchClub != '') {
                $filterMember = ['search' => $searchClub, 'user_id' => $this->current_user, 'status' => Orm_Tf_User_Club::CLUB_MEMEBER , 'not_creator' => $this->current_user];
            } else {
                $filterMember = ['status' => Orm_Tf_User_Club::CLUB_MEMEBER, 'user_id' => $this->current_user , 'not_creator' => $this->current_user];
            }
            $clubs = Orm_Tf_Club::get_all($filterMember,$page,6);
        }else{
            if ($searchClub != '') {
                $filterJoin = ['search' => $searchClub,  'status' => Orm_Tf_User_Club::CLUB_SUBSCRIBE, 'club_creator' => $this->current_user];
            } else {
                $filterJoin = ['status' => Orm_Tf_User_Club::CLUB_SUBSCRIBE, 'club_creator' => $this->current_user];
            }
            $clubs_to_join = Orm_Tf_User_Club::get_all($filterJoin,$page,6);
        }

        if(isset($clubs)){
            $data['clubs'] = $clubs;
            $result = $this->load->view('load_more_clubs', $data);
        }else{
            $data['clubs_to_join'] = $clubs_to_join;
            $result = $this->load->view('load_more_clubs', $data);
        }
        echo $result;
    }

    /**
     * this function discover
     * @return string the html view
     */
    public function discover()
    {
        $this->view_params['type'] = 'discover';
        $this->view_params['sub_menu'] = 'team_formation/sub_menu';

        $searchText = $this->input->get('text');

        if ($searchText != '') {
            $filterNotMember = ['search' => $searchText, 'not_creator' => $this->current_user];
        } else {
            $filterNotMember = ['not_creator' => $this->current_user];
        }
        $filterNotMember['gender'] = Orm_User::get_logged_user()->get_gender() +1;

        $associateClubs = Orm_Tf_User_Club::get_all(['user_id' => $this->current_user],0,0);
        $excludedClubs = array();
        foreach ($associateClubs as $club){ /** @var $club Orm_Tf_User_Club*/
        if(!in_array($club->get_club_id() , $excludedClubs) ){
            $excludedClubs[] = $club->get_club_id();
             }
        }
        $filterNotMember['not_in_id'] = $excludedClubs;

        $NotMemberClubs = Orm_Tf_Club::get_all($filterNotMember);

        $this->view_params['searchText'] = $searchText;
        $this->view_params['results'] = $NotMemberClubs;

        $this->layout->view('discover', $this->view_params);
    }

    /**
     * this function manage
     * @return string the html view
     */
    public function manage()
    {
        if(Orm_Tf_Club::check_if_can_add()){
            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'link_attr' => 'href="/team_formation/add_edit"',
                'link_icon' => 'plus',
                'link_title' => lang('Add').' '.lang('Club')
            ), true);
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Team formation'),
            'icon' => 'fa fa-comments',

        ), true);

        $active_tab = $this->input->get_post('active_tab');

        if($active_tab == "admin"){
            $this->view_params['active_tab'] = 'admin';
        }else{
            $this->view_params['active_tab'] = 'creator';
        }

        $this->view_params['type'] = 'manage';
        $this->view_params['sub_menu'] = 'team_formation/sub_menu';

        $this->breadcrumbs->push(lang('Manage').' '.lang('Club'), '/team_formation/manage');

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }


        $filters = array('creator' => $this->current_user , 'search' => $fltr['keyword']);

        $clubs = Orm_Tf_Club::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Tf_Club::get_count($filters));

        $this->view_params['clubs'] = $clubs;
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;

        $this->_get_adminClubs();

        $this->layout->view('manage', $this->view_params);

    }

    /**
     * this function _get admin Clubs
     * @return string get all data user club the call function
     */
    private function _get_adminClubs(){
        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');

        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array('user_id' => $this->current_user
        ,'status' => Orm_Tf_User_Club::CLUB_MEMEBER
        ,'is_admin' => Orm_Tf_User_Club::USER_ADMIN
        ,'search' => $fltr['keyword']);

        $clubs = Orm_Tf_User_Club::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Tf_User_Club::get_count($filters));

        $this->view_params['admin_clubs'] = $clubs;
        $this->view_params['admin_pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;
    }

    /**
     * this function invite users by its club id
     * @param int $club_id the club id of the invite users to be viewed
     * @return string the html view
     */
    public function invite_users($club_id = 0)
    {
        $filterClub_info = ['creator' => $this->current_user , 'id' => $club_id];
        $clubs = Orm_Tf_Club::get_all($filterClub_info,0,1 );

        $this->view_params['clubs'] = $clubs;

        $this->load->view('manage/invite_users', $this->view_params);
    }
    /**
     * this function manage members by its club id
     * @param int $club_id the club id of the invite users to be viewed
     * @return string the html view
     */
    public function manage_members($club_id = 0){
        $filterClub = array('id' => $club_id);
        $club_info = Orm_Tf_Club::get_one($filterClub);
        if($club_info->get_id() == 0 ){
            Validator::set_error_flash_message("Unavailable Resource");
            redirect('/');
        }

//        $club_admins = Orm_Tf_User_Club::get_all(['is_admin'=>1,'club_id'=>$club_id]);

        if(Orm_User::has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)
        || Orm_User::get_logged_user_id() === $club_info->get_creator()
        || in_array(Orm_User::get_logged_user_id(),$club_info->get_admin_ids()))
        {
            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'sub_title' => lang('Manage').' '.$club_info->get_name().' Club',
                'title' => lang('Team Formation'),
                'link_attr' => 'href="/team_formation/invite_users/'.$club_id.'" data-toggle="ajaxModal"',
                'link_icon' => 'user-plus',
                'link_title' => lang('Invite Members')
            ), true);
        }

//        if(Orm_Tf_Club::check_if_can_manage()){
//            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
//                'sub_title' => 'Manage '.$club_info->get_name().' Club',
//                'title' => 'Team Formation',
//                'link_attr' => 'href="/team_formation/invite_users/'.$club_id.'" data-toggle="ajaxModal"',
//                'link_icon' => 'user-plus',
//                'link_title' => lang('Invite Members')
//            ), true);
//        }

        $this->breadcrumbs->push(lang('Manage').' '.lang('Clubs'), '/team_formation/manage');
        $this->breadcrumbs->push(lang('Manage').' '.lang('Members') , '/team_formation/manage_members/'.$club_id.'');

        $keyword = $this->input->get('fltr[keyword]');

        $filters = Orm_Tf_Club::get_clubMembers($club_id , $keyword);

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');

        if (!$page) {
            $page = 1;
        }

        $club_members = Orm_Tf_User_Club::get_all($filters , $page , $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Tf_User_Club::get_count($filters));


        $this->view_params['members'] = $club_members;
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['club_info'] = $club_info;

        $this->layout->view('manage/manage_members', $this->view_params);
    }

    /**
     * this function get users for invite
     * @return string the html view
     */
    public function get_users_for_invite(){
        $user_class = $this->input->get_post('user_class');
        $allowed_types = $this->input->get_post('allowed_types');
        $allow_change_types = boolval($this->input->get_post('allow_change_types'));
        $club_id = $this->input->get_post('club_id');
        $property_id = $this->input->get_post('users_to_invite');


        if(empty($allowed_types) || !is_array($allowed_types)) {
            $allowed_types = array(
                Orm_User::USER_FACULTY,
                Orm_User::USER_STAFF,
                Orm_User::USER_STUDENT,
                Orm_User::USER_ALUMNI,
                Orm_User::USER_EMPLOYER,
            );
        }

        if(empty($user_class)) {
            $allow_change_types = true;

            $values = array_values($allowed_types);
            $user_class = array_shift($values);
        }

        $per_page = 6;
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $fillter0 = array('club_id' => $club_id);
        $exclude_users = Orm_Tf_User_Club::get_all($fillter0);

        foreach ($exclude_users as $exclude_user){
            $excludeUsersArray[] = $exclude_user->get_user_id();
        }

        if(!$exclude_users){
            $excludeUsersArray = "";
        }

        $club_info = Orm_Tf_Club::get_instance($club_id);
        $member_gender = $club_info->get_member_gender();
        ($member_gender != 0 ? $member_gender -= 1:$member_gender = '');




        if (!empty($fltr['keyword'])) {
            $filters = array('gender' => $member_gender,'not_id' => $this->current_user , 'not_in_id' => $excludeUsersArray , 'keyword' => trim($fltr['keyword']));
        }else{
            $filters = array('gender' => $member_gender,'not_id' => $this->current_user , 'not_in_id' => $excludeUsersArray );
        }

        $users = array();
        $user_counts = 0;

        if (in_array($user_class, $allowed_types)) {
            $users = $user_class::get_all($filters, $page, $per_page);

            $user_counts = $user_class::get_count($filters);
        }

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI'), 'num_elements' => 5, 'pager_class' => 'pagination m-a-1'));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count($user_counts);

        $this->view_params['users'] = $users;
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;

        $this->view_params['user_class'] = $user_class;
        $this->view_params['allowed_types'] = $allowed_types;
        $this->view_params['allow_change_types'] = $allow_change_types;
        $this->view_params['club_id'] = $club_id;
        $this->view_params['proparty_id'] = $property_id;
        $this->layout->set_layout('layout_blank')->view('user/find_members_to_invite', $this->view_params);
    }

    /**
     * this function invite user
     * @return string the html view
     */
    public function invite_user(){
        $user_id = $this->input->post('user_id');
        $club_id = $this->input->post('club_id');
        $invite_member = Orm_Tf_User_Club::get_one(['club_id' => $club_id , 'user_id' => $user_id]);
        $invite_member->set_club_id($club_id);
        $invite_member->set_user_id($user_id);
        $invite_member->set_status(Orm_Tf_User_Club::CLUB_FOR_JOIN);

       $inserted_id = $invite_member->save();
       $new_club = Orm_Tf_Club::get_instance($invite_member->get_club_id());

        Orm_Notification::send_notification(
            Orm_User::get_logged_user_id(),
            $user_id,
            Orm_Notification_Template::CLUBS,
            Orm_Notification::TYPE_CLUBS,
            array(

                '%club_name_english%',
                '%sender_name%'
            ),
            array(
                $new_club->get_name_en()
            )
        );

       $user_club = Orm_Tf_User_Club::get_instance($inserted_id);
       $inserted_user_id = $user_club->get_user_id();

       $user = Orm_User::get_instance($inserted_user_id);
       $invited_username = $user->get_full_name();
       Validator::set_success_flash_message($invited_username." ".lang('Invited Successfully'));
       return json_response(['success' => true ]);
    }
    /**
     * this function add edit by its id
     * @param int $id the id of the add edit to be viewed
     * @return string the html view
     */
    public function add_edit($id = 0)
    {
        if(!Orm_Tf_Club::check_if_can_add()){
            Validator::set_error_flash_message("Permission denied");
            redirect('/');
        }
        $club = Orm_Tf_Club::get_instance($id);
        if($club->get_id() == 0){
            $this->breadcrumbs->push(lang('Add') . ' ' . lang('Club'), '/team_formation/add_edit');
        }else{
            $this->breadcrumbs->push(lang('Edit') . ' ' . lang('Club'), '/team_formation/add_edit');
        }
        $this->view_params['club'] =$club;
        $this->layout->view('add_club', $this->view_params);
    }

    /**
     * this function save
     * @redirect success or error
     */
    public function save()
    {
        Orm_Tf_Club::check_if_can_add();
        
        $id = $this->input->post('id');
        $name_en = $this->input->post('name_en');
        $name_ar = $this->input->post('name_ar');
        $description_en = $this->input->post('description_en');
        $description_ar = $this->input->post('description_ar');
        $policies_en = $this->input->post('policies_en');
        $policies_ar = $this->input->post('policies_ar');
        $approval_post = $this->input->post('approval_post');
        $memeber_gender = $this->input->post('memeber_gender');

        $memeber_gender = !is_null($memeber_gender) ? $memeber_gender : -1;
        $memeber_gender = $memeber_gender==-1 ?Orm_User::get_logged_user()->get_gender() + 1: $memeber_gender;



        $club = Orm_Tf_Club::get_instance($id);
        $club->set_name_en($name_en);
        $club->set_name_ar($name_ar);
        $club->set_description_en($description_en);
        $club->set_description_ar($description_ar);
        $club->set_policies_en($policies_en);
        $club->set_policies_ar($policies_ar);
        $club->set_approval_post($approval_post);
        $club->set_member_gender($memeber_gender);
        $club->set_creator(Orm_User::get_logged_user_id());

        /* Validator Start*/
        Validator::required_field_validator('name_en',$name_en,lang('Invalid Club Name') . ' ( ' . lang('English').' ) ');
        Validator::required_field_validator('name_ar',$name_ar,lang('Invalid Club Name') . ' ( ' . lang('Arabic').' ) ');
        Validator::required_field_validator('description_en',$description_en,lang('Invalid Description') . ' ( ' . lang('English').' ) ');
        Validator::required_field_validator('description_ar',$description_ar,lang('Invalid Description') . ' ( ' . lang('Arabic').' ) ');
        Validator::required_field_validator('policies_en',$policies_en,lang('Invalid Policies') . ' ( ' . lang('English').' ) ');
        Validator::required_field_validator('policies_ar',$policies_ar,lang('Invalid Policies') . ' ( ' . lang('Arabic').' ) ');
        /*Validator End*/

        $logo = $_FILES['logo'];
        if ($logo['name']) {
            $logoFile = $this->attach('logo');
            $club->set_logo($logoFile);
        }
        $cover = $_FILES['cover'];
        if ($cover['name']) {
            $coverFile = $this->attach('cover');
            $club->set_cover($coverFile);
        }

        if (Validator::success()) {
            $club->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));
            redirect('/team_formation/manage');
        }

        if($id == 0){
            $this->breadcrumbs->push(lang('Add') . ' ' . lang('Team formation'), '/team_formation/add_edit');
        }else{
            $this->breadcrumbs->push(lang('Edit') . ' ' . lang('Team formation'), '/team_formation/add_edit');
        }
        $this->view_params['club'] = $club;



        $this->layout->view('add_club', $this->view_params);
    }
    /**
     * this function delete club by its id and is ajax
     * @param int $id the id of the delete club to be viewed
     * @param bool $is_ajax the is ajax of the delete club to be viewed
     * @return string the html view
     */
    public function delete_club($id = 0 , $is_ajax = false)
    {
       if(!$is_ajax){
           if(!$this->input->is_ajax_request()){
               Validator::set_error_flash_message(lang('Bad request please try again!'));
               exit('<script>document.location.href="/";</script>');
           }
       }

        if(!Orm_Tf_Club::check_if_can_manage()){
            Validator::set_success_flash_message(lang('Permission Denied'), true);
            exit('<script>window.location.href("/");</script>');
        }

        $club = Orm_Tf_Club::get_instance($id);

        if($club->get_id()){
            $club->delete();
            $club_members = Orm_Tf_User_Club::get_all(['club_id' => $club->get_id()]);
            foreach ($club_members as $member){
                $member->delete();
            }
            Validator::set_success_flash_message(lang('Club Deleted Successfully'), true);
            if($is_ajax){
                redirect('/team_formation');
            }else{
                exit('<script>window.location.href("/team_formation/manage");</script>');
            }
        }else{
            Validator::set_success_flash_message(lang('Unavailable Resource'), true);
            if($is_ajax){
                exit('<script>window.location.href("/");</script>');
            }else{
                redirect('/');
            }
        }
    }
    /**
     * this function attach by its field Name
     * @param string $fieldName the field Name of the attach to be call function
     * @return string|bool the call function
     */
    private function attach($fieldName)
    {
        $this->load->library('Uploader_Image');
        Uploader_Image::common_validator('file_upload', $fieldName);
        Uploader_Image::zero_size_validator('file_upload', $fieldName, lang('File not found.'));
        Uploader_Image::max_size_validator('file_upload', $fieldName, $this->config->item('upload_max_size'), lang('File exceeds maximum allowed size.'));
        Uploader_Image::mime_type_validator('file_upload', $fieldName, array( 'image/png', 'image/gif', 'image/jpeg', 'image/xbm'), lang('File type not allowed.'));

        if (Validator::success()) {
            $store_dir_path = rtrim(FCPATH, '/').'/files/clubs';
            if(!is_dir($store_dir_path)){
                mkdir($store_dir_path, 0777 );
            }
            $file = '/files/clubs/' .time().$_FILES[$fieldName]['name'];
            $full_path = rtrim(FCPATH, '/') . $file;
            Uploader_Image::imgResize($full_path, 300, 300);
            Uploader_Image::move_file_to($fieldName, $full_path);
            return $file;
        }else{
            return "false";
        }

    }


    /**
     * this function club info by its id and is ajax
     * @param int $id the id of the club info to be viewed
     * @return string the html view
     */
    public function club_info($id = 0)
    {
        $this->breadcrumbs->push(lang('Club Info'), '/team_formation/info');

        $club = Orm_Tf_Club::get_instance($id);

        if($club->get_id() == 0){
            Validator::set_error_flash_message("Unavailable Resource");
            redirect('/');
        }

        $keyword = $this->input->get('fltr[keyword]');
        $filters = Orm_Tf_Club::get_clubMembers($club->get_id() , $keyword);

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');

        if (!$page) {
            $page = 1;
        }

        $club_members = Orm_Tf_User_Club::get_all($filters , $page , $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Tf_User_Club::get_count($filters));


        $this->view_params['members'] = $club_members;
        $this->view_params['pager'] = $pager->render(true);

        $this->view_params['club'] = $club;
        $this->view_params['allPosts'] = Orm_Tf_Post::get_all(['club_id' => $id], 0, 0, ['date_created DESC']);

        $filterAppending = ['status' => 0, 'is_deleted' => 0, 'creator' =>$this->current_user];
        $userClubAppending = Orm_Tf_Club::get_all($filterAppending);

        $filterAccepted = ['status' => 1, 'is_deleted' => 0, 'creator' =>$this->current_user];
        $userClubAccepted = Orm_Tf_Club::get_all($filterAccepted);

        $this->view_params['userClubAppending'] = $userClubAppending;
        $this->view_params['userClubAccepted'] = $userClubAccepted;
        $this->view_params['club_id'] = $id;
        $this->view_params['countAppending'] = count($userClubAppending);
        $this->view_params['countAccepted'] = count($userClubAccepted);

        $this->layout->view('club_info', $this->view_params);
    }

    /**
     * this function add edit post by its id and post id
     * @param int $id the id of the add edit post to be viewed
     * @param int $post_id the post id of the add edit post to be viewed
     * @return string the html view
     */
    public function add_edit_post($id = 0, $post_id = 0)
    {
        $this->view_params['club'] = Orm_Tf_Club::get_instance($id);
        $this->view_params['post'] = Orm_Tf_Post::get_instance($post_id);
        $this->breadcrumbs->push(lang('Team formation'), '/team_formation');
        $this->breadcrumbs->push(lang('Add') . ' ' . lang('Team formation'), '/team_formation/create');
        $this->load->view('add_post', $this->view_params);
    }

    /**
     * this function save post
     * @redirect success or error
     */
    public function save_post()
    {
        $post_id = $this->input->post('id');
        $content = $this->input->post('content');
        $club_id = $this->input->post('club_id');

        $post = Orm_Tf_Post::get_instance($post_id);

        Validator::required_field_validator('content', $content, lang('Required Filed'));

        $post->set_club_id($club_id);
        $post->set_content($content);
        $post->set_date_created(date('Y-m-d H:i:s'));
        $post->set_creator(Orm_User::get_logged_user()->get_id());


        if (Validator::success()) {
            $post->save();
            Validator::set_success_flash_message(lang('Successfully Saved'));
            json_response(['success' => true, 'id' => $post->save()]);
        }
        $this->view_params['club'] = Orm_Tf_Club::get_instance($club_id);
        $this->view_params['post'] = Orm_Tf_Post::get_one(['id' => $post_id]);
        json_response(['success' => false, 'html' => $this->load->view('add_post', $this->view_params, true)]);
    }

    /**
     * this function delete by its id
     * @param int $id the id of the delete to be viewed
     * @redirect success or error
     */
    public function delete($id)
    {
        $post = Orm_Tf_Post::get_instance($id);

        if ($post->get_id()) {
            $post->delete();
        }
        Validator::set_success_flash_message(lang('Successful Delete'));
    }

    /**
     * this function join club
     * @redirect success or error
     */
    public function join_club()
    {
        if(!$this->input->is_ajax_request()){
            Validator::set_error_flash_message(lang('Bad request please try again!'));
            exit('<script>document.location.href="/";</script>');
        }

        $club_id = $this->input->get('club_id');

        $club_user =Orm_Tf_User_Club::get_instance($club_id);
        $club_user->set_status(Orm_Tf_User_Club::CLUB_SUBSCRIBE);
        $club_user->set_club_id($club_id);
        $club_user->set_user_id($this->current_user);
        $club_user->save();
        Validator::set_success_flash_message(lang('Your request to join has been send successfully'));
        return json_response(['success' => true ]);
    }

    /**
     * this function accept member by its member id
     * @param int $member_id the member id of the accept member to be viewed
     * @redirect success or error
     */
    public function accept_member($member_id = 0 )
    {
        $club_user = Orm_Tf_User_Club::get_instance($member_id);
        if($club_user->get_id()){
            $club_user->set_status(Orm_Tf_User_Club::CLUB_MEMEBER);
        }else{
            Validator::set_error_flash_message(lang('Unavailable Resource'));
            redirect('/');
        }

        $club_user->save();
        Validator::set_success_flash_message(lang('Accepted Successfully'));
        redirect('/team_formation');
    }

    /**
     * this function accept member invitation by its club id
     * @param int $club_id the club id of the accept member invitation to be viewed
     * @redirect success or error
     */
    public function accept_member_invitation($club_id = 0 )
    {
        $club = Orm_Tf_Club::get_instance($club_id);
        if($club->get_id() == 0){
            Validator::set_error_flash_message(lang('Unavailable Resource'));
            redirect('/');
        }
        $club_user = Orm_Tf_User_Club::get_one(['club_id' => $club_id , 'user_id' => $this->current_user]);
        if($club_user->get_id()){
            $club_user->set_status(Orm_Tf_User_Club::CLUB_MEMEBER);
        }else{
            Validator::set_error_flash_message(lang('Unavailable Resource'));
            redirect('/');
        }

        $club_user->save();
        Validator::set_success_flash_message(lang('Accepted Successfully'));
        redirect('/team_formation');
    }

    /**
     * this function refuse invitation by its club id
     * @param int $club_id the club id of the refuse invitation to be viewed
     * @redirect success or error
     */
    public function refuse_invitation($club_id = 0 )
    {
        $club = Orm_Tf_Club::get_instance($club_id);
        if($club->get_id() == 0){
            Validator::set_error_flash_message(lang('Unavailable Resource'));
            redirect('/');
        }
        $club_user = Orm_Tf_User_Club::get_one(['club_id' => $club_id , 'user_id' => $this->current_user]);
        if($club_user->get_id()){
            $club_user->delete();
        }else{
            Validator::set_error_flash_message(lang('Unavailable Resource'));
            redirect('/');
        }

        Validator::set_success_flash_message(lang('Invitation Deleted Successfully'));
        redirect('/team_formation');
    }

    /**
     * this function leave club by its member id
     * @param int $member_id the member id of the leave club to be viewed
     * @redirect success or error
     */
    public function leave_club($member_id = 0)
    {
        $member = Orm_Tf_User_Club::get_instance($member_id);
        if($member->get_id()){
            $member->delete();
            Validator::set_success_flash_message(lang('Leaved Successfully'));
            redirect('/team_formation');
        }else{
            Validator::set_error_flash_message(lang('Unavailable Resource'));
            redirect('/team_formation');
        }
    }

    /**
     * this function remove member by its member id
     * @param int $member_id the member id of the remove member to be viewed
     * @redirect success or error
     */
    public function remove_member($member_id){
        if(!$this->input->is_ajax_request()){
            Validator::set_error_flash_message(lang('Bad request please try again!'));
            exit('<script>document.location.href="/";</script>');
        }
        $memeber = Orm_Tf_User_Club::get_instance($member_id);
        if($memeber->get_id()){
            $memeber->delete();
            Validator::set_success_flash_message(lang('Member Removed Successfully'));
        }else{
            Validator::set_error_flash_message(lang('Unavailable Resource'));
        }
    }
    /**
     * this function set as admin by its member id
     * @param int $member_id the member id of the set as admin to be viewed
     * @redirect success or error
     */
    public function set_as_admin($member_id = 0 , $club_id = 0){
        if(Orm_Tf_Club::get_instance($club_id)->get_id() == 0){
            Validator::set_error_flash_message(lang('Unavailable Resource'));
            redirect('/');
        }
        $memeber = Orm_Tf_User_Club::get_one(['id' => $member_id , 'club_id' => $club_id , 'is_admin' => Orm_Tf_User_Club::USER_NOT_ADMIN]);
        if($memeber->get_id()){
            $memeber->set_is_admin(Orm_Tf_User_Club::USER_ADMIN);
            $memeber->save();
            Validator::set_success_flash_message(lang('Set Admin Successfully'));
            redirect('/team_formation/manage_members/'.$club_id);
        }else{
            Validator::set_error_flash_message(lang('Unavailable Resource'));
            redirect('/team_formation/manage_members/'.$club_id);
        }
    }
    /**
     * this function set as admin by its member id and club id
     * @param int $member_id the member id of the set as admin to be viewed
     * @param int $club_id the member id of the set as admin to be viewed
     * @redirect success or error
     */
    public function un_set_as_admin($member_id =0 , $club_id = 0){
        if(Orm_Tf_Club::get_instance($club_id)->get_id() == 0){
            Validator::set_error_flash_message(lang('Unavailable Resource'));
            redirect('/');
        }
        $memeber = Orm_Tf_User_Club::get_one(['id' => $member_id , 'club_id' => $club_id , 'is_admin' => Orm_Tf_User_Club::USER_ADMIN]);
        if($memeber->get_id()){
            $memeber->set_is_admin(Orm_Tf_User_Club::USER_NOT_ADMIN);
            $memeber->save();
            Validator::set_success_flash_message(lang('Unset Successfully'));
            redirect('/team_formation/manage_members/'.$club_id);
        }else{
            Validator::set_error_flash_message(lang('Unavailable Resource'));
            redirect('/team_formation/manage_members/'.$club_id);
        }
    }
}

