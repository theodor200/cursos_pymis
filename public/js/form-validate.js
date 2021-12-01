(function() {
    'use strict';
    window.addEventListener('load', function() {

        let forms = document.getElementsByClassName('needs-validation');
        const _url = window.location.protocol+'//'+window.location.hostname
        let validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }else{

                    event.preventDefault();
                    let route = $("#route").val()
                    let redirect=$("#redirect").val()
                    $.ajax({
                        data: $(form).serialize(),
                        url: route,
                        type: "POST",
                        dataType: 'json',
                        processData : 'false',
                        success: function (data) {
                            console.log('Success:' + data.status)
                        },
                        error: function (data) {
                            console.log('Error:' + data.status)
                            console.log(data)
                            $("#alert_server").fadeIn(1000)
                            $("#alert_server").removeAttr('hidden')

                            if(data.status == 403){
                                $("#alert_server p").text('Redireccionando ...')
                                window.location=redirect
                            }
                            if(typeof(data.responseJSON) !== 'undefined'){
                                    if(typeof(data.responseJSON.errors) !== 'undefined'){
                                        if(typeof(data.responseJSON.errors.Domain) !== 'undefined'){
                                            $("#alert_server p").text(data.responseJSON.errors.Domain)
                                        }
                                        if(typeof(data.responseJSON.errors.email) !== 'undefined'){
                                            $("#alert_server p").text(data.responseJSON.errors.email)
                                        }
                                        if(typeof(data.responseJSON.errors.password) !== 'undefined'){
                                            $("#alert_server p").text(data.responseJSON.errors.password)
                                        }
                                    }
                            }
                        },
                        complete: function(data){
                            console.log('Complete:' + data.status)
                            $("#alert_server").fadeIn(1000)
                            $("#alert_server").removeAttr('hidden')
                            if(data.status == 200) {
                                window.location.replace(redirect)
                                $("#alert_server p").text('Redireccionando ...')
                            }
                        },
                    })
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
