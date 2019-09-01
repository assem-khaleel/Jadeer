<?php
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class Orm_User extends Orm
{

    /**
     * @var $instances Orm_User[]
     */
    protected static $instances = array();
    protected static $table_name = 'user';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $class_type = '';
    protected $login_id = '';
    protected $integration_id = 0;
    protected $email = '';
    protected $password = '';
    protected $birth_date = '0000-00-00';
    protected $last_login = '0000-00-00 00:00:00';
    protected $is_active = 1;
    protected $avatar = '';
    protected $first_name = '';
    protected $last_name = '';
    protected $gender = 0;
    protected $nationality = '';
    protected $phone = '';
    protected $fax_no = '';
    protected $office_no = '';
    protected $address = '';
    protected $token = '';
    protected $about_me = '';
    protected $theme = null;
    protected $theme_fixed_navbar = 0;
    protected $theme_fixed_menu = 0;
    protected $theme_flip_menu = 0;
    protected $theme_horizontal_menu = 0;

    const USER_FACULTY = Orm_User_Faculty::class;
    const USER_STAFF = Orm_User_Staff::class;
    const USER_STUDENT = Orm_User_Student::class;
    const USER_ALUMNI = Orm_User_Alumni::class;
    const USER_EMPLOYER = Orm_User_Employer::class;

    const GENDER_MALE = 0;
    const GENDER_FEMALE = 1;
    const GENDER_NOT_SPECIFIED = -1;

    public static $gender_list = array(
        self::GENDER_MALE => 'Male',
        self::GENDER_FEMALE => 'Female'
    );

    private $user_object_fields = array();

    protected function get_user_object_fields() {
        return $this->user_object_fields;
    }

    protected function add_user_object_fields($field_name, $field_value) {
        if($this->$field_name != $field_value) {
            $this->user_object_fields[$field_name] = $field_value;
        }
    }

    protected function reset_user_object_fields() {
        $this->user_object_fields = array();
    }

    protected function reset_object_fields($reset_user = true) {
        if($reset_user) {
            $this->reset_user_object_fields();
        }
        parent::reset_object_fields();
    }

    /**
     * @return User_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('User_Model', 'user');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_User
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
     * get all Objects
     *
     * @param array $filters
     * @param int $page
     * @param int $per_page
     * @param array $orders
     *
     * @return Orm_User[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array())
    {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_User
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_User_Default();
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
        $db_params['class_type'] = $this->get_class_type();
        $db_params['login_id'] = $this->get_login_id();
        $db_params['integration_id'] = $this->get_integration_id();
        $db_params['email'] = $this->get_email();
        $db_params['password'] = $this->get_password();
        $db_params['birth_date'] = $this->get_birth_date();
        $db_params['last_login'] = $this->get_last_login();
        $db_params['is_active'] = $this->get_is_active();
        $db_params['avatar'] = $this->get_avatar();
        $db_params['first_name'] = $this->get_first_name();
        $db_params['last_name'] = $this->get_last_name();
        $db_params['gender'] = $this->get_gender();
        $db_params['nationality'] = $this->get_nationality();
        $db_params['phone'] = $this->get_phone();
        $db_params['fax_no'] = $this->get_fax_no();
        $db_params['office_no'] = $this->get_office_no();
        $db_params['address'] = $this->get_address();
        $db_params['token'] = $this->get_token();
        $db_params['about_me'] = $this->get_about_me();
        $db_params['theme'] = $this->get_theme();
        $db_params['theme_fixed_navbar'] = $this->get_theme_fixed_navbar();
        $db_params['theme_fixed_menu'] = $this->get_theme_fixed_menu();
        $db_params['theme_flip_menu'] = $this->get_theme_flip_menu();

        return $db_params;
    }

    public function save() {
        if ($this->get_object_status() == 'new') {
            $insert_id = self::get_model()->insert($this->to_array());
            $this->set_id($insert_id);
        } elseif($this->get_object_fields()) {
            self::get_model()->update($this->get_id(), $this->get_object_fields());
        }

        $this->set_object_status('saved');
        $this->reset_object_fields(false);
        return $this->get_id();
    }

    public function delete()
    {
        $this->reset_object_fields();
        $this->set_is_active(0);
        $this->save();
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

    public function set_class_type($value)
    {
        $this->add_object_field('class_type', $value);
        $this->class_type = $value;
    }

    public function get_class_type()
    {
        return $this->class_type;
    }

    public function get_type_name()
    {
        return str_replace('Orm_User_', '', $this->get_class_type());
    }

    public function set_login_id($value)
    {
        $this->add_object_field('login_id', $value);
        $this->login_id = $value;
    }

    public function get_login_id()
    {
        return $this->login_id;
    }

    public function set_integration_id($value)
    {
        $this->add_object_field('integration_id', $value);
        $this->integration_id = $value;
    }

    public function get_integration_id()
    {
        return $this->integration_id;
    }

    public function set_email($value)
    {
        $this->add_object_field('email', $value);
        $this->email = $value;
    }

    public function get_email()
    {
        return $this->email;
    }

    public function set_password($value)
    {
        $this->add_object_field('password', $value);
        $this->password = $value;
    }

    public function get_password()
    {
        return $this->password;
    }

    public function set_birth_date($value)
    {
        if (empty($value)) { $value = '0000-00-00'; }

        $this->add_object_field('birth_date', $value);
        $this->birth_date = $value;
    }

    public function get_birth_date()
    {
        return $this->birth_date;
    }

    public function set_last_login($value)
    {
        $this->add_object_field('last_login', $value);
        $this->last_login = $value;
    }

    public function get_last_login()
    {
        return $this->last_login;
    }

    public function set_is_active($value)
    {
        $this->add_object_field('is_active', $value);
        $this->is_active = $value;
    }

    public function get_is_active()
    {
        return $this->is_active;
    }

    public function set_avatar($value)
    {
        $this->add_object_field('avatar', $value);
        $this->avatar = $value;
    }

    public function get_avatar()
    {
        $avatar = $this->avatar;
        if (!$avatar || !file_exists(rtrim(FCPATH, '/') . $avatar)) {
            $avatar = '/assets/jadeer/img/avatar.png';
        }
        return $avatar;
    }

    public function set_first_name($value)
    {
        $this->add_object_field('first_name', $value);
        $this->first_name = $value;
    }

    public function get_first_name()
    {
        return $this->first_name;
    }

    public function set_last_name($value)
    {
        $this->add_object_field('last_name', $value);
        $this->last_name = $value;
    }

    public function get_last_name()
    {
        return $this->last_name;
    }

    public function set_gender($value)
    {
        $this->add_object_field('gender', $value);
        $this->gender = $value;
    }

    public function get_gender($to_string = false)
    {

        if ($to_string) {
            return (isset(self::$gender_list[$this->gender]) ? self::$gender_list[$this->gender] : '');
        }

        return $this->gender;
    }

    public function set_nationality($value)
    {
        $this->add_object_field('nationality', $value);
        $this->nationality = $value;
    }

    public function get_nationality()
    {
        return $this->nationality;
    }

    public function set_phone($value)
    {
        $this->add_object_field('phone', $value);
        $this->phone = $value;
    }

    public function get_phone()
    {
        return $this->phone;
    }

    public function set_fax_no($value)
    {
        $this->add_object_field('fax_no', $value);
        $this->fax_no = $value;
    }

    public function get_fax_no()
    {
        return $this->fax_no;
    }

    public function set_office_no($value)
    {
        $this->add_object_field('office_no', $value);
        $this->office_no = $value;
    }

    public function get_office_no()
    {
        return $this->office_no;
    }

    public function set_address($value)
    {
        $this->add_object_field('address', $value);
        $this->address = $value;
    }

    public function get_address()
    {
        return $this->address;
    }

    public function set_token($value)
    {
        $this->add_object_field('token', $value);
        $this->token = $value;
    }

    public function get_token()
    {
        return $this->token;
    }

    public function set_about_me($value)
    {
        $this->add_object_field('about_me', $value);
        $this->about_me = $value;
    }

    public function get_about_me()
    {
        return $this->about_me;
    }
    public function set_theme($value)
    {
        $this->add_object_field('theme', $value);
        $this->theme = $value;
    }

    public function get_theme()
    {

        if(is_null($this->theme)) {
            $this->theme = Orm::get_ci()->config->item('default_theme');
        }

        return $this->theme;
    }

    public function set_theme_fixed_navbar($value)
    {
        $this->add_object_field('theme_fixed_navbar', $value);
        $this->theme_fixed_navbar = $value;
    }

    public function get_theme_fixed_navbar()
    {
        return $this->theme_fixed_navbar;
    }

    public function set_theme_fixed_menu($value)
    {
        $this->add_object_field('theme_fixed_menu', $value);
        $this->theme_fixed_menu = $value;
    }

    public function get_theme_fixed_menu()
    {
        return $this->theme_fixed_menu;
    }

    public function set_theme_flip_menu($value)
    {
        $this->add_object_field('theme_flip_menu', $value);
        $this->theme_flip_menu = $value;
    }

    public function get_theme_flip_menu()
    {
        return $this->theme_flip_menu;
    }

    public function set_theme_horizontal_menu($value)
    {
        $this->add_object_field('theme_horizontal_menu', $value);
        $this->theme_horizontal_menu = $value;
    }

    public function get_theme_horizontal_menu()
    {
        return $this->theme_horizontal_menu;
    }

    public static function get_user_data($data)
    {

        if (empty($data['id']) || empty($data['class_type'])) {
            return $data;
        }

        $class_name = $data['class_type']; /** @var $class_name Orm_User */

        if (!class_exists($class_name)) {
            show_error("Class does not exist: {$class_name}");
        }

        $user_data = $class_name::get_model()->get_by_user_id($data['id']);

        if ($user_data && is_array($user_data)) {
            $data += $user_data;
        }

        return $data;
    }

    /**
     * @param $email
     * @return mixed|Orm_User
     */
    public static function get_by_email($email)
    {
        return static::get_one(array('email' => $email));
    }

    /**
     * @param $login_id
     * @return mixed|Orm_User
     */
    public static function get_by_login_id($login_id)
    {
        return static::get_one(array('login_id' => $login_id));
    }

    public static function is_logged_in()
    {
        if (!is_null(self::get_logged_user())) {
            return true;
        }
        return false;
    }

    public static function check_logged_in()
    {
        if(!Orm_Institution::is_insert_institution()) {
            Validator::set_error_flash_message(lang('You Have to fill all your institution information before start work'));
        }

        if (!self::is_logged_in()) {

            if (self::get_logged_user() && !self::get_logged_user()->get_is_active()) {
                Validator::set_error_flash_message(lang("Error: You are not Active"));
                self::get_logged_user()->logout();
            }

            $go_to = Orm::get_ci()->input->server('REQUEST_URI');
            Orm::get_ci()->session->set_userdata('go_to', $go_to);

            redirect('/welcome/login');
        }
    }

    public function login()
    {
        Orm::get_ci()->session->set_userdata('user_id', $this->get_id());

        $this->set_last_login(date('Y-m-d H:i:s'));
        $this->save();
    }

    public function logout()
    {
        Orm::get_ci()->session->unset_userdata('user_id');
        Orm::get_ci()->session->sess_destroy();
    }

    public static function get_logged_user_id()
    {
        $user_id = Orm::get_ci()->session->userdata('user_id');

        if (is_cli() && !$user_id) {
            $user_id = Orm::get_ci()->config->item('cli_user_id');
        }

        return $user_id;
    }

    /**
     * @return Orm_User | Orm_User_Faculty | Orm_User_Staff | Orm_User_Student | Orm_User_Alumni | Orm_User_Employer
     */
    public static function get_logged_user()
    {
        $user_id = self::get_logged_user_id();
        if ($user_id) {
            $user = self::get_instance($user_id);

            if ($user && $user->get_id()) {
                return $user;
            }
        }

        return null;
    }

    public static function has_role_teacher()
    {
        if (self::get_logged_user() instanceof Orm_User_Faculty) {
            return true;
        }
        return false;
    }

    public static function get_institution_role()
    {
        if (self::check_credential(array(self::USER_STAFF, self::USER_FACULTY))) {
            return self::get_logged_user()->get_role_obj()->get_admin_level();
        }

        return null;
    }

    public static function has_role_type($role_inst = Orm_Role::ROLE_NOT_ADMIN)
    {
        if (self::get_institution_role() == $role_inst) {
            return true;
        }
        return false;
    }

    public function get_full_name($escape = false)
    {
        $full_name = $this->get_first_name() . ' ' . $this->get_last_name();
        if ($escape) {
            $full_name = addslashes($full_name);
        }
        return $full_name;
    }

    private static $user_credentials = array();

    private static function get_user_credentials()
    {

        $logged_user = self::get_logged_user();

        switch ($logged_user->get_class_type()) {
            case self::USER_STAFF :
            case self::USER_FACULTY :

                self::$user_credentials = $logged_user->get_role_obj()->get_credential();

                break;
        }
        return self::$user_credentials;
    }

    public static function check_permission($user_types = array(), $only_type = true, $credential = '')
    {
        if (!self::check_credential($user_types, $only_type, $credential)) {
            Validator::set_error_flash_message(lang('Permissions Denied'));
            redirect(Orm::get_ci()->config->item('root_url'));
        }
    }

    public static function check_permission_or($user_types = array(), $only_type = true, $credentials = array())
    {
        if (!self::check_credential_or($user_types, $only_type, $credentials)) {
            Validator::set_error_flash_message(lang('Permissions Denied'));
            redirect(Orm::get_ci()->config->item('root_url'));
        }
    }

    public static function check_credential($user_types = array(), $only_type = true, $credential = '')
    {
        if (in_array(self::get_logged_user()->get_class_type(), $user_types)) {

            if ($only_type) {
                return true;
            } else {
                $user_credentials = self::get_user_credentials();
                if (in_array($credential, $user_credentials)) {
                    return true;
                }
            }
        }

        return false;
    }

    public static function check_credential_or($user_types = array(), $only_type = true, $credentials = array())
    {
        if (in_array(self::get_logged_user()->get_class_type(), $user_types)) {

            if ($only_type) {
                return true;
            } else {
                $user_credentials = self::get_user_credentials();
                if (array_intersect($credentials, $user_credentials)) {
                    return true;
                }
            }
        }

        return false;
    }

    public function draw_form()
    {
        $type = str_replace('orm_', '', strtolower($this->get_class_type()));
        return Orm::get_ci()->load->view("user/type/{$type}", array('user' => $this), true);
    }

    public function draw_demographics($draw_general_info = true)
    {

        $html = '';

        if($draw_general_info) {
            $html .= '<div class="row">';
            $html .= '<label class="col-sm-3">' . lang('Name') . '</label>';
            $html .= '<div class="col-sm-9">';
            $html .= htmlfilter($this->get_full_name() ?: '----');
            $html .= '</div>';
            $html .= '</div>';

            $html .= '<div class="row">';
            $html .= '<label class="col-sm-3">' . lang('Gender') . '</label>';
            $html .= '<div class="col-sm-9">';
            $html .= htmlfilter(lang($this->get_gender(true)));
            $html .= '</div>';
            $html .= '</div>';
        }

        return $html;
    }
 public static function draw_filters()
    {

        $fltr = Orm::get_ci()->input->get_post('fltr');
        $html = '';
        $html .= '<div class="form-group">';
        $html .= '<label class="col-sm-3">' . lang('Gender') . '</label>';
        $html .= '<div class="col-sm-9">';
        $html .= '<input type="checkbox" style="display: none"'.(isset($fltr['gender']) && 0 == $fltr['gender']  ? 'selected="selected"' : '').' name="fltr[gender]" value="0">';
        $html .= '<input type="checkbox" style="display: none"'.(isset($fltr['gender']) && 1 == $fltr['gender']  ? 'selected="selected"' : '').' name="fltr[gender]" value="1">';
        $html .= '<select id="gender_select" class="form-control">';
        $html .= '<option value="-1">' . lang('All Gender') . '</option>';

        foreach (self::$gender_list as $key => $gender) {
            $selected = (isset($fltr['gender']) && $key == $fltr['gender'] && $key != -1 ? 'selected="selected"' : '');
            $html .= '<option value="' . $key . '" ' . $selected . '>' .htmlfilter(lang($gender)) .'</option>';
        }
        $html .= '</select>';
        $html .= <<<HTML
        <script>
        $('#gender_select').change(function(){
            
            $('input[name="fltr[gender]"]').each(function(){ 
                $(this).prop('checked', false); 
            });
            
            
            $('input[name="fltr[gender]"][value="'+ $(this).val() +'"]').prop('checked', true);
        });
        
</script>
HTML;
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    public static function draw_common_filters()
    {

        $fltr = Orm::get_ci()->input->get_post('fltr');

        $html = '<div class="form-group">';
        $html .= '<label class="col-sm-3">' . lang('Keyword') . '</label>';
        $html .= '<div class="col-sm-9">';
        $html .= '<input type="text" name="fltr[keyword]" class="form-control" value="' . (isset($fltr['keyword']) ? $fltr['keyword'] : '') . '" />';
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    public static function draw_structure_filters($enable_course_level = false,$semester=false)
    {

        $user_filter = array();
        Orm_User::get_logged_user()->get_filters($user_filter);
        $fltr = array_merge($user_filter,(array)Orm::get_ci()->input->get_post('fltr'));

        switch (Orm_User::get_logged_user()->get_institution_role()) {
            case Orm_Role::ROLE_INSTITUTION_ADMIN:
                $campus_read_only = '';
                $college_read_only = '';
                $department_read_only = '';
                $program_read_only = '';
                break;
            case Orm_Role::ROLE_COLLEGE_ADMIN:
                $campus_read_only = 'disabled="disabled"';
                $college_read_only = 'disabled="disabled"';
                $department_read_only = '';
                $program_read_only = '';
                break;
            case Orm_Role::ROLE_DEPARTMENT_ADMIN:
                $campus_read_only = 'disabled="disabled"';
                $college_read_only = 'disabled="disabled"';
                $department_read_only = 'disabled="disabled"';
                $program_read_only = '';
                break;
            case Orm_Role::ROLE_PROGRAM_ADMIN:
                $campus_read_only = 'disabled="disabled"';
                $college_read_only = 'disabled="disabled"';
                $department_read_only = 'disabled="disabled"';
                $program_read_only = 'disabled="disabled"';
                break;
            default:
                $campus_read_only = 'disabled="disabled"';
                $college_read_only = 'disabled="disabled"';
                $department_read_only = 'disabled="disabled"';
                $program_read_only = 'disabled="disabled"';
                break;
        }

        $html = '';

        $show_cumpus_filter = !in_array(static::class, [Orm_User_Alumni::class, Orm_User_Employer::class]);


        //All Semester
        if($semester) {
            $semester_list = Orm_Semester::get_all();
            $html .= '<div class="form-group">';
            $html .= '<label for="program_block" class="col-sm-3 ">' . lang('semester') . '</label>';
            $html .= '<div class="col-sm-9">';
            $html .= '<select id="semester_block"  name="fltr[semesters_id]" class="form-control" ' . '>';
            $html .= '<option value="">' . lang('All semester') . '</option>';

            foreach ($semester_list as $semesters) {
                $selected = (isset($fltr['semester_id']) && $semesters->get_id() == $fltr['semester_id'] ? 'selected="selected"' : '');
                $html .= '<option value="' . $semesters->get_id() . '" ' . $selected . '>' . htmlfilter($semesters->get_name()) . '</option>';
            }
            $html .= '</select>';
            $html .= '<input type="hidden" name="fltr[semester_id]" value="' . (isset($fltr['semester_id']) ? $fltr['semester_id'] : '') . '">';

            $html .= '</div>';
            $html .= '</div>';


        }


        $college_list = array();
        if($show_cumpus_filter) {
            //All Campus
            $html .= '<style>
    .select2-container {
        z-index: 9999;
    }
</style>';
            $html .= '<div class="form-group">';
            $html .= '<label for="campus_block" class="col-sm-3">' . lang('Campus') . '</label>';
            $html .= '<div class="col-sm-9">';
            $html .= '<select id="campus_block" '.$campus_read_only.' name="fltr[campus_in][]" class="form-control" onchange="get_colleges_by_campus(this, 1, 1); $(\'#college_block\').html(\'<option value>' . lang('All College') . '</option>\'); $(\'#department_block\').html(\'<option value>' . lang('All Department') . '</option>\'); $(\'#program_block\').html(\'<option value>' . lang('All Program') . '</option>\');"  multiple="multiple">';
            $html .= '<script> $(document).ready(function() {
                 $("select[multiple=multiple]").select2();
            }); </script>';
            //$html .= '<option value="">' . lang('All Campus') . '</option>';

            foreach (Orm_Campus::get_all() as $campus) {
                // Edited by shamaseen
                $selected = (isset($fltr['campus_in']) &&  in_array($campus->get_id(),(array) $fltr['campus_in'])  ? 'selected="selected"' : '');
                $html .= '<option value="' . $campus->get_id() . '" ' . $selected . '>' . htmlfilter($campus->get_name()) . '</option>';
            }

            $html .= '</select>';
            if($campus_read_only) {
                $html .= '<input type="hidden" name="fltr[campus_in]" value="' . (isset($fltr['campus_in']) ? $fltr['campus_in'] : '') . '">';
            }
            $html .= '</div>';
            $html .= '</div>';

            if (!empty($fltr['campus_id'])) {
                $college_list = Orm_College::get_all(array('campus_id' => $fltr['campus_id']));
            }
            if (!empty($fltr['campus_in'])) {
                // Edited by shamaseen
                //$college_list = Orm_College::get_all(array('campus_id' => $fltr['campus_id']));
                $college_list = Orm_College::get_all(array('campus_in' => $fltr['campus_in']));
            }

        } else {
            $college_list = Orm_College::get_all();
        }

        //All College
        $html .= '<div class="form-group">';
        $html .= '<label for="college_block" class="col-sm-3">' . lang('College') . '</label>';
        $html .= '<div class="col-sm-9">';
        $html .= '<select id="college_block" '.$college_read_only.' name="fltr[college_id]" class="form-control" onchange="get_departments_by_college(this, 1, 1); $(\'#department_block\').html(\'<option value>' . lang('All Department') . '</option>\'); $(\'#program_block\').html(\'<option value>' . lang('All Program') . '</option>\');">';
        $html .= '<option value="">' . lang('All College') . '</option>';
        if ($college_list) {
            foreach ($college_list as $college) {
                $selected = (isset($fltr['college_id']) && $college->get_id() == $fltr['college_id'] ? 'selected="selected"' : '');
                $html .= '<option value="' . $college->get_id() . '" ' . $selected . '>' . htmlfilter($college->get_name()) . '</option>';
            }
        }
        $html .= '</select>';
        if($college_read_only) {
            $html .= '<input type="hidden" name="fltr[college_id]" value="' . (isset($fltr['college_id']) ? $fltr['college_id'] : '') . '">';
        }
        $html .= '</div>';
        $html .= '</div>';

        //All Department
        $html .= '<div class="form-group">';
        $html .= '<label for="department_block" class="col-sm-3 ">' . lang('Department') . '</label>';
        $html .= '<div class="col-sm-9">';
        $html .= '<select id="department_block" '. $department_read_only .'  name="fltr[department_id]" class="form-control" onchange="get_programs_by_department(this, 1, 1); $(\'#program_block\').html(\'<option value>' . lang('All Program') . '</option>\');">';
        $html .= '<option value="">' . lang('All Department') . '</option>';
        if (!empty($fltr['college_id'])) {
            foreach (Orm_Department::get_all(array('college_id' => $fltr['college_id'])) as $department) {
                $selected = (isset($fltr['department_id']) && $department->get_id() == $fltr['department_id'] ? 'selected="selected"' : '');
                $html .= '<option value="' . $department->get_id() . '" ' . $selected . '>' . htmlfilter($department->get_name()) . '</option>';
            }
        }
        $html .= '</select>';
        if($department_read_only) {
            $html .= '<input type="hidden" name="fltr[department_id]" value="' . (isset($fltr['department_id']) ? $fltr['department_id'] : '') . '">';
        }
        $html .= '</div>';
        $html .= '</div>';

        $course_level = $enable_course_level ? 'onchange="get_courses_by_program(this, 0, 1);"' : '';

        //All Program
        $html .= '<div class="form-group">';
        $html .= '<label for="program_block" class="col-sm-3 ">' . lang('Program') . '</label>';
        $html .= '<div class="col-sm-9">';
        $html .= '<select id="program_block" '. $program_read_only .' name="fltr[program_id]" class="form-control" ' . $course_level . '>';
        $html .= '<option value="">' . lang('All Program') . '</option>';
        if (!empty($fltr['department_id'])) {
            foreach (Orm_Program::get_all(array('department_id' => $fltr['department_id'])) as $program) {
                $selected = (isset($fltr['program_id']) && $program->get_id() == $fltr['program_id'] ? 'selected="selected"' : '');
                $html .= '<option value="' . $program->get_id() . '" ' . $selected . '>' . htmlfilter($program->get_name()) . '</option>';
            }
        }
        $html .= '</select>';
        if($program_read_only) {
            $html .= '<input type="hidden" name="fltr[program_id]" value="' . (isset($fltr['program_id']) ? $fltr['program_id'] : '') . '">';
        }
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    /**
     * @param $role_level
     * @param array $filters
     * @return array|int|Orm_User_Faculty[]|Orm_User_Staff[]
     */
    public static function get_user_by_role($role_level, $filters = array())
    {

        $filters['role_in'] = Orm_Role::get_role_ids_by_level($role_level);

        $users = array();
        $users += Orm_User_Faculty::get_all($filters);
        $users += Orm_User_Staff::get_all($filters);

        return $users;
    }

    public static function get_user_ids_by_role($role_level, $filters = array())
    {

        $filters['role_in'] = Orm_Role::get_role_ids_by_level($role_level);

        $user_ids = array();
        $user_ids += array_column(Orm_User_Faculty::get_model()->get_all($filters,0,0,array(),Orm::FETCH_ARRAY), 'id');
        $user_ids += array_column(Orm_User_Staff::get_model()->get_all($filters,0,0,array(),Orm::FETCH_ARRAY), 'id');

        return $user_ids;
    }

    public function get_array_filter()
    {
        if (self::get_logged_user()->get_role_obj()->get_admin_level() == Orm_Role::ROLE_PROGRAM_ADMIN) {
            $filters['program_id'] = self::get_logged_user()->get_program_id();
            $filters['college_id'] = self::get_logged_user()->get_college_id();
        } elseif (self::get_logged_user()->get_role_obj()->get_admin_level() == Orm_Role::ROLE_COLLEGE_ADMIN) {
            $filters['college_id'] = self::get_logged_user()->get_college_id();
        } else {
            $filters = array();
        }
        return $filters;
    }

    /**
     * @return Orm_Role
     */
    public function get_role_obj()
    {
        return new Orm_Role();
    }

    public static function get_all_admins() {
        $role_ids = array_column(Orm_Role::get_model()->get_all(array('not_admin_level' => Orm_Role::ROLE_NOT_ADMIN) ,0 ,0 ,array() ,Orm::FETCH_ARRAY),'id');

        $users = Orm_User_Faculty::get_all(array('role_in' => $role_ids));
        $users += Orm_User_Staff::get_all(array('role_in' => $role_ids));

        return $users;
    }

    public function draw_compose_link($template_name = null, $container = 'div')
    {
        $ci = get_instance();
        $ci->layout->render_javascript('/assets/jadeer/js/tinymce/tinymce.min.js');

        $link = "/thread/compose/{$this->get_id()}";

        if(!is_null($template_name)) {
            $link .= "/{$template_name}";
        }

        $html = '<a class="link" data-toggle="ajaxModal" href="' . $link . '">';
        $html .= '<i class="fa fa-user"></i> &ensp;' . htmlfilter(ucwords($this->get_full_name()));
        $html .= '</a>';

        if($container) {
            $html = "<{$container}>{$html}</{$container}>";
        }

        return $html;
    }

    public function get_filters(&$filters) {
        $user = Orm_User::get_logged_user();

        $campus_ids = $user->get_college_obj()->get_campus_ids();
        $campus_id = intval(isset($campus_ids[0]) ? $campus_ids[0] : 0);

        switch ($user->get_institution_role()) {
            case Orm_Role::ROLE_INSTITUTION_ADMIN:
                break;

            case Orm_Role::ROLE_COLLEGE_ADMIN:
                $filters['campus_in'] = $campus_id;
                $filters['college_id'] = intval($user->get_college_id());
                break;

            case Orm_Role::ROLE_DEPARTMENT_ADMIN:
                $filters['campus_in'] = $campus_id;
                $filters['college_id'] = intval($user->get_college_id());
                $filters['department_id'] = intval($user->get_department_id());
                break;

            case Orm_Role::ROLE_PROGRAM_ADMIN:
                $filters['campus_in'] = $campus_id;
                $filters['college_id'] = intval($user->get_college_id());
                $filters['department_id'] = intval($user->get_department_id());
                $filters['program_id'] = intval($user->get_program_id());
                break;

            default:
                $filters['campus_in'] = $campus_id;
                $filters['college_id'] = intval($user->get_college_id());
                $filters['department_id'] = intval($user->get_department_id());
                $filters['program_id'] = intval($user->get_program_id());
                break;
        }
    }

    public function get_unit_id() {
        return 0;
    }

    public function get_college_id() {
        return 0;
    }

    public function get_program_id() {
        return 0;
    }

    public static function draw_find_users($input_name = 'user_id', $input_value = null, $label = null, $allowed_types = null, $role = null) {

        $id = Orm::get_ci()->input->get_post(preg_replace('/\[(.*)\]/', '', $input_name));

        if($id && is_array($id)) {

            preg_match('/\[(.*)\]/', $input_name, $matches);

            if($matches) {
                $id = isset($id[$matches[1]]) ? $id[$matches[1]] : 0;
            }

        }

        $user_id = '';
        $user_name = '';

        if(intval($id) || !is_null($input_value)) {

            $id = intval($id ?: $input_value);

            $user = self::get_instance($id);
            if($user && $user->get_id()) {
                $user_id = intval($user->get_id());
                $user_name = htmlfilter($user->get_full_name());
            }
        }

        if(!is_null($label)) {
            $label = "<label class='control-label'>{$label}</label>";
        }

        if(is_null($allowed_types)) {
            $allowed_types = [];
        }

        $allowed_types = json_encode($allowed_types);

        $uniqid = uniqid();

        $validator = Validator::get_html_error_message($input_name);

        return <<<HTML
            <div class='form-group'>
                {$label}
                <input id='name_{$uniqid}' value='{$user_name}' onclick='find_users(this, "id_{$uniqid}", "name_{$uniqid}", "{$role}", {$allowed_types})' readonly class='form-control' type='text' />
                <input id='id_{$uniqid}' value='{$user_id}' name='{$input_name}' type='hidden' />
                {$validator}
            </div>
HTML;

    }

    public function fill_post_object() {
        //DO Nothing
    }

    public function activate()
    {
        $this->reset_object_fields();
        $this->set_is_active(1);
        $this->save();
    }

}

