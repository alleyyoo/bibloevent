function modalGenerate(name, reload = false) {
    $("." + name + "ModalButton").click(function () {
        $.get($(this).attr("href"))
            .done(function (html) {
                if (html) {
                    let id = "#" + name + "Modal";
                    if ($(id).length) $(id).remove();
                    $("body").append(html);
                    $(id).modal();
                    $(id).on("shown.bs.modal", function () {
                        let form = $("#" + name + "ModalForm");
                        form.submit(function () {
                            $.post($(this).attr("action"), $(this).serialize())
                                .done(function (response) {
                                    if (response === 'success') {
                                        $(id).modal("hide");
                                        $(id).on("hidden.bs.modal", function () {
                                            if (reload) location.reload();
                                        });
                                    }  else {
                                        Swal.fire({
                                            title: "Hatalı işlem!",
                                            text: "Lütfen tekrar deneyiniz.",
                                            type: "error"
                                        });
                                    }
                                })
                                .fail(function (response) {
                                    form.find(".invalid-feedback").remove();
                                    let errors = response.responseJSON.errors;
                                    for(var i in errors) {
                                        let input = form.find("#modal-" + i).addClass("is-invalid");
                                        for(var j in errors[i]) {
                                            input.parent().append('<span class="invalid-feedback" role="alert"><strong>' + errors[i][j] + '</strong></span>');
                                        }
                                    }
                                });
                            return false;
                        });
                    });
                }
            });
        return false;
    });
}

$(document).ready(function () {

    modalGenerate("password");
    modalGenerate("settings", true);
    modalGenerate("userCreate", true);
    modalGenerate("userUpdate", true);
    modalGenerate("languageCreate", true);
    modalGenerate("languageUpdate", true);
    modalGenerate("fragmentCreate", true);

});
