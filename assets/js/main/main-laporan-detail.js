require(["../common" ], function (common) {  
    require(["main-function","../app/app-laporan-detail"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});