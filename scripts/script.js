$r = jQuery.noConflict();

$r(document).ready(function(){
    
    var path = Drupal.settings.basePath+Drupal.settings.modulepath;

    var modulepath = Drupal.settings.basePath+Drupal.settings.modulepath;
    var imgPath = path+'/raty/lib/img/';

    $r('#overall_star').raty({
        click:function(score, evt) {
            $r('#edit-overall-rating').val(score);
        },
        starOn   : imgPath+'star-on.png',
        starOff  : imgPath+'star-off.png',
        mouseover: function(score, evt) {
            var divID = $r(this).attr('id');
            if(score == 1) {
                $r("#"+divID).next("span").text('Poor');
            }
            else if(score == 2) {
                $r("#"+divID).next("span").text('Could be better');
            }
            else if(score == 3) {
                $r("#"+divID).next("span").text('Average');
            }
            else if(score == 4) {
                $r("#"+divID).next("span").text('Good');
            }
            else if(score == 5) {
                $r("#"+divID).next("span").text('Amazing');
            }
        },
        mouseout: function(score, evt) {
            var divID = $r(this).attr('id');
            $r("#"+divID).next("span").text('');
        }
    });

    $r('#quality_star').raty({
        click:function(score, evt) {
            $r('#edit-quality').val(score);
        },
        starOn   : imgPath+'star-on.png',
        starOff  : imgPath+'star-off.png',
        mouseover: function(score, evt) {
            var divID = $r(this).attr('id');
            if(score == 1) {
                $r("#"+divID).next("span").text('Poor');
            }
            else if(score == 2) {
                $r("#"+divID).next("span").text('Could be better');
            }
            else if(score == 3) {
                $r("#"+divID).next("span").text('Average');
            }
            else if(score == 4) {
                $r("#"+divID).next("span").text('Good');
            }
            else if(score == 5) {
                $r("#"+divID).next("span").text('Amazing');
            }
        },
        mouseout: function(score, evt) {
            var divID = $r(this).attr('id');
            $r("#"+divID).next("span").text('');
        }
    });

    $r('#services_star').raty({
        click:function(score, evt) {
            $r('#edit-services-screw').val(score);
        },
        starOn   : imgPath+'star-on.png',
        starOff  : imgPath+'star-off.png',
        mouseover: function(score, evt) {
            var divID = $r(this).attr('id');
            if(score == 1) {
                $r("#"+divID).next("span").text('Poor');
            }
            else if(score == 2) {
                $r("#"+divID).next("span").text('Could be better');
            }
            else if(score == 3) {
                $r("#"+divID).next("span").text('Average');
            }
            else if(score == 4) {
                $r("#"+divID).next("span").text('Good');
            }
            else if(score == 5) {
                $r("#"+divID).next("span").text('Amazing');
            }
        },
        mouseout: function(score, evt) {
            var divID = $r(this).attr('id');
            $r("#"+divID).next("span").text('');
        }
    });

    $r('#money_star').raty({
        click:function(score, evt) {
            $r('#edit-value-for-money').val(score);
        },
        starOn   : imgPath+'star-on.png',
        starOff  : imgPath+'star-off.png',
        mouseover: function(score, evt) {
            var divID = $r(this).attr('id');
            if(score == 1) {
                $r("#"+divID).next("span").text('Poor');
            }
            else if(score == 2) {
                $r("#"+divID).next("span").text('Could be better');
            }
            else if(score == 3) {
                $r("#"+divID).next("span").text('Average');
            }
            else if(score == 4) {
                $r("#"+divID).next("span").text('Good');
            }
            else if(score == 5) {
                $r("#"+divID).next("span").text('Amazing');
            }
        },
        mouseout: function(score, evt) {
            var divID = $r(this).attr('id');
            $r("#"+divID).next("span").text('');
        }
    });

    $r('#experiences_star').raty({
        click:function(score, evt) {
            $r('#edit-star-experiences').val(score);
        },
        starOn   : imgPath+'star-on.png',
        starOff  : imgPath+'star-off.png',
        mouseover: function(score, evt) {
            var divID = $r(this).attr('id');
            if(score == 1) {
                $r("#"+divID).next("span").text('Poor');
            }
            else if(score == 2) {
                $r("#"+divID).next("span").text('Could be better');
            }
            else if(score == 3) {
                $r("#"+divID).next("span").text('Average');
            }
            else if(score == 4) {
                $r("#"+divID).next("span").text('Good');
            }
            else if(score == 5) {
                $r("#"+divID).next("span").text('Amazing');
            }
        },
        mouseout: function(score, evt) {
            var divID = $r(this).attr('id');
            $r("#"+divID).next("span").text('');
        }
    });

// Showing rating on product detail page
    $r(".review-rating").each(function(i, obj){
        var Score = $r(this).find('span').html();
        
        var id = $r(this).find('div').attr('id');
        $r(this).raty({
            readOnly: true,
            score: Score,
            starOn   : imgPath+'star-on.png',
            starOff  : imgPath+'star-off.png',
            hints: ['Poor', 'Could be better', 'Average', 'Good', 'Amazing'],
         });
    });
// Showing product overall rating
    $r(".product-rating").each(function(i, obj){
        var Score = $r(this).find('span').html();
        var id = $r(this).find('div').attr('id');
        $r(this).raty({
            readOnly: true,
            score: Score,
            starOn   : imgPath+'star-on.png',
            starOff  : imgPath+'star-off.png',
            halfShow: true,
            starHalf: imgPath+'star-half.png',
            hints: ['Poor', 'Could be better', 'Average', 'Good', 'Amazing'],
         });
    });
// Ajax call on filters
$r("#advance_review_filter").change(function(){
    if($r(this).val()) {
        var star = $r(this).val();
        var sort = $r("#review_filter").val();
        if(sort == 'created-desc') {
            var method = 'created';
            var action = 'DESC';
        }
        else if(sort == 'created-asc') {
            var method = 'created';
            var action = 'ASC';
        }
        else if(sort == 'likes') {
            var method = 'likes';
        }
        else if(sort == 'images') {
            var method = 'images';
        }
        var nid = $r("#rnid").val();
        $r("#reviews-wrapper").html("");
        $r.ajax({
            type: "GET",
            url : Drupal.settings.basePath+"reviews_filter?nid="+nid+"&star="+star+"&method="+method+"&action="+action,
            cache: false,
            success: function(data){
                $r("#reviews-wrapper").html(data);
                $r(".review-rating").each(function(i, obj){
                    var Score = $r(this).find('span').html();
                    var id = $r(this).find('div').attr('id');
                    $r('#'+id).raty({
                        readOnly: true,
                        score: Score,
                        starOn   : imgPath+'star-on.png',
                        starOff  : imgPath+'star-off.png',
                        hints: ['Poor', 'Could be better', 'Average', 'Good', 'Amazing'],
                     });
                });
            }
        });
    }
});

$r("#review_filter").change(function(){
    if($r(this).val()) {
        var sort = $r(this).val();
        if(sort == 'created-desc') {
            var method = 'created';
            var action = 'DESC';
        }
        else if(sort == 'created-asc') {
            var method = 'created';
            var action = 'ASC';
        }
        else if(sort == 'likes') {
            var method = 'likes';
        }
        else if(sort == 'images') {
            var method = 'images';
        }
        var star = $r("#advance_review_filter").val();
        var nid = $r("#rnid").val();
        $r.ajax({
            type: "GET",
            url : Drupal.settings.basePath+"reviews_filter?nid="+nid+"&star="+star+"&method="+method+"&action="+action,
            cache: false,
            success: function(data){
                $r("#reviews-wrapper").html(data);
                $r(".review-rating").each(function(i, obj){
                    var Score = $r(this).find('span').html();
                    var id = $r(this).find('div').attr('id');
                    $r('#'+id).raty({
                        readOnly: true,
                        score: Score,
                        starOn   : imgPath+'star-on.png',
                        starOff  : imgPath+'star-off.png',
                        hints: ['Poor', 'Could be better', 'Average', 'Good', 'Amazing'],
                     });
                });
            }
        });
    }
});

    // default value for edit body of review in admin
    var bodyText = $r("#body-hidden").html();
    $r("#reviews-system-review-edit-form #edit-body").text(bodyText);


});

