let dataset_keydown = (e) => {
    let keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
        let row = $(e.target).closest(".row");
        let name = row.data("name");
        let key_input = $("#"+name+"_key");
        let key = key_input.val();
        let value = $("#"+name+"_value").val();
        if (key && value) {
            let clone = row.clone();
            let index = new Date().getTime();
            clone.addClass("dataset");
            clone.find("input").removeAttr("id");
            clone.find("input:eq(0)").attr("name", name+"["+index+"][key]");
            clone.find("input:eq(1)").attr("name", name+"["+index+"][value]");
            clone.append('<a href="javascript:;"><i class="fas fa-minus-circle"></i></a>');
            row.before(clone);
            row.find("input").val("");
            key_input.focus();
        }
        return false;
    }
};

$("body").on("click", ".dataset a", function () {
    $(this).closest(".dataset").remove();
});
