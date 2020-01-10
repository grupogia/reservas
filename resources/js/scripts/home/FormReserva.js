import swal from "sweetalert2";

export class FormReserva
{
    constructor(formName, fullcalendar, modalReserva) {
        this.form = document.getElementById(formName);
        this.calendar = fullcalendar;
        this.modal = modalReserva;
    }

    successMessage(response) {
        swal.fire({
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

        for (let i in errors) {
            errorText += errors[i][0] + '<br>'
        }
        swal.fire({
            type: 'error',
            title: 'Datos inválidos',
            html: errorText
        });
    }

    sendData(url, data) {
        swal.showLoading()

        axios.post(url, data)
        .then(response => {
            this.successMessage(response)
        })
        .catch(errors => {
            if (errors.response.status === 422)
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