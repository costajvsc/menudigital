@extends('meta/_layout')

@section('title-page') Menu digital - Produtos @endsection
@section('main') 
        <table id="table_produtos" class="table text-center"></table>

        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modal-product" onclick="controller.clearForm()">
          Adicionar
        </button>

        <div class="modal fade" id="modal-product" tabindex="-1" role="dialog" aria-labelledby="modelExpand" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Informações produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <img src="" id="modal_img" class="img-fluid mb-2" alt="Responsive image">
                        <input type="hidden" name="id" id="id_produto">
                        <div class="form-group">
                            <label for="nome_produto">Nome do produto</label>
                            <input type="text" class="form-control field-edit" id="nome_produto" placeholder="Digite o nome do produto">
                        </div>

                        <div class="form-group ">
                            <label for="descricao">Descrição</label>
                            <textarea class="form-control field-edit" id="descricao" rows="3" placeholder="Descrição do produto"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="preco_produto">Valor do produto</label>
                            <input type="number" step="any" min=".01" class="form-control field-edit" id="preco_produto"  placeholder="9.99">
                        </div>

                        <div class="form-group">
                            <label for="categoria">Tipo de produto</label>
                            <select class="form-control field-edit" id="categoria">
                                <option value="bebida">Bebida</option>
                                <option value="entrada">Entrada</option>
                                <option value="principal">Prato principal</option>
                                <option value="sobremesa">Sobremesa</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status">Status do produto</label>
                            <select class="form-control field-edit" id="status">
                                <option value="ativo">Ativo</option>
                                <option value="inativo">Inativo</option>
                            </select>
                        </div>       

                        <div class="form-group">
                            <label for="img_produto">Imagem do produto</label>
                            <input type="file" class="form-control-file field-edit" id="img_produto">
                        </div>     
                    </div>

                    <div id="modal_footer" class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-compress-alt"></i>
                        </button>
                        <button type="button" class="btn btn-primary" onclick="toggleEditForm()">
                            <i id="edit" class="fas fa-pen"></i>
                        </button>
                        <button type="submit" class="btn btn-danger" >
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="/js/model/Produto.js"></script>
    <script src="/js/model/ProdutoList.js"></script> 
    <script src="/js/model/ProdutoForm.js"></script> 
    <script src="/js/view/ProdutoView.js"></script>
    <script src="/js/controller/ProdutoController.js"></script>
    <script>
        let controller = new ProdutoController()
    </script>
@endsection

