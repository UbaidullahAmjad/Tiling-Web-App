@extends('master.back')

@section('content')

<div class="container-fluid">

<!-- Page Heading -->
<div class="card mb-4">
    <div class="card-body">
        <div class="d-sm-flex align-warehouses-center justify-content-between">
            <h3 class="mb-0 bc-title"><b>{{ __('Update Product') }}</b> </h3>
            <a class="btn btn-primary   btn-sm" href="{{route('back.warehouse.index')}}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
            @include('alerts.alerts')
    </div>
</div>
<!-- Nested Row within Card Body -->

<form class="admin-form" action="{{ route('back.warehouse.update',$warehouse->id) }}" method="POST"
      enctype="multipart/form-data">

      @csrf

      @method('PUT')
      <div class="row">

            <div class="col-lg-8">
                  <div class="card">
                        <div class="card-body">
                              <div class="form-group">
                                    <label for="name">{{ __('Name') }} *</label>
                                    <input type="text" name="name" class="form-control warehouse-name"
                                    id="name"
                                    placeholder="{{ __('Enter Name') }}"
                                    value="{{ $warehouse->name }}" >
                              </div>

                              

                              <div class="form-group">
                                    <label for="slug">{{ __('Delivery Time') }} *</label>
                                    <input type="text" name="delivery_time" class="form-control" id="delivery_time"
                                          placeholder="{{ __('Enter delivery time') }}" 
                                          value="{{ $warehouse->delivery_time }}">
                              </div>
                              
                              

                              <div class="form-group">
                                    <button type="submit"
                                          class="btn btn-secondary ">{{ __('Submit') }}</button>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</form>
</div>

@endsection
