<?php
$secured=true;
require_once 'include/config.php';

if(!isset($_GET['pw']) || empty($_GET['pw']) || $_GET['pw']!=$accesspassword){
	die('unauthorized');
}
echo'<center><b>FEATURED <a href="partners.php" target="_blank">PARTNERS</a></b></center>';
foreach($ccs as $ccid=>$cc){
	$basetemplate='<a href="'.$cc['url'].'" target="_blank" title="'.$cc['desc'].'"><img src="'.$cc['icon'].'" alt=""/> '.$cc['title'].'</a>';

	//var_dump($cc);
	if($cc['type']=='twitch' && ($twitchinfo = json_decode(@file_get_contents('https://api.twitch.tv/kraken/streams?channel=' . $cc['tname']), true))!==null && !empty($twitchinfo['streams'][0]['preview']['small'])){
		echo'<table><tr>';
		echo'<td>';
		echo'<img src="'.$twitchinfo['streams'][0]['preview']['small'].'?'.date('H').'" alt="" style="height:36px;width:64px;background-color:black;"/>';
		echo'</td><td>';
		echo $basetemplate;
		echo'&nbsp;<small><b style="color:red;">LIVE</b></small><br/><small>'.$twitchinfo['streams'][0]['viewers'].' viewers</small>';
		echo'</td>';
		echo'</tr></table>';
	}else{
			$collect.=$basetemplate.'<br/>';
	}
}
echo $collect;

echo'<br/><br/><div style="float:right;text-align:right;"><a href="partners.php" target="_blank"><small>GET FEATURED</small></a></div>';
exit;
