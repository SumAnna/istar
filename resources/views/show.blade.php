@extends('layouts.app')
@section('content')
<h1>Контакт</h1>
	<p><a href="/">Назад</a></p>
	<p>
		{{ $contact->id }}; {{ $contact->lastname }}; {{ $contact->firstname }} 
		<a href="/contacts/{{ $contact->id }}/edit">Редактировать контакт</a>
		<form action="/contacts/{{ $contact->id }}" method="post" id="form-delete">
			@method('delete')
			@csrf
			<a href="#" id="delete">Удалить контакт</a>
		</form>
	</p>
	<ul>
	@foreach($contact->numbers as $number)
		<li>
			{{ $number->id }}; {{ $number->phone }}
		</li>
	@endforeach
	</ul>
	<script>
		var anchor = document.getElementById('delete');
		anchor.onclick = function(){
			var result = confirm('Are you sure?');
			if (result){
				document.getElementById('form-delete').submit();
			}
		};
	</script>
@endsection
