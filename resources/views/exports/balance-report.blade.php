
<table>
    <tbody>
        <tr>
            <th colspan="8" style="background-color: #002060; color: white; text-align:center;">COMPRA - VENTA DÓLARES  FORTUNE ONLINE</th>
            <th colspan="3" style="background-color: #002060; color: white; text-align:center;">{{ date('d-m-Y') }}</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <td rowspan="2" colspan="2" valign="center" style="background-color: #ffff00; border-right: 1px solid black; border-bottom: 1px solid black; text-align:center;">CAJA INICIAL</td>
            <td colspan="2" style="background-color: #ffff00; border-bottom: 1px solid black;">$ {{ number_format( $initial_box_dol, 2, ',', '.') }}</td>
            <td style="background-color: #ffff00; border-right: 1px solid black; border-bottom: 1px solid black;">T/C {{ number_format($exchange_rate->compra, 3, ',', '.') }}</td>
            <td rowspan="2" valign="center" style="background-color: #8db4e2; border-right: 1px solid black; border-bottom: 1px solid black; text-align:center;">NETO</td>
            <td colspan="2" style="background-color: #8db4e2; border-right: 1px solid black; border-bottom: 1px solid black;">$ {{ number_format( $total_entries - $total_outputs, 2, ',', '.') }}</td>
            <td rowspan="2" valign="center" style="background-color: #99ff33; border-right: 1px solid black; border-bottom: 1px solid black;">UTILIDAD</td>
            <td rowspan="2" colspan="2" valign="center" style="background-color: #99ff33; border-right: 1px solid black; border-bottom: 1px solid black; text-align:center;">S/. {{ number_format( $total_outputs_change - $total_amount_movements_change, 2, ',', '.') }}</td>
            <td></td>
            <td colspan="7" style="background-color: #ff0000; border: 1px solid black; text-align:center;">EN SALDOS VA SUMANDO TODAS LAS COMPRAS</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="3" style="background-color: #ffff00; border-right: 1px solid black; border-bottom: 1px solid black;">S/. {{ number_format( $initial_box_pen, 2, ',', '.') }}</td>
            <td colspan="2" style="background-color: #8db4e2; border-right: 1px solid black; border-bottom: 1px solid black;">S/. {{ number_format( ($initial_box_pen - $total_entries_change) + $total_outputs_change, 2, ',', '.') }}</td>
            <td></td>
            <td colspan="7" style="background-color: #ff0000; border: 1px solid black; text-align:center;text-align:center;">EN MOVIMIENTOS SUMA TODAS LAS VENTAS O SALIDAS</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        {{-- ROW SEPARATOR --}}
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <th colspan="4" style="background-color: #002060; color: white; text-align:center;">ENTRADAS</th>
            <td></td>
            <th colspan="4" style="background-color: #002060; color: white; text-align:center;">SALIDAS</th>
            <td></td>
            <td></td>
            <th colspan="3" style="border: 1px solid black; text-align:center;">MOVIMIENTOS</th>
            <td></td>
            <th colspan="3" style="border: 1px solid black; text-align:center;">SALDOS</th>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td rowspan="2" valign="center" style="background-color: #002060; color: white; border: 1px solid white; text-align:center;">ITEM</td>
            <td style="background-color: #002060; color: white; border: 1px solid white; text-align:center;">$ {{ number_format( $total_entries, 2, ',', '.') }}</td>
            <td style="background-color: #002060; color: white; border: 1px solid white; text-align:center;">TOTAL</td>
            <td style="background-color: #002060; color: white; border: 1px solid white; text-align:center;">S/. {{ number_format( $total_entries_change, 2, ',', '.') }}</td>
            <td></td>
            <td rowspan="2" valign="center" style="background-color: #002060; color: white; border: 1px solid white; text-align:center;">ITEM</td>
            <td style="background-color: #002060; color: white; border: 1px solid white; text-align:center;">$ {{ number_format( $total_outputs, 2, ',', '.') }}</td>
            <td style="background-color: #002060; color: white; border: 1px solid white; text-align:center;">TOTAL</td>
            <td style="background-color: #002060; color: white; border: 1px solid white; text-align:center;">S/. {{ number_format( $total_outputs_change, 2, ',', '.') }}</td>
            <td></td>
            <td></td>
            <td style="border: 1px solid black; text-align:center;">$ {{ number_format( $total_amount_movements, 2, ',', '.') }}</td>
            <td style="border: 1px solid black; text-align:center;">TOTAL</td>
            <td style="border: 1px solid black; text-align:center;">S/. {{ number_format( $total_amount_movements_change, 2, ',', '.') }}</td>
            <td></td>
            <td style="border: 1px solid black; text-align:center;">$ {{ number_format( $total_entries - $total_amount_movements, 2, ',', '.') }}</td>
            <td style="border: 1px solid black; text-align:center;">TOTAL</td>
            <td style="border: 1px solid black; text-align:center;">S/. {{ number_format( $total_amount_balance_change, 2, ',', '.') }}</td>
        </tr>

        <tr>
            <td></td>
            <td style="background-color: #002060; color: white; border: 1px solid white; text-align:center;">MONTO</td>
            <td style="background-color: #002060; color: white; border: 1px solid white; text-align:center;">T/C</td>
            <td style="background-color: #002060; color: white; border: 1px solid white; text-align:center;">SOLES</td>
            <td></td>
            <td style="background-color: #002060; color: white; border: 1px solid white; text-align:center;">MONTO</td>
            <td style="background-color: #002060; color: white; border: 1px solid white; text-align:center;">T/C</td>
            <td style="background-color: #002060; color: white; border: 1px solid white; text-align:center;">SOLES</td>
            <td></td>
            <td></td>
            <td style="border: 1px solid black; text-align:center;">MONTO</td>
            <td style="border: 1px solid black; text-align:center;">T/C</td>
            <td style="border: 1px solid black; text-align:center;">SOLES</td>
            <td></td>
            <td style="border: 1px solid black; text-align:center;">MONTO</td>
            <td style="border: 1px solid black; text-align:center;">T/C</td>
            <td style="border: 1px solid black; text-align:center;">P.T.</td>
        </tr>

        @for ($i = 0; $i < count($rows); $i++)
            <tr>
                <td></td>
                <td style="border: 1px solid black; text-align:center; {{ $i == 0 ? 'background-color: #948a54; color: white' : '' }}">{{ $rows[$i][1] }}</td>
                <td style="border: 1px solid black; text-align:center; {{ $i == 0 ? 'background-color: #948a54; color: white' : '' }}">$ {{ number_format( $rows[$i][2], 2, ',', '.') }}</td>
                <td style="border: 1px solid black; text-align:center; {{ $i == 0 ? 'background-color: #948a54; color: white' : '' }}">{{ number_format($rows[$i][3], 3, ',', '.') }}</td>
                <td style="border: 1px solid black; text-align:center; {{ $i == 0 ? 'background-color: #948a54; color: white' : '' }}">S/. {{ number_format( $rows[$i][4], 2, ',', '.') }}</td>
                <td></td>
                <td style="border: 1px solid black; text-align:center; ">{{ $rows[$i][6] }}</td>
                <td style="border: 1px solid black; text-align:center; ">$ {{ number_format( $rows[$i][7], 2, ',', '.') }}</td>
                <td style="border: 1px solid black; text-align:center; ">{{ number_format($rows[$i][8], 3, ',', '.') }}</td>
                <td style="border: 1px solid black; text-align:center; ">S/. {{ number_format( $rows[$i][9], 2, ',', '.') }}</td>
                <td></td>
                <td></td>
                <td style="border: 1px solid black; text-align:center;">$ {{ number_format( $rows[$i][12], 2, ',', '.') }}</td>
                <td style="border: 1px solid black; text-align:center;">{{ number_format($rows[$i][13], 3, ',', '.') }}</td>
                <td style="border: 1px solid black; text-align:center;">{{ number_format( $rows[$i][14], 2, ',', '.') }}</td>
                <td></td>
                <td style="border: 1px solid black; text-align:center;">$ {{ number_format( $rows[$i][16], 2, ',', '.') }}</td>
                <td style="border: 1px solid black; text-align:center;">{{ number_format($rows[$i][17], 3, ',', '.') }}</td>
                <td style="border: 1px solid black; text-align:center;">S/. {{ number_format( $rows[$i][18], 2, ',', '.') }}</td>
                <td></td>
            </tr>
        @endfor
    </tbody>
</table>