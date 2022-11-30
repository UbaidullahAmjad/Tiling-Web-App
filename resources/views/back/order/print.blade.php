<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/' . $setting->favicon) }}" />

    <title>{{ $setting->title }}</title>
    <!-- Bootstrap -->
    <link href="{{ asset('assets/front/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/front/css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/css/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/css/jquery-ui.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/front/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/css/owl.carousel.min.css') }}" rel="stylesheet">

    @yield('css')

    <!-- Main css -->
    <link href="{{ asset('assets/front/css/main.css') }}" rel="stylesheet">
</head>

<body id="invoice-print" onload="window.print()" id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @php
                    if ($order->state) {
                        $state = json_decode($order->state, true);
                    } else {
                        $state = [];
                    }
                @endphp
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col text-center">

                                        <!-- Logo -->
                                        <img class="img-fluid mb-5 mh-70" width="180" alt="Logo"
                                            src="{{ asset('assets/images/' . $setting->logo) }}">

                                    </div>
                                </div> <!-- / .row -->
                                <div class="row">
                            <div class="col-12">
                                <h5><b>{{ __('Order Details :') }}</b></h5>

                                <span class="text-muted"><strong>{{ __('Transaction Id : ') }} </strong></span>{{ $order->txnid }}<br>
                                <span
                                    class="text-muted"> <strong>{{ __('Order Id : ') }}</strong></span>{{ $order->transaction_number }}<br>
                                <span
                                    class="text-muted"><strong>{{ __('Order Date : ') }}</strong></span>{{ $order->created_at->format('M d, Y') }}<br>
                                <span class="text-muted"><strong>{{ __('Payment Status : ') }}</strong></span>
                                @if ($order->payment_status == 'Paid')
                                    <div class="badge badge-success">
                                        {{ __('Paid') }}
                                    </div>
                                @else
                                    <div class="badge badge-danger">
                                        {{ __('Unpaid') }}
                                    </div>
                                @endif
                                <br>
                                <span
                                    class="text-muted"><strong>{{ __('Payment Method : ') }}</strong></span>{{ $order->payment_method }}<br>

                                <br>
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-6">
                                <h5><b>{{ __('Billing Address :') }}</b></h5>
                                @php
                                    $bill = json_decode($order->billing_info, true);

                                @endphp

                                <span class="text-muted"><strong>{{ __('Name') }}: </strong></span>{{ $bill['bill_first_name'] }}
                                {{ $bill['bill_last_name'] }}<br>
                                <span class="text-muted"><strong>{{ __('Email') }}: </strong></span>{{ $bill['bill_email'] }}<br>
                                <span class="text-muted"><strong>{{ __('Phone') }}: </strong></span>{{ $bill['bill_phone'] }}<br>
                                @if (isset($bill['bill_address1']))
                                    <span class="text-muted"><strong>{{ __('Address') }}: </strong></span>{{ $bill['bill_address1'] }},
                                    {{ isset($bill['bill_address2']) ? $bill['bill_address2'] : '' }}<br>
                                @endif
                                @if (isset($bill['bill_country']))
                                    <span class="text-muted"><strong>{{ __('Country') }}:</strong>
                                    </span>{{ $bill['bill_country'] }}<br>
                                @endif
                                @if (isset($bill['bill_city']))
                                    <span class="text-muted"><strong>{{ __('City') }}: </strong></span>{{ $bill['bill_city'] }}<br>
                                @endif
                                @if (isset($state['name']))
                                    <span class="text-muted"><strong>{{ __('State') }}: </strong></span>{{ $state['name'] }}<br>
                                @endif
                                @if (isset($bill['bill_zip']))
                                    <span class="text-muted"><strong>{{ __('Zip') }}:</strong> </span>{{ $bill['bill_zip'] }}<br>
                                @endif
                                @if (isset($bill['bill_company']))
                                    <span class="text-muted"><strong>{{ __('Company') }}:</strong>
                                    </span>{{ $bill['bill_company'] }}<br>
                                @endif


                            </div>
                            <div class="col-6 col-md-6">
                                <h5> <b>{{ __('Shipping Address :') }}</b></h5>
                                @php
                                    $ship = json_decode($order->shipping_info, true);
                                @endphp
                                <span class="text-muted"><strong>{{ __('Name') }}: </strong></span>{{ $ship['ship_first_name'] }}
                                {{ $ship['ship_last_name'] }} <br>
                                <span class="text-muted"><strong>{{ __('Email') }}: </strong></span>{{ $ship['ship_email'] }}<br>
                                <span class="text-muted"><strong>{{ __('Phone') }}: </strong></span>{{ $ship['ship_phone'] }}<br>
                                @if (isset($ship['ship_address1']))
                                    <span class="text-muted"><strong>{{ __('Address') }}: </strong></span>{{ $ship['ship_address1'] }},
                                    {{ isset($ship['ship_address2']) ? $ship['ship_address2'] : '' }}<br>
                                @endif
                                @if (isset($ship['ship_country']))
                                    <span class="text-muted"><strong>{{ __('Country') }}:</strong>
                                    </span>{{ $ship['ship_country'] }}<br>
                                @endif
                                @if (isset($ship['ship_city']))
                                    <span class="text-muted"><strong>{{ __('City') }}: </strong></span>{{ $ship['ship_city'] }}<br>
                                @endif
                                @if (isset($state['name']))
                                    <span class="text-muted"><strong>{{ __('State') }}: </strong></span>{{ $state['name'] }}<br>
                                @endif
                                @if (isset($ship['ship_zip']))
                                    <span class="text-muted"><strong>{{ __('Zip') }}: </strong></span>{{ $ship['ship_zip'] }}<br>
                                @endif
                                @if (isset($ship['ship_company']))
                                    <span class="text-muted"><strong>{{ __('Company') }}:</strong>
                                    </span>{{ $ship['ship_company'] }}<br>
                                @endif

                            </div>
                        </div>
                                <div class="row">
                                    <div class="col-12">

                                        <!-- Table -->
                                        <div class="gd-responsive-table">
                                            <table class="table my-4">
                                                <thead>
                                                    <tr>
                                                        <th width="50%" class="px-0 bg-transparent border-top-0">
                                                            <span class="h6">{{ __('Products') }}</span>
                                                        </th>
                                                        <th class="px-0 bg-transparent border-top-0">
                                                            <span class="h6">{{ __('Attribute') }}</span>
                                                        </th>
                                                        <th class="px-0 bg-transparent border-top-0">
                                                            <span class="h6">{{ __('Quantity') }}</span>
                                                        </th>
                                                        <th class="px-0 bg-transparent border-top-0 text-right">
                                                            <span class="h6">{{ __('Price') }}</span>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $option_price = 0;
                                                        $total = 0;
                                                    @endphp
                                                    @foreach (json_decode($order->cart, true) as $item)
                                                        @php
                                                            $total += $item['main_price'] * $item['qty'];
                                                            $option_price += $item['attribute_price'];
                                                            $grandSubtotal = $total + $option_price;
                                                        @endphp
                                                        <tr>
                                                            <td class="px-0">
                                                                {{ $item['name'] }}
                                                            </td>
                                                            <td class="px-0">
                                                                @if (isset($item['attribute']['option_name']))
                                                                    @foreach ($item['attribute']['option_name'] as $optionkey => $option_name)
                                                                        <span
                                                                            class="entry-meta"><b>{{ $option_name }}</b>
                                                                            :
                                                                            @if ($setting->currency_direction == 1)
                                                                                {{ $order->currency_sign }}{{ round($item['attribute']['option_price'][$optionkey] * $order->currency_value, 2) }}
                                                                            @else
                                                                                {{ round($item['attribute']['option_price'][$optionkey] * $order->currency_value, 2) }}{{ $order->currency_sign }}
                                                                            @endif

                                                                        </span>
                                                                    @endforeach
                                                                @else
                                                                    --
                                                                @endif
                                                            </td>
                                                            <td class="px-0">
                                                                {{ $item['qty'] }}
                                                            </td>

                                                            <td class="px-0 text-right">
                                                                @if ($setting->currency_direction == 1)
                                                                    {{ $order->currency_sign }}{{ round($item['main_price'] * $order->currency_value, 2) }}
                                                                @else
                                                                    {{ round($item['main_price'] * $order->currency_value, 2) }}{{ $order->currency_sign }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td class="padding-top-2x" colspan="5">
                                                        </td>
                                                    </tr>
                                                    @if ($order->tax != 0)
                                                        <tr>
                                                            <td class="px-0 border-top border-top-2">
                                                                <span class="text-muted">{{ __('Tax') }}</span>
                                                            </td>
                                                            <td class="px-0 text-right border-top border-top-2"
                                                                colspan="5">
                                                                <span>
                                                                    @if ($setting->currency_direction == 1)
                                                                        {{ $order->currency_sign }}{{ round($order->tax * $order->currency_value, 2) }}
                                                                    @else
                                                                        {{ round($order->tax * $order->currency_value, 2) }}{{ $order->currency_sign }}
                                                                    @endif
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    @if (json_decode($order->discount, true))
                                                        @php
                                                            $discount = json_decode($order->discount, true);
                                                        @endphp
                                                        <tr>
                                                            <td class="px-0 border-top border-top-2">
                                                                <span
                                                                    class="text-muted">{{ __('Coupon discount') }}
                                                                    ({{ $discount['code']['code_name'] }})</span>
                                                            </td>
                                                            <td class="px-0 text-right border-top border-top-2"
                                                                colspan="5">
                                                                <span class="text-danger">
                                                                    @if ($setting->currency_direction == 1)
                                                                        -{{ $order->currency_sign }}{{ round($discount['discount'] * $order->currency_value, 2) }}
                                                                    @else
                                                                        -{{ round($discount['discount'] * $order->currency_value, 2) }}{{ $order->currency_sign }}
                                                                    @endif
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    @if (json_decode($order->shipping, true))
                                                        @php
                                                            $shipping = json_decode($order->shipping, true);
                                                        @endphp
                                                        <tr>
                                                            <td class="px-0 border-top border-top-2">
                                                                <span
                                                                    class="text-muted">{{ __('Shipping') }}</span>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td class="px-0 text-right border-top border-top-2"
                                                                colspan="5">
                                                                <span>
                                                                    @if ($setting->currency_direction == 1)
                                                                        {{ $order->currency_sign }}{{ round($shipping['price'] * $order->currency_value, 2) }}
                                                                    @else
                                                                        {{ round($shipping['price'] * $order->currency_value, 2) }}{{ $order->currency_sign }}
                                                                    @endif

                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    @if (json_decode($order->state_price, true))
                                                        <tr>
                                                            <td class="px-0 border-top border-top-2">
                                                                <span
                                                                    class="text-muted">{{ __('State Tax') }}</span>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td class="px-0 text-right border-top border-top-2"
                                                                colspan="5">
                                                                <span>
                                                                    @if ($setting->currency_direction == 1)
                                                                        {{ isset($state['type']) && $state['type'] == 'percentage' ? ' (' . $state['price'] . '%) ' : '' }}
                                                                        {{ $order->currency_sign }}{{ round($order['state_price'] * $order->currency_value, 2) }}
                                                                    @else
                                                                        {{ isset($state['type']) && $state['type'] == 'percentage' ? ' (' . $state['price'] . '%) ' : '' }}
                                                                        {{ round($shipping['state_price'] * $order->currency_value, 2) }}{{ $order->currency_sign }}
                                                                    @endif

                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    <tr>
                                                        <td class="px-0 border-top border-top-2">

                                                            @if ($order->payment_method == 'Cash On Delivery')
                                                                <strong>{{ __('Total amount') }}</strong>
                                                            @else
                                                                <strong>{{ __('Total amount due') }}</strong>
                                                            @endif
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="px-0 text-right border-top border-top-2" colspan="5">
                                                            <span class="h3">
                                                                @if ($setting->currency_direction == 1)
                                                                    {{ $order->currency_sign }}{{ App\Helpers\PriceHelper::OrderTotal($order) }}
                                                                @else
                                                                    {{ App\Helpers\PriceHelper::OrderTotal($order) }}{{ $order->currency_sign }}
                                                                @endif
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div> <!-- / .row -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

</body>

</html>
