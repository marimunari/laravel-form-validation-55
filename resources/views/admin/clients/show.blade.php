@extends('layouts.layout')

@section('content')
<h3>Ver cliente</h3>
<a class="btn btn-primary" href="{{ route('clients.edit', ['client' => $client->id]) }}">Editar</a>
<a class="btn btn-danger" href="{{ route('clients.destroy', ['client' => $client->id]) }}" 
    onclick="event.preventDefault(); if(confirm('Deseja excluir este cliente?')) 
    {document.getElementById('formDelete').submit();}">Excluir</a>
<form id="formDelete" style="display: none" 
    action="{{ route('clients.destroy', ['client' => $client->id]) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>
<br><br>
<table class="table table-bordered">
    <tbody>
        <tr>
            <th scope="row">ID</th>
            <td>{{ $client->id }}</td>
        </tr>
        <tr>
            <th scope="row">Nome</th>
            <td>{{ $client->name }}</td>
        </tr>
        <tr>
            <th scope="row">Documento</th>
            <td>{{ $client->document }}</td>
        </tr>
        <tr>
            <th scope="row">E-mail</th>
            <td>{{ $client->email }}</td>
        </tr>
        <tr>
            <th scope="row">Telefone</th>
            <td>{{ $client->phone }}</td>
        </tr>
        <tr>
            <th scope="row">Estado Civil</th>
            <td>
                @switch($client->maritalStatus)
                    @case(1)
                        Solteiro
                        @break
                    @case(2)
                        Casado
                        @break
                    @case(3)
                        Divorciado
                        @break
                @endswitch
            </td>
        </tr>
        <tr>
            <th scope="row">Data de Nasc.</th>
            <td>{{ date('d/m/Y', strtotime($client->dateBirth)) }}</td>
        </tr>
        <tr>
            <th scope="row">Gênero</th>
            <td>{{ $client->gender == 'm' ? 'Masculino' : 'Feminino' }}</td>
        </tr>
        <tr>
            <th scope="row">Inadimplente</th>
            <td>{{ $client->defaulter ? 'Sim' : 'Não' }}</td>
        </tr>
    </tbody>
</table>
<a class="btn btn-primary" href="{{ route('clients.index') }}">Voltar</a>
@endsection