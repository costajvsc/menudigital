@extends('meta/_layout')

@section('title-page') Menu digital - Produtos @endsection
@section('main') 
        <table id="table_pedidos" class="table text-center"></table>        

        <div class="modal fade" id="modal-pedidos" tabindex="-1" role="dialog" aria-labelledby="modelExpand" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Informações pedido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div id="modal_body" class="modal-body">
                        <input type="hidden" id="id_pedido"> 
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
    <script src="/js/model/Pedido.js"></script>
    <script src="/js/model/PedidoList.js"></script> 
    <script src="/js/model/PedidoForm.js"></script> 
    <script src="/js/view/PedidoView.js"></script>
    <script src="/js/controller/PedidoController.js"></script>
    <script>
        let controller = new PedidoController()
    </script>
@endsection

