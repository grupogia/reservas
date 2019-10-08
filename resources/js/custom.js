import 'jquery-ui/ui/widgets/datepicker.js';
import 'timepicker';
//var dt = require( 'datatables.net' )();

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

if (typeof tableSuites !== 'undefined')
require('./scripts/suites/index')