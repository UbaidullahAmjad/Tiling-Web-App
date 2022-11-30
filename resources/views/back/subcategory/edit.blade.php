@extends('master.back')

@section('content')

<div class="container-fluid">

	<!-- Page Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class="mb-0 bc-title"><b>{{ __('Edit Sub Category') }}</b> </h3>
                <a class="btn btn-primary btn-sm" href="{{route('back.subcategory.index')}}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
                </div>
        </div>
    </div>

	<!-- Form -->
	<div class="row">

		<div class="col-xl-12 col-lg-12 col-md-12">
			<form class="admin-form" action="{{ route('back.subcategory.update',$subcategory->id) }}" method="POST"
				enctype="multipart/form-data">
				
				@csrf
				@method('PUT')
				@include('alerts.alerts')

				<div class="card">
					<div class="card-body ">
						<!-- Nested Row within Card Body -->
						<div class="row justify-content-center">
							<div class="col-lg-12">
								<div class="form-group">
									<label for="category_id">{{ __('Select Category') }} *</label>
									<select name="category_id" id="category_id" class="form-control" >
										@foreach(DB::table('categories')->whereStatus(1)->get() as $cat)
											<option value="{{ $cat->id }}" {{$subcategory->category_id == $cat->id ? 'selected' :''}} >{{ $cat->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group">
									<label for="name">{{ __('Name') }} *</label>
									<input type="text" name="name" class="form-control item-name" id="name"
										placeholder="{{ __('Enter Name') }}" value="{{ $subcategory->name}}" >
								</div>

								<div class="form-group">
									<label for="slug">{{ __('Slug') }} *</label>
									<input type="text" name="slug" class="form-control" id="slug"
										placeholder="{{ __('Enter Slug') }}" value="{{ $subcategory->slug }}" >
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
							<img class="admin-img lg" src="{{ $subcategory->navigation_img ? asset('assets/images/subcategory/'.$subcategory->navigation_img) : asset('assets/images/placeholder.png') }}" >
						</div>
						<div class="form-group position-relative ">
							<label class="file">
							<input type="file"  accept="image/*"   class="upload-photo" name="navigation_img"
								id="file"  aria-label="File browser example">
							<span
								class="file-custom text-left">{{ __('Upload Image...') }}</span>
							</label>
							<br>
							<span class="mt-1 text-info">{{ __('Image Must Be In JPG,JPEG or PNG Format') }}</span>
						</div>
					</div>
				</div>

				<!-- <div class="card">
					<div class="card-body">
						<div class="form-group pb-0  mb-0">
							<label class="d-block">{{ __('Header Image') }} *</label>
						</div>
						<div class="form-group pb-0 pt-0 mt-0 mb-0">
							<img class="admin-img lg" src="{{ $subcategory->header_img ? asset('assets/images/subcategory/'.$subcategory->header_img) : asset('assets/images/placeholder.png') }}" >
						</div>
						<div class="form-group position-relative ">
							<label class="file">
							<input type="file"  accept="image/*"   class="upload-photo" name="header_img"
								id="file"  aria-label="File browser example">
							<span
								class="file-custom text-left">{{ __('Upload Image...') }}</span>
							</label>
							<br>
							<span class="mt-1 text-info">{{ __('Image Size Should Be 800 x 800. or square size') }}</span>
						</div>
					</div>
				</div> -->

				<!-- <div class="card">
					<div class="card-body">
						<div class="form-group pb-0  mb-0">
							<label>{{ __('Gallery Images') }} </label>
						</div>
						<div class="form-group pb-0 pt-0 mt-0 mb-0">
							<div id="gallery-images">
								<div class="d-block">

									@forelse($subcategory->galleryImages as $gallery)
										<div class="single-g-item d-inline-block m-2">
											<span data-toggle="modal"
											data-target="#confirm-delete" href="javascript:;"
											data-href="{{ route('back.subcategory.deleteGalleryImage', $gallery->id) }}" class="remove-gallery-img">
												<i class="fas fa-trash"></i>
											</span>
											<a class="popup-link" href="{{ $gallery->image ? asset('assets/images/subcategory/'.$gallery->image) : asset('assets/images/placeholder.png') }}">
												<img class="admin-gallery-img" src="{{ $gallery->image ? asset('assets/images/subcategory/'.$gallery->image) : asset('assets/images/placeholder.png') }}"
												alt="No Image Found">
											</a>
										</div>
									@empty
										<h6><b>{{ __('No Images Added') }}</b></h6>
									@endforelse
								</div>
							</div>
						</div>
						<div class="form-group position-relative ">
							<label class="file">
							<input type="file"  accept="image/*"  name="gallery_imgs[]" id="file"
								aria-label="File browser example" accept="image/*" multiple>
							<span
								class="file-custom text-left">{{ __('Upload Image...') }}</span>
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
							placeholder="{{ __('Enter Description') }}">{{ $subcategory->description }}</textarea>
						</div>
					</div>
				</div>

				<div class="card">
					<div class="card-body">
						<div class="form-group">
						<label for="details">{{ __('Special Description') }} *</label>
						<textarea name="special_desc" id="special_desc" class="form-control text-editor" rows="6"
							placeholder="{{ __('Enter Description') }}">{{ $subcategory->special_desc }}</textarea>
						</div>
					</div>
				</div> -->

				<div class="form-group">
					<button type="submit"
						class="btn btn-secondary ">{{ __('Submit') }}</button>
				</div>
			</form>
		</div>
	</div>

</div>

{{-- DELETE MODAL --}}

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirm-deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

		<!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ __('Confirm Delete?') }}</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
		</div>

		<!-- Modal Body -->
        <div class="modal-body">
			{{ __('You are going to delete this image from gallery.') }} {{ __('Do you want to delete it?') }}
		</div>

		<!-- Modal footer -->
        <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
			<form action="" class="d-inline btn-ok" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
			</form>
		</div>

      </div>
    </div>
</div>

{{-- DELETE MODAL ENDS --}}

@endsection
