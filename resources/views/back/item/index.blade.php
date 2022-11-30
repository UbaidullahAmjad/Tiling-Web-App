@extends('master.back')


@section('content')



<!-- Start of Main Content -->
<div class="container-fluid">

	<!-- Page Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class="mb-0 bc-title"><b>{{ __('All Products') }}</b></h3>
                    <div class="right">
                        
                        <form class="d-inline-block" action="{{route('back.bulk.delete')}}" method="get">
                            <input type="hidden" value="" name="ids[]" id="bulk_delete">
                            <input type="hidden" value="items" name="table">
                            <button class="btn btn-danger btn-sm">{{__('Bulk Delete')}}</button>
                        </form>
                    </div>
                </div>
        </div>
    </div>

    <input type="hidden" id="product_url" value="{{route('back.item.index')}}">

	<!-- DataTales -->
	<div class="card shadow mb-4">
		<div class="card-body">
            @include('alerts.alerts')
            <form action="{{route('back.item.index')}}" method="GET">
                <div class="product-filter-area">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="mb-2"><b>{{ __('Product Filter :') }}</b></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6" >
                            <div class="form-group px-0">
                                <select class="form-control" name="category_id">
                                    <option disabled>{{__('Select Category')}}</option>
                                    <option value="">{{__('All Category')}}</option>
                                    @foreach(DB::table('categories')->whereStatus(1)->get() as $cat)
                                    <option value="{{ $cat->id }}" {{request()->input('category_id') == $cat->id ? 'selected' : ''}}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6" >
                            <div class="form-group px-0">
                                <select class="form-control" name="orderby">
                                    <option disabled>{{__('Select Order')}}</option>
                                    <option value="asc" {{request()->input('orderby') == 'asc' ? 'selected' : ''}}>{{__('Ascending order')}}</option>
                                    <option value="desc" {{request()->input('orderby') == 'desc' ? 'selected' : ''}}>{{__('Descending order')}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mt-2">
                            <button type="submit" class="btn btn-primary  py-2  d-inline-block">{{__('Filter Product')}}</button>
                        </div>
                    </div>
                </div>
            </form>



            <br>
			<div class="gd-responsive-table">
				<table class="table table-bordered table-striped" id="admin-table" width="100%" cellspacing="0">

					<thead>
						<tr>
							<th> <input type="checkbox" data-target="product-bulk-delete" class="form-control bulk_all_delete"> </th>
                            <th>Item ID</th>
							<th>{{ __('Image') }}</th>
                            <th width="30%">{{ __('Name') }}</th>
							<th>{{ __('Status') }}</th>
							
							<th>{{ __('Item Type') }}</th>
                            
							<th>{{ __('Actions') }}</th>
						</tr>
					</thead>

					<tbody>
                        @include('back.item.table',compact('datas'))
					</tbody>

				</table>
			</div>
		</div>
	</div>

</div>

</div>
<!-- End of Main Content -->

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
			{{ __('You are going to delete this item. All contents related with this item will be lost.') }} {{ __('Do you want to delete it?') }}
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



