@extends('layouts.main')

@section('content')
	<form id="urls-form" method="POST" action="/check-urls">
		<div class="form-group">
			<textarea class="form-control" name="urls" id="url-container" placeholder="Paste in a list of urls to test, one per line" rows="20"></textarea>
		</div>
		{{ csrf_field() }}
		<button 
			type="submit" 
			class="btn btn-primary"
		>
			Check These URLs
			<i class="glyphicon glyphicon-play-circle"></i>
		</button>
	</form>

	<div style="text-align:left">
		<h3>Note:</h3>
		<p>It's possible to add tens of thousands of URLs, but you probably don't want to. Try to limit it to 2000 or less</p>
	</div>
	<status-checker></status-checker>
@endsection
