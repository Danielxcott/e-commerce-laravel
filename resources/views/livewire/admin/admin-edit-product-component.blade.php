@php
    use App\Models\Product;
    $item = Product::where("slug",$product)->first();
@endphp
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="pannel pannel-heading">
                <div class="col-md-6">
                    <h3>Update Products</h3>
                </div>
                <div class="col-md-6">
                    <h3><a href="{{ route('admin.products') }}" class="text-decoration-none text-primary">All Products</a></h3>
                </div>
            </div>
            <div class="pannel pannel-body">
                <form action="{{ route('product.update',$item->slug) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" value="{{ $item->name }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Slug</label>
                        <input type="text" name="slug" class="form-control" value="{{ $item->slug }}">
                    </div>
                    <div class="mb-3">
                        <label for="">Description</label>
                        <textarea type="text" rows="10" name="description" class="form-control">{{ $item->description }}</textarea>
                    </div>
                    <div class=" mb-3">
                        <label for="">Regular Price</label>
                        <input type="number" name="regular_price" value="{{ $item->regular_price }}" class="form-control">
                    </div>
                    <div class=" mb-3">
                        <label for="">Sale Price</label>
                        <input type="number" name="sale_price" value="{{ $item->sale_price }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">SKU</label>
                        <input type="text" name="sku" value="{{ $item->SKU }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Stock</label>
                        <select name="stock" id="" class="form-control custom-control">
                            <option value="instock" >Instock</option>
                            <option value="outofstock">OutOfStock</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Featured</label>
                        <select name="feature" id="" class="form-control custom-control">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Quantity</label>
                        <input type="number" name="quantity" value="{{ $item->quantity }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Product Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="">Category</label>
                        <select name="category" id="" class="form-control custom-control">
                            <option selected disabled>All Category</option>
                            @foreach ($categories as $category )
                                <option value="{{ $category->id }}" {{ $category->id == old('category',$item->category_id) ? "selected" : "" }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>