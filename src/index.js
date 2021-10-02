import {config} from './config';

/**
 method: 'POST',
 mode: 'same-origin',
 cache: 'no-cache',
 headers: {
        'Content-Type': 'application/json'
    }
 */

function loadCaptcha(){
    fetch(config.endPointPrefix + 'captcha.php', {

    })
        .then((res)=> res.blob())
        .then((blob)=>{
            console.log(blob);
            const img = document.getElementById('protect');
            const imgURL = URL.createObjectURL(blob);
            img.src = imgURL;
        });
}

loadCaptcha();

const btn = document.getElementById('btn');
btn.addEventListener('click', loadCaptcha);
