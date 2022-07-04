'use strict';


function valida(e) {
    if (document.getElementById('tipo').value == "G")
        document.getElementById('diaria').value = "300.00";

    else {
        if (document.getElementById('tipo').value == "M")
            document.getElementById('diaria').value = "220.00";

        else
            document.getElementById('diaria').value = "150.00";
    }
}
document.getElementById('tipo').addEventListener('change', valida);
