var app = angular.module('receiptApp',[]);

app.controller('receiptCtrl', ['$scope', '$http', 
						function($scope, $http){
	
	var config = {
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
  };

  function reboot(){
		$http.get('http://localhost/phpPractice/index.php?boot=1', config).
		success(function(data){
			for(var i=0; i<data.length; i++){
				data[i].ingredient = data[i].ingredient.split(',');
			}
			var arrData = [];
			var arrElemData = [];
			for(var i=0; i<data.length; i++){
				arrElemData.push(data[i]);		
				if((i+1)%3 == 0){
					arrData.push(arrElemData);
					arrElemData = [];
				}
				else if(i+1==data.length){
					arrData.push(arrElemData);
				}
			}
			$scope.arrReceipts = arrData;
		});
	}
	reboot();

	$scope.deleteReceipt = function(id){
		$http.get('http://localhost/phpPractice/index.php?delete='+id).
		success(function(data){
			alert("was deleted!");
			reboot();
		});
	}

	$scope.rec = {};
  $scope.setReceipt = function(){
		var data = angular.toJson($scope.rec, true);
		$http.post('http://localhost/phpPractice/create.php', data, config)
		.success(function(data){
			reboot();
		})
		.error(function(data){

		})
    $scope.rec.name = "";
    $scope.rec.time = "";
    $scope.rec.ingredient = "";
    $scope.rec.description = "";
    $scope.rec.link = "";
	};

	$scope.upd = {};
	$scope.flipInput = function(id){
		$http.get('http://localhost/phpPractice/index.php?update='+id)
		.success(function(data){
			//console.log(data);
			$scope.upd.id = data.id;
			$scope.upd.name = data.name;
			$scope.upd.time = data.time;
			$scope.upd.ingridient = data.ingredient;
			$scope.upd.description = data.description;
			$scope.upd.linkImg = data.link;
		})
	};

	$scope.updateReceipt = function(){
		var data = angular.toJson($scope.upd, true);
		//console.log(data);
		$http.post('http://localhost/phpPractice/update.php', data, config)
		.success(function(data){
			console.log(data);
			reboot();
		})
	};

}]);