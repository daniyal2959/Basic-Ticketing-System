let password = $('input[name=password]');
let mediumPassword = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");
let strongPassword = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");

password.on('keypress', function (){
    let passValue = password.val();
    let strength = $('#strength');
    if (strongPassword.test(passValue)){
        strength.removeClass('mediumPass');
        strength.removeClass('weakPass');
        strength.addClass('strongPass');

        strength.text('Strong');
    }
    else if (mediumPassword.test(passValue)){
        strength.removeClass('strongPass');
        strength.removeClass('weakPass');
        strength.addClass('mediumPass');

        strength.text('Medium');
    }
    else {
        strength.removeClass('mediumPass');
        strength.removeClass('strongPass');
        strength.addClass('weakPass');

        strength.text('Weak');
    }
})



