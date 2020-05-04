@extends('layouts.app')
@section('content')
<div id="chatbox">
		<div id="friendslist" class='row justify-content-center'>
	<div class="card">
      <div class="card-header">
            <div class="card-header-bar">
              <a href="/" class="btn-back"><span class="sr-only">Back</span></a>
            </div>

            <div class="card-header-slanted-edge">
				<div class="d-flex justify-content-center phone-image">
					<img src="https://icons.iconarchive.com/icons/graphicloads/colorful-long-shadow/256/User-icon.png" class="img-phone">
				</div>
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 200"><path class="polygon" d="M-20,200,1000,0V200Z" /></svg>
				<a href="/contacts/{{ $contact->id }}/edit" class="btn-edit"><span class="sr-only">Edit</span></a>
            </div>
      </div>

      <div class="card-body">
          <h2 class="name">{{ $contact->lastname }} {{ $contact->firstname }}</h2>
          <h4 class="job-title">Контакт</h4>
          @foreach($contact->numbers as $number)
			<div class="bio" style="width: 80%; border-bottom: 1px solid #e7ebee;">
				<a class="phone-number" href="tel:{{ $number->phone }}" style="color: inherit"><p >Номер {{ $loop->iteration }}: {{ $number->phone }}</p></a>
			</div>
		  @endforeach
          <div class="social-accounts">
            <img src="https://res.cloudinary.com/dj14cmwoz/image/upload/v1491077480/profile-card/images/dribbble.svg" alt=""><span class="sr-only">Dribbble</span>
            <img src="https://res.cloudinary.com/dj14cmwoz/image/upload/v1491077480/profile-card/images/twitter.svg" alt=""><span class="sr-only">Twitter</span>
            <img src="https://res.cloudinary.com/dj14cmwoz/image/upload/v1491077480/profile-card/images/instagram.svg" alt=""><span class="sr-only">Instagram</span>
          </div>
      </div>
		<form action="/contacts/{{ $contact->id }}" method="post" id="form-delete" class="d-flex justify-content-center">
			@method('delete')
			@csrf
			<a class="btn btn-custom btn-lg btn-danger w-50" id="delete" href="#">
					Удалить
			</a>
		</form>
  </div>
		
	</div>
</div>
	<script>
		var anchor = document.getElementById('delete');
		anchor.onclick = function(e){
			e.preventDefault();
			if(window.confirm('Удалить контакт {{ $contact->lastname }} {{ $contact->firstname }}?')){
				document.getElementById('form-delete').submit();
			}
			else{
				
			}
		};

	</script>
@endsection
