<?php
/*
 * hook_form
 */
 function reviews_system_review_form(&$form_state) {
     $nid = arg(2);
     $max_length = 600;
     
     global $user;

     
     $form['rate_this_experience'] = array(
        '#type' => 'fieldset',
        '#title' => t('Rate this exprience'),
        '#collapsible' => TRUE,
        '#collapsed' => FALSE,
     );
     $form['rate_this_experience']['overall_rating'] = array(
        '#type' => 'hidden',
        '#title' => t(''),
        '#required' => FALSE,
        '#default_value' => "",
        '#description' => "",
        '#size' => 20,
        '#maxlength' => 20,
    );
     $form['rate_this_experience']['quality'] = array(
        '#type' => 'hidden',
        '#title' => t(''),
        '#required' => FALSE,
        '#default_value' => "",
        '#description' => "",
        '#size' => 20,
        '#maxlength' => 20,
    );
    $form['rate_this_experience']['services_screw'] = array(
        '#type' => 'hidden',
        '#title' => t(''),
        '#required' => FALSE,
        '#default_value' => "",
        '#description' => "",
        '#size' => 20,
        '#maxlength' => 20,
    );
    $form['rate_this_experience']['value_for_money'] = array(
        '#type' => 'hidden',
        '#title' => t(''),
        '#required' => FALSE,
        '#default_value' => "",
        '#description' => "",
        '#size' => 20,
        '#maxlength' => 20,
    );
    $form['rate_this_experience']['star_experiences'] = array(
        '#type' => 'hidden',
        '#title' => t(''),
        '#required' => FALSE,
        '#default_value' => "",
        '#description' => "Quality Rating.",
        '#size' => 20,
        '#maxlength' => 20,
    );
    $form['write_your_review'] = array(
        '#type' => 'fieldset',
        '#title' => t('Write your review'),
        '#collapsible' => FALSE,
        '#collapsed' => FALSE,
        '#attributes' => array('id'=>"write_review"),
        //'#prefix' => '<div class="write_review">',
        //'#suffix' => '</div>',
    );
    $form['write_your_review']['title'] = array(
        '#type' => 'textfield',
        '#title' => t('Title'),
        '#required' => TRUE,
        '#default_value' => "",
        '#description' => "",
        '#size' => 35,
        '#maxlength' => 40,
    );
    $form['write_your_review']['body'] = array(
        '#type' => 'textarea',
        '#title' => t('Your review'),
        '#required' => TRUE,
        '#default_value' => "",
        '#description' => "Characters Limit : <span id='countdown'>600</span>",
        '#rows' => "5",
        '#cols' => "30",
        '#size' => "30",
        '#resizable' => True,
        '#attributes' => array('onKeyDown'=>"limitText(this,600);", 'onKeyUp'=>"limitText(this,600);"),
        /*'#suffix' => '<div class="help-text">Thanks for reviewing this product. All reviews must comply with the terms of the site.<br />
                     Please take the below into consideration when leaving your review to ensure your review is published.<br />
                     Talk about your experience, the staff, the activity, the price<br />
                     Do not talk about other travellers, travel shops or other websites<br />
                     No HTML links, swearing or derogatory remarks, or inappropriate images.
                     </div>',*/
    );
    $form['write_your_review']['nid'] = array(
        '#type' => 'hidden',
        '#title' => t(''),
        '#required' => FALSE,
        '#default_value' => $nid,
        '#description' => "",
        '#size' => 20,
        '#maxlength' => 20,
    );
    $form['share_your_pics'] = array(
        '#type' => 'fieldset',
        '#title' => t('Pictures tell a 1000 words! Share yours <span> (Optional) </span>'),
        '#collapsible' => FALSE,
        '#collapsed' => FALSE,
        '#prefix' => '<div class="share_images">',
        '#suffix' => '</div>',
    );
    $form['share_your_pics']['image1'] = array(
        '#type' => 'file',
        '#title' => t('Image 1'),
        '#default_value' => '',
    );
    $form['share_your_pics']['image1_title'] = array(
        '#type' => 'textfield',
        '#title' => t('Image1 Title'),
        '#required' => FALSE,
        '#default_value' => "",
        '#description' => "",
        '#size' => 30,
        '#maxlength' => 40,
    );
    $form['share_your_pics']['image2'] = array(
        '#type' => 'file',
        '#title' => t('Image 2'),
        '#default_value' => '',
    );
    $form['share_your_pics']['image2_title'] = array(
        '#type' => 'textfield',
        '#title' => t('Image2 Title'),
        '#required' => FALSE,
        '#default_value' => "",
        '#description' => "",
        '#size' => 30,
        '#maxlength' => 40,
    );
    $form['share_your_pics']['image3'] = array(
        '#type' => 'file',
        '#title' => t('Image 3'),
        '#default_value' => $node->image,
    );
    $form['share_your_pics']['image3_title'] = array(
        '#type' => 'textfield',
        '#title' => t('Image3 Title'),
        '#required' => FALSE,
        '#default_value' => "",
        '#description' => "",
        '#size' => 30,
        '#maxlength' => 40,
    );
    $form['tell_us'] = array(
        '#type' => 'fieldset',
        '#title' => t('Tell us a bit about yourself'),
        '#collapsible' => FALSE,
        '#collapsed' => FALSE,
        '#prefix' => '<div class="share_images">',
        '#suffix' => '</div>',
     );
     
    /*$form['tell_us']['user_name'] = array(
        '#type' => 'textfield',
        '#title' => t('Your Name'),
        '#required' => FALSE,
        '#default_value' => "",
        '#description' => "",
        '#size' => 20,
        '#maxlength' => 40,
    );*/
    $form['tell_us']['location'] = array(
        '#type' => 'textfield',
        '#title' => t('Location'),
        '#required' => FALSE,
        '#default_value' => "",
        '#description' => "",
        '#size' => 20,
        '#maxlength' => 40,
    );
    $form['tell_us']['age'] = array(
        '#type' => 'select',
        '#title' => t('How old are you?'),
        '#required' => FALSE,
        '#options' => array('' => '','17 or under' => '17 or under','18 +' => '18 +','21 +' => '21 +','25 +' => '25 +','35 +' => '35 +','50 +' => '50 +'),
        '#default_value' => "",
        '#description' => "",
        
    );
    $form['tell_us']['gender'] = array(
        '#type' => 'select',
        '#title' => t('Are you male or female?'),
        '#required' => FALSE,
        '#options' => array('' => '','male' => 'Male','female'=>'Female'),
        '#default_value' => "",
        '#description' => "",
    );
    /*$form['tell_us']['email'] = array(
        '#type' => 'textfield',
        '#title' => t('Your email'),
        '#required' => TRUE,
        '#default_value' => "",
        '#description' => "",
        '#size' => 40,
        '#maxlength' => 50,
        '#element_validate' => array('reviews_system_email_element_validate'),
    ); */
    $form['#attributes'] = array('enctype' => "multipart/form-data");
    
    //print_r($user);
    
    //if($user->uid == 0) {
//        $form['#redirect'] = array('user/login', drupal_get_destination());;
//    }
    
    $form['submit'] = array(
        '#type' => 'submit',
        '#value' => 'Submit',
    );
    
    return $form;
 }
 /*
 * hook_review_form_validate
 */
 function reviews_system_review_form_validate($form, &$form_state) {
     
    $dest = file_directory_path();
    $contest_dir = 'review_images';

    if(!file_exists($dest . '/' . $contest_dir) || !is_dir($dest . '/' . $contest_dir)) {
        mkdir($dest . '/' . $contest_dir);
    }

    $dest = $dest.'/'.$contest_dir;
    if(isset($_FILES['files']['name'])) {
        foreach($_FILES['files']['name'] AS $key => $name) {
            $file = file_save_upload($key, $validators, $dest, $replace = FILE_EXISTS_RENAME);
            $form_state['values'][$key] = $file;
        }
    }
 }
  /*
 * hook_review_form_submit
 */
 function reviews_system_review_form_submit($form, $form_state) {
     
     
    $images = array();
    if(isset($form_state['values']['image1']->fid)) {
        $images['image1'] = $form_state['values']['image1']->fid;
    }
    if(isset($form_state['values']['image2']->fid)) {
        $images['image2'] = $form_state['values']['image2']->fid;
    }
    if(isset($form_state['values']['image3']->fid)) {
        $images['image3'] = $form_state['values']['image3']->fid;
    }

    $images_count = count($images);

    $nid = $form_state['values']['nid'];
    $title = $form_state['values']['title'];
    $body = $form_state['values']['body'];
    $overall_rating = $form_state['values']['overall_rating'];
    $quality = $form_state['values']['quality'];
    $services_crew = $form_state['values']['services_screw'];
    $value_for_money = $form_state['values']['value_for_money'];
    $star_experiences = $form_state['values']['star_experiences'];
    $age = $form_state['values']['age'];
    $gender = $form_state['values']['gender'];
    $location = $form_state['values']['location'];
    $booked_on_site = ''; 
    
    //$info = array('mail' => $email);
    //$user = user_load($info);
    //$user_name = $form_state['values']['user_name'] ;
    //$email = $form_state['values']['email']; 
    
    
    
    global $user;
    if($user->uid > 0) {
        $verified = reviews_system_get_verified_user($user->uid);
        if($verified == 'VERIFIED') {
            $verified = 1;
        }
        else {
            $verified = 0;
        }
    }
                                  
    
    $user_name = $user->name ;
    $email = $user->mail;

    $createdtime = time();
    $created = date('Y-m-d h:i:s');
    
    $query = db_query("INSERT INTO {reviews}
        (nid,status,title,body,images,created,overall_rating,quality,services_crew,value_for_money,star_experiences,uid,verified,user_name,age,gender,location,email,booked_on_site)
        VALUES(%d, %d, '%s','%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', %d, %d, '%s', '%s', '%s', '%s', '%s', %d)",
        $nid, 0, $title, $body, $images_count, $created, $overall_rating, $quality, $services_crew, $value_for_money, $star_experiences, $user->uid, $verified, $user_name,$age, $gender, $location, $email, $booked_on_site
    );



    if($query) {
        $last_id = db_last_insert_id('reviews', 'id');

        if(isset($images)) {
            foreach($images AS $key => $img) {
                $title = $form_state['values'][$key.'_title'];

                $query = db_query("INSERT INTO {reviews_images}
                    (rid,nid,uid,fid,title,timestamp)
                    VALUES(%d, %d, '%d','%d', '%s', '%s')",
                    $last_id, $nid, $user->uid, $img, $title, $created
                 );
            }
        }

        $email = reviews_system_review_mail($last_id);
        drupal_set_message('Review has been sent for admin approval.This will be published successfully after admin approval.');
    }
    
    
    if($user->uid > 0) {
        drupal_goto('confirm_review');
    }
    else {
        $dest =  '?rid='.$last_id;
        drupal_goto('user/login/'.$last_id);
    }
    
    
    
    
    
    
    
 }
