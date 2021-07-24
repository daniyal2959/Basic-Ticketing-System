document.querySelector('input[type=color]').addEventListener('input', (e)=>{
    document.querySelector('#colorChoosed').style.background = e.target.value;
})
