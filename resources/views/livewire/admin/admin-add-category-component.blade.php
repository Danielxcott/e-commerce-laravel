<div class="container" style="padding: 30px 0;">
    <div class="row">
        <div class="col-md-12">
            <div class="pannel pannel-default">
                <div class="pannel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            Add Category
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route("admin.categories") }}" class="btn btn-success pull-right">All Categories</a>
                        </div>
                    </div>
                </div>
                <div class="pannel-body">
                        <form action="{{ route("admin.storeCategory") }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="form-label">Category Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="form-label">Slug</label>
                                <input type="text" name="slug" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="form-label">Parent Category</label>
                                <select name="category_id" id="" class="custom-control form-control">
                                    <option value="" selected disabled>Select the category</option>
                                    @foreach ($categories as $category )
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
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
