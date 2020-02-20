<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Node extends CI_Controller {

    public $xauth;
    public $show_name;

    public function __construct(){
        parent::__construct();

        $this->load->helper(array('form', 'url', 'html', 'directory', 'cookie'));
        //$this->load->library(array('form_validation', 'security', 'pagination', 'session', 'encrypt', 'Compress', 'nativesession'));

        $this->load->library(array('form_validation', 'security', 'pagination', 'session', 'Compress', 'nativesession'));
        
        $this->perPage = 20;
        $this->form_validation->set_message('valid_email', 'Invalid email entered');
        $this->form_validation->set_message('alpha_space', 'Invalid name entered');
        $this->form_validation->set_message('is_unique', 'This %s already exists');
        //$this->form_validation->set_message('max_length', 'The field "%s" is too long, cant\'t proceed!');
        $this->form_validation->set_message('regex_match[/^[0-9]{6,11}$/]', 'Phone must contain numbers and a maximum of 11 digits!');
        $this->load->model('sql_models');
        @date_default_timezone_set('Africa/Lagos');

            //load our Nativesession library
        //$this->load->library( 'nativesession' );

        $ipaddrs = $_SERVER['REMOTE_ADDR'];
        $this->sql_models->record_visitors($ipaddrs);

        

        function hash_password($password){
           return password_hash($password, PASSWORD_BCRYPT);
        }

        function time_ago($date){
            $periods=array("sec","min","hr","day","week","month","year","decade");
            $lengths=array("60","60","24","7","4.35","12","10");
            $now=time();
            @$mydate=strtotime($date);
            if($now>$mydate){
                $difference=$now-$mydate;
                $tense="ago";
            }else{
                $difference=$mydate-$now;
                $tense="from now";
            }
            for($j=0; $difference>=$lengths[$j] && $j<count($lengths)-1; $j++){
                $difference/=$lengths[$j];
            }
            $difference=intval($difference);
                //$difference=round($difference,PHP_ROUND_HALF_DOWN);
            if($difference!=1){
                $periods[$j].='s';
            }
            return "$difference $periods[$j] {$tense}";
        }


        function convertTime($difference){
            $days = intval($difference / 86400); 
            $difference = $difference % 86400;
            $hours = intval($difference / 3600)+($days*24); 
            $difference = $difference % 3600;
            $minutes = intval($difference / 60);
            $difference = $difference % 60;
            $seconds = intval($difference); 
            $check_zero = $days;
            if($check_zero<=0)
                return ("<font style='font-size:14px;'>".$hours."hrs</font>");
            else
                return ($days." days");
        }


        function url_test($url) {
          $timeout = 10;
          $ch = curl_init();
          curl_setopt ( $ch, CURLOPT_URL, $url );
          curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
          curl_setopt ( $ch, CURLOPT_TIMEOUT, $timeout );
          $http_respond = curl_exec($ch);
          $http_respond = trim( strip_tags( $http_respond ) );
          $http_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
          if ( ( $http_code == "200" ) || ( $http_code == "302" ) ) {
            return true;
          } else {
            // return $http_code;, possible too
            return false;
          }
          curl_close( $ch );
        }


        function makeLinks2($str) {
            $reg_exUrl = "/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))/";
            if(preg_match($reg_exUrl, $str, $url)) {                    
                if(strpos( $url[0], ":" ) === false){
                    $link = 'http://'.$url[0];
                }else{
                    $link = $url[0];
                }
                $str = preg_replace($reg_exUrl, '#', $str);
            }
            return $str;
        }



        // function makeLinks3($str) {
        //     //$clean = preg_replace('/<iframe.*?src="http:\/\/www\.youtube\.com\/embed\/(.*)".*?\/iframe>/si','%youtube_embed%=$1',  html_entity_decode($str));
        //     $str = preg_replace( '/<iframe\b[^>]*width="([^"]*)"[^>]*height="([^"]*)"[^>]*youtube.com\/embed\/([^"]*)[^>]*>(.*?)>/', '<amp-youtube width="$1" height="$2" data-videoid="$3" layout="responsive"></amp-youtube>', $str );

        //     //$str = preg_replace('/%youtube_embed%=(.*)/si', '',  $clean);
        //     return $str;
        // }



    }



    function storeNewsFromSource(){
        if($this->sql_models->addAndFetchNews())
            echo "Updates Done...";
        else
            echo "No Updates...";
    }



    function update_my_pass(){
        $this->form_validation->set_rules('txtpass1', 'old password', 'required|trim');
        $this->form_validation->set_rules('txtpass2', 'new password', 'required|trim');
        $this->form_validation->set_rules('txtpass3', 'confirm password', 'required|trim|matches[txtpass2]');
        $oldpass = $this->input->post('txtpass1');
        
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{
            $new_pass = sha1($this->input->post('txtpass3'));
            $updated = $this->sql_models->update_password($new_pass, sha1($oldpass));
            if($updated){
                $now = 865000;
                $cookie = array(
                    'name'              => 'adm_password_sch',
                    'value'             => $new_pass,
                    'expire'            => $now,
                    'secure'            => FALSE
                );
                set_cookie($cookie);
                echo "pass1_updated";
            }else{
                echo "Invalid old password!";
            }
        }
    }



    public function index(){
        $data['page_title'] = "Daily news, headlines, entertainments, sports, breaking news and more | SkyNewsNG";
        $data['page_name'] = "";
        $data['page_header'] = "";
        $ipaddrs = $_SERVER['REMOTE_ADDR'];
        $data['sponsoredAD'] = $this->sql_models->sponsoredAD();

        // news, business, sport, culture, science_technology, Entertainment, Trending, Metro News
        // Lifestyle, Politics, Sports, Gossip, 
        $data['news_cats'] = $news_single = $this->sql_models->fetchEachCats();
        
        //function recentNews($param1, $param2, $offset, $limit, $sorts)

        $data['recent_news'] = $this->sql_models->recentNews('', '', 3, '', '');
        //$data['recent_sports'] = $this->sql_models->recentNews('Metro News', '', 1, 1, '');
        $data['recent_sports'] = $this->sql_models->recentNews('Entertainment', '', 1, 1, '');
        $data['recent_lifestyle'] = $this->sql_models->recentNews('Events', '', 1, 1, '');
        $data['recent_business'] = $this->sql_models->recentNews('sport', '', 1, '', '');
        $data['recent_tech'] = $this->sql_models->recentNews('Weddings', '', 1, '', '');
        $data['recent_news_one'] = $this->sql_models->recentNews('', '', 1, 1, '');
        $data['recent_news1'] = $this->sql_models->recentNews('', '', 4, 2, '');
        $data['recent_lifestyle1'] = $this->sql_models->recentNews('Events', '', 0, 2, '');
        $data['recent_business1'] = $this->sql_models->recentNews('Business', '', 2, '', '');
        $data['recent_poli'] = $this->sql_models->recentNews('Politics', '', 2, '', '');
        $data['recent_sports1'] = $this->sql_models->recentNews('sport', '', 2, '', '');
        $data['recent_tech1'] = $this->sql_models->recentNews('Weddings', '', 2, '', '');
        $data['most_viewed'] = $this->sql_models->recentNews('', '', 6, '', 'views');
        $data['headlines1'] = $this->sql_models->recentNewsHeadlines();
        $this->load->view("header", $data);
        $this->load->view("index", $data);
        $this->load->view('right_bar', $data);
        $this->load->view('footer', $data);
    }



    public function contact(){
        $data['page_title'] = "Contact | SkyNewsNG";
        $data['page_name'] = "contact";
        $data['page_header'] = "";
        $data['sponsoredAD'] = $this->sql_models->sponsoredAD();
        $this->load->view("header", $data);
        $this->load->view("contact", $data);
        $this->load->view('footer', $data);
    }

    
    public function privacy_policy(){
        $data['page_title'] = "Privacy & Policy | SkyNewsNG";
        $data['page_name'] = "privacy_policy";
        $data['page_header'] = "";
        $data['sponsoredAD'] = $this->sql_models->sponsoredAD();
        $this->load->view("header", $data);
        $this->load->view("privacy_policy", $data);
        $this->load->view('footer', $data);
    }


    function send_mail($from_email, $to_email, $identification, $messages, $subj){
        //Load email library
        $this->load->library('email');
        $this->email->from($from_email, $identification);
        $this->email->to($to_email);
        $this->email->subject($subj);
        $this->email->message($messages);
        //Send mail
        if($this->email->send())
            return true;
        else
            return false;
    }


    function send_email_to_admin(){
        $this->form_validation->set_rules('txtnames', 'full names', 'required|trim|alpha_space|max_length[30]');
        $this->form_validation->set_rules('txtemail', 'email', 'required|trim|valid_email');
        $this->form_validation->set_rules('txtphone', 'phone number', 'required|trim|numeric|regex_match[/^[0-9]{6,11}$/]');
        $this->form_validation->set_rules('txtsubj', 'subject', 'required|trim');
        $this->form_validation->set_rules('txtmsg', 'message', 'required|trim');

        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{
            
            $txtname = $this->input->post('txtnames');
            $txtphs = $this->input->post('txtphone');
            $txtemail = $this->input->post('txtemail');
            $txtsubject = $this->input->post('txtsubj');
            $txtmessage = nl2br($this->input->post('txtmsg'));

            if($txtsubject==1) $txtsubject = "Advertise";
            else if($txtsubject==2) $txtsubject = "Complaints & Reports";
            else if($txtsubject==3) $txtsubject = "Suggestions & Feedback";
            else $txtsubject = "Others";

            //////////////////FOR EMAILS/////////////////////////
                $txtemail = strtolower($txtemail);
                $my_name = ucwords($txtname);

                $message_contents = "<div style='margin-top:0px; text-align:center;'><img src='".base_url()."/images/logo-black.png'></div>";
                $message_contents .= "<p style='font-size:14px; margin-top:25px'><b>Hello Admin,</b></p>";
                $message_contents .= "<p style='font-size:14px; margin-top:10px'>You have a message from $my_name sent at SkyNewsNG contact page. </p>";
                $message_contents .= "<p style='font-size:14px; margin:15px 0 5px 0'><b>Name: </b>$my_name</p>";
                $message_contents .= "<p style='font-size:14px; margin:0px 0 5px 0'><b>Phone:</b><a href='tel:$txtphs'>$txtphs</a></p>";
                $message_contents .= "<p style='font-size:14px; margin:0px 0 5px 0'><b>Subject:</b>$txtsubject</p>";
                $message_contents .= "<p style='font-size:14px; margin:0px 0 20px 0'><b>Message</b><br>$txtmessage</p><br><br>";

                $message_contents .= "<p style='margin-top:16px; line-height:1.5em; font-size:13px;'><b>Best Regards,</b><br>";
                $message_contents .= "<a href='http://skynewsng.com/' style='color:#0066FF' target='_blank'>http://skynewsng.com</a></p>";

                $from_email = $my_name;
                $subj = $txtsubject;

                $this->send_mail($from_email, "info@skynewsng.com", "Contact Page", $message_contents, $subj);
                //function send_mail($from_email, $to_email, $identification, $messages, $subj){
                echo "email_sent";
            //////////////////FOR EMAILS/////////////////////////
        }
    }



    public function media(){
        $category = $this->uri->segment(2); // events or campaign
        $keywords = $this->uri->segment(3); // searched word
        //echo $category; exit;
        $keywords = str_replace(array("%20", "-"), " ", $keywords);
        if($category=="search"){
            $newsCat = $this->sql_models->fetchNewsCat('search', $keywords, $category, 0);
            $data['newsCatCount'] = $this->sql_models->fetchEachCatsCounts('search', $keywords, $category);
            $titles = "Searches for ".ucwords($keywords);
        }else{
            $newsCat = $this->sql_models->fetchNewsCat('', '', $category, 0);
            $data['newsCatCount'] = $this->sql_models->fetchEachCatsCounts('', '', $category);
            //if(!$newsCat) redirect('');
            $titles = ucwords($category);
        }
        $data['sponsoredAD'] = $this->sql_models->sponsoredAD();

        $data['fetchNews'] = $newsCat;
        $data['most_viewed'] = $this->sql_models->recentNews('', '', 4, '', 'views');
        $data['page_title'] = "$titles | SkyNewsNG";
        $data['page_name'] = "media";
        $data['news_cats'] = $this->sql_models->fetchEachCats();
        $this->load->view("header", $data);
        $this->load->view("archive_page", $data);
        $this->load->view('right_bar', $data);
        $this->load->view('footer', $data);
    }



    function upload_blogpost(){
        $this->form_validation->set_rules('txtcats', 'Category', 'required|trim');
        $this->form_validation->set_rules('txttitle', 'Title', 'required|trim');
        $this->form_validation->set_rules('txtdescrip', 'Content', 'required|trim|min_length[10]');
        
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{

            $txtcats = $this->input->post('txtcats');
            $txttitle = $this->input->post('txttitle');
            $txtdescrip = $this->input->post('txtdescrip');
            $former_file_ph = $this->input->post('former_file_ph');
            $blogid = $this->input->post('blogid'); // for update
            
            $filesCount = @count($_FILES['blog_img']['name']);
            $gen_num1 = mt_rand(1111111, 9999999);

            
            $data1 = array();
            if(!empty($_FILES['blog_img']['name'])){
                $ext2 = pathinfo($_FILES['blog_img']['name'], PATHINFO_EXTENSION);
                $img_ext_chk = array('jpg','png','jpeg','mp4');
    
                if(!in_array($ext2,$img_ext_chk) && isset($_FILES['blog_img']['name']) && $_FILES['blog_img']['name'] != ""){
                    echo "Invalid image format!<br>";
                }else if(isset($_FILES['blog_img']['size']) && $_FILES['blog_img']['size'] > 52428800){
                    echo "The file(s) has exceeded 50mb<br>";
                }else{
                    $randm = mt_rand(111111111, 999999999);
                    $rename_file = "$randm.$ext2";
                    $rename_file = str_replace(" ", "_", $rename_file);
                    $ext=pathinfo($rename_file,PATHINFO_EXTENSION);
                    $ext = strtolower($ext);
    
                    $url = "fake_fols/".$rename_file;
                    $url_dest = "news_files/";
                    $new_name2 = $rename_file;

                    if($ext=="jpg" || $ext=="png" || $ext=="gif" || $ext=="jpeg")
                        $url_source1 = "fake_fols/";
                    else
                        $url_source1 = "news_files/"; // for videos

                    //$url = "fake_fols/".$rename_file;
                    //$url_dest = "sponsoredads/";

                    $file_tmp = $_FILES["blog_img"]["tmp_name"];
                    if(is_uploaded_file($file_tmp)){
                        if($blogid != "")
                            $this->sql_models->delete_pics($former_file_ph);
                        //if(move_uploaded_file($file_tmp, $url)){
                        //if(move_uploaded_file($file_tmp, $url_source1.$rename_file)  && ($blogid != "" || $blogid > 0)) {
                        if(move_uploaded_file($file_tmp, $url_source1.$rename_file) ) {
                            if($ext=="jpg" || $ext=="png" || $ext=="gif" || $ext=="jpeg"){
                                $this->compress($url, $url_dest.$rename_file, 80);
                            }
                            $data1 = array(
                            'files'     => $new_name2
                            );
                        }
                    }
                    $in_folder1="fake_fols/".$rename_file; // delete the image in the fake folder
                    if(is_readable($in_folder1)) @unlink($in_folder1);
                }
            }

            if($blogid != ""){
                $data2 = array(
                    'titles'         => $txttitle,
                    'cats'           => $txtcats,
                    'links'          => "",
                    'contents'       => $txtdescrip,
                );
            }else{
                $data2 = array(
                    'session1'       => substr(time(), -6),
                    'titles'         => $txttitle,
                    'cats'           => $txtcats,
                    'links'          => "",
                    'contents'       => $txtdescrip,
                    'views'          => 0,
                    'date_posted'    => date('l F d, Y', time())
                );
            }

            $newdata3 = array_merge($data1, $data2);
            $newdata3 = $this->security->xss_clean($newdata3);

            if($blogid != ""){
                $query1 = $this->db->where('md5(id)', $blogid)->update('all_news', $newdata3);
            }else{
                $query1 = $this->db->insert('all_news', $newdata3);
            }
            echo "uploaded";
        }
    }



    function delete_images(){
        $ids = $this->input->post('ids');
        $files = $this->input->post('files');
        
        $this->db->select('id')->from('all_news')->where('id', $ids);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            
            $in_folder1="sponsoredads/".$files;
            if(is_readable($in_folder1)) @unlink($in_folder1);

            $this->db->where('id', $ids);
            $this->db->set('files', '', FALSE);
            $this->db->update('all_news');
            echo "deleted";

        }else{
            echo "error";
        }
    }



    function upload_adverts(){
        $this->form_validation->set_rules('txtexp', 'Expiry', 'required|trim');
        $this->form_validation->set_rules('txtpositn', 'Ad Position', 'required|trim');
        
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{
            $txtexp = $this->input->post('txtexp');
            $txtpositn = $this->input->post('txtpositn');
            $txtlinks = $this->input->post('txtlinks');
            $adv_id = $this->input->post('adv_id'); // for update
            $former_file_ph = $this->input->post('former_file_ph');

            if($txtexp == "noexp")
                $txtexp1 = strtotime('+1 year', time());
            else{ 
                $txtexp1 = strtotime('+'.$txtexp, time());
            }

            $gen_num1 = mt_rand(1111111, 9999999);

            $errors = false;
            $img_ext_chk = array('jpg','png','jpeg', 'gif');
            $path1 = @$_FILES['adv_image']['name'];
            $ext2 = pathinfo($path1, PATHINFO_EXTENSION);

            $file_tmp = $_FILES["adv_image"]["tmp_name"];

            $data = getimagesize($file_tmp);
            $img_width = $data[0];
            $img_height = $data[1];

            if(@$_FILES['adv_image']['name'] == ""){
                echo "Please upload an image";

            }else if(!in_array($ext2,$img_ext_chk) && isset($_FILES['adv_image']['name']) && $_FILES['adv_image']['name'] != ""){
                echo "Invalid image format!<br>";

            }else if(isset($_FILES['adv_image']['size']) && $_FILES['adv_image']['size'] > 512000){
                echo "The image has exceeded 500KB<br>";

            }else if(($img_width > 650 || $img_height > 100) && ($txtpositn=="top" || $txtpositn=="mid" || $txtpositn=="fot")){ // thin thumbnail ad is 600x74
                echo "This image size can only be at the side of the website. Top, middle and footer banner should always be sizes 600w by 74h<br>";

            }else{
                $randm = mt_rand(111111111, 999999999);
                $rename_file = "$randm.$ext2";
                $rename_file = str_replace(" ", "_", $rename_file);
                $ext=pathinfo($rename_file,PATHINFO_EXTENSION);
                $ext = strtolower($ext);

                $url = "fake_fols/".$rename_file;
                $url_dest = "sponsoredads/";

                $new_name2 = $rename_file;
                if(is_uploaded_file($file_tmp)){
                    if($adv_id != "")
                        $this->sql_models->delete_pics($former_file_ph);
                    if(move_uploaded_file($file_tmp, $url)){
                        //$this->resizeImage($url, $url_dest, 500, '', FALSE);
                        $this->compress($url, $url_dest.$rename_file, 80);
                    }
                }
                $in_folder1="fake_fols/".$rename_file; // delete the image in the fake folder
                if(is_readable($in_folder1)) @unlink($in_folder1);


                if($ext2=="") $new_name2="";

                if($adv_id!=""){ // for edit
                    $data1 = array();
                    if(isset($path1) && @$path1 != ''){
                        $data1 = array(
                            'image'    => $new_name2
                        );
                    }

                    $data2 = array(
                        'positn'        => $txtpositn,
                        'expiry'        => $txtexp1,
                        'links'        => $txtlinks,
                        'durations'     => $txtexp
                    );
                    $newdata3 = array_merge($data1, $data2);

                }else{
                    $newdata3 = array(
                        'image'         => $new_name2,
                        'positn'        => $txtpositn,
                        'expiry'        => $txtexp1,
                        'links'        => $txtlinks,
                        'durations'     => $txtexp,
                        'created_at'    => date("Y-m-d g:i a", time())
                    );
                }

                if($adv_id != ""){
                    $query1 = $this->db->where('md5(id)', $adv_id)->update('adverts', $newdata3);
                }else{
                    $query1 = $this->db->insert('adverts', $newdata3);
                }
                echo "uploaded";
            }
        }
    }


    function delete_records(){
        $txtall_id = $this->input->post('txtall_id');
        $txt_dbase_table = $this->input->post('txt_dbase_table');
        $profile_details = $this->sql_models->deleteTblRecords($txt_dbase_table, $txtall_id);
        if($profile_details) echo "deleted"; else echo "error";
    }




    function post_comments(){
        $this->form_validation->set_rules('txtcname', 'full names', 'required|trim|min_length[7]|max_length[30]');
        $this->form_validation->set_rules('txtcemail', 'email', 'required|trim|valid_email');
        $this->form_validation->set_rules('txtcmessage', 'message', 'required|trim');
        
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{
            $txtcname = $this->input->post('txtcname');
            $txtcemail = $this->input->post('txtcemail');
            $txtcmessage = $this->input->post('txtcmessage');
            $txtblogid = $this->input->post('txtblogid');
            $txtreply_id = $this->input->post('txtreply_id');

            //echo "$txtblogid mmmm"; exit;

            if($txtreply_id==""){

                $newdata2 = array(
                    'newsid'       => $txtblogid,
                    'names'        => $txtcname,
                    'emails'       => $txtcemail,
                    'message'      => $txtcmessage,
                    'created_at'   => date("Y-m-d g:i a", time())
                );

            }else{

                $newdata2 = array(
                    'comments_id'   => $txtreply_id,
                    'names'         => $txtcname,
                    'emails'        => $txtcemail,
                    'message'       => $txtcmessage,
                    'created_at'    => date("Y-m-d g:i a", time())
                );
            }

            $now = 865000;
            $cookie1 = array(
                'name'              => 'txtcname',
                'value'             => $txtcname,
                'expire'            => $now,
                'secure'            => FALSE
            );
            $cookie2 = array(
                'name'              => 'txtcemail',
                'value'             => $txtcemail,
                'expire'            => $now,
                'secure'            => FALSE
            );
            set_cookie($cookie1);
            set_cookie($cookie2);

            $newdata2 = $this->security->xss_clean($newdata2);
            $inserted = $this->sql_models->insert_comments($newdata2, $txtreply_id);

            if($inserted){
                echo "inserted";
            }else{
                echo "Network Error! Try inserting again or refresh the page";
            }
        }
    }



    public function news(){
        $mycat = $this->uri->segment(1);
        $newsid = $this->uri->segment(3);
        $newsid = substr($newsid, 0, -4);
        $this->sql_models->updateViews1($newsid);
        //echo $newsid; exit;

        $news_single = $this->sql_models->fetchNewsSingle($newsid);
        if(!$news_single) redirect('');
        $titles = $news_single['titles'];
        if(strlen($titles)>50)
            $titles = substr($titles, 0, 50)."...";
        
        $data['sponsoredAD'] = $this->sql_models->sponsoredAD();
        $data['cmt_count'] = $this->sql_models->countComments($newsid);
        // $data['sponsoredAD_top'] = $this->sql_models->sponsoredAD('top');
        // $data['sponsoredAD_mid'] = $this->sql_models->sponsoredAD('mid');
        // $data['sponsoredAD_fot'] = $this->sql_models->sponsoredAD('fot');
        $data['results'] = $this->sql_models->fetchComments($newsid);

        $data['txtcname'] = $this->input->cookie('txtcname', TRUE);
        $data['txtcemail'] = $this->input->cookie('txtcemail', TRUE);

        $data['page_title'] = "$titles | SkyNewsNG";
        $data['page_name'] = "news";
        $data['most_viewed'] = $this->sql_models->recentNews('', '', 4, '', 'views');
        $data['page_cats'] = ucwords($mycat);
        $data['news_single'] = $news_single;
        $data['newsid'] = $newsid;
        $single_title = $news_single['titles'];
        //print_r($news_single); exit;
        $data['news_cats'] = $news_single = $this->sql_models->fetchEachCats();
        $data['related_post'] = $this->sql_models->fetchRelatedPosts($mycat, $newsid, $single_title);
        $this->load->view("header", $data);
        $this->load->view("single_post", $data);
        $this->load->view('right_bar', $data);
        $this->load->view('footer', $data);
    }



    function bring_blog_id_comments(){
        $blog_id = $this->input->post('blog_id');
        $results = $this->sql_models->fetchComments($blog_id);
        if($results){
            foreach ($results as $key) {
                $ids = $key['id'];
                $names = $key['names'];
                $message = $key['message'];
                $created_at = $key['created_at'];
                $created_at = @date("jS M, Y h:i a", strtotime($created_at));

                $replies = $this->sql_models->fetchReplies($ids, 1);
                $repCnt = $this->sql_models->fetchRepliesCount($ids);
            ?>
                <div class="sided-70 mb-20">
                    <div class="s-left rounded">
                        <img class="bg-grad-layer-6i" src="<?=base_url()?>images/no_passport.jpg" alt="">
                    </div>
                    
                    <div class="s-right ml-100 ml-xs-85">
                        <h5><b><?=ucwords($names);?> </b> <span class="font-8 color-888"><?=$created_at;?></span></h5>
                        <p class="mt-0 mb-5 font-10 lh-25 color-333"><?=ucfirst($message);?></p>
                        <a class="btn-brdr-grey btn-b-sm plr-15 mt-5 link_reply" id="<?=$ids?>" href="javascript:;"><b>REPLY</b></a>
                        <span class="reps1">Replies: <?=$repCnt?></span>
                    </div>
                </div>

                <?php
                if($replies){
                    foreach ($replies as $key) {
                        $ids1 = $key['id'];
                        $names1 = $key['names'];
                        $message1 = $key['message'];
                        $created_at1 = $key['created_at'];
                        $created_at1 = @date("jS M, Y h:i a", strtotime($created_at1));
                        ?>
                            <div class="sided-70 onereply ml-100 ml-xs-20 mb-30">
                                <div class="s-left s-left2 rounded">
                                    <img class="bg-grad-layer-6i" src="<?=base_url()?>images/no_passport.jpg" alt="">
                                </div>
                                
                                <div class="s-right ml-80 ml-xs-85">
                                    <h5><b><?=ucwords($names1);?> </b> <span class="font-8 color-888"><?=$created_at1;?></span></h5>
                                    <p class="mtb-5 font-10 lh-20 color-333"><?=ucfirst($message1);?></p>
                                </div>
                            </div>
                    <?php
                    }
                }
                ?>
        <?php
            }
        }else{
            echo "<p style='text-align:center;'>No comment yet! Be the first to post a comment.</p>";
        }
    }




    public function getMoreNews(){
        $page = $this->input->post('page');
        $txtpg_name = $this->input->post('txtpg_name');
        $moreNews = $this->sql_models->fetchNewsCat('', '', $txtpg_name, $page);
        //print_r($moreNews);
        if($moreNews){
            $cnts = 1;
            foreach($moreNews as $post){
                $id = $post['id'].substr(time(), -3).$cnts;
                $titles = $post['titles'];
                $titles_f = str_replace(array(" ", "’", "‘"), array("-", "", ""), strtolower($titles));
                $cats = strtoupper($post['cats']);
                $catsi = str_replace(" ", "-", strtolower($cats));
                $links = base_url()."$catsi/news/$id/$titles_f/";
                $files = $post['files'];
                $views = $post['views'];
                $date_posted = @date("D jS M, Y", strtotime($post['date_posted']));
                $linksi = $post['links'];
                if($linksi=="") $files = base_url()."news_files/$files";
            ?>
                
                <div class="col-sm-6 mt-10">
                    <img class="bg-grad-layer-6i" src="<?=$files?>" alt="">
                    <h4 class="pt-5 font-12 lh-sm-23 font-sm-16"><a href="<?=$links?>"><b><?=$titles?></b></a></h4>
                    <ul class="list-li-mr-10 pt-0 mb-25 font-sm-12">
                        <li class="color-lite-black color-black"><b>Posted:</b>
                        <?=$date_posted?></li>
                        <li><i class="color-primary mr-5 font-10 ion-ios-bolt"></i><?=$cats?></li>
                        <li><i class="color-primary mr-5 font-11 ion-eye"></i><?=$views?></li>
                    </ul>
                </div>
                <?php
                $cnts++;
            }
        }else{
            if($page<=0){
                echo "<p style='font-size:14px; padding:2em 10px; margin:1em 0 2em 0; text-align:center; color:#666; background:#eee;'>No news found on this search</p>";
            }
        }
        ?>

        <?php
    }

    

    // public function about(){
    //     $data['page_title'] = "About Us";
    //     $data['page_name'] = "about";
    //     $data['page_header'] = "About <font>Us</font>";
    //     //$this->params();
    //     $this->load->view("header_all", $data);
    //     $this->load->view("header", $data);
    //     $this->load->view("about", $data);
    //     $this->load->view('footer', $data);
    // }




    public function resizeImage($source_path, $target_path, $widths, $heights, $maintain_ratio){
      $config_manip = array(
          'image_library' => 'gd2',
          'source_image' => $source_path,
          'new_image' => $target_path,
          'maintain_ratio' => $maintain_ratio,
          'width' => $widths,
          'height' => $heights,
      );
      $this->load->library('image_lib');
      $this->image_lib->initialize($config_manip);

      if (!$this->image_lib->resize()) {
          echo $this->image_lib->display_errors();
      }

      $this->image_lib->clear();
   }


   function compress($source, $destination, $quality) {

        $info = getimagesize($source);

        if ($info['mime'] == 'image/jpeg') 
            $image = imagecreatefromjpeg($source);

        elseif ($info['mime'] == 'image/gif') 
            $image = imagecreatefromgif($source);

        elseif ($info['mime'] == 'image/png') 
            $image = imagecreatefrompng($source);

        imagejpeg($image, $destination, $quality);

        return $destination;
    }




    function logme_adms(){
        $this->form_validation->set_rules('username', 'username', 'required|trim');
        $this->form_validation->set_rules('pass', 'password', 'required|trim');
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{
            $is_correct_id = $this->sql_models->auth_details(strtolower($this->input->post('username')), strtolower($this->input->post('pass')));

            if($is_correct_id){
                echo "successor1";
            }else{
                echo "Invalid details entered!";
            }
        }
    }










}






