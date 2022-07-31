<style>
    .product-wish{
        position: absolute;
        top: 10%;
        left: 0;
        right: 30px;
        z-index: 70;
        text-align: right;
        padding-top: 0;
    }
    .product-wish .fa{
        color: #cbcbcb;
        font-size: 30px;
    }
    .product-wish .fa:hover{
        color: #ff3c45;
    }
    .product-wish .fill-heart{
        color: #ff3c45;
    }
</style>
<main id="main" class="main-site left-sidebar">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/" class="link">home</a></li>
                <li class="item-link"><span>Wishlist</span></li>
            </ul>
        </div>
        <div class="row">
            @if (Cart::instance('wishlist')->content()->count() > 0)
            <ul class="product-list grid-products equal-container">
                @foreach (Cart::instance('wishlist')->content() as $item )
                <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                    <div class="product product-style-3 equal-elem ">
                        <div class="product-thumnail">
                            <a href="{{ route('product.detail',$item->model->slug) }}" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                <figure><img src="{{ asset('assets/images/products/'.$item->model->image)}}" alt="{{ $item->model->name }}"></figure>
                            </a>
                        </div>
                        <div class="product-info">
                            <a href="{{ route('product.detail',$item->model->slug) }}" class="product-name"><span>{{ $item->model->name }}</span></a>
                            <div class="wrap-price"><span class="product-price">${{ $item->model->regular_price }}</span></div>
                            <form action="{{ route('move.wishlistToCart',$item->rowId) }}" method="POST">
                                @csrf
                                {{-- <input type="hidden" name="id" value="{{ $item->model->id }}" > --}}
                                <button type="submit" class="btn btn-secondary">Move To Cart</button>
                            </form>
                            <div class="product-wish">
                                <form action="{{ route('remove.wishlist',$item->model->id) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item->model->id }}">
                                    <button type="submit"><i class="fa fa-heart fill-heart"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
            @else
            <h3>No items are added in the wishlist!</h3>
            @endif
        </div>
    </div>
</main>  
