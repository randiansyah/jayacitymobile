require(["../common" ], function (common) {  
    require(["main-function","../app/app-notif"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});