function reviews_system_email_element_validate($element, &$form_state, $form) {
   if (!valid_email_address($element['#value'])) {
     form_error($element, t('Please enter a valid email address.'));
   }
}
/*
 * hook_form to review edit for admin
 */
 function reviews_system_review_edit_form(&$form_state) {
    $nodes = reviews_system_getProductNodes();    
    
     
    $rid = arg(3);
    $review = reviews_sysytem_get_review($rid);
    
    /*if($review['verified'] == 0) {
        $verified = reviews_system_get_verified_user($review['uid']);
        if($verified == 'VERIFIED') {
            $verified = 1;
        }
        else {
            $verified = 0;
        }                              
    }
    else {*/
        $verified =  $review['verified']; 
    //} 
    
    
    
    //echo "<pre>";print_r($review);echo "</pre>";
    
    $destination = 'admin/content/reviews';
    $form['rid'] = array(
        '#type' => 'hidden',
        '#title' => t(''),
        '#required' => FALSE,
        '#default_value' => $review['id'],
        '#description' => "",
        '#size' => 20,
        '#maxlength' => 20,
    );  
    $form['nid'] = array(      
        '#type' => 'select',
        '#title' => t('Product'),
        '#required' => TRUE,
        '#options' => $nodes,
        '#default_value' => $review['nid'],
        '#description' => ""
    );
    $form['verified'] = array(
        '#type' => 'checkbox',
        '#title' => t('Verified Customer'),
        '#required' => TRUE,
        //'#options' => ,
        '#default_value' => $verified,
        '#description' => ""
    );
    $form['body'] = array(
        '#type' => 'textarea',
        '#title' => t('Your review'),
        '#required' => TRUE,
        '#default_value' => $body,
        '#description' => "",
        '#rows' => "10",
        '#cols' => "30",
        '#size' => "30",
    );
    $form['submit'] = array(
        '#type' => 'submit',
        '#value' => 'Submit',
    );
    $form['#redirect'] = 'admin/content/reviews';
    return $form;
 }
