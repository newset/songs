var Songs = function($scope,$http){
	//server base 
	var base_url = 'http://localhost/songs/file.php';

	$scope.songs = [];
	$scope.list = [];
	$scope.current = null;
	$scope.page = 1;
	$scope.total = 0;
	$scope.uncheck = 0;
	$scope.checked = 0;

	$scope.lyrics = [];

	$scope.setup = function(){
		// var url = base_url + '?action=init';
		
		// $http.get(url).success(function(data){
		// 	console.log(data);
		// });
	}

	$scope.change_current = function(song,index){
		$scope.current = song;
		$scope.lyrics = [];
	}

	$scope.init = function(){
		$scope.get($scope.page);
	}

	$scope.get = function(page){
		var url = base_url + '?action=get_songs&page='+page;
		
		$http.get(url).success(function(data){
			$scope.songs = data;
		});
	}

	$scope.refresh_page = function(){

	}

	$scope.next = function() {
		
	}

	$scope.prev = function() {
		
	}

	$scope.load_more = function(){
		
	}

	$scope.search = function(){
		var name = $scope.current.song,
			singer = $scope.current.singer_1,
			url = 'http://geci.me/api/lyric/'+name+'?id=1&jsoncallback=?';

		$.getJSON(url,function(data){
			$scope.lyrics = data.result;
		});
	}

	$scope.init();
	
	$scope.$watch("songs",function(){
		if (!$scope.current && $scope.songs) {
			$scope.current = $scope.songs[0];
		};
	});
}