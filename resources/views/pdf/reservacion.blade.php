<page backtop="7mm" backbottom="7mm" backleft="10mm" backright="10mm">
    <style>
        table { border-collapse: collapse }
        table tr th { text-transform: uppercase }
        table th { background: #000; color: #ffffff }
        table tr td, table tr th {
            padding: 4px 6px;
            text-align: center;
            border-bottom: solid 1px #000;
        }
    </style>
<page_header>   
</page_header>
<page_footer>
</page_footer>

<p style="text-align: right; margin-bottom: -38px; padding-bottom: 0">{{ $reservacion->created_at->format('d') }} de {{ $reservacion->created_at->format('M, Y') }}</p>
<h1>Reservación Jardín Meliar</h1>
<hr>
<h4>Folio - {{ $reservacion->folio }}</h4>

<p>
    Cliente: <strong>{{ strToUpper($reservacion->client->name . ' ' . $reservacion->client->surname) }}</strong>
</p>

<p>
    Noches: <strong>{{ $nights }}</strong>
</p>

<p>
    Llegada: <strong>{{ $reservacion->checkin }}</strong>
</p>

<p>
    Salida: <strong>{{ $reservacion->checkout }}</strong>
</p>

<p>
    Total a pagar con impuestos: <strong>$ {{ number_format($reservacion->total,2) }} MXN</strong>
</p>

<p>
    Condiciones de Pago: <strong>{{ strToUpper($reservacion->payment_method) }}</strong>
</p>

<br><br>

<table style="width: 100px">
    <tr>
        <th style="width: 89px">habitacion</th>
        <th style="width: 89px">tarifa</th>
        <th style="width: 89px">adultos</th>
        <th style="width: 89px">P.U.</th>
        <th style="width: 89px">noches</th>
        <th style="width: 89px">subtotal</th>
    </tr>
    @foreach ($reservacion->details as $detail)
        <tr>
            <td>{{ $detail->suite->number . ' ' . $detail->suite->title }}</td>
            <td>{{ strToUpper($detail->rate_type) }}</td>
            <td>{{ $detail->adults }}</td>
            <td>$ {{ number_format($detail->subtotal, 2) }}</td>
            <td>{{ $nights }}</td>
            <td>$ {{ number_format($detail->subtotal * $nights, 2) }}</td>
        </tr>
    @endforeach
</table>

<br>

<p>La tarifa incluye impuestos: 16% al valor agregado, 3.75% de impuestos sobre hospedaje.</p>
</page>