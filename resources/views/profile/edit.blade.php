@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- Informações do perfil --}}
            <div class="card mb-4">
                <div class="card-header">Informações do Perfil</div>
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Alterar senha --}}
            <div class="card mb-4">
                <div class="card-header">Alterar Senha</div>
                <div class="card-body">
                    @includeIf('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Excluir conta --}}
            <div class="card">
                <div class="card-header text-danger">Excluir Conta</div>
                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
