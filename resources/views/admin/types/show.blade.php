@extends('layouts.app')

@section('title', 'Pagina iniziale')

@section('content')
<div class="container">
    <div class="card mt-5">
        <div class="card-body">
            <strong>Nome: </strong> {{ $type->label }} <br />
            <strong>Colore: </strong> {{ $type->colour }} <br />
            {!! $type->getBadge() ?? 'Nessuna tipologia' !!}
        </div>
      </div> 
      <a href="{{ route('admin.types.index') }}">Torna ai tipi</a>  
</div>
@endsection