<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Layout $layout
 * @property Breadcrumbs $breadcrumbs
 * @property CI_Config $config
 * Class Doc_repo
 */
class Doc_repo extends MX_Controller
{
    /**
     * View Params
     * @var array
     */
    private $view_params = array();

    public function __construct()
    {
        parent::__construct();

        Orm_User::check_logged_in();
        Orm_User::check_permission_or(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, ['doc_repo-manage', 'doc_repo-list', 'accreditation-list']);

        $this->layout->add_stylesheet('/assets/jadeer/js/jquery-ui-1.11.4/jquery-ui.min.css');
        $this->layout->add_javascript('/assets/jadeer/js/jquery-ui-1.11.4/jquery-ui.min.js');

        $this->layout->add_javascript('/assets/jadeer/js/jquery.cookie.js');

        $this->layout->add_javascript('/assets/jadeer/js/elFinder-2.1.1/js/elfinder.min.js');
        $this->layout->add_javascript('/assets/jadeer/js/elFinder-2.1.1/js/i18n/elfinder.ar.js');
        $this->layout->add_stylesheet('/assets/jadeer/js/elFinder-2.1.1/css/elfinder.full.css');

        $this->layout->set_layout('layout_blank');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Files Repository'),
            'icon' => 'fa fa-list-ol',
        ), true);
        $this->breadcrumbs->push(lang('File Repository'), '/file_manager');

        $this->view_params['menu_tab'] = 'doc_repo';
    }

    public function index() {
        show_404();
    }

    public function file_manager($type = 'default', $node_id = 0)
    {

        switch ($type) {
            case 'attachment_node':
                $this->view_params['node_id'] = $node_id;
                $this->view_params['property_id'] = $this->input->get('property_id');
                $this->layout->view('doc_repo/file_manager_attachment_node', $this->view_params);
                break;
            case 'attachment':
                $this->view_params['property_id'] = $this->input->get('property_id');
                $this->layout->view('doc_repo/file_manager_attachment', $this->view_params);
                break;
            case 'tinymce_node':
                $this->view_params['node_id'] = $node_id;
                $this->layout->view('doc_repo/file_manager_tinymce_node', $this->view_params);
                break;
            case 'tinymce':
                $this->layout->view('doc_repo/file_manager_tinymce', $this->view_params);
                break;
            default :
                $this->layout->set_layout('layout')->view('doc_repo/file_manager', $this->view_params);
                break;
        }
    }

    public function file_manager_connector($type = 'default', $node_id = 0)
    {

        $allow_doc_repo = true;
        $attributes = $default_attributes = array(
            array(
                'pattern' => "%.*%",
                'locked' => true
            )
        );

        $generals_dir = '/files/Generals';

        //Documents
        $documents_dir = '/files/Documents';

        switch ($type) {
            case 'tinymce_node':
            case 'attachment_node':
                if ($node_id) {
                    Modules::load('accreditation');

                    $node = Orm_Node::get_instance($node_id);

                    if (!$node->check_if_user_can_access_node()) {
                        json_response(array('error' => array(lang("Error: You Don't have Permission"))));
                    }

                    $documents_dir .= '/' . $node->get_attachments_directory(false);
                } else {
                    json_response(array('error' => array(lang("Error: You Don't have Permission"))));
                }
                break;

            default :

                if (!Orm_User::has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN) && !Orm_User::check_credential(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'doc_repo-manage')) {

                    $doc_repo_path = array();
                    $doc_repo_path[] = intval(Orm_Semester::get_active_semester()->get_year());

                    if (Orm_User::has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {
                        $doc_repo_path[] = str_replace('/', '-', Orm_User::get_logged_user()->get_college_obj()->get_name_en());
                    } elseif (Orm_User::has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
                        $doc_repo_path[] = str_replace('/', '-', Orm_User::get_logged_user()->get_college_obj()->get_name_en());
                        $doc_repo_path[] = str_replace('/', '-', Orm_User::get_logged_user()->get_program_obj()->get_name_en());
                    } elseif(Orm_User::has_role_teacher()) {
                        $doc_repo_path[] = str_replace('/', '-', Orm_User::get_logged_user()->get_college_obj()->get_name_en());
                        $doc_repo_path[] = str_replace('/', '-', Orm_Semester::get_active_semester()->get_name());

                        $teacher_course_names = Orm_Course::get_teacher_course_ids(Orm_User::get_logged_user()->get_id(), true, 'name_en');

                        if($teacher_course_names) {
                            foreach($teacher_course_names as &$name){
                                $name = trim(str_replace('/', '-', $name));
                            }

                            $courses = trim(implode('|', $teacher_course_names));

                            $attributes[] = array(
                                'pattern' => "%^(?!.*({$courses})).*%",
                                'hidden' => true
                            );
                        } else {
                            $allow_doc_repo = false;
                        }

                    } else {
                        $allow_doc_repo = false;
                    }

                    $path = implode('/', $doc_repo_path);

                    $documents_dir .= '/' . $path;

                } else {
                    $attributes = $default_attributes = array(
                        array()
                    );
                }

                break;
        }

        if($allow_doc_repo) {
            //check if file exists or not
            $generals_full_dir = rtrim(FCPATH, '/') . $generals_dir;
            if (!is_dir($generals_full_dir)) {
                mkdir($generals_full_dir, 0777, true);
            }

            $documents_full_dir = rtrim(FCPATH, '/') . $documents_dir;
            if (!is_dir($documents_full_dir)) {
                mkdir($documents_full_dir, 0777, true);
            }
        }

        $users_dir = '/files/Users/' . Orm_User::get_logged_user()->get_id();
        $users_full_dir = rtrim(FCPATH, '/') . $users_dir;
        if (!is_dir($users_full_dir)) {
            mkdir($users_full_dir, 0777, true);
        }

        include_once APPPATH . 'libraries/elFinder-2.1.1/elFinderConnector.class.php';
        include_once APPPATH . 'libraries/elFinder-2.1.1/elFinder.class.php';
        include_once APPPATH . 'libraries/elFinder-2.1.1/elFinderVolumeDriver.class.php';
        include_once APPPATH . 'libraries/elFinder-2.1.1/elFinderVolumeLocalFileSystem.class.php';

        /**
         * Simple function to demonstrate how to control file access using "accessControl" callback.
         * This method will disable accessing files/folders starting from  '.' (dot)
         *
         * @param  string $attr attribute name (read|write|locked|hidden)
         * @param  string $path file path relative to volume root directory started with directory separator
         * @return bool|null
         * */
        function access($attr, $path, $data, $volume)
        {
            return strpos(basename($path), '.') === 0 // if file/folder begins with '.' (dot)
                ? !($attr == 'read' || $attr == 'write') // set read+write to false, other (locked+hidden) set to true
                : null; // else elFinder decide it itself
        }

        $root = array(
            'driver' => 'LocalFileSystem', // driver for accessing file system (REQUIRED)
            'accessControl' => 'access', // disable and hide dot starting files (OPTIONAL)
            'uploadOverwrite' => false,
            'uploadDeny' => array('all'),
            'uploadOrder' => 'deny,allow',
            'uploadMaxSize' => $this->config->item('upload_max_size'),
            'uploadAllow' => $this->config->item('upload_allow'),
        );

        if($allow_doc_repo) {
            $opts['roots']['generals'] = array_merge($root, array('path' => $generals_full_dir, 'URL' => $generals_dir,'alias' => lang('General'), 'attributes' => $default_attributes));
            $opts['roots']['documents'] = array_merge($root, array('path' => $documents_full_dir, 'URL' => $documents_dir, 'alias' => lang('Documents'), 'attributes' => $attributes));
        }
        $opts['roots']['users'] = array_merge($root, array('path' => $users_full_dir, 'URL' => $users_dir, 'alias' => lang('My files')));

        // run elFinder
        $connector = new elFinderConnector(new elFinder($opts));
        $connector->run();
    }

}
