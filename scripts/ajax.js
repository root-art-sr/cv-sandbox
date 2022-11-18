$(document).ready(function () {
    $("form").submit(function (event) {
        var formData = {
            pdfname: $("#pdfname").val(),
            pdfurl: $("#pdfurl").val(),
            pdfcontent: $("#pdfcontent").val(),
            htmltopdf: $("#htmltopdf").val()
        };

        $.ajax({
            method: "POST",
            url: "/ajax/pdf.php",
            data: formData,
            encode: true
        }).done(function(data) {
            var win = window.open();
            win.document.write(data);
        });

      event.preventDefault();
    });
});