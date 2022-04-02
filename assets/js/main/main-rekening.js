require(["../common" ], function (common) {  
    require(["main-function","../app/app-rekening"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});