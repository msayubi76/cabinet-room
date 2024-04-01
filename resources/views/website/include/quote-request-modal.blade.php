 <!--Request Quote Modal -->
 <div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document" style=" width: 550px; margin: auto;">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLongTitle"><b>Request a Quote.</b></h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form class="form-valide" id="request-quote-form" method="post" enctype="multipart/form-data">
                 <div class="modal-body">
                     <div class="form-title text-center"> </div>
                     <div class="d-flex flex-column  ">

                         @csrf
                         <input type="hidden" id="user_id" name="user_id"
                             value="{{ Auth::user() ? Auth::user()->id : '' }}">
                         <input type="hidden" id="product_id" name="product_id"  >
                         <div class="row">
                             <div class="col-md-6">
                                 <input type="email" id="user_email" name="email" class="form-control"
                                     id="email"placeholder="Your email address..." required>
                                 <div id="user_email_text" class="text-danger backend-error-text"></div>

                             </div>
                             <div class="col-md-6">
                                 <input type="name" id="name" name="name" class="form-control"
                                     id="name"placeholder="Your name..." required>
                                 <div id="name_text" class="text-danger backend-error-text"></div>

                             </div>

                         </div>
                         <div class="row">
                             <div class="col-md-6">
                                 <input type="address" id="address" name="address" class="form-control" id="address"
                                     placeholder="Your address..." required>
                                 <div id="address_text" class="text-danger backend-error-text"></div>

                             </div>
                             <div class="col-md-6">
                                 <input type="phone" id="phone" name="phone" class="form-control" id="phone"
                                     placeholder="Your phone..." required>
                                 <div id="phone_text" class="text-danger backend-error-text"></div>

                             </div>

                         </div>
                         <div class="">
                             <textarea name="discription" id="discription" placeholder="Your description..." class="form-control" cols="30"
                                 rows="6" required></textarea>
                             <div id="discription_text" class="text-danger backend-error-text"></div>

                         </div>



                     </div>
                 </div>

                 <div class="modal-footer d-flex justify-content-center">
                     <button type="button" onclick="requestQuote()"
                         class="btn btn-info btn-sm btn-round add-quote btn-sm">Request Quote</button>

                 </div>
             </form>

         </div>
     </div>
 </div>
  
