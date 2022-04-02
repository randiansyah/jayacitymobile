require(["../common" ], function (common) {  
    require(["main-function","../app/app-dana_titipan"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});