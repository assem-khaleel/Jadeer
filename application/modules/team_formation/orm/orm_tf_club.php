<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Tf_Club extends Orm
{

    /**
     * @var $instances Orm_Tf_Club[]
     */
    protected static $instances = array();
    protected static $table_name = 'tf_club';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $name_ar = '';
    protected $name_en = '';
    protected $policies_en = '';
    protected $policies_ar = '';
    protected $description_en = '';
    protected $description_ar = '';
    protected $creator = 0;
    protected $approval_post = 0;
    protected $is_deleted = 0;
    protected $logo = '';
    protected $cover = '';
    protected $member_gender = 0;


    const POST_BY_ANYONE = 0;
    const POST_NEED_PERMISSION = 1;
    const POST_ADMIN = 2;

    const GENDER_MEMEBER_BOTH = 0;
    const GENDER_MEMEBER_MALE = 1;
    const GENDER_MEMEBER_FEMALE = 2;

    public static $post_list = array(
        self::POST_BY_ANYONE => 'Anyone can Post',
        self::POST_NEED_PERMISSION => 'Must approve the posts by admins and moderators',
        self::POST_ADMIN => 'Only the admins can post'
    );
    public static $member_gender_list = array(
        self::GENDER_MEMEBER_BOTH => 'Both Gender can Join the group',
        self::GENDER_MEMEBER_MALE => 'Only Male can Join the group',
        self::GENDER_MEMEBER_FEMALE => 'Only Female can Join the group'
    );


    /**
     * @return Tf_Club_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Tf_Club_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Tf_Club
     */
    public static function get_instance($id)
    {

        $id = intval($id);

        if (isset(self::$instances[$id])) {
            return self::$instances[$id];
        }

        return self::get_one(array('id' => $id));
    }

    /**
     * Get all rows as Objects
     *
     * @param array $filters
     * @param int $page
     * @param int $per_page
     * @param array $orders
     *
     * @return Orm_Tf_Club[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array())
    {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one row as Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Tf_Club
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Tf_Club();
    }

    /**
     * get count
     *
     * @param array $filters
     * @return int
     */
    public static function get_count($filters = array())
    {
        return self::get_model()->get_all($filters, 0, 0, array(), Orm::FETCH_COUNT);
    }

    public function to_array()
    {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['name_ar'] = $this->get_name_ar();
        $db_params['name_en'] = $this->get_name_en();
        $db_params['policies_en'] = $this->get_policies_en();
        $db_params['policies_ar'] = $this->get_policies_ar();
        $db_params['description_en'] = $this->get_description_en();
        $db_params['description_ar'] = $this->get_description_ar();
        $db_params['creator'] = $this->get_creator();
        $db_params['approval_post'] = $this->get_approval_post();
        $db_params['is_deleted'] = $this->get_is_deleted();
        $db_params['logo'] = $this->get_logo();
        $db_params['cover'] = $this->get_cover();
        $db_params['member_gender'] = $this->get_member_gender();

        return $db_params;
    }

    public function save()
    {
        if ($this->get_object_status() == 'new') {
            $insert_id = self::get_model()->insert($this->to_array());
            $this->set_id($insert_id);
        } elseif ($this->get_object_fields()) {
            self::get_model()->update($this->get_id(), $this->get_object_fields());
        }

        $this->set_object_status('saved');
        $this->reset_object_fields();
        return $this->get_id();
    }

    public function delete()
    {
        return self::get_model()->delete($this->get_id());
    }

    public function set_id($value)
    {
        $this->add_object_field('id', $value);
        $this->id = $value;

        $this->push_instance();
    }

    public function get_id()
    {
        return $this->id;
    }

    public function set_name_ar($value)
    {
        $this->add_object_field('name_ar', $value);
        $this->name_ar = $value;
    }

    public function get_name_ar()
    {
        return $this->name_ar;
    }

    public function set_name_en($value)
    {
        $this->add_object_field('name_en', $value);
        $this->name_en = $value;
    }

    public function get_name_en()
    {
        return $this->name_en;
    }


    public function set_policies_en($value)
    {
        $this->add_object_field('policies_en', $value);
        $this->policies_en = $value;
    }

    public function get_policies_en()
    {
        return $this->policies_en;
    }

    public function set_policies_ar($value)
    {
        $this->add_object_field('policies_ar', $value);
        $this->policies_ar = $value;
    }

    public function get_policies_ar()
    {
        return $this->policies_ar;
    }

    public function set_description_en($value)
    {
        $this->add_object_field('description_en', $value);
        $this->description_en = $value;
    }

    public function get_description_en()
    {
        return $this->description_en;
    }

    public function set_description_ar($value)
    {
        $this->add_object_field('description_ar', $value);
        $this->description_ar = $value;
    }

    public function get_description_ar()
    {
        return $this->description_ar;
    }

    public function set_creator($value)
    {
        $this->add_object_field('creator', $value);
        $this->creator = $value;
    }

    public function get_creator()
    {
        return $this->creator;
    }

    public function set_approval_post($value)
    {
        $this->add_object_field('approval_post', $value);
        $this->approval_post = $value;
    }


    public function get_approval_post($to_string = false)
    {
        if ($to_string) {
            return (isset(self::$post_list[$this->approval_post]) ? self::$post_list[$this->approval_post] : '');
        }

        return $this->approval_post;
    }

    public function set_is_deleted($value)
    {
        $this->add_object_field('is_deleted', $value);
        $this->is_deleted = $value;
    }

    public function get_is_deleted()
    {
        return $this->is_deleted;
    }

    public function set_logo($value)
    {
        $this->add_object_field('logo', $value);
        $this->logo = $value;
    }

    public function get_logo()
    {
        return $this->logo;
    }

    public function set_cover($value)
    {
        $this->add_object_field('cover', $value);
        $this->cover = $value;
    }

    public function get_cover()
    {
        return $this->cover;
    }

    public function set_member_gender($value)
    {
        $this->add_object_field('member_gender', $value);
        $this->member_gender = $value;
    }

    public function get_member_gender($to_string = false)
    {
        if ($to_string) {
            return (isset(self::$member_gender_list[$this->member_gender]) ? self::$member_gender_list[$this->member_gender] : '');
        }


        return $this->member_gender;
    }


    /**
     * @return Orm_User
     */
    public function get_creator_obj()
    {
        return Orm_User::get_instance($this->get_creator());
    }


    public function get_name($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_name_ar();
        }
        return $this->get_name_en();
    }

    public function get_description($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_description_ar();
        }
        return $this->get_description_en();
    }

    public function get_policies($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_policies_ar();
        }
        return $this->get_policies_en();
    }

    private $admins = null;
    /**
     * this function get admins
     * @return Orm_Tf_User_Club[] the call function
     */
    public function get_admins()
    {
        if (is_null($this->admins)) {
            $this->admins = Orm_Tf_User_Club::get_all(['club_id' => $this->get_id(), 'is_admin' => Orm_Tf_User_Club::USER_ADMIN]);
        }

        return $this->admins;
    }

    /**
     * this function get admin ids
     * @return array the call function
     */
    public function get_admin_ids()
    {
        $admin_ids = array();
        foreach ($this->get_admins() as $admin) {
            $admin_ids[] = $admin->get_user_id();
        }
        return $admin_ids;
    }

    private $members = null;
    /**
     * this function get memebers
     * @return Orm_Tf_User_Club[] the call function
     */
    public function get_memebers()
    {
        if (is_null($this->members)) {
            $this->members = Orm_Tf_User_Club::get_all(['club_id' => $this->get_id(), 'is_admin' => Orm_Tf_User_Club::USER_NOT_ADMIN]);
        }

        return $this->members;
    }
    /**
     * this function get member ids
     * @return array the call function
     */
    public function get_member_ids()
    {
        $member_ids = array();
        foreach ($this->get_memebers() as $memeber) {
            $member_ids[] = $memeber->get_user_id();
        }
        return $member_ids;
    }
    /**
     * this function check if can view
     * @return bool the call function
     */
    public static function check_if_can_view()
    {

        return Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'team_formation-list') || Orm_User::check_credential([Orm_User_Student::class], true);

    }

    /**
     * this function check if can add
     * @return bool the call function
     */
    public static function check_if_can_add()
    {
        return Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'team_formation-manage') || Orm_User::check_credential([Orm_User_Student::class], true);
    }

    private $can_edit = null;

    /**
     * this function check if can edit
     * @return bool|null the call function
     */
    public function check_if_can_edit()
    {

        if (is_null($this->can_edit)) {

            $this->can_edit = false;

            if (self::check_if_can_add() && $this->get_creator() == Orm_User::get_logged_user()->get_id()) {
                $this->can_edit = true;
            }
        }

        return $this->can_edit;

    }

    private $can_delete = null;

    /**
     * this function check if can delete
     * @return bool|null the call function
     */
    public function check_if_can_delete()
    {

        if (is_null($this->can_delete)) {

            $this->can_delete = false;

            if ($this->check_if_can_edit() && Orm_User::get_logged_user()->get_id()) {
                $this->can_delete = true;
            }
        }

        return $this->can_delete;
    }
    /**
     * this function get more club by its filters
     * @param array $attributes the filters of the get more club to be call function
     * @return int the call function
     */
    public static function get_more_club($attributes = array())
    {

        return Orm_Tf_Club::get_count($attributes) > 6;
    }
    /**
     * this function get users by its status and limit
     * @param int $status the status of the get users to be call function
     * @param int $limit the limit of the get users to be call function
     * @return int|Orm_Tf_User_Club[] the call function
     */
    public function get_users($status, $limit = 0)
    {

        return Orm_Tf_User_Club::get_all(['club_id' => $this->get_id(), 'status' => $status], 0, $limit);
    }
    /**
     * this function count Club members
     * @return int the call function
     */
    public function countClub_members()
    {
        return Orm_Tf_User_Club::get_count(['club_id' => $this->get_id(), 'stats' => Orm_Tf_User_Club::CLUB_MEMEBER]);
    }
    /**
     * this function count Club posts
     * @return int the call function
     */
    public function countClub_posts()
    {
        return Orm_Tf_Post::get_count(['club_id' => $this->get_id(), 'stats' => Orm_Tf_User_Club::CLUB_MEMEBER]);
    }

    /**
     * this function check_if can manage
     * @return bool the call function
     */
    public static function check_if_can_manage()
    {
        return Orm_User::check_credential([
                Orm_User::USER_STAFF
                , Orm_User::USER_FACULTY], false, 'team_formation-manage') || Orm_User::check_credential([
                Orm_User::USER_ALUMNI
                , Orm_User::USER_EMPLOYER
                , Orm_User::USER_STUDENT], true);
    }

    /**
     * @return string
     */
    public static function get_las_query()
    {
        return self::get_model()->last_query();
    }
    /**
     * this function get club Members by its club id and keyword
     * @param int $club_id the club id of the get club Members to be call function
     * @param string $keyword the keyword of the get club Members to be call function
     * @return array the call function
     */
    public static function get_clubMembers($club_id, $keyword)
    {
        $filters = array('club_id' => $club_id, 'status' => Orm_Tf_User_Club::CLUB_MEMEBER);
        $club_users = Orm_Tf_User_Club::get_all(['club_id' => $club_id]);
        $txt_fillter = $keyword;
        if (!empty($txt_fillter) && !empty($club_users)) {
            $users_ids = array();
            $search_inClub = array();
            foreach ($club_users as $club_user) {
                $search_inClub[] = $club_user->get_user_id();
            }
            $users = Orm_User::get_all(['keyword' => $txt_fillter, 'in_id' => $search_inClub]);
            if (!empty($users)) {
                foreach ($users as $user) {
                    $users_ids[] = $user->get_id();
                }
                $filters['user_id_in'] = $users_ids;

                return $filters;
            }
        }
        return $filters;
    }
}

