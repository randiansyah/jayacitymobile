require(["../common" ], function (common) {  
    require(["main-function","../app/app-lunas"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});