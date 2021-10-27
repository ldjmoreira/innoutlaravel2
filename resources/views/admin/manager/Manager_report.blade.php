@extends('template.app2')

@section('content')
<div class="content-title mb-4">
    <i class="icon icofont-ui-calendar mr-2"></i>
    <!--Isso tem que vir de uma função-->
    <div>
        <h1>Relatorio Gerencial</h1>
        <h2>Acompanhe seu saldo de horas</h2>
    </div>
</div>

<div class="summary-boxes">
    <div class="summary-box bg-primary">
        <i class="icon icofont-users"></i>
        <p class="title">Qtde de Funcionários</p>
        <h3 class="value"><?= $activeUsersCount ?? '' ?></h3>
    </div>
    <div class="summary-box bg-danger">
        <i class="icon icofont-patient-bed"></i>
        <p class="title">Faltas</p>
        <h3 class="value"><?= count($absentUsers) ?></h3>
    </div>
    <div class="summary-box bg-success">
        <i class="icon icofont-sand-clock"></i>
        <p class="title">Horas no Mês</p>
        <h3 class="value"><?= $hoursInMonth ?? '' ?></h3>
    </div>
</div>

<?php if(count($absentUsers) > 0): ?>
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="card-title">Faltosos do Dia</h4>
            <p class="card-category mb-0">Relação dos funcionários que ainda não bateram o ponto</p>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <th>Nome</th>
                </thead>
                <tbody>
                    @foreach ($absentUsers as $name)
                    
                        <tr>
                            <td> {{$name->name}}   </td>
                        </tr>
                        @endforeach 
                        
                </tbody>
            </table>
        </div>
    </div>
    <?php endif ?>
@endsection
