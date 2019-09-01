<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * @property CI_DB_query_builder $db
 * @property Orm_Fp_Forms_Type $type
 *
 * Class Manager
 */
class Faculty_Performance extends MX_Controller
{
    /**
     * @var $view_params array => the array pf data that will send to views
     * @var $type int (type of forms)
     * @var $deadline int (deadline id active)
     */

    private $view_params = array();

    private $type;
    private $deadline = 0;


    /**
     * Faculty_Performance constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if (!License::get_instance()->check_module('faculty_performance', true)) {
            show_404();
        }

        Orm_User::check_logged_in();
        Orm_User::check_permission(array(Orm_User::USER_FACULTY,Orm_User::USER_STAFF), false, 'faculty_performance-forms');

        $this->deadline = Orm_Fp_Forms_Deadline::get_current_deadline();

        $this->breadcrumbs->push(lang('Faculty Performance'), '/faculty_performance');

        $this->check_type($this->input->get_post('type_id'));

        $this->view_params['sub_menu'] = 'faculty_performance/sub_menu';
        $this->view_params['sub_tab'] = 'faculty_form';
        $this->view_params['menu_tab'] = 'faculty_performance';
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Faculty Performance From'),
            'icon' => 'fa fa-university'
        ), true);

    }


    /**
     * prepare all data that are needed in faculty performance forms
     * @return object|string
     */
    public function index()
    {
        if (!$this->deadline) {
            return Orm_Fp_Forms::show_message('warning', lang('Warning'), lang('the deadline range not set, please contact the administration to get a new deadline'));
        }

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');

        if (!$page) {
            $page = 1;
        }

        $filters = array(
            'type_id' => $this->type->get_id(),
            'is_hidden' => 0
        );

        $forms = Orm_Fp_Forms::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Fp_Forms::get_count($filters));

        $this->breadcrumbs->push($this->type->get_name() . ' ' . lang('Forms'), '/faculty_performance?type_id=' . $this->type->get_id());

        $this->view_params['forms'] = $forms;
        $this->view_params['pager'] = $pager->render(true);

        $this->view_params['layout_body'] = Orm_Fp_Forms::show_message('default', lang('Please Select Form'), null, true);

