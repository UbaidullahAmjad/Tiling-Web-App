@extends('master.back')

@section('content')

<div class="container-fluid">

	<!-- Page Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class="mb-0 bc-title"><b>{{ __('Create Sub Category') }}</b>
                </h3>
                <a class="btn btn-primary btn-sm" href="{{route('back.subcategory.index')}}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
            </div>
        </div>
    </div>

	<!-- Form -->
	<div class="row">

		<div class="col-xl-12 col-lg-12 col-md-12">

            <form class="admin-form" action="{{ route('back.subcategory.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                @include('alerts.alerts')
        
                <div class="card o-hidden border-0 shadow-lg">
                    <div class="card-body ">
                        <!-- Nested Row within Card Body -->
                        <div class="row justify-content-center">
                            <div class="col-lg-12">

                                <div class="form-group">
                                    <label for="category_id">{{ __('Select Category') }} *</label>
                                    <select name="category_id" id="category_id" class="form-control" >
                                        @foreach(DB::table('categories')->whereStatus(1)->get() as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="name">{{ __('Name') }} *</label>
                                    <input type="text" name="name" class="form-control item-name" id="name"
                                        placeholder="{{ __('Enter Name') }}" value="{{ old('name') }}" >
                                </div>

                                <div class="form-group">
                                    <label for="slug">{{ __('Slug') }} *</label>
                                    <input type="text" name="slug" class="form-control" id="slug"
                                        placeholder="{{ __('Enter Slug') }}" value="{{ old('slug') }}" >
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="form-group pb-0  mb-0">
                            <label class="d-block">{{ __('Navigation Image') }} *</label>
                        </div>
                        <div class="form-group pb-0 pt-0 mt-0 mb-0">
                            <img class="admin-img lg" src="">
                        </div>
                        <div class="form-group position-relative ">
                            <label class="file">
                                <input type="file" accept="image/*" class="upload-photo" name="navigation_img" id="file"
                                    aria-label="File browser example">
                                <span class="file-custom text-left">{{ __('Upload Image...') }}</span>
                            </label>
                            <br>
                            <span
                                class="mt-1 text-info">{{ __('Image Must Be In JPG,JPEG or PNG Format') }}</span>
                        </div>
                    </div>
                </div>

                <!-- <div class="card">
                    <div class="card-body">
                        <div class="form-group pb-0  mb-0">
                            <label class="d-block">{{ __('Header Image') }} *</label>
                        </div>
                        <div class="form-group pb-0 pt-0 mt-0 mb-0">
                            <img class="admin-img lg" src="">
                        </div>
                        <div class="form-group position-relative ">
                            <label class="file">
                                <input type="file" accept="image/*" class="upload-photo" name="header_img" id="file"
                                    aria-label="File browser example">
                                <span class="file-custom text-left">{{ __('Upload Image...') }}</span>
                            </label>
                            <br>
                            <span
                                class="mt-1 text-info">{{ __('Image Size Should Be 800 x 800. or square size') }}</span>
                        </div>
                    </div>
                </div> -->

                <!-- <div class="card">
                    <div class="card-body">
                        <div class="form-group pb-0  mb-0">
                            <label class="d-block">{{ __('Gallery Images') }} *</label>
                        </div>
                        <div class="form-group pb-0 pt-0 mt-0 mb-0">
                            <img class="admin-img lg" src="">
                        </div>
                        <div class="form-group position-relative ">
                            <label class="file">
                                <input type="file" accept="image/*" name="gallery_imgs[]" id="file"
                                    aria-label="File browser example" accept="image/*" multiple>
                                <span class="file-custom text-left">{{ __('Upload Image...') }}</span>
                            </label>
                            <br>
                            <span class="mt-1 text-info">{{ __('Image Size Should Be 800 x 800. or square size') }}</span>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="details">{{ __('Description') }} *</label>
                            <textarea name="description" id="description" class="form-control text-editor" rows="6"
                                placeholder="{{ __('Enter Description') }}"></textarea>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="details">{{ __('Special Description') }} *</label>
                            <textarea name="special_desc" id="special_desc" class="form-control text-editor" rows="6"
                                placeholder="{{ __('Enter Description') }}"></textarea>
                        </div>
                    </div>
                </div> -->

                <div class="form-group">
                    <button type="submit"
                        class="btn btn-secondary ">{{ __('Submit') }}</button>
                </div>
		    </div>

        </form>
	</div>

</div>

<script type="text/javascript">
    // Dropzone.options.dropzone =
    // {
    //     url: "{{ route('back.subcategory.getImages') }}",
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    //     },
    //     addRemoveLinks: true,
    //     autoDiscover: false,
    //     uploadMultiple: true,
    //     parallelUploads: 10,
    //     maxFiles: 10,
    //     maxFilesize: 10,
    //     renameFile: function (file) {
    //         var dt = new Date();
    //         var time = dt.getTime();
    //         return time + file.name;
    //     },
    //     acceptedFiles: ".jpeg,.jpg,.png,.gif",
    //     addRemoveLinks: true,
    //     timeout: 60000,
    //     success: function (file, response) {
    //         console.log(response);
    //     },
    //     error: function (file, response) {
    //         return false;
    //     }
    // };
</script>

@endsection
