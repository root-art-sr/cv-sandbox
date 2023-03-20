<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>PDF DOM Reading: sascha_riess_cv_<?= $pdfname ?>.pdf</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="/favicon.png" type="image/png" />
<!-- link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" -->
<link rel="stylesheet/less" type="text/css" href="/local_less/main.less" />
<script src="/scripts/less.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</head>
<body>
    <div id="canvas_div_pdf">
        <?= $pdfcontent ?>
        <div class="hbar">
            <span class="hbarheadline">&nbsp;</span>
        </div>
    </div>
<script>
let element = document.getElementById('canvas_div_pdf');
let opt = {
    margin:       0.610,
    filename:     'sascha_riess_cv_<?= $pdfname ?>.pdf',
    image:        { type: 'jpeg', quality: 1 },
    html2canvas:  { scale: 2, logging: true, dpi: 192, letterRendering: true },
    jsPDF:        { unit: 'cm', format: 'a4', orientation: 'portrait' },
    pagebreak:    { mode:  ['avoid-all', 'legacy'] }
};

/*
html2pdf().set(opt).from(element).toPdf().get('pdf').then(function (pdf) {
  window.open(pdf.output('bloburl'), '_parent');
});
*/

setTimeout(function () {
    html2pdf().set(opt).from(element).toPdf().get('pdf').save();
}, 100);

window.onfocus = function () {
    setTimeout(function () {
        window.close();
    }, 150);
};
</script>
</body>
</html>