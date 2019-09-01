<?php

/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 4/4/16
 * Time: 10:48 AM
 */
class Authentication_Kau
{

    public static function before_login() {

        $login_id = Orm::get_ci()->input->server('username');

        if($login_id) {
            $user = Orm_user::get_by_login_id($login_id);

            if(!is_null($user) && $user->get_id() && $user->get_is_active()) {
                $user->login();


                $go_to = Orm::get_ci()->session->userdata('go_to');
                Orm::get_ci()->session->unset_userdata('go_to');

                $url = ($go_to ?: Orm::get_ci()->config->item('root_url'));

                redirect($url);

            }
            else {
                redirect("http://sso.kau.edu.sa/KAU_SSO_Services.aspx?err=21");
            }
        }

    }

    public static function after_login() {
        // Do thing
    }

    public static function logout() {
        redirect('https://iam.kau.edu.sa/secure/logout.html');
    }
}