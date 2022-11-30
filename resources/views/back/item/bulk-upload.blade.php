@extends('master.back')

@section('content')

<div class="container-fluid">

<!-- Page Heading -->
<div class="card mb-4">
    <div class="card-body">
        <div class="d-sm-flex align-items-center justify-content-between">
            <h3 class="mb-0 bc-title"><b>{{ __('Product CSV Import & Export') }}</b> </h3>
            <a class="btn btn-primary  btn-sm" href="{{route('back.item.index')}}"><i class="fas fa-chevron-left"></i> {{ __('Go Items') }}</a>
        </div>
    </div>
</div>

<!-- Form -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card o-hidden border-0 shadow-lg">
                    <div class="card-body pt4">
                        <div class="row text-center">
                            <div class="col-lg-12">
                            <form action="{{ route('back.item.images.multiple') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label class="file">
                                            <input type="file" accept="image/*" name="images[]" id="file"
                                                aria-label="File browser example" accept="image/*" multiple required>
                                            <span class="file-custom text-left">{{ __("Products' Multiple Images...") }}</span>
                                            
                                        </label>
                                    </div>
                                    <div class="col-lg-2">
                                        <button type="submit" class="btn btn-success">Upload</button>
                                    </div>
                                    
                                </div>
                                <!-- <div class="row mt-2"> -->
                                    
                                <!-- </div> -->
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            
    <!-- Product upload images end -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">

            <div class="card o-hidden border-0 shadow-lg">
                <div class="card-body pt4">
                    <!-- Nested Row within Card Body -->
                    <div class="row text-center">
                        <div class="col-lg-12">
                            <form class="admin-form tab-form" action="{{ route('back.csv.import') }}" method="POST"enctype="multipart/form-data">
                                <input type="hidden" value="normal" name="item_type">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-left">
                                            <a class="btn btn-info btn-sm" href="{{route('back.csv.export')}}">{{__('Products CSV Export')}}</a>
                                        </div>
                                        <div class="text-right">
                                            <a class="btn btn-info btn-sm" href="{{asset('assets/Tiles App - CSV Product Import Format.csv')}}" download>{{__('Simple CSV Download')}}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-left">
                                            <button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#exampleModal">{{__('See CSV Data Format')}}</button>
                                        </div>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">CSV Columns</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                category<br>subcategory<br>name<br>min_quantity<br>tags<br>product_features<br>product_description<br>meta_keywords<br>meta_description<br>status<br>attribute<br>attribute_abbreviation<br>attribute_option_name1<br>attribute_option_price1<br>attribute_option_stock1<br>attribute_option_description1<br>attribute_option_length1<br>attribute_option_height1<br>attribute_option_broad1<br>attribute_option_quantity1<br>attribute_option_variable_quantity1<br>attribute_option_name2<br>attribute_option_variable_quantity2
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-6">
                                        @include('alerts.alerts')
                                    
                                        <div class="form-group position-relative ">
                                            <label for="file">{{__('Uplaod Your CSV File')}}</label>
                                            <input type="file"  accept="csv" class="form-control" name="csv"
                                            id="file" required  >
                                    
                                        </div>
                                    </div>
                                </div>
                                </div>
                                </div>
                                <div class="form-group d-flex justify-content-center">
                                    <button type="submit"
                                        class="btn btn-secondary ">{{ __('Submit') }}</button>
                                </div>
                            </form>
                            
                            
                        </div>
                    </div>  
                </div>
            </div>

        </div>
    </div>

    <!--  -->

</div>

@endsection
