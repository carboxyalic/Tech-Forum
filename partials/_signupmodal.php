<!-- Modal-->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title font-weight-bolder text-dark" id="signupModalLabel">Signup</h5>
                    <p class="text-muted font-weight-bold m-0"><small>Enter your details to create your account</small></p>
                </div>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form class="form" action="../../../scoopsol/php-forum/api/_signup.php" method="POST">
                <div class="modal-body p-10">
                    <!--begin::Form group-->
                    <div class="form-group">
                        <label class="font-weight-bolder text-dark">Full Name</label>
                        <input class="form-control form-control-solid" type="text" placeholder="Fullname" name="fullname" autocomplete="off" required>
                    </div>
                    <!--end::Form group-->
                    <!--begin::Form group-->
                    <div class="form-group">
                        <label class="font-weight-bolder text-dark">Email</label>
                        <input class="form-control form-control-solid" type="email" placeholder="Email" name="email" autocomplete="off" required>
                    </div>
                    <!--end::Form group-->
                    <!--begin::Form group-->
                    <div class="form-group">
                        <label class="font-weight-bolder text-dark">Password</label>
                        <input class="form-control form-control-solid" type="password" placeholder="Password" name="password" autocomplete="off" required>
                    </div>
                    <!--end::Form group-->
                    <!--begin::Form group-->
                    <div class="form-group">
                        <label class="font-weight-bolder text-dark">Confirm Password</label>
                        <input class="form-control form-control-solid" type="password" placeholder="Confirm password" name="cpassword" autocomplete="off" required>
                    </div>
                    <!--end::Form group-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-success font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success font-weight-bold">Signup</button>
                </div>
            </form>
        </div>
    </div>
</div>