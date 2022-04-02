require(["../common" ], function (common) {  
    require(["main-function","../app/app-kwitansi-dana"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});