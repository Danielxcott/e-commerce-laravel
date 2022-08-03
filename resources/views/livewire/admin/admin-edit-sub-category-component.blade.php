@php
    use App\Models\SubCategory;
    $subCategory = SubCategory::where("slug",$subCategory)->first();
@endphp
<div class="container" style="padding: 30px 0;">
    <div class="row">
        <div class="col-md-12">
            <div class="pannel pannel-default">
                <div class="pannel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            Edit Sub Category
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route("admin.categories") }}" class="btn btn-success pull-right">All Categories</a>
                        </div>
                    </div>
                </div>
                <div class="pannel-body">
                    <form action="{{ route("admin.updateSubCategory",$subCategory->slug) }}" method="POST">
                        @csrf
                        @method("put")
                        <div class="form-group">
                            <label for="form-label">Category Name</label>
                            <input type="text" name="name" value="{{ $subCategory->name }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="form-label">Slug</label>
                            <input type="text" name="slug" value="{{ $subCategory->slug }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="form-label">Parent Category</label>
                            <select name="category_id" id="" class="custom-control form-control">
                                <option value="" selected disabled>Select the category</option>
                                @foreach ($categories as $category )
                                <option value="{{ $category->id }}" {{ $category->id == $subCategory->category_id ? "selected" : "" }} >{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

