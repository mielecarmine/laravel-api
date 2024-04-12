@extends('layouts.app')

@section('title', 'Pagina iniziale')

@section('content')
  <section>
    <div class="container py-4">
      <a href="{{ route('admin.types.create') }}"> Inserisci nuovo tipo </a>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Nome</th>
            {{-- <th scope="col">Tipo</th> --}}
            <th scope="col">Colore (in esadecimale)</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($types as $type)
            <tr>
                <td>{{ $type->label }}</td>
                <td>{{ $type->colour }}</td>
                <td>{!! $type->getBadge() ?? 'Nessuna tipologia' !!}</td>
                <td><a href="{{ route('admin.types.show', $type ),}}"><i class="fa-solid fa-eye"></i></a></td>
                <td><a href="{{ route('admin.types.edit', $type ) }}"><i class="fa-solid fa-pencil"></i></a></td>
                <td><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-modal-{{ $type->id }}">
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
@foreach($types as $type)
<div class="modal fade" id="delete-modal-{{ $type->id }}" tabindex="-1" aria-labelledby="delete-modal-{{ $type->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminare {{$type->label}}?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                L'azione é irreversibile.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <form action="{{route('admin.types.destroy', $type)}}" method="POST">
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