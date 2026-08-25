<!DOCTYPE html>
<html lang="pt-PT">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CSM SmartSchool | Assiduidade</title>

    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
    <link rel="icon" href="{{ asset('img/books.png') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>

        .attendance-card{

            width:85%;
            max-width:1450px;

            margin:20px auto;

            background:#fff;

            border-radius:10px;

            padding:25px;

            box-shadow:0 5px 15px rgba(0,0,0,.10);

        }

        .attendance-body{

            width:94%;

            margin:auto;

        }

        .row{

            display:flex;

            gap:20px;

            flex-wrap:wrap;

            margin-bottom:20px;

        }

        .form-group{

            flex:1;

            min-width:220px;

        }

        .form-group label{

            display:block;

            margin-bottom:8px;

            font-weight:bold;

            color:#444;

        }

        .form-control{

            width:100%;

            padding:10px;

            border-radius:8px;

            border:1px solid #ccc;

            transition:.3s;

        }

        .form-control:focus{

            outline:none;

            border-color:#0d6efd;

            box-shadow:0 0 5px rgba(13,110,253,.3);

        }

        .info-bar{

            display:flex;

            justify-content:space-between;

            align-items:center;

            margin-top:20px;

            margin-bottom:15px;

        }

        #studentCounter{

            font-weight:bold;

            color:#0d6efd;

        }

        .btn-success{

            background:#198754;

            color:white;

            border:none;

            padding:10px 20px;

            border-radius:8px;

            cursor:pointer;

        }

        .btn-primary{

            background:#0d6efd;

            color:white;

            border:none;

            padding:10px 20px;

            border-radius:8px;

            cursor:pointer;

        }

        .btn-success:hover,
        .btn-primary:hover{

            opacity:.9;

        }

        .alert-success{

            background:#d1fae5;

            color:#065f46;

            padding:12px;

            border-radius:8px;

            margin-bottom:15px;

        }

        .alert-danger{

            background:#fee2e2;

            color:#991b1b;

            padding:12px;

            border-radius:8px;

            margin-bottom:15px;

        }

    </style>

</head>

<body>

<div class="navbar">

    <div class="menu-toggle" onclick="toggleMenu()">☰</div>

    <div class="logo">

        <img src="{{ asset('img/logo.png') }}">

    </div>

    <div class="search">

        <input type="text" placeholder="Pesquisar...">

    </div>

</div>

@include('partials.sidebargestacad')

<div class="main-content">

<fieldset style="border-radius: 8px; border: 2px solid blue">
        <legend style="text-align: center;"><h3 style="text-align: center; color: blue;">{{ __('messages.Create Attendance') }}</h3></legend>

<div class="attendance-card">

<br>
<br>

<div class="attendance-body">

@if(session('success'))

<div class="alert-success">

{{ session('success') }}

</div>

@endif

@if($errors->any())

<div class="alert-danger">

<ul>

@foreach($errors->all() as $error)

<li>{{ $error }}</li>

@endforeach

</ul>

</div>

@endif

<form action="{{ route('attendance.store') }}" method="POST">

@csrf

<div class="row">

<div class="form-group">

<label>Nível</label>

<select name="niveau" id="niveau" class="form-control" required>
    <option value="">Selecionar...</option>
    <option value="Maternelle">Maternelle</option>
    <option value="Elementaire">Elementaire</option>
    <option value="College">College</option>
    <option value="Lycee">Lycee</option>
</select>

</div>

<div class="form-group">
    <label>Turma</label>
    <select name="classe_id" id="classe_id" class="form-control" disabled required>
        <option value=""> Escolha primeiro o nível </option>
    </select>
</div>

<div class="form-group">
    <label>Disciplina</label>
    <select name="matiere_id" id="matiere_id" class="form-control" disabled required>
        <option value="">Escolha primeiro o nível </option>
    </select>
</div>

<div class="form-group">
    <label>Professor</label>
    <select name="professor_id" class="form-control" required> 
        <option value="">Selecionar...</option>
        @foreach($professors as $prof)
        <option value="{{ $prof->id }}">
        {{ $prof->firstname ?? $prof->nome }}
        {{ $prof->lastname ?? $prof->apelido }}
        </option>
        @endforeach
    </select>
</div>

</div>

