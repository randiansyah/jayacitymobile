require(["../common" ], function (common) {  
    require(["main-function","../app/app-akad"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});