document.querySelectorAll('#userTypes input[type=radio]').forEach(element=>{
    element.addEventListener('click', ()=>{
        if (element.getAttribute('data-department') == 'show'){
            document.querySelector('#departmentWasHidden').classList.remove('d-none');
        }
        else{
            document.querySelector('#departmentWasHidden').classList.add('d-none');
            document.querySelectorAll('#departmentWasHidden input[type=radio]').forEach(el=>{
               el.checked = false;
            });
        }
    });
});


document.querySelector('#makePassword').addEventListener('click', ()=>{
    let password = generatePassword(10);
    let passField = document.querySelector('#passwordField > div');
    passField.classList.remove('d-none');
    passField.querySelector('#password').value = password;
    passField.querySelector('#password').setAttribute('type', 'text');

});

function generatePassword(length) {
    let charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
        retVal = "";
    for (let i = 0, n = charset.length; i < length; ++i) {
        retVal += charset.charAt(Math.floor(Math.random() * n));
    }
    return retVal;
}
