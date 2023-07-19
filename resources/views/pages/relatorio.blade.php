<!DOCTYPE html>

<head lang="pt">
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        body {
            font-size: 10pt;
            font-family: sans-serif;
        }

        .conteiner-retiradas {
            width: 100%;
        }

        table {
            border-collapse: collapse;
            text-align: center;
        }

        td,
        th {
            border: 0.5px solid #ccc;
            padding: 0.3rem;
        }

        .margin-top {
            margin-top: 0.5rem;
        }

        .title {
            color: white;
            background: rgb(3, 46, 241);
            font-weight: bold;
        }

        .title.items {
            background: rgb(44, 130, 228);
        }

        .float-right {
            position: absolute;
            top: -2%;
            right: 0;
        }

        .mt {
            margin-top: 0.2rem;
        }
    </style>
</head>

<body>
    <div>
        <h1>Relátorio de retirada</h1>
        <div>
            <span>Centro médico:</span>
            <strong>São josé</strong>
        </div>
        <div class="float-right">
            <div>
                <span>Periódo:</span>
                <strong>{{ $periodo }}</strong>
            </div>
            <div>
                <span>Pesquisa:</span>
                <strong>{{ $value }}</strong>
            </div>
            <div class="mt">
                <span>Tipo:</span>
                <strong>{{ $tipo_impressao }}</strong>
            </div>
            <div class="mt">
                <span>Gerado a:</span>
                <strong>{{ date('Y-m-d') }}</strong>
            </div>
            <div class="mt">
                <span>Gerado por:</span>
                <strong>{{ Auth::user()->name }}</strong>
            </div>
        </div>
        <hr />
    </div>
    @if ($tipo_impressao != 'simplificada')
        @foreach ($retiradas as $retirada)
            <table class="conteiner-retiradas @if ($loop->index > 0) margin-top @endif">
                <thead>
                    <tr class="title">
                        <td colspan="6">Retirada</td>
                    </tr>
                    <tr class="subtitle">
                        <td>Médicamento</td>
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
                        <tr class="title items">
                            <td colspan="3">Items</td>
                        </tr>
                        <tr class="subtitle items">
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
                </table>
            @endif
        @endforeach
    @else
        <table class="conteiner-retiradas">
            <thead>
                <tr class="subtitle">
                    <td>Médicamento</td>
                    <td>Farmacêutico</td>
                    <td>Qtd(Inicial)</td>
                    <td>Qtd(Retirada)</td>
                    <td>Qtd(Stock)</td>
                    <td>Criado a</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($retiradas as $retirada)
                    <tr class="datas">
                        <td>{{ $retirada->medicamento->nome }}</td>
                        <td>{{ $retirada->user->name }}</td>
                        <td>{{ $retirada->quantidade_inicial }}</td>
                        <td>{{ $retirada->quantidade_retirada }}</td>
                        <td>{{ $retirada->quantidade_stock }}</td>
                        <td>{{ $retirada->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
