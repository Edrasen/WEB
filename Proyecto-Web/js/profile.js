

/**
 * Description
 * @authors Daivd Lopez Hernandez
 * @date    2019-09-02 13:54:38
 * @version 1.0.0
 */
// Or with jQuery

$(document).ready(function () {
    $('#FechaNac').datepicker({
        selectYears: 5,
        format: 'yyyy/mm/dd',
        showClearBtn:true,
        changeMonth: true,
        autoClose:true,
        minDate: new Date(1919, 0, 1),
        maxDate: new Date(),
        container:'#modalActualizar',
        i18n: {
            cancel: 'Cancelar',
            clear: 'Limpiar',
            done: 'Ok',
            months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sept", "Oct", "Nov", "Dic"],
            weekdays: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
            weekdaysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
            weekdaysAbbrev: ["D", "L", "M", "M", "J", "V", "S"]
        }
    });
    $("#FechaNac").datepicker("setDate", "7/11/1998");

    $('.sidenav').sidenav();
    $('.modal').modal();

    $('.dropdown-button').dropdown({
        inDuration: 300,
        outDuration: 225,
        belowOrigin: true, // Displays dropdown below the button
        alignment: 'right' // Displays dropdown with edge aligned to the left of button
    }
    );

    //Actualizar :)
    $("#formActualizar").validetta({
        bubblePosition: 'bottom',
        bubbleGapTop: 10,
        bubbleGapLeft: -5,
        onValid:
            $("#formActualizar").submit(function (evt) {
                evt.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: 'inc/ActualizarPerfil.php',
                    type: "POST",
                    data: formData,
                    async: false,
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
                                M.toast({ html: '<i class=\'green-text fas fa-check-circle\'><\i> <i class=\'white-text\'> Usuario Actualizado exitosamente<\i> <div class= \'progress\'><div class=\'indeterminate\'></div></div> ', classes: 'rounded' });
                                setTimeout("location.href = 'myProfile';", 500);
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

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#FotoPerfil').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}