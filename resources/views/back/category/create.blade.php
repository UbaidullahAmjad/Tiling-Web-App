@extends('master.back')

@section('content')

<div class="container-fluid">

	<!-- Page Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class="mb-0 bc-title"><b>{{ __('Create Category') }}</b> </h3>
                <a class="btn btn-primary btn-sm" href="{{route('back.category.index')}}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
                </div>
        </div>
    </div>

	<!-- Form -->
	<div class="row">

		<div class="col-xl-12 col-lg-12 col-md-12">

			<div class="card o-hidden border-0 shadow-lg">
				<div class="card-body ">
					<!-- Nested Row within Card Body -->
					<div class="row justify-content-center">
						<div class="col-lg-12">
								<form class="admin-form" action="{{ route('back.category.store') }}" method="POST"
									enctype="multipart/form-data" class="dropzone" id="dropzone">

                                    @csrf

									@include('alerts.alerts')

									<div class="form-group">
										<label for="name">{{ __('Set Image') }} *</label>
                                        <br>
										<img class="admin-img" src="{{  asset('assets/images/placeholder.png') }}"
												alt="No Image Found">
                                        <br>
										<span class="mt-1">{{ __('Image Size Should Be 60 x 60.') }}</span>
									</div>

									<div class="form-group position-relative">
										<label class="file">
											<input type="file"  accept="image/*"  class="upload-photo" name="photo" id="file"
												aria-label="File browser example" >
											<span class="file-custom text-left">{{ __('Upload Image...') }}</span>
										</label>
                                    </div>

									<div class="form-group">
										<label for="name">{{ __('Name') }} *</label>
										<input type="text" name="name" class="form-control item-name" id="name"
											placeholder="{{ __('Enter Name') }}" value="{{ old('name') }}" >
									</div>

									<!-- <div class="form-group">
										<label for="name">{{ __('Title') }}</label>
										<input type="text" name="title" class="form-control item-name" id="name"
											placeholder="{{ __('Enter Title') }}" value="{{ old('title') }}" >
									</div>

									<div class="form-group">
										<label for="name">{{ __('Sub Title') }}</label>
										<input type="text" name="sub_title" class="form-control item-name" id="name"
											placeholder="{{ __('Enter Sub Title') }}" value="{{ old('sub_title') }}" >
									</div>

									<div class="form-group">
										<label for="sort_details">{{ __('Short Description') }}</label>
										<textarea name="short_description" id="sort_details" class="form-control text-editor"
											placeholder="{{ __('Short Description') }}">{{ old('short_description') }}</textarea>
									</div> -->
									<div class="form-group">
										<label for="slug">{{ __('Slug') }} *</label>
										<input type="text" name="slug" class="form-control" id="slug"
											placeholder="{{ __('Enter Slug') }}" value="{{ old('slug') }}" >
									</div>
									
									<div class="form-group">
										<label for="details">{{ __('Description') }}</label>
										<textarea name="description" id="details" class="form-control text-editor" rows="6"
											placeholder="{{ __('Enter Description') }}">{{ old('description') }}</textarea>
									</div>



									<!-- <div class="form-group">
										<label for="name">{{ __('Second Title') }}</label>
										<input type="text" name="second_title" class="form-control item-name" id="name"
											placeholder="{{ __('Enter Second Title') }}" value="{{ old('second_title') }}" >
									</div>


									<div class="form-group">
										<label for="sort_details">{{ __('Second Short Description') }}</label>
										<textarea name="second_short_description" id="sort_details" class="form-control text-editor"
											placeholder="{{ __('Second Short Description') }}">{{ old('second_short_description') }}</textarea>
									</div>

									<div class="form-group">
										<label for="details">{{ __('Second Description') }}</label>
										<textarea name="second_description" id="details" class="form-control text-editor" rows="6"
											placeholder="{{ __('Enter Second Description') }}">{{ old('second_description') }}</textarea>
									</div>

									<div class="form-group">
									<label for="">Upload Images</label>
										<input type="file" name="cat_images[]" multiple class="form-control">
									</div>-->

								
									

									<!-- <div class="form-group">
										<label for="meta_keywords">{{ __('Meta Keywords') }}
											</label>
										<input type="text" name="meta_keywords" class="tags"
											id="meta_keywords"
											placeholder="{{ __('Enter Meta Keywords') }}"
											value="">
									</div>

									<div class="form-group">
										<label
											for="meta_description">{{ __('Meta Description') }}
											</label>
										<textarea name="meta_descriptions" id="meta_description"
											class="form-control" rows="5"
											placeholder="{{ __('Enter Meta Description') }}"
										></textarea>
									</div>

									<div class="form-group">
										<label for="serial">{{ __('Serial') }} *</label>
										<input type="number" name="serial" class="form-control" id="serial"
											placeholder="{{ __('Enter Serial Number') }}" value="0">
									</div> -->

									<div class="form-group">
										<button type="submit"
											class="btn btn-secondary ">{{ __('Submit') }}</button>
									</div>

									<div>
								</form>
						</div>
					</div>
				</div>
			</div>

		</div>

	</div>

</div>


<script type="text/javascript">
    Dropzone.options.dropzone =
    {
		url:"{{route('back.category.image')}}",
		// url:null,
		method: "POST",
        headers: {
            'Authorization': ''
        },
        maxFilesize: 10,
        renameFile: function (file) {
            var dt = new Date();
            var time = dt.getTime();
            return time + file.name;
        },
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        timeout: 60000,
        success: function (file, response) {
            console.log(response);
        },
        error: function (file, response) {
            return false;
        }
    };
</script>

@endsection