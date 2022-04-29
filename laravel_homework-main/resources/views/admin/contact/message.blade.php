@extends('admin.admin_master')
@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <h2> Admin message</h2>
                <a href="{{ route('add.contact') }}"> <button class="btn btn-info">Add About</button> </a>
                    <div class="col-md-12">
                        <div class="card">
                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            <div class="card-header">  All Contact data </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col" width="5%">SL </th>
                                        <th scope="col" width="20%">Date</th>
                                        <th scope="col" width="10%">Name</th>
                                        <th scope="col" width="10%">Email</th>
                                        <th scope="col" width="10%">Subject</th>
                                        <th scope="col" width="30%">Message</th>
                                        <th scope="col" width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @php($i = 1)
                                     @foreach ($messages as $mess)
                                        <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $mess->created_at }}</td>
                                        <td>{{ $mess->name }}</td>
                                        <td>{{ $mess->email }}</td>
                                        <td>{{ $mess->subject }}</td>
                                        <td>{{ $mess->message }}</td>
                                        <td>
                                         <a href="{{ url('message/delete/'.$mess->id) }}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger">Delete</a>

                                        </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
                            </div>
                            </div>
                          </div>
                        </div>

@endsection
