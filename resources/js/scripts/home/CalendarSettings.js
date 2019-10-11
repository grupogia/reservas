import interactionPlugin from '@fullcalendar/interaction';
import resourceTimelinePlugin from '@fullcalendar/resource-timeline';
import esLocale from '@fullcalendar/core/locales/es';

export const CalendarSettings = {
    schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',

    /**
     * Plugins
     */
    plugins: [ resourceTimelinePlugin, interactionPlugin ],
    defaultView: 'resourceTimelineMonth',
    height: 550,
    resourceAreaWidth: '310px',
    locale: esLocale,
    //slotWidth: 100,
    titleFormat: { year: 'numeric', month: 'long' },

    // Cabecera
    header: {
        left: 'resourceTimelineYear,resourceTimelineMonth,resourceTimelineWeek',
        center: 'title',
        right: 'today prev,next'
    },

    // Vistas
    views: {
        resourceTimelineMonth: {
            slotLabelFormat: [
                { month: 'long' },
                { weekday: 'long', day: 'numeric' } // top of text
            ]
        },
        resourceTimelineYear: {
            buttonText: 'Año',
            slotLabelFormat: [
                { month: 'long' }, // top of text
                { weekday: 'long', day: 'numeric' }
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

    // Habitaciones
    resourceColumns: [
        {
          labelText: 'HABITACIÓN',
          field: 'number'
        },
        {
            labelText: 'TIPO CAMA',
            field: 'bed_type'
        },
        {
            labelText: '# CAMAS',
            field: 'bed_number'
        },
    ],

    resourceGroupField: 'title',
    resources: 'deptos',
    
    // Link de los recursos
    events: 'reservaciones'
}