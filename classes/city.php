<?php 


/**
* 通过ip查询所在城市
*/
class City
{
	/**
	 * 通过ip获取所在城市
	 * $ip 要查询城市地点的ip
	 */
	public static function getAdd($ip)
	{
		//获取接口的返回值
		$data=@file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip=$ip");
		//把数据转换成数组
		$arr=json_decode($data,true);
		//获取数组中的城市值
		$city=$arr['data']['city'];
		//返回获取到的城市
		return $city;
	}
}


 ?>