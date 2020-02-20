<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//session_start();

class Admin extends CI_Controller {

        public $xauth;
        public $showname;

        public function __construct(){
            parent::__construct();

            $this->load->helper(array('form', 'url', 'html', 'directory', 'cookie', 'file'));
            $this->load->library(array('form_validation', 'security', 'pagination', 'session', 'excel'));
            $this->perPage = 25;
            $this->load->model('sql_models');
            @date_default_timezone_set('Africa/Lagos');

            if(!$this->sql_models->validate_adminx()){
                $this->xauth = 0;
            }else{
                $this->xauth = 1;
            }

        }



    public function login(){
        $data['page_name'] = "login";
        $data['page_title'] = "Login";
        if(!$this->xauth){
            $this->load->view("admin/login", $data);
        }else{
            redirect('admin/');
        }
    }


    function logout(){
        $cookie = array(
            'name'   => 'adm_password_afnu',
            'value'  => '',
            'expire' => '0',
            'secure' => FALSE
        );

        $cookie1 = array(
            'name'   => 'adm_username_afnu',
            'value'  => '',
            'expire' => '0',
            'secure' => FALSE
        );

        delete_cookie($cookie);
        delete_cookie($cookie1);
        redirect('admin/login');
    }



       // Show view Page
    public function index(){
        if($this->sql_models->validate_adminx()){
            $data['page_name'] = "";
            $data['page_title'] = "Administrator";
            $data['getId'] = "";
            //$data['unread_msg'] = $this->unread_msg;
             $data['webviews'] = $this->sql_models->totalCounts('visitors', '');
            // $data['totalmems'] = $this->sql_models->totalCounts('members', '');
            // $data['mem_subs'] = $this->sql_models->totalCounts('member_subscription', 1);
            // $data['scholarships'] = $this->sql_models->totalCounts('scholarships', '');
            $data['adverts'] = $this->sql_models->totalCounts('adverts', '');
            $data['news'] = $this->sql_models->totalCounts('all_news', '');
            $data['fetchLast10News'] = $this->sql_models->fetchLast10Records('all_news');
            $data['adverts1'] = $this->sql_models->fetchLast10Records('adverts');
            $data['newsupdates'] = $this->sql_models->NewsUpdate();
            // $data['url_id'] = "";
            $this->load->view("admin/header", $data);
            $this->load->view("admin/index", $data);
        }else{
            redirect('admin/login');
        }
    }



    
    
    public function settings(){
        if($this->sql_models->validate_adminx()){
            $data['show_name'] = "Admin";
            $data['page_name'] = "settings";
            $data['page_title'] = "Admin Settings";
            $data['url_id'] = "";
            //$data['unread_msg'] = $this->unread_msg;
            $this->load->view("admin/header", $data);
            $this->load->view("admin/index", $data);
        }else{
            redirect('admin/login');
        }
    }

    

    public function upload_advert(){
        $url_id = $this->uri->segment(3);
        if($this->sql_models->validate_adminx()){
            $data['show_name'] = "Admin";
            $data['page_name'] = "upload_advert";
            $data['page_title'] = "Upload Advert";
            $data['url_id'] = $url_id;
            $data['getId'] = "";
            $this->load->view("admin/header", $data);
            $this->load->view("admin/index", $data);
        }else{
            redirect('admin/login');
        }
    }


    public function edit_advert(){
        $url_id = $this->uri->segment(3);
        if($this->sql_models->validate_adminx()){
            $data['show_name'] = "Admin";
            $data['page_name'] = "edit_advert";
            $data['page_title'] = "Edit Advert";
            $data['url_id'] = $url_id;
            $data['getId'] = $this->sql_models->get_ID($url_id, 'adverts');
            $this->load->view("admin/header", $data);
            $this->load->view("admin/index", $data);
        }else{
            redirect('admin/login');
        }
    }




