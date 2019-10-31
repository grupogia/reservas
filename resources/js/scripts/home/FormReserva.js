import Axios from "axios";
import Swal from "sweetalert2";

export class FormReserva
{
    constructor(formName, fullcalendar, modalReserva) {
        this.form = document.getElementById(formName);
        this.calendar = fullcalendar;
        this.modal = modalReserva;
    }

    successMessage(response) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            type: 'success',
            title: response.data.success
        });
        this.calendar.refetchEvents();
        this.modal.hide();
    }

    errorMessage(errorObj) {
        let errors = errorObj.response.data.errors;
        let errorText = '';

        this.calendar.refetchEvents();

        if (errorObj.response.status === 419) {
            location.reload();
        }

        for (let i in errors) {
            errorText += errors[i][0] + '<br>'
        }
        Swal.fire({
            type: 'error',
            title: 'Datos inválidos',
            html: errorText
        });
    }

    sendData(url, data) {
        Swal.showLoading()

        Axios.post(url, data)
        .then(response => {
            this.successMessage(response)
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