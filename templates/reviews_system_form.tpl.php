<?php

    drupal_add_js(drupal_get_path('module','reviews_system').'/raty/demo/js/jquery.min.js');
    drupal_add_js(drupal_get_path('module','reviews_system').'/raty/lib/jquery.raty.min.js');
    drupal_add_js(drupal_get_path('module','reviews_system').'/scripts/script.js');
      honeypot_add_form_protection($form, $form_state, array('honeypot', 'time_restriction'));
?>

<div class="write-bg">
    <img title="" alt="" src="<?php echo base_path().drupal_get_path('module','reviews_system').'/templates/images/write-review.jpg'?>">
</div>
<?php     

   $nid = arg(2);
   $node = node_load($nid);
   //print "<h1>".$node->title."</h1><br />";
   //print "<p>".$node->body."</p><br />";
   print "<h2> Leave a review about ".$node->title."</h2><br />";
   
   print '<div class="main-raty">';
   
       print '<div class="ratey"><div class="rate-item">';
         print '<div class="label">Overall Rating : </div>';
         print '<div id = "overall_star" class="star"></div>';
         print '<span id="rateme-text"></span>';
         print drupal_render($form['rate_this_experience']['overall_rating']);
       print '</div><hr /></div>';

       //print '<div class="other-rating">';
           //print '<div class="other-rating-left">';
           print '<div class="ratey"><div class="rate-item">';
             print '<div class="label">Quality : </div>';
             print '<div id = "quality_star" class="star"></div>';
             print '<span id="rateme-text"></span>';
             print drupal_render($form['rate_this_experience']['quality']);
           print '</div></div>';

           print '<div class="ratey"><div class="rate-item">';
             print '<div class="label">Crew : </div>';
             print '<div id = "services_star" class="star"></div>';
             print '<span id="rateme-text"></span>';
             print drupal_render($form['rate_this_experience']['services_screw']);
           print '</div></div>';
           //print '</div>';

           //print '<div class="other-rating-right">';
           print '<div class="ratey"><div class="rate-item">';
             print '<div class="label">Value for Money : </div>';
             print '<div id = "money_star" class="star"></div>';
             print '<span id="rateme-text"></span>';
             print drupal_render($form['rate_this_experience']['value_for_money']);
           print '</div></div>';

           print '<div class="ratey"><div class="rate-item">';
             print '<div class="label">Experience : </div>';
             print '<div id = "experiences_star" class="star"></div>';
             print '<span id="rateme-text"></span>';
             print drupal_render($form['rate_this_experience']['star_experiences']);
           print '</div></div>';
           //</div>';
           
       //print '</div>';
       
   print '</div>';    
   
   print drupal_render($form['write_your_review']);
   print drupal_render($form['share_your_pics']);
   print drupal_render($form['tell_us']);
   
    $mdpath = drupal_get_path('module','reviews_system').'/templates/';
    $imgUrl = $mdpath.'images/qimage.png';
    $img = theme_image($imgUrl, $alt, $title, $attributes, $getsize);
    //$callout = theme_image($mdpath.'images/callout.gif', $alt, $title, $attributes, $getsize);
    $span = '<span> <img class="callout" src="'.base_path().$mdpath.'images/callout.gif" /> 
      <p>Thanks for reviewing this product. All reviews must comply with the terms of the site.</p> 
      <p>Mad Travel Shop reserves the right to not publish, edit or delete any inappropriate or irrelevant reviews.</p>
      <p>Talk about your experience, the staff, the activity, the price</p>
      <p>Do not talk about other travellers, travel shops or other websites</p>
      <p>No HTML tags, swearing or derogatory remarks, or inappropriate images.</p>
      <p>Any images you upload must be your own photo\'s, no commercial images will be published</p>';

   print '<div class="termcon"><p class="helpp">By Submitting this review, you are accepting our Terms & Conditions.</p>'
   .l($img.$span, '', array('fragment' => '#', 'external' => true, 'html' => true, 'attributes' => array('class' => 'helpr')))
   .'</div>';   
   
   print drupal_render($form['submit']);

   print '<div style="display:none">'.drupal_render($form).'</div>';
?>