    public function uploadnews(){
        if($this->sql_models->validate_adminx()){
            $data['url_id'] = "";
            $data['url_id1'] = "";
            $data['show_name'] = "Admin";
            $data['page_name'] = "uploadnews";
            $data['page_title'] = "Upload News";
            $data['getId'] = "";
            $data['cate'] = $this->sql_models->get_Cats();
            $this->load->view("admin/header", $data);
            $this->load->view("admin/index", $data);
        }else{
            redirect('admin/login');
        }
    }


    public function edit_news(){
        if($this->sql_models->validate_adminx()){
            $url_id = $this->uri->segment(3);
            if($this->sql_models->check_link($url_id, 'all_news')){
                $data['url_id'] = $url_id;
                $data['url_id1'] = "";
                //$data['unread_msg'] = $this->unread_msg;
                $data['show_name'] = "Admin";
                $data['page_name'] = "edit_news";
                $data['page_title'] = "Edit News";
                $data['getId'] = $this->sql_models->get_ID($url_id, 'all_news');
                $this->load->view("admin/header", $data);
                $this->load->view("admin/index", $data);
            }else{
                redirect('admin/viewNews');
            }
        }else{
            redirect('admin/login');
        }
    }


    public function viewNews(){
        if($this->sql_models->validate_adminx()){
            $data['url_id'] = "";
            $data['show_name'] = "Admin";
            $data['page_name'] = "viewNews";
            $data['page_title'] = "View News";
            $this->load->view("admin/header", $data);
            $this->load->view("admin/index", $data);
        }else{
            redirect('admin/login');
        }
    }




    public function view_advert(){
        if($this->sql_models->validate_adminx()){
            $data['show_name'] = "Admin";
            $data['page_name'] = "view_advert";
            $data['page_title'] = "View Adverts";
            $data['url_id'] = "";
            $this->load->view("admin/header", $data);
            $this->load->view("admin/index", $data);
        }else{
            redirect('admin/login');
        }
    }

    



    public function update_password(){
        if($this->sql_models->validate_adminx()){
            $data['page_name'] = "changepasswords";
            $data['page_title'] = "Change Password";
            $data['url_id'] = "";
            $data['unread_msg'] = $this->unread_msg;
            $this->load->view("admin/header", $data);
            $this->load->view("admin/index", $data);
            //$this->load->view("admin/footer");
        }else{
            redirect('admin/login');
        }
    }




    public function fetch_all_blogs(){
        $fetch_data = $this->sql_models->make_datatables('all_news', '', '');
        $data = array();
        $conts = 1;
        foreach($fetch_data as $row)
        {   
            $sub_array = array();
            $ids = $row->id;
            $titles = $row->titles;
            $cats = $row->cats;
            $links = $row->links;
            $links_1 = $links;
            $files = $row->files;
            $contents = $row->contents;
            $views = @number_format($row->views);
            $date_posted = $row->date_posted;

            if($links=="") $links="No link embeded"; else $links="<a href='$links' target='_blank'>$links</a>";

            $myphotos = "";
            $myphotos .= "<div class='evnt_pics'>";
            $myphotos .= "<img src='".base_url()."news_files/$files' id='im10'></div>";
            
            $btns1 = '';
            if($links_1==""){
                $btns1 .= '<button class="btn btn-primary btn-xs edit_news" captn="0" data-title="Edit" data-toggle="modal" 
                data-target="#myPopup_" id="'.md5($ids).'"><span class="fa fa-pencil"></span> </button>&nbsp;';
            }

            $btns1 .= '<button class="btn btn-danger btn-xs btn_delete" data-title="Delete" data-toggle="modal" 
            data-target="#delete_dv" for_id="'.$ids.'" for_page="events">
            <span class="fa fa-trash-o"></span></button>';
            
            $sub_array[] = $conts;
            $sub_array[] = $titles;
            $sub_array[] = $cats;
            $sub_array[] = $views;
            $sub_array[] = $date_posted;
            $sub_array[] = $links;
            $sub_array[] = $contents;
            $sub_array[] = $myphotos;
            $sub_array[] = $btns1;
            // $sub_array[] = $titles;

            $data[] = $sub_array;
            $conts++;
        }
        $output = array(
            "draw"              =>  intval($_POST["draw"]),
            "recordsTotal"      =>  $this->sql_models->get_all_data('all_news', ''),
            "recordsFiltered"   =>  $this->sql_models->get_filtered_data('all_news', '', '', '', '', ''),
            "data"              =>  $data
        );
        echo json_encode($output);
    }

    

