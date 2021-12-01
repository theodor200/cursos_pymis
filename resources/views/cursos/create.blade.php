@extends('layouts.app-access')
@section('content')
    @inject('GetDepartamento','App\Services\GetUbicacion')
    @inject('GetCategoria','App\Services\GetCategoriaCurso')
<div class="container">
    <div class="row mt-5">
        <div class="col">
            <h1 class="text-uppercase">Registro de curso</h1>
            <hr class="my-4">
            <p class="font-weight-normal mt-2 mb-2">Rellene el formulario para registrar los datos de un curso.</p>
        </div>
    </div>
    <hr class="my-4">
    <div class="row mt-0">
        <div class="col">
            <form action="{{url('/cursos')}}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>

                {{csrf_field()}}

                <h5 class=" text-uppercase ">Información general:</h5>

                <div class="form-row">

                    <div class="col-md-4 mb-1">
                        <label for="validationCustom01"><br>Categoría del curso:</label>
                        <select class="form-control" name="id_categoria" id="id_categoria" required>
                            @foreach($GetCategoria->getCategoria(false) as $index=>$categoria)
                                <option value="{{ $index }}">{{ $categoria }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Seleccione una categoría</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>

                    <div class="col-md-4 mb-1">
                        <label for="validationCustom02"><br>Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" style="text-transform: uppercase" onkeyup="this.value.toUpperCase();" required >
                        <div class="invalid-feedback"> Ingrese un nombre para el curso.</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>

                    <div class="col-md-4 mb-1">
                        <label for="validationCustom01"><br>Costo: S/.</label>
                        <input type="text" class="form-control" id="costo"  name="costo" pattern="[0-9.]*" required>
                        <div class="invalid-feedback"> Ingrese un monto en soles valido ejemplo S/ 100.00</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>

                    <div class="col-md-3 mb-1">
                        <label for="validationCustom01"><br>Promedio mínimo para aprobar el curso:</label>
                        <input type="number" min="10" class="form-control" id="promedio_minimo" name="promedio_minimo" value="16" required>
                        <div class="invalid-feedback"> Ingrese el promedio mínimo.</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>                   

                </div>
                <hr class="my-4">
                <h5 class=" text-uppercase ">Logitipo para certificado:</h5>
                <p><b>Aviso:</b> 
                    <br>
                    Si no elije una imagen, se mostrará el logotipo de Pymis por defecto al expedir los certificados de este curso.<br> 
                    Evite tener espacios en blanco alrededor de su logotipo.<br>
                    Se recomienda que la imagen tengo 250 pixeles de ancho por 80 pixeles de alto.</p>
                <div class="form-row">
                    <div class="col-md-3 mb-1">
                        <label for="validationCustom01"><br></label>
                        <input type="file" id="logotipo" name="logotipo" accept="image/*" onchange="validarFile(this);">                        
                        <div class="invalid-feedback"> Ingrese la ubicación del logotipo del curso.</div>
                        <div class="valid-feedback">Correcto.</div> 
                    </div>
                </div>
                
                <hr class="my-4">
                <h5 class=" text-uppercase ">Ubicación:</h5>
                <div class="form-row">

                    <div class="col-md-4 mb-1">
                        <label for="validationCustom01"><br>Departamento:</label>
                        <select class="form-control" name="id_departamento" id="departamento" required>
                            @foreach($GetDepartamento->getDepartamento() as $index=>$deparmanto)
                                <option value="{{ $index }}">{{ $deparmanto }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Seleccione un departamento</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>
                    <div class="col-md-4 mb-1">
                        <label for="validationCustom01"><br>Provincia:</label>
                        <select class="form-control" name="id_provincia" id="provincia" required>
                            <option value="">Seleccione una provincia</option>
                        </select>
                        <div class="invalid-feedback">Seleccione una provincia</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>
                    <div class="col-md-4 mb-1">
                        <label for="validationCustom01"><br>Distrito:</label>
                        <select class="form-control" name="id_distrito" id="distrito" required>
                            <option value="">Seleccione un distrito</option>
                        </select>
                        <div class="invalid-feedback">Seleccione un distrito</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>

                    <div class="col-md-6 mb-1">
                        <label for="validationCustom01"><br>Dirección:</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" style="text-transform: uppercase" onkeyup="this.value.toUpperCase();" required>
                        <div class="invalid-feedback"> Ingrese una dirección valida.</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>
                </div>
                <hr class="my-4">
                <h5 class=" text-uppercase ">Fecha:</h5>
                    <div id="event_period" class="row">
                        <div class="col-6">
                            <label for="validationCustom01"><br>Fecha de inicio del curso:</label>
                            <input type="text" class="actual_range form-control" name="fecha_inicio" required>
                            <div class="invalid-feedback"> Ingrese una fecha de inicio.</div>
                            <div class="valid-feedback">Correcto.</div>
                        </div>
                        <div class="col-6">
                            <label for="validationCustom01"><br>Fecha de fin del curso:</label>
                            <input type="text" class="actual_range form-control" name="fecha_fin" required>
                            <div class="invalid-feedback"> Ingrese una fecha de fin.</div>
                            <div class="valid-feedback">Correcto.</div>
                        </div>

                        <div class="col-md-3 mb-1">
                            <label for="validationCustom01"><br>Horas de dictado:</label>
                            <input type="number" min="1" class="form-control" id="hora" name="hora" required>
                            <div class="invalid-feedback"> Ingrese la cantidad de horas a dictar, como mínimo 1 hora.</div>
                            <div class="valid-feedback">Correcto.</div>
                        </div>
                    </div>

                <hr class="my-4">
                <h5 class=" text-uppercase ">Estado del curso:</h5>
                <p class="font-weight-normal mt-4 mb-2">Los alumnos podrán inscribirse al curso si está activo.</p>
                <div class="form-row">
                    <div class="col-md-4 mb-1">
                        <label for="validationCustom02"><br>Estado del curso</label>
                        <select class="form-control" id="estado" name="estado" style="text-transform: uppercase" onkeyup="this.value.toUpperCase();" required >
                            <option value="">Seleccionar</option>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                        <div class="invalid-feedback"> Seleccione un estado.</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>
                    <div class="col-md-3 mb-1">
                        <label for="validationCustom01"><br>Número de vacantes:</label>
                        <input type="text" class="form-control" id="vacantes" name="vacantes" pattern="[0-9]*" style="text-transform: uppercase" onkeyup="this.value.toUpperCase();" required>
                        <div class="invalid-feedback"> Ingrese un número de vacantes.</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>
                    <input type="hidden" id="cat_nombre" name="cat_nombre" readonly>
                </div>
                <button class="btn btn-secondary my-5" type="submit" id="crear_rango">Registrar curso</button>
            </form>
        </div>
    </div>
    <hr>
</div>
@endsection
@section('javascript-optional')
<script>
        function validarFile(all)
        {
            //EXTENSIONES Y TAMANO PERMITIDO.
            var extensiones_permitidas = [".png",".PNG", ".bmp",".BMP", ".jpg", ".JPG", ".jpeg",".JPEG", ".gif",".GIF"];
            var tamano = 2; // EXPRESADO EN MB.
            var rutayarchivo = all.value;
            var ultimo_punto = all.value.lastIndexOf(".");
            var extension = rutayarchivo.slice(ultimo_punto, rutayarchivo.length);
            if(extensiones_permitidas.indexOf(extension) == -1)
            {
                alert("Extensión de archivo no valida, solo puede elegir archivos del tipo imagen como, .png, .bmp, .jpg, .jpeg, .gif");
                document.getElementById(all.id).value = "";
                return;
            }
            if((all.files[0].size / 1048576) > tamano)
            {
                alert("El archivo no puede superar los "+tamano+"MB de peso.");
                document.getElementById(all.id).value = "";
                return;
            }
        }

    (function() {
        'use strict';      
            
        const url = location.protocol+'//'+location.hostname+'/'
        window.addEventListener('load', function() {
            $.ajaxSetup({
                headers:
                { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.lastElementChild.addEventListener('click',function(e){                        
                    form.classList.add('was-validated');
                    e.preventDefault();
                    //e.stopPropagation();
                    if (form.checkValidity() === true) {
                        const i = $("#id_categoria").val(), nom = $("#nombre").val(),
                            n=nom.replace(/ /g, "")
                        $("#cat_nombre").val(i+n)
                        let serialize=$(form).serialize()
                        console.log(serialize)
                        let serializeArray=$(form).serializeArray()
                        console.log(serializeArray)
                        let formImage=new FormData(form)
                        let data_imagen = $('#logotipo')[0].files[0];
                        formImage.append('logotipo',data_imagen)
                        
                       
                        $.ajax({                            
                            url: "{{url('/cursos')}}",                            
                            type: "POST",                            
                            data: formImage,                                
                            contentType : false,
                            cache: false,
                            processData:false,
                            beforeSend: function(response){
                                console.log()
                                $('#myModalMessage').modal('show');
                                $('.modal-body').html('Enviando datos ...');
                                
                            },
                            success: function(response){
                            },
                            complete:function(response){
                                if( response.responseText == ''){
                                    $('.modal-body').html('EL registro se guardó con éxito.');
                                    form.classList.remove('was-validated');
                                    form.classList.add('needs-validation');
                                    form.reset();
                                    window.location.replace(window.location.protocol+'//'+window.location.hostname+'/cursos');
                                }else{
                                    let mensaje=response.responseJSON.mensaje
                                    typeof mensaje=== 'undefined' ? mensaje=' ' : mensaje = mensaje + '<br>'
                                    $('.modal-body').html(
                                        mensaje
                                    );
                                }
                            }
                        });

                    }
                })
            });

            $.fn.datepicker.dates['es'] = {
                days: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
                daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
                months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                today: "Hoy",
                clear: "Borrar",
                format: "yyyy-mm-dd",
                titleFormat: "MM yyyy", 
                weekStart: 0
            };

            var currDate = new Date();

            $('#event_period').datepicker({
                language:'es',
                inputs: $('.actual_range'),
                startDate : currDate
            });


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

</script>
@endsection
