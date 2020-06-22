class PedidoList{
    constructor(){
        this.lista = []
    }

    pop(){
        this.lista = []
    }

    push(pedido){
        this.lista.push(pedido)
    }

    get pedidos(){
        return this.lista
    }
}