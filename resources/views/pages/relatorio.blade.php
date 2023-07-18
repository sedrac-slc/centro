<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>

        .conteiner-retiradas{
            width: 100%;
        }

        .conteiner-items {
            float: right;
        }

        table{
            border-collapse: collapse;
            text-align: center;
        }

        td,th{
            border: 0.5px solid #ccc;
            padding: 0.3rem;
        }
    </style>
</head>

<body>
    @foreach ($retiradas as $retirada)
        <div class="conteiner-data">
            <table class="conteiner-retiradas">
                <thead>
                    <tr><td colspan="6">Retirada</td></tr>
                    <tr class="titles">
                        <td>Médico</td>
                        <td>Farmacêutico</td>
                        <td>Qtd(Inicial)</td>
                        <td>Qtd(Retirada)</td>
                        <td>Qtd(Stock)</td>
                        <td>Criado a</td>
                    </tr>
                </thead>
                <tbody>
                    <tr class="datas">
                        <td>{{ $retirada->medicamento->nome }}</td>
                        <td>{{ $retirada->user->name }}</td>
                        <td>{{ $retirada->quantidade_inicial }}</td>
                        <td>{{ $retirada->quantidade_retirada }}</td>
                        <td>{{ $retirada->quantidade_stock }}</td>
                        <td>{{ $retirada->created_at }}</td>
                    </tr>
                </tbody>
            </table>
            @if (sizeof($retirada->items) > 0)
                <table class="conteiner-items">
                    <thead>
                        <tr><td colspan="3">Items</td></tr>
                        <tr class="titles">
                            <td>Código</td>
                            <td>Data válidado</td>
                            <td>Criado a</td>
                        </tr>
                    </thead>
                    @foreach ($retirada->items as $item)
                        <tbody>
                            <tr class="datas">
                                <td>{{ $item->codigo }}</td>
                                <td>{{ $item->data_validade }}</td>
                                <td>{{ $item->created_at }}</td>
                            </tr>
                        </tbody>
                    @endforeach
        </div>
    @endif
    </div>
    @endforeach
</body>

</html>
