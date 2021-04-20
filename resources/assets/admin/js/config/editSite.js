var validate = {
    rules: {
    	icon: {maxSize: 100},
        icon_text: 'required',
    	logo: {maxSize: 1024},
        logo_text: 'required',
        name: {required: true, maxlength: 20},
        title: {required: true, maxlength: 80},
        keywords: {required: true, maxlength: 100},
        description: {required: true, maxlength: 200},
        icp: {required: true, maxlength: 50}
    },
    callback: location.href
};
$('#kt_content .form').validate(validate);