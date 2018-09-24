$(function () {
    $("#code-form").on("submit", function () {
        var formData = $("#code").val();
        Craft.postActionRequest('phpstorm-craft-workshop/compiler/submit', {code: formData}, function (response) {
                    console.log(arguments);
                });
        return false;

    });
});