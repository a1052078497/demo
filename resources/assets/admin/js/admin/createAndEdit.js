var validate = {
    rules: {
        identity_id: 'required',
        username: {required: true, minlength: 4, maxlength: 20},
        password: {required: true, minlength: 6, maxlength: 15},
        password_confirmation: {equalTo: '#kt_content .password'}
    },
    callback: '/admin'
};
// 编辑状态密码可选
if ($('input[name=_method]').length) {
    delete validate.rules.password.required;
}
$('#kt_content .form').validate(validate);