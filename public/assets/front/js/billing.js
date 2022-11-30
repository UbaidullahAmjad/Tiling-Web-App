$(document).ready(function(){
    var user = "{{ auth()->user() }}";
    if(user){
        document.getElementById('logged-in-billing').style.display = 'block';
    }
});

// FOR Guest
$("#continue__button_guest").click(function(){
    document.getElementById('login_reg_guest').style.display = 'none';
    document.getElementById('billing_page_info').style.display = 'block';

});

$("#go_to_shipp_payement").click(function(){
        var bill_first_name = document.getElementById('checkout-fn').value;
        var bill_last_name = document.getElementById('checkout-fn').value;
        var bill_email = document.getElementById('checkout_email_billing').value;
        var bill_phone = document.getElementById('checkout-phone').value;
        var bill_company = document.getElementById('checkout-company').value;
        var bill_address1 = document.getElementById('checkout-address1').value;
        
        var bill_zip = document.getElementById('checkout-zip').value;
        var bill_city = document.getElementById('checkout-city').value;
        var bill_country = document.getElementById('billing-country').value;
        var same_ship_address = document.getElementById('same_address').checked;

        document.getElementById('b_f_name').style.display = "none";
        document.getElementById('b_f_email').style.display = "none";
        document.getElementById('b_f_phone').style.display = "none";
        document.getElementById('b_f_address').style.display = "none";
        document.getElementById('b_f_zip').style.display = "none";
        document.getElementById('b_f_country').style.display = "none";

        if(!bill_first_name){  
            document.getElementById('b_f_name').style.display = "block";
            exit();
        }
        if(!bill_email){  
            document.getElementById('b_f_email').style.display = "block";
            exit();
        }
        if(!bill_phone){  
            document.getElementById('b_f_phone').style.display = "block";
            exit();
        }
        if(!bill_address1){
            document.getElementById('b_f_address').style.display = "block";
            exit();
        }
        if(!bill_zip){
            document.getElementById('b_f_zip').style.display = "block";
        }
        if(bill_country == "Choose Country"){
            document.getElementById('b_f_country').style.display = "block";
            exit();
        }
        
        // exit();
    $.ajax({
        url : "{{ route('front.checkout.store') }}",
        type: "json",
        method: "post",
        data : {
            "_token": "{{ csrf_token() }}",
            bill_first_name : bill_first_name,
            bill_last_name : bill_last_name,
            bill_email : bill_email,
            bill_phone : bill_phone,
            bill_company : bill_company,
            bill_address1 : bill_address1,
            bill_zip : bill_zip,
            bill_city : bill_city,
            bill_country : bill_country,
            same_ship_address: same_ship_address
        },
        success: function(data){
            if(data.shipping_add == false){
                document.getElementById('billing_page_info').style.display = 'none';
                $('#billing_step').removeClass('active');
                $('#shipping_step').addClass('active');
                document.getElementById('shipping_page_info').style.display = 'block';
                const element = document.getElementById("shipping_step");
                element.scrollIntoView();
                
            }else{
                document.getElementById('billing_page_info').style.display = 'none';
                document.getElementById('shipping_page_info').style.display = 'none';
                $('#billing_step').removeClass('active');
                $('#shipping_step').removeClass('active');
                $('#payment_step').addClass('active');
                // console.log(document.getElementById('payment_page_info'))
                document.getElementById('payment_page_info').style.display = 'block';
                const element = document.getElementById("payment_step");
                element.scrollIntoView();

                
            }
        }
            
    });

});

// back to billing

$("#back_to_shipping").click(function(){
        
    document.getElementById('payment_page_info').style.display = 'none';

                document.getElementById('shipping_page_info').style.display = 'block';
                // document.getElementById('billing_page_info').style.display = 'block';
                $('#payment_step').removeClass('active');
                $('#shipping_step').addClass('active');
                
                const element = document.getElementById("shipping_step");
                element.scrollIntoView();
                
            
        
            
    

});
$("#back_to_billing").click(function(){
        

        document.getElementById('shipping_page_info').style.display = 'none';
        // document.getElementById('billing_page_info').style.display = 'block';
        document.getElementById('logged-in-billing').style.display = 'block';
        $('#shipping_step').removeClass('active');
        $('#billing_step').addClass('active');
        
        const element = document.getElementById("billing_step");
        element.scrollIntoView();
        
    

    


});



