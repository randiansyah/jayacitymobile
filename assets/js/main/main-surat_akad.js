require(["../common" ], function (common) {  
    require(["main-function","../app/app-surat_akad"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});