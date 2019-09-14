import { Calendar } from '@fullcalendar/core';
import { CalendarSettings } from './CalendarSettings';

/** Mis Clases */
import { ModalReserva } from './ModalReserva';
import { FormReserva } from './FormReserva';
import { FormCargar } from './FormCargar';

/** fullcalendar */
let calendarEl = document.getElementById('hotelCalendar');
const calendar = new Calendar(calendarEl, CalendarSettings);

// Mis librerias
const modal = new ModalReserva('modalRegistrar');
const form = new FormReserva('formReserva');
const formCargar = new FormCargar('formCargarHab');

/** 
 * Eventos de fullcalendar 
 */
calendar.on('dateClick', (info) => {    
    modal.show(info)
});

calendar.on('eventClick', function(click) {
    modal.showEvent(click.event)
});

calendar.render();

/** Mis eventos */
form.submitEventListener();

formCargar.submitEventListener();

modal.changeSelectEventListener();

modal.clickEventListener('btnVaciarReservas');