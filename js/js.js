$(document).ready(function () {

    //Show mess
    function message (text){
        $('.form-message').html('<div class="alert alert-danger" role="alert">' + text + '</div>')
    }

    //Del mess
    function messageDel (text){
        $('.form-message').html('')
    }

    //Check lang
    var isLat = function (str) {
        return /[a-z]/i.test(str);
    };

    //Check mail
    var isEmail = function (str) {
        return /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/.test(str)
    };

    //If error = 1, reg or inp fail
    var error = 0, pass = '', errorInp = 0;
    var loginReg, emailReg, passwordReg;
    var emailInp, passInp;

    //Check form input
    $('.form-input-email').blur(function () {
        $('.form-after').text('');
        var text = $(this).val();
        if(text == ''){
            $(this).after('<span class="form-after" style="font-size: 70%;">Поле должно быть заполнено!</span>');
            errorInp = 1;
        } else {
            errorInp = 0;
            emailInp = text;
        }
    });
    $('.form-input-pass').blur(function () {
        $('.form-after').text('');
        var text = $(this).val();
        if(text == ''){
            $(this).after('<span class="form-after" style="font-size: 70%;">Поле должно быть заполнено!<br></span>');
            errorInp = 1;
        } else {
            errorInp = 0;
            passInp = text;
        }
    });

    //Click Inp
    $('.form-btn-inp').on('click', function () {
        if (errorInp != 0){
            messageDel();
            message('Заполнены не все поля!')
        } else {
            $.ajax({
                type: "POST",
                dataType: 'text',
                url: "../core/handler/input.php",
                data: {"email":emailInp, "pass":passInp},
                success: function(data){
                    if (data){
                        if(data != 'bad'){
                            document.location.href='../lk/index.php?u=' + data;
                        } else {
                            messageDel();
                            message('Ошибка входа! Некорректные данные!')
                        }
                    }
                }
            });
        }
    });

    //Check form reg
    $('.form-reg-login').focus(function () {
        $(this).after('<span class="form-after" style="font-size: 70%;">Латинские буквы, цифры, от 5 до 15 символов</span>');
    }).blur(function () {
        $('.form-after').text('');
        messageDel();
        var text = $(this).val();
        if(text.length < 5 || text.length > 15) {
            message('Ошибка! Латинские буквы, цифры, от 5 до 15 символов');
            error = 1;
        } else if (!isLat(text)){
            message('Ошибка! Латинские буквы, цифры, от 5 до 15 символов');
            error = 1;
        } else {
            loginReg = text;
            error = 0;
        }
    });
    $('.form-reg-email').focus(function () {
        $(this).after('<span class="form-after" style="font-size: 70%;">Актуальная почта</span>');
    }).blur(function () {
        $('.form-after').text('');
        messageDel();
        var text = $(this).val();
        if(!isEmail(text)) {
            message('Не корректная почта!')
            error = 1;
        } else {
            emailReg = text;
            error = 0;
        }
    });
    $('.form-reg-pass1').focus(function () {
        $(this).after('<span class="form-after" style="font-size: 70%;">Латинские буквы, цифры, от 5 до 20 символов</span>');
    }).blur(function () {
        $('.form-after').text('');
        messageDel();
        var text = $(this).val();
        if(text.length < 5 || text.length > 20) {
            message('Ошибка! Латинские буквы, цифры, от 5 до 20 символов');
            error = 1;
        } else if (!isLat(text)){
            message('Ошибка! Латинские буквы, цифры, от 5 до 20 символов');
            error = 1;
        } else {
            passwordReg = text;
            pass = text;
            error = 0;
        }
    });
    $('.form-reg-pass2').focus(function () {
        $(this).after('<span class="form-after" style="font-size: 70%;">Повторите пароль</span>');
    }).blur(function () {
        $('.form-after').text('');
        messageDel();
        var text = $(this).val();
        if (text != pass){
            message('Ошибка! Пароли не совпадают!');
            error = 1;
        } else {
            error = 0;
        }
    });

    //Click reg
    $('.form-btn-reg').on('click', function () {
        if (error != 0){
            messageDel();
            message('Допущены ошибки!')
        } else if (!$('.form-reg-login').val() && !$('.form-reg-email').val() && !$('.form-reg-pass1').val() && !$('.form-reg-pass2').val()){
            messageDel();
            message('Не все поля заполнены!')
        } else {
            var userIp = $('.ip-user').text();
            var userAgent = $('.user-agent').text();
            $.ajax({
                type: "POST",
                dataType: 'text',
                url: "../core/handler/reg.php",
                data: {"login":loginReg, "email":emailReg, "pass":passwordReg, "userIp":userIp, "userAgent":userAgent},
                success: function(data){
                    if (data == 'success'){
                        document.location.href='../lk/index.php?u=' + loginReg;
                    } else {
                        messageDel();
                        message(data)
                    }
                }
            });
        }
    })
});