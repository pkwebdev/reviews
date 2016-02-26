<?php
/*
 * hook_form
 */
 function reviews_system_review_admin_filter_form(&$form_state) {
     if($_GET['text']) {
         $defualt_text = $_GET['text'];
         $defualt_option = $_GET['filter_by'];
         $display = "display:block;";
     }
     else {
         $defualt_text = '';
         $defualt_option = '';
         $display = "display:none;";
     }
     
     if($_GET['filter_by'] == 'by_date') {
        $size = 20;
     }
     else {
         $size = 50;
     }
     
     $form['filter'] = array(
        '#type' => 'fieldset',
        '#title' => t('Filter'),
        '#collapsible' => TRUE,
        '#collapsed' => FALSE,
     );
    $form['filter']['filter_by'] = array(
        '#type' => 'select',
        '#title' => t(''),
        '#required' => FALSE,
        '#options' => array('' => 'Filter by','by_text' => 'Filter By Text','by_product' => 'Filter By Product','by_date' => 'Filter By Date'),
        '#default_value' => $defualt_option,
        '#description' => "",
        '#prefix' => '<div style="float:left;width: 160px;">',
        '#suffix' => '</div>',
        '#attributes' => array('onchange' => 'return show_filter_fileds(this);'),

    );
    $form['filter']['text'] = array(
        '#type' => 'textfield',
        '#title' => t(''),
        '#required' => FALSE,
        '#default_value' => $defualt_text,
        '#description' => "",
        '#size' => $size,
        '#maxlength' => 100,
        '#prefix' => '<div class="filter_criteria" style="'.$display.'"><div style="float:left;width: 500px;">',
        '#suffix' => '</div>',
    );
    $form['filter']['submit'] = array(
        '#type' => 'submit',
        '#value' => 'Go',
        '#prefix' => '<div style="float:left;width: 160px;">',
        '#suffix' => '</div></div>',
    );
    $form['#method'] = 'get';
    $form['#action'] = 'reviews';
    return $form;
 }
 /*
 * hook_form_validate
 */
 function reviews_system_review_admin_filter_form_validate($form, &$form_state) {

 }
 /*
 * hook_form_submit
 */
 function reviews_system_review_admin_filter_form_submit($form, &$form_state) {

 }
/*
 * Listing of reviews in admin
 */
function reviews_system_admin_reviews() {
    $html = '';
    $header = array(array('data' => 'ID', 'field' => 'id', 'sort' => 'desc'), array('data' => 'Title', 'field' => 'title', 'sort' => 'asc'), 'Product', 'Status', 'Date', 'Action');
    
    if(isset($_GET)) {
        
        //$sql = "SELECT * FROM reviews WHERE uid !=0";
        // modified on 5-12-2014
        $sql = "SELECT * FROM reviews WHERE 1";
        
        
        if($_GET['filter_by'] == 'by_text' && $_GET['text'] != '') {
            $text = $_GET['text'];
            $sql .= " AND title like '%%".$text."%%' OR body like '%%".$text."%%'";
        }
        else if($_GET['filter_by'] == 'by_product' && $_GET['text'] != '') {
            
            //$sql = "SELECT r.* FROM reviews r JOIN node n ON n.nid=r.nid WHERE r.uid !=0";
            // modified on 5-12-2014
            $sql = "SELECT r.* FROM reviews r JOIN node n ON n.nid=r.nid WHERE 1";
            
            $title = $_GET['text'];
            if($title) {
                $sql .= " AND n.title LIKE '%%".$title."%%'";
            }
        }
        else if($_GET['filter_by'] == 'by_date' && $_GET['text'] != '') {
            
            //$sql = "SELECT * FROM reviews WHERE uid !=0";
            // modified on 5-12-2014
            $sql = "SELECT * FROM reviews";
            
            $datestr = $_GET['text'];
            $created = strtotime($datestr);
            if($created) {
                $sql .= " AND DATE_FORMAT(created, '%%m/%%d/%%Y') = '".$datestr."'";
            }
        }
    }
    else {
        //$sql = "SELECT * FROM reviews WHERE uid !=0";
        // modified on 5-12-2014
        $sql = "SELECT * FROM reviews WHERE 1";
    }
    
    
    //$cntsql = "SELECT count(*) FROM reviews WHERE uid !=0";
    // modified on 5-12-2014
    $cntsql = "SELECT count(*) FROM reviews WHERE 1";
    
    $res = pager_query($sql . tablesort_sql($header), $limit = 50, $element = 0, $cntsql);
    $pager = theme('pager', NULL, 50, 0);
    
    $data = array();
    while ($row = db_fetch_array($res)) {
        $dstr = strtotime($row['created']);
        $date = date('d F, Y',$dstr);
        $node = node_load($row['nid']);
        $product = l(t($node->title),'node/'.$node->nid,array('html' => true));
        $title = l(t($row['title']), 'admin/review/edit/'.$row['id'],array('html' => true));
        if($row['status']) {
            $status = 'Approved';
            $activate = l(t('Unpublish'), 'review/unpublish/'.$row['id'], array('html' => true));
        }
        else {
            $status = 'Not Approved';
            $activate = l(t('Publish'), 'review/publish/'.$row['id'], array('html' => true));
        }
        $delete = l(t('Delete'),'review/delete/'.$row['id'],array('attributes'=>array('onclick' => "return confirm('are you sure?')"),'html' => true));
        $action = $activate.' | '.$delete;
        $data[] = array($row['id'], $title, $product, $status, $date, $action);
    }
    $html = theme('table', $header, $data);

    return theme_render_template(drupal_get_path('module', 'reviews_system') .'/templates/admin_reviews.tpl.php',array('html' => $html, 'pager' => $pager));
}
/*
 * For edit review
 */
function reviews_system_review_edit($id) {
    return $id;
}
/*
 * For publish a review
 */
function reviews_system_review_publish($id) {
    $query = db_query("UPDATE {reviews} SET status = %d WHERE id = %d",1,$id);
    if($query) {
        drupal_set_message('Reviews has been successfully published');
        drupal_goto('admin/content/reviews');
    }
}
/*
 * For unpublish a review
 */
function reviews_system_review_unpublish($id) {
    $query = db_query("UPDATE {reviews} SET status = %d WHERE id = %d",0,$id);
    if($query) {
        drupal_set_message('Reviews has been successfully unpublished');
        drupal_goto('admin/content/reviews');
    }
}
/*
 * For unpublish a review
 */
function reviews_system_review_delete($id) {
    $query = db_query("DELETE FROM {reviews} WHERE id = %d",$id);
    if($query) {
        drupal_set_message('Reviews has been deleted successfully');
        drupal_goto('admin/content/reviews');
    }
}
