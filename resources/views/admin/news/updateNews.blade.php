<section class="content-header">
    <h1>
        <small>Update News</small><br>
    </h1>
</section>

<form role="form" method="post" class="form-horizontal form-group" action="{{ url('news/update/' . $news['id']) }}"
    enctype="multipart/form-data" id="editNewsForm">
    {{ csrf_field() }}
    <div class="card-body">

        <div class="form-group row">
            <label for="ownerName" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="title" name="title" value="{{ $news['title'] }}"
                    autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label for="description" class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10">
                <textarea class="form-control textarea" id="editDescription" name="description">
                        {{ $news['description'] }}
                        </textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="bannerImage" class="col-sm-2 control-label">Cover
                Image</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="edit_cover_image" name="cover_image" accept="image/*">
                <a href="javascript:void(0);" class='text-blue view-image' data-images="{{ $news['cover_image'] }}">View cover
                    Image</a>
            </div>
        </div>

        <!-- /.card-body -->

        <div class="card-footer d-flex justify-content-center">
            <button type="submit" class="btn btn-primary mr-3">Submit</button>
            <button type="reset" class="btn btn-warning text-white">Clear</button>
        </div>
</form>
