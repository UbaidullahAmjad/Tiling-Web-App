                <div class="card">
                    <div class="card-body">
                        <div class="row" >
                            <div class="col-md-3 gues_reg_login">
                                <div class="row" style="padding: 12px;">
                                    <h5>CONTINUE AS A GUEST</h5>
                                    <p>Here you can continue shopping without registering.</p>
                                    <button id="continue__button_guest" class="btn btn-primary  btn-sm"
                                        type="button"><span class="hidden-xs-down">{{ __('Continue') }}</span><i
                                            class="icon-arrow-right"></i></button>
                                </div>
                            </div>
                            <div class="col-md-3 gues_reg_login">
                                <div class="row" style="padding: 12px;">
                                    <h5>TO REGISTER</h5>
                                    <button id="join_now_button" class="btn btn-primary  btn-sm"
                                        type="button"><span class="hidden-xs-down">{{ __('Join Now') }}</span><i
                                            class="icon-arrow-right"></i></button>
                                    <h6 class="mt-2">MY ADVANTAGES</h6>
                                    <span><i class="fa fa-check"></i> Fast shopping</span> <br>
                                    <span><i class="fa fa-check"></i> Save user data and settings</span><br>
                                    <span><i class="fa fa-check"></i> Manage your watch list</span>
                                </div>
                            </div>
                            <div class="col-md-5 gues_reg_login">
                                <div class="row" style="padding: 12px;">
                                    <h5>I AM ALREADY A CUSTOMER</h5>
                                    <form method="post">
                                        @csrf
                                        <p style="color:red;">* Required Fields</p>
                                        <input type="email" id="login-checkout-email" name="login_email" class="form-control" placeholder="Your Email *"> 
                                        <p style="display:none;color:red;" id="log_email">Email is required</p>
                                        <input type="password" id="login-checkout-password" name="login_password" class="form-control mt-2" placeholder="Your Password *">
                                        <!-- <button class="btn btn-primary  btn-sm mt-2" id="" type="button">Login</button> -->
                                        <p style="display:none;color:red;" id="log_password">Password is required</p>
                                        <button id="login-checkout-button" class="btn btn-primary  btn-sm mt-2" type="button"><span class="hidden-xs-down">Login</span><i class="icon-arrow-right"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>