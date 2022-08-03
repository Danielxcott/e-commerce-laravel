@php
    use App\Models\Category;
    $category = Category::where("slug",$category)->first();
@endphp
<div class="container" style="padding: 30px 0;">
    <div class="row">
        <div class="col-md-12">
            <div class="pannel pannel-default">
                <div class="pannel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            Edit Category
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route("admin.categories") }}" class="btn btn-success pull-right">All Categories</a>
                        </div>
                    </div>
                </div>
                <div class="pannel-body">
                    <form action="{{ route("admin.updateCategory",$category->slug) }}" method="POST">
                        @csrf
                        @method("put")
                        <div class="form-group">
                            <label for="form-label">Category Name</label>
                            <input type="text" name="name" value="{{ $category->name }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="form-label">Slug</label>
                            <input type="text" name="slug" value="{{ $category->slug }}" class="form-control">
                        </div>                  
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
