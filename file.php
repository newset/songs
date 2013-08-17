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

		$limit = 1000;
		$page = 0;
		$i = 2;
		
		$db = new Mysql('songs','root','root','192.168.1.104');

		$insert = array();
		$sql = 'INSERT INTO songs (filename,song,language,all_singer,singer_1,singer_2,original,version) VALUES ';
		while($i<=1000) {

			$sql.='("'.$data->val($i,1).'","';
			$sql.= $data->val($i,2).'","';
			$sql.= $data->val($i,3).'","';
			$sql.= $data->val($i,4).'","';
			$sql.= $data->val($i,5).'","';
			$sql.= $data->val($i,6).'","';
			$sql.= $data->val($i,13).'","';
			$sql.= $data->val($i,15).'")';
			if ($i !=1000) {
				$sql.=",";
			}
			
			$i++;
		}
		$db->ExecuteSQL($sql);
	}

	

	/*
		获取列表
	*/
	function get_songs(){
		header("Content-type: application/json");
		$page =isset($_GET['page']) ? $_GET['page'] : 1;
		$per_page = 100;
		$page = intval($page) && $page>0 ? $page : 1;
		$db = new Mysql('songs','root','root','192.168.1.104');
		$offset = ($page-1)*$per_page;
		$limit = $page*$per_page;
		$sql = "select * from songs limit $offset,$per_page";
		$data = $db->ExecuteSQL($sql);
		echo json_encode($data);
	}

	/*
		搜索歌词
	*/

	function search(){

	}