import Axios from "axios";
import Swal from "sweetalert2";

export class FormReserva
{
    constructor(formName) {
        this.form = document.getElementById(formName)
    }

    successMessage(successObj) {
        console.log(successObj)
        Swal.fire({
            type: 'success',
            title: 'Completado'
        })
        .then(() => {
            getShoppingCartContent();
        })
    }

    errorMessage(errorObj) {
        let errors = errorObj.response.data.errors
        let errorTitle = errorObj.response.data.message
        let errorText = ''

        for (let i in errors) {
            errorText += errors[i][0] + '<br>'
        }
        Swal.fire({
            type: 'error',
            title: errorTitle,
            html: errorText
        });
        console.log(errors);
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