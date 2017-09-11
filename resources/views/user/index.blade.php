@extends('layouts.app')

@push('script')
    <script src="{{url("/js/user.js")}}"></script>
@endpush
 
@section('content')
    <div class="col-md-offset-2 col-md-8" v-cloak>
        <div class="text-right">
            <button class="btn btn-default" data-toggle="modal" href="#modal-form" @click="readyModalForInsert">Register new user</button>
        </div>
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">Users</div>

            <div class="panel-body">
                <input type="text" v-model="searchKey" placeholder="Look for...">
            </div>
            <div class="table-responsive">
                <table class="table no-border">
                    <th class="text-right">Employee ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                    <tbody>
                    <tr v-for="user in filteredUsers">
                        <td class="text-right" v-text="user.employee_id"></td>
                        <td v-text="user.name"></td>
                        <td v-text="user.email"></td>
                        <td>
                            <button class="btn btn-primary btn-xs" data-toggle="modal" href="#modal-form" @click="setSelectedUser(user)">edit</button>
                            <button class="btn btn-danger btn-xs" @click="deleteUser(user)">remove</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include("modals.userModals")
@endsection
