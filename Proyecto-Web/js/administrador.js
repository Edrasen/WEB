
/**
 * Description
 * @authors Daivd Lopez Hernandez
 * @date    2019-09-02 13:54:38
 * @version 1.0.0
 */
// Or with jQuery

$(document).ready(function () {
    $('.dropdown-button').dropdown({
        inDuration: 300,
        outDuration: 225,
        belowOrigin: true, // Displays dropdown below the button
        alignment: 'right' // Displays dropdown with edge aligned to the left of button
    });
    $('select').formSelect();
    $('.sidenav').sidenav();
    $('.tabs').tabs();
    $('.modal').modal();
    $('#Categoria').dataTable({
        "language": {
            "lengthMenu": "",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrada de _MAX_ registros)",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron registros coincidentes",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });
    $('#Postal').dataTable({
        "language": {
            "lengthMenu": "",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrada de _MAX_ registros)",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron registros coincidentes",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });
    $('#Usuario').dataTable({
        "language": {
            "lengthMenu": "",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrada de _MAX_ registros)",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron registros coincidentes",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        responsive: true

    });
    //AgregarCategoria
    $("#formAgregarC").validetta({
        bubblePosition: 'bottom',
        bubbleGapTop: 10,
        bubbleGapLeft: -5,
        onValid:
            $("#formAgregarC").submit(function (evt) {
                evt.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: 'inc/AgregarCategoria.php',
                    type: "POST",
                    data: $("#formAgregarC").serialize(),           // formData,
                    cache: false,
                    error: function () {
                        alert('Ha ocurrido un error');
                    },
                    success:
                        function (response) {
                            var resp = JSON.parse(response);
                            if (resp.success == "1") {
                                M.toast({ html: '<i class=\'green-text fas fa-check-circle\'><\i> <i class=\'white-text\'> Se ha creado la nueva categoría<\i> <div class= \'progress\'><div class=\'indeterminate\'></div></div> ', classes: 'rounded' });
                                setTimeout("location.href = 'Administrador.php#Categorias';", 100);
                            } else {
                                M.toast({ html: '<i class=\'red-text fas fa-check-circle\'><\i> <i class=\'white-text\'>' + resp.message + '<\i>', classes: 'rounded' });
                            }
                        }
                });
                // Para que no se recarge
                return false;
            })
    });


    //AgregarPOSTAL
    $("#formAgregaPos").validetta({
        bubblePosition: 'bottom',
        bubbleGapTop: 10,
        bubbleGapLeft: -5,
        onValid:
            $("#formAgregaPos").submit(function (evt) {
                evt.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: 'inc/AgregarPostal.php',
                    type: "POST",
                    data: formData,//$("#formAgregaPos").serialize(), 
                    cache: false,
                    contentType: false,
                    enctype: 'multipart/form-data',
                    processData: false,
                    error: function () {
                        alert('Ha ocurrido un error');
                    },
                    success:
                        function (response) {
                            var resp = JSON.parse(response);
                            if (resp.success == "1") {
                                M.toast({ html: '<i class=\'green-text fas fa-check-circle\'><\i> <i class=\'white-text\'> Se guardado la nueva postal<\i> <div class= \'progress\'><div class=\'indeterminate\'></div></div> ', classes: 'rounded' });
                                setTimeout("location.href = 'Administrador.php#Postales';", 100);
                            } else {
                                M.toast({ html: '<i class=\'red-text fas fa-check-circle\'><\i> <i class=\'white-text\'>' + resp.message + '<\i>', classes: 'rounded' });
                            }
                        }
                });
                // Para que no se recarge
                return false;
            })
    });

    //MODIFICAR CATEGORIA
    $("#formModificarC").validetta({
        bubblePosition: 'bottom',
        bubbleGapTop: 10,
        bubbleGapLeft: -5,
        onValid:
            $("#formModificarC").submit(function (evt) {
                evt.preventDefault();
                $.ajax({
                    url: 'inc/ModiCategoria.php',
                    type: "POST",
                    data: $("#formModificarC").serialize(),
                    cache: false,
                    error: function () {
                        alert('Ha ocurrido un error');
                    },
                    success:
                        function (response) {
                            var resp = JSON.parse(response);
                            if (resp.success == "1") {
                                M.toast({ 
                                    html: '<i class=\'green-text fas fa-check-circle\'><\i> <i class=\'white-text\'> Se ha modificado la categoría<\i> <div class= \'progress\'><div class=\'indeterminate\'></div></div> ',
                                     classes: 'rounded' 
                                });
                                setTimeout("location.href = 'Administrador.php#Categorias';", 100);
                            } else {
                                M.toast({ html: '<i class=\'red-text fas fa-check-circle\'><\i> <i class=\'white-text\'>' + resp.message + '<\i>', classes: 'rounded' });
                            }
                        }
                });
                // Para que no se recarge
                return false;
            })
    });

    $("#Pcategoria").load("inc/OpcCategoria.php");
    $("#Ecategoria").load("inc/OCategoria.php");


    //MODIFICAR POSTAL
    $("#formEditaPos").validetta({
        bubblePosition: 'bottom',
        bubbleGapTop: 10,
        bubbleGapLeft: -5,
        onValid:
            $("#formEditaPos").submit(function (evt) {
                evt.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: 'inc/ModificaPostal.php',
                    type: "POST",
                    data: formData,//$("#formEditaPos").serialize(), //
                    cache: false,
                    contentType: false,
                    enctype: 'multipart/form-data',
                    processData: false,
                    error: function () {
                        alert('Ha ocurrido un error');
                    },
                    success:
                        function (response) {
                            var resp = JSON.parse(response);
                            if (resp.success == "1") {
                                M.toast({ html: '<i class=\'green-text fas fa-check-circle\'><\i> <i class=\'white-text\'> Se ha modificado la postal <\i> <div class= \'progress\'><div class=\'indeterminate\'></div></div> ', classes: 'rounded' });
                                setTimeout("location.href = 'Administrador.php#Postales';", 100);
                            } else {
                                M.toast({ html: '<i class=\'red-text fas fa-check-circle\'><\i> <i class=\'white-text\'>' + resp.message + '<\i>', classes: 'rounded' });
                            }
                        }
                });
                // Para que no se recarge
                return false;
            })
    });



    $("#formModificarUser").validetta({
        bubblePosition: 'bottom',
        bubbleGapTop: 10,
        bubbleGapLeft: -5,
        onValid:
            $("#formModificarUser").submit(function (evt) {
                evt.preventDefault();
                $.ajax({
                    url: 'inc/ModificaUser.php',
                    type: "POST",
                    data: $("#formModificarUser").serialize(),
                    cache: false,
                    error: function () {
                        alert('Ha ocurrido un error');
                    },
                    success:
                        function (response) {
                            alert(response);
                            var resp = JSON.parse(response);
                            if (resp.success == "1") {
                                M.toast({ html: '<i class=\'green-text fas fa-check-circle\'><\i> <i class=\'white-text\'> Usuario modificado exitosamente<\i> <div class= \'progress\'><div class=\'indeterminate\'></div></div> ', classes: 'rounded' });
                                setTimeout("location.href = 'Administrador.php';", 100);
                            } else {
                                M.toast({ html: '<i class=\'red-text fas fa-check-circle\'><\i> <i class=\'white-text\'>' + resp.message + '<\i>', classes: 'rounded' });
                            }
                        }
                });
                // Para que no se recarge
                return false;
            })
    });


});


//Obtener datos para mostrar en modificar categoria
function editarReg(idReg, nomReg) {
    $("#editaC").val(nomReg);
    $("#idCate").val(idReg);
    $("#modalModificarC").validetta({
        bubblePosition: 'bottom',
        bubbleGapTop: 10,
        bubbleGapLeft: -5
    });
}

function editarPos(idReg, desc, cate) {
    $("#idEP").val(idReg);
    $("#Edesc").val(desc);
    $("#Ecategoria").val(cate);
    $("#modalEditaPos").validetta({
        bubblePosition: 'bottom',
        bubbleGapTop: 10,
        bubbleGapLeft: -5
    });
}

function editarUsuario(idReg, nomReg, email,estatus , privi) {
    alert(estatus+" "+privi);
    $("#idU").val(idReg);
    $("#nombreUser").val(nomReg);
    $("#emailU").val(email);s
    $("#priviU").val(privi);
    $("#estaU").val(estatus);
    $("#modalModificarUser").validetta({
        bubblePosition: 'bottom',
        bubbleGapTop: 10,
        bubbleGapLeft: -5
    });
}
