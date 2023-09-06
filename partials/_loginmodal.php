<!-- Modal-->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bolder text-dark" id="loginModalLabel">Welcome to PHP Forum - Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form class="form" action="../../../scoopsol/php-forum/api/_login.php" method="POST">
                <div class="modal-body">
                    <!--begin::Form group-->
                    <div class="form-group">
                        <label class="font-weight-bolder text-dark">Email</label>
                        <input class="form-control form-control-solid" type="text" name="username" autocomplete="off" placeholder="Email" required>
                    </div>
                    <!--end::Form group-->
                    <!--begin::Form group-->
                    <div class="form-group">
                        <div class="d-flex justify-content-between mt-n5">
                            <label class="font-weight-bolder text-dark pt-5">Password</label>
                        </div>
                        <input class="form-control form-control-solid" type="password" name="password" autocomplete="off" placeholder="Password" required>
                    </div>
                    <!--end::Form group-->
                    <!--begin::Form group-->
                    <div class="form-group d-none">
                        <input class="form-control form-control-solid" type="text" name="filename" value="<?php echo $filename ?>">
                    </div>
                    <!--end::Form group-->
                    <!--begin::Form group-->
                    <div class="form-group d-none">
                        <input class="form-control form-control-solid" type="text" name="id" value="<?php echo $pathQuery ?>">
                    </div>
                    <!--end::Form group-->
                    <!--begin::Form group-->
                    <div class="form-group d-none">
                        <input class="form-control form-control-solid" type="text" name="url" value="<?php echo $_SERVER['REQUEST_URI'] ?>">
                    </div>
                    <!--end::Form group-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-success font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success font-weight-bolder">Sign In</button>
                </div>
            </form>
        </div>
    </div>
</div>