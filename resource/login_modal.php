<?php

?>

<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#login_modal">Login</button>

<div id="login_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Sign up Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Login</h4>
            </div>
            <div class="modal-body">
                <form role="form"  action="resource/login.php" method="post">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="email" required />
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
                <p>Login</p>
            </div>
        </div>
    </div>
</div>

