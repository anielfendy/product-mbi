@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid mt--7">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Edit Product</div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        @if ($errors->any())
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>
                                                            {{ $error }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <form action="{{ route('product.update', ['product' => $product->id]) }}" method="POST" role="form" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            {{ method_field('PATCH') }}
                                            <div class="form-group row">
                                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                                <div class="col-md-6">
                                                    <input id="name" type="text" class="form-control" name="name" value="{{ $product->name }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
                                                <div class="col-md-6">
                                                    <textarea class="form-control" rows="5" id="description" name="description">{{ $product->description }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="image" class="col-md-4 col-form-label text-md-right">Image</label>
                                                <div class="col-md-6">
                                                    <input id="image" type="file" class="form-control" name="image">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="current_img" class="col-md-4 col-form-label text-md-right">Current Image</label>
                                                <div class="col-md-6">
                                                    <img class="img-same-height" src="{{ asset('/storage'.$product->image) }}" alt="Card image cap">
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0 mt-5">
                                                <div class="col-md-8 offset-md-4">
                                                    <button type="submit" class="btn btn-primary">Update Product</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush