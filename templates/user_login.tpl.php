

<div class="review-login">
   <div class="f_section">     
        <?php echo drupal_render($form); ?>
   </div>      
   <div class="r_sec">
   
   <h1><?php print l('Create an account', 'user/register', array('html' => true)); ?></h1>
   <h2>Or Connect with Facebook</h2>
   
       <?php 
        $mdpath = drupal_get_path('module','reviews_system').'/templates/';
        $fbimgUrl = $mdpath.'images/fb.png';
        $fbimg = theme_image($fbimgUrl, $alt, $title, $attributes, $getsize);  
        $link = fboauth_action_link_properties('connect');
        if(arg(2) != '') {
            $link['query']['state'] = arg(2);
        }
        
        print l($fbimg, $link['href'], array('html' => true,'query' => $link['query']));
       ?> 
   </div>    
</div>