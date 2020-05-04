@extends('layouts.app')
@section('content')
<div class="">
	<div id="chatbox">
		
		<div id="friendslist" class='row justify-content-center'>
			<h1>Мои контакты</h1>
			<div id="topmenu">
				<a href="/">
					<span class="contacts"><i class="fa fa-address-book"></i><strong>Мои контакты</strong></span>
				</a>
				<a href="contacts/create">
					<span class="new_contact active"><i class="fa fa-plus-circle"></i><strong>Добавить контакт</strong></span>
				</a>
			</div>
			<form action="/contacts" method="post" class="form_new_contact mt-3">
				@csrf
				
				<div class="form-group row">
					<label for="firstname" class="col-form-label col-md">Имя</label>
					<div class="col-md-9">
						<input id="firstname" name="firstname" type="text" class="d-flex form-control @error('firstname') is-invalid @enderror"/>
					</div>
				</div>
				@error('firstname')
					<div class="alert col-12 alert-danger">{{ $message }}</div>
				@enderror
				<div class="form-group row">
					<label for="lastname" class="col-md col-form-label">Фамилия</label>
					<div class="col-md-9">
						<input id="lastname" name="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror"/>
					</div>
				</div>
				@error('lastname')
					<div class="alert col-12 alert-danger">{{ $message }}</div>
				@enderror
				<div class="form-group row">
					<label for="phone[0]" class="col-md col-form-label">Телефон</label>
					<div class="col-md-9">
						<input type="tel" id="phone[0]" name="phone[0]" pattern="[+]{1}[0-9]{12}" class="form-control @error('phone[0]') is-invalid @enderror phone-input" title="Введите номер телефона в формате +XXXXXXXXXXX, где X - цифра от 0 до 9"/>
					</div>
				</div>
				@error('phone[0]')
					<div class="alert col-12 alert-danger">{{ $message }}</div>
				@enderror
				@if(isset($msg))
					<div class="col-12 alert alert-danger">{{ $msg ?? '' }}</div>
				@endif
				<div class="form-group text-center">
				<div>
				 <button class="btn btn-custom btn-lg btn-danger w-50" name="submit" type="submit">
					Добавить
				 </button>
				</div>
			   </div>
			</form>
		</div>	
	</div>
</div>
@endsection