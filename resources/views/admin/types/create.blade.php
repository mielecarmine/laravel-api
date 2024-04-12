@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <form action="{{ route('admin.types.store') }}" method="POST">
        @csrf
        
        <label for="label" class="form-label">Nome</label>
        <input type="text" class="form-control" id="label" name="label" />
    
        <label for="colour" class="form-label">Colore (in esadecimale)</label>
        <input type="text" class="form-control" id="colour" name="colour" />
    
        <button type="submit" class="btn btn-primary mt-4">Salva</button>
    </form>
</div>
@endsection