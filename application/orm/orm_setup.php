<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 1/5/17
 * Time: 3:21 PM
 */
class Orm_Setup extends Orm {

    private static $setup = null;

    private $object = null;
    private $can_access_setup = false;

    /**
     * Orm_Setup constructor.
     */
    public function __construct()
    {

        /** @var $object Orm_Institution | Orm_Unit | Orm_College | Orm_Program */

        switch (Orm_User::get_logged_user()->get_institution_role()) {
            case Orm_Role::ROLE_INSTITUTION_ADMIN:
                $this->object = Orm_Institution::get_instance();
                break;

            case Orm_Role::ROLE_COLLEGE_ADMIN:
                $collegeId = Orm_User::get_logged_user()->get_college_id();
                $this->object = Orm_College::get_instance($collegeId);
                break;

            case Orm_Role::ROLE_PROGRAM_ADMIN:
                $programId = Orm_User::get_logged_user()->get_program_id();
                $this->object = Orm_Program::get_instance($programId);
                break;

            default:

                $logged_user = Orm_User::get_logged_user();

                if($logged_user->get_program_id()) {
                    $this->object = $logged_user->get_program_obj();
                } elseif($logged_user->get_college_id()) {
                    $this->object = $logged_user->get_college_obj();
                } elseif($logged_user->get_unit_id()) {
                    $this->object = $logged_user->get_unit_obj();
                } else {
                    $this->object = Orm_Institution::get_instance();
                }

                break;
        }

        if(!is_null($this->object)){
            $this->can_access_setup = true;
        }

    }

    public static function get_instance() {

        if(is_null(self::$setup)) {
            self::$setup = new self();
        }

        return self::$setup;
    }

    /**
     * @return Orm_Institution | Orm_Unit | Orm_College | Orm_Program
     */
    public function get_object() {
        return $this->object;
    }

    public function get_can_access_setup() {
        return $this->can_access_setup;
    }

    public static function check_can_access_setup() {
        return self::get_instance()->get_can_access_setup();
    }

}