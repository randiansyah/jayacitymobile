define([
    "jQuery",
    "bootstrap",
    "sidebar"
], function($, boostrap, sidebar) {
    return {
        init: function() {
            App.initFunc();
            App.initEvent();
        },
        initEvent: function() {
            $(".edit").on("click", function() {
                var id = $(this).data("id");

                $.ajax({
                    url: App.baseUrl + "template_email/edit",
                    method: "POST",
                    data: {id : id},
                    success: function(data) {
                        $("#myModal").modal("show");
                        $("#tampil_modal").html(data);
                    }
                });
            })
        }
    }
});