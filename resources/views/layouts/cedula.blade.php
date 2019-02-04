<!DOCTYPE html>
<html lang="en">
<head>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
    <script src="https://unpkg.com/jspdf-autotable"></script>
</head>
<body>
    <iframe id="pdfFrame" src="" frameborder="0"></iframe>
</body>

<script>
var doc = new jsPDF({
  unit: 'mm',
});

// Header background
doc.setFillColor(204,204,204);
doc.rect(0,0,210, 38.1, 'F');

//Header logos
loadUnamLogo(()=>{
    loadFILogo(()=>{
        loadRightTopText();
        loadTable();
        loadPDF();
    })
})
    


function loadTable(){
    const cellStyles = {lineColor: 0,lineWidth: 0.2}
    doc.autoTable({
        theme: 'plain',
        margin: {
            left:10,
            top:48
        },
        tableWidth: 190,
        tableLineColor: 0,
        tableLineWidth: .2,
        head: [[{
            content: 'Cédula de registro del equipo: {{$team->name}}', 
            colSpan: 5, 
            styles: {
                halign: 'center',
                valign: 'bottom',
                fontSize: 20,
                textColor: 0,
                
            }
        }]],
        body: [
            [
                {
                    content: "",
                    style:{
                        cellPadding: 1
                    }
                }
            ],
            [
                {
                    content: "Datos del torneo",
                    colSpan: 5,
                    styles:{
                        halign: 'center',
                        fontSize: 16,
                        textColor: 0,
                        ...cellStyles
                    }
                },
            ],
            [
                {
                    content: "1",
                    styles:cellStyles
                },
                {
                    content: "1",
                    styles:cellStyles
                },
                {
                    content: "1",
                    styles:cellStyles
                },
                {
                    content: "1",
                    styles:cellStyles
                },
                {
                    content: "1",
                    styles:cellStyles
                },
            ],
        ]
    });
}



function loadRightTopText(){
    doc.setTextColor(0);
    doc.setFontSize(24);
    doc.text("Secretaría de Servicios", 120, 9);
    doc.text("Académicos", 161.5, 17);

    doc.setFontSize(16);
    doc.text("Actividades Deportivas", 150, 27);
}

function loadUnamLogo(next){
    var unamLogo = new Image();
    unamLogo.onload = function (){
        var canvas = document.createElement('canvas');
        canvas.width = this.naturalWidth; 
        canvas.height = this.naturalHeight; 

        canvas.getContext('2d').drawImage(this, 0, 0);
        
        doc.addImage(canvas.toDataURL('image/png'), 'PNG', 3.2, 3.2, 32.1, 32.5);
        next();
    }
    unamLogo.src = "{{asset('images/logo_unam.png')}}"
}

function loadFILogo(next){
    var fiLogo = new Image();
    fiLogo.onload = function (){
        var canvas = document.createElement('canvas');
        canvas.width = this.naturalWidth; 
        canvas.height = this.naturalHeight; 

        canvas.getContext('2d').drawImage(this, 0, 0);
        
        doc.addImage(canvas.toDataURL('image/png'), 'PNG', 34.9, 3.2, 27.5, 32.5);
        next();        
    }
    fiLogo.src = "{{asset('images/logo_fi.png')}}"
}

function loadPDF(){
    pdfFrame.src = doc.output('bloburi')
}

var centeredText = function(text, y) {
    var textWidth = doc.getStringUnitWidth(text) * doc.internal.getFontSize() / doc.internal.scaleFactor;
    var textOffset = (doc.internal.pageSize.width - textWidth) / 2;
    doc.text(textOffset, y, text);
}


</script>

<style>
    body{
        margin: 0;
    }
    #pdfFrame {
        width: 100vw;
        height: 100vh;
    }
</style>

</html>