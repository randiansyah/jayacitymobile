require(["../common" ], function (common) {  
    require(["main-function","../app/app-menu-admin"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});