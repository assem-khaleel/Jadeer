<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Layout $layout
 * @property CI_Input $input
 * Class language
 */
class Language extends MX_Controller
{

    /**
     * View Params
     * @var array
     */
    private $view_params = array();

    public function __construct() {
        parent::__construct();

        $this->view_params['sub_menu'] = 'settings/sub_menu';
        $this->view_params['sub_tab'] = 'language';
        $this->view_params['menu_tab'] = 'settings';
        $this->breadcrumbs->push(lang('Settings'), '/settings');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Translations'),
            'icon' => 'fa fa-language'
        ), true);
    }

    /**
     * listing the all items action
     */
    public function index()
    {

        Orm_User::check_logged_in();
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-translation');

        $page = (int)$this->input->get_post('page');
        $language_id = (int)$this->input->get_post('language_id');
        $fltr = (array) $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();
        if ($language_id) {
            $filters['language_id'] = $language_id;
        }
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $per_page = 10;
        $translations = Orm_Translation::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Translation::get_count($filters));

        $this->view_params['translations'] = $translations;
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['languages'] = $this->config->item('languages');
        $this->view_params['language_id'] = $language_id;

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Translations'), '/language');

        $this->view_params['active_sidebar'] = 'settings';

        $this->layout->view('language/items', $this->view_params);
    }

    public function save()
    {

        Orm_User::check_logged_in();
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-translation');

        $translations = $this->input->post('translations');

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            if ($translations) {
                foreach ($translations as $translation_id => $translation) {
                    $translation_obj = Orm_Translation::get_instance($translation_id);
                    $translation_obj->set_translation($translation);
                    $translation_obj->save();
                }

                Orm_Translation::generate_lang_file();

                Validator::set_success_flash_message(lang('Successfully Saved'));
                redirect('/language');
            }
        }

        $this->view_params['translations'] = $translations;

        redirect('/language');
    }

    public function remove($id)
    {

        Orm_User::check_logged_in();
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-translation');

        $translation = Orm_Translation::get_instance($id);

        if ($translation->get_id()) {
            $translation->delete();
        }

        Validator::set_success_flash_message(lang('Successfully Deleted'), true);
        redirect(base_url('/language'));
    }

    public function change($language)
    {
        if(array_key_exists($language, $this->config->item('languages'))) {
            $this->session->set_userdata('site_lang', $language);

            if (ENVIRONMENT == 'development') {
                Orm_Translation::generate_lang_file();
            }

            if ($this->input->server('HTTP_REFERER')) {
                redirect($this->input->server('HTTP_REFERER'));
            } else {
                redirect(base_url());
            }
        }

    }

}