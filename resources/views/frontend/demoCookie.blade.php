 <?php
$myarray=[];
$myarray['key1']=1233;
$myarray['key2']=22332;
$myarray['key3']=1233;
$myarray['key4']=22332;
$myarray['key5']=1233;
$myarray['key6']=22332;
print_r($myarray);
setcookie('demo', json_encode($myarray,true),time()+60*2000, '/');
echo "cookie set";
if(isset($_COOKIE['demo']))
{	
	$data=stripcslashes($_COOKIE['demo']);
	$d=json_decode($data,true);
	echo count($d);
}
?>