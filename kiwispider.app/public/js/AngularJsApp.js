var appA =  angular.module('TasksApp',['ngRoute',  'ui.bootstrap'],function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});
