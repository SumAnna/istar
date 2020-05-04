@extends('layouts.app')
@section('content')
	<div id="chatbox">

		

		<div id="friendslist" class="row justify-content-center">
			<h1>Мои контакты</h1>
			<div id="topmenu">
				<span class="contacts active"><i class="fa fa-address-book"></i><strong>Мои контакты</strong></span>
				<a href="contacts/create">
					<span class="new_contact"><i class="fa fa-plus-circle"></i><strong>Добавить контакт</strong></span>
				</a>
			</div>
			<div id="search">
				<input type="text" id="searchfield" placeholder=" Поиск..." onkeyup="textPrint();"/>
			</div>
			<div id="friends">
				@foreach($contacts as $contact)
				<a href="contacts/{{ $contact->id }}">
					<div class="friend">
						<img src="https://icons.iconarchive.com/icons/graphicloads/colorful-long-shadow/256/User-icon.png" />
						<p class="mb-0">
							<strong>{{ $contact->lastname }} {{ $contact->firstname }}</strong>
						</p>
					</div>
				</a>
				@endforeach



			</div>                

		</div>	      
	</div>


<script>
let names = @json($contacts);	
function textPrint() {
	let regexp = document.getElementById('searchfield').value;
	let newRegexp = regexp.toLowerCase();
	let found = [];
	for(let message of names){
		let lname = message.lastname.toLowerCase();
		let fname = message.firstname.toLowerCase();
			if(lname.match(newRegexp)){
				found.push(message);
			}
			else{
				if(fname.match(newRegexp)){
					found.push(message);
				}
			}
	}
	newArray = found;
	showPage(found);
}

function showPage(names){
	let tbody = document.getElementById('friends');
	let newBody = document.createElement('friends');
	newBody.id = 'friends';
	document.getElementById('friendslist').replaceChild(newBody, tbody);
	for(let name of names){
		let a = document.createElement('a');
		let name_id = name.id;
		a.href="contacts/"+ name_id;
		console.log(name.id);
		let div = document.createElement('div');
		div.classList.add('friend');
		let img = document.createElement('img');
		img.src = "https://icons.iconarchive.com/icons/graphicloads/colorful-long-shadow/256/User-icon.png";
		let p = document.createElement('p');
		let strong = document.createElement('strong');
		strong.innerHTML = name.lastname +" "+ name.firstname;
		newBody.appendChild(a);
		a.appendChild(div);
		div.appendChild(img);
		div.appendChild(p);
		p.appendChild(strong);
	}
}

</script>
@endsection