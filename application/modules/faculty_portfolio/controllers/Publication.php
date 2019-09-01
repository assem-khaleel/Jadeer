<?php
/**
 * Created by PhpStorm.
 * User: QANAH
 * Date: 3/6/16 Baker BIRTH DATE
 * Time: 2:51 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * Class Publication
 */
class Publication extends MX_Controller
{

    private $view_params = array();

    /**
     * Publication constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if (!License::get_instance()->check_module('faculty_portfolio', true)) {
            show_404();
        }

        Orm_User::check_logged_in();

        $this->breadcrumbs->push(lang('Faculty Portfolio'), '/faculty_portfolio');

        $this->layout->add_javascript('/assets/jadeer/js/jquery.iframe-transport.js');

        $this->view_params['menu_tab'] = 'faculty_portfolio';

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Faculty Portfolio'),
            'icon' => 'fa fa-university'
        ), true);
    }

    /**
     * this function info by its user id
     * @param int $user_id the user id  of the info to be viewed
     * @return string the html view
     */
    public function info($user_id = 0) {

            if(!$user_id) {
                $user_id = Orm_User::get_logged_user_id();
            }

            $this->view_params['sub_menu'] = 'menu';
            $this->view_params['user_id'] = $user_id;
            $this->view_params['active'] = "publication";

            $this->view_params['books'] = $this->book_view(true, $user_id);
            $this->view_params['researches'] = $this->research_view(true, $user_id);
            $this->view_params['awards'] = $this->award_view(true, $user_id);
            $this->view_params['conferences'] = $this->conference_view(true, $user_id);
            $this->view_params['projects'] = $this->project_view(true, $user_id);

        if ($this->input->is_ajax_request()) {
            $this->load->view("faculty_portfolio/publication/list", $this->view_params);
        } else {
            $this->layout->view("faculty_portfolio/publication/list", $this->view_params);

        }
    }



    /* Book functions */

    /**
     *this function book manage
     * @redirect success or error
     */
    public function book_manage() {

        $user_id = Orm_User::get_logged_user_id();

        $id = $this->input->post_get('id');

        $book_obj = Orm_Fp_Book::get_instance($id);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $title            = $this->input->post('title');
            $author_type      = $this->input->post('author_type');
            $authors          = $this->input->post('authors');
            $authors_no       = $this->input->post('authors_no');
            $publish_date     = $this->input->post('publish_date');
            $publisher        = $this->input->post('publisher');
            $pages_count      = $this->input->post('pages_count');

            $is_translate     = $this->input->post('is_translate');
            $is_translate     = empty($is_translate)? 0 : 1;


            $book_obj->set_title($title);
            $book_obj->set_author_type($author_type);
            $book_obj->set_authors($authors);
            $book_obj->set_authors_no($authors_no);
            $book_obj->set_publish_date($publish_date);
            $book_obj->set_publisher($publisher);
            $book_obj->set_pages_count($pages_count);
            $book_obj->set_is_translate($is_translate);

            $this->load->library('Uploader');


            Validator::required_field_validator('title', $title, lang('This is a required field'));
            Validator::required_field_validator('authors', $authors, lang('This is a required field'));
            Validator::date_format_validator('publish_date', $publish_date, lang('Date format is correct'));


            if(Validator::success() && !($book_obj->get_id() && $book_obj->get_user_id() != $user_id)) {
                $book_obj->set_user_id($user_id);

                if(!$book_obj->get_id() || $book_obj->get_id()!=0 ) {

                    Uploader::common_validator('attachment', 'attachment');
                    Uploader::zero_size_validator('attachment', 'attachment', lang('File not found.'));
                    Uploader::max_size_validator('attachment', 'attachment', $this->config->item('upload_max_size'), lang('File exceeds maximum allowed size.'));
                    Uploader::mime_type_validator('attachment', 'attachment', $this->config->item('upload_allow'), lang('File type not allowed.'));

                    $attachment = Uploader::get_file_name('attachment', '/files/Users/' . $user_id . '/books/', false);
                    Uploader::move_file_to('attachment', rtrim(FCPATH, '/') . $attachment);
                    $book_obj->set_attachment($attachment);
                }


                $book_obj->save();
                json_response(array('status' => true));
            }

        }
        else {
            $book_obj = Orm_Fp_Book::get_instance($id);
        }