$("#go_to_payment_page").click(function(){
        var ship_first_name = document.getElementById('checkout-fnn').value;
        var ship_last_name = document.getElementById('checkout-fnn').value;
        var ship_email = document.getElementById('checkout-emaill').value;
        var ship_phone = document.getElementById('checkout-phonee').value;
        var ship_company = document.getElementById('checkout-companyy').value;
        var ship_address1 = document.getElementById('checkout-address11').value;
        
        var ship_zip = document.getElementById('checkout-zipp').value;
        var ship_city = document.getElementById('checkout-cityy').value;
        var ship_country = document.getElementById('billing-countryy').value;
        
        if(!ship_address1){
            // alert('');
            Swal.fire('Address is Required')
            exit();
        }
        if(!ship_company){
            Swal.fire('Company is Required')
            exit();
        }
        if(ship_country == "Choose Country"){
            Swal.fire('Country is Required')
            exit();
        }


    $.ajax({
        url : "{{route('front.checkout.shipping.store')}}",
        type: "json",
        method: "post",
        data : {
            "_token": "{{ csrf_token() }}",
            ship_first_name : ship_first_name,
            ship_last_name : ship_last_name,
            ship_email : ship_email,
            ship_phone : ship_phone,
            ship_company : ship_company,
            ship_address1 : ship_address1,
            ship_zip : ship_zip,
            ship_city : ship_city,
            ship_country : ship_country,
            // same_ship_address: same_ship_address
        },
        success: function(data){
            
                if(document.getElementById('billing_page_info')){
                    document.getElementById('billing_page_info').style.display = 'none';
                }else if(document.getElementById('logged-in-billing')){
                    document.getElementById('logged-in-billing').style.display = 'none';
                }
                
                document.getElementById('shipping_page_info').style.display = 'none';
                document.getElementById('payment_page_info').style.display = 'block';

                $('#billing_step').removeClass('active');
                $('#shipping_step').removeClass('active');
                $('#payment_step').addClass('active');
                const element = document.getElementById("payment_step");
                element.scrollIntoView();

                
            
        }
            
    });

});


// FOR Logged In User
$("#login-checkout-button").click(function(){
    var email = document.getElementById('login-checkout-email').value;
    var password = document.getElementById('login-checkout-password').value;
    $.ajax({
        url : "{{route('user.login.checkout.submit')}}",
        type: "json",
        method: "post",
        data : {
            "_token": "{{ csrf_token() }}",
            login_email : email,
            login_password : password,
            
            // same_ship_address: same_ship_address
        },
        success: function(data){
            console.log(document.getElementById('logged-in-billing'))
            $('#checkout-fnb').val(data.first_name);
            $('#checkout-lnb').val(data.last_name);
            $('#checkout_email_billingb').val(data.email);
            $('#checkout-phoneb').val(data.phone);
            $('#checkout-companyb').val(data.bill_company);
            $('#checkout-address1b').val(data.bill_address1);
            $('#checkout-zipb').val(data.bill_zip);
            $('#checkout-cityb').val(data.bill_city);
            $('#billing-countryb').val(data.bill_country);
           
            document.getElementById('login_reg_guest').style.display = 'none';
            document.getElementById('logged-in-billing').style.display = 'block';


                

                
            
        }
            
    });

});


