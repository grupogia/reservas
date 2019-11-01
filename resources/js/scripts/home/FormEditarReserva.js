import Axios from "axios";
import Swal from "sweetalert2";

export class FormEditarReserva
{
    constructor(formName, fullcalendar, modalEditar) {
        this.form = document.getElementById(formName)
        this.calendar = fullcalendar
        this.modal = modalEditar
    }

    successMessage(msgObj) {
        Swal.fire({
            type: 'success',
            title: msgObj.message
        })
        .then(() => {
            this.calendar.refetchEvents();
            this.modal.hide();
        })
    }

    errorMessage(msgObj) {
        let errors = msgObj.response.data.errors
        let errorText = ''

        for (let i in errors) {
            errorText += errors[i][0] + '<br>';
        }

        if (msgObj.response.status === 401 || msgObj.response.status === 419) {
            location.reload()
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