    public function logme_adm(){
        $this->form_validation->set_rules('txtuser', 'username', 'required|trim');
        $this->form_validation->set_rules('txtpas1s', 'password', 'required|trim');
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{
            $data = array(
                'emails' => $this->input->post('txtuser'),
                'pass1'=> sha1($this->input->post('txtpas1s'))
                    );
            $is_correct = $this->sql_models->get_admin_logins($data);
            if($is_correct){
                $user_mail = $this->input->post('txtuser');
                $user_mail = sha1(strtolower($user_mail));
                $user_pass = sha1($this->input->post('txtpas1s'));

                $newdata = array(
                    'adm_uname_ider'  => $user_mail,
                    'pass1s_ider'     => $user_pass,
                    'logged_in_ider' => TRUE
                );
                $this->session->set_userdata($newdata);
                    echo "success1";
                
            }else{
                
                echo "Login credentials do not match!";

            }
        }
    }

    


    function fetch_adverts(){
        $txtmem = $this->uri->segment(3);
        $fetch_data = $this->sql_models->make_datatables('adverts', '', '');
        $data = array();
        $conts = 1;
        foreach($fetch_data as $row)
        {
            $sub_array = array();
            $id = $row->id;
            $image = $row->image;
            $links = $row->links;
            $expiry = $row->expiry;
            $duration = $row->durations;
            $created_at = $row->created_at;

            if($links=="") {
                $links1="javascript:;";
                $targets = "";
            }else{
                $links1=$links;
                $targets = "target='_blank'";
            }

            if($image=="")
                $image1 = "No image";
            else{
                $image1 = base_url()."sponsoredads/$image";
                $image1 = "<img src='$image1' style='width:160px !important;'>";
            }

            if($expiry <= 0)
                $expiry1 = "<i style='color:#777; font-weight:normal'>No Expiry</i>";
            else{
                if($expiry < time())
                    $expiry1 = "<label style='color:red'>Expired ($duration)</label>";
                else
                    $expiry1 = date("D jS M, Y h:ia", $expiry);
            }

            $created_at = date("D jS M, Y h:ia", strtotime($created_at));

            $btns1 = '<button class="btn btn-primary btn-xs edit_adv" data-title="Edit" data-toggle="modal" 
                data-target="#myPopup_" id="'.md5($id).'"><span class="fa fa-pencil"></span> </button> &nbsp;';
            
            $btns1 .= '<button class="btn btn-danger btn-xs btn_delete" data-title="Delete" data-toggle="modal" 
            data-target="#delete_dv" for_id="'.$id.'" for_page="">
            <span class="fa fa-trash-o"></span></button>';
            
            $sub_array[] = $conts;
            $sub_array[] = "<a href='$links1' $targets>$image1</a>";
            $sub_array[] = $created_at;
            $sub_array[] = "<a href='$links1' $targets>$links</a>";
            $sub_array[] = $expiry1;
            $sub_array[] = $btns1;
            $data[] = $sub_array;
            $conts++;
        }
        $output = array(
            "draw"              =>  intval($_POST["draw"]),
            "recordsTotal"      =>  $this->sql_models->get_all_data('adverts', $txtmem),
            "recordsFiltered"   =>  $this->sql_models->get_filtered_data('adverts', $txtmem),
            "data"              =>  $data
        );
        echo json_encode($output);
    }



}
