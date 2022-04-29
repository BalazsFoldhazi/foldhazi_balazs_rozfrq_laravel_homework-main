@extends('admin.admin_master')

@section('admin')

<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Create slider</h2>
        </div>
        <div class="card-body">
           <form action="{{ route('store.slider') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <form>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Slider title</label>
                    <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Slider title">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Slider description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Example image</label>
                    <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                </div>
                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Submit</button>

                </div>
            </form>
        </div>
    </div>





@endsection