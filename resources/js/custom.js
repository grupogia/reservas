import 'jquery-ui/ui/widgets/datepicker.js';
import 'timepicker';

if ($('.datepk').length) {    
    $('.datepk').datepicker({
        dateFormat: "dd/mm/yy"
    })
}

$('.timepk').timepicker({
    timeFormat: 'h:i A'
})

if (typeof hotelCalendar !== 'undefined')
require('./scripts/home/index')