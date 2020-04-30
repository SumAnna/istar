@extends('layouts.app')
@section('content')
<h1>Новый контакт</h1>
<p><a href="/">Назад</a></p>
<form action="/contacts" method="post">
	@csrf
	<label for="firstname">Имя</label>
	<input id="firstname" name="firstname" type="text" class="@error('firstname') is-invalid @enderror"/>
	@error('firstname')
	<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	<label for="lastname">Фамилия</label>
	<input id="lastname" name="lastname" type="text" class="@error('lastname') is-invalid @enderror"/>
	@error('lastname')
	<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	<label for="phone[0]">Телефон</label>
	<input type="tel" id="phone[0]" name="phone[0]" pattern="[+]{1}[0-9]{12}" class="@error('phone[0]') is-invalid @enderror"/>
	@error('phone[0]')
	<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	<input type="submit"/>
</form>
@endsection