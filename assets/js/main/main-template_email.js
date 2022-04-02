require(["../common" ], function (common) {  
    require(["main-function","../app/app-template_email"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});