$("#go_to_shippp_payement").click(function(){
        var bill_first_name = document.getElementById('checkout-fnb').value;
        var bill_last_name = document.getElementById('checkout-fnb').value;
        var bill_email = document.getElementById('checkout_email_billingb').value;
        var bill_phone = document.getElementById('checkout-phoneb').value;
        var bill_company = document.getElementById('checkout-companyb').value;
        var bill_address1 = document.getElementById('checkout-address1b').value;
        
        var bill_zip = document.getElementById('checkout-zipb').value;
        var bill_city = document.getElementById('checkout-cityb').value;
        var bill_country = document.getElementById('billing-countryb').value;
        var same_ship_address = document.getElementById('same_addressb').checked;

        document.getElementById('b_f_l_name').style.display = "none";
        document.getElementById('b_f_l_email').style.display = "none";
        document.getElementById('b_f_l_phone').style.display = "none";
        document.getElementById('b_f_l_address').style.display = "none";
        document.getElementById('b_f_l_zip').style.display = "none";
        document.getElementById('b_f_l_country').style.display = "none";

        if(!bill_first_name){  
            document.getElementById('b_f_l_name').style.display = "block";
            exit();
        }
        if(!bill_email){  
            document.getElementById('b_f_l_email').style.display = "block";
            exit();
        }
        if(!bill_phone){  
            document.getElementById('b_f_l_phone').style.display = "block";
            exit();
        }
        if(!bill_address1){
            document.getElementById('b_f_l_address').style.display = "block";
            exit();
        }
        if(!bill_zip){
            document.getElementById('b_f_l_zip').style.display = "block";
            exit();
        }
        if(bill_country == "Choose Country"){
            document.getElementById('b_f_l_country').style.display = "block";
            exit();
        }



    $.ajax({
        url : "{{ route('front.checkout.store') }}",
        type: "json",
        method: "post",
        data : {
            "_token": "{{ csrf_token() }}",
            bill_first_name : bill_first_name,
            bill_last_name : bill_last_name,
            bill_email : bill_email,
            bill_phone : bill_phone,
            bill_company : bill_company,
            bill_address1 : bill_address1,
            bill_zip : bill_zip,
            bill_city : bill_city,
            bill_country : bill_country,
            same_ship_address: same_ship_address
        },
        success: function(data){
            if(data.shipping_add == false){
                document.getElementById('logged-in-billing').style.display = 'none';
                $('#billing_step').removeClass('active');
                $('#shipping_step').addClass('active');
                document.getElementById('shipping_page_info').style.display = 'block';
                const element = document.getElementById("shipping_step");
                element.scrollIntoView();
                
            }else{
                document.getElementById('logged-in-billing').style.display = 'none';
                document.getElementById('shipping_page_info').style.display = 'none';
                $('#billing_step').removeClass('active');
                $('#shipping_step').removeClass('active');
                $('#payment_step').addClass('active');
                // console.log(document.getElementById('payment_page_info'))
                document.getElementById('payment_page_info').style.display = 'block';
                const element = document.getElementById("payment_step");
                element.scrollIntoView();

                
            }
        }
            
    });

});


$("#join_now_button").click(function(){
    document.getElementById('bill_ship_payment_section').style.display = 'none';
    document.getElementById('regis_page').style.display = 'block';

});
$("#regis_go_back").click(function(){
    document.getElementById('regis_page').style.display = 'none';
    document.getElementById('bill_ship_payment_section').style.display = 'block';


});

$("#do_register").click(function(){
    var first_name = document.getElementById('reg-fn').value;
    var last_name = document.getElementById('reg-ln').value;
    var email = document.getElementById('reg-email').value;
    var bill_address1 = document.getElementById('reg-address1').value;
    var bill_zip = document.getElementById('reg-zip').value;
    var bill_country = document.getElementById('reg-country').value;
    var phone = document.getElementById('reg-phone').value;
    var password = document.getElementById('reg-pass').value;
    var password_confirmation = document.getElementById('reg-pass-confirm').value;

    if(!password){
            Swal.fire('password is Required')
            exit();
        }
        if(!password_confirmation){
            Swal.fire('Confirm Password is Required')
            exit();
        }
        if(password != password_confirmation){
            Swal.fire('Password does not match')
            exit();
        }
        if(!bill_email){
            Swal.fire('Email is Required')
            exit();
        }
    if(!bill_address1){
            // alert('');
            Swal.fire('Address is Required')
            exit();
        }
        if(!bill_company){
            Swal.fire('Company is Required')
            exit();
        }
        if(bill_country == "Choose Country"){
            Swal.fire('Country is Required')
            exit();
        }


    $.ajax({
        url: "{{route('user.register.submit.ajax')}}",
        type: "json",
        method: "post",
        data : {
            "_token": "{{ csrf_token() }}",
            first_name : first_name,
            last_name : last_name,
            email : email,
            phone : phone,
            bill_country : bill_country,
            bill_address1 : bill_address1,
            bill_zip : bill_zip,
            password : password,
            password_confirmation : password_confirmation
           
           
        },
        success: function(data){

            if(data){
                document.getElementById('regis_page').style.display = 'none';
                document.getElementById('login_reg_guest').style.display = 'none';

                

                $('#checkout-fnb').val(data.first_name);
                $('#checkout-lnb').val(data.last_name);
                $('#checkout_email_billingb').val(data.email);
                $('#checkout-phoneb').val(data.phone);
                $('#checkout-companyb').val(data.bill_company);
                $('#checkout-address1b').val(data.bill_address1);
                $('#checkout-zipb').val(data.bill_zip);
                $('#checkout-cityb').val(data.bill_city);
                $('#billing-countryb').val(data.bill_country);
                document.getElementById('bill_ship_payment_section').style.display = 'block';
                document.getElementById('logged-in-billing').style.display = 'block';
            }else{
                alertify.set('notifier', 'position', 'top-right', 'delay', 80);
                alertify.error('Something went wrong');
            }
            

            
        }
    });


});