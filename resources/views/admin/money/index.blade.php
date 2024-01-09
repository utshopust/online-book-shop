@extends('layouts.admin-master')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Money Card</h1>
        <div class="my-2 px-1">
            <div class="row">
                <div class="col-6">
                    <div>
                        <a href="{{route('money.create')}}" class="btn-primary btn-sm">
                            <i class="fas fa-plus-circle mr-1"></i>
                            Add Money Card
                        </a>
                    </div>
                </div>
                
            </div>
        </div>

        {{--Flash Message--}}
        @include('layouts.includes.flash-message')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <span class="m-0 font-weight-bold text-primary">Moeny Card list</span>
            </div>
            <div class="card-body">
             
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Action</th>
                                <th>Card Title</th>
                                <th>Card Amount</th>
                                <th>Card Id</th>
                                <th>Create Date</th>
                                <th>Update Date</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                            @foreach($money as $category)
                                <tr>
                                    <td>
                                        {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\AdminBooksController@moneydestroy', $category->id]]) !!}

                                        <!--<a href="{{route('money.edit', $category->id)}}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>-->

                                        <button type="submit" onclick="return confirm('Category will delete permanently. All books related with this category will deleted. Are you sure to delete??')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>

                                        {!! Form::close() !!}
                                    </td>
                                    <td><a>{{$category->title}}</a></td>
                                    <td>{{$category->amount}}</td>
                                    <td>{{$category->card_id}}</td>
                                    <td>{{$category->created_at? $category->created_at->diffForHumans(): '-'}}</td>
                                    <td>{{$category->updated_at? $category->updated_at->diffForHumans(): '-'}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
               
            </div>
        </div>

    </div>
@endsection
