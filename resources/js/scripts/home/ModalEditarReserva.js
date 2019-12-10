import moment from 'moment';
import Swal from 'sweetalert2';

export class ModalEditarReserva {
    constructor(modalName, fullcalendar) {
        this.modal = document.getElementById(modalName);
        this.bootstrapModal = $('#' + modalName)
        this.calendar = fullcalendar;
    }

    show(event) {
        this.printReservationModal(event)
        this.getDetailReserva(formEditarReserva)
        this.bootstrapModal.modal('show')
    }

    clickEventListener(btnName) {
        let btn = document.getElementById(btnName);

        btn.addEventListener('click', e => {
            e.preventDefault();
            let classList = btn.classList;
            
            if (classList.contains('btn-danger')) {
                let url = document.getElementById('formEditarReserva').action;

                Swal.showLoading();
                
                axios.delete(url)
                .then(res => {                    
                    Swal.fire({
                        type: 'success',
                        title: res.data.message
                    })
                    .then(() => {
                        this.calendar.refetchEvents()
                        this.bootstrapModal.modal('hide')
                    })
                })
                .catch(error => {             
                    Swal.fire({
                        type: 'error',
                        title: error.response.data.message
                    })
                })
            }
        })
    }

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

    getDetailReserva(form) {
        let url = form.action;
        
        axios.get(url)
        .then(res => {
            this.printTbodyHab(res)
        })
        return true;
    }

    printTbodyHab(json) {
        // Los cambios de este método afectan a la clase FormCargar
        let tbody = document.getElementById('tbody_editar_habitaciones_cargadas');
        let cartContent = json.data.detalle;
        let total = json.data.initial;
        let tbodyHTML = '';
        let segmentation = json.data.segmentation;        

        for (let index in cartContent) {
            let prod = cartContent[index]           
            
            tbodyHTML += `<tr>
            <td>${prod.suite.number + ' ' + prod.suite.title}</td>
            <td>${prod.rate_type.toUpperCase()}</td>
            <td>${prod.adults}</td>
            <td>${prod.children}</td>
            <td>${prod.suite.bed_type.toUpperCase()}</td>
            <td>$ ${new Intl.NumberFormat().format(prod.subtotal)}</td>
            <td>
            <a href="actualizar-habitaciones/${prod.id}/edit">Editar</a>
            </td>
            </tr>`;
        }
        tbody.innerHTML = tbodyHTML;
        total_editar_carga.innerHTML = '$ ' + new Intl.NumberFormat().format(total);

        $('#modalEditar select[name=tipo_de_reserva]').val(segmentation.name)
        $('#modalEditar select[name=canal]').val(segmentation.channel)
    }

    printReservationModal(event) {        
        let start_date = moment(event.start).format('DD/MM/YYYY');
        let end_date   = moment(event.end)  .format('DD/MM/YYYY');
        let start_time = moment(event.start).format('hh:mm A');
        let end_time   = moment(event.end)  .format('hh:mm A');
        let resource   = event.getResources()[0];
        let props      = event.extendedProps;
        let form       = $('#modalEditar #formEditarReserva')[0];
        let isMethod   = $('#modalEditar input[name=_method]').length;
        let payment    = props.payment_method.toLowerCase();

        let no_tarjeta = $('#modalEditar span[data-name=no_tarjeta]');
        let no_tarjeta_cont = $('#modalEditar div[data-name=no_tarjeta_cont]');

        if (payment === 'tarjeta') {
            no_tarjeta_cont[0].style.display = 'block';
            no_tarjeta.html(props.number.substr(-4))
        } else {
            no_tarjeta_cont[0].style.display = 'none';
        }
        
        form.reset();
        form.action = form.dataset.url + '/' + event.id;

        if (!isMethod)
        form.innerHTML += `<input type="hidden" name="_method" value="PUT"/>`;

        btnChangePayment.href = btnChangePayment.dataset.url + '/' + event.id;

        $('#modalEditar a.btn-warning')[0].href = $('#modalEditar a.btn-warning')[0].dataset.url + '/' + event.id
        
        $('#modalEditar input[name=nombre]')         .val(props.name)
        $('#modalEditar input[name=apellidos]')      .val(props.surname)
        $('#modalEditar input[name=email]')          .val(props.email)
        $('#modalEditar input[name=direccion]')      .val(props.address)
        $('#modalEditar input[name=telefono]')       .val(props.phone)
        $('#modalEditar input[name=procedencia]')    .val(props.country)
        $('#modalEditar select[name=tipo_pago]')     .val(payment)
        $('#modalEditar input[name=tipo_pago]')      .val(payment)
        $('#modalEditar input[name=habitacion]')     .val(resource.title + ' ' + resource.id)
        $('#modalEditar select[name=canal]')         .val(props.segmentation)
        $('#modalEditar input[name=canal]')          .val(props.segmentation)
        $('#modalEditar input[name=hora_de_entrada]').val(start_time)
        $('#modalEditar input[name=hora_de_salida]') .val(end_time)
        $('#modalEditar input[name=fecha_de_entrada]').val(start_date)
        $('#modalEditar input[name=fecha_de_salida]').val(end_date)
        $('#modalEditar textarea[name=notas]').html(props.notes)
        $('#totalConImpuestos').val('Total $ ' + new Intl.NumberFormat().format(props.total))
        //$('#totalConImpuestos').val('Total $ ' + props.total)
    }
}