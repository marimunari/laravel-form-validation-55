@php
    use App\Client;
@endphp

@extends('layouts.layout')

@section('content')
    <h3>Novo cliente</h3>
    <h4>{{ $clientType == Client::TYPE_INDIVIDUAL ? 'Pessoa Física' : 'Pessoa Jurídica' }}</h4>
    <a href="{{ route('clients.create',['clientType' => Client::TYPE_INDIVIDUAL]) }}">Pessoa Física</a> |
    <a href="{{ route('clients.create',['clientType' => Client::TYPE_LEGAL]) }}">Pessoa Jurídica</a>
    @include('admin.form._form_errors') 
    <form method="post" action="{{ route('clients.store') }}">
        @include('admin.clients._form')
        <button type="submit" class="btn btn-default">Criar</button>
    </form>
@endsection