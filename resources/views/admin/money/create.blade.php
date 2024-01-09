@extends('layouts.admin-master')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Add new Money Card</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Money Card create form</h6>
            </div>
            <div class="card-body">
                {!! Form::open(['method'=>'POST', 'action'=>'Admin\AdminBooksController@moneystore']) !!}
                <div class="form-group">
                   {!! Form::label('Title') !!}
                   {!! Form::text('title', null, ['class'=>'form-control '.($errors->has('title')? 'is-invalid': '')]) !!}
                    @if($errors->has('title'))
                        <span class="invalid-feedback">
                            <strong>{{$errors->first('title')}}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Amount</label>
                    <input type="number" class="form-control" name="amount">
                    
                    @if($errors->has('amount'))
                        <span class="invalid-feedback">
                            <strong>{{$errors->first('amount')}}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                   {!! Form::submit('Create', ['class'=>'btn btn-primary']) !!}
                   {!! Form::reset('Reset', ['class'=>'btn btn-danger']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>

    </div>
@endsection
