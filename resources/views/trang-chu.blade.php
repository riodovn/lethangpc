@extends('layouts.app')
@section('content')
 <!-- Carousel Slider -->
 <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://via.placeholder.com/1200x400" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="https://via.placeholder.com/1200x400" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="https://via.placeholder.com/1200x400" class="d-block w-100" alt="...">
        </div>
    </div>
</div>

<!-- Danh sách sản phẩm -->
<section class="container mt-5">
    <h2 class="mb-4">Sản phẩm mới</h2>
    <div class="row">
        @if(isset($products) && !empty($products))
        @foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if(!empty($product->image_url))
                    <img src="{{ $product->image_url }}" class="card-img" alt="Product Image">
                @else
                    <img src="https://via.placeholder.com/400x300" class="card-img" alt="Placeholder Image">
                @endif
                    <div class="card-overlay">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-description">{{ $product->description }}</p>
                        <div class="price">
                            <span class="old-price">${{ $product->old_price }}</span>
                            <span class="new-price">${{ $product->new_price }}</span>
                            <span class="discount">{{ $product->discount }}%</span>
                        </div>
                        <a href="{{ route('product.show',$product->id) }}" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>Không có sản phẩm nào để hiển thị.</p>
    @endif
    
    </div>
</section>
@endsection