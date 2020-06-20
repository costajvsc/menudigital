<html>
</html>
<body>
    <h1>Pedido realizado com sucesso</h1>
    <p>Prezado {{$pedido->nome}} o seu pedido foi realizado!</p>
    <p><b>Numero do pedido:</b> {{$pedido->id_pedido}}</p>
    <h3>Produtos pedidos</h3>
    @foreach($itens as $i)
        <p><b>Item:</b> {{$i->nome_produto}}</p>
    @endforeach
</body>