<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>myangular</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/angular/node_modules/mdi/css/materialdesignicons.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/angular/node_modules/angular-material/angular-material.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/angular/css/style.css"/>
<script src="<?php echo base_url();?>assets/angular/node_modules/angular/angular.js"></script>
<script src="<?php echo base_url();?>assets/angular/script/app.js"></script>
<script src="<?php echo base_url();?>assets/angular/component/classified.ctr.js"></script>
<script src="<?php echo base_url();?>assets/angular/node_modules/angular-animate/angular-animate.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/angular/component/classified.ctr.js"></script>
<script src="<?php echo base_url();?>assets/angular/node_modules/angular-aria/angular-aria.js"></script>
<script src="<?php echo base_url();?>assets/angular/node_modules/angular-material/angular-material.js"></script>
</head>

<body ng-app="myangular" ng-controller="studentController">
<md-toolbar>
	<div class="md-toolbar-tools">
    	<p><strong>Angular JS Card Layout</strong></p>
    </div>
</md-toolbar>
<md-content class="md-padding" layout="row" layout-wrap>
	<md-card ng-repeat="item in students  track by $index" flex="3" style="padding: 30px;">
    <div ng-controller="formCtrl">
            <form  name="userForm"  class="well form-search"   >
                
                <input type="text" ng-model="name" class="input-medium" ng-value="item.name" ng-init="name= item.name"  placeholder="Name"  >
                <input type="text" ng-model="email" class="input-medium" ng-init="email= item.email" placeholder="Email">
                <input type="text" ng-model="message" class="input-medium" ng-init="message= item.message" placeholder="Message">
                <button type="submit" class="btn" ng-click="formsubmit(userForm)">Submit </button>
        
            </form>
            <div ng-model="result" ng-show="result" style="border: 1px solid rgb(238, 238, 238);margin-top: 37px;padding: 22px;">
              <div><span>Name:</span><span class="">{{result.name}}</span></div>
              <div><span>Email:</span><span class="">{{result.email}}</span></div>
              <div><span>Message:</span><span class="">{{result.message}}</span></div>
            </div>
        </div>
	</md-card>
</md-content>


</body>
</html>