var Songs = function($scope,$http){
	//server base 
	var base_url = 'http://localhost/songs/file.php';

	$scope.songs = [];
	$scope.current = null;
	$scope.page = 1;
	$scope.total = 0;
	$scope.uncheck = 0;
	$scope.checked = 0;

	$scope.lyrics = [];

	$scope.setup = function(){
		var url = base_url + '?action=init';
		
		$http.get(url).success(function(data){
			console.log(data);
		});
	}

	$scope.init = function(){
		$scope.get($scope.page);
	}

	$scope.get = function(page){
		var url = base_url + '?action=get_songs&page='+page;
		
		$http.get(url).success(function(data){
			console.log(data);
		});
	}

	$scope.next = function() {
		
	}

	$scope.prev = function() {
		
	}

	$scope.load_more = function(){
		
	}

	$scope.init();
}