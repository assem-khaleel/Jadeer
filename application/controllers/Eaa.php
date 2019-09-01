<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Breadcrumbs $breadcrumbs
 * @property CI_Config $config
 * @property CI_Input $input
 * @property CI_Session $session
 * @property Layout $layout
 * Class College
 */
class Eaa extends CI_Controller
{
    /**
     * View Params
     * @var array
     */
    private $view_params = array();
    private $user = 'admin';
    private $password = 'EAA-jfsSXgWYyGb2=wZv';

    public function __construct()
    {
        parent::__construct();

        Orm_User::check_logged_in();


        $wk_options = $this->config->item('wk_pdf_options');
        $wk_binary = isset($wk_options['binary']) ? $wk_options['binary'] : '/usr/local/bin/wkhtmltopdf';

        $this->view_params['server_requirements'] = [
            'PHP Settings' => [
                'PHP Version' => array(
                    'required_settings' => '5.6',
                    'required' => ">= floatval(5.6)",
                    'how' => 'floatval(substr(phpversion(),0,3))'
                ),
                'Register Globals' => array(
                    'required_settings' => 'No',
                    'required' => '== false',
                    'how' => "ini_get('register_globals')"
                ),
                'File Uploads' => array(
                    'required_settings' => 'Yes',
                    'required' => '== true',
                    'how' => "boolval(ini_get('file_uploads'))"
                ),
                'Session Auto Start' => array(
                    'required_settings' => 'No',
                    'required' => '== false',
                    'how' => "ini_get('session_auto_start')"
                )
            ],
            'PHP Extensions' => [
                'ionCube Loader' => array(
                    'required_settings' => 'Yes',
                    'required' => '== true',
                    'how' => "extension_loaded('ionCube Loader')"
                ),
                'mysql' => array(
                    'required_settings' => 'Yes',
                    'required' => '== true',
                    'how' => "extension_loaded('mysqli')"
                ),
                'MySQL Backup' => array(
                    'required_settings' => 'Yes',
                    'required' => '== true',
                    'how' => "boolval(exec('which mysqldump'))"
                ),
                'fileinfo' => array(
                    'required_settings' => 'Yes',
                    'required' => '== true',
                    'how' => "extension_loaded('fileinfo')"
                ),
                'wkhtmltopdf' => array(
                    'required_settings' => 'Yes',
                    'required' => '== true',
                    'how' => "file_exists('{$wk_binary}')"
                ),
            ],
            'File Permissions' => array(
                'config' => array(
                    'required_settings' => 'Writable',
                    'required' => '== true',
                    'how' => "is_writable('{project_path}/application/config/config.php')"
                ),
                'database' => array(
                    'required_settings' => 'Writable',
                    'required' => '== true',
                    'how' => "is_writable('{project_path}/application/config/database.php')"
                )
            ),
            'Directory Permissions'=> array(
                'Language' => array(
                    'required_settings' => 'Writable',
                    'required' => '== true',
                    'how' => "is_writable('{project_path}/application/language')"
                ),
                'Files' => array(
                    'required_settings' => 'Writable',
                    'required' => '== true',
                    'how' => "is_writable('{project_path}/files')"
                ),
                'Backup Dir' => array(
                    'required_settings' => 'Writable',
                    'required' => '== true',
                    'how' => "is_writable('{project_path}/backup')"
                ),
            )
        ];
    }

    private function check_authenticate() {

        if (empty($this->session->userdata('eaa_admin'))) {
            return true;
        }
        return false;
    }

    public function authenticate() {

        if($this->input->method() === 'post') {

            $user = $this->input->post('user');
            $password = $this->input->post('password');

            if($user == $this->user && $password == $this->password) {
                $this->session->set_userdata('eaa_admin', true);
                redirect('/eaa');
            } else {
                Validator::set_error('user', 'Invalid User Name Or Password');
            }
        }

        $this->layout->view('/eaa/authenticate', $this->view_params);
    }

    public function logout() {
        $this->session->unset_userdata('eaa_admin');
        redirect('/eaa');
    }

    public function index()

    {
        if($this->check_authenticate()) {
            redirect('/eaa/authenticate');
        }

        $license = License::get_instance();

        $expiration = $license->get_expiration();
        $colleges = $license->get_colleges();
        $programs = $license->get_programs();
        $modules = $license->get_modules();
        $package = $license->get_package();

        $available_modules = $this->get_available_modules();

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $expiration = $this->input->post('expiration');
            $colleges = $this->input->post('colleges');
            $programs = $this->input->post('programs');
            $modules = $this->input->post('modules');
            $package = $this->input->post('package');

            if(!is_array($colleges)) {
                $colleges = array();
            }
            if(!is_array($programs)) {
                $programs = array();
            }
            if(!is_array($modules)) {
                $modules = array();
            }

            Validator::required_field_validator('expiration', $expiration, 'Required Field');
            Validator::required_field_validator('package', $package, 'Required Field');

            if($package != License::PACKAGE_ULTIMATE) {
                Validator::required_array_validator('colleges_programs', $colleges, 'Required Field');
                Validator::required_array_validator('colleges_programs', $programs, 'Required Field');
            }

            Validator::required_array_validator('modules', $modules, 'Required Field');

            if (Validator::success()) {

                $jwt = new Lcobucci\JWT\Builder();
                $signer = new Lcobucci\JWT\Signer\Hmac\Sha256();

                $jwt->set('colleges', $colleges);
                $jwt->set('programs', $programs);
                $jwt->set('modules', array_merge($available_modules, $modules));
                $jwt->set('package', $package);

                $jwt->setIssuer(base_url('eaa'));
                $jwt->setIssuedAt(time());
                $jwt->setExpiration(strtotime($expiration));
                $jwt->sign($signer, md5('EAA-License-jfsSXgWYyGb2=wZv'));

                file_put_contents(FCPATH . 'license_' . ENVIRONMENT . '.key',(string) $jwt->getToken());

                redirect('/eaa');
            }
        }

        $this->view_params['expiration'] = $expiration;
        $this->view_params['colleges'] = $colleges;
        $this->view_params['programs'] = $programs;
        $this->view_params['modules'] = $modules;
        $this->view_params['package'] = $package;
        $this->view_params['available_modules'] = $available_modules;

        $this->layout->view('/eaa/index', $this->view_params);
    }

    private function get_available_modules() {
        $available_modules = array();
        foreach (scandir(APPPATH . 'modules') as $module) {
            $matches = array();
            preg_match('/\./', $module, $matches);
            if ($matches) continue;
            $available_modules[$module] = false;
        }

        return $available_modules;
    }

}
