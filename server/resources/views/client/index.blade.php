<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Menu</title>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
  </head>
    
  <body>

    <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="#">Menu Digital</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" 
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
          <ul class="navbar-nav">
            <li><a class="nav-item nav-link" href="#Titulo-pratos">Pratos</a></li>
            <li><a class="nav-item nav-link" href="#Titulo-bebidas">Bebidas</a></li>
            <li><a class="nav-item nav-link" href="#Titulo-sobremesas">Sobremesas</a></li>
            <li><a class="nav-item nav-link" data-toggle="modal" data-target="#modal-pedido" href="#">Pedidos</a></li>
          </ul>
        </div>
      </nav>
    </header>

    <main>
      <div class="container">
      <section class="carrosel">
        <div id="carouselExampleCaptions" class="carousel slide" data-interval="3000" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="img/banner-bg.jpg" class="d-block w-100 imagem-carrossel1" alt="...">
              <div class="carousel-caption d-none d-md-block">
              </div>
            </div>
            <div class="carousel-item">
              <img src="img/res01.jpg" class="d-block w-100 imagem-carrossel2" alt="...">
              <div class="carousel-caption d-none d-md-block">
              </div>
            </div>
            <div class="carousel-item">
              <img src="img/res02.jpg" class="d-block w-100 imagem-carrossel3" alt="...">
              <div class="carousel-caption d-none d-md-block">
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </section>

            <section id="Titulo-pratos">
                <h1 class="text-left fonte-titulo cor-especial pt-3 mr-8">Entradas</h1>
            </section>
        
            <section class="container-fluid bg-light" id="Pratos">
                <div class="row justify-content-center">
                    @foreach($entrada as $e)
                    <article class="card borda-cor-especial card-largura p-0 m-4 col-12 col-md-4">
                        <img src="http://localhost:8000/img/produtos/{{$e->id_produto}}.{{$e->ext}}" class="card-img-top card-posicao-imagem" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$e->nome_produto}}</h5>
                            <p class="card-text">{{$e->descricao}}</p>
                            <h4 class="text-right fonte-titulo cor-especial ">R$: {{$e->preco}}</h4>
                            <buttom class="btn botao-cor-especial" onclick="controller.fill({{$e}})">Pedir</buttom>
                        </div>
                    </article>
                    @endforeach
                </div>
            </section>

            <section id="Titulo-pratos">
                <h1 class="text-left fonte-titulo cor-especial pt-3 mr-8">Pratos</h1>
            </section>
        
            <section class="container-fluid bg-light" id="Pratos">
                <div class="row justify-content-center">
                @foreach($principal as $p)
                    <article class="card borda-cor-especial card-largura p-0 m-4 col-12 col-md-4">
                        <img src="http://localhost:8000/img/produtos/{{$p->id_produto}}.{{$p->ext}}" class="card-img-top card-posicao-imagem" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$p->nome_produto}}</h5>
                            <p class="card-text">{{$p->descricao}}</p>
                            <h4 class="text-right fonte-titulo cor-especial ">R$: {{$p->preco}}</h4>
                            <buttom class="btn botao-cor-especial" onclick="controller.fill({{$p}})">Pedir</buttom>
                        </div>
                    </article>
                @endforeach
                </div>
            </section>

            <section id="Titulo-sobremesas">
                <h1 class="text-left fonte-titulo cor-especial pt-3 mr-8">Sobremesas</h1>
            </section>

            <section class="container-fluid bg-light" id="Sobremesas">
                <div class="row justify-content-center">
                    @foreach($sobremesa as $s)
                        <article class="card borda-cor-especial card-largura p-0 m-4 col-12 col-md-4">
                            <img src="http://localhost:8000/img/produtos/{{$s->id_produto}}.{{$s->ext}}" class="card-img-top card-posicao-imagem" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{$s->nome_produto}}</h5>
                                <p class="card-text">{{$s->descricao}}</p>
                                <h4 class="text-right fonte-titulo cor-especial ">R$: {{$s->preco}}</h4>
                                <buttom class="btn botao-cor-especial" onclick="controller.fill({{$s}})">Pedir</buttom>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            <section id="Titulo-bebidas">
                <h1 class="text-left fonte-titulo cor-especial pt-3 mr-8">Bebidas</h1>
            </section>

            <section class="container-fluid bg-light" id="Bebidas">
                <div class="row justify-content-center">
                    @foreach($bebida as $b)
                        <article class="card borda-cor-especial card-largura p-0 m-4 col-12 col-md-4">
                            <img src="http://localhost:8000/img/produtos/{{$b->id_produto}}.{{$b->ext}}" class="card-img-top card-posicao-imagem" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{$b->nome_produto}}</h5>
                                <p class="card-text">{{$b->descricao}}</p>
                                <h4 class="text-right fonte-titulo cor-especial ">R$: {{$b->preco}}</h4>
                                <buttom class="btn botao-cor-especial" onclick="controller.fill({{$b}})">Pedir</buttom>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
            <buttom class="btn botao-cor-especial mb-2" data-toggle="modal" data-target="#modal-pedido" onclick="controller.fillModal()">Carrinho</buttom>
        </div>
    </main> 
    
    <footer class="bg-secondary p-5">
        <h5 class="text-light m-0 text-center">Desenvolvedores: João Victor & Marcos Pimentel</h5>
    </footer>
    <div class="modal fade" id="modal-pedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lista de pedidos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>

                <div class="modal-body">
                    <form onsubmit="controller.create(event)">
                        <div class="form-group row">
                            <input type="text" class="form-control-plaintext" id="nome_cliente" placeholder="Digite seu nome" required>
                        </div>
                        <div class="form-group row">
                            <input type="email" class="form-control-plaintext" id="email_cliente" placeholder="email@example.com" required>
                        </div>
                        <div class="form-group row">
                            <input type="number" class="form-control-plaintext" id="cpf_cliente" placeholder="XXX.XXX.XXX-XX">
                        </div>
                        <div class="form-group row">
                            <input type="number" class="form-control-plaintext" id="telefone" placeholder="(XX) X XXXX-XXXX" required>
                        </div>
                        <input type="hidden" id="itens">
                        <h3>Listar pedidos</h3>
                        <div id="modal_itens">

                        </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger">Menu</button>
                    <button type="submit" class="btn btn-success">Realizar pedido</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" 
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" 
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" 
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>

    <script src="/js/model/Produto.js"></script>
    <script src="/js/model/ProdutoList.js"></script> 
    <script src="/js/model/CarrinhoForm.js"></script> 
    <script src="/js/view/CarrinhoView.js"></script> 
    <script src="/js/controller/CarrinhoController.js"></script>
    
    <script>
        let controller = new CarrinhoController()
    </script>
</html>