<?php
    
?>

<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#signup_modal">Sign Up</button>

<div id="signup_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Sign up Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Sign Up</h4>
            </div>
            <div class="modal-body">
                <form role="form"  action="resource/signup.php" method="post">
                    <div class="form-group">
                        <input type="text" name="fullname" class="form-control" placeholder="Full Name" required="required" />
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="email. your@example.com" required />
                    </div>
                    <div class="form-group">
                        <input type="text" name="compname" class="form-control" placeholder="Company Name" required />
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" required />
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block btn-sm">Sign Up</button>
                    </div>
                </form>
            </div>
            
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-primary btn-block btn-sm">Sign Up</button>-->
                <p>Register you business today</p>
            </div>
        </div>
    </div>
</div>

