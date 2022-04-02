require(["../common" ], function (common) {  
    require(["main-function","../app/app-report_tarik"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});
