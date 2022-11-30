@extends('master.back')

@section('content')
    <div class="container-fluid">

        <!-- Option Heading -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h3 class="mb-0 bc-title"><b>{{ __('Create  Options') }}</b></h3>
                    <a class="btn btn-primary   btn-sm" href="{{ route('back.option.index', $item->id) }}"><i
                            class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
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
                                <form class="admin-form" action="{{ route('back.option.store', $item->id) }}"
                                    method="POST" enctype="multipart/form-data">

                                    @csrf

                                    @include('alerts.alerts')

                                    <div class="form-group">
                                        <label for="attribute_id">{{ __('Attribute') }} *</label>

                                        <select name="attribute_id" class="form-control" id="attribute_id">
                                            <option value="">{{ __('Select Attribute') }}</option>
                                            @foreach ($attributes as $attribute)
                                                <option value="{{ $attribute->id }}"
                                                    {{ $attribute->id == old('attribute_id') ? 'selected' : '' }}>
                                                    {{ $attribute->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="attr_name">{{ __('Name') }} *</label>
                                        <input type="text" name="name" class="form-control" id="attr_name"
                                            placeholder="{{ __('Enter Name') }}" value="{{ old('name') }}">
                                    </div>
                                    <div class="form-group position-relative ">
                                        <label class="file">
                                            <input type="file" accept="image/*" class="upload-photo" name="image" id="file"
                                                aria-label="File browser example">
                                            <span class="file-custom text-left">{{ __('Upload Image...') }}</span>
                                        </label>
                                        <br>
                                        <span
                                            class="mt-1 text-info">{{ __('Image Size Should Be 800 x 800. or square size') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="details">{{ __('Description') }} *</label>
                                        <textarea name="description" id="details" class="form-control text-editor" rows="6"
                                            placeholder="{{ __('Enter Description') }}">{{ old('details') }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="stock">{{ __('Warehouse Availability') }} *</label>
                                        <input type="number" name="availability" class="form-control" id="availability"
                                            placeholder="{{ __('Enter Stock') }}" value="{{ old('availability') }}">
                                        <label for="unlimited">
                                            <input type="checkbox" class="my-2" id="unlimited">
                                            {{ __('Unlimited') }}
                                        </label>
                                    </div>


                                    <div class="form-group">
                                        <label for="price">{{ __('+ Price') }} *</label>
                                        <small>({{ __('Set 0 to make it free') }})</small>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">{{ $curr->sign }}
                                                </span>
                                            </div>
                                            <input type="text" id="price" name="price" class="form-control"
                                                placeholder="{{ __('Enter Price') }}" value="{{ old('price') }}">
                                        </div>
                                    </div>
                                    <div id="three-fields" style="display:none">
                                        <div class="form-group">
                                            <label for="attr_name">{{ __('Length') }} </label>
                                            <input type="number" step="any" name="length" class="form-control" id="attr_name"
                                                placeholder="{{ __('Enter Length') }}" value="{{ old('length') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="attr_name">{{ __('Height') }} </label>
                                            <input type="number" step="any" name="height" class="form-control" id="attr_name"
                                                placeholder="{{ __('Enter Height') }}" value="{{ old('height') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="attr_name">{{ __('Broad') }} </label>
                                            <input type="number" step="any" name="broad" class="form-control" id="attr_name"
                                                placeholder="{{ __('Enter Broad') }}" value="{{ old('broad') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="attr_name">{{ __('Variable Quantity') }}</label>
                                            <input type="number" name="variable_quantity" class="form-control" id="variable_quantity"
                                                placeholder="{{ __('Enter Quantity') }}"
                                                value="1" step="any">
                                        </div>
                                        <div class="form-group">
                                        <label for="attr_name">{{ __('Item Number') }} *</label>
                                        <input type="text" name="item_number" class="form-control" id="item_number"
                                               placeholder="{{ __('Enter Item Number') }}" value="{{ old('item_number') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="attr_name">{{ __('Material') }} *</label>
                                        <input type="text" name="material" class="form-control" id="material"
                                               placeholder="{{ __('Enter Material') }}" value="{{ old('material') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="attr_name">{{ __('Use') }} *</label>
                                        <input type="text" name="used" class="form-control" id="used"
                                               placeholder="{{ __('Enter Use') }}" value="{{ old('used') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="attr_name">{{ __('Format') }} *</label>
                                        <input type="text" name="format" class="form-control" id="format"
                                               placeholder="{{ __('Enter Format') }}" value="{{ old('format') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="attr_name">{{ __('Surface') }} *</label>
                                        <input type="text" name="surface" class="form-control" id="surface"
                                               placeholder="{{ __('Enter Surface') }}" value="{{ old('surface') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="attr_name">{{ __('Edge') }} *</label>
                                        <input type="text" name="edge" class="form-control" id="edge"
                                               placeholder="{{ __('Enter Edge') }}" value="{{ old('edge') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="attr_name">{{ __('Weight (per unit)') }} *</label>
                                        <input type="text" name="weight_per_unit" class="form-control" id="weight_per_unit"
                                               placeholder="{{ __('Enter Weight') }}" value="{{ old('weight_per_unit') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="attr_name">{{ __('1 box contains =') }} *</label>
                                        <input type="text" name="box_contains" class="form-control" id="box_contains"
                                               placeholder="{{ __('1 box contains =') }}" value="{{ old('box_contains') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="attr_name">{{ __('Frost Resistance') }} *</label>
                                        <input type="text" name="frost_resistance" class="form-control" id="frost_resistance"
                                               placeholder="{{ __('Enter Frost Resistance') }}" value="{{ old('frost_resistance') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="attr_name">{{ __('Synonyms') }} *</label>
                                        <input type="text" name="synonyms" class="form-control" id="synonyms"
                                               placeholder="{{ __('Enter Synonyms') }}" value="{{ old('synonyms') }}">
                                    </div>
                                    </div>

                                    

                                    <div id="qty" style="display:none">
                                        <div class="form-group">
                                            <label for="attr_name">{{ __('Quantity') }}</label>
                                            <input type="number" name="quantity" class="form-control" id="attr_name"
                                                placeholder="{{ __('Enter Quantity') }}"
                                                value="1">
                                        </div>
                                    </div>


                                    <input type="hidden" id="attr_keyword" name="keyword" value="{{ old('keyword') }}">

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-secondary">{{ __('Submit') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $('select').on('change', function() {
            var val = this.value;
            $.ajax({
                url: "{{ route('check-attribute') }}",
                method: "GET",
                data: {
                    id: val
                },
                success: function(data) {

                    if (data == "square") {


                        document.getElementById('qty').style.display = "none";
                        document.getElementById('three-fields').style.display = "block";
                    } else if (data == "other") {
                        document.getElementById('three-fields').style.display = "none";
                        document.getElementById('qty').style.display = "block";


                    }
                }
            });
        });
    </script>
@endsection
