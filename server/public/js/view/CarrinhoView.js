class CarrinhoView{
    constructor(element){
        this._element = element
    }

    modal_update(itens){
        this._element.innerHTML = `
        <ul class="list-group" id='list_pedido'>
            ${itens.map((m) => `<li class="list-group-item">${m.id_produto} - ${m.nome_produto} </li>`).join('')}
        </ul>
        `
    }

}