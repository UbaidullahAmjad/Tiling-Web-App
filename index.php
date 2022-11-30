<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap-grid.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>GeniusDevs</title>
    <style>
        /*custom font*/
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

        :root {
            --heading-color: #333;
            --paragraph-color: #777;
            --main-color-one: #377DFF ;
            --secondary-color: #30373f;
        }

        /*basic reset*/
        * {
            margin: 0;
            padding: 0;
        }
        body{
            font-family: 'Roboto', sans-serif;
        }

        .alert.alert-warning {
            background-color: #f0f07b;
            color: #333;
        }
        #msform {
            text-align: center;
            position: relative;
        }

        #msform .content-wrap {
            background: white;
            border: 0 none;
            border-radius: 3px;
            padding: 40px 30px 40px 30px;
            box-sizing: border-box;
            position: relative;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        }

        #msform .content-wrap:not(:first-of-type) {
            display: none;
        }

        #msform input, #msform textarea {
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-bottom: 10px;
            width: 100%;
            box-sizing: border-box;
            font-family: montserrat;
            color: #2C3E50;
            font-size: 13px;
        }

        #msform .action-button {
            width: 100px;
            background: var(--main-color-one);
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 1px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px;
        }

        #msform .action-button:hover, #msform .action-button:focus {
            box-shadow: 0 0 0 2px white, 0 0 0 3px var(--main-color-one);
        }
        .btn{
            background: #377DFF;
            color: #fff;
            padding: 10px 30px;
            border-radius: 5px;
            text-decoration: none;
        }
        .fs-title {
            font-size: 15px;
            text-transform: uppercase;
            color: #2C3E50;
            margin-bottom: 10px;
        }

        .fs-subtitle {
            font-weight: normal;
            font-size: 13px;
            color: #666;
            margin-bottom: 20px;
        }

        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            counter-reset: step;
            display: flex;
            justify-content: space-evenly;
        }

        #progressbar li.active {
            color: #2c3e50;
            font-weight: 700;
        }

        #progressbar li {
            list-style-type: none;
            color: white;
            text-transform: capitalize;
            font-size: 14px;
            position: relative;
            font-weight: 600;
        }

        #progressbar li:before {
            content: counter(step);
            counter-increment: step;
            width: 30px;
            line-height: 30px;
            display: block;
            font-size: 14px;
            color: #333;
            background: white;
            border-radius: 3px;
            margin: 0 auto 15px auto;;
            font-weight: 700;
        }

        #progressbar li:after {
            content: '';
            width: 210%;
            height: 2px;
            background: white;
            position: absolute;
            left: -160%;
            top: 13px;
            z-index: -1;
        }

        #progressbar li:first-child:after {
            content: none;
        }

        #progressbar li:nth-child(2)::after {
            width: 200%;
            left: -140%;
        }

        #progressbar li.active:before {
            background: var(--main-color-one);
            color: white;
        }

        .brand-logo img {
            max-width: 200px;
            text-align: center;
        }

        .brand-logo {
            display: flex;
            justify-content: center;
            margin-bottom: 40px;
            flex-direction: column;
            align-items: center;
        }

        .main-area {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            width: 100%;
            padding: 100px 0;
        }

        .copyright-area {
            text-align: center;
            font-size: 14px;
            color: rgba(255, 255, 255, .6);
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding-bottom: 30px;
            background-color: rgb(198, 161, 207);
        }


        .copyright-area a {
            color: #fff;
        }

        .brand-logo .title {
            font-size: 40px;
            line-height: 50px;
            font-weight: 700;
            display: block;
            margin-bottom: 0px;
        }


        .get-support {
            position: fixed;
            right: 60px;
            bottom: 60px;
        }

        .get-support .icon-wrap {
            position: relative;
            z-index: 0;
        }

        .get-support .icon-wrap:hover .support-list {
            visibility: visible;
            opacity: 1;
        }

        .get-support .icon-wrap .support-list {
            position: absolute;
            bottom: 40px;
            left: 100px;
            margin: 0;
            padding: 0;
            list-style: none;
            width: 100%;
            visibility: hidden;
            opacity: 0;
            transition: 300ms all;
        }

        .get-support .icon-wrap .support-list li {
            display: block;
            background-color: #fff;
        }

        .get-support .icon-wrap .support-list li:nth-child(1),
        .get-support .icon-wrap .support-list li:nth-child(2) {
            position: absolute;
            bottom: 50px;
            right: 100px;
        }

        .get-support .icon-wrap .support-list li:nth-child(1) a,
        .get-support .icon-wrap .support-list li:nth-child(2) a {
            text-decoration: none;
            padding: 8px 20px;
            width: 180px;
            display: block;
            color: #333;
            font-weight: 600;
            transition: all 300ms;
        }

        .get-support .icon-wrap .support-list li:nth-child(1) a:hover,
        .get-support .icon-wrap .support-list li:nth-child(2) a:hover {
            background-color: var(--main-color-one);
            color: #fff;
        }

        .get-support .icon-wrap .support-list li:nth-child(2) {
            position: absolute;
            bottom: 90px;
            right: 100px;
        }

        .get-support .icon-wrap .support-list li:nth-child(2) a {
            text-decoration: none;
            padding: 8px 20px;
            width: 180px;
            display: block;
            color: #333;
            font-weight: 600;
            transition: all 300ms;
        }

        .get-support .icon-wrap i {
            display: inline-block;
            width: 80px;
            height: 80px;
            text-align: center;
            line-height: 80px;
            font-size: 40px;
            background-color: #fff;
            border-radius: 50%;
            color: var(--main-color-one);
            cursor: pointer;
        }

        .content-wrap h4 {
            font-size: 26px;
            line-height: 36px;
            margin-bottom: 20px;
            color: var(--heading-color);
        }

        .content-wrap p {
            color: var(--paragraph-color);
        }

        ul.check-list li.title:before {
            display: none;
        }

        ul.check-list li:before {
            position: static;
            content: "\f058";
            margin-right: 0;
            color: #2bad2b;
            font-family: fontawesome;
        }

        ul.check-list li + li {
            margin-top: 8px;
            color: var(--heading-color);
            opacity: .9;
        }

        ul.close-list .title {
            color: red;
        }

        ul.check-list .title {
            color: #2bad2b;
        }

        ul.close-list {
            padding: 0;
            list-style: none;
            margin: 20px 0;
        }

        ul.check-list .title, ul.close-list .title {
            font-size: 20px;
            font-weight: 700;
            margin: 20px 0;
            border-bottom: 1px solid #e2e2e2;
            padding-bottom: 10px;
        }

        ul.check-list {
            margin: 0;
            padding: 0;
            list-style: none;
            margin-bottom: 20px;
        }

        ul.close-list li.title:before {
            display: none;
        }

        ul.close-list li:before {
            position: static;
            content: "\f057";
            font-family: fontawesome;
            margin-right: 5px;
            color: red;
        }

        ul.close-list li {
            color: var(--heading-color);
            opacity: .78;
        }

        #msform .action-button {
            width: auto;
            padding: 15px 30px;
            margin-top: 30px;
            font-size: 16px;
            font-weight: 600;
        }

        #msform .action-button:focus {
            border: none;
            outline: none;
            box-shadow: none;
        }

        .icon.check {
            color: #2bad2b;
        }

        .icon.close {
            color: #f35656;
        }

        table,
        .requirement-check {
            border-collapse: collapse;
            width: 100%;
        }

        th, td,
        .requirement-check th,
        .requirement-check td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(odd),
        .requirement-check tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        tr:nth-child(even),
        .requirement-check tr:nth-child(even) {
            background-color: #ececec;
        }

        #msform .action-button[disabled] {
            background-color: #eee;
            color: #444;
        }

        .content-wrap h5 {
            font-size: 20px;
            text-align: left;
            margin-bottom: 20px;
        }

        .form-block {
            margin-bottom: 30px;
            text-align: left;
        }

        .form-block label {
            opacity: .8;
            margin-bottom: 10px;
            display: block;
        }

        .form-group .form-control {
            border: 1px solid #e2e2e2;
            border-radius: 0;
        }

        .form-group .form-control:focus {
            outline: none;
            box-shadow: none;
        }

        #msform input[readonly] {
            background-color: #f2f2f2;
            font-weight: 600;
        }

        .alert {
            position: relative;
            padding: .75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: .25rem;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        ul.error-list {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        ul.error-list li + li {
            margin-top: 10px;
        }

        ul.error-list li {
            font-size: 14px;
            font-weight: 600;
        }

        .install-success {
            display: block;
            width: 100%;
            background-color: #fff;
            padding: 10px 20px;
            margin-bottom: 40px;
        }

        .install-success a {
            color: #fff;
            text-decoration: none;
            background-color: #000;
            padding: 3px 10px;
            border-radius: 3px;
            font-size: 14px;
            margin-top: 20px;
            display: inline-block;
        }

        .install-success strong {
            color: red;
        }

        .info strong {
            color: #2bad2b;
        }

        .check-db-connection {
            display: flex;
            justify-content: space-between;
            background-color: #ececec;
            margin-bottom: 30px;
            align-items: center;
            padding: 20px;
            border-radius: 4px;
        }

        .check-db-connection h2 {
            font-size: 16px;
            font-weight: 500;
        }

        .check-db-connection .boxed-btn.success,
        .check-db-connection .boxed-btn.success:hover{
            background-color: green;
        }
        .check-db-connection .boxed-btn {
            border: none;
            padding: 10px 20px;
            background-color: #000b26;
            border-radius: 3px;
            transition: all 300ms;
            cursor: pointer;
            font-weight: 500;
            color: #fff;
        }

        .check-db-connection .boxed-btn:hover {
            background-color: green;
        }
        .hidden-update-wrap{
            display: none;
        }
        .hidden-update-wrap.show{
            display: block;
        }
        @keyframes flickerAnimation {
            0%   { opacity:1; }
            50%  { opacity:0.5; }
            100% { opacity:1; }
        }
        @-o-keyframes flickerAnimation{
            0%   { opacity:1; }
            50%  { opacity:0.5; }
            100% { opacity:1; }
        }
        @-moz-keyframes flickerAnimation{
            0%   { opacity:1; }
            50%  { opacity:0.5; }
            100% { opacity:1; }
        }
        @-webkit-keyframes flickerAnimation{
            0%   { opacity:1; }
            50%  { opacity:0.5; }
            100% { opacity:1; }
        }
        .animate-flicker {
            -webkit-animation: flickerAnimation 3s infinite;
            -moz-animation: flickerAnimation 3s infinite;
            -o-animation: flickerAnimation 3s infinite;
            animation: flickerAnimation 3s infinite;
        }
        .form-control.has-error {
            border: 2px solid #c74343 !important;
        }
        .head-wrap {
            text-align: left;
        }
        .head-wrap strong {
            color: #da4c59;
            font-size: 14px;
            font-weight: 400;
        }

        .info-text {
            font-size: 14px;
            margin: 0 0 15px;
            display: block;
            color: #f17171;
        }

        .info-text strong {
            background-color: #e6e6e6;
            color: #515152;
            padding: 1px 5px;
        }

        .info-text code {
            background-color: #e6e6e6;
            color: #515152;
            padding: 1px 5px;
        }
    </style>
</head>
<body>
<?php
function home_base_url()
{
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
        $url = "https://";
    }else{
        $url = "http://";
    }
    // Append the host(domain name, ip) to the URL.
    $url.= $_SERVER['HTTP_HOST'];
    // Append the requested resource location to the URL
    $url.= $_SERVER['REQUEST_URI'];

    return str_replace(['install/index.php','install/','install','update/index','update/','/update'],['','','','','',''],$url);
}
function get_current_file_url($Protocol='http://') {
    $Protocol = isSecure() ?  'https://' : 'http://';
    return $Protocol.$_SERVER['HTTP_HOST'].str_replace(realpath($_SERVER['DOCUMENT_ROOT']), '', realpath(__DIR__));
}

function isSecure() {
  return
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || $_SERVER['SERVER_PORT'] == 443;
}





function showErrorMessage($msg){
    return '<div class="alert alert-danger">'.$msg.'</div>';
}

function showSuccessMessage($msg){
    return '<div class="alert alert-success">'.$msg.'</div>';
}




function formatBytes($size, $precision = 2)
{
    $base = log($size, 1024);
    $suffixes = array('', 'KB', 'MB', 'GB', 'TB');

    return round(1024 ** ($base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
}

function make_slug($title, $separator = '-')
{

    // Convert all dashes/underscores into separator
    $flip = $separator === '-' ? '_' : '-';

    $title = preg_replace('![' . preg_quote($flip) . ']+!u', $separator, $title);

    // Replace @ with the word 'at'
    $title = str_replace('@', $separator . 'at' . $separator, $title);

    // Remove all characters that are not the separator, letters, numbers, or whitespace.
    $title = preg_replace('![^' . preg_quote($separator) . '\pL\pN\s]+!u', '', mb_strtolower($title, 'UTF-8'));

    // Replace all separator characters and whitespace by a single separator
    $title = preg_replace('![' . preg_quote($separator) . '\s]+!u', $separator, $title);

    return trim($title, $separator);
}



?>
<div class="main-area">
   
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="form-outer-wrapper">
                    <div class="brand-logo">
                        <h2 class="title">GeniusDevs</h2>
                        <p>Software Update Wizard</p>
                    </div>

                   
                    <form id="msform" action="index.php" method="post">
                   
                    
                        <div class="content-wrap with-step">
                            <h4>Database Information</h4>
                            
                           
                            <div class="">
                                <div class="alert alert-warning">
                                    if any of those failed, try again, <strong>Don't forget to keep a backup your script and database</strong>
                                </div>
                                <div class="appendable-message-box"></div>
                                <div class="check-db-connection">
                                    <h2>Update OmniMart</h2>
                                    <div class="right-wrap">
                                        <button class="boxed-btn file_update_button"  type="button" data-action="_update_controller_files">Update</button>
                                    </div>
                                    
                                </div>

                                <a class="btn" href="<?php echo  str_replace('updater','updater/finalize',get_current_file_url()) ?>">Home</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script>
    $(document).ready(function ($) {
        "use strict";

        /**
         * update views file
         * @since 1.0.1
         * */
        $(document).on('click','.file_update_button',function (e){
            e.preventDefault();

            var el = $(this);
            var buttonWrap = $(this);
            var errorWrap = '';

            //validate database field
            if (validateDatabaseField()){
                el.text('in progress...');
                el.addClass('animate-flicker');
                $.ajax({
                    type: 'POST',
                    url: "<?php echo get_current_file_url().'/ajax.php'?>",
                    data:{
                        'action' : $(this).data('action')
                    },
                    errors: function (response){
                        console.log(response);
                    },
                    success: function (data){
                        buttonWrap.removeClass('animate-flicker');
                        buttonWrap.text('Update');
                        var errorWrap = $('.appendable-message-box');
                        var jsonData = JSON.parse(data);

                        if (jsonData.type === 'success'){
                            buttonWrap.addClass('success');
                            buttonWrap.text('Update Successful');
                            buttonWrap.attr('disabled',true);
                            errorWrap.append('<div class="alert alert-'+jsonData.type+'">'+jsonData.msg+'</div>');
                        }else{
                            errorWrap.append('<div class="alert alert-'+jsonData.type+'">'+jsonData.msg+'</div>');
                        }
                    }
                });
            }
        });




        /**
        *  validate database fields
        * */
        function validateDatabaseField(){
            var allField = [
                'input[name="database_host"]',
                'input[name="database_username"]',
                'input[name="database_name"]',
            ];
            var returnVal = true;
            allField.forEach(function (value,index){
                if ($(value).val() == ''){
                    $(value).addClass('has-error');
                    returnVal = false;
                }else{
                    $(value).removeClass('has-error');
                }
            });

            return returnVal;
        }


    })
</script>
</body>
</html>