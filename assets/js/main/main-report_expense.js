require(["../common" ], function (common) {  
    require(["main-function","../app/app-report_expense"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});