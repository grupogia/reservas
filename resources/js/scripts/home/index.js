import { Calendar } from '@fullcalendar/core';
import { CalendarSettings } from './CalendarSettings';

/** Mis Clases */
import { ModalReserva } from './ModalReserva';
import { ModalEditarReserva } from './ModalEditarReserva';

import { FormReserva } from './FormReserva';
import { FormEditarReserva } from './FormEditarReserva';
import { FormCargar } from './FormCargar';

/** fullcalendar */
let calendarEl = document.getElementById('hotelCalendar');
const calendar = new Calendar(calendarEl, CalendarSettings);

// Mis librerias
const modal       = new ModalReserva('modalRegistrar');
const modalEditar = new ModalEditarReserva('modalEditar', calendar);
const formAdd     = new FormReserva('formReserva', calendar, modal);
const formEditar  = new FormEditarReserva('formEditarReserva', calendar, modal);
const formCargar  = new FormCargar('formCargarHab');

/** 
 * Eventos de fullcalendar 
 */
calendar.on('dateClick', (info) => {    
    modal.show(info)
});

calendar.on('eventClick', function(click) {
    modalEditar.show(click.event)
});

calendar.render();

/** Mis eventos */
formAdd.submitEventListener();

formEditar.submitEventListener();

formCargar.submitEventListener();

modal.changeSelectEventListener();

modal.clickEventListener('btnVaciarReservas');

modalEditar.clickEventListener('btnDeleteReservacion');