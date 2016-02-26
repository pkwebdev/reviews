<?php

    //rating scripts
    drupal_add_js(drupal_get_path('module','reviews_system').'/raty/demo/js/jquery.min.js');
    drupal_add_js(drupal_get_path('module','reviews_system').'/raty/lib/jquery.raty.min.js');
    drupal_add_js(drupal_get_path('module','reviews_system').'/scripts/script.js');

    $template_path = base_path().drupal_get_path('module','reviews_system').'/templates/';
?>
<div class="container admin-edit-form-container"><!--container!-->

        <?php
            $rid = arg(3);
            $review = reviews_sysytem_get_review($rid);
            
        ?>

        <div class="filter"><!--filter!-->
            <div class="comment"><!--comment section!-->
                <div class="review-rating">
                    <div id ="review-rating-overall-<?php print $review['id'] ?>" class="star"></div>
                    <span style=""><?php print $review['overall_rating']?></span>
                </div>

                <h2><?php print $review['title']; ?></h2>
                <h5><?php print date('d F Y',strtotime($review['created'])); ?></h5>

                <div class="comment_sec"><!--comment section!-->
                	<div class="pro"><img src="<?php print $template_path ?>images/pro_pics.jpg" /></div>
                    <div class="con_area">
                    	<h4><?php print $review['user_name']; ?></h4>
                        <!--<h6>Verified Purchaser</h6>-->
                        <p><strong>From</strong> <?php print $review['location']; ?> <strong>Age:</strong> <?php print $review['age']; ?> <strong> Gender:</strong> <?php print $review['gender']; ?></p>
                    </div>
                    <div class="clr"></div>
                </div><!--comment section!-->

                <div class="bottom_part"><!--bottom sec!-->
                    <?php print drupal_render($form['verified']); ?>
                    <?php print drupal_render($form['nid']); ?>
                	<?php print drupal_render($form['body']); ?>
                        <p id="body-hidden"><?php print $review['body']; ?></p>
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
                    <div class="clr"></div>
                </div><!--bottom sec!-->
            </div><!--comment section!-->

        </div><!--filter!-->
    </div><!--container!-->

<?php
   

   print drupal_render($form['submit']);

   print '<div style="display:none">'.drupal_render($form).'</div>';
?>