/*
 * hook_review_form_submit
 */
 function reviews_system_review_edit_form_submit($form, $form_state) {

    $rid = $form_state['values']['rid'];
    $body = $form_state['values']['body'];
    $nid = $form_state['values']['nid'];
    $verified = $form_state['values']['verified'];


    $query = db_query("UPDATE {reviews} SET nid=%d, body='%s', verified=%d WHERE id=%d",$nid,$body,$verified,$rid);
    

    if($query) {
        drupal_set_message('Review has been updated.');
    }
 }
 /*
  * Review send to admin for approval
  */
 function reviews_system_review_mail($rid) {
        $review = reviews_sysytem_get_review($rid);
        $adminemail2 = 'online@madtravelshop.com,';
        $admin = user_load(69);
        $to = $admin->mail;
        $from = $adminemail2;
        $name = $review['user_name'];
        $link = url('admin/review/edit/'.$rid, array('absolute' => TRUE));
        $subject = "New Mad Travel review approval request.";
        $body  ="Hi Admin,";
        $body .= "<br />";
        $body .= "<br />";
        $node = node_load($review['nid']);
        $body .= $name.' has added a new product review for "'.$node->title.'". Please review & approve as soon as possible.<br />';
        $body .= 'Review link : '.$link;
        $body .= "<br /><br />";
        $body .="Thanks!";
        $message = array(
            'headers' => array('From' => $from,'BCC' => '','Content-type'=> 'text/html','From-name'),
                'to' => $to,
                'subject' => $subject,
                'body' => $body,
        );
        drupal_mail_send($message);
 }
 /*
 * get all product nodes to reassign it to review
 */
function reviews_system_getProductNodes() {
    $query = db_query("SELECT nid,title FROM {node} WHERE type = '%s' AND status = %d", "product",1);
    while($row = db_fetch_array($query)) {
        $rows[$row['nid']] = $row['title'];
    }
    return $rows;
}