import moment from 'moment';
import Axios from 'axios';
import Swal from 'sweetalert2';

export class ModalReserva {
    constructor(modalName) {
        this.modal = document.getElementById(modalName);
        this.bootstrapModal = $('#' + modalName)
    }

    /** Muestra el modal */
    show(dataJson) {
        this.getShoppingCartContent()
        this.printModalStoreEvent(dataJson)
        this.bootstrapModal.modal('show')
    }

    showEvent(dataJson) {
        this.printModalUpdateEvent(dataJson);
        this.bootstrapModal.modal('show');
    }

    hide() {
        this.bootstrapModal.modal('hide')
    }

    /** Devuelve las habitaciones cargadas en el carrito */
    getShoppingCartContent() {
        Axios.get('carrito-habitaciones')
        .then(res => {
            this.printTbodyHab(res)
        })
    }

    /** Activa los eventos de hacer click */
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
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        type: 'success',
                        title: 'El carrito está vacío'
                    })
                    this.getShoppingCartContent();
                })
            }
        })

        this.modal.querySelector('.calculate').addEventListener('click', () => {
            let data = new FormData(formReserva);
            
            Axios.post('/calcular-precio', data)
            .then(response => {
                Swal.fire({
                    type: 'success',
                    title: '$ ' + response.data.total,
                    text: response.data.message
                })
            })
            .catch(err => {
                let errors = err.response.data.errors
                let errorText = ''

                for (let i in errors) {
                    errorText += errors[i][0] + '<br>'
                }
                Swal.fire({
                    type: 'error',
                    title: 'Datos inválidos',
                    html: errorText
                });
            })
        })
    }

    /** Muestra u oculta los selects al realizar cambio en ellos */
    changeSelectEventListener() {
        $('#modalRegistrar select').on('change', e => {
            let name = e.target.name;
            let value = e.target.value;

            // if (name == 'habitacion') {
            //     console.log(value);
            // }
            
            // if (name == 'tarifa') {
            //     console.log(value)
            // }

            if (name == 'tipo_pago') {
                this.toggleInputs(value, 'tipo-pago');
            }

            if (name == 'tipo_de_segmentacion') {
                this.toggleInputs(value, 'tipo-de-segmentacion');
            }

            if (name == 'tipo') {                
                this.toggleOptions(value, 'canal');
            }
        })
    }

    toggleInputs(value = '', divClass) {
        let divs = document.querySelectorAll('div[class*="selected"].' + divClass);
        
        for (let i = 0; i < divs.length; i++) {
            divs[i].style.display = 'none';
        }
        
        if (value) {
            let selected = document.querySelector('.' + value + '-selected');
            selected.style.display = 'block';
        }
    }

    /** Aparece y desaparece las opciones de un select */
    toggleOptions(value = '', optionsClass) {
        let options = document.querySelectorAll('option.' + optionsClass);
        let emptyOption = document.querySelector('.' + optionsClass + '.empty');
        
        for (let i = 0; i < options.length; i++) {
            options[i].style.display = 'none';
        }

        emptyOption.selected = true;
        
        if (!value) return emptyOption.style.display = 'block';

        let selected = document.querySelectorAll('.' + value);

        for (let i = 0; i < selected.length; i++) {                
            selected[i].style.display = 'block';
        }
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

    printModalStoreEvent(date) {
        let time_start = '12:00 AM';
        let date_start = moment(date.dateStr).format('DD/MM/YYYY')
        let time_end = '11:00 PM ';
        let date_end = moment(date.dateStr).format('DD/MM/YYYY')
        let form     = $('#modalRegistrar #formReserva')[0]
        
        form.reset();
        form.action = form.dataset.url;
        $('#modalRegistrar input[name=_method]').remove();

        $('#modalRegistrar input[name=hora_de_entrada]') .val(time_start)
        $('#modalRegistrar input[name=fecha_de_entrada]').val(date_start)
        $('#modalRegistrar input[name=hora_de_salida]')  .val(time_end)
        $('#modalRegistrar input[name=fecha_de_salida]') .val(date_end)
    }

    printModalUpdateEvent(event) {
        let start = moment(event.start).format('hh:mm A DD-MM-YYYY');
        let end   = moment(event.start).format('hh:mm A DD-MM-YYYY');
        let resource = event.getResources()[0];
        let props = event.extendedProps;
        let form  = $('#modalRegistrar #formReserva')[0]
        let isMethod = $('#modalRegistrar input[name=_method]').length;
        
        form.reset();
        form.action = form.dataset.url + '/' + event.id;

        if (!isMethod)
        form.innerHTML += `<input type="hidden" name="_method" value="PUT"/>`;       

        $('#modalRegistrar input[name=nombre]')     .val(props.name)
        $('#modalRegistrar input[name=apellidos]')  .val(props.surname)
        $('#modalRegistrar input[name=email]')      .val(props.email)
        $('#modalRegistrar input[name=direccion]')  .val(props.address)
        $('#modalRegistrar input[name=telefono]')   .val(props.phone)
        $('#modalRegistrar input[name=procedencia]').val(props.country)
        $('#modalRegistrar input[name=vencimiento]').val(props.expiration)
        $('#modalRegistrar select[name=tipo_pago]') .val(props.payment_method)
        $('#modalRegistrar input[name=habitacion]') .val(resource.title + ' ' + resource.id)
        $('#modalRegistrar input[name=entrada]')    .val(start)
        $('#modalRegistrar input[name=salida]')     .val(end)
        $('#modalRegistrar textarea[name=notas]')   .html(props.notes)
    }
}