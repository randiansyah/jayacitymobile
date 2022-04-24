require(["../common" ], function (common) {  
    require(["main-function","../app/app-suspend"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});