        $this->layout->view('fp_layout', $this->view_params);

    }

    /**
     * This function to show one Forms and the data that will appear
     * @param $type_id => type of form such as (Teaching , Research , Service )
     * @param $id => Form ID that want to see
     */
    public function manage($type_id, $id)
    {
        //get form
        $form = Orm_Fp_Forms::get_instance($id);

        if (!$form->get_id()) {
            Validator::set_error_flash_message('Error : Please try Again');
            redirect('/faculty_performance');
        }

        $type_id = $this->check_type($type_id);

        if (!$type_id) {
            Validator::set_error_flash_message('Error : Please try Again');
            redirect('/faculty_performance');
        }

        $this->breadcrumbs->push($this->type->get_name() . ' ' . lang('Forms'), '/faculty_performance?type_id=' . $this->type->get_id());

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');

        if (!$page) {
            $page = 1;
        }

        $filters = array();
        $filters['form_id'] = $form->get_id();
        $filters['deadline_id'] = $this->deadline;
        $filters['user_id'] = Orm_User::get_logged_user_id();

        $inputs = $form->get_inputs();
        $result = Orm_Fp_Forms_Result::get_all($filters, $page, $per_page * count($inputs));

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(count($inputs) ? (Orm_Fp_Forms_Result::get_count($filters) / count($inputs)) : 0);

        $this->view_params['inputs'] = $inputs;
        $this->view_params['result'] = $result;
        $this->view_params['form'] = $form;
        $this->view_params['pager'] = $pager->render(true);

        if($form->get_is_hidden() == intval(true)){

            $this->view_params['layout_body'] =  Orm_Fp_Forms::show_message('default', lang('This form are hidden, Please select another form'), null,true);

        } else{
            $this->view_params['layout_body'] = $this->load->view('manage', $this->view_params, true);
        }


        $this->layout->view('fp_layout', $this->view_params);
    }

    /**
     * This Function For Know the type of form depends on the type id, if not exist then it will take type teaching as a default form type
     * @param $id => type id
     * @return int => return the ID of type
     */
    private function check_type($id)
    {
        $type = Orm_Fp_Forms_Type::get_instance($id);

        if (!$type->get_id()) {
            $id = Orm_Fp_Forms_Type::TYPE_TEACHING;
        }

        $this->type = Orm_Fp_Forms_Type::get_instance($id);

        $this->view_params['type_id'] = $id;
        return $id;
    }

    /**
     * remove the Form and all data related on  (form id and all result ids will take from view )
     * @param $type_id => the type of the Form
     */
    public function delete($type_id)
    {
        $form_id = $this->input->get('form_id');
        $ids = $this->input->get('ids');

        if ($ids) {
            $this->db->trans_start();

            foreach ($ids as $input_id => $id) {
                $result = Orm_Fp_Forms_Result::get_instance($id);

                if ($result->get_form_id() == $form_id && $result->get_input_id() == $input_id && $result->get_user_id() == Orm_User::get_logged_user_id()) {
                    $result->soft_delete();
                }
            }

            $this->db->trans_complete();
        }

        Validator::set_success_flash_message(lang('Form Result Delete Successfully'), true);
        redirect("/faculty_performance/manage/{$type_id}/{$form_id}");
    }

    /**
     * add new data for form  (form id and all result ids will take from view )
     * @param $type_id=> the type of the Form
     */
    public function add($type_id)
    {
        $this->check_type($type_id);

        $form_id = $this->input->get('form_id');

        $this->view_params['form'] = Orm_Fp_Forms::get_instance($form_id);
        $this->load->view('add_edit', $this->view_params);
    }

    /**
     * edit data that are set in form (form id and all result ids will take from view )
     * @param $type_id => the type of the Form
     */
    public function edit($type_id)
    {
        $this->check_type($type_id);

        $form_id = $this->input->get('form_id');
        $ids = $this->input->get('ids');

        $results = array();
        foreach ($ids as $input_id => $id) {
            $result = Orm_Fp_Forms_Result::get_instance($id);

            if ($result->get_form_id() == $form_id && $result->get_input_id() == $input_id && $result->get_user_id() == Orm_User::get_logged_user_id()) {
                $results[$input_id] = $result;
            }
        }

        $this->view_params['results'] = $results;
        $this->view_params['form'] = Orm_Fp_Forms::get_instance($form_id);
        $this->load->view('add_edit', $this->view_params);
    }

    /**
     * save the data on forms that related on  (form id and all resutl ids will take from view )
     * @param $type_id  => the type of the Form
     */
    public function save($type_id)
    {
        $this->check_type($type_id);

        $form_id = $this->input->post('form_id');
        $ids = $this->input->post('ids');

        $form = Orm_Fp_Forms::get_instance($form_id);

        $results = array();

        if (!$form->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(['reload' => true]);
        }

        if ($ids) {

            foreach ($ids as $input_id => $data) {
                $input = Orm_Fp_Forms_Inputs::get_instance($input_id);
                if ($input->get_form_id() == $form_id) {
                    $result = Orm_Fp_Forms_Result::get_instance($data['id']);

                    $results[$input_id] = $result;

                    Orm_Fp_Forms::get_static_form($input, $result)->validate(
                        $this->deadline,
                        (isset($data['english']) ? $data['english'] : ''),
                        (isset($data['arabic']) ? $data['arabic'] : '')
                    );
                }
            }

            if (Validator::success()) {
                $this->db->trans_start();

                foreach ($ids as $input_id => $data) {
                    $input = Orm_Fp_Forms_Inputs::get_instance($input_id);
                    if ($input->get_form_id() == $form_id) {
                        $result = Orm_Fp_Forms_Result::get_instance($data['id']);
                        Orm_Fp_Forms::get_static_form($input, $result)->save();
                    }
                }

                $this->db->trans_complete();

                Validator::set_success_flash_message(lang('Form Successfully Add'));
                json_response(['reload' => true]);

            }
        }

        $this->view_params['results'] = $results;
        $this->view_params['form'] = $form;
        $html = $this->load->view('add_edit', $this->view_params, true);

        json_response(['html' => $html]);

    }

}
