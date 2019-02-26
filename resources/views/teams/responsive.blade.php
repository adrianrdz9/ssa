<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
    <script src="https://unpkg.com/jspdf-autotable"></script>
</head>
<body>
    <iframe id="pdfFrame" src="" frameborder="0"></iframe>
</body>

<script>
const cellStyles = {lineColor: 0,lineWidth: 0.2}

var doc = new jsPDF({
  unit: 'mm',
});

// Header background
doc.setFillColor(204,204,204);
doc.rect(0,0,210, 38.1, 'F');
doc.setFontSize(14);
//Header logos
loadUnamLogo(()=>{
    loadFILogo(()=>{
        loadRightTopText();
        loadTable();
        loadUsersTable();
        doc.addPage();
        doc.setFillColor(204,204,204);
        doc.rect(0,0,210, 38.1, 'F');
        loadUnamLogo(()=>{
            loadFILogo(()=>{
                loadResponsive(()=>{
                    loadPDF();
                });
            });
        });
    })
})

function loadResponsive(next){
    doc.setFontSize(26);
    centeredText('Responsiva', 60);
    doc.setFontSize(12);


    doc.text(`Declaro estar sano y apto para participar en el evento deportivo {{$team->branch->tournament->name}} reconozco los riesgos inhertes a la práctica
            deportiva, por lo que voluntariamente y con conocimiento pleno de esto, acepto y asumo la responsabilidad de mi integridad física y
            libero de toda responsabilidad a la Universidad Nacional Autónoma de México, a la 
           Dirección General del Deporte Universitario y al Comité Organizador.`, 15,75, {maxWidth: 175, align: "justify"});
    doc.setLineWidth(0.5)
    doc.setDrawColor(0,0,0);
    doc.line(20, 145, 85, 145)
    centeredText('Firma del alumno', 150, 65, 20)
    centeredText('({{$user->name}} {{$user->last_name}})', 155, 65, 20)

    doc.line(120, 145, 190, 145)
    centeredText('Firma del padre o tutor', 150, 70, 120)
    centeredText('(alumnos menores de edad)', 155, 70, 120)

    var unamLogo = new Image();
    unamLogo.onload = function (){
        var canvas = document.createElement('canvas');
        canvas.width = this.naturalWidth; 
        canvas.height = this.naturalHeight; 

        var ctx = canvas.getContext('2d');
        ctx.globalAlpha = 0.2;
        ctx.drawImage(this, 0, 0);
        var center = (doc.internal.pageSize.width)/2;
        doc.addImage(canvas.toDataURL('image/png'), 'PNG', center-50, 80,100, 100);
        next();
    }
    unamLogo.src = "{{asset('images/logo_unam.png')}}"

}
    