/* Document ready ends here */



function click_like(rid) {
    var ul_id = "#like_dislike_"+rid;
    var hreF = $r(ul_id+" #like").attr('href');
    $r.ajax({
        type: "GET",
        url : hreF,
        success: function(data){
            $r(ul_id).html(data);
            return false;
        }
    });
    return false;
}

function click_dislike(rid) {
    var ul_id = "#like_dislike_"+rid;
    var hreF = $r(ul_id+" #dislike").attr('href');
    $r.ajax({
        type: "GET",
        url : hreF,
        success: function(data){
            $r(ul_id).html(data);
            return false;
        }
    });
    return false;
}
function fbShare(obj) {
                                             
    var hreF = obj;
    
    window.open(
        'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(hreF),
        'facebook-share-dialog',
        'width=626,height=436'
    );
    return false;
}
function twShare(obj) {
                                              
    var hreF = obj;            
    window.open(
        hreF,
        'twitter-share-dialog',
        'width=626,height=436'
    );
    return false;
}
function gShare(obj) {
                                            
    var hreF = obj; 

    window.open(
        'https://plus.google.com/share?url='+encodeURIComponent(hreF),
        'google-share-dialog',
        'width=626,height=436'
    );
    return false;
}
// character limit function for text area
function textareaMaxLength(field, evt, limit) {
  var evt = (evt) ? evt : event;
  var charCode =
    (typeof evt.which != "undefined") ? evt.which :
   ((typeof evt.keyCode != "undefined") ? evt.keyCode : 0);

  if (!(charCode >= 13 && charCode <= 126)) {
    return true;
  }

  return (field.value.length < limit);
}
function limitText(limitField, limitNum) {
        limitCount = $r('#countdown').html();
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount = limitNum - limitField.value.length;
                $r('#countdown').html(limitCount);
	}
}
/*
* admin filter
*/
function show_filter_fileds(Obj) {
    var val = Obj.value;
    $r("#edit-text").val('');
    $r(".filter_criteria").show();
    $r("#edit-text").css('width', 400);
    if(val == 'by_date') {
        $r("#edit-text").css('width', 200);
        $r("#edit-text").datepicker();
    }
    else {
        $r("#edit-text").removeClass("hasDatepicker");
        $r("#edit-text").unbind();
    }
}
