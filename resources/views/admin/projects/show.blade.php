@extends('layouts.app')

@section('title', 'Pagina iniziale')

@section('content')
<div class="container">
    <div class="card mt-5">
        <div class="card-body">
            <strong>Nome: </strong> {{ $project->name }} <br />
            <strong>Tipo: </strong> {{ $project->type->label }} <br />
            <strong>Descrizione:</strong> {{ $project->description }} <br />
            <strong>Link:</strong> <a href="{{ $project->link }}">{{ $project->link }} </a><br />
            <strong>Tecnologie utilizzate:</strong>
            @forelse ($project->technologies as $tech)
                {{ $tech->label }} @unless ($loop->last), @else . @endunless
            @empty
                Nessuna tecnologia associata
            @endforelse
        </div>
      </div> 
      <a href="{{ route('admin.projects.index') }}">Torna ai progetti</a>  
</div>
@endsection