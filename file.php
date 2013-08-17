<?php 

	// https://code.google.com/p/php-excel-reader/wiki/Documentation
	// http://eden.openovate.com/documentation/start

	require('spreadsheet-reader/php-excel-reader/excel_reader2.php');
	require('spreadsheet-reader/SpreadsheetReader.php');
	include('eden.php');

	$action = $_GET['action'];
	if ($action && function_exists($action)) {
		call_user_func($action);
	}else{
		echo json_encode(array('msg'=>'woops!'));
	}

	/*
		初始化数据
	*/

	function init(){
		// $data = new Spreadsheet_Excel_Reader("songs.xls",false);
		// echo $data->rowcount();

		$limit = 500;
		$page = 0;
		$rows = array();

		while ($i < $limit*($page+1)) {
			
		}
		$database = eden('mysql', '127.0.0.1' ,'songs', 'root', 'root');

		// $excel = new SimpleExcel('CSV');
		// $excel->parser->loadFile('songs.xls');
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