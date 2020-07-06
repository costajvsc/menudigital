class ProdutoList{
    constructor(){
        this._lista = [];
    }

    push(produto){
        this._lista.push(produto)
    }

    pop(){
        this._lista = []
    }
    
    get produtos(){
        return this._lista;
    }
}