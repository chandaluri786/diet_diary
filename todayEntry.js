$(document).ready(
    

 
    function () {
    activity = $("#activity"),
    start = $("#start"),
    end = $("#end"),
    item = $("#item"),
    allFields = $([]).add(activity).add(start).add(end).add(item);
    var dialog;
    function addDietEntry() {
        allFields.removeClass("ui-state-error");
        console.log("activity", activity.val());
        console.log("start", start.val());
        console.log("end", end.val());
        console.log("item", item.val());

        $.ajax({
            url: 'ce.php',
            type: "POST",
            data: JSON.stringify(
                {
                        "activity": activity.val(),
                        "start": start.val(),
                        "end": end.val(),
                        "item": item.val()
                    }),
                dataType: "json",
                contentType: 'application/json',
                success: function (result) {
                    location.reload()
                }
            })
            dialog.dialog("close");

        }

     dialog = $("#dialog-form").dialog({
        autoOpen: false,
        height: 400,
        width:  400,
        modal: true,
        buttons: [
            { id : "Cancel",
            text : "Cancel",
            click: function () {
                dialog.dialog("close");
            }
        }
        ,
        {
            id: "Add",
            text: "Add",
            value: "Add",
            click: function () {
                addDietEntry();
            }
        },
        {
            id: "Close",
            text: "Close",
            click: function () {
            form[0].reset();
            allFields.removeClass("ui-state-error");
        }
    }
    ]
    });
    form = dialog.find("form").on("submit", function (event) {
        event.preventDefault();

    });

    $('#add').click(function () {
        dialog.dialog("open");
        console.log("entered");
    });
});
