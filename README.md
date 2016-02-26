$Id: README.md

Description
-----------

Reviews System is a drupal 6 module  to submit the reviews on products. User can give the rating to the product with the 5 star rating. User can add the desriptition of the review and post the images. Also users can like and dislike the reviews. 


Installation & Configuration
-----------------------------

1. Extract module in sites/all/modules/ Drupal directory.

2. Install the module from Administrator > Site Building > Modules

3. Once the module is enabled, you can See the posted reviews in the admin at:
   Administer > Content Management > Reviews

4. To post the reviews by Login from facebook you need to install the FBOAuth module.
   https://www.drupal.org/project/fboauth

5. You need to add the following lines in your node-product.tpl or the content template file where you want to show the reviews section for the users.
   
    if(isset($reviews)) {
        print $reviews;    
    }  
    
6. To enable the module for sendinf auto email after 2 days of booking date or purchase date you need to setup the cron you can use the poormanscron module for it.
    https://www.drupal.org/project/poormanscron
        
     