function loadUsersTable(){
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
            content: 'Datos del usuario', 
            colSpan: 6, 
            styles: {
                halign: 'center',
                valign: 'bottom',
                fontSize: 20,
                textColor: 0,
                
            }
        }]],
        body: [
            [
                @for($i =0; $i < 6; $i++)
                {
                    content: "",
                    style:{
                        cellPadding: 1
                    }
                },
                @endfor
            ],
        ]
    });

        doc.autoTable({
            body: [
                [
                    @for($i =0; $i < 6; $i++)
                    {
                        content: "",
                        style:{
                            cellPadding: 1
                        }
                    },
                    @endfor
                ],
                [
                    {
                        content: "{{$user->name}} {{$user->last_name}}",
                        colSpan: 6,
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
                        content: "Número de cuenta: ",
                        styles:cellStyles
                    },
                    {
                        content: "{{$user->account_number}}",
                        styles:cellStyles,
                        colSpan: 5
                    },
                ],
                [
                    {
                        content: "Carrera: ",
                        styles:cellStyles
                    },
                    {
                        content: "{{$user->career}}",
                        styles:cellStyles,
                        colSpan: 2
                    },
                    {
                        content: "Semestre: ",
                        styles:cellStyles
                    },
                    {
                        content: "{{$user->semester}}",
                        styles:cellStyles,
                        colSpan: 2
                    },
                ],
                [ 
                    {
                        content: "Peso: ",
                        styles:cellStyles
                    },
                    {
                        content: "{{$user->weight}}kg",
                        styles:cellStyles,
                    },
                    {
                        content: "Altura: ",
                        styles:cellStyles
                    },
                    {
                        content: "{{$user->height}}cm",
                        styles:cellStyles,
                    },
                    {
                        content: "Tipo de sangre: ",
                        styles:cellStyles
                    },
                    {
                        content: "{{$user->blood_type}}",
                        styles:cellStyles,
                    },
                ],
                [
                    {
                        content: "CURP: ",
                        styles:cellStyles
                    },
                    {
                        content: "{{$user->curp}}",
                        styles:cellStyles,
                    },
                    {
                        content: "Servicio médico: ",
                        styles:cellStyles
                    },
                    {
                        content: "{{$user->medical_service}}",
                        styles:cellStyles,
                    },
                    {
                        content: "Número de carnet: ",
                        styles:cellStyles
                    },
                    {
                        content: "{{$user->medical_card_no}}",
                        styles:cellStyles,
                    },
                ],
                [
                    {
                        content: "Teléfono: ",
                        styles:cellStyles
                    },
                    {
                        content: "{{$user->phone_number}}",
                        styles:cellStyles,
                        colSpan: 2
                    },
                    {
                        content: "Email: ",
                        styles:cellStyles
                    },
                    {
                        content: "{{$user->email}}",
                        styles:cellStyles,
                        colSpan: 2
                    },
                ],
                [
                    {
                        content: 'Dirección: ',
                        styles: cellStyles
                    },
                    {
                        content: "{{$user->address}}",
                        styles: cellStyles,
                        colSpan: 5
                    }
                ]
                
            ]
        })
}

function loadTable(){
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
            content: 'Cédula de registro', 
            colSpan: 6, 
            styles: {
                halign: 'center',
                valign: 'bottom',
                fontSize: 20,
                textColor: 0,
                
            }
        }]],
        body: [
            [
                @for($i =0; $i < 6; $i++)
                {
                    content: "",
                    style:{
                        cellPadding: 1
                    }
                },
                @endfor
            ],
        ]
    });
    doc.autoTable({
        body: [
            [
                @for($i =0; $i < 6; $i++)
                {
                    content: "",
                    style:{
                        cellPadding: 1
                    }
                },
                @endfor
            ],
            [
                {
                    content: "Datos del equipo ({{$team->name}})",
                    colSpan: 6,
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
                    content: "Torneo al que pertenece: ",
                    styles:cellStyles
                },
                {
                    content: "{{$team->branch->tournament->name}}",
                    styles:cellStyles,
                    colSpan: 2
                },
                {
                    content: "Rama: ",
                    styles:cellStyles
                },
                {
                    content: "{{$team->branch->branch}}",
                    styles:cellStyles,
                    colSpan: 2
                },
            ],
            [
                {
                    content: "Equipo representativo: ",
                    styles:cellStyles
                },
                {
                    content: "{{$team->isRepresentative ? 'Si' : 'No'}}",
                    styles:cellStyles
                },
                {
                    content: "Inscripción completada: ",
                    styles:cellStyles
                },
                {
                    content: "{{$team->completed ? 'Si' : 'No'}}",
                    styles:cellStyles
                },
                {
                    content: "Abierto a recibir integrantes: ",
                    styles:cellStyles
                },
                {
                    content: "{{$team->available ? 'Si' : 'No' }}",
                    styles:cellStyles
                },
            ],
            [
                {
                    content: "Capitan: ",
                    styles:cellStyles
                },
                {
                    content: "{{$team->captain->name}} {{$team->captain->last_name}}",
                    styles:cellStyles
                },
                {
                    content: "Número de integrantes: ",
                    styles:cellStyles
                },
                {
                    content: "{{$team->accepted_users->count()}}",
                    styles:cellStyles
                },
                {
                    content: "Voucher: ",
                    styles:cellStyles
                },
                {
                    content: "{{$team->voucher}}",
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

var centeredText = function(text, y, limit = doc.internal.pageSize.width, offset = 0) {
    var textWidth = doc.getStringUnitWidth(text) * doc.internal.getFontSize() / doc.internal.scaleFactor;
    var textOffset = (limit - textWidth) / 2;
    doc.text(textOffset+offset, y, text);
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