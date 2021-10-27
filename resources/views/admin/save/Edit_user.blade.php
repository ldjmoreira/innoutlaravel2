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

<form action="{{ route('Save_update',['userUnic'=>$userUnic->id]) }}" method="post">
    @csrf

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name">Nome</label>
            <input type="text" id="name" name="name" placeholder="Informe o nome"
             class="form-control  @error('name') is-invalid @enderror" 
             value="{{old('name', $userUnic->name)}}" required autocomplete="name" autofocus>
        </div>
        <div class="form-group col-md-6">
            <label for="email">E-mail</label>        
            <input type="email" id="email" name="email" placeholder="Informe o email"
                class="form-control  @error('email') is-invalid @enderror"
                value="{{old('email', $userUnic->email)}}" required autocomplete="name" autofocus>

        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="password">Senha</label>

            <input type="password" id="password" name="password" placeholder="Informe a senha"
                class="form-control  @error('email') is-invalid @enderror">

        </div>
        <div class="form-group col-md-6">
            <label for="confirm_password">Confirmação de Senha</label>

            <input type="password" id="confirm_password" name="confirm_password"
                placeholder="Confirme a senha"
                class="form-control  @error('confirm_password') is-invalid @enderror">

        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="email_verified_at">Data de Admissão</label>

            <input type="date" id="email_verified_at" name="email_verified_at"
            class="form-control  @error('email_verified_at') is-invalid @enderror" 
            value="{{old('email_verified_at', $userUnic->email_verified_at)}}" required autocomplete="name" autofocus>

        </div>
        <div class="form-group col-md-6">
            <label for="end_date">Data de Desligamento</label>

            <input type="date" id="end_date" name="end_date"
                class="form-control  @error('end_date') is-invalid @enderror" 
                value="{{old('end_date', $userUnic->end_date)}}"  autocomplete="end_date" autofocus>

        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-1">
            <label for="is_admin">Administrador?</label>

            <input type="checkbox" id="is_admin" name="is_admin"
            class="form-control  @error('is_admin') is-invalid @enderror"
            value="{{old('is_admin', $userUnic->is_admin)}}"  autocomplete="is_admin" autofocus>
        </div>
    </div>
    <div>
        <button class="btn btn-primary btn-lg">Salvar</button>
        <a href="{{ route('Page_users') }}" class="btn btn-secondary btn-lg">Cancelar</a>
    </div>
</form>
@endsection
