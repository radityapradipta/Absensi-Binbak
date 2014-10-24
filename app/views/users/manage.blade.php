@extends('layouts.main')

@section('content')
<div class="page_title">
    Manage User
</div>
<div class="page_content">
    <div class="page_content_solo">
        <div class="content_head">
            Add User
        </div>
        <form id="user-add">
            <!---------------- Da Text Field -------------------->

            <div class="content_field">
                <input type="input" name="ssn" class="content_text_field" placeholder="Kode SSN" required />
            </div>
            <!---------------- Da Text Field -------------------->


            <!---------------- Da Text Field -------------------->

            <div class="content_field">
                <input type="input" name="username" class="content_text_field" placeholder="Username" required />
            </div>
            <!---------------- Da Text Field -------------------->

            <!---------------- Da Text Field -------------------->

            <div class="content_field">
                <input type="password" name="password" class="content_text_field" placeholder="Password" required />
            </div>
            <!---------------- Da Text Field -------------------->

            <!---------------- Da Text Field -------------------->

            <div class="content_field">
                <select name="role" class="content_dropDown"/>
                @foreach ($roles as $role)	              
                <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>
                @endforeach
                </select>
            </div>
            <!---------------- Da Text Field -------------------->

            <div class="content_button">
                <button type="submit" class="btn btn-primary-mod">Add User</button>
            </div>
        </form>
    </div>

    <div class="page_content_under">
        <div class="content_head">
            User List
        </div>

        <!---------------- Da Text Field -------------------->
        <div class="content_field">
            <select class="content_dropDown" id="role-select"/>
            <option value="-1" disabled selected>Select Role</option>
            @foreach ($roles as $role)	
            @if(isset($role_id) && $role['id']==$role_id)
            <option value="{{ $role['id'] }}" selected>{{ $role['name'] }}</option>
            @else
            <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>
            @endif	
            @endforeach
            </select>
        </div>
        <br/>
        @if(!isset($role_id))
        Please insert the option :)        
        @elseif((count($accounts)<1))	
        <div class="content_head">No data found :(</div>
        @else	

        <!---------------- Da Text Field -------------------->

        <ul class="page_table">
            <li class="container_12">
                <div class="grid_2">Kode SSN</div>
                <div class="grid_6">Username</div>
                <div class="grid_2">Role</div>					
                <div class="grid_1"></div>
                <div class="grid_1"></div>			
                <br class="clear"/>
            </li>
            @foreach ($accounts as $account)	
            <li class="container_12" data-id="{{ $account['id'] }}">
                <div class="grid_2 ssn">{{ $account->employee->ssn }}</div>
                <div class="grid_6 username">{{ $account['username'] }}</div>
                <div class="grid_2 role">{{ $account->role->name }}</div>
                <div class="grid_1"><a class="user-edit-button" href="#">Edit</a></div>
                <div class="grid_1"><a class="user-delete-button" href="#">Delete</a></div>
                <br class="clear"/>
            </li>

            @endforeach 
        </ul>

        @endif	
    </div>
</div>

<!---------------- Modal -------------------->
<div class="modal fade" id="user-edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit User</h4>
            </div>
            <form id="user-update">
                <input type="hidden" name="id" id="edit-id" />
                <div class="modal-body">
                    <!---------------- Da Text Field -------------------->

                    <div class="content_field">
                        <input type="input" name="ssn" id="edit-ssn" class="content_text_field" placeholder="Kode SSN">
                    </div>
                    <!---------------- Da Text Field -------------------->

                    <!---------------- Da Text Field -------------------->

                    <div class="content_field">
                        <input type="input" name="username" id="edit-username" class="content_text_field" placeholder="Username">
                    </div>
                    <!---------------- Da Text Field -------------------->

                    <!---------------- Da Text Field -------------------->

                    <div class="content_field">
                        <select name="role" class="content_dropDown" id="edit-role"/>
                        @foreach ($roles as $role)	              
                        @if(isset($role_id) && $role['id']==$role_id)
                        <option value="{{ $role['id'] }}" selected>{{ $role['name'] }}</option>
                        @else
                        <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>
                        @endif	
                        @endforeach
                        </select>
                    </div>
                    <!---------------- Da Text Field -------------------->

                    <br/><input type="checkbox" id="edit-password-toggle"/> Reset Password
                    <!---------------- Da Text Field -------------------->

                    <div class="content_field">
                        <input type="password" name="password" id="edit-password" class="content_text_field" placeholder="Password" style="display:none;">
                    </div>
                    <!---------------- Da Text Field -------------------->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="user-save-button" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop