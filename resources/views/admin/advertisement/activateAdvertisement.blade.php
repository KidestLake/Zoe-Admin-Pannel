<section class="content-header">
    <h1>
        <small>Activate Advertisement</small><br>
    </h1>
</section>

<!-- form start -->
<form role="form" method="post" class="form-horizontal form-group"
    action="{{ url('advertisements/update/' . $advertisement['id']).'/true'}}" enctype="multipart/form-data"
    id="activateAdvertisementForm">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT">
    <div class="card-body">

        <div class="form-group row">
            <label for="ownerName" class="col-sm-2 col-form-label">Owner
                Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="owner_name" name="owner_name"
                    value="{{ $advertisement['owner_name'] }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="phone" class="col-sm-2 col-form-label">Phone</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $advertisement['phone'] }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="link" class="col-sm-2 col-form-label">Link</label>
            <div class="col-sm-10">
                <input type="url" class="form-control" id="url" name="url" value="{{ $advertisement['url'] }}">
            </div>
        </div>

        <!-- Date -->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Start Date:</label>
            <div class="col-sm-10">
                <input type="text" id="activate_start_date" name="start_date" class="form-control"
                    value="{{ $advertisement['start_date'] }}" />
            </div>
        </div>

        <!-- Date -->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">End Date:</label>
            <div class="col-sm-10">
                <input type="text" id="activate_end_date" name="end_date" class="form-control"
                    value="{{ $advertisement['end_date'] }}" />
            </div>
        </div>

        <div class="form-group row">
            <label for="bannerImage" class="col-sm-2 col-form-label">Smaller
                Banner</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="activate_banner_image_one" name="banner_image_one"
                    accept="image/*">
            </div>
            <div class="offset-sm-2">
                <i>(20*20,max Size 20kb) </i>
            </div>
        </div>

        <div class="form-group row">
            <label for="bannerImage" class="col-sm-2 col-form-label">Larger
                Banner</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="activate_banner_image_two" name="banner_image_two"
                    accept="image/*">
            </div>
            <div class="offset-sm-2">
                <i> (50*50,max Size 20kb) </i>
            </div>
        </div>

        <div class="form-group row">
            <div class="offset-sm-2">
                <a href="JavaScript:void(0);" class='text-blue view-image' data-images="{{ $advertisement['banner_image'] }}">View
                    Banner
                    Image</a>
            </div>
        </div>

        <!-- /.card-body -->

        <div class="d-flex justify-content-center">
            <input type="submit" class="btn btn-primary mr-3" value="Submit" />
            <button type="reset" class="btn btn-warning text-white">Clear</button>
        </div>
</form>


<script type="text/javascript">
    $(document).ready(function() {

      $('#activate_start_date').datepicker({
              dateFormat: 'yy-mm-dd',
              minDate: +1,
          });

      //Date range picker
      $('#activate_end_date').datepicker({
          dateFormat: 'yy-mm-dd',
          minDate: +2,
      });

    });

$('#activateAdvertisementForm').validate({
            rules: {
                owner_name: {
                    required: true,

                },
                phone: {
                    required: true,
                    minlength: 9,
                    maxlength: 15
                },
                start_date: {
                    required: true,

                },
                end_date: {
                    required: true,

                }
            },
            messages: {
                owner_name: {
                    required: "Please enter owner name",

                },
                phone: {
                    required: "Please enter phone number",
                    minlength: "Your Phone must be at least 9 characters long",
                    maxLength: "Your Phone must be at maximum 15 characters long"
                },
                start_date: {
                    required: "Please enter start date for the advertisement",

                },
                end_date: {
                    required: "Please enter end date for the advertisement",

                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                error.addClass('offset-sm-2');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }

        });

</script>
