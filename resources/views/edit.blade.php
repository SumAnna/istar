@extends('layouts.app')
@section('content')
<h1>Редактировать контакт</h1>
<p><a href="/">Назад</a></p>
<form id="form-edit" action="/contacts/{{ $contact->id }}" method="post">
	@method('put')
	@csrf
</form>
	<input form="form-edit" value="{{ $contact->id }}" id="id" name="id" type="hidden" readonly/>
	<label for="firstname">Имя</label>
	<input form="form-edit" value="{{ $contact->firstname }}" id="firstname" name="firstname" type="text" class="@error('firstname') is-invalid @enderror"/>
	@error('firstname')
	<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	<label for="lastname">Фамилия</label>
	<input form="form-edit" id="lastname" value="{{ $contact->lastname }}" name="lastname" type="text" class="@error('lastname') is-invalid @enderror"/>
	@error('lastname')
	<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	<br/>
	@foreach($contact->numbers as $key => $number)
	<label for="phone-{{ $number->id }}">Номер {{ $key + 1 }}</label>
	<input form="form-edit" value="{{ $number->phone }}" id="phone[{{ $number->id }}]" name="phone[{{ $number->id }}]" type="tel" pattern="[+]{1}[0-9]{12}" class="@error('phone[{{ $number->id }}]') is-invalid @enderror"/>
	<form id="form-delete" action="/contacts/{{ $number->id }}/number" method="post">
		@method('delete')
		@csrf
		<a href="#" class="delete">Удалить номер</a>
	</form>
	@error('phone[{{ $number->id }}]')
	<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	<br/>
	@endforeach
	<div>
	<label for="phone[0]">Добавить телефон</label>
	<input form="form-edit" type="tel" id="phone[0]" name="phone[0]" pattern="[+]{1}[0-9]{12}" class="@error('phone[0]') is-invalid @enderror"/>
	@error('phone[0]')
	<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	</div>
	<input form="form-edit" type="submit"/>

<p><a href="/">Назад</a></p>
<script>
	var anchors = document.getElementsByClassName('delete');
	for(anchor of anchors) {
		anchor.onclick = function(){
			var result = confirm('Are you sure?');
			if (result){
				document.getElementById('form-delete').submit();
			}
		};		
	};
</script>
@endsection