< script >
    document.getElementById('refresh').addEventListener('click', function() {
        var captchaImg = document.querySelector('.captcha img');
        captchaImg.src = captchaImg.src + '?' + Date.now();
    }); <
/script>