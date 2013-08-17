<?php 

	// https://code.google.com/p/php-excel-reader/wiki/Documentation
	// http://eden.openovate.com/documentation/start
	ini_set('default_charset', 'utf-8'); 
	
	require('spreadsheet-reader/php-excel-reader/excel_reader2.php');
	require('spreadsheet-reader/SpreadsheetReader.php');
	include('eden.php');

	include('pdo/config.php');
	include('pdo/Mysql.php');
	include('pdo/class.lpdo.php');


	$action = $_GET['action'];
	if ($action && function_exists($action)) {
		call_user_func($action);
	}else{
		echo json_encode(array('msg'=>'woops!'));
	}

	function array_iconv($in_charset,$out_charset,$arr){    
    	return eval('return '.iconv($in_charset,$out_charset,var_export($arr,true).';'));    
	}  

	/*
		初始化数据
	*/

	function init(){
		$data = new Spreadsheet_Excel_Reader("songs.xls",false);

		$limit = 2;
		$page = 0;
		$i = 2;
		
		$db = new Mysql('songs','root','root','192.168.1.104');

		$insert = array();
		$sql = 'INSERT INTO songs (filename,song,language,all_singer,singer_1,singer_2,original,version) VALUES ';
		while($i<=10) {


			$sql.="('".$data->val($i,1)."','";
			$sql.= $data->val($i,2)."','";
			$sql.= $data->val($i,3)."','";
			$sql.= $data->val($i,4)."','";
			$sql.= $data->val($i,5)."','";
			$sql.= $data->val($i,6)."','";
			$sql.= $data->val($i,13)."','";
			$sql.= $data->val($i,15)."')";
			if ($i !=10) {
				$sql.=",";
			}
			
			$i++;
		}
		echo "<br>";
		var_dump($db);
		$db->ExecuteSQL($sql);
	}

	

	/*
		获取列表
	*/
	function get_songs(){
		echo 'test';
	}

	/*
		搜索歌词
	*/

	function search(){

	}