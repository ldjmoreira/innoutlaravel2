@extends('template.app2')

@section('content')
<div class="content-title mb-4">
    <i class="icon icofont-ui-calendar mr-2"></i>
    
    <div>
        <h1>Relatorio mensal</h1>
        <h2>Acompanhe seu saldo de horas</h2>
    </div>
</div>

<div>
    <form class="mb-4" action="#" method="post">
    <div class="input-group">

        <select name="user" class="form-control mr-2" placeholder="Selecione o usuário ...">
            <option value="">Selecione o usuário</option>
            <?php
                foreach($users as $user) {
                    $selected = $user->id === $selectedUserId ? 'selected' : '';
                    echo "<option value='{$user->id}' {$selected} >{$user->name}</option>";
                }
            ?>
        </select>
  
        <select name="period" class="form-control" placeholder="Selecione o periodo ...">
            <?php
                foreach($periods as $key =>$month) {
                    $selected = $key === $selectedPeriod ? 'selected' : '';
                    echo "<option value='{$key}'{$selected}>{$month}</option>";
                }
            ?>
        </select>
        <button class="btn btn-primary ml-2">
                <i class="icofont-search"></i>
        </button>
    </div>
    </form>
    
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <th>Dia</th>
            <th>Entrada 1</th>
            <th>Saída 1</th>
            <th>Entrada 2</th>
            <th>Saída 2</th>
            <th>Saldo</th>
        </thead>
        <tbody>
            <?php

            foreach($report as $registry): ?>
                <tr>
                <td><?=App\Http\Controllers\date_utils::formatDateWithLocale($registry->work_date, '%A, %d de %B de %Y') ?></td>
                    <td><?= $registry->time1 ?></td>
                    <td><?= $registry->time2 ?></td>
                    <td><?= $registry->time3 ?></td>
                    <td><?= $registry->time4 ?></td>
                    <td>lorion</td>
                </tr>
            <?php endforeach ?>
            <tr class="bg-primary text-white">
                <td>Horas Trabalhadas</td>
                <td colspan="3"><?= $sumOfWorkedTime ?></td>
                <td>Saldo Mensal</td>
                <td><?= $balance ?></td>
            </tr>
        </tbody>	
    </table>

</div>
<!--Isso 
<div>
    <form class="mb-4" action="#" method="post">
    <div class="input-group">
        
        <select name="user" class="form-control mr-2" placeholder="Selecione o usuário ...">
            <option value="">Selecione o usuário</option>
            <?php
                foreach($users as $user) {
                    $selected = $user->id === $selectedUserId ? 'selected' : '';
                    echo "<option value='{$user->id}' {$selected} >{$user->name}</option>";
                }
            ?>
        </select>
        
        <select name="period" class="form-control" placeholder="Selecione o periodo ...">
            <?php
                foreach($periods as $key =>$month) {
                    $selected = $key === $selectedPeriod ? 'selected' : '';
                    echo "<option value='{$key}'{$selected}>{$month}</option>";
                }
            ?>
        </select>
        <button class="btn btn-primary ml-2">
                <i class="icofont-search"></i>
        </button>
    </div>
    </form>
    
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <th>Dia</th>
            <th>Entrada 1</th>
            <th>Saída 1</th>
            <th>Entrada 2</th>
            <th>Saída 2</th>
            <th>Saldo</th>
        </thead>
        <tbody>
            <?php

            foreach($report as $registry): ?>
                <tr>
                <td><?= $registry->work_date ?></td>
                    <td><?= $registry->time1 ?></td>
                    <td><?= $registry->time2 ?></td>
                    <td><?= $registry->time3 ?></td>
                    <td><?= $registry->time4 ?></td>
                   
                </tr>
            <?php endforeach ?>
            <tr class="bg-primary text-white">
                <td>Horas Trabalhadas</td>
                <td colspan="3"><?= $sumOfWorkedTime ?></td>
                <td>Saldo Mensal</td>
                <td><?= $balance ?></td>
            </tr>
        </tbody>	
    </table>

</div>
tem que vir de uma função-->
@endsection
