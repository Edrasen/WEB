

/**
 * Description
 * @authors Daivd Lopez Hernandez
 * @date    2019-09-02 13:54:38
 * @version 1.0.0
 */
// Or with jQuery

$(document).ready(
    function () {
        $('.sidenav').sidenav();
        $('.modal').modal();

        $('.dropdown-button').dropdown({
            inDuration: 300,
            outDuration: 225,
            belowOrigin: true, // Displays dropdown below the button
            alignment: 'right' // Displays dropdown with edge aligned to the left of button
        }
        );
    });