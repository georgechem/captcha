import {config} from './config';

function loadCaptcha(){
    fetch(config.endPointPrefix + 'captcha.php', {

    })
        .then((res)=> res.blob())
        .then((blob)=>{
            const img = document.getElementById('protect');
            const imgURL = URL.createObjectURL(blob);
            img.src = imgURL;
        })
        .catch((err)=>{
           console.log(err);
        });

}

function verifyCaptcha(event){
    event.preventDefault();
    const form = new FormData(captchaForm);
    const data = 'captcha=' + form.get('captcha');
    fetch(config.endPointPrefix + 'verifyCaptcha.php',{
        method: 'POST',
        mode: 'same-origin',
        cache: 'no-cache',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: data
    })
        .then((res)=>res.json())
        .then((res)=>{
            console.log(res);
        })
        .catch((err)=>{
            console.log(err);
        });
}

const btn = document.getElementById('btn');
const captchaForm = document.getElementById('captchaForm');
loadCaptcha();

btn.addEventListener('click', loadCaptcha);
captchaForm.addEventListener('submit', verifyCaptcha)

