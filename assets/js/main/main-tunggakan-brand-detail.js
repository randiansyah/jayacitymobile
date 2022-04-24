require(["../common" ], function (common) {  
    require(["main-function","../app/app-tunggakan-brand-detail"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});