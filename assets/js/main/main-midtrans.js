require(["../common" ], function (common) {  
    require(["main-function","../app/app-midtrans"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});