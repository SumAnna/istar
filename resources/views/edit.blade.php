@extends('layouts.app')
@section('content')
<div id="chatbox">
		<div id="friendslist" class='row justify-content-center'>
	<div class="card">
      <div class="card-header">
            <div class="card-header-bar">
              <a href="/contacts/{{ $contact->id }}" class="btn-back"><span class="sr-only">Back</span></a>
            </div>
			<form id="form-edit" action="/contacts/{{ $contact->id }}" method="post">
				@method('put')
				@csrf
			</form>
            <div class="card-header-slanted-edge">
				<div class="d-flex justify-content-center phone-image">
					<img src="https://icons.iconarchive.com/icons/graphicloads/colorful-long-shadow/256/User-icon.png" class="img-phone">
				</div>
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 200"><path class="polygon" d="M-20,200,1000,0V200Z" /></svg>
				<a href="/contacts/{{ $contact->id }}" class="btn-contact"><span class="sr-only">Contact</span></a>
            </div>
      </div>

      <div class="card-body">
		<h2 class="name" style="color: brown;">Редактировать контакт</h2>
        <h4 class="job-title">{{ $contact->lastname }} {{ $contact->firstname }}</h4>
	<input form="form-edit" value="{{ $contact->id }}" id="id" name="id" type="hidden" readonly/>
	<div class="form-group row">
		<label for="firstname"  class="col-md-3 col-form-label">Имя</label>
		<div class="col-md-9 d-flex">
			<input form="form-edit" value="{{ $contact->firstname }}" id="firstname" name="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror"/>
			<div class="col-md-1 col-hide-mob">
				<a href="#" style="opacity: 0;"><i class="fa fa-times"></i></a>
			</div>
		</div>
	</div>
	@error('firstname')
		<div class="alert col-12 alert-danger">{{ $message }}</div>
	@enderror
	<div class="form-group row">
		<label for="lastname"  class="col-md-3 col-form-label">Фамилия</label>
		<div class="col-md-9 d-flex">
			<input form="form-edit" id="lastname" value="{{ $contact->lastname }}" name="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror"/>
			<div class="col-md-1 col-hide-mob">
				<a href="#" style="opacity: 0;"><i class="fa fa-times"></i></a>
			</div>	
		</div>
		
	</div>
	@error('lastname')
			<div class="alert col-12 alert-danger">{{ $message }}</div>
	@enderror
	@foreach($contact->numbers as $key => $number)
		<div class="form-group row">
			<label for="phone[{{ $number->id }}]"  class="col-md-3 col-form-label">Номер {{ $key + 1 }}</label>

			<div class="col-md-9 d-flex">
				<input form="form-edit" value="{{ $number->phone }}" id="phone.{{ $number->id }}" name="phone[{{ $number->id }}]" type="tel" pattern="[+]{1}[0-9]{12}" class="@error('phone.'.$number->id) is-invalid @enderror form-control"/>
				
			<form id="form-delete-{{ $number->id }}" action="/contacts/{{ $number->id }}/number" method="post" class="col-md-1 col-mob-close" style="display: flex;
    align-items: center;">
				@method('delete')
				@csrf
				<a href="#" class="delete" style="color: brown;"><i class="fa fa-times"></i></a>
			</form>	
			</div>
		</div>
		
		@error('phone.'.$number->id)
			<div class="alert col-12 alert-danger">{{ $message }}</div>
		@enderror
		
	@endforeach
	<div class="form-group row">
		<label for="phone[0]" class="col-md-3 col-form-label">Добавить телефон</label>
		<div class="col-md-9 d-flex">
			<input form="form-edit" type="tel" id="phone.0" name="phone[0]" pattern="[+]{1}[0-9]{12}" class="@error('phone.0') is-invalid @enderror form-control @error('exists') is-invalid @enderror" title="Введите номер телефона в формате +XXXXXXXXXXX, где X - цифра от 0 до 9"/>
		<div class="col-md-1 col-hide-mob">
				<a href="#" style="opacity: 0;"><i class="fa fa-times"></i></a>
		</div>	
		</div>
	</div>
	@error('phone.0')
		<div class="col-12 alert alert-danger">{{ $message }}</div>
	@enderror
	@if(isset($msg))
		<div class="col-12 alert alert-danger">{{ $msg ?? '' }}</div>
	@endif
	<input form="form-edit" type="submit" class="btn btn-custom btn-lg btn-danger w-50 mt-2"/>
      </div>
  </div>
		
	</div>
</div>
<script>
	var anchors = document.getElementsByClassName('delete');
	for(anchor of anchors) {
		anchor.onclick = function(){
			var result = confirm('Вы уверены что хотите удалить номер?');
			if (result){
				this.parentNode.submit();
			}
		};		
	};
</script>
@endsection
