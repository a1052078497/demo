$('.form').validate({
    rules: {
        username: 'required',
        password: 'required',
    },
    errorClass: 'text-left pl-4 help-block',
    callback: function (result) {
    	var callback = $.getUrlParam('back');
    	location.href = callback ? callback : result.data.callback;
    }
});