@extends('template.app2')

@section('content')
<div class="content-title mb-4">
    <i class="icon icofont-users mr-2"></i>
    <!--Isso tem que vir de uma função-->
    <div>
        <h1>Cadastro de Usuários</h1>
        <h2>Acompanhe seu saldo de horas</h2>
    </div>
</div>


<a class="btn btn-lg btn-primary mb-3" href="{{ route('Save_user') }}">Novo Usuário</a>


<table class="table table-bordered table-striped table-hover">
    <thead>
        <th>Nome</th>
        <th>Email</th>
        <th>Data de Admissão</th>
        <th>Data de Desligamento</th>
        <th>Ações</th>
    </thead>
    <tbody>
        @foreach($userAll as $user)
            <tr>
                <td> {{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->created_at/*->format('d-m-Y')*/ }}</td>
                <td>{{$user->end_date}}</td>
                <td>
                    
                    <a href="{{ route('Save_edit',['Save_user'=>$user->id]) }}" 
                        class="btn btn-warning rounded-circle mr-2">
                        <i class="icofont-edit"></i>
                    </a>
                    <a href="{{ route('destroy_user',['Save_user'=>$user->id]) }}"
                        class="btn btn-danger rounded-circle">
                        <i class="icofont-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach 
    </tbody>
</table>
{{$userAll ?? ''->links()/* ver pq nao funciona*/}}

@endsection
