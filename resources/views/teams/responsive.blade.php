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
const cellStyles = {lineColor: 0,lineWidth: 0.2}

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
        loadUsersTable();
        loadPDF();
        doc.addPage();
        loadResponsive();
    })
})
    
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
            content: 'Cédula de registro del equipo: {{$team->name}}', 
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
                    content: "Datos del equipo",
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
                    content: "",
                    styles:cellStyles
                },
                {
                    content: "",
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