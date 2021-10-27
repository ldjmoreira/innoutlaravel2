@extends('template.app2')

@section('content')
<div class="content-title mb-4">
        <i class="icon icofont-check-alt mr-2"></i>
        <!--Isso tem que vir de uma função-->
    <div>
        <h1>Registrar Ponto</h1>
        <h2>Mantenha seu ponto consistente!</h2>
    </div>
</div>

    <div class="card">
        <div class="card-header">
            <h3><?= $today ?? '' ?></h3>
            <p class="mb-0">Os batimentos efetuados hoje</p>
        </div>
        <div class="card-body">
            <div class="d-flex m-5 justify-content-around">
                <span class="record">Entrada 1: <?=$workingHours[0]->time1 ?? '---'?>   </span>
                <span class="record">Saída 1: <?= $workingHours[0]->time2 ?? '---' ?></span>
            </div>
            <div class="d-flex m-5 justify-content-around">
                <span class="record">Entrada 2: <?= $workingHours[0]->time3 ?? '---' ?></span>
                <span class="record">Saída 2: <?= $workingHours[0]->time4 ?? '---' ?></span>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-center">
            <a href="{{ route('innout') }}" class="btn btn-success btn-lg">
                <i class="icofont-check mr-1"></i>
                Bater o Ponto
            </a>
        </div>
    </div>
    <form class="mt-5" action={{ route('innout2') }} method="post">
        @csrf
        <div class="input-group no-border">
            <input type="text" name="forcedTime" class="form-control"
                placeholder="Informe a hora para simular o batimento">
            <button class="btn btn-danger ml-3">
                Simular Ponto
            </button>
        </div>
    </form>
</div>
@endsection
