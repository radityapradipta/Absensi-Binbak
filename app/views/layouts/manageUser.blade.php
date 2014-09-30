@extends('layouts.main')

@section('content')
<form>
	<div class="page_title">
		Manage User
	</div>
	
	<div class="page_content">
		<div class="page_content_solo">
			<!---------------- Da Text Field -------------------->

			<div class="content_field">
				<form>
					<input type="input" class="content_text_field" placeholder="Username">
				</form>
			</div>
			<!---------------- Da Text Field -------------------->
			
			<!---------------- Da Text Field -------------------->

			<div class="content_field">
				<form>
					<input type="input" class="content_text_field" placeholder="Name">
				</form>
			</div>
			<!---------------- Da Text Field -------------------->
			
			<div class="content_button">
				<button type="button" class="btn btn-primary-mod">Add User</button>
			</div>
		</div>
		
		<div class="page_content_under">
			<ul class="page_table">
				<li>
					<div>Username</div>
					<div>Name</div>
					<div></div>
					<div></div>
				</li>
				
				<li>
					<div>john_doe</div>
					<div>johndoe</div>
					<div><a>Edit</a></div>
					<div><a>Delete</a></div>
				</li>
				
				<li>
					<div>john_doe</div>
					<div>johndoe</div>
					<div><a>Edit</a></div>
					<div><a>Delete</a></div>
				</li>
				
				<li>
					<div>john_doe</div>
					<div>johndoe</div>
					<div><a>Edit</a></div>
					<div><a>Delete</a></div>
				</li>
				
				<li>
					<div>john_doe</div>
					<div>johndoe</div>
					<div><a>Edit</a></div>
					<div><a>Delete</a></div>
				</li>
				
				<li>
					<div>john_doe</div>
					<div>johndoe</div>
					<div><a>Edit</a></div>
					<div><a>Delete</a></div>
				</li>
				
				<li>
					<div>john_doe</div>
					<div>johndoe</div>
					<div><a>Edit</a></div>
					<div><a>Delete</a></div>
				</li>
				
				<li>
					<div>john_doe</div>
					<div>johndoe</div>
					<div><a>Edit</a></div>
					<div><a>Delete</a></div>
				</li>
				
				<li>
					<div>john_doe</div>
					<div>johndoe</div>
					<div><a>Edit</a></div>
					<div><a>Delete</a></div>
				</li>
				
				<li>
					<div>john_doe</div>
					<div>johndoe</div>
					<div><a>Edit</a></div>
					<div><a>Delete</a></div>
				</li>
				
				<li>
					<div>john_doe</div>
					<div>johndoe</div>
					<div><a>Edit</a></div>
					<div><a>Delete</a></div>
				</li>
			</ul>
		</div>
	</div>
</form>
@stop