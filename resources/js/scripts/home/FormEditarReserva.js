import Axios from "axios";
import Swal from "sweetalert2";

export class FormEditarReserva
{
    constructor(formName) {
        this.form = document.getElementById(formName)
    }

    successMessage(msgObj) {
        Swal.fire({
            type: 'success',
            title: msgObj.message
        })
        .then(() => {
            location.reload();
        })
    }

    errorMessage(msgObj) {
        let errors = msgObj.response.data.errors
        let errorText = ''

        if (msgObj.response.status === 401) {
            location.reload();
        }

        for (let i in errors) {
            errorText += errors[i][0] + '<br>';
        }

        if (msgObj.response.status === 403) {
            errorText = 'No tiene permisos sobre este registro.';
        }
        Swal.fire({
            type: 'error',
            title: 'No se aplicaron cambios',
            html: errorText
        });
    }

    sendData(url, data) {
        Axios.post(url, data)
        .then(response => {
            this.successMessage(response.data)
        })
        .catch(errors => {
            this.errorMessage(errors)
        })
    }

    submitEventListener() {
        this.form.addEventListener('submit', e => {
            e.preventDefault();
            let data = new FormData(e.target);
            let url = e.target.action;
   
            this.sendData(url, data);
        });
    }
}