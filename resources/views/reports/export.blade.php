<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Menus</th>
            <th>Tables</th>
            <th>Sérveur</th>
            <th>Qantité</th>
            <th>Total</th>
            <th>Type de Paiement</th>
            <th>Etat de Paiement</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sales as $sale)
        <tr>
            <td>
                {{ $sale->id }}
            </td>
            <td>
                @foreach ($sale->menus()->where("sales_id",$sale->id)->get() as $menu)
                        <h5>
                            {{ $menu->title }}
                        </h5>
                        <h5>
                            {{ $menu->price }} DH
                        </h5>
                @endforeach
            </td>
            <td>
                @foreach ($sale->tables()->where("sales_id",$sale->id)->get() as $table)
                <div>
                    <div>
                        <div>
                            <h5>
                                {{ $table->name }}
                            </h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </td>
            <td>
                {{ $sale->servant->name }}
            </td>
            <td>
                {{ $sale->quantity }}
            </td>
            <td>
                {{ $sale->total_received }}
            </td>
            <td>
                {{ $sale->payment_type === "cash" ? "Espéce" : "Carte Bancaire" }}
            </td>
            <td>
                {{ $sale->payment_status === "paid" ? "Payé" : "Impayé" }}
            </td>
        </tr>
        <tr>
            <td colspan="5">
                Rapport de  {{ $from }} à {{ $to }}
            </td>
            <td>
                {{ $total }} DH
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
