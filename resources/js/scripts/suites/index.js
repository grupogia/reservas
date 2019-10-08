require('datatables.net');

let table = $('#tableSuites');

table.dataTable({
    processing: true,
    serverSide: true,
    "scrollX": false,
    ajax: {
        url: '/suites',
        dataSrc: 'data',
    },
    //data: data,
    columns: [
        { data: 'number' },
        { data: 'title' },
        { data: 'bed_type' },
        { data: 'bed_number' },
        { data: 'created_at' },
        { data: 'updated_at' },
        { data: 'options', className: "p-1" },
    ]
})

// table.click(function (e) {
//     let classList = e.target.classList;
    
//     if (classList.contains('edit-suite'))
//     console.log(e.target.dataset.item);
    
// })