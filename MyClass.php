<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css.css">
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
    </head>
    <body>
        <div class="menuBar">
            <h1>My<br>School</h1>
            <ul>
                <li class="selectedList"><a href="MyClass.html">My Class</a></li>
                <li><a href="Timetable.html">Timetable</a></li>
                <li><a href="MyProgess.html">My Progess</a></li>
                <li><a href="Teacher.html">Teacher</a></li>
                <li><a href="Activities.html">Activities</a></li>
            </ul>
        </div>
        <p class="header"></p>
        
        <div class="pageContent" ng-app="myApp" ng-controller="studentCtrl">
            <div ng-show="tableDiv">
                <select ng-options="class as class.Name for class in classes" ng-model="selectedClass" ng-change="classSelected()">
                    <option value="" disabled selected>Class..</option>
                </select>
                <table ng-show="myTableShow">
                    <tr>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Birthday</th>
                        <th>Phone</th>
                    </tr>
                    <tr ng-repeat="x in students" ng-click="studentSelected(x)">
                        <td style="width: 200px">{{ x.Name }}</td>
                        <td style="width: 100px">{{ x.Sex }}</td>
                        <td>{{ x.Birthday }}</td>
                        <td>{{ x.Phone }}</td>
                    </tr>
                </table>
            </div>
            <div ng-hide="tableDiv">
                
                <form class="studentForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                    <h1>Student Information</h1>
                    <label for="studentName">Full name:</label><br>
                    <input type="text" name="studentName" ng-model="infoName" ng-value="selectedStudent.Name"><br>
                    <label for="studentGender">Gender:</label><br>
                    <input type="text" name="studentGender" ng-model="infoGender" ng-value="selectedStudent.Sex"><br>
                    <label for="studentBirthday">Birthday:</label><br>
                    <input type="text" name="studentBirthday" ng-model="infoBirthday" ng-value="selectedStudent.Birthday"><br>
                    <label for="studentPhone">Phone number:</label><br>
                    <input type="text" name="studentPhone" ng-model="infoPhone" ng-value="selectedStudent.Phone"><br>
                    <input type="button" value="Cancel" ng-click="cancelClicked()">
                    <input type="submit" value="Confirm Change" ng-click="infoSubmit()">
                </form>
            </div>
        </div>

        <script>
            var app = angular.module('myApp', []);
            app.controller('studentCtrl', function($scope, $http) 
            {
                var studentList = "";
                var temp = "";
                $http.get("student_mysql.php").then(function (response) {studentList = response.data.records;});
                $http.get("class_mysql.php").then(function (response) {$scope.classes = response.data.records;});
                $scope.tableDiv = true;
                
                $scope.classSelected = function () {
                    $scope.students = studentList.filter(function(item) {
                        return item.Class == $scope.selectedClass.ID;});
                    $scope.myTableShow = true;
                };
                $scope.studentSelected = function(x) {
                    temp = "";
                    $scope.tableDiv = !$scope.tableDiv;
                    $scope.selectedStudent = x;
                    temp = x;
                };
                $scope.cancelClicked = function() {
                    $scope.selectedStudent = temp;
                    $scope.tableDiv = !$scope.tableDiv;
                };
                $scope.infoSubmit = function() {
                    $http({
                        method: "POST", 
                        url: "infoSubmit.php",  
                        data: {
                        name: $scope.infoName,
                        gender: $scope.infoGender,
                        birthday: $scope.infoBirthday,
                        phone: $scope.infoPhone 
                        }
                        }).success(function(response) {
                            console.log(response); //get the echo value from php page
                        }).error(function(response) {
                                console.log(response);
                        });
                }
            });
        </script>
    </body>
</html>