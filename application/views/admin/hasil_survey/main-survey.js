require(["../common" ], function (common) {  
    require(["main-function","../app/app-survey"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});