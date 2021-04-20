$('#kt_content .form').validate({
    rules: {
        old_password: 'required',
        new_password: {required: true, minlength: 6, maxlength: 15},
        password_confirmation: {equalTo: '#kt_content .password'}
    },
    callback: location.href
});