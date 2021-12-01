(function() {
    'use strict';
    const url = location.protocol+'//'+location.hostname+'/'
    window.addEventListener('load', function() {

        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.lastElementChild.addEventListener('click',function(e){
                form.classList.add('was-validated');
                e.preventDefault();
                //e.stopPropagation();
                if (form.checkValidity() === true) {
                    const patch = document.getElementsByName('_method')[0].value
                    if(patch == 'POST'){
                        const _redirect = '/empresas'
                        _ajax(url+'empresas',patch,form,'EL registro se guardó con éxito.',_redirect)

                    }else if(patch == 'PATCH'){
                        const _id = document.getElementsByName('_id')[0].value, _redirect = '/empresas/'+_id+'/edit'
                        _ajax(url+'empresas/'+_id,patch,form,'EL registro se actualizo con éxito.',_redirect)
                    }
                }
            })
        });
        function cl(param){
            console.log(param);
        }

        document.querySelectorAll('.delete').forEach(a => {
                a.addEventListener('click',(ev)=>{
                    ev.preventDefault()
                    const _url = ev.target.parentNode.getAttribute('href')


                    _ajax(_url,'DELETE',null,'EL registro se eliminado con éxito.')
                })
            })


        function _ajax(action_url,type,form,mensaje,redirect){
            let data=''
            if(type == 'DELETE'){
                data = {'_method':type}
            }else{
                data =$(form).serialize()
            }

            $.ajax({
                url: action_url,
                type: type,
                headers: {'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
                data: data,
                dataType: 'json',
                cache: false,
                processData:false,
                beforeSend: function(response){
                    $('#myModalMessage').modal('show');
                    $('.modal-body').html('Enviando datos ...');
                },
                success: function(response){
                },
                complete:function(response){
                    console.log(response)
                    if( response.responseText == ''){
                        $('.modal-body').html(mensaje);
                        form.classList.remove('was-validated');
                        form.classList.add('needs-validation');
                        form.reset();
                        window.location.replace(window.location.protocol+'//'+window.location.hostname+redirect);
                    }else{
                        let correo= response.responseJSON.errors.correo,
                            razon_social=response.responseJSON.errors.razon_social,
                            dominio=response.responseJSON.errors.dominio;
                        typeof correo === 'undefined' ? correo=' ' : correo = correo + '<br>'
                        typeof razon_social === 'undefined' ? razon_social=' ' : razon_social = razon_social + '<br>'
                        typeof dominio === 'undefined' ? dominio=' ' : dominio = dominio + '<br>'
                        $('.modal-body').html(
                            correo + razon_social + dominio
                        );
                    }
                }
            });
        }

        $("#departamento").on('change',(e)=>{
            const id = e.target.value
            $.get(url+'provincias/'+id,(e)=>{
                $("#provincia").empty();
                $("#provincia").append("<option value=''>Seleccione una provincia</option>")
                $.each(e, (index, value)=>{
                    $("#provincia").append("<option value='"+index+"'>"+value+"</option>")
                })
            })
        })

        $("#provincia").on('change',(e)=>{
            const id = e.target.value
            $.get(url+'distritos/'+id,(e)=>{
                $("#distrito").empty();
                $("#distrito").append("<option value=''>Seleccione un distrito</option>")
                $.each(e, (index, value)=>{
                    $("#distrito").append("<option value='"+index+"'>"+value+"</option>")
                })
            })
        })
    }, false);
})();
