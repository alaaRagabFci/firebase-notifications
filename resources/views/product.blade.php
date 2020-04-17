@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create product</div>

                <div class="card-body">
                    <form method="post" action="{{ url('/product')}}">
                        @csrf
                      <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="title" name="title" class="form-control" id="exampleInputEmail1"  placeholder="Enter title">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <input type="description" name="description" class="form-control" id="exampleInputPassword1" placeholder="Enter description">
                      </div>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
