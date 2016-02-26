<?php
    drupal_add_js(drupal_get_path('module','reviews_system').'/raty/demo/js/jquery.min.js');
    drupal_add_js(drupal_get_path('module','reviews_system').'/raty/lib/jquery.raty.min.js');
    drupal_add_js(drupal_get_path('module','reviews_system').'/scripts/script.js');

    $template_path = base_path().drupal_get_path('module','reviews_system').'/templates/';
    $files_path = base_path().file_directory_path();
?>
<div class="container"><!--container!-->
        
        <div class="filter"><!--filter!-->
            <div class="comment"><!--comment section!-->
                <div class="rtop">
                    <div class="rtop-left">
                        <div class="review-rating">
                            <div id ="review-rating-overall-<?php print $review['id'] ?>" class="star"></div>
                            <span style=""><?php print $review['overall_rating']?></span>
                        </div>

                        <h2><?php print $review['title']; ?></h2>
                        <h5><?php print date('d F Y',strtotime($review['created'])); ?></h5>
                    </div>
                    <div class="rtop-right">
                        <ul class="ul_social">
                        <?php
                            $mdpath = drupal_get_path('module','reviews_system').'/templates/';

                            $fbimgUrl = $mdpath.'images/f.2.png';
                            $fbimg = theme_image($fbimgUrl, $alt, $title, $attributes, $getsize);

                            $twimgUrl = $mdpath.'images/t.2.png';
                            $twimg = theme_image($twimgUrl, $alt, $title, $attributes, $getsize);

                            $gimgUrl = $mdpath.'images/g+.1.png';
                            $gimg = theme_image($gimgUrl, $alt, $title, $attributes, $getsize);

                            $reviewUrl = url('review/'.$review['id'], array('absolute' => TRUE));

                            print '<li>'.l($fbimg, $reviewUrl, array('html' => true, 'attributes' => array('class' => 'fbsocial', 'id' => 'fbsocial', 'onclick' => 'return fbShare();'))).'</li>';
                            print '<li>'.l($twimg, $reviewUrl, array('html' => true, 'attributes' => array('class' => 'twsocial', 'id' => 'twsocial', 'onclick' => 'return twShare();'))).'</li>';
                            print '<li>'.l($gimg, $reviewUrl, array('html' => true, 'attributes' => array('class' => 'gsocial', 'id' => 'gsocial', 'onclick' => 'return gShare();'))).'</li>';

                        ?>
                        </ul>
                    </div>
                </div>

                <div class="comment_sec"><!--comment section!-->
                	<div class="pro"><img src="<?php print $template_path ?>images/pro.png" /></div>
                    <div class="con_area">
                    	<h4><?php print $review['user_name']; ?></h4>
                        <p><strong>From</strong> <?php print $review['location']; ?> <strong>Age:</strong> <?php print $review['age']; ?> <strong> Gender:</strong> <?php print $review['gender']; ?></p>
                        <p>
                           <?php

                                $limg = reviews_system_like_image($review['id']);
                                $dimg = reviews_system_dislike_image($review['id']);

                                $likeUrl = 'review_like/'.$nid.'/'.$review['id'];
                                $dislikeUrl = 'review_dislike/'.$nid.'/'.$review['id'];

                                $like_dislike_count = reviews_system_likes_dislikes_count($review['id']);
                                
                                print '<ul class="like_dislike" id="like_dislike_'.$review['id'].'">';
                                print '<li>'.l($limg, $likeUrl , array('html' => true, 'attributes' => array('title' => 'Was this review helpful?', 'class' => 'like', 'id' => 'like', 'onclick' => 'return click_like('.$review['id'].');'))).'<span id="likes_count">'.$like_dislike_count['likes'].'</span></li>';
                                print '<li>'.l($dimg, $dislikeUrl, array('html' => true, 'attributes' => array('title' => 'Was this review helpful?', 'class' => 'dislike', 'id' => 'dislike', 'onclick' => 'return click_dislike('.$review['id'].');'))).'<span id="dislikes_count">'.$like_dislike_count['dislikes'].'</span></li>';
                                print '</ul>';
                           ?>
                        </p>
                    </div>
                    <div class="clr"></div>
                </div><!--comment section!-->

                <div class="bottom_part"><!--bottom sec!-->
                    <div class="desc-right">
                        <p><?php print $review['body']; ?></p>
                        <div class="gallery">
                                <ul>
                                    <?php
                                            $pictures = array();
                                            $pictures = reviews_system_get_images($review['id']);
                                            if(isset($pictures)) {
                                                foreach($pictures AS $key => $img) {
                                                    $image = reviews_system_get_image($img['fid'])->filename;
                                                    $image_title = reviews_system_get_image_title($img['fid'])->title;
                                                    $rel = 'lightbox-review-'.$review['id'];
                                                    if($image) {
                                                        print '<li><a rel="'.$rel.'" title="'.$image_title.'" href="'.$files_path.'/review_images/'.$image.'"><img src="'.$files_path.'/review_images/'.$image.'" /></a></li>';
                                                    }
                                                }
                                                
                                                $meta_image = url(file_directory_path().'/review_images/'.$image,array('absolute' =>true));
                                            }
                                            else {
                                                $rel = 'lightbox-noimage-'.$review['id'];
                                                for($i=1;$i<=3;$i++) {
                                                    print '<li><a rel="'.$rel.'" title="No images uploaded" href="'.$template_path.'images/no_img.png"><img src="'.$template_path.'images/no_img_sm.png" /></a></li>';
                                                }
                                                $module_path = drupal_get_path('module','reviews_system').'/templates/';
                                                $meta_image = url($module_path.'images/no_img.png', array('absolute' => TRUE));
                                            }
                                            
                                        $nid = $review['nid'];
                                        $node = node_load($nid);
                                        $site_name = variable_get('site_name', '');
                                        $meta_title = $site_name." ".$node->title;
                                        $desc = substr($review['body'], 0, 200);
                                        $meta_description = "Check out this mad review. ".$desc;
                                        $meta_url = url('review/'.$review['id'], array('absolute' => TRUE));
                                        

                                        // for Google
                                        $meta_data .= '<meta name="title" content="'.$meta_title.'" />';
                                        $meta_data .= '<meta name="description" content="'.$meta_description.'" />';
                                        $meta_data .= '<meta name="image" content="'.$meta_image.'" />';
                                        $meta_data .= '<meta name="url" content="'.$meta_url.'" />';
                                        $meta_data .= '<meta name="keywords" content="" />';
                                        $meta_data .= '<meta name="author" content="" />';
                                        $meta_data .= '<meta name="copyright" content="" />';
                                        $meta_data .= '<meta name="application-name" content="" />';

                                        // for Facebook
                                        $meta_data .= '<meta property="og:title" content="'.$meta_title.'" />';
                                        $meta_data .= '<meta property="og:type" content="review" />';
                                        $meta_data .= '<meta property="og:image" content="'.$meta_image.'" />';
                                        $meta_data .= '<meta property="og:url" content="'.$meta_url.'" />';
                                        $meta_data .= '<meta property="og:description" content="'.$meta_description.'" />';

                                        // for Twitter
                                        $meta_data .= '<meta name="twitter:card" content="summary" />';
                                        $meta_data .= '<meta name="twitter:title" content="'.$meta_title.'" />';
                                        $meta_data .= '<meta name="twitter:description" content="'.$meta_description.'" />';
                                        $meta_data .= '<meta name="twitter:image" content="'.$meta_image.'" />';
                                        $meta_data .= '<meta name="twitter:url" content="'.$meta_url.'" />';
                                        
                                        drupal_set_html_head($meta_data);

                                    ?>
                                </ul>
                        </div>
                    </div>
                    <div class="rt_part">
                    	<h4>Quality </h4>
                         <div class="review-rating">
                            <div id="review-rating-quality-<?php print $review['id'] ?>" class="star"></div>
                            <span style=""><?php print $review['quality']?></span>
                        </div>

                        <h4>Services Crew </h4>
                         <div class="review-rating">
                            <div id="review-rating-services-<?php print $review['id'] ?>" class="star"></div>
                            <span style=""><?php print $review['services_crew']?></span>
                        </div>

                        <h4>Value for money </h4>
                         <div class="review-rating">
                            <div id="review-rating-value-<?php print $review['id'] ?>" class="star"></div>
                            <span style=""><?php print $review['value_for_money']?></span>
                        </div>

                        <h4>Star Experience </h4>
                         <div class="review-rating">
                            <div id="review-rating-star-<?php print $review['id'] ?>" class="star"></div>
                            <span><?php print $review['star_experiences']?></span>
                        </div>
                    </div>
                    <div class="clr"></div>
                </div><!--bottom sec!-->
            </div><!--comment section!-->

        </div><!--filter!-->
    </div><!--container!-->