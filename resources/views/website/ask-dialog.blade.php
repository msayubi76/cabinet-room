<div class="modal fade contactModal"   tabindex="-1" role="dialog" aria-labelledby="contactModal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"  >Contact us for any query.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid"> 
                    <div class="row">
                        <div class="col-md-12 ">
                            <h4 class="text-uppercase">Head Office Japan</h4>
                            <p>{{ $generalSetting->head_office_address }}</p>
                            <hr>
                        </div>
                        <div class="col-md-12 ">
                            <h4 class="text-uppercase">Branch Office Pakistan</h4> 
                            <p>{{ $generalSetting->branch_address }}</p>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <h4 class="text-uppercase">Contact Detail</h4>
                            
                            <p><b>Mobile No Pakistan: </b>{{ $generalSetting->mobile_2 }}</p>
                            <p><b>Mobile No Japan: </b>{{ $generalSetting->mobile_1 }}</p>
                            <p><b>Tel: </b>{{ $generalSetting->tel_1 }}</p>
                            <p><b>Fax: </b>{{ $generalSetting->fax_1 }}</p>
                            <hr>
                        </div>
                        <div class="col-md-12 ">
                            <h4 class="text-uppercase">E-Maiil</h4>
                            <p><b>Email 1: </b>{{ $generalSetting->email_1 }}</p>
                            <p><b>Email 2: </b>{{ $generalSetting->email_2 }}</p>
                            <p><b>Email 3: </b>{{ $generalSetting->email_3 }}</p>
                            <hr>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
