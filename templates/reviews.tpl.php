<?php

    //rating scripts
    
    //print drupal_add_js(drupal_get_path('module','reviews_system').'/raty/demo/js/jquery.min.js', 'return');
    //print drupal_add_js(drupal_get_path('module','reviews_system').'/raty/lib/jquery.raty.min.js', 'return');
    //print drupal_add_js(drupal_get_path('module','reviews_system').'/scripts/script.js', 'return');


    //if (!in_array('administrator', $user->roles)) {
        //drupal_add_js(drupal_get_path('module','reviews_system').'/raty/demo/js/jquery.min.js');
        //drupal_add_js(drupal_get_path('module','reviews_system').'/raty/lib/jquery.raty.min.js');
        //drupal_add_js(drupal_get_path('module','reviews_system').'/scripts/script.js');
    //}
    
   $mpath = base_path().drupal_get_path("module","reviews_system");
   
?>

    <!--script type="text/javascript" src="<?php echo $mpath ?>/raty/demo/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $mpath ?>/raty/lib/jquery.raty.min.js"></script>
    <script type="text/javascript" src="<?php echo $mpath ?>/scripts/script.js"></script-->  
    

<?php    
    $template_path = drupal_get_path('module','reviews_system').'/templates/';
    $nid = arg(1);
?> 

