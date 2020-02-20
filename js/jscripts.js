
$(document).ready( function () {

  var site_urls = $("#txtsite_url").val();
  var txtpage_name = $("#txtpage_name").val();
  if(txtpage_name=="" || txtpage_name=="media"){
    $.ajax({
      type : "POST",
      url : site_urls+"node/storeNewsFromSource",
      cache : false,
      success : function(data){
      },error : function(data){
      }
    });
  }

  var dates = new Date().getFullYear();

  // var ad = $("#adsense").html();
  // $("#adslot").html(ad);


  var txtnewscnt = $("#txtnewscnt").val();  
  if(txtnewscnt<=14){
    $('.load_more_bt').hide();
    $('#load_more_mba1').html('<font style="color:#999 !important;">No more news!</font>').show();
  }


  $(document).keydown(function(e){
    var code = (e.keyCode ? e.keyCode : e.which);
    var txt_srch = $('#txt_srch').val();
    txt_srch = txt_srch.replace(/\s+/g, '-').toLowerCase();

    if(code == 13 && txt_srch!=""){ // enter
      window.location = site_urls+"media/search/"+txt_srch+"/";
    }
  });



  $(".post_comment").click(function(){
    var self = this;
    $(".alert_msg1").hide();
    var ccount = $("#cmtcnt").val();
    ccount = parseInt(ccount)+1;

    var txtblogid = $('#txtblogid').val();
    var txtreply_id = $('#txtreply_id').val();

    $(self).attr('disabled', true).css({'background': '#FFA275', 'color': '#ccc'});
    $.ajax({
      type : "POST",
      url : site_urls+"node/post_comments",
      data: $("#form_comments").serialize(),
      success : function(data){
        if(data=="inserted"){
          //$("#form_comments")[0].reset();
          $('#txtreply_id').val('');
          $('#txtcmessage').val('');

          $(".alert_msg1").hide();
          $("#cmtcnt").val(ccount);
          $(".cmt_counts").html(ccount);

          $("html, body").animate({scrollTop:$('.comment_section').offset().top-150}, 400);
          
          refreshComments(txtblogid);
        }else{
          $(".alert_msg1").show().html('<div class="Errormsg">'+data+'</div>');
        }

        $(self).removeAttr('disabled').css({'background': '#f7631b', 'color': '#fff'});
        setTimeout(function(){
          $(".alert_msg1").fadeOut('slow');
        },2500);

      },error : function(data){
          $(self).removeAttr('disabled').css({'background': '#f7631b', 'color': '#fff'});
          $(".alert_msg1").show().html('<div class="Errormsg">Poor Network Connection!</div>');
      }
    });
  });



  function refreshComments($id){
    var datastring='blog_id='+$id;
    $.ajax({
      type : "POST",
      url : site_urls+"node/bring_blog_id_comments",
      data: datastring,
      success : function(data){
          $('.all_comments').html(data);
      }
    });
  }


  

  $('.link_reply').click(function(){
    var id = $(this).attr("id");
    $("#txtreply_id").val(id);
    $("html, body").animate({scrollTop:$('.leave_comment').offset().top-40}, "slow");
  });



  $('#load_more_mba').click(function(){
    var page = $(this).data('val');
    var txtpg_name = $("#txtpg_name").val();

    $('#load_more_mba').hide();
    $('#load_more_mba1').show();
    var datastring='page='+page
    +'&txtpg_name='+txtpg_name;
    
    $.ajax({
      type : "POST",
      url : site_urls+"node/getMoreNews",
      data : datastring,
      cache : false,
      success : function(data){
        var responseReturn = data.match(/Posted/g);
        if(responseReturn != null){
          $("#ajax_table_bma").append(data);
          $('.load_more_bt').data('val', ($('.load_more_bt').data('val')+1));
          $('#load_more_mba').show();
          $('#load_more_mba1').hide();
        }else{
          $('#load_more_mba').hide();
          $('#load_more_mba1').show();
          $('.load_more_bt, .load_more_bma1').html('<font style="color:#999 !important;">No more news!</font>');
        }

      },error : function(data){
        $('#load_more_mba').show();
        $('#load_more_mba1').hide();
      }
    });
  });



  $('body').on('click', '.cmd_send_msg', function (e) {
      e.preventDefault();
      var self = this;
      $(".alert_msg1").hide();
      
      $(self).attr('disabled', true).css({'background': '#FFA275', 'color': '#ccc'});
      
      $.ajax({
        type : "POST",
        url : site_urls+"node/send_email_to_admin",
        data: $(".from_contact").serialize(),
        success : function(data){

          if(data=="email_sent"){
            $(self).removeAttr('disabled').css({'background': '#f7631b', 'color': '#fff'});
            
            $(".alert_msg1").show().html('<div style="text-align:center">Your message has been sent!</div>').removeClass('alert-danger').addClass('alert-success');
            $(".from_contact")[0].reset();
            
            setTimeout(function(){
              $(".alert_msg1").hide();
            },2500);
          
          }else{
            $(self).removeAttr('disabled').css({'background': '#f7631b', 'color': '#fff'});
            $(".alert_msg1").show().html('<div class="Errormsg">'+data+'</div>').removeClass('alert-success').addClass('alert-danger');
          }

        },error : function(data){
            $(self).removeAttr('disabled').css({'background': '#f7631b', 'color': '#fff'});
            $(".alert_msg1").show().html('<div class="Errormsg">Poor Network Connection!</div>').removeClass('alert-success').addClass('alert-danger');
        }
      });
  });



  $('body').on('click', '#cmd_update_pass_admin', function (e) {
    e.preventDefault();
    var self = this;
    $(".alert_msg1").hide();
    
    $(self).attr('disabled', true).css({'background': '#FFA275', 'color': '#ccc'});
    
    $.ajax({
      type : "POST",
      url : site_urls+"node/update_my_pass",
      data: $("#edit_pass").serialize(),
      success : function(data){

        if(data=="pass1_updated"){
          $(self).removeAttr('disabled').css({'background': '#f7631b', 'color': '#fff'});
          
          $(".alert_msg1").show().html('<div style="text-align:center">Your password has been updated!</div>').removeClass('alert-danger').addClass('alert-success');
          $("#edit_pass")[0].reset();
          
          setTimeout(function(){
            $(".alert_msg1").hide();
          },2500);
        
        }else{
          $(self).removeAttr('disabled').css({'background': '#f7631b', 'color': '#fff'});
          $(".alert_msg1").show().html('<div class="Errormsg">'+data+'</div>');
        }

      },error : function(data){
          $(self).removeAttr('disabled').css({'background': '#f7631b', 'color': '#fff'});
          $(".alert_msg1").show().html('<div class="Errormsg">Poor Network Connection!</div>');
      }
    });
  });


  $(window).scroll(function() {
      if ($(this).scrollTop() >= 300) {
        $(".links2").hide();
        $(".while_logo1").slideDown();
      }else{
        $(".links2").fadeIn();
        $(".while_logo1").hide();
      }
  });


  if ($(window).scrollTop() >= 300) {
    $(".links2").hide();
    $(".while_logo1").slideDown();
  }else{
    $(".links2").fadeIn();
    $(".while_logo1").hide();
  }


  
  $(".right-area .fa-search").click(function(){
    $(this).hide();
    $(".right-area .fa-close").show();
  });

  $(".right-area .fa-close").click(function(){
    $(this).hide();
    $(".right-area .fa-search").show();
  });


  $(".cmd_login_admin").click(function(){
    var self = this;
    $(self).attr('disabled', true).css({'background': '#219864', 'color': '#ccc'});
    $(".alert_msg").hide();
    $.ajax({
        type : "POST",
        url : site_urls+"node/logme_adms",
        data: $(".login_form").serialize(),
        success : function(data){
          if(data=="successor1"){
              setTimeout(function(){
                $(".alert_msg").fadeOut('slow');
              },2500);

              window.location = site_urls+"admin/";
              $(self).removeAttr('disabled').css({'background': '#219864', 'color': '#fff'});

          }else{
              $(self).removeAttr('disabled').css({'background': '#219864', 'color': '#fff'});
              $(".alert_msg").show().html('<div class="Errormsg">'+data+'</div>');
          }

        },error : function(data){
            $(self).removeAttr('disabled').css({'background': '#219864', 'color': '#fff'});
            $(".alert_msg").show().html('<div class="Errormsg">'+data+'</div>');
        }
    });
  });



  $("#upload_adv_form").on('submit',(function(e) {
    e.preventDefault();
    $(".alert_msg").hide();
    $('#cmd_upload_ad').attr('disabled', true).css({'background': '#FFA275', 'color': '#ccc'});
    $(".alert_msg").hide();
    var adv_id = $("#adv_id").val();
    
    $.ajax({
      url : site_urls+"node/upload_adverts",
      type: "POST",
      data: new FormData(this),
      contentType: false, 
      cache: false,
      processData:false,
      success: function(data){
        if(data=="uploaded"){
          $('#cmd_upload_ad').removeAttr('disabled').css({'background': '#f7631b', 'color': '#fff'});
          if(adv_id=="")
            $("#upload_adv_form")[0].reset();

          $('.first_create_form').hide();
          $('.success_form').slideDown('fast');

          setTimeout(function(){
            $(".alert_msg").hide();
          },2500);
        }else{
          $(".alert_msg").show().html('<div class="Errormsg">'+data+'</div>');
        }

        $('#cmd_upload_ad').removeAttr('disabled').css({'background': '#f7631b', 'color': '#fff'});
      
      },error : function(data){
        alert('Error! Network Connection Failed!');
        $('#cmd_upload_ad').removeAttr('disabled').css({'background': '#f7631b', 'color': '#fff'});
      }
    });
  }));



  $(".uploadnews").on('submit',(function(e) {
    e.preventDefault();
    $(".alert_msg").hide();
    $('#cmd_upload_media').attr('disabled', true).css({'background': '#FFA275', 'color': '#ccc'});
    $(".alert_msg").hide();
    $blogid = $("#blogid").val();
    
    $.ajax({
      url : site_urls+"node/upload_blogpost",
      type: "POST",
      data: new FormData(this),
      contentType: false, 
      cache: false,
      processData:false,
      success: function(data){
        if(data.trim()=="uploaded"){
          $('#cmd_upload_media').removeAttr('disabled').css({'background': '#f7631b', 'color': '#fff'});
          if($blogid == ""){
            $(".uploadnews")[0].reset();
            quill.setText('');
          }

          $('.first_create_form').hide();
          $('.third_create_form').slideDown('fast');

          setTimeout(function(){
            $(".alert_msg").hide();
          },2500);

        }else{
          $(".alert_msg").show().html('<div class="Errormsg">'+data+'</div>');
        }

        $('#cmd_upload_media').removeAttr('disabled').css({'background': '#f7631b', 'color': '#fff'});
      
      },error : function(data){
        alert('Error! Network Connection Failed!');
        $('#cmd_upload_media').removeAttr('disabled').css({'background': '#f7631b', 'color': '#fff'});
      }
    });
  }));


  $('body').on('click', '#cmd_goto_firstform', function () {
    $('.third_create_form').hide();
    $('.first_create_form').fadeIn('fast');
  });



  var myEditor = document.querySelector('#editor');
  if(myEditor != null){
    var editor_html = myEditor.children[0].innerHTML;
    var editor = $("#txtdescrip").val(editor_html);
  }



  
  $('body').on('blur, keyup, focusout', '#editor', function () {
    var myEditor = document.querySelector('#editor');
    var editor_html = myEditor.children[0].innerHTML;
    var editor = $("#txtdescrip").val(editor_html);
  });



  function readURL(input, idf){
    if(input.files && input.files[0]){
      var reader = new FileReader();
      reader.onload=function(e){
        $(idf).attr('src',e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }



  $('body').on('change', '#txtimage', function () {
    var fls = $("#txtimage").val();
    var fileExtension = ['jpeg', 'jpg', 'png'];
    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
      alert("Formats allowed are : "+fileExtension.join(', '));
      $("#txtimage").val('');
      return false;
    }
  });


  $('body').on('change', '#blog_img', function () {
    var fls = $("#blog_img").val();
    var fileExtension = ['jpeg', 'jpg', 'png', 'mp4'];
    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
      alert("Formats allowed are : "+fileExtension.join(', '));
      $("#blog_img").val('');
      return false;
    }
  });



  $('body').on('click', '.all_pagn a', function (e) {
    e.preventDefault();
    var self = $(this);
    var pageNum = self.attr('data-ci-pagination-page');
    
    $(".loaders").show();
    var cats = retrieve_cookie('cats');
    var keywords = retrieve_cookie('keywords');

    var datastring='cats='+cats
    +'&keywords='+keywords;
    $.ajax({
      url: site_urls+'node/pg/'+pageNum,
      type: 'post',
      data: datastring,
      success: function(responseData){
        $(".loaders").hide();
        $('.cntr_div').html(responseData);
        $("html, body").animate({scrollTop: $('.cntr_div').offset().top-200 }, 1);
      },error: function(responseData){
        $(".loaders").hide();
      }
    });
  });




function marquee(a, b) {
  var width = b.width()+300;
  var start_pos = a.width();
  var end_pos = -width;

  function scroll() {
    if (b.position().left <= -width) {
        b.css('left', start_pos);
        scroll();
    }
    else {
        time = (parseInt(b.position().left, 10) - end_pos) *
            (30000 / (start_pos - end_pos)); // Increase or decrease speed by changing value 10000
        b.animate({
            'left': -width
        }, time, 'linear', function() {
            scroll();
        });
    }
  }

  b.css({
      'width': width,
      'left': start_pos
  });
  scroll(a, b);
  
  b.mouseenter(function() {     // Remove these lines
      b.stop();                 //
      b.clearQueue();           // if you don't want
  });                           //
  b.mouseleave(function() {     // marquee to pause
      scroll(a, b);             //
  });                           // on mouse over    
}

if(txtpage_name==""){
  marquee($('#displays'), $('#texts'));
}


  $('.cmd_search_center').click(function(){
    var txtprogs = $(".txtprogs").val();
    var txtkeywd = $(".txtkeywd").val();
    if(txtprogs!="" || txtkeywd!=""){

      create_cookie('keywords', txtkeywd);
      create_cookie('cats', txtprogs);
      var pageNum = 0;

      $(".cntr_div").empty().html('<div style="text-align:center;" class="col-lg-8"><img src="'+site_urls+'images/loaderq.gif"></div>');

      var datastring='cats='+txtprogs
      +'&keywords='+txtkeywd;

      $.ajax({
        url: site_urls+'node/pg/'+pageNum,
        type: 'post',
        data: datastring,
        success: function(responseData){
          $('.search_contents').slideToggle('slow'); // slide up
          $(".loaders").hide();
          $('.cntr_div').html(responseData);
          //$("html, body").animate({scrollTop: $('.cntr_div').offset().top-200 }, 1);
        },error: function(responseData){
          $(".loaders").hide();
        }
      });
    }
  }); 


  
  $('.filters').click(function(){
    $('.search_contents').slideToggle('slow');
  });


  $('body').on('click', '.btn_delete', function () {
    $('#delete_dv').show();
    var for_id = $(this).attr("for_id");
    var for_page = $(this).attr("for_page");
    $('#txtall_id').val(for_id);
    $('#txtall_page').val(for_page);
  });


  
  $('body').on('click', '.edit_btn', function () {
    var ids = $(this).attr("id");
    var txtmem = $(this).attr("txtmem");
    if(txtmem!="")
      window.location = site_urls+"dashboard/edit-center/"+ids+"/";
    else
      window.location = site_urls+"admin/edit_center/"+ids+"/";
  });
  $('body').on('click', '.cmd_remove_adm', function () {
    var txtall_id = $("#txtall_id").val();
    var txt_dbase_table = $("#txt_dbase_table").val();
    var self = this;
    
    $(self).attr('disabled', true).css({'background': '#FFA275', 'color': '#ccc'});
    var datastring='txtall_id='+txtall_id
    +'&txt_dbase_table='+txt_dbase_table;

    $.ajax({
      type: "POST",
      url : site_urls+"node/delete_records",
      data: datastring,
      cache: false,
      success: function(html){
        $(self).removeAttr('disabled').css({'background': '#f7631b', 'color': '#fff'});
        
        dataTable.clear().draw();
        dataTable.rows.add(NewlyCreatedData);
        dataTable.columns.adjust().draw();
      
      },error : function(html){
        alert('Error! Network Connection Failed!');
        $(self).removeAttr('disabled').css({'background': '#f7631b', 'color': '#fff'});
      }
    });
  });
  $("footer div div ul div").html('Copyright &copy; '+dates+' SkyNewsNG. Website by <a href="mailto:donchibobo@gmail.com" class="color-primary_j">CATech</a><br>Sources from <a href="https://www.informationng.com/" target="_blank" class="color-primary_j">informationng.com</a>, <a href="https://www.bellanaija.com/" target="_blank" class="color-primary_j">bellanaija.com</a>, <a href="https://www.channelstv.com" target="_blank" class="color-primary_j">channelstv.com</a> & <a href="https://www.africanews.com/" target="_blank" class="color-primary_j">africanews.com</a>');
  $('body').on('click', '.edit_news', function () {
    var ids = $(this).attr("id");
    window.location = site_urls+"admin/edit_news/"+ids+"/";
  });
  $('body').on('click', '.delete_imgs', function () {
    $ids = $(this).attr('ids');
    $files = $(this).attr('files');
    
    if(confirm('Proceed to delete this image?')){
      $('#delete_imgs'+$ids).removeClass('delete_imgs').addClass("disable_btn");

      var datastring='ids='+$ids
      +'&files='+$files;

      $.ajax({
        type: "POST",
        url : site_urls+"node/delete_images",
        data: datastring,
        cache: false,
        success: function(html){
          $('#delete_imgs'+$ids).removeClass('disable_btn').addClass("delete_imgs");
          $('.update_imgs2'+$ids).slideUp('slow');
        },error : function(html){
          alert('Error! Network Connection Failed!');
          $('#delete_imgs'+$ids).removeClass('disable_btn').addClass("delete_imgs");
        }
      });
    }
  });
  



  $('body').on('click', '.view_changes_ad', function () {
    window.location = site_urls+"admin/view_advert/";
  });


  $('body').on('click', '.edit_adv', function () {
    var ids = $(this).attr("id");
    window.location = site_urls+"admin/edit_advert/"+ids+"/";
  });


  $('body').on('click', '#cmd_back_tofirst', function () {
    $('.success_form').hide();
    $('.first_create_form').fadeIn('fast');
  });




  function create_cookie(name, value, days2expire, path) {
    var date = new Date();
    date.setTime(date.getTime() + (days2expire * 24 * 60 * 60 * 1000));
    var expires = date.toUTCString();
    document.cookie = name + '=' + value + ';' +
                     'expires=' + expires + ';' +
                     'path=' + path + ';';
  }


  function retrieve_cookie(name) {
    var cookie_value = "",
      current_cookie = "",
      name_expr = name + "=",
      all_cookies = document.cookie.split(';'),
      n = all_cookies.length;
   
    for(var i = 0; i < n; i++) {
      current_cookie = all_cookies[i].trim();
      if(current_cookie.indexOf(name_expr) == 0) {
        cookie_value = current_cookie.substring(name_expr.length, current_cookie.length);
        break;
      }
    }
    return cookie_value;
  }




});