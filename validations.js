function validate()
{
    var password = document.getElementById("pass1").value;
    var confpass = document.getElementById("pass2").value;
    var user_name = document.getElementById("user-name").value;

    // Validates if the password matches this regular expression
    var regex_pass = /^[A-z]+[a-z]+[@$_#]+[0-9]+$/;

    // Validates if the username matches this regular expression
    var regex_un = /^[_0-9]*[a-z]+[_]*[0-9]+[_a-z]*/;

    if (password.length < 7) 
    {
        alert("Password too small");
        document.getElementById("valid").value = "false";
    }
    else if(password !== confpass)
    {
        alert("Password doesn't match");
        document.getElementById("valid").value = "false";
    }
    else if(!regex_pass.test(password))
    {
        alert('Password is not strong');
        document.getElementById("valid").value = "false";
    }
    else if(!regex_un.test(user_name))
    {
        alert('Invalid username');
        document.getElementById("valid").value = "false";
    }
    else
    {
        document.getElementById("valid").value = "true";
    }

}