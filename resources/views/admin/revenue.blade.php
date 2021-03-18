@extends('layouts.admin')
@section('adminContent')
    <div class="col-md-12 px-2">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body px-2">
                <div class="table-responsive px-0">
                    <h4 class="text-center font-weight-bold pb-4">Recettes par jour</h4>
                    <table id="revenue" class="table table-striped table-bordere text-center" style="width:100%">
                        <thead>
                            <tr>
                                <th>Jour</th>
                                <th>CB</th>
                                <th>Ticket resto</th>
                                <th>Espéces</th>
                                <th>Paygreen</th>
                                <th>TVA 5,5%</th>
                                <th>TVA 10%</th>
                                <th>TAV 20%</th>
                                <th>Total HT</th>
                                <th>Total TTC</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Jour</th>
                                <th>CB</th>
                                <th>Ticket resto</th>
                                <th>Espéces</th>
                                <th>Paygreen</th>
                                <th>TVA 5,5%</th>
                                <th>TVA 10%</th>
                                <th>TAV 20%</th>
                                <th>Total HT</th>
                                <th>Total TTC</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($day as $key => $value)
                                        <tr>
                                            <td>{{ date('Y/m/d', strtotime($key)) }}</td>
                                            <td>{{ number_format($value['totalCBresto'], 2, ",", ".") }} €</td>
                                            <td>{{ number_format($value['totalTR'], 2, ",", ".") }} €</td>
                                            <td>{{ number_format($value['totalMoney'], 2, ",", ".") }} €</td>
                                            <td>{{ number_format($value['totalPG'], 2, ",", ".") }} €</td>
                                            <td>{{ number_format($value['tva6'], 2, ",", ".") }} €</td>
                                            <td>{{ number_format($value['tva10'], 2, ",", ".") }} €</td>
                                            <td>{{ number_format($value['tva20'], 2, ",", ".") }} €</td>
                                            <td>{{ number_format($value['totalHT'], 2, ",", ".") }} €</td>
                                            <td>{{ number_format($value['totalTTC'], 2, ",", ".") }} €</td>
                                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