<div class="container reviews-content"><!--container!-->     
        <?php
            $description = '';
            $nid = arg(1);
            $product_rating = reviews_system_calculate_product_rating($nid);
            $reviews_count = count($reviews['data']);
            $nd = reviews_system_get_node_info($nid);
            // NODEWORDS_TYPE_NODE = 5
            $nodewords = nodewords_load_tags(NODEWORDS_TYPE_NODE, $nid);
            //echo $description = substr($nodewords['description'],0,200);
            //echo "<pre>";print_r($nd);echo "</pre>";
            $description = $nodewords['description']['value'];
            
        ?>
        <div class="product_review"><!--pro review!-->
        	<h3>Product reviews</h3>
                <?php
                   $rcount = reviews_system_get_reviews_count($nid);
                   if($rcount) {
                ?>
                    <div class="raiting"><!--raiting!-->
                        <span>Overall rating</span> 
                        <div class="product-rating">
                            <div id="overall-rating-<?php print $nid ?>" class="star"></div>
                            <span style=""><?php print $product_rating->overall_total ?></span>
                        </div>
                        <p class="rcount">
                            <?php print $rcount.' reviews'; ?>
                        </p>
                    </div><!--raiting!-->
                
            <div class="quality_part">
            	<div class="box_left"><!--box!-->
                	<div class="quality"><!--left part!-->
                    	<h4>Quality</h4>
                        <div class="product-rating">
                            <div id="quality-<?php print $nid ?>" class="star"></div>
                            <span style=""><?php print $product_rating->quality_total ?></span>
                        </div>
                    </div><!--left part!-->
                    <div class="rt"><!--right part!-->
                    	<?php print $product_rating->quality_total.'/5' ?>
                    </div><!--right part!-->
                    <div class="clr"></div>
                </div><!--box!-->

                <div class="box_left"><!--box!-->
                	<div class="quality"><!--left part!-->
                    	<h4>Crew</h4>
                        <div class="product-rating">
                            <div id="services-<?php print $nid ?>" class="star"></div>
                            <span style=""><?php print $product_rating->service_total ?></span>
                        </div>
                    </div><!--left part!-->
                    <div class="rt"><!--right part!-->
                    	<?php print $product_rating->service_total.'/5' ?>
                    </div><!--right part!-->
                    <div class="clr"></div>
                </div><!--box!-->


                <div class="box_left"><!--box!-->
                    <div class="quality"><!--left part!-->
                        <h4>Value for Money</h4>
                        <div class="product-rating">
                            <div id="value-for-money-<?php print $nid ?>" class="star"></div>
                            <span style=""><?php print $product_rating->value_total ?></span>
                        </div>
                    </div><!--left part!-->
                    <div class="rt"><!--right part!-->
                    	<?php print $product_rating->value_total.'/5' ?>
                    </div><!--right part!-->
                    <div class="clr"></div>
                </div><!--box!-->


                <div class="box_left"><!--box!-->
                	<div class="quality"><!--left part!-->
                    	<h4>Experience</h4>
                        <div class="product-rating">
                            <div id="star-experinces-<?php print $nid ?>" class="star"></div>
                            <span style=""><?php print $product_rating->star_total ?></span>
                        </div>
                    </div><!--left part!-->
                    <div class="rt"><!--right part!-->
                    	<?php print $product_rating->star_total.'/5' ?>
                    </div><!--right part!-->
                    <div class="clr"></div>
                </div><!--box!-->


                <div class="clr"></div>
            </div>
           <?php } ?>
        </div><!--pro review!-->

        <div class="filter"><!--filter!-->
            <?php if($rcount) { ?>
                <h4>Advanced filters</h4>
                <select id="advance_review_filter">
                    <option value="0">Star Rating</option>
                    <option value="1">1 Star</option>
                    <option value="2">2 Star</option>
                    <option value="3">3 Star</option>
                    <option value="4">4 Star</option>
                    <option value="5">5 Star</option>
                </select>
                <input type="hidden" name="nid" id="rnid" value="<?php print $nid; ?>" />
                <h6>Click on filters to refine your results.</h6>
             <?php } ?>
            <div class="write_sec"><!--write section!-->
                <?php if(!$rcount){ print "<p> No reviews found yet, be the first legend to review this tour.</p>"; } ?>
            	<em>
                    <!--a href="<?php print base_path().'add/review/'.$nid ?>">
                    <img src="<?php print $template_path ?>images/review.1.png" /></a-->
                    
                    <?php 
                        $wimgurl = $template_path.'images/review.1.png';
                        $wimg =  theme_image($wimgurl, $alt, $title, $attributes, $getsize);
                        echo l($wimg, 'add/review/'.$nid, array('html' => true));
                    ?>
                    
                </em>
                <?php if($rcount){ ?>
                <select id="review_filter">
                    <option value="created-desc">Sort by</option>
                    <option value="created-desc">Newest</option>
                    <option value="created-asc">Oldest</option>
                    <option value="likes">Most Liked</option>
                    <option value="images">Top Photo uploads</option>
                </select>
                <?php } ?>
                <div class="clr"></div>
            </div><!--write section!-->
        <div id="reviews-wrapper" itemscope itemtype="https://schema.org/Product"> 
                <div class="richtext"><!-- rich text for aggregate rating -->
                    <span itemprop="name"><?php print $nd->title ?></span>
                    <span itemprop="description"><?php print $description ?></span>  
                    <div itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">
                        <span itemprop="ratingValue"><?php print $product_rating->overall_total ?></span>/5 based on
                        <span itemprop="reviewCount"><?php print $reviews_count; ?></span> reviews
                    </div>
                </div>                                   
        <?php 
            $files_path = base_path().file_directory_path();
          if($rcount) {
            foreach($reviews['data'] AS $key => $review) { 
        ?>   
            <div class="comment" itemtype="https://schema.org/Review" itemscope itemprop="review"><!--comment section!-->
                
                <div class="richtext"><!-- rich text for review -->
                    <span itemscope itemprop="name"><?php print $review['title']?></span>
                    <span itemscope itemprop="reviewbody"><?php print $review['body']?></span>
                    <span itemscope itemprop="reviewrating" itemscope itemtype="https://schema.org/Rating"> 
                        <span itemprop="ratingvalue"><?php print $review['overall_rating']?></span>/5
                    </span>
               </div>         
                
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
                            
                            $desc = substr($review['body'], 0, 200);
                            $description = "Check out this mad review. ".$desc;

                            print '<li>'.l($fbimg, $reviewUrl, array('html' => true, 'attributes' => array('class' => 'fbsocial', 'id' => 'fbsocial', 'onclick' => 'return fbShare(this);'))).'</li>';
                            
                            ?>
                            <script src="https://platform.twitter.com/widgets.js" type="text/javascript"></script>
                            <!--li id='custom-tweet-button'><a href="https://twitter.com/share?url=<?php echo $reviewUrl ?>&text=<?php echo $description ?>" target="_blank" onclick='return twShare(this);'>Tweet</a></li-->
                            <li id='custom-tweet-button'><a href="https://twitter.com/share?url=<?php echo $reviewUrl ?>&text=<?php echo $description ?>" target="_blank" onclick='return twShare(this);'><?php echo $twimg; ?></a></li>
                            <?php
                            print '<li>'.l($gimg, $reviewUrl, array('html' => true, 'attributes' => array('class' => 'gsocial', 'id' => 'gsocial', 'onclick' => 'return gShare(this);'))).'</li>';
                            
                            


                        ?>
                        </ul>
                    </div>
                </div>   
                
                <div class="comment_sec"><!--comment section!-->
                	<div class="pro">
                        <?php  
                            $user1 = user_load($review['uid']);
                            
                            //echo "<pre>";print_r($review);echo "</pre>"; 
                            
                            if($user1->picture != '') {
                                $imgUrl = $user1->picture;
                                echo theme_image($imgUrl, $alt, $title, $attributes, $getsize); 
                            }
                            else { 
                                $imgUrl = $template_path.'images/pro.png';
                                echo theme_image($imgUrl, $alt, $title, $attributes, $getsize);
                            }
                        ?>
                    </div>
                    <div class="con_area">
                        <?php 
                            //$verified = reviews_system_get_verified_user($review['uid']);
                            if($review['verified'] == 1) {
                              $verified = 'VERIFIED';
                            }
                            else {
                              $verified = 'NOT VERIFIED';
                            }
                         ?>
                    	<h4><?php print $review['user_name']; ?></h4><span><?php echo $verified ?></span>
                   
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
                    <div class="rt_part">
                    	<h4>Quality </h4>
                         <div class="review-rating">
                            <div id="review-rating-quality-<?php print $review['id'] ?>" class="star"></div>
                            <span style=""><?php print $review['quality']?></span>
                        </div>

                        <h4>Crew </h4>
                         <div class="review-rating">
                            <div id="review-rating-services-<?php print $review['id'] ?>" class="star"></div>
                            <span style=""><?php print $review['services_crew']?></span>
                        </div>

                        <h4>Value for Money </h4>
                         <div class="review-rating">
                            <div id="review-rating-value-<?php print $review['id'] ?>" class="star"></div>
                            <span style=""><?php print $review['value_for_money']?></span>
                        </div>

                        <h4>Experience </h4>
                         <div class="review-rating">
                            <div id="review-rating-star-<?php print $review['id'] ?>" class="star"></div>
                            <span><?php print $review['star_experiences']?></span>
                        </div>
                    </div>
                    <div class="desc-right">
                        <p><?php print $review['body']; ?></p> 
                    </div>
                    <div class="gallery">
                                <ul>
                                    <?php
                                            $pictures = array();
                                            $pictures = reviews_system_get_images($review['id']);
                                            
                                            if(!empty($pictures)) {
                                                foreach($pictures AS $key => $img) {
                                                    $image = reviews_system_get_image($img['fid'])->filename;
                                                    $image_title = reviews_system_get_image_title($img['fid'])->title;
                                                    
                                                    $rel = 'lightbox-review-'.$review['id'];
                                                    if($image) {
                                                        print '<li><a rel="'.$rel.'" title="'.$image_title.'" href="'.$files_path.'/review_images/'.$image.'"><img src="'.$files_path.'/review_images/'.$image.'" /></a></li>';
                                                    }
                                                }
                                            }
                                            else {             
                                                $rel = 'lightbox-noimage-'.$review['id'];
                                                for($i=1;$i<=3;$i++) {
                                                    print '<li><a rel="'.$rel.'" title="No images uploaded" href="'.base_path().$template_path.'images/no_img.png"><img src="'.base_path().$template_path.'images/no_img_sm.png" /></a></li>';
                                                }
                                            }

                                    ?>
                                </ul>
                        </div>
                    <div class="clr"></div>
                </div><!--bottom sec!-->
                
                <div class="bottom_part_desc"><!--bottom sec!-->
                    <p>Reviews on this page are the subjective opinion of a Mad Travel member and in no way the opinion of Mad Travel Shop.</p>
                </div><!--bottom sec!-->
                
                
                
            </div><!--comment section!-->
        <?php } } ?>
        </div>
        </div><!--filter!-->
    </div><!--container!-->