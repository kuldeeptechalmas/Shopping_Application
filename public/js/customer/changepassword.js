// old password 
    function oldpasswordshow() {
        $("#oldpasswordhidden").removeAttr("hidden");
        $("#oldpasswordshow").attr("hidden", true);
        document.getElementById('oldpassword').type = 'text';
    }

    function oldpasswordhidden() {
        $("#oldpasswordshow").removeAttr("hidden");
        $("#oldpasswordhidden").attr('hidden', true);
        document.getElementById('oldpassword').type = 'password';
    }

    // new password 
    function newpasswordshow() {
        $("#newpasswordhidden").removeAttr("hidden");
        $("#newpasswordshow").attr("hidden", true);
        document.getElementById('newpassword').type = 'text';
    }

    function newpasswordhidden() {
        $("#newpasswordshow").removeAttr("hidden");
        $("#newpasswordhidden").attr('hidden', true);
        document.getElementById('newpassword').type = 'password';
    }
    // conf password 
    function confpasswordshow() {
        $("#confpasswordhidden").removeAttr("hidden");
        $("#confpasswordshow").attr("hidden", true);
        document.getElementById('confpassword').type = 'text';
    }

    function confpasswordhidden() {
        $("#confpasswordshow").removeAttr("hidden");
        $("#confpasswordhidden").attr('hidden', true);
        document.getElementById('confpassword').type = 'password';
    }