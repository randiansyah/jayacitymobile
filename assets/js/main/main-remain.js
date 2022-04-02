require(["../common" ], function (common) {  
    require(["main-function","../app/app-remain"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});