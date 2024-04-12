@extends('layouts.app')

@section('title', 'Pagina iniziale')

@section('content')
  <section>
    <div class="container py-4">
      <a href="{{ route('admin.projects.create') }}"> Inserisci nuovo progetto </a>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Nome</th>
            <th scope="col">Tipo</th>
            <th scope="col">Link</th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($projects as $project)
            <tr>
                <td>{{ $project->name }}</td>
                <td>{!! $project->type ? $project->type->getBadge() : 'Nessuna tipologia' !!}</td>
                <td><a href="{{ $project->link }}">{{ $project->link }}</a></td>
                <td><a href="{{ route('admin.projects.show', $project ),}}"><i class="fa-solid fa-eye"></i></a></td>
                <td><a href="{{ route('admin.projects.edit', $project ) }}"><i class="fa-solid fa-pencil"></i></a></td>
                <td><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-modal-{{ $project->id }}">
                  <i class="fa-solid fa-trash"></i>
                </button></td>
            </tr> 
          @endforeach
        </tbody>
      </table>
    </div>
  </section>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endsection

@section('modal')
{{-- MODAL --}}
@foreach($projects as $project)
<div class="modal fade" id="delete-modal-{{ $project->id }}" tabindex="-1" aria-labelledby="delete-modal-{{ $project->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminare {{$project->name}}?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                L'azione é irreversibile.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <form action="{{route('admin.projects.destroy', $project)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Elimina</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection