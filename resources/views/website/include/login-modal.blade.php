<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true" style="background-color: rgba(0,0,0,0.4);">
    <div class="modal-dialog modal-dialog-centered" role="document" style=" width: 440px; margin: auto;">
        <div class="modal-content">
            <div class="modal-header">
                <img src="{{ asset('website/assets/images/logo.png') }}" width="111" height="44"  >
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-title text-center">
                     

                    <h5 class="modal-title" id=""><b>Welcome! Please Login to continue.</b></h5>
                </div>
                <div class="d-flex flex-column  ">
                    <form class="form-valide" id="subcategory-form" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="product_page" value="{{ $product->id }}" class="form-control">
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="Your email address...">
                            <div id="email_text" class="text-danger backend-error-text"></div>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" id="password"
                                placeholder="Your password...">
                            <div id="password_text" class="text-danger backend-error-text"></div>
                        </div>
                        <button type="submit" class="btn btn-info btn-block btn-round login-btn btn-sm"
                            onclick="loginUser()">Login</button>
                    </form>

                    <div class="login-bottom mt-3">
                       
                        <p>With your social media account</p>
                        <div class="social-icons">
                            <div class="button">
                                {{-- <a class="tw" href="#"> <i class="anc-tw"> </i> <span>Twitter</span> --}}
                                <div class="clear"> </div></a>
                                <a class="fa" href="{{ route('facebook-auth') }}"> <i class="anc-fa"> </i>
                                    <span>Facebook</span>
                                    <div class="clear"> </div>
                                </a>
                                <a class="go" href="{{ route('google-auth') }}"><i class="anc-go">
                                    </i><span>Google+</span>
                                    <div class="clear"> </div>
                                </a>
                                <div class="clear"> </div>
                            </div>
                             
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <div class="signup-section">Not a member yet? <a href="{{ url('register/' . $product->id) }}"
                        class="text-info">
                        Sign Up</a>.</div>
            </div>
        </div>
    </div>
</div>
