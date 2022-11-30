<!DOCTYPE html>
<html>
   <head>
      <title></title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
      <style type="text/css">
         .panel-title {
         display: inline;
         font-weight: bold;
         }
         .display-table {
         display: table;
         }
         .display-tr {
         display: table-row;
         }
         .display-td {
         display: table-cell;
         vertical-align: middle;
         width: 61%;
         }

         .card{
             padding: 15px;
             text-align: center;
             margin-top: 10px;
         }
      </style>
   </head>
   <body>
      <div class="container">
         
         <div class="row card">
            <div class="col-md-6 col-md-offset-3">
               <div class="panel panel-default credit-card-box">
                  <div class="panel-heading display-table" >
                     <div class="row display-tr" >
                        <h3 class="panel-title display-td" >Payment Details</h3>
                        
                     </div>
                  </div>
                  <div class="panel-body">
                     @if (Session::has('success'))
                     <div class="alert alert-success text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p>{{ Session::get('success') }}</p>
                     </div>
                     @endif
                     <form
                        role="form"
                        action="{{ route('front.checkout.submit') }}"
                        method="post"
                        
                        
                        id="payment-form">
                        @csrf
                        <input type="hidden" name="payment_method" value="Stripe">
                             <input type="hidden" name="state_id" value="{{ $state_id }}" class="state_id_setup">
                        <div class='form-row row'>
                           <div class='col-xs-12 form-group card required'>
                              <label class='control-label'>Card Number</label> <input class="form-control" type="number" id="stripe-card" maxlength="16" name="card"
                                     placeholder="{{ __('Card Number') }}" required>
                           </div>
                        </div>
                        <div class='form-row row'>
                           <div class='col-xs-12 col-md-4 form-group cvc required'>
                              <label class='control-label'>CVC</label> <input class="form-control" type="number" id="stripe-cvv" maxlength="3" name="cvc" placeholder="{{ __('CVV') }}"
                                     required>
                           </div>
                           <div class='col-xs-12 col-md-4 form-group expiration required'>
                              <label class='control-label'>Expiration Month</label> <input class="form-control" type="number" id="stripe-month" maxlength="2" name="month"
                                     placeholder="{{ __('Expitation Month') }}" required>
                           </div>
                           <div class='col-xs-12 col-md-4 form-group expiration required'>
                              <label class='control-label'>Expiration Year</label> <input class="form-control" type="number" id="stripe-year" maxlength="4"  name="year"
                                     placeholder="{{ __('Expitation Year') }}" required>
                           </div>
                     </div>
                        
                        <div class="row">
                           <div class="col-xs-12">
                              <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now</button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
     <script>
         $(document).ready(function () {
  //called when key is pressed in textbox
  $("#stripe-card").keypress(function (e) {
     
     var maxlengthNumber = parseInt($('#stripe-card').attr('maxlength'));
     var inputValueLength = $('#stripe-card').val().length + 1;
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        
               return false;
    }
    if(maxlengthNumber < inputValueLength) {
    	return false;
    }
   });


   $("#stripe-month").keypress(function (e) {
     
     var maxlengthNumber = parseInt($('#stripe-month').attr('maxlength'));
     var inputValueLength = $('#stripe-month').val().length + 1;
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        
               return false;
    }
    if(maxlengthNumber < inputValueLength) {
    	return false;
    }
   });

   $("#stripe-year").keypress(function (e) {
     
     var maxlengthNumber = parseInt($('#stripe-year').attr('maxlength'));
     var inputValueLength = $('#stripe-year').val().length + 1;
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        
               return false;
    }
    if(maxlengthNumber < inputValueLength) {
    	return false;
    }
   });

   $("#stripe-cvv").keypress(function (e) {
     
     var maxlengthNumber = parseInt($('#stripe-cvv').attr('maxlength'));
     var inputValueLength = $('#stripe-cvv').val().length + 1;
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        
               return false;
    }
    if(maxlengthNumber < inputValueLength) {
    	return false;
    }
   });
});
     </script>
   </body>
   
</html>