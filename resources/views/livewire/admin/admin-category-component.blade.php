<style>
     nav svg{
        height: 20px;
    }
    nav .hidden{
        display: block !important;
    }
    .sclist{
        list-style: none;
    }
</style>
<div class="container" style="padding: 30px 0;">
    <div class="row">
        <div class="col-md-12">
            <div class="pannel pannel-default">
                <div class="pannel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            All Categories
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('admin.addCategory') }}" class="btn btn-success pull-right">Add New Category</a>
                        </div>
                    </div>
                </div>
                <div class="pannel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category Name</th>
                                <th>Slug</th>
                                <th>Subcategories</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        <ul class="sclist">
                                            @foreach ($category->subCategories as $subcategory )
                                                <li>{{ $subcategory->name }} 
                                                    <button class="btn btn-link"><a href="{{ route("admin.editSubCategory",['subCategory'=>$subcategory->slug]) }}"><i class="fa fa-edit"></i></a> </button>
                                                    <form action="{{ route("admin.deleteSubCategory",$category->id) }}" method="post" style="display: inline-block">
                                                        @csrf
                                                        @method("delete")
                                                        <button onclick="confirm('Are you sure to delete') || event.stopImmediatePropagation()" class="btn btn-link"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <a href="{{ route("admin.editCategory",$category->slug) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route("admin.deleteCategory",$category->id) }}" method="post" style="display: inline-block">
                                            @csrf
                                            @method("delete")
                                            <button class="btn btn-danger btn-sm">Del</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
