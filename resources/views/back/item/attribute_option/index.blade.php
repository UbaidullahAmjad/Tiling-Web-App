@extends('master.back')

@section('content')

<!-- Start of Main Content -->
<div class="container-fluid">
  @php
    $attr = $item->attributes->first();
    
  @endphp
	<!-- Option Heading -->
    <div class="card mb-4">
       <div class="card-body">
        <div class="d-sm-flex align-items-center justify-content-between">
            <h3 class="mb-0 bc-title"><b>{{ __('Attribute Options') }}</b> </h3>
            <div>
                <a class="btn btn-primary   btn-sm" href="{{route('back.attribute.index',$item->id)}}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
                @if($attr != null && $attr->abbrivation == "m2")
                <a class="btn btn-primary btn-sm" href="{{ route('back.option.create',$item->id) }}"><i class="fas fa-plus"></i> {{ __('Add') }}</a>
                @elseif($attr != null && count($datas) < 1)
                <a class="btn btn-primary btn-sm" href="{{ route('back.option.create',$item->id) }}"><i class="fas fa-plus"></i> {{ __('Add') }}</a>
                @endif
            </div>
            </div>
       </div>
    </div>


	<!-- DataTales -->
	<div class="card shadow mb-4">
		<div class="card-body">
			@include('alerts.alerts')
			<div class="gd-responsive-table">
				<table class="table table-bordered table-striped" id="admin-table" width="100%" cellspacing="0">

					<thead>
						<tr>
              <th width="20%">{{ __('Option Name') }}</th>
              <th width="20%">{{ __('Attribute') }}</th>
              <th width="20%">{{ __('Price') }}</th>
              <th width="20%">{{ __('Stock') }}</th>
							<th width="15%">{{ __('Actions') }}</th>
						</tr>
					</thead>

					<tbody>
                        @include('back.item.attribute_option.table',compact('datas'))
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
			{{ __('You are going to delete this option. All contents related with this option will be lost.') }} {{ __('Do you want to delete it?') }}
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
