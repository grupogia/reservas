import moment from 'moment';
import Axios from 'axios';
import Swal from 'sweetalert2';

export class ModalEditarReserva {
    constructor(modalName) {
        this.modal = document.getElementById(modalName);
        this.bootstrapModal = $('#' + modalName)
    }

    show(dataJson) {
        this.printReservationOnModal(dataJson)
        this.bootstrapModal.modal('show')
    }

    clickEventListener(btnName) {
        let btn = document.getElementById(btnName);

        btn.addEventListener('click', e => {
            e.preventDefault();
            let classList = btn.classList;
            
            if (classList.contains('btn-danger')) {
                let url = e.target.href;
                
                Axios.get(url)
                .then(() => {
                    Swal.fire({
                        type: 'success',
                        title: 'El carrito está vacío'
                    })
                    .then(() => this.getShoppingCartContent())
                })
            }
        })
    }

    changeSelectEventListener() {
        $('#modalRegistrar select').on('change', e => {
            let name = e.target.name;
            let value = e.target.value;

            if (name == 'habitacion') {
                console.log(value);
            }
            
            if (name == 'tarifa') {
                console.log(value)
            }

            if (name == 'tipo_pago') {
                this.toggleInputs(value, 'tipo-pago');
            }

            if (name == 'tipo_de_reserva') {
                this.toggleInputs(value, 'tipo-de-reserva');
            }
        })
    }

    toggleInputs(value = '', divClass) {
        let divs = document.querySelectorAll('div[class*="selected"].' + divClass);
        let selected = '.' + value + '-selected';

        for (let i = 0; i < divs.length; i++) {
            divs[i].style.display = 'none';
        }

        if (value)
        document.querySelector(selected).style.display = 'block';
    }

    getDetailReserva() {
        return true;
    }

    printTbodyHab(json) {
        // Los cambios de este método afectan a la clase FormCargar
        let tbody = document.getElementById('tbody_habitaciones_cargadas');
        let cartContent = json.data.content;
        let total = json.data.initial;
        let tbodyHTML = '';

        for (let index in cartContent) {
            let prod = cartContent[index]
            tbodyHTML += `<tr>
            <td>${prod.name}</td>
            <td>${prod.qty}</td>
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

    printReservationOnModal(event) {
        let start_date = moment(event.start).format('DD/MM/YYYY');
        let end_date = moment(event.start).format('DD/MM/YYYY');
        let start_time = moment(event.start).format('hh:mm A');
        let end_time = moment(event.start).format('hh:mm A');
        let resource = event.getResources()[0];
        let props = event.extendedProps;
        let form = $('#modalEditar #formEditarReserva')[0]
        let isMethod = $('#modalEditar input[name=_method]').length;
        
        form.reset();
        form.action = form.dataset.url + '/' + event.id;

        if (!isMethod)
        form.innerHTML += `<input type="hidden" name="_method" value="PUT"/>`;

        $('#modalEditar input[name=nombre]').val(props.name)
        $('#modalEditar input[name=apellidos]').val(props.surname)
        $('#modalEditar input[name=email]').val(props.email)
        $('#modalEditar input[name=direccion]').val(props.address)
        $('#modalEditar input[name=telefono]').val(props.phone)
        $('#modalEditar input[name=procedencia]').val(props.country)
        $('#modalEditar input[name=vencimiento]').val(props.expiration)
        $('#modalEditar select[name=tipo_pago]').val(props.payment_method.toLowerCase())
        $('#modalEditar input[name=tipo_pago]').val(props.payment_method.toLowerCase())
        $('#modalEditar input[name=habitacion]').val(resource.title + ' ' + resource.id)
        $('#modalEditar input[name=fecha_de_entrada]').val(start_date)
        $('#modalEditar input[name=fecha_de_salida]').val(end_date)
        $('#modalEditar input[name=hora_de_entrada]').val(start_time)
        $('#modalEditar input[name=hora_de_salida]').val(end_time)
        $('#modalEditar textarea[name=notas]').html(props.notes)
    }
}