$("document").ready(function () {
    // Tooltips
    tippy("#tooltipExport", {
        content: "No se seleccionaron elementos!",
    });
    tippy(".tooltipTimetable", {
        content: "Haz doble click para editar",
    });

    editTimetable();
});

function editTimetable() {
    let confirm = document.getElementById("confirm-time");
    [].forEach.call(
        document.getElementsByClassName("weekDays"),
        function (row) {
            let inputs = row.querySelectorAll("input");

            row.addEventListener("dblclick", (event) => {
                inputs.forEach((input) => {
                    input.style.background = "#F9E79F";
                    input.removeAttribute("disabled");

                    confirm.style.display = "block";
                });
            });
        }
    );
}
