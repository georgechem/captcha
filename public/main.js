(()=>{"use strict";function t(){fetch("./../src/php/captcha.php",{}).then((function(t){return t.blob()})).then((function(t){console.log(t);var e=document.getElementById("protect"),c=URL.createObjectURL(t);e.src=c}))}t(),document.getElementById("btn").addEventListener("click",t)})();
//# sourceMappingURL=main.js.map