@extends('layouts.app')
@section('content')
<h1>Телефонная книга</h1>
<a href="contacts/create">Добавить контакт</a>
<ul>
@foreach($contacts as $contact)
	<li>
		{{ $contact->id }}; <a href="contacts/{{ $contact->id }}">{{ $contact->lastname }} {{ $contact->firstname }}</a>
	</li>
@endforeach
</ul>
@endsection