import Swal from 'sweetalert2';

export class FormCargar
{
    constructor(formName) {
        this.form = document.getElementById(formName)
    }

    successMessage(res) {  
        this.getShoppingCartContent()
        $('#submodalHabitacion').submodal('hide')
        this.form.reset()

        Swal.fire({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            type: 'success',
            title: res.data.message
        })
    }

    errorMessage(res) {
        let msg = res.response.data;
        let errorsText = ''

        if (res.response.status === 419 || res.response.status === 401) {
            location.reload();
        }
        
        for (let i in msg.errors) {
            errorsText += msg.errors[i]
        }

        Swal.fire({
            type: 'error',
            title: 'No se cargó',
            html: errorsText
        })
    }

    /**
     * Envía los datos de la habitacion a cargar
     */
    sendData(habitacionId, formData) {
        Swal.showLoading()
        
        axios.post('carrito-habitaciones/' + habitacionId, formData)
        .then(res => {
            this.successMessage(res)
        })
        .catch(res => {
            console.log(res)
            this.errorMessage(res)
        })
    }

    /**
     * Se ejecuta una vez que se envía el formulario
     */
    submitEventListener() {
        this.form.addEventListener('submit', e => {
            e.preventDefault();
            let datosDeHabitacion = new FormData(this.form)
            let habId = this.form.querySelector('select[name=habitacion]').value

            datosDeHabitacion.append('fecha_de_entrada', document.querySelector('#modalRegistrar [name=fecha_de_entrada]').value)
            datosDeHabitacion.append('fecha_de_salida', document.querySelector('#modalRegistrar [name=fecha_de_salida]').value)
            datosDeHabitacion.append('hora_de_entrada', document.querySelector('#modalRegistrar [name=hora_de_entrada]').value)
            datosDeHabitacion.append('hora_de_salida', document.querySelector('#modalRegistrar [name=hora_de_salida]').value)

            this.sendData(habId, datosDeHabitacion)
        })
    }

    /**
     * Actualiza el estado del carrito
     */
    getShoppingCartContent() {
        axios.get('carrito-habitaciones')
        .then(res => {
            this.printTbodyHab(res)
        })
    }

    printTbodyHab(json) {        
        // Los cambios de este método afectan a la clase ModalCargar
        let tbody = document.getElementById('tbody_habitaciones_cargadas');
        let cartContent = json.data.content;
        let total = json.data.initial;
        let tbodyHTML = '';

        for (let index in cartContent) {
            let prod = cartContent[index]
            
            tbodyHTML += `<tr>
            <td>${prod.name}</td>
            <td>${prod.options.adultos}</td>
            <td>${prod.options.ninios}</td>
            <td>${prod.options.tarifa.toUpperCase()}</td>
            <td>${prod.options.bed_type.toUpperCase()}</td>
            <td>$ ${new Intl.NumberFormat().format(prod.price)}</td>
            </tr>`;
        }
        tbody.innerHTML = tbodyHTML;
        total_carga.innerHTML = '$ ' + total
    }
}