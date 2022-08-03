<div class="container" style="padding: 30px 0;">
    <div class="row">   
        <div class="col-md-12">
            <div class="pannel pannel-default">
                <div class="pannel-heading">
                    <h3>Sale Setting</h3>
                </div>
                <form action="{{ route("admin.saleStore") }}" method="post" id="sale-form">
                    @csrf
                </form>
                <div class="pannel-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-4 control-label">Status</div>
                            <div class="col-md-4">
                                <select name="status" form="sale-form" id="" class="form-control">
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 control-label">Sale Date</div>
                            <div class="col-md-4">
                                <input type="text" id="sale-date" name="sale_date" form="sale-form" placeholder="YYYY/MM/DD H:M:S" class="form-control input-md">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <button class="btn btn-success" form="sale-form" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push("script")
<script>
    $(function(){
        $("#sale-date").datetimepicker({
            format : "Y-MM-DD h:m:s",
        })
    })
    </script>  
@endpush
