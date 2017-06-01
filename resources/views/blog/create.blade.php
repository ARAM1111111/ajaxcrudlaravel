@extends('master')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>CREATE</h1>
		</div>
	</div>
<div class="row">
	<div class="col-md-12">
		<form action="{{route('blog.store')}}" method="post">
			{{csrf_field()}}
			<div class="form-group {{$errors->has('title')?$errors->first('title'):''}}">
				<input type="text" name='title' class="form-control" placeholder='Enter Title Here'>
				{!! $errors->first('title','<p class="help-block">:message</p>') !!}
			</div>
			<div class="form-group {{$errors->has('description')?$errors->first('description'):''}}">
				<input type="text" name='description' class="form-control" placeholder='Enter Title Here'>
				{!! $errors->first('description','<p class="help-block">:message</p>') !!}
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-primary" value='SAVE'>
			</div>
		</form>
	</div>
</div>



@endsection