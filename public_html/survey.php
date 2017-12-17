<?php
include 'connection.php';
if(isset($_GET['oid']))
{

$oid=$_GET['oid'];
$uid=$_GET['uid'];
if(isset($_POST['btnSubmit']))
{
	$q1 =  explode(',',$_POST['ques1']);
	$ques1=$q1[1];

	$q2 =  explode(',', $_POST['ques2']);
	$ques2=$q2[1];

	$q3 =  explode(',', $_POST['ques3']);
	$ques3=$q3[1];
	
	$comment=$_POST['comment'];
	$rating1=trim($_POST['yourRating']);
	
	
	
$res=mysql_query("insert into tbl_feedback(OrderId,rating,question1,question2,question3,UserComment,addon) values('$oid','$rating1','$ques1','$ques2','$ques3','$comment',now())") or die(mysql_error());
if(mysql_affected_rows())
{
	
	echo "<script>alert('Thanks for your feedback and support! Visit again');</script>";
	
}
}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<meta name="viewport" content="width=device-width,   initial-scale=1.0, maximum-scale=1, user-scalable=no, maximum-scale=1, user-scalable=no"/><link href="//img1.wsimg.com/ux/1.3.46/css/uxcore.min.css" rel="stylesheet"/><!-- HTML5 shim IE8 support of HTML5 elements and media queries -->
<link href="//img1.wsimg.com/ux/eldorado/1.5.98/css/appheader.min.css" rel="stylesheet"/>
<style>
@import url('//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css');

.uxc-gd-logo {
background-image:url(//img1.wsimg.com/ux/eldorado/1.5.98/images/brand1.0/gd-header-logo.png);
}
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
.uxc-gd-logo {
background-image:url(//img1.wsimg.com/ux/eldorado/1.5.98/images/brand1.0/gd-header-logo2.png);
}
}.uxc-pt-icon {
background-image:url(//img1.wsimg.com/ux/eldorado/1.5.98/images/brand1.0/shopper-type-sprite.png);
}.ux-footer-logo {
background-image: url(//img1.wsimg.com/ux/eldorado/1.5.98/images/brand1.0/gd-header-logo.png);
}
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
.ux-footer-logo{
background-image: url(//img1.wsimg.com/ux/eldorado/1.5.98/images/brand1.0/gd-header-logo2.png);
}
}
.list-group-item.active, .list-group-item.active:hover, .list-group-item.active:focus{
	color:#000;
	height:100px;
	background:#ffffff;
}
.fa-star{ color:#FAE570;}


</style>            <link href="/Content/CSS/pqc-v2-styles.css" rel="stylesheet" />
            <link href="/Content/CSS/1/pqc-site-specific.css" rel="stylesheet" />
<script>var ux = ux || {};
ux.config = ux.config || {};
ux.config.plabel = '1';</script><script src="//img1.wsimg.com/ux/1.3.46/js/uxcore.en.min.js"></script><script>var uxel = ux.eldorado || {};
uxel.fns = [];
uxel.ready = function ready(fn) { uxel.fns.push(fn); };
uxel.data = {
  app: 'unspecified',
  ssoApp: 'unspecified',
  market: 'en-in',
  uiTheme: 'brand1.0',
  languageName: 'English',
  countryName: 'India',
  appAlias: 'unspecified',
  version: '1.5.98',
  currency: 'USD',
  split: '1',
  plId: '1',
  context: {
    isrslr: false,
    isgd: true,
    issppl: false,
    isspgd: false
  },
  tokens: {
    loginApp: '%7B%7Bpc%3Aloginapp%7D%7D',
    loginPath: '%7B%7Bpc%3Acurrentpage%7D%7D'
  },
  impression: 'uxp.eld.int.appheader.unspecified.impression',
  shopperId: '{{pc:shopperid}}',
  env: 'prodPhx',
  manifest: 'appheader',
  urlArgs: '{{pc:urlargs}}',
  formats: {
    sfullname: '%7Bf%7D%20%7Bl%7D',
    smenu: '%7Bf%7D'
  },
  thirdParty: {},
  inappHelpSupported: 'true',
  utilityChatSupported: 'false'
};
uxel.texts = {
  inappHelpTitle: 'Help'
};
uxel.urls = { };
ux.eldorado = uxel;</script>
<script>if (ux.config['disableBrowserDeprecation'] !== true) {
  ux.ready(function() {
    $('<div id="uxh-browser-dep" />')
      .prependTo(document.body)
      .sfBrowser({"ignored":[{"ua":"mobile"}]});
  });
}</script>
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-SXRF" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript><script>uxel.ready(function() {
  uxel.thirdParty.initGATagManager('GTM-SXRF');
});
</script><!-- End Google Tag Manager --><script>ux.jQuery = $;
</script><script>if (window.ux.eldorado && window.ux.eldorado.loadTcc) {
  window.ux.eldorado.loadTcc();
}
</script><script src="//img1.wsimg.com/ux/eldorado/1.5.98/js/appheader.min.js"></script><!-- Manifest appheader --><script src="//img1.wsimg.com/ux/1.3.46/js/uxcontrols.min.js"></script><link href="//img1.wsimg.com/ux/1.3.46/css/uxcontrols.min.css" rel="stylesheet"/>        

        <title>Satisfaction Survey</title>
        
        <script>
            var _gaDataLayer = _gaDataLayer || [];
            _gaDataLayer.push({ 'tcc.status': 'on' });
        </script>
    </head>

    <body class='survey-market-en-in'>
        <div id="survey-header-wrapper">
   
<style type="text/css">
    
</style>





        </div>
        
        <div class="container">
            <div id="survey-content-wrapper" class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-lg-offset-2 col-md-offset-2">
                <div id="survey-content">
                    

    <style>
        body {
            min-width: 450px;
        }
    </style>
<h2 style="text-align: center; color: #679b08;">Thanks for your valuable feedback!</h2>
<h3>
    How are we doing?
</h3>
<h6>
    <p id="header-text">
        Our mission is simple – we're here to provide first-class service . Please tell us how we are living up to your requirements by filling out the survey below based on your most recent customer support interaction.
    </p>
</h6>
<p class="text-right">
    <span class="req">
        * required
    </span> 
</p>

    
<div id="survey-header-error" class="alert alert-danger" style="display: none;">
    <div class="uxicon alert-icon uxicon-alert"></div>
    <span id="survey-header-error-text">
    </span>
</div>

<form action="" id="survey-submit-form" method="post" role="form"><input id="SurveyId" name="SurveyId" type="hidden" value="379" /><input id="Products" name="Products" type="hidden" value="" /><input id="SurveySentId" name="SurveySentId" type="hidden" value="60177123" /><input id="SurveyTakenId" name="SurveyTakenId" type="hidden" value="" /><input id="ShopperId" name="ShopperId" type="hidden" value="144180755" /><input id="RepId" name="RepId" type="hidden" value="20899" /><input id="RepVersion" name="RepVersion" type="hidden" value="196725" /><input id="PfId" name="PfId" type="hidden" value="" /><input id="Source" name="Source" type="hidden" value="" /><input id="SurveyType" name="SurveyType" type="hidden" value="0" /><input id="ShopperPassedOnQueryString" name="ShopperPassedOnQueryString" type="hidden" value="True" /><input id="QueryStringValues" name="QueryStringValues" type="hidden" value="regionsite=IN&amp;marketid=en-IN&amp;s=144180755&amp;r=196725&amp;repid=20899&amp;e=1&amp;SurveySentID=60177123&amp;isc=gdbbj1005&amp;ci=87725&amp;cvosrc=bounceback.1005.gdbbj1005" />        <div id="survey-categories-wrapper">


	
	<div class="container">
	
    <div class="row lead">
    	<span class="pull-left" style="font-size: 16px; font-weight: bold;">Please Rate Us:&nbsp;&nbsp;&nbsp;</span>
        <div id="stars" class="starrr pull-left"></div>
        <span style="font-size: 16px;  font-weight: bold;">&nbsp;&nbsp;&nbsp;You gave a rating of <span id="count">0</span> star(s)</span>
        <input type="hidden" name="yourRating" id="count1" />
	</div>
    
    
</div>
	

<div class="survey-category survey-category-id-700 survey-category-number-1">
        <h6>
            <legend>
                Recent Experience
            </legend>
        </h6>
    
    <div class="survey-questions-wrapper">
    	
    	<div class="form-group survey-question survey-question-id-3506 survey-question-number-1">
    <label class="control-label">
        Please rate your satisfaction with your product experience:<span class="req">*</span>    </label>
    <div class="survey-answers-wrapper survey-question-required-True survey-questiontype-Slider3Control">
                <div class="list-group survey-question-slider">
                    <div class="list-group-item active">
                        <div class="survey-question-slider-top">
                            <div class="col-xs-4 col-sm-4 col-lg-4" style="padding-left: 25px;">
                                Very Dissatisfied
                            </div>
                            <div class="col-xs-4 col-sm-4 col-lg-4 text-center" >
                                Neutral
                            </div>
                            <div class="col-xs-4 col-sm-4 col-lg-4 text-right">
                                Very Satisfied
                            </div>
                        </div>
                        <input type="hidden" name="SingleLineAnswers.Index" value="3506" />
                        <input type="hidden" id="survey-slider-val-3506" name="ques1" value="" >
                        <div class="survey-slider">
                            <div style="float: left;">
                                <div id="survey-slider-3506" >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <div class="clearfix"></div>
    </div>

</div>
<div class="form-group survey-question survey-question-id-3507 survey-question-number-2">
    <label class="control-label">
        Please rate your satisfaction with your customer service representative:<span class="req">*</span>    </label>
    <div class="survey-answers-wrapper survey-question-required-True survey-questiontype-Slider3Control">
                <div class="list-group survey-question-slider">
                    <div class="list-group-item active">
                        <div class="survey-question-slider-top">
                            <div class="col-xs-4 col-sm-4 col-lg-4" style="padding-left: 25px;">
                                Very Dissatisfied
                            </div>
                            <div class="col-xs-4 col-sm-4 col-lg-4 text-center" >
                                Neutral
                            </div>
                            <div class="col-xs-4 col-sm-4 col-lg-4 text-right">
                                Very Satisfied
                            </div>
                        </div>
                        <input type="hidden" name="SingleLineAnswers.Index" value="3507" />
                        <input type="hidden" id="survey-slider-val-3507" name="ques2" value="">
                        <div class="survey-slider">
                            <div style="float: left;">
                                <div id="survey-slider-3507" >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <div class="clearfix"></div>
    </div>

</div>

<div class="form-group survey-question survey-question-id-3508 survey-question-number-3">
    <label class="control-label">
        How likely are you to recommend us to a friend:<span class="req">*</span>    </label>
    <div class="survey-answers-wrapper survey-question-required-True survey-questiontype-SliderControl">
                <div class="list-group survey-question-slider">
                    <div class="list-group-item active">
                        <div class="survey-question-slider-top">
                            <div class="col-xs-4 col-sm-4 col-lg-4" style="padding-left: 25px;">
                                Not At All
                            </div>
                            <div class="col-xs-4 col-sm-4 col-lg-4 text-center" >
                                Neutral
                            </div>
                            <div class="col-xs-4 col-sm-4 col-lg-4 text-right">
                                Extremely Likely
                            </div>
                        </div>
                        <input type="hidden" name="SingleLineAnswers.Index" value="3508" />
                        <input type="hidden" id="survey-slider-val-3508" name="ques3" value="" >
                        <div class="survey-slider">
                            <div style="float: left;">
                                <div id="survey-slider-3508" >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <div class="clearfix"></div>
    </div>

</div>
<div class="form-group survey-question survey-question-id-3509 survey-question-number-4">
    <label class="control-label">
        Please share any additional comments:    </label>
    <div class="survey-answers-wrapper survey-question-required-False survey-questiontype-MultiLineText">
            <div>
                <input type="hidden" name="QuestionAnswers.Index" value="3509" />
                <input name="QuestionAnswers[3509].QuestionId" type="hidden" value="3509">
                <input name="QuestionAnswers[3509].QuestionNumber" type="hidden" value="4">
                <input name="QuestionAnswers[3509].CategoryNumber" type="hidden" value="1">
                <textarea name="comment" data-tcode='survey:question:mlt:379:3509' rows="3" maxlength="4000" class="form-control answer-3509" ></textarea>
            </div>
        <div class="clearfix"></div>
    </div>

</div>
    </div>
</div>

        
        </div>
            <div id="survey-submit" class="text-left">
                <input type="submit" class="btn btn-success btn-lg" data-tcode='survey:footer:submit:button:click' value="Submit" id="survey-submit-button" name="btnSubmit">
            </div>
</form>

<script type="text/javascript">
    $(document).ready(function() {
        

        RenderSliders();
        

        $("#survey-submit-form").submit(function() {
            ClearErrors();

            var error = Validate();

            if (error) {
                $("#survey-header-error-text").html("Please correct all errors below.");
                $("#survey-header-error").show();
                $('html, body').animate({ scrollTop: 0 }, 0);
            }
            RemoveCCNumbers();

            if (!error) {
                $('#survey-submit-button').trigger("click");
            }

            return !error;
        });

        $('.container').bind('resize', function(e) {
            ResizeSliders();
        });
        $(window).resize(function() {
            ResizeSliders();
        });

    });


    function ResizeSliders() {
        require("starfield/sf.slider", function() {
                        
                        var divWidth = $("#survey-slider-3507").closest(".list-group").width();
                        var useVert = 'h';
                        var width = divWidth-20;
                        var pleaseSelectText = 'Please Select';

                        var sliderWidth = $("#survey-slider-3507").width();
                        var sliderValue =  $("#survey-slider-3507").sfSlider('val');
                        if(Math.abs(sliderWidth - divWidth) > 40 || sliderWidth >= divWidth-20) {
                            $("#survey-slider-3507").sfSlider({
                                type:useVert,
                                size: width,
                                unitSize: (width-50)/11,
                                min: 0,
                                max: 11,
                                initVal: sliderValue,
                                snap: true,
                                ticks: [pleaseSelectText,'0','1','2','3','4','5','6','7','8','9','10'],
                                onValueChanged: function(slider, value) {
                                    var answerArray = new Array();

                                        answerArray[1] = "2,1";
                                        answerArray[2] = "2,2";
                                        answerArray[3] = "2,3";
                                        answerArray[4] = "2,4";
                                        answerArray[5] = "2,5";
                                        answerArray[6] = "2,6";
                                        answerArray[7] = "2,7";
                                        answerArray[8] = "2,8";
                                        answerArray[9] = "2,9";
                                        answerArray[10] = "2,10";
                                        answerArray[11] = "2,11";
                                    $('#survey-slider-val-3507').val(answerArray[value]);
                                }
                            }); 
                        }

                        
                        
                        var divWidth = $("#survey-slider-3506").closest(".list-group").width();
                        var useVert = 'h';
                        var width = divWidth-20;
                        var pleaseSelectText = 'Please Select';

                        var sliderWidth = $("#survey-slider-3506").width();
                        var sliderValue =  $("#survey-slider-3506").sfSlider('val');
                        if(Math.abs(sliderWidth - divWidth) > 40 || sliderWidth >= divWidth-20) {
                            $("#survey-slider-3506").sfSlider({
                                type:useVert,
                                size: width,
                                unitSize: (width-50)/11,
                                min: 0,
                                max: 11,
                                initVal: sliderValue,
                                snap: true,
                                ticks: [pleaseSelectText,'0','1','2','3','4','5','6','7','8','9','10'],
                                onValueChanged: function(slider, value) {
                                    var answerArray = new Array();

                                        answerArray[1] = "1,1";
                                        answerArray[2] = "1,2";
                                        answerArray[3] = "1,3";
                                        answerArray[4] = "1,4";
                                        answerArray[5] = "1,5";
                                        answerArray[6] = "1,6";
                                        answerArray[7] = "1,7";
                                        answerArray[8] = "1,8";
                                        answerArray[9] = "1,9";
                                        answerArray[10] = "1,10";
                                        answerArray[11] = "1,11";
                                    $('#survey-slider-val-3506').val(answerArray[value]);
                                }
                            }); 
                        }

                        
                        
                        var divWidth = $("#survey-slider-3508").closest(".list-group").width();
                        var useVert = 'h';
                        var width = divWidth-20;
                        var pleaseSelectText = 'Please Select';

                        var sliderWidth = $("#survey-slider-3508").width();
                        var sliderValue =  $("#survey-slider-3508").sfSlider('val');
                        if(Math.abs(sliderWidth - divWidth) > 40 || sliderWidth >= divWidth-20) {
                            $("#survey-slider-3508").sfSlider({
                                type:useVert,
                                size: width,
                                unitSize: (width-50)/11,
                                min: 0,
                                max: 11,
                                initVal: sliderValue,
                                snap: true,
                                ticks: [pleaseSelectText,'0','1','2','3','4','5','6','7','8','9','10'],
                                onValueChanged: function(slider, value) {
                                    var answerArray = new Array();

                                        answerArray[1] = "3,1";
                                        answerArray[2] = "3,2";
                                        answerArray[3] = "3,3";
                                        answerArray[4] = "3,4";
                                        answerArray[5] = "3,5";
                                        answerArray[6] = "3,6";
                                        answerArray[7] = "3,7";
                                        answerArray[8] = "3,8";
                                        answerArray[9] = "3,9";
                                        answerArray[10] = "3,10";
                                        answerArray[11] = "3,11";
                                    $('#survey-slider-val-3508').val(answerArray[value]);
                                }
                            }); 
                        }

                        
        });
        jQuery(".sf-slider-ticks :first-child").addClass("sf-slider-first-tick");
    }


    function RenderSliders() {

                    
            var divWidth = $("#survey-slider-3507").closest(".list-group").width();
            var useVert = 'h';
            var width = divWidth-20;
            var pleaseSelectText = 'Please Select';
            $("#survey-slider-3507").sfSlider({
                type:useVert,
                size: width,
                unitSize: (width-50)/11,
                min: 0,
                max: 11,
                initVal: 0,
                snap: true,
                ticks: [pleaseSelectText,'0','1','2','3','4','5','6','7','8','9','10'],
                onValueChanged: function(slider, value) {
                    var answerArray = new Array();

                        answerArray[1] = "2,1";
                        answerArray[2] = "2,2";
                        answerArray[3] = "2,3";
                        answerArray[4] = "2,4";
                        answerArray[5] = "2,5";
                        answerArray[6] = "2,6";
                        answerArray[7] = "2,7";
                        answerArray[8] = "2,8";
                        answerArray[9] = "2,9";
                        answerArray[10] = "2,10";
                        answerArray[11] = "2,11";
                    $('#survey-slider-val-3507').val(answerArray[value]);
                }
            });


            
                    
            var divWidth = $("#survey-slider-3506").closest(".list-group").width();
            var useVert = 'h';
            var width = divWidth-20;
            var pleaseSelectText = 'Please Select';
            $("#survey-slider-3506").sfSlider({
                type:useVert,
                size: width,
                unitSize: (width-50)/11,
                min: 0,
                max: 11,
                initVal: 0,
                snap: true,
                ticks: [pleaseSelectText,'0','1','2','3','4','5','6','7','8','9','10'],
                onValueChanged: function(slider, value) {
                    var answerArray = new Array();

                        answerArray[1] = "1,1";
                        answerArray[2] = "1,2";
                        answerArray[3] = "1,3";
                        answerArray[4] = "1,4";
                        answerArray[5] = "1,5";
                        answerArray[6] = "1,6";
                        answerArray[7] = "1,7";
                        answerArray[8] = "1,8";
                        answerArray[9] = "1,9";
                        answerArray[10] = "1,10";
                        answerArray[11] = "1,11";
                    $('#survey-slider-val-3506').val(answerArray[value]);
                }
            });


            
                    
            var divWidth = $("#survey-slider-3508").closest(".list-group").width();
            var useVert = 'h';
            var width = divWidth-20;
            var pleaseSelectText = 'Please Select';
            $("#survey-slider-3508").sfSlider({
                type:useVert,
                size: width,
                unitSize: (width-50)/11,
                min: 0,
                max: 11,
                initVal: 0,
                snap: true,
                ticks: [pleaseSelectText,'0','1','2','3','4','5','6','7','8','9','10'],
                onValueChanged: function(slider, value) {
                    var answerArray = new Array();

                        answerArray[1] = "3,1";
                        answerArray[2] = "3,2";
                        answerArray[3] = "3,3";
                        answerArray[4] = "3,4";
                        answerArray[5] = "3,5";
                        answerArray[6] = "3,6";
                        answerArray[7] = "3,7";
                        answerArray[8] = "3,8";
                        answerArray[9] = "3,9";
                        answerArray[10] = "3,10";
                        answerArray[11] = "3,11";
                    $('#survey-slider-val-3508').val(answerArray[value]);
                }
            });


            
        jQuery(".sf-slider-ticks :first-child").addClass("sf-slider-first-tick");

    }

    function Validate() {
        var error = false;
        //Set Errors

        //Radio Buttons
        $(".survey-questiontype-RadioButton.survey-question-required-True").each(function() {
            var found = $(this).find('input:checked').val();
            if (found === undefined) {
                $(this).closest('.survey-question').addClass("has-error");
                error = true;
            }
        });

        //Check Boxes
        $(".survey-questiontype-Checkbox.survey-question-required-True").each(function() {
            var found = $(this).find('input:checked').val();
            if (found === undefined) {
                $(this).closest('.survey-question').addClass("has-error");
                error = true;
            }
        });

        //Multi Line
        $(".survey-questiontype-MultiLineText.survey-question-required-True").each(function() {
            var found = $(this).find('textarea').first().val();
            if (found === undefined || found.length == 0) {
                $(this).closest('.survey-question').addClass("has-error");
                error = true;
            }
        });
        
        //Single Line
        $(".survey-questiontype-SingleLineText.survey-question-required-True").each(function() {
            var found = $(this).find('input[type=text]').first().val();
            if (found === undefined || found.length == 0) {
                $(this).closest('.survey-question').addClass("has-error");
                error = true;
            }
        });
        
        //Dropdown
        $(".survey-questiontype-DropDownList.survey-question-required-True").each(function() {
            var found = $(this).find('option:selected').first().val();
            if (found === undefined || found.length <= 1) {
                $(this).closest('.survey-question').addClass("has-error");
                error = true;
            }
        });

        //Sliders
        $("[class*='survey-questiontype-Slider'].survey-question-required-True").each(function() {
            var found = $(this).find('input[id*=survey-slider-val]').val();
            if (found === undefined || found == "") {
                $(this).closest('.survey-question').addClass("has-error");
                error = true;
            }
        });

        //Email Address
        var emailVal = $("#survey-input-email-address").val();
        if (!(emailVal === undefined)) {
            if (emailVal.length == 0 || !ValidEmail(emailVal)) {
                $('#survey-content-email').addClass("has-error");
                error = true;
            }
        }
        return error;
    }

    function ValidEmail(email) {
        var pattern = /\S+@\S+/;
        return pattern.test(email);
    }

    function RemoveCCNumbers() {
        var regex = /(?:\d[-]*\d?){11,22}/g;
        $('textarea,input:text').each(function () {
            var val = $(this).val();
            val = val.replace(regex, '*******');
            $(this).val(val);
        });

    }

    function ClearErrors() {
        $('.survey-question').removeClass("has-error");
        $('#survey-content-email').removeClass("has-error");
    }

    function DisableForm(val) {
        $("body :input").attr("disabled", true);
        $('input, textarea, select').prop("readonly", val);
        if (val)
            $('#survey-submit-button').hide();

        $('#survey-iris :input').attr("disabled", false);
        $('#survey-iris textarea').prop("readonly", false);
    }

</script>
<script>
	// Starrr plugin (https://github.com/dobtco/starrr)
var __slice = [].slice;

(function($, window) {
    var Starrr;

    Starrr = (function() {
        Starrr.prototype.defaults = {
            rating: void 0,
            numStars: 5,
            change: function(e, value) {}
        };

        function Starrr($el, options) {
            var i, _, _ref,
                _this = this;

            this.options = $.extend({}, this.defaults, options);
            this.$el = $el;
            _ref = this.defaults;
            for (i in _ref) {
                _ = _ref[i];
                if (this.$el.data(i) != null) {
                    this.options[i] = this.$el.data(i);
                }
            }
            this.createStars();
            this.syncRating();
            this.$el.on('mouseover.starrr', 'i', function(e) {
                return _this.syncRating(_this.$el.find('i').index(e.currentTarget) + 1);
            });
            this.$el.on('mouseout.starrr', function() {
                return _this.syncRating();
            });
            this.$el.on('click.starrr', 'i', function(e) {
                return _this.setRating(_this.$el.find('i').index(e.currentTarget) + 1);
            });
            this.$el.on('starrr:change', this.options.change);
        }

        Starrr.prototype.createStars = function() {
            var _i, _ref, _results;

            _results = [];
            for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
                _results.push(this.$el.append("<i class='fa fa-star-o'></i>"));
            }
            return _results;
        };

        Starrr.prototype.setRating = function(rating) {
            if (this.options.rating === rating) {
                rating = void 0;
            }
            this.options.rating = rating;
            this.syncRating();
            return this.$el.trigger('starrr:change', rating);
        };

        Starrr.prototype.syncRating = function(rating) {
            var i, _i, _j, _ref;

            rating || (rating = this.options.rating);
            if (rating) {
                for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
                    this.$el.find('i').eq(i).removeClass('fa-star-o').addClass('fa-star');
                }
            }
            if (rating && rating < 5) {
                for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
                    this.$el.find('i').eq(i).removeClass('fa-star').addClass('fa-star-o');
                }
            }
            if (!rating) {
                return this.$el.find('i').removeClass('fa-star').addClass('fa-star-o');
            }
        };

        return Starrr;

    })();
    return $.fn.extend({
        starrr: function() {
            var args, option;

            option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
            return this.each(function() {
                var data;

                data = $(this).data('star-rating');
                if (!data) {
                    $(this).data('star-rating', (data = new Starrr($(this), option)));
                }
                if (typeof option === 'string') {
                    return data[option].apply(data, args);
                }
            });
        }
    });
})(window.jQuery, window);

$(function() {
    return $(".starrr").starrr();
});

$( document ).ready(function() {
      
  $('#stars').on('starrr:change', function(e, value){
    $('#count').html(value);
    $('#count1').val(value);
  });
  
  $('#stars-existing').on('starrr:change', function(e, value){
    $('#count-existing').html(value);
  });
});
	
</script>


                </div>
                <div id="survey-footer-wrapper">
<div id="survey-footer" style="padding-top: 30px;">
    <div id="survey-footer-text">
           Copyright &copy; 2017 Laundry Bucket All Rights Reserved. 
    </div>
</div>
                </div>

                
            </div>

           
            
        </div>
        
    </body>

</html>
<?php
}
?>
