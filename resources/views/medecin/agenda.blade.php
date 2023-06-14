@extends('layouts.app')

@section('content')
    <h1>Agenda du médecin</h1>

    <form action="{{ route('doctor.agenda') }}" method="GET">
        <label for="date">Sélectionnez une date :</label>
        <input type="date" name="date" id="date" value="{{ $date }}" required>
        <button type="submit">Afficher</button>
    </form>

    <h2>Rendez-vous du {{ $date }}</h2>

    @if ($rendezvous->isEmpty())
        <p>Aucun rendez-vous pour cette date.</p>
    @else
        <ul>
            @foreach ($rendezvous as $appointment)
                <li>
                    <strong>{{ $appointment->date }}</strong> - {{ $appointment->patient->name }}
                </li>
            @endforeach
        </ul>
    @endif
@endsection
