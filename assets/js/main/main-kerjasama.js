require(["../common" ], function (common) {  
    require(["main-function","../app/app-kerjasama"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});