<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Users Ajax</title>
	<link rel="stylesheet" href="{{ asset('public/plugins/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('public/plugins/fontawesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('public/plugins/sweetalert/css/sweetalert.css') }}">
	<style>
		.mt-20 {
			margin-top: 20px;
		}
	</style>
</head>
<body>
	
	<div class="container mt-20">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-6">
					<button class="btn btn-primary btn-block" data-toggle="modal" data-target="#add-new-user-modal">
						<i class="fa fa-plus"></i> Add New User
					</button>
				</div>
				<div class="col-md-6">
					<button class="btn btn-info btn-block">
						<i class="fa fa-search"></i>
					</button>
				</div>
			</div>
			<div class="col-md-12">
				<table class="table table-hover table-striped">
					<thead>
						<tr>
							<th>id</th>
							<th>name</th>
							<th>email</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="users-output">
						
						{{-- @foreach($users as $user)
							<tr>
								<td>{{ $user->id }}</td>
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
							</tr>
						@endforeach --}}
					
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!--========================================
	=            Add New User Modal            =
	=========================================-->
	<div class="modal fade" tabindex="-1" role="dialog" id="add-new-user-modal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title text-center">Add New User</h4>
				</div>
				<form action="#" id="add-new-user-form" method="POST">
					{{ csrf_field() }}
					<div class="modal-body">
						<div class="form-group">
							<label for="name">Username</label>
							<input type="text" autocomplete="false" name="name" id="name" placeholder="Username ex:john,..." class="form-control">
						</div>
						<div class="form-group">
							<label for="email">E-mail</label>
							<input type="email" name="email" autocomplete="false" id="email" placeholder="Email Address ex:email@domain.com" class="form-control">
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" name="password" autocomplete="new-password" id="password" placeholder="password" class="form-control">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--====  End of Add New User Modal  ====-->

	<!--========================================
	=            Edit User Modal            =
	=========================================-->
	<div class="modal fade" tabindex="-1" role="dialog" id="edit-new-user-modal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title text-center">Edit User</h4>
				</div>
				<form action="#" id="edit-new-user-form" method="POST">
					{{ csrf_field() }}
					{{ method_field('PUT') }}
					<div class="modal-body">
						<div class="form-group">
							<label for="name">Username</label>
							<input type="hidden" name="id">
							<input type="text" autocomplete="false" name="name" id="name" placeholder="Username ex:john,..." class="form-control">
						</div>
						<div class="form-group">
							<label for="email">E-mail</label>
							<input type="email" name="email" autocomplete="false" id="email" placeholder="Email Address ex:email@domain.com" class="form-control">
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" name="password" autocomplete="new-password" id="password" placeholder="password" class="form-control">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--====  End of Edit User Modal  ====-->
	

	<script src="{{ asset('public/plugins/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('public/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('public/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
	<script>
		$(function(){

			var getUsers = function(){
				$.ajax({
					url: 'getAllUsers',
					type: 'GET',
					success: function(response) {
						var users_output = '';
						$.each(response.users, function(index, value){
							users_output += '<tr><td class="text-center"><i class="fa fa-user view-user" data-hamada="'+value.id+'"></i> '+
									value.id+'</td><td>'+
									value.name+'</td><td>'+
									value.email+'</td><td class="text-danger"><i class="fa fa-trash remove-user" data-id="'+
									value.id+'"></i></td></tr>';
						});
						$('#users-output').html(users_output);
					}
				});
			}

			getUsers();

			$("form#add-new-user-form").on('submit', function(event){
				event.preventDefault();

				$.ajax({
					url: "",
					type: 'POST',
					data: $(this).serialize(), // $(this).serializeArray(), new FormData(this)
					success: function(response) {
						getUsers();
						$('#add-new-user-modal').modal('hide');
					},
					error: function(response) {

					},
					beforeSend: function() {

					}
				});
			});

			$('#users-output').on('click', '.view-user',function(){
				var id = $(this).data('hamada');

				$.ajax({
					url: 'getUserInfo',
					data: {id: id},
					type: 'GET',
					success: function(response) {
						console.log(response);
						$('#edit-new-user-form input[name=id]').val(response.id);
						$('#edit-new-user-form input[name=name]').val(response.name);
						$('#edit-new-user-form input[name=email]').val(response.email);
						$("#edit-new-user-modal").modal('show');
					}
				});
			});

			$('#edit-new-user-form').on('submit', function(event){
				event.preventDefault();

				$.ajax({
					url: 'updateUserInfo',
					data: $(this).serialize(),
					type: 'POST',
					success: function(response) {
						getUsers();
						$("#edit-new-user-modal").modal('hide');
					}
				});
			});

			$('#users-output').on('click', '.remove-user', function(){
				var id = $(this).data('id');

				swal({
				  	title: "Are you sure?",
				  	text: "You will not be able to recover this User!",
				  	type: "warning",
				  	showCancelButton: true,
				  	confirmButtonColor: "#DD6B55",
				  	confirmButtonText: "Yes, delete it!",
				  	closeOnConfirm: false
				},
				function(){
					$.ajax({
						url: 'deleteUser',
						data: {id: id, _token: '{{ csrf_token() }}'},
						type: 'DELETE',
						success: function(response) {

						}
					});
				  	swal("Deleted!", "Your User has been deleted.", "success");
					getUsers();
				});
			});
		});
	</script>
</body>
</html>