$(function () {
    $("#btn-eval").on("click", function () {
        var formBody = $("body");
        var formData = $("#code").val();
        Craft.postActionRequest('phpstorm-craft-workshop/compiler/submit', {code: formData}, $.proxy(function (response) {
            //todo write processor
                }));

    });
});