<div class="row">

    <div class="form-group">
        <label>Nº Aula</label>
        <input type="number" name="lesson_number" class="form-control" min="1" required>
    </div>

    <div class="form-group">
        <label>Data</label>
        <input type="date" name="attendance_date" class="form-control" value="{{ date('Y-m-d') }}" required>
    </div>

</div>

<div class="info-bar">

    <div id="studentCounter">
        Total de alunos: 0
    </div>

        <div style="display:flex;justify-content:flex-end;gap:15px;flex-wrap:wrap;">

                <button type="button" class="btn-primary" id="presentes"> 
                    <i class="fas fa-user-check"></i>
                        {{ __('messages.Present') }}
                </button>

                <button type="button" class="btn-primary" id="faltas">
                    <i class="fas fa-user-times"></i>
                        {{ __('messages.Absent') }}
                </button>

                <button type="button" class="btn-primary" id="atrasados">
                    <i class="fas fa-clock"></i>
                        {{ __('messages.Late') }}
                </button>

                <button type="button" class="btn-primary" id="justificadas">
                <i class="fas fa-file-alt"></i>
                        {{ __('messages.Excused') }}
                </button>
        </div>

</div>


<hr>

<div class="table-responsive">
    <table class="table attendance-table">
    <thead>
        <tr>
            <th style="width:60px;">#</th>
            <th style="text-align:left;">Aluno</th>
            <th title="Presente">P</th>
            <th title="Falta">F</th>
            <th title="Atrasado">A</th>
            <th title="Justificada">J</th>
            <th style="width:280px;">Observações</th>
        </tr>
    </thead>

    <tbody id="studentsTable">
        <tr>
            <td colspan="7" style="padding:30px;text-align:center;color:#777;">
            <i class="fas fa-users fa-2x"></i>
            <br><br>
            Selecione um nível e uma turma para carregar os alunos.
            </td>
        </tr>
    </tbody>
</table>

</div>

<br>

        <div style="display:flex;justify-content:flex-end;gap:15px;flex-wrap:wrap;">

                <button type="submit" class="btn-success">
                    <i class="fas fa-save"></i>
                        Guardar Assiduidade
                </button>

        </div>

</form>

</div>

</fieldset>

</div>

<style>

.table-responsive{

    overflow-x:auto;

}

.attendance-table{

    width:100%;

    border-collapse:collapse;

    background:#fff;

}

.attendance-table th{

    background:#0d6efd;

    color:#fff;

    padding:12px;

    text-align:center;

}

.attendance-table td{

    padding:10px;

    border-bottom:1px solid #e5e5e5;

    text-align:center;

}

.attendance-table tbody tr:hover{

    background:#f8f9fa;

}

.attendance-table input[type="radio"]{

    transform:scale(1.2);

    cursor:pointer;

}

.attendance-table input[type="text"]{

    width:100%;

    border:1px solid #ccc;

    border-radius:6px;

    padding:8px;

}

.badge-present{

    color:#198754;

    font-weight:bold;

}

.badge-absent{

    color:#dc3545;

    font-weight:bold;

}

.badge-late{

    color:#ffc107;

    font-weight:bold;

}

.badge-justified{

    color:#0d6efd;

    font-weight:bold;

}

</style>





<script>

/*=========================================
 MENU
=========================================*/

function toggleMenu(){

    const sidebar=document.getElementById('sidebar');
    const overlay=document.getElementById('overlay');

    if(sidebar){
        sidebar.classList.toggle('open');
    }

    if(overlay){
        overlay.classList.toggle('active');
    }

}


/*=========================================
 ELEMENTOS
=========================================*/

const niveauSelect=document.getElementById('niveau');
const classeSelect=document.getElementById('classe_id');
const matiereSelect=document.getElementById('matiere_id');

const studentsTable=document.getElementById('studentsTable');
const studentCounter=document.getElementById('studentCounter');


/*=========================================
 NÍVEL
=========================================*/

