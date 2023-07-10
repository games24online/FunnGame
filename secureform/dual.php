<?php
error_reporting(0);
include_once(__DIR__.'/lang.php');
header('Access-Control-Allow-Origin: *');
header('Content-type: text/html; charset=utf-8');
$server = '/secureform';
$partner = (isset($_GET['partner']))?$_GET['partner']:'vp';
$partner_param = isset($_GET['partner'])?'&partner='.$_GET['partner']:'';
$lpname = isset($_GET['lpname'])?$_GET['lpname']:'';
$lphost = isset($_GET['lpname'])?$_GET['lphost']:'';
$clickid  = isset($_GET['clickid'])?$_GET['clickid']:'';
$country = isset($_GET['country'])?$_GET['country']:$_GET['autocamp'];
$language = (null !== substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2))?substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2):'en';
$lang =(isset($_GET['lang']))?$_GET['lang']:$language;
$ts =(isset($_GET['tsource']))?$_GET['tsource']:'';
$tsource =(isset($_GET['tsource']))?'&tsource='.$_GET['tsource']:'';
$paytpl   = isset($_GET['paytpl'])?'&paytpl='.$_GET['paytpl']:2;
$afseid = isset($_GET['afseid'])?'&afseid='.$_GET['afseid']:'';
$p4 = isset($_GET['p4'])?'&p4='.$_GET['p4']:'';
$uid = isset($_GET['uid'])?'&uid='.$_GET['uid']:'';
$stream = isset($_GET['stream'])?'&stream='.$_GET['stream']:'';
$iframe = isset($_GET['iframe'])?$_GET['iframe']:'';
$debug = isset($_GET['debug'])?'&debug='.$_GET['debug']:'';
$print = isset($_GET['print'])?'&print='.$_GET['print']:'';
$langs = isset($_GET['lang'])?'&lang='.$lang:'';
$optionid = 0;
$translation = getTranslation($lang);
$html = '<link href="'.$server.'/files/style.css" rel="stylesheet" type="text/css">
	<link href="'.$server.'/files/nprogress.css" rel="stylesheet" type="text/css">
	<script src="'.$server.'/files/jquery.min.js" type="text/javascript"></script>
	<script src="'.$server.'/files/nprogress.js" type="text/javascript"></script>
	<script src="/jquery.validate.min.js"></script>
	<script type="text/javascript">
		function validateLog(clickid, data) {
			var urlParams = (new URL(document.location)).searchParams;
			var xhr = new XMLHttpRequest();
			var url = "'.$server.'/logs_validate.php";
			xhr.open("POST", url, true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.send("clickid="+clickid+"&data="+JSON.stringify(data));
		}
	</script>
<!-- keyboard -->
<script type="text/javascript">
	function onKeyboardOnOff(isOpen) {
    if (isOpen) {
		$("html, body").animate({ scrollTop: 0 }, "fast");
    }
}
var originalPotion = false;
$(document).ready(function(){
    if (originalPotion === false) originalPotion = $(window).width() + $(window).height();
});
function getMobileOperatingSystem() {
    var userAgent = navigator.userAgent || navigator.vendor || window.opera;
    if (/windows phone/i.test(userAgent)) {
        return "winphone";
    }
    if (/android/i.test(userAgent)) {
        return "android";
    }
    if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
        return "ios";
    }

    return "";
}
function applyAfterResize() {
    if (getMobileOperatingSystem() != "ios") {
        if (originalPotion !== false) {
            var wasWithKeyboard = $("body").hasClass("view-withKeyboard");
            var nowWithKeyboard = false;
                var diff = Math.abs(originalPotion - ($(window).width() + $(window).height()));
                if (diff > 100) nowWithKeyboard = true;
            $("body").toggleClass("view-withKeyboard", nowWithKeyboard);
            if (wasWithKeyboard != nowWithKeyboard) {
                onKeyboardOnOff(nowWithKeyboard);
            }
        }
    }
}
$(window).on("focus blur", "select, textarea, input[type=text], input[type=date], input[type=password], input[type=email], input[type=number]", function(e){
    var $obj = $(this);
    var nowWithKeyboard = (e.type == "focusin");
    $("body").toggleClass("view-withKeyboard", nowWithKeyboard);
    onKeyboardOnOff(nowWithKeyboard);
});
$(window).on("resize orientationchange", function(){
    applyAfterResize();
});
</script>
<!-- keyboard -->
	<script type="text/javascript">
	$.validator.setDefaults({
		submitHandler: function(form) {
			NProgress.start();';
		$html .= '
			$(form).find("input[type=submit]").prop("disabled", true);
			$(form)[0].submit();';
		$html .='},
		onkeyup: function(element) {
			var el = $(element).attr("name");
			setTimeout(function() {
				if($(element).hasClass("error") == true) {
				/*	$("#"+el+"-info").hide(); */
				}
				else {
					$("#"+el+"-info").show();
				}
			}, 1);
            this.element(element);
        },
		invalidHandler: function(event, validator) {
			var errors = validator.numberOfInvalids();
            if (errors) {
                var invalidElements = validator.invalidElements(),
				arrayElements = new Object();
				for (const [key, value] of Object.entries(invalidElements)) {
				if($(value).is("input")) {
					 setTimeout(function() { 
						if($(value).hasClass("error")) {
							$(value).next(".labels").find("label.info").hide();
						}
					}, 100);
					arrayElements[key] = {"name":$(value).attr("name"),"message":validator.errorList[key].message,"method":validator.errorList[key].method,"value":$(value).val()};
				 }
				}
				setTimeout(function() {
					$("form#signupForm").find("input.valid").next(".labels").find("label.info").show();
				}, 100);
				validateLog("'.$clickid.'", arrayElements);
            }
		}
	});
	
	$.validator.addMethod("onlyLatinAndNumber", function (value) {
		return /^[A-Za-z0-9@.\s]*$/.test(value);
	});
	
	$.validator.addMethod("onlyLatin", function (value) {
		return /^[A-Za-z\s]*$/.test(value);
	});

	$().ready(function() {
		$("#signupForm").validate({
			onkeyup: false,
			onfocusout: false,
			rules: {
				email: {
					required: true,
					email: true,
					onlyLatinAndNumber: true, ';
	if(mb_substr($partner,0,2) == 'vp') {
					$html .= 'remote: {
						url: "'.$server.'/mx.php",
						type: "post",
						data: {
						  email: function() {
							return $("input[name=email]").val();
						  }
						}
					  } ';
	}				  
					$html .= '},
				password: {
					required: true,
					minlength: 6,
					maxlength: 15,
					onlyLatinAndNumber: true,
				}
			},
			messages: {
				email: {
					required: "'.$translation['validateEmailRequired'].'",
					email: "'.$translation['validateEmail'].'",
					onlyLatinAndNumber: "'.$translation['validateLatinAndNumber'].'", ';
	if(mb_substr($partner,0,2) == 'vp') {				
					$html .= 'remote: "'.$translation['validateEmail'].'"';
	}				
				$html .= '},
				password: {
					required: "'.$translation['validatePasswordRequired'].'",
					minlength: "'.$translation['validatePasswordLength'].'",
					maxlength: "'.$translation['validatePasswordLength'].'",
					onlyLatinAndNumber: "'.$translation['validateLatinAndNumber'].'",
				}
			},
			errorPlacement: function(error, element) {
				  element.next(".labels").find("label.errors").replaceWith(error);
			}
		});
	});
	</script>
    <form name="signupForm" id="signupForm" action="'.$server.'/'.$partner.'.php'.'?clickid='.$clickid.$tsource.$afseid.$p4.$uid.$stream.$debug.$print.$langs.$partner_param.'" method="post" enctype="multipart/form-data">
			<legend>'.$translation['emailLegend'].'</legend>
			<input name="email" type="email" value="" placeholder="'.$translation['emailPlaceholder'].'"/>
		<div class="labels">
			<label class="errors"></label>
			<label class="info" id="email-info">'.$translation['emailLabel'].'</label>
		</div>	
			<legend>'.$translation['passwordLegend'].'</legend>
			<input name="password" type="password" value="" placeholder="'.$translation['passwordPlaceholder'].'" autocomplete="off"/>
		<div class="labels">
			<label class="errors"></label>
			<label class="info" id="password-info">'.$translation['passwordLabel'].'</label>
		</div>
			<input type="hidden" name="optionid" value="'.$optionid.'"/>
			<input type="hidden" name="lpname" value="'.$lpname.'"/>
			<input type="hidden" name="lphost" value="'.$lphost.'"/>
			<input type="hidden" name="country" value="'.$country.'"/>
			<input type="hidden" name="language" value="'.$language.'"/>
			<input type="submit" value="'.$translation['play_now'].'">
	</form>';

function sendGetRequest($url, $headers = []) {
    $ret = [
        'header'   => '',
        'response' => '',
    ];
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $response = curl_exec($ch);
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    curl_close($ch);
    $ret['header']   = trim(substr($response, 0, $header_size));
    $ret['response'] = trim(substr($response, $header_size - 1));
    return $ret;
}
function check_expires($string) {
    $expires = strtotime('+1 day');
    $res = [];
    if (preg_match('#expires\s*?=([^;]*?);#su', $string, $res)) {
        $expires = strtotime(trim(explode(',', $res[1])[0]));
    }

    return $expires >= time();
}
require_once(__DIR__.'/logs.php');
$referer = (strlen($_SERVER['HTTP_REFERER'])>0)?$_SERVER['HTTP_REFERER']:'//'.$_GET['lphost'].'/'.$_GET['lpname'].str_replace('/secureform/index.php', '', $_SERVER['REQUEST_URI']);
new Logs('form',['clickid'=>$_GET['clickid'],'url'=>$referer,'partner'=>$_GET['partner']]);

echo $html;
?>