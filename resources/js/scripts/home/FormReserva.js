import Axios from "axios";
import Swal from "sweetalert2";

export class FormReserva
{
    constructor(formName) {
        this.form = document.getElementById(formName)
    }

    successMessage(response) {
        Swal.fire({
            type: 'success',
            title: response.data.success
        }).then(() => location.reload())
    }

    errorMessage(errorObj) {
        let errors = errorObj.response.data.errors
        let errorText = ''

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