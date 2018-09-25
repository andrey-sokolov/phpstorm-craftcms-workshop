$(function () {
    $("#code-form").on("submit", function () {
        var formData = $("#code").val();
        var $btn = $("#btn-eval");
        $btn.attr("disabled", true);
        Craft.postActionRequest('phpstorm-craft-workshop/compiler/submit', {code: formData}, function (response) {
            alert(response);
            $btn.removeAttr("disabled");
        });
        return false;

    });
});