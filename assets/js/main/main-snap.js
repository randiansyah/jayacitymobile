require(["../common" ], function (common) {  
    require(["main-function","../app/app-snap"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});