niveauSelect.addEventListener('change',function(){

    let niveau=this.value;

    classeSelect.innerHTML='<option>Carregando...</option>';
    matiereSelect.innerHTML='<option>Carregando...</option>';

    classeSelect.disabled=true;
    matiereSelect.disabled=true;

    studentsTable.innerHTML=
    `<tr>
        <td colspan="7" align="center">
            Selecione uma turma.
        </td>
    </tr>`;

    studentCounter.innerHTML='Total de alunos: 0';

    if(niveau==''){
        return;
    }

    console.log("Nível:",niveau);


    /*=========================
      TURMAS
    =========================*/

    fetch("{{ url('/attendance/classes-by-niveau') }}/"+niveau)

    .then(response=>response.json())

    .then(data=>{

        console.log("Turmas:",data);

        classeSelect.innerHTML='<option value="">Selecionar...</option>';

        if(data.length===0){

            classeSelect.innerHTML=
            '<option value="">Nenhuma turma encontrada</option>';

            return;

        }

        data.forEach(classe=>{

            classeSelect.innerHTML+=`

                <option value="${classe.id}">

                    ${classe.code}

                </option>

            `;

        });

        classeSelect.disabled=false;

    })

    .catch(error=>{

        console.error(error);

        classeSelect.innerHTML=
        '<option>Erro ao carregar</option>';

    });



    /*=========================
      MATÉRIAS
    =========================*/

    fetch("{{ url('/attendance/matieres-by-niveau') }}/"+niveau)

    .then(response=>response.json())

    .then(data=>{

        console.log("Matérias:",data);

        matiereSelect.innerHTML='<option value="">Selecionar...</option>';

        if(data.length===0){

            matiereSelect.innerHTML=
            '<option>Sem matérias</option>';

            return;

        }

        data.forEach(m=>{

            matiereSelect.innerHTML+=`

                <option value="${m.id}">

                    ${m.name}

                </option>

            `;

        });

        matiereSelect.disabled=false;

    })

    .catch(error=>{

        console.error(error);

        matiereSelect.innerHTML=
        '<option>Erro ao carregar</option>';

    });

});


/*=========================================
 TURMA
=========================================*/

classeSelect.addEventListener('change',function(){

    let classe=this.value;

    if(classe==""){
        return;
    }

    studentsTable.innerHTML=

    `<tr>

        <td colspan="7" align="center">

            Carregando alunos...

        </td>

    </tr>`;

    fetch("{{ url('/attendance/eleves-by-classe') }}/"+classe)

    .then(response=>response.json())

    .then(data=>{

        console.log("Alunos:",data);

        studentsTable.innerHTML='';

        studentCounter.innerHTML=
        'Total de alunos: '+data.length;

        if(data.length===0){

            studentsTable.innerHTML=

            `<tr>

                <td colspan="7">

                    Nenhum aluno encontrado.

                </td>

            </tr>`;

            return;

        }

        data.forEach((student,index)=>{

            studentsTable.innerHTML+=`

            <tr>

                <td>${index+1}</td>

                <td style="text-align:left">

                    ${student.nome} ${student.apelido}

                </td>

                <td>

                    <input
                    type="radio"
                    name="attendance[${student.id}]"
                    value="present"
                    checked>

                </td>

                <td>

                    <input
                    type="radio"
                    name="attendance[${student.id}]"
                    value="absent">

                </td>

                <td>

                    <input
                    type="radio"
                    name="attendance[${student.id}]"
                    value="late">

                </td>

                <td>

                    <input
                    type="radio"
                    name="attendance[${student.id}]"
                    value="justified">

                </td>

                <td>

                    <input
                    type="text"
                    class="form-control"
                    name="remarks[${student.id}]"
                    placeholder="Observações">

                </td>

            </tr>

            `;

        });

    })

    .catch(error=>{

        console.error(error);

        studentsTable.innerHTML=

        `<tr>

            <td colspan="7">

                Erro ao carregar alunos.

            </td>

        </tr>`;

    });

});


/*=========================================
 MARCAR TODOS
=========================================*/

function marcarTodos(status){

    document.querySelectorAll(

        'input[value="'+status+'"]'

    ).forEach(r=>{

        r.checked=true;

    });

}


document.getElementById('presentes')
.addEventListener('click',()=>marcarTodos('present'));

document.getElementById('faltas')
.addEventListener('click',()=>marcarTodos('absent'));

document.getElementById('atrasados')
.addEventListener('click',()=>marcarTodos('late'));

document.getElementById('justificadas')
.addEventListener('click',()=>marcarTodos('justified'));

if(document.getElementById('markAllPresent')){

    document.getElementById('markAllPresent')
    .addEventListener('click',()=>marcarTodos('present'));

}

</script>

</body>
</html>



