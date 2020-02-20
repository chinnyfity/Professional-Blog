<?php

class Sql_models extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }



    function url_exists($domain){
        ini_set("default_socket_timeout","05");
        set_time_limit(60); // 60 seconds
        $f=@fopen($domain,"r");
        $r=@fread($f,1000);
        @fclose($f);
        if(strlen($r)>1) {
            return true;
        }else{
            return false;
       }
   }




    function get_rss_feed_as_html(){
        $categorys = array('sport','business','news','culture','science_technology');
        $categorys2 = array('africa','business','features','world','lifestyle','sci-tech','sport');
        //$feed_url1 = "https://www.informationng.com/feed";
        $feed_url1 = "https://www.bellanaija.com/feed/";
        $feed_url2 = "https://www.africanews.com/feed";
        //$feed_url3 = "http://www.sabcnews.com/sabcnews/category/";
        $feed_url3 = "https://www.channelstv.com/feed"; // africa, sports, in pictures, local, world news, politics
        

        $this->countAllNewsAndDelete(); // delete if news is more than 1500

        $random_pick = array(1, 2, 3);
        $rands = $random_pick[array_rand($random_pick)];

        if($rands==1)
            $feed_urli = $feed_url1;
        else if($rands==2)
            $feed_urli = $feed_url2;
        else
            $feed_urli = $feed_url3; // channelstv

        if($feed_urli == $feed_url1){ // informationng shows all categories
            $feed_url = $feed_url1;


        if($this->url_exists($feed_url)){
            $rss = new DOMDocument();

            $opts = array(
                'http' => array(
                    'user_agent' => 'PHP libxml agent',
                )
            );
            $context = stream_context_create($opts);
            libxml_set_streams_context($context);

            $rss->load($feed_url);

            $x=1;
            foreach ($rss->getElementsByTagName('item') as $node) { //informationng
                $item = array (
                    'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
                    'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
                    'content' => $node->getElementsByTagName('encoded')->item(0)->nodeValue,
                    'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
                    'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
                    'image_uri' => $node->getElementsByTagName('encoded')->item(0)->nodeValue,
                    //'image_uri' => $node->getElementsByTagName('enclosure')->item(0)->getAttribute('url'),
                    'cats' => $node->getElementsByTagName('category')->item(0)->nodeValue,
                );
                $image_uri = $item['image_uri'];
                $has_image = preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $image_uri, $image);
                $immg1 = @$image['src']; // @ means some dont have images

                $description = $item['content'];
                $description = strip_tags(preg_replace('/(<(script|style)\b[^>]*>).*?(<\/\2>)/s', "$1$3", $description), '');

                if($x <= 25){
                    $title = str_replace(' & ', ' &amp; ', $item['title']);
                    $content = $item['desc'];
                    $link = $item['link'];
                    $date = $item['date'];
                    $cats = $item['cats'];

                    $data[$x]['session1']       = 0;
                    $data[$x]['titles']         = $title;
                    $data[$x]['cats']           = $cats;
                    $data[$x]['links']          = $link;
                    $data[$x]['files']          = $immg1;
                    $data[$x]['contents']       = $description;
                    $data[$x]['views']          = 0;
                    $data[$x]['date_posted']    = $date;
                }
                    
                $x++;
            }

            echo "bellanaija";
            //print_r($data);
            if(!$this->already_uploaded($title, $item['cats'], $item['link'])){
                $query = $this->db->insert_batch('all_news', $data);
                if($query) return true; else return false;
            }else{
                return true;
            }
        }



        }else if($feed_urli == $feed_url3){
            $max_item_cnt=15;

            foreach ($categorys2 as $values) {
                $feed_url = "https://www.channelstv.com/feed";

                if($this->url_exists($feed_url)){
                    $rss = new DOMDocument();

                    $opts = array(
                        'http' => array(
                            'user_agent' => 'PHP libxml agent',
                        )
                    );
                    $context = stream_context_create($opts);
                    libxml_set_streams_context($context);

                    $rss->load($feed_url);
               
                    $feed = array();
                    foreach ($rss->getElementsByTagName('item') as $node) {
                        $item = array (
                            'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
                            'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
                            'content' => $node->getElementsByTagName('description')->item(0)->nodeValue,
                            'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
                            'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
                            'cats' => $node->getElementsByTagName('category')->item(0)->nodeValue,
                        );
                        $content = $node->getElementsByTagName('encoded'); // <content:encoded>
                        if ($content->length > 0) {
                            $item['content'] = $content->item(0)->nodeValue;
                        }
                        array_push($feed, $item);
                    }

                    if ($max_item_cnt > count($feed)) {
                        $max_item_cnt = count($feed);
                    }

                    for ($x=0;$x<$max_item_cnt;$x++) {
                        $title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
                        $link = $feed[$x]['link'];
                        $cats = $feed[$x]['cats'];
                        $content = $feed[$x]['content'];
                        $date = date('l F d, Y', strtotime($feed[$x]['date']));
                        $has_image = preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $content, $image);
                        $immg = $image['src'];
                        $description = $feed[$x]['desc'];
                        $description = strip_tags(preg_replace('/(<(script|style)\b[^>]*>).*?(<\/\2>)/s', "$1$3", $description), '');

                        $data[$x]['session1']       = 0;
                        $data[$x]['titles']         = $title;
                        $data[$x]['cats']           = $cats;
                        $data[$x]['links']          = $link;
                        $data[$x]['files']          = $immg;
                        $data[$x]['contents']       = $content;
                        $data[$x]['views']          = 0;
                        $data[$x]['date_posted']    = $date;
                    }

                    echo "channelstv";
                    //print_r($data);
                    if(!$this->already_uploaded($title, $cats, $link)){
                        $query = $this->db->insert_batch('all_news', $data);
                        if($query) return true; else return false;
                    }else{
                        return true;
                    }
                }
            }


        }else{

            $x1=1;
            foreach ($categorys as $values) {
                $feed_url = "https://www.africanews.com/feed/rss?themes=$values";

                if($this->url_exists($feed_url)){
                    $rss = new DOMDocument();

                    $opts = array(
                        'http' => array(
                            'user_agent' => 'PHP libxml agent',
                        )
                    );
                    $context = stream_context_create($opts);
                    libxml_set_streams_context($context);

                    $rss->load($feed_url);

                    foreach ($rss->getElementsByTagName('item') as $node) {
                        $item = array (
                            'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
                            'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
                            //'content' => $node->getElementsByTagName('encoded')->item(0)->nodeValue,
                            'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
                            'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
                            //'image_uri' => $node->getElementsByTagName('encoded')->item(0)->nodeValue,
                            'image_uri' => $node->getElementsByTagName('enclosure')->item(0)->getAttribute('url'),
                            'cats' => $values,
                        );
                        $image_uri = $item['image_uri'];
                        $has_image = preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $image_uri, $image);
                        $immg = @$item['image_uri'];
                        $description = $item['desc'];

                        if($x1 <= 15){
                            //$rrr .= $item['cats']."<br><br>";
                            $data[$x1]['session1']       = 0;
                            $data[$x1]['cats']           = $item['cats'];
                            $data[$x1]['titles']         = $item['title'];
                            $data[$x1]['links']          = $item['link'];
                            $data[$x1]['files']          = $immg;
                            $data[$x1]['contents']       = $description;
                            $data[$x1]['views']          = 0;
                            $data[$x1]['date_posted']    = $item['date'];
                        }
                        //$x1++;
                    }

                    echo "africanews";
                    //print_r($data);
                    if(!$this->already_uploaded($item['title'], $item['cats'], $item['link'])){
                        $query = $this->db->insert_batch('all_news', $data);
                        if($query) return true; else return false;
                    }else{
                        return true;
                    }
                }
                $x1++;
            }
        }
    }


    function already_uploaded($titles, $cats, $link){
        $this->db->select('id');
        $this->db->from('all_news');
        $this->db->where('titles', $titles)->where('cats', $cats);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }


    function addAndFetchNews(){
        /*$data = array(
            'session1'          => substr(time(), -6),
            'hour_timings'      => strtotime('+5 hours', time()),
            'min_timings'      => strtotime('+5 minutes', time())
        );

        $reset_sess_new     = $data['session1'];
        $hour_timings_new   = $data['hour_timings'];
        $min_timings_new    = $data['min_timings'];

        $this->db->select('session1, hour_timings, min_timings')->from('process_news');
        $this->db->order_by('id', 'asc');
        $query = $this->db->get();
        if($query->num_rows() > 0){ // if process_news is empty then insert it
            $session1 = $query->row('session1'); // this is used on checkDayExpiredTime()
            $hour_timings1 = $query->row('hour_timings');
            $min_timings1 = $query->row('min_timings');

        }else{

            $this->db->insert('process_news', $data);
            $this->db->select('session1, hour_timings, min_timings')->from('process_news');
            $this->db->order_by('id', 'asc');
            $query = $this->db->get();
            $session1 = $query->row('session1');
            $hour_timings1 = $query->row('hour_timings');
            $min_timings1 = $query->row('min_timings');

            $query = $this->output_rss_feed($reset_sess_new);
            if($query) return true; else return false;
        }*/
        
        // if($this->check5MinuteExpiredTime()){ // while its within 5 minutes, continue updating news online
        //     $query = $this->output_rss_feed($reset_sess_new);
        //     if($query) return true; else return false;

        // }else{ // 5 minutes expired
            // if($this->checkHourExpiredTime()){ // if 6hrs has expired
            //     $this->db->set('session1', $reset_sess_new, FALSE);
            //     $this->db->set('hour_timings', $hour_timings_new, FALSE);
            //     $this->db->set('min_timings', $min_timings_new, FALSE);

            //     $this->db->where('session1', $session1)->where('hour_timings', $hour_timings1)->where('min_timings', $min_timings1);
            //     $query = $this->db->update('process_news');

                //if(!$this->checkUploadedSessions($reset_sess_new)){ // if i have uploaded this session

                    $query = $this->output_rss_feed();
                    if($query) return true; else return false;
                //}

            // }else{
            //     return true;
            // }
        //}
    }


    function checkHourExpiredTime(){
        $now = time();
        $this->db->select('id')->from('process_news');
        $query = $this->db->get();
        if($query->num_rows() > 0){ // check if data exists
            $this->db->select('id')->from('process_news')->where('hour_timings >=', $now); // < means expired
            $query = $this->db->get();
            if($query->num_rows() > 0){ // time expired, renew time and session
                return true;
            }else{
                return false;
            }
        }else{ // no data
            return true;
        }
    }




    function countAllNewsAndDelete(){
        $allnews = $this->db->from("all_news")->count_all_results();
        if($allnews>2500){
            $this->db->query("DELETE FROM all_news ORDER BY id LIMIT 50");
        }
    }



    function output_rss_feed(){
        $query = $this->get_rss_feed_as_html();
        if($query) return true; else return false;
    }



    function recentNews($param1, $param2, $offset, $limit, $sorts){
        $this->db->select('id, titles, cats, links, files, views, contents, date_posted')->from('all_news');
            $srchs = "(cats like 'Sport%' or cats like 'sport%')";
            $srchs1 = "(cats like '%$param1%')";
            $srchs2 = "(cats like '%$param2%')";
            
        if($param1!=''){
            if(strtolower($param1)=='sport')
                $this->db->where("$srchs");
            else if($param1=="science_technology")
                $this->db->where('cats', 'sci-tech')->or_where('cats', 'science_technology');
            else
                $this->db->where("$srchs1");
                //$this->db->where('cats', $param1);
        }
        if($param2!=''){
            if(strtolower($param2)=='sport')
                $this->db->where("$srchs");
            else if($param2=="science_technology")
                $this->db->where('cats', 'sci-tech')->or_where('cats', 'science_technology');
            else
                $this->db->where("$srchs2");
                //$this->db->or_where('cats', $param2);
        }

        if($param2=='Lifestyle'){
            $this->db->where('cats', 'Lifestyle')->or_where('cats', 'Events');
        }

        if($param2=='Entertainment'){
            $this->db->where('cats', 'Entertainment');
            $this->db->where('cats', 'Movies & TV')->or_where('cats', 'Style');
            $this->db->where('cats', 'Nollywood')->or_where('cats', 'Music');
            $this->db->where('cats', 'Weddings')->or_where('cats', 'Scoop');
        }

        $this->db->where('files !=', '')->where('cats !=', 'BN TV');

        if($offset!="")
            $this->db->limit($offset, $limit);
        else
            $this->db->limit($limit);

        if($param1=='' && $param2==''){
            if($sorts=="views")
                $this->db->order_by('views', 'desc');
            else
                $this->db->order_by('id', 'desc');
        }else{
            $this->db->order_by('id', 'desc');
        }

        $this->db->group_by('titles');

        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }



    function insert_comments($data, $txtreply_id){
        if($txtreply_id=="")
            $query1 = $this->db->insert('blog_comments', $data);
        else
            $query1 = $this->db->insert('blog_replies', $data);
        return ($query1) ? true : false;
    }


    function recentNewsHeadlines(){
        $this->db->select('id, titles, cats, links')->from('all_news');
        $this->db->limit(8);
        $this->db->order_by('views', 'desc');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    
    function get_Cats(){
        $this->db->select('cats')->from('all_news')->where('cats !=', 'sport');
        $this->db->order_by('views', 'desc');
        $this->db->group_by('cats');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }



    function fetchComments($blogid){
        $this->db->select('*')->from('blog_comments')->where('newsid', $blogid);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    function fetchReplies($rep_id, $limits){
        $this->db->select('*')->from('blog_replies')->where('comments_id', $rep_id);
        $this->db->order_by('id', 'desc');
        if($limits!="") $this->db->limit($limits);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    function fetchRepliesCount($rep_id){
        $this->db->from('blog_replies')->where('comments_id', $rep_id);
        return $this->db->count_all_results();
    }



    function countComments($blog_id){
        $this->db->select('count(bc.id) as allcount')->from('blog_comments bc')->where('bc.newsid', $blog_id);
        $this->db->join('all_news', 'all_news.id = bc.newsid');
        $query = $this->db->get();
        $result = $query->result_array();
        return ($result ? $result[0]['allcount'] : 0);
    }


    function sponsoredAD(){
        $this->db->select('image, positn, links')->from('adverts')->where('expiry >', time());
        $this->db->limit(2);
        $this->db->order_by('rand()');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }



    function fetchNewsSingle($id){
        $this->db->select('id, titles, cats, files, links, views, contents, date_posted')->from('all_news')->where('id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }


    function NewsUpdate(){
        $this->db->select('hour_timings')->from('process_news');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $next_update = $query->row('hour_timings');
            return @date("D jS M, Y h:i a", $next_update);

        }else{
            return false;
        }
    }


    function update_password($new_pass, $oldpass){
        $this->db->select('id')->from('admin_tbls');
        $this->db->where('pass1', $oldpass);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $this->db->where('pass1', $oldpass);
            $this->db->set('pass1', $new_pass);
            $this->db->update('admin_tbls');
            return true;
        }else{
            return false;
        }
    }


    function fetchEachCatsCounts($search, $keywords, $cats){
        if($cats=="metro-news") $cats="Metro News";
        if(isset($search) && $search=="search" && $keywords!=""){
            $srchs = "(titles like '%$keywords%' OR cats like '%$keywords%' OR contents like '%$keywords%')";
            //$this->db->where("$srchs");
            //return $this->db->from("all_news")->where("$srchs")->group_by('titles')->count_all_results();
        }else{
            if($cats == "science-technology"){
                $srchs = "(titles like '%science_technology%' OR cats like '%sci-tech%')";
                //$this->db->where("$srchs");
                //return $this->db->from("all_news")->where("$srchs")->group_by('titles')->count_all_results();
            }else{
                $srchs = "(cats like '%$cats%')";
                //return $this->db->from("all_news")->where("$srchs")->group_by('titles')->count_all_results();
            }
        }
        $query = $this->db->query("SELECT DISTINCT(titles), id, cats, files, links, views, date_posted FROM all_news WHERE files!='' AND $srchs GROUP BY titles");

        if($query->num_rows() > 0){
            return $query->num_rows();
        }else{
            return 0;
        }
    }



    function fetchEachCatsCounts_cats($search, $keywords, $cats){
        
        if($cats=="metro-news") $cats="Metro News";
        if($cats=="sports") $cats="sport";
        $this->db->select('id, titles, cats, files, links, views, date_posted')->from('all_news');

        if(isset($search) && $search=="search" && $keywords!=""){
            $srchs = "(titles like '%$keywords%' OR cats like '%$keywords%')";
            $this->db->where("$srchs");
        }else{
            if($cats == "science-technology"){
                $srchs = "(titles like '%science_technology%' OR cats like '%sci-tech%')";
                $this->db->where("$srchs");
            }else{
                $srchs = "(cats like '%$cats%')";
                $this->db->where("$srchs");
            }
        }
        $this->db->where('files !=', '');
        
        $this->db->order_by('date_posted', 'desc');
        $this->db->group_by('titles');

        $query = $this->db->get();
        if($query->num_rows() > 0){
            return count($query->result_array());
        }else{
            return false;
        }
    }

    
    function fetchNewsCat($search, $keywords, $cats, $page){
        $offset = 14*$page;
        $limit = 14;
        $cats = str_replace("-", " ", $cats);
        if($cats=="sports") $cats="sport";
        //if($cats=="mobile-leadstory") $cats="mobile-leadstory";
        //$this->db->select('id, titles, cats, files, links, views, date_posted')->from('all_news');
        //$selects = "SELECT id, cats, files, links, views, date_posted, DISTINCT titles";
        //$this->db->select('id, titles, cats, files, links, views, date_posted')->from('all_news');
        //$this->db->distinct('titles_');
        //echo $cats." mmm"; exit;

        if(isset($search) && $search=="search" && $keywords!=""){
            $srchs = "(titles like '%$keywords%' OR cats like '%$keywords%')";
            //$this->db->where("$srchs");

        }else{

            // if($cats == "science-technology"){
            //     $srchs = "(cats like '%science_technology%' OR cats like '%sci-tech%')";
            //     //$this->db->where("$srchs");

            if($cats == "in-pictures"){
                //$this->db->where('cats', 'in pictures');
                $srchs = "(cats='in pictures')";

            }else if($cats=='lifestyle'){
                $srchs = "(cats='Lifestyle' OR cats='Events')";

            }else if($cats=='sport'){
                $srchs = "(cats like '%sport%' OR cats like '%football%')";

            }else if($cats=='entertainment'){
                $srchs = "(cats='Entertainment' OR cats='Style' OR cats='Movies & TV' OR cats='Music' OR cats='Nollywood' OR cats='Scoop' OR cats='Weddings')";

            }else{
                //$this->db->where('cats', $cats);
                $srchs = "(cats like '%$cats%')";
                //$this->db->where("$srchs");
            }
        }
        //$this->db->where('files !=', '');

        $query = $this->db->query("SELECT DISTINCT(titles), id, cats, files, links, views, date_posted FROM all_news WHERE files!='' AND $srchs GROUP BY titles ORDER BY id DESC LIMIT $offset, $limit");
        
        //$this->db->limit($limit, $offset);
        //$this->db->order_by('date_posted', 'desc');
        //$this->db->group_by('titles');

        //$query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    function fetchEachCats(){
        $this->db->select('cats')->from('all_news');
        $this->db->distinct();
        $this->db->where('cats !=', 'mobile-leadstory')->where('cats !=', 'This week in 1994');
        $this->db->where('cats !=', 'Democracy Gauge stories')->where('cats !=', 'South Africa');
        $this->db->where('cats !=', 'BN TV')->where('cats !=', 'Uncategorized')->where('cats !=', 'Football');
        $this->db->order_by('cats', 'asc');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    function delete_pics($file1){
        $in_folder1 = "news_files/".$file1;
        if(is_readable($in_folder1)){
            @unlink($in_folder1);
            return true;
        }else{
            return false;
        }
    }



    function updateViews1($id){
        $this->db->where('id', $id);
        $this->db->set('views', 'views+1', FALSE);
        $this->db->update('all_news');
    }


    function validate_adminx(){
        $admin_type = $this->input->cookie('admin_type', TRUE);
        $adm_uname = $this->input->cookie('adm_username_afnu', TRUE);
        $adm_pass = $this->input->cookie('adm_password_afnu', TRUE);
        if(isset($adm_pass) && $adm_pass!=''){
            $this->db->select('id')->from('admin_tbls')->where('pass1', $adm_pass)->where('sha1(uname)', $adm_uname);
            $query = $this->db->get();
            if($query->num_rows() > 0){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }


    function totalCounts($tbl){
        $this->db->from($tbl);
        return $this->db->count_all_results();
    }


    function auth_details($users, $passwords){
        $this->db->select('id')->from('admin_tbls')->where('pass1', sha1($passwords))->where('uname', $users);
        $now = 865000;
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $cookie = array(
                'name'   => 'adm_username_afnu',
                'value'  => sha1($users),
                'expire' => $now,
                'secure' => FALSE
            );
            $cookie1 = array(
                'name'   => 'adm_password_afnu',
                'value'  => sha1($passwords),
                'expire' => $now,
                'secure' => FALSE
            );
            set_cookie($cookie);
            set_cookie($cookie1);
            return true;
        }else{
            return false;
        }
    }


    function fetchRelatedPosts($cats, $newsid, $titles){
        if($cats=="this-week") $cats="This week in 1994";
        if($cats=="democracy") $cats="Democracy Gauge stories";
        if($cats=="sports") $cats="sport";
        $this->db->select('id, titles, cats, files, links, views, date_posted')->from('all_news');
        $this->db->where('cats', $cats)->where('id !=', $newsid);//->where_not('titles', LIKE, '%$titles%');
        $this->db->order_by('id', 'desc');
        $this->db->group_by('titles');
        $this->db->limit(4);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    
    function fetchLast10Records($tbl){
        if($tbl=="adverts"){
            $this->db->select('image, expiry, durations, created_at')->from('adverts');
            $this->db->limit(4);
        }else{
            $this->db->select('id, titles, cats, date_posted')->from('all_news');
            $this->db->limit(8);
        }
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }




    function record_visitors($ipaddr){
        $this->db->select('ipaddrs')->from('visitors')->where('ipaddrs', $ipaddr);
        $query = $this->db->get();
        if($query->num_rows() <= 0){
            $data = array(
                'ipaddrs'  => $ipaddr
            );
            $this->db->insert('visitors', $data);
        }
        return true;
    }

    
    

    
    var $order_column = array(null, "*");


    function make_datatables($tbls, $params, $params2){
        $this->fetchUsers($tbls, $params, $params2);
        if($_POST["length"] != -1){
            $this->db->limit($_POST["length"], $_POST["start"]);
        }
        $query = $this->db->get();
        return $query->result();
    }
    

    public function get_filtered_data($tbls, $params){
        $this->fetchUsers($tbls, '', '');
        if($params!="" && $params>0)
            $this->db->where('id', $params);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_all_data($tbls, $params){
        $this->db->select("*");
        $this->db->from($tbls);
        if($params!="" && $params>0)
            $this->db->where('id', $params);
        return $this->db->count_all_results();
    }



    function fetchUsers($tbls, $params, $params2){
        $nowtime = time();
        $txtsrchs = $_POST['search']['value'];

        if($tbls=="all_news"){
            $this->db->select('*');
            $this->db->from($tbls);
            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(titles like '%$txtsrchs%' OR contents like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            $this->db->order_by('id', 'desc');
        }

        if($tbls=="adverts"){
            $this->db->select('*');
            $this->db->from($tbls);
            $this->db->order_by('id', 'desc');
        }
    }



    public function check_link($url, $tbl){
        $this->db->select('id');
        $this->db->from($tbl);
        $this->db->where('md5(id)', $url);
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return true;
        else
            return false;
    }


    function get_ID($id, $tbl){
        $this->db->select('*')->from($tbl)->where('md5(id)', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }


    function deleteTblRecords($txt_dbase_table, $txtall_id){
        if($txt_dbase_table == "viewNews"){

            $this->db->select('id, files')->from('all_news')->where('id', $txtall_id);
            $query = $this->db->get();
            $id1 = $query->row('id');
            $files = $query->row('files');
            $in_folder1="news_files/$files";
            if(is_readable($in_folder1)) @unlink($in_folder1);

            $this->db->where('id', $txtall_id);
            $query = $this->db->delete('all_news');
        }


        if($txt_dbase_table == "view_advert"){
            $this->db->select('image')->from('adverts')->where('id', $txtall_id);
            $query1 = $this->db->get();
            $files1 = $query1->row('image');

            $in_folder1="sponsoredads/$files1";
            if(is_readable($in_folder1)) @unlink($in_folder1);

            $this->db->where('id', $txtall_id);
            $this->db->delete('adverts');
        }

        if($query) return true; else return false;
    }

    

}

?>