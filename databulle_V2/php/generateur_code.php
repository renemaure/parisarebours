<?php
	function verifnom(){
		$knom ="";
		if (isset($_COOKIE['nom'])) $knom = $_COOKIE['nom'].", ";
		return $knom;
	}
	
	function lirejsourc($pointpoint){
		$json_source = file_get_contents($pointpoint.'bin/commun.json');
		return $json_source;
	}
	
	function jsource($pointpoint){
		$json_source = lirejsourc($pointpoint);
		$commun = json_decode($json_source, true);
		return $commun;
	}
	
	function refdatabule(){
		if (isset($_GET['dtb'])) $ref_dtb = $_GET['dtb']; /* recupere la variable en get corespondant au databulle */
		return $ref_dtb;
	}
	
	function footer($pointpoint){
		$commun = jsource($pointpoint);
		$rtr = "\r";
		$nl = "\n";
		$tt = "\t";
		$text_dtb="";
		$text_dtb .=$nl.$tt.$tt.$tt."<div class=\"footer\" data-role=\"footer\" data-position=\"fixed\" id`\"footer\">".$rtr;
		$text_dtb .="\t\t\t\t<p class=\"txt_footer\"><span class=\"fg margg20\">".$commun["titre"]."</span>  Version : ".$commun["etape_ver"]." ".$commun["num_ver"]." au ".$commun["date_ver"];	
		$text_dtb .="<a href=\"#credits\" data-rel=\"dialog\" class=\"fdroit margd20\">Infos datadulle</a></p>\r";
		$text_dtb .="\t\t\t</div>";
		echo $text_dtb;
	}
	
	function credit(){
		$rtr = "\r";
		$tt = "\t";
		$nl = "\n";
		$text_dtb="";
		$text_dtb .="<div data-role=\"dialog\" data-theme=\"a\" id=\"credits\">".$rtr;	
		$text_dtb .=$tt.$tt.$tt.'<div data-role="header">'.$rtr;
		$text_dtb .=$tt.$tt.$tt.$tt.'<h1>Information Datadulle</h1>'.$rtr;
		$text_dtb .=$tt.$tt.$tt.'</div>'.$rtr;
		$text_dtb .=$tt.$tt.$tt.'<div data-role="content" data-theme="b">'.$rtr;
		$text_dtb .=$tt.$tt.$tt.$tt.'Ici du texte a afficher'.$rtr;
		$text_dtb .=$tt.$tt.$tt.'</div>'.$rtr;
		$text_dtb .=$tt.$tt.'</div>'.$rtr;
		echo $text_dtb;
	}
	function jsonjs($pointpoint){
		$json_source = lirejsourc($pointpoint);
		$json_source = str_replace("\n","",$json_source);
		$json_source = str_replace("\r","",$json_source); 
		$json_source = str_replace("\"","'",$json_source);  
		echo"commun = \"".$json_source."\";"; 
	}
	
	function generathead($pointpoint){
		$commun = jsource($pointpoint);
		$rtr = "\r\t\t";
		$nl = "\n";
		$text_head = "<meta charset=\"utf-8\">".$nl;
		$text_head .= $rtr."<title>".$commun["titre"]."</title>".$nl;
		$text_head .= $rtr."<meta name=\"author\" content=\"collectif 11880\">";
		$text_head .= $rtr."<meta name=\"viewport\" content=\"user-scalable=no, width=device-width, initial-scale=1\"/>";
		$text_head .= $rtr."<meta name=\"apple-mobile-web-app-capable\" content=\"yes\">".$nl;
		$text_head .= $rtr."<link rel=\"stylesheet\" href=\"".$pointpoint."bin/css/master.css\"/>".$nl;
		$text_head .= $rtr."<script src=\"".$pointpoint."bin/jquery/jquery-1.11.3.min.js\"></script>";
		$text_head .= $rtr."<script src=\"".$pointpoint."bin/jquery/jquery.mobile-1.4.5.min.js\"></script> ";
		echo $text_head;
	}
?>