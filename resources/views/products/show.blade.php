<!-- resources/views/products/show.blade.php -->

@extends('layouts.app')

@section('content')
   <!-- resources/views/products/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($product->productImages as $index => $image)
                            <div class="carousel-item{{ $index === 0 ? ' active' : '' }}">
                                <img src="{{ $image->image_path }}" class="d-block w-100" alt="Product Image">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <h1>{{ $product->name }}</h1>
                <p>{{ $product->description }}</p>
                <div class="product-detail-price" data-price="{{ $product->price }}" data-discount-price="{{ $product->discount_price }}">
                    <span class="product-detail-old-price">${{ $product->price }}</span>
                    <span class="product-detail-new-price">${{ $product->discount_price }}</span>
                    <span class="product-detail-discount badge badge-danger"></span>
                </div>
                
                <a href="#" class="btn btn-simple mt-4  "><i class="fas fa-shopping-cart"></i> Giỏ hàng</a>
                <p class='mt-4'>CSKH 1: 0935396912</p>
                <p class='mt-4'>CSKH 2: 0935396912</p>
                <p class='mt-4'>CSKH 3: 0935396912</p>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-12">
                <h2>Thông số kỹ thuật</h2>
                <table class="table">
                    <tbody>
                        @foreach($product->technicalSpecs as $spec)
                            <tr>
                                <td>{{ $spec->name }}</td>
                                <td>{{ $spec->value }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-12">
                <h2>Chính sách bảo hành</h2>
                @if($product->warrantyPolicies->isNotEmpty())
                    <ul>
                        @foreach($product->warrantyPolicies as $policy)
                            <li>{{ $policy->title }}: {{ $policy->content }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>Không có chính sách bảo hành cho sản phẩm này.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
            var price = $(".product-detail-price").data('price');
            var discountPrice = $(".product-detail-price").data('discount-price');
            var discountPercentage = ((price - discountPrice) / price) * 100;
            $(".product-detail-price").find('.product-detail-discount').text('-'+discountPercentage.toFixed(2) + '%');
    });
</script>
@endsection
@endsection
