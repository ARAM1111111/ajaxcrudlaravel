@extends('master')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>Simple Ajax</h1>
			@if(session('alert-success'))
       <div class="alert alert-success">
         {{session('alert-success')}}
       </div>
     @endif
		</div>
	</div>
	<div class="row">
		<table class="table table-striped">
			<tr>
				<th>No.</th>
				<th>Title</th>
				<th>Description</th>
				<th>Actions</th>
			</tr>
			<a href="{{route('blog.create')}}" class="btn btn-info pull-right">CREATE NEW DATA</a>
			<?php $n=1 ?>
			@foreach($blogs as $blog)
				<tr>
				<td>{{$n++}}</td>
				<td>{{$blog->title}}</td>
				<td>{{$blog->description}}</td>
				<td>
					<form action="{{route('blog.destroy',$blog->id)}}" method="post">
						{{method_field('delete')}}
						{{csrf_field()}}
						<a href="{{route('blog.edit',$blog->id)}}" class="btn btn-primary">EDIT</a>
						<input type="submit" class="btn btn-danger" onclick="return confirm('ARE YOU SHURE???')" name='name' value='DELETE'>
					</form>		
				</td>
			</tr>
			@endforeach

		</table>
	</div>
@endsection