@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-md-12 margin-bot20">
                <div class="float-right">
                    <a href="{{ action('ProductController@create') }}" class="btn btn-info btn-fill">Create New Product</a>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            @forelse ($products as $product)
            <div class="col-12 col-md-4 d-flex align-items-stretch mt-2">
                <div class="card" style="width: 100%;">
                        <img class="card-img-top img-same-height" src="{{ asset('/storage'.$product->image) }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <a href="{{ route('product.edit', ['product' => $product->id]) }}" class="btn btn-outline-primary">Edit</a>
                        </div>
                </div>
            </div>
            @empty
            @endforelse
            
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush