@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="row justify-content-center">
        <permission-manager :per="{{json_encode(config('permission.permissions'))}}"></permission-manager>
    </div>
</div>
@endsection