        $this->view_params['book'] = $book_obj;

        $html = $this->load->view('faculty_portfolio/publication/books/manage', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    /**
     * this function book delete by its id
     * @param int $id the id  of the book delete to be viewed
     * @redirect success or error
     */
    public function book_delete($id=0) {
        $user_id = Orm_User::get_logged_user_id();

        $book_obj = Orm_Fp_Book::get_instance($id);

        if($book_obj->get_id() && $book_obj->get_user_id() == $user_id) {
            $book_obj->delete();
        }
    }

    /**
     * this function book view by its to buffer and user id
     * @param bool $to_buffer the to buffer of the book view to be viewed
     * @param int $user_id the user id of the book view to be viewed
     * @return mixed the html view
     */
    public function book_view($to_buffer=false, $user_id=0) {

        if(!Orm_User::get_logged_user_id()){
            show_404();
        }

        if(!$user_id){
            $user_id = Orm_User::get_logged_user_id();
        }
        $book_page = intval($this->input->post_get('book_page')) ? : 1;
        $per_page = $this->config->item('dashboard_per_page');

        $this->view_params['books'] = Orm_Fp_Book::get_all(['user_id' => $user_id], $book_page, $per_page);


        $this->view_params['pager'] = '';
        $this->view_params['user_id'] = $user_id;
        $pager = new Pager(array('url' => '/faculty_portfolio/publication/book_view', 'page_label' => 'book_page'));
        $pager->set_page($book_page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Fp_Book::get_count(['user_id' => $user_id]));
        $pager->set_pager_style('margin: 0px;');
        $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="book_container"');

        if ($pager->get_total_count() > $pager->get_per_page()) {
            $this->view_params['pager'] = '<div class="table-footer">' . $pager->render(true) . '</div>';
        }

        if ($to_buffer) {
            return $this->load->view('faculty_portfolio/publication/books/list', $this->view_params, true);
        }

        $this->load->view('faculty_portfolio/publication/books/list', $this->view_params);
    }



    /* Research functions */

    /**
     *this function research manage
     * @redirect success or error
     */
    public function research_manage() {

        $user_id = Orm_User::get_logged_user_id();

        $id = $this->input->post_get('id');

        $research_obj = Orm_Fp_Research::get_instance($id);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $number              = $this->input->post('number');
            $type                = $this->input->post('type');
            $title               = $this->input->post('title');
            $subject             = $this->input->post('subject');
            $publish_type        = $this->input->post('publish_type');
            $publish_date        = $this->input->post('publish_date');
            $language            = $this->input->post('language');
            $summary             = $this->input->post('summary');
            $comments            = $this->input->post('comments');
            $issn                = $this->input->post('issn');
            $isi                 = $this->input->post('isi');
            $isbn                = $this->input->post('isbn');
            $other               = $this->input->post('other');
            $source              = $this->input->post('source');
            $published_in        = $this->input->post('published_in');
            $page_from           = $this->input->post('page_from');
            $page_to             = $this->input->post('page_to');
            $page_count          = $this->input->post('page_count');
            $original_type       = $this->input->post('original_type');
            $original_language   = $this->input->post('original_language');
            $original_researcher = $this->input->post('original_researcher');
            $email               = $this->input->post('email');
            $authors             = $this->input->post('authors');
            $participant_count   = $this->input->post('participant_count');
            $position_rank       = $this->input->post('position_rank');
            $agreement_date      = $this->input->post('agreement_date');
            $country             = $this->input->post('country');
            $research_center     = $this->input->post('research_center');
            $research_budget     = $this->input->post('research_budget');
            $support_party       = $this->input->post('support_party');
            $paper_status        = $this->input->post('paper_status');

            $research_obj->set_number($number);
            $research_obj->set_type($type);
            $research_obj->set_title($title);
            $research_obj->set_subject($subject);
            $research_obj->set_publish_type($publish_type);
            $research_obj->set_publish_date($publish_date);
            $research_obj->set_language($language);
            $research_obj->set_summary($summary);
            $research_obj->set_comments($comments);
            $research_obj->set_issn($issn);
            $research_obj->set_isi($isi);
            $research_obj->set_isbn($isbn);
            $research_obj->set_other($other);
            $research_obj->set_source($source);
            $research_obj->set_published_in($published_in);
            $research_obj->set_page_from($page_from);
            $research_obj->set_page_to($page_to);
            $research_obj->set_page_count($page_count);
            $research_obj->set_original_type($original_type);
            $research_obj->set_original_language($original_language);
            $research_obj->set_original_researcher($original_researcher);
            $research_obj->set_email($email);
            $research_obj->set_authors($authors);
            $research_obj->set_participant_count($participant_count);
            $research_obj->set_position_rank($position_rank);
            $research_obj->set_agreement_date($agreement_date);
            $research_obj->set_country($country);
            $research_obj->set_research_center($research_center);
            $research_obj->set_research_budget($research_budget);
            $research_obj->set_support_party($support_party);
            $research_obj->set_paper_status($paper_status);

            $this->load->library('Uploader');

            Validator::required_field_validator('title', $title, lang('This is a required field'));
            Validator::required_field_validator('authors', $authors, lang('This is a required field'));

            if(Validator::success() && !($research_obj->get_id() && $research_obj->get_user_id() != $user_id)) {
                $research_obj->set_user_id($user_id);

                Uploader::common_validator('attachment', 'attachment');
                Uploader::zero_size_validator('attachment', 'attachment', lang('File not found.'));
                Uploader::max_size_validator('attachment', 'attachment', $this->config->item('upload_max_size'), lang('File exceeds maximum allowed size.'));
                Uploader::mime_type_validator('attachment', 'attachment', $this->config->item('upload_allow'), lang('File type not allowed.'));

                Uploader::common_validator('agreement_attachment', 'agreement_attachment');
                Uploader::zero_size_validator('agreement_attachment', 'agreement_attachment', lang('File not found.'));
                Uploader::max_size_validator('agreement_attachment', 'agreement_attachment', $this->config->item('upload_max_size'), lang('File exceeds maximum allowed size.'));
                Uploader::mime_type_validator('agreement_attachment', 'agreement_attachment', $this->config->item('upload_allow'), lang('File type not allowed.'));


                if(!$research_obj->get_id() || $research_obj->get_id()!=0) {
                    $attachment = Uploader::get_file_name('attachment', '/files/Users/' . $user_id . '/researches/', false);
                    Uploader::move_file_to('attachment', rtrim(FCPATH, '/') . $attachment);
                    $research_obj->set_attachment($attachment);
                }

                if(!$research_obj->get_id() || $research_obj->get_id()!=0) {
                    $agreement_attachment = Uploader::get_file_name('agreement_attachment', '/files/Users/' . $user_id . '/researches/', false);
                    Uploader::move_file_to('agreement_attachment', rtrim(FCPATH, '/') . $agreement_attachment);
                    $research_obj->set_agreement_attachment($agreement_attachment);
                }

                $research_obj->save();
                json_response(array('status' => true));
            }

        }
        else {
            $research_obj = Orm_Fp_Research::get_instance($id);
        }

        $this->view_params['research'] = $research_obj;

        $html = $this->load->view('faculty_portfolio/publication/research/manage', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    /**
     * this function research delete by its id
     * @param int id the id of the dresearch delete to be viewed
     * @redirect success or error
     */
    public function research_delete($id=0) {
        $user_id = Orm_User::get_logged_user_id();

        $research_obj = Orm_Fp_Research::get_instance($id);

        if($research_obj->get_id() && $research_obj->get_user_id() == $user_id) {
            $research_obj->delete();
        }
    }

    /**
     * this function research view by its to buffer and user id
     * @param bool $to_buffer the to buffer of the research view to be viewed
     * @param int $user_id the user id of the research view to be viewed
     * @return mixed the html view
     */
    public function research_view($to_buffer=false, $user_id=0) {

        if(!Orm_User::get_logged_user_id()){
            show_404();
        }
        if(!$user_id){
            $user_id = Orm_User::get_logged_user_id();
        }
        $research_page = intval($this->input->post_get('research_page')) ? : 1;
        $per_page = $this->config->item('dashboard_per_page');

        $this->view_params['researches'] = Orm_Fp_Research::get_all(['user_id' => $user_id], $research_page, $per_page);


        $this->view_params['pager'] = '';
        $this->view_params['user_id'] = $user_id;
        $pager = new Pager(array('url' => '/faculty_portfolio/publication/research_view', 'page_label' => 'research_page'));
        $pager->set_page($research_page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Fp_Research::get_count(['user_id' => $user_id]));
        $pager->set_pager_style('margin: 0px;');
        $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="research_container"');

        if ($pager->get_total_count() > $pager->get_per_page()) {
            $this->view_params['pager'] = '<div class="table-footer">' . $pager->render(true) . '</div>';
        }

        if ($to_buffer) {
            return $this->load->view('faculty_portfolio/publication/research/list', $this->view_params, true);
        }

        $this->load->view('faculty_portfolio/publication/research/list', $this->view_params);
    }
    
    
    
    /* Award functions */

    /**
     * this function award manage
     * @redirect success or error
     */
    public function award_manage() {

        $user_id = Orm_User::get_logged_user_id();

        $id = $this->input->post_get('id');

        $name           = $this->input->post('name');
        $domain         = $this->input->post('domain');
        $party          = $this->input->post('party');
        $date           = $this->input->post('date');
        $address        = $this->input->post('address');
        $material_value = $this->input->post('material_value');
        $moral_value    = $this->input->post('moral_value');
        $description    = $this->input->post('description');



        $award_obj = Orm_Fp_Award::get_instance($id);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $award_obj->set_name($name);
            $award_obj->set_domain($domain);
            $award_obj->set_party($party);
            $award_obj->set_date($date);
            $award_obj->set_address($address);
            $award_obj->set_material_value($material_value);
            $award_obj->set_moral_value($moral_value);
            $award_obj->set_description($description);

            Validator::required_field_validator('name', $name, lang('This is a required field'));

            if(Validator::success() && !($award_obj->get_id() && $award_obj->get_user_id() != $user_id)) {
                $award_obj->set_user_id($user_id);
            
                $award_obj->save();
                json_response(array('status' => true));
            }
        }
        else {
            $award_obj = Orm_Fp_Award::get_instance($id);
        }

        $this->view_params['award'] = $award_obj;

        $html = $this->load->view('faculty_portfolio/publication/award/manage', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    /**
     * this function award delete by its id
     * @param int id the id of the award delete to be viewed
     * @redirect success or error
     */
    public function award_delete($id=0) {
        $user_id = Orm_User::get_logged_user_id();

        $award_obj = Orm_Fp_Award::get_instance($id);

        if($award_obj->get_id() && $award_obj->get_user_id() == $user_id) {
            $award_obj->delete();
        }
    }

    /**
     * this function award view by its to buffer and user id
     * @param bool $to_buffer the to buffer of the award view to be viewed
     * @param int $user_id the user id of the award view to be viewed
     * @return mixed the html view
     */
    public function award_view($to_buffer=false, $user_id=0) {

        if(!Orm_User::get_logged_user_id()){
            show_404();
        }

        if(!$user_id){
            $user_id = Orm_User::get_logged_user_id();
        }
        $award_page = intval($this->input->post_get('award_page')) ? : 1;
        $per_page = $this->config->item('dashboard_per_page');

        $this->view_params['awards'] = Orm_Fp_Award::get_all(['user_id' => $user_id], $award_page, $per_page);


        $this->view_params['pager'] = '';
        $this->view_params['user_id'] = $user_id;
        $pager = new Pager(array('url' => '/faculty_portfolio/publication/award_view', 'page_label' => 'award_page'));
        $pager->set_page($award_page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Fp_Award::get_count(['user_id' => $user_id]));
        $pager->set_pager_style('margin: 0px;');
        $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="award_container"');

        if ($pager->get_total_count() > $pager->get_per_page()) {
            $this->view_params['pager'] = '<div class="table-footer">' . $pager->render(true) . '</div>';
        }

        if ($to_buffer) {
            return $this->load->view('faculty_portfolio/publication/award/list', $this->view_params, true);
        }

        $this->load->view('faculty_portfolio/publication/award/list', $this->view_params);
    }


    /* Conference functions */

    /**
     *this function conference manage
     * @redirect success or error
     */
    public function conference_manage() {
        $user_id = Orm_User::get_logged_user_id();

        $id = $this->input->post_get('id');

        $name               = $this->input->post('name');
        $date               = $this->input->post('date');
        $location           = $this->input->post('location');
        $participation_type = $this->input->post('participation_type');
        $description        = $this->input->post('description');
        $is_workshop        = $this->input->post('is_workshop');
        $is_workshop        = isset($is_workshop) ? $is_workshop : 0;

        $conference_obj = Orm_Fp_Conference::get_instance($id);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $conference_obj->set_name($name);
            $conference_obj->set_date($date);
            $conference_obj->set_location($location);
            $conference_obj->set_participation_type($participation_type);
            $conference_obj->set_description($description);
            $conference_obj->set_is_workshop($is_workshop);

            Validator::required_field_validator('name', $name, lang('This is a required field'));

            if(Validator::success() && !($conference_obj->get_id() && $conference_obj->get_user_id() != $user_id)) {
                $conference_obj->set_user_id($user_id);

                $conference_obj->save();
                json_response(array('status' => true));
            }
        }
        else {
            $conference_obj = Orm_Fp_Conference::get_instance($id);
            if(!$conference_obj->get_id()) {
                $conference_obj->set_is_workshop(0);
            }
        }

        $this->view_params['conference'] = $conference_obj;

        $html = $this->load->view('faculty_portfolio/publication/conference/manage', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    /**
     * this function conference delete by its id
     * @param int $id the id of the conference delete to be viewed
     * @redirect success or error
     */
    public function conference_delete($id=0) {
        $user_id = Orm_User::get_logged_user_id();

        $conference_obj = Orm_Fp_Conference::get_instance($id);

        if($conference_obj->get_id() && $conference_obj->get_user_id() == $user_id) {
            $conference_obj->delete();
        }
    }

    /**
     * this function conference view by its to buffer and user id
     * @param bool $to_buffer the to buffer of the conference view to be viewed
     * @param int $user_id the user id of the conference view to be viewed
     * @return mixed the html view
     */
    public function conference_view($to_buffer=false, $user_id=0) {

        if(!Orm_User::get_logged_user_id()){
            show_404();
        }
        if(!$user_id){
            $user_id = Orm_User::get_logged_user_id();
        }
        $conference_page = intval($this->input->post_get('conference_page')) ? : 1;
        $per_page = $this->config->item('dashboard_per_page');

        $this->view_params['conferences'] = Orm_Fp_Conference::get_all(['user_id' => $user_id], $conference_page, $per_page);


        $this->view_params['pager'] = '';
        $this->view_params['user_id'] = $user_id;
        $pager = new Pager(array('url' => '/faculty_portfolio/publication/conference_view', 'page_label' => 'conference_page'));
        $pager->set_page($conference_page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Fp_Conference::get_count(['user_id' => $user_id]));
        $pager->set_pager_style('margin: 0px;');
        $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="conference_container"');

        if ($pager->get_total_count() > $pager->get_per_page()) {
            $this->view_params['pager'] = '<div class="table-footer">' . $pager->render(true) . '</div>';
        }

        if ($to_buffer) {
            return $this->load->view('faculty_portfolio/publication/conference/list', $this->view_params, true);
        }

        $this->load->view('faculty_portfolio/publication/conference/list', $this->view_params);
    }


    /* Project functions */

    /**
     *this function legend
     * @redirect success or error
     */
    public function project_manage() {

        $user_id = Orm_User::get_logged_user_id();

        $id = $this->input->post_get('id');

        $name        = $this->input->post('name');
        $date_from   = $this->input->post('date_from');
        $date_to     = $this->input->post('date_to');
        $location    = $this->input->post('location');
        $membership  = $this->input->post('membership');
        $description = $this->input->post('description');

        $project_obj = Orm_Fp_Project::get_instance($id);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $project_obj->set_name($name);
            $project_obj->set_date_from($date_from);
            $project_obj->set_date_to($date_to);
            $project_obj->set_location($location);
            $project_obj->set_membership($membership);
            $project_obj->set_description($description);

            Validator::required_field_validator('name', $name, lang('This is a required field'));

            if(Validator::success() && !($project_obj->get_id() && $project_obj->get_user_id() != $user_id)) {
                $project_obj->set_user_id($user_id);

                $project_obj->save();
                json_response(array('status' => true));
            }
        }
        else {
            $project_obj = Orm_Fp_Project::get_instance($id);
        }

        $this->view_params['project'] = $project_obj;

        $html = $this->load->view('faculty_portfolio/publication/project/manage', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    /**
     * this function project delete by its id
     * @param int $id the id of the project delete to be viewed
     * @redirect success or error
     */
    public function project_delete($id=0) {
        $user_id = Orm_User::get_logged_user_id();

        $project_obj = Orm_Fp_Project::get_instance($id);

        if($project_obj->get_id() && $project_obj->get_user_id() == $user_id) {
            $project_obj->delete();
        }
    }

    /**
     * this function project view by its to buffer and user id
     * @param bool $to_buffer the to buffer of the project view to be viewed
     * @param int $user_id the user id of the project view to be viewed
     * @return mixed the html view
     */
    public function project_view($to_buffer=false, $user_id=0) {

        if(!Orm_User::get_logged_user_id()){
            show_404();
        }

        if(!$user_id){
            $user_id = Orm_User::get_logged_user_id();
        }
        
        $project_page = intval($this->input->post_get('project_page')) ? : 1;
        $per_page = $this->config->item('dashboard_per_page');

        $this->view_params['projects'] = Orm_Fp_Project::get_all(['user_id' => $user_id], $project_page, $per_page);


        $this->view_params['pager'] = '';
        $this->view_params['user_id'] = $user_id;
        $pager = new Pager(array('url' => '/faculty_portfolio/publication/project_view', 'page_label' => 'project_page'));
        $pager->set_page($project_page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Fp_Project::get_count(['user_id' => $user_id]));
        $pager->set_pager_style('margin: 0px;');
        $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="project_container"');

        if ($pager->get_total_count() > $pager->get_per_page()) {
            $this->view_params['pager'] = '<div class="table-footer">' . $pager->render(true) . '</div>';
        }

        if ($to_buffer) {
            return $this->load->view('faculty_portfolio/publication/project/list', $this->view_params, true);
        }

        $this->load->view('faculty_portfolio/publication/project/list', $this->view_params);
    }

}
