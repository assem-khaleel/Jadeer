<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 23/10/17
 * Time: 13:30
 */

class Orm_Rb_Rubrics_User extends Orm_Rb_Rubrics {

    /**
     * @return bool
     */
    public static function is_valid() {
        $user_id = intval(self::get_ci()->input->get_post('extra_value'));

        Validator::less_than_validator('extra_value', $user_id, 1, lang('You have to select user'));

        return Validator::success();
    }

    /**
     * this function get properties by its error and value
     * @param string $error the error of the get properties to be call function
     * @param string $value the value of the get properties to be call function
     * @return string the html call function
     */
    public static function get_properties($error ='', $value='') {
        $select_user = lang('Select User');
        if(!empty($value)){
            $name = Orm_User::get_instance($value)->get_full_name();
        }else{
            $name='';
        }


        $staff = Orm_User::USER_STAFF;
        $faculty = Orm_User::USER_FACULTY;

        return <<<HTML
                <div class="form-group">
                    <label class="control-label" for="service_desc">$select_user</label>
                    <input id="user_label" type="text" onclick="find_users(this,'user_id','user_label', '', ['$staff', '$faculty'])"
                           readonly class="form-control" value="$name" />
                    <input id="user_id" name="extra_value" type="hidden" value="$value" />
                    $error
                </div>
HTML;
    }

    /**
     * this function draw
     * @return string the html call function
     */
    public function draw()
    {
        $title = lang('user');
        $value = Orm_User::get_instance($this->get_extra_data())->get_full_name();

        return <<<HTML
        <div class="form-group">
            <label class="control-label"> $title </label>
            <label class="form-control">$value</label>
        </div>
HTML;
    }
    /**
     * this function set evaluation by its view params
     * @param array $view_params the view params of the set evaluation to be call function
     * @return string the call function
     */
    public function set_evaluation($view_params)
    {

        $users = (array) $this->get_ci()->input->post('users');

        Validator::required_array_validator('users_ids',$users, lang('This field is required'));


        foreach ($users as $key=>$user){
            if(!Orm_User::get_instance($users)->get_id()) {
                Validator::set_error('users', lang('This field is required'), $key);
            }
        }

        if(Validator::success()) {
            $evaluation = Orm_Rb_Evaluations::get_one(['rubrics_id'=>$this->get_id()]);

            $evaluation->set_rubrics_id($this->get_id());
            $evaluation->set_criteria(json_encode($users));

            if($evaluation->get_id()) {
                $evaluation->set_date_added(date('Y-m-d'));
            }

            $evaluation->save();

            json_response(['success'=>true]);
        }

        $view_params['rubric'] = $this;

        json_response(['success' => false, 'html' => $this->load->view('publish', $this->view_params, true)]);


        return $this->get_ci()->load->view('invitation/user', $view_params, true);
    }
    /**
     * this function get invitation form by its view params
     * @param array $view_params the view params of the get invitation form to be call function
     * @return object|string the call function
     */
       public function get_invitation_form($view_params)
    {
        $view_params['rubric'] = $this;
        return $this->get_ci()->load->view('invitation/user', $view_params, true);

    }
    /**
     * this function check invitation
     * @return bool the call function
     */
    public function check_invitation()
    {
        foreach (Orm_Rb_Evaluations::get_all(['rubrics_id' => $this->get_id()]) as $evaluation){
            $criteria = json_decode($evaluation->get_criteria(), 1);

            if(in_array(Orm_User::get_logged_user_id(), $criteria)){
                return true;
            }
        }

        return false;
    }

    /**
     * this function answer draw
     * @return string the html call function
     */
    public function answer_draw()
    {
        $title = lang('Evaluate User');
        $value = Orm_User::get_instance($this->get_extra_data())->get_full_name();
        $input_value = $this->get_extra_data();
        $error = Validator::get_html_error_message('user_id');

        return <<<HTML
        <div class="form-group">
            <label class="control-label"> $title: </label>
            <label class="form-control">$value</label>
            <input type="hidden" name="user_id" value="$input_value" />
            $error
        </div>
HTML;
    }

}