require(["../common" ], function (common) {  
    require(["main-function","../app/app-saldo"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});