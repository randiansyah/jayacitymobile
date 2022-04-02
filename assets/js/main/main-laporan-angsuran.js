require(["../common" ], function (common) {  
    require(["main-function","../app/app-laporan-angsuran"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});