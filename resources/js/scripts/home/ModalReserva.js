import moment from 'moment';
import Axios from 'axios';

export class ModalReserva {
    constructor(modalName) {
        this.modal = document.getElementById(modalName);
        this.bootstrapModal = $('#' + modalName)
    }

    show(dataJson) {
        this.getShoppingCartContent()
        this.printModalStoreEvent(dataJson)
        this.bootstrapModal.modal('show')
    }

    showEvent(dataJson) {
        this.printModalUpdateEvent(dataJson);
        this.bootstrapModal.modal('show')
    }

    getShoppingCartContent() {
        Axios.get('carrito-habitaciones')
        .then(res => {
            this.printTbodyHab(res)
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

    printTbodyHab(json) {
        let tbody = document.getElementById('tbody_habitaciones_cargadas');
        let cartContent = json.data.content;
        let total = json.data.initial;
        let tbodyHTML = '';

        for (let index in cartContent) {
            let prod = cartContent[index]
            tbodyHTML += `<tr>
            <td>${prod.name}</td>
            <td>${prod.qty}</td>
            <td>${prod.options.tarifa.toUpperCase()}</td>
            <td>${prod.options.bed_type.toUpperCase()}</td>
            <td>$ ${new Intl.NumberFormat().format(prod.price)}</td>
            </tr>`;
        }
        tbody.innerHTML = tbodyHTML;
        total_carga.innerHTML = '$ ' + total
    }

    printModalStoreEvent(date) {
        let time_start = '12:00 AM';
        let date_start = moment(date.dateStr).format('DD/MM/YYYY')
        let time_end = '11:00 PM ';
        let date_end = moment(date.dateStr).format('DD/MM/YYYY')
        let form = $('#modalRegistrar #formReserva')[0]
        
        form.reset();
        form.action = form.dataset.url;
        $('#modalRegistrar input[name=_method]').remove();

        $('#modalRegistrar input[name=hora_de_entrada]').val(time_start)
        $('#modalRegistrar input[name=fecha_de_entrada]').val(date_start)
        $('#modalRegistrar input[name=hora_de_salida]').val(time_end)
        $('#modalRegistrar input[name=fecha_de_salida]').val(date_end)
    }

    printModalUpdateEvent(event) {
        let start = moment(event.start).format('hh:mm A DD-MM-YYYY');
        let end = moment(event.start).format('hh:mm A DD-MM-YYYY');
        let resource = event.getResources()[0];
        let props = event.extendedProps;
        let form = $('#modalRegistrar #formReserva')[0]
        let isMethod = $('#modalRegistrar input[name=_method]').length;
        
        form.reset();
        form.action = form.dataset.url + '/' + event.id;

        if (!isMethod)
        form.innerHTML += `<input type="hidden" name="_method" value="PUT"/>`;       

        $('#modalRegistrar input[name=nombre]').val(props.name)
        $('#modalRegistrar input[name=apellidos]').val(props.surname)
        $('#modalRegistrar input[name=email]').val(props.email)
        $('#modalRegistrar input[name=direccion]').val(props.address)
        $('#modalRegistrar input[name=telefono]').val(props.phone)
        $('#modalRegistrar input[name=procedencia]').val(props.country)
        $('#modalRegistrar input[name=vencimiento]').val(props.expiration)
        $('#modalRegistrar select[name=tipo_pago]').val(props.payment_method)
        $('#modalRegistrar input[name=habitacion]').val(resource.title + ' ' + resource.id)
        $('#modalRegistrar input[name=entrada]').val(start)
        $('#modalRegistrar input[name=salida]').val(end)
        $('#modalRegistrar textarea[name=notas]').html(props.notes)
    }
}