import { Calendar } from '@fullcalendar/core';
import interactionPlugin from '@fullcalendar/interaction';
import resourceTimelinePlugin from '@fullcalendar/resource-timeline';
import esLocale from '@fullcalendar/core/locales/es';

/** Mis Clases */
import { ModalReserva } from './ModalReserva';
import { FormReserva } from './FormReserva';
import { FormCargar } from './FormCargar';

let calendarEl = document.getElementById('hotelCalendar');

const modal = new ModalReserva('modalRegistrar');
const form = new FormReserva('formReserva');
const formCargar = new FormCargar('formCargarHab');

const calendar = new Calendar(calendarEl, {
    schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',

    plugins: [ resourceTimelinePlugin, interactionPlugin ],
    height: 550,
    defaultView: 'resourceTimelineMonth',
    locale: esLocale,
    resourceAreaWidth: '310px',
    //slotWidth: 100,
    titleFormat: { year: 'numeric', month: 'short' },

    header: {
        left: 'resourceTimelineYear,resourceTimelineMonth,resourceTimelineWeek',
        center: 'title',
        right: 'today prev,next'
    },

    views: {
        resourceTimelineMonth: {
            slotLabelFormat: [
                { month: 'long' },
                { weekday: 'short', day: 'numeric' } // top of text
            ]
        },
        resourceTimelineYear: {
            buttonText: 'Año',
            slotLabelFormat: [
                { month: 'long' }, // top of text
                { weekday: 'short', day: 'numeric' }
            ]
        },
        resourceTimelineWeek: {
            type: 'resourceTimelineWeek',
            buttonText: 'Semana',
            dateAlignment: 'week',
            duration: { day: 7 },
            slotWidth: 50,
            //dayCount: 1,
            slotLabelFormat: [
                { weekday: 'long', day: 'numeric' },
                { hour: 'numeric', minute: 'numeric' }
            ]
        }
    },

    dateClick: function(info) {
        modal.show(info)
    },

    eventClick: function(click) {
        modal.showEvent(click.event)
    },

    resourceColumns: [
        {
          labelText: 'Nº HAB',
          field: 'number'
        },
        {
          labelText: 'CAMAS',
          field: 'bed_number'
        },
        {
            labelText: 'TIPO CAMA',
            field: 'bed_type'
        }
    ],

    resourceGroupField: 'title',
    resources: 'deptos',
    events: 'reservaciones'
});

calendar.render();

form.submitEventListener();

formCargar.submitEventListener();

modal.changeSelectEventListener();

modal.clickEventListener('btnVaciarReservas');