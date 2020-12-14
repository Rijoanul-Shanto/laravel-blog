@extends('layouts.app')

@section('content')
    <div class="container-fluid body-color">
        <div style="height: 94vh">
            <div class="signup-form">
                <form action="/examples/actions/confirmation.php" method="post">
                    <h2>Register</h2>
                    <p class="hint-text">Create your account. It's free and only takes a minute.</p>
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required="required">  	
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required="required">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="required">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="confirm-password" name="confirm_password" placeholder="Confirm Password" required="required">
                    </div>        
                    <div class="form-group">
                        <label class="form-check-label"><input type="checkbox" required="required"> I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg btn-block">Register Now</button>
                    </div>
                </form>
                <div class="text-center">Already have an account? <a href="#">Sign in</a></div>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
<script type="text/javascript">
    $('#confirm-password').keyup(function () {
            let value = this.value;
            console.log('ami pass', value);
            let pass = $("#password").val();
            if (value === pass && pass.length > 0) {
                $("#confirm-password").addClass("custom-valid");
                $("#password").addClass("custom-valid");
                $("#confirm-password").removeClass("custom-invalid");
                $("#password").removeClass("custom-invalid");
            } else {
                $("#confirm-password").addClass("custom-invalid");
                $("#password").addClass("custom-invalid");
                $("#confirm-password").removeClass("custom-valid");
                $("#password").removeClass("custom-valid");
            }
        });
        $('#name').keyup(function () {
            let value = this.value;
            console.log('ami naame', value);
            if (value.length > 0) {
                $("#name").addClass("custom-valid");
                $("#name").removeClass("custom-invalid");
            } else {
                $("#name").addClass("custom-invalid");
                $("#name").removeClass("custom-valid");
            }
        });
        $('#email').keyup(function () {
            let value = this.value;
            if (value.length > 0 && IsEmail(value)) {
                $("#email").addClass("custom-valid");
                $("#email").removeClass("custom-invalid");
            } else {
                $("#email").addClass("custom-invalid");
                $("#email").removeClass("custom-valid");
            }
        });

        function IsEmail(email) {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(email)) {
                return false;
            } else {
                return true;
            }
        }
</script>
@endsection