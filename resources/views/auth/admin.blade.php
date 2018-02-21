@extends('layouts.master')

@section('content')
<div class="container">
  <div class="row">
    <h1 class="text-center">Admin Panel</h1>
    <hr>
    <div class="col-md-12 table-responsive">
      <table class="table table-bordered">
          <thead>
          <th class="text-center">Name</th>
          <th class="text-center">E-Mail</th>
          <th class="text-center">User</th>
          <th class="text-center">Author</th>
          <th class="text-center">Admin</th>
          <th class="text-center"></th>
          </thead>
          <tbody>
          @foreach($users as $user)
              <tr>
                  <form action="{{ route('auth.admin.assign') }}" method="post">
                      <td class="text-center">{{ $user->name }}</td>
                      <td class="text-center">{{ $user->email }} <input type="hidden" name="email" value="{{ $user->email }}"></td>
                      <td class="text-center"><input type="checkbox" {{ $user->hasRole('User') ? 'checked' : '' }} name="role_user"></td>
                      <td class="text-center"><input type="checkbox" {{ $user->hasRole('Author') ? 'checked' : '' }} name="role_author"></td>
                      <td class="text-center"><input type="checkbox" {{ $user->hasRole('Admin') ? 'checked' : '' }} name="role_admin"></td>
                      {{ csrf_field() }}
                      <td class="text-center"><button class="btn" type="submit">Assign Roles</button></td>
                  </form>
              </tr>
          @endforeach
          </tbody>
      </table>
    </div>  
  </div>
</div>    
@endsection