require(["../common" ], function (common) {  
    require(["main-function","../app/app-handOver"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});