<?php
	header("Cache-Control:no-cache,must-revalidate,no-store"); 
	$host='10.10.10.200';
	$dbname='apiService';
	$user='root';
	$password='123456';
	$dbh = new PDO("mysql:host=$host;dbname=$dbname",$user,$password);
	$dbh->exec("SET names utf8");
	//$cityCodes=DB::select('select cityCode from city_code');
	$citycodes=$dbh->query('select citycode from city_code');
	$i=1;
	$file = '/opt/dev/webroot/apiService/public/dingshi/'.date('Y').'_'.date('m').'_'.date('d').'_'.date('H').'_'.date('i').'_'.date('s').'.txt';
	//设置程序的最大执行时间（因为程序执行时间较长）
	ini_set('max_execution_time', '600');
	foreach($citycodes as $citycode){
		$i++;
		$code=$citycode['citycode'];
		//获取天气信息的url
		$url='https://api.thinkpage.cn/v3/weather/now.json?key=gzgaljfbxvzlkyvg&location='.$code;
		//获取天气信息
		$weather=file_get_contents($url);
		//转换编码
		$weather=mb_convert_encoding( $weather, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5' );
		//把取得天气信息由json格式转换为数组
		$weather=json_decode($weather,true);
		if(!isset($weather['results'][0]['now']['text'])){
			continue;
		}
		if(count($weather!=0)){
			$sql="select id from weathers_ch where citycode="."'".$code."'";
			$result=$dbh->query($sql);
			//若不存在则插入，若已经存在则更新
			$numcount = $result->rowCount();
			$typecode="'".$weather['results'][0]['now']['code']."'";
			$type="'".$weather['results'][0]['now']['text']."'";
			$temp="'".$weather['results'][0]['now']['temperature']."'";
			$time="'".date('Y-m-d H:i:s',time())."'";
			if($numcount>0){
				$sql="UPDATE weathers_ch SET typecode=$typecode, type=$type, mtime=$time,temp=$temp where citycode="."'".$code."'".";";
				//file_put_contents($file,$sql,FILE_APPEND);
				$result=$dbh->query($sql);
			}else{
				$citycode="'".$weather['results'][0]['location']['id']."'";
				$city="'".$weather['results'][0]['location']['name']."'";
				$citypath="'".$weather['results'][0]['location']['path']."'";
				$sql="INSERT INTO weathers_ch (typecode,citycode,type,temp,city,citypath) VALUES ($typecode,$citycode,$type,$temp,$city,$citypath);";
				//file_put_contents($file,$sql,FILE_APPEND);
				$dbh->query($sql);
    			}
			}
		}
	
	$dbh = null;
?>