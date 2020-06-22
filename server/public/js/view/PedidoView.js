class PedidoView{
    constructor(table, modal_body, modal_footer){
        this._table = table
        this._modal_body = modal_body
        this._modal_footer = modal_footer
    }

    _template(model){
        return `
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome cliente</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Funcionario</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                ${model.map((m) => `
                    <tr>
                        <td>${m.id_pedido}</td>
                        <td>${m.nome_cliente}</td>
                        <td>${m.telefone}</td>
                        <td>${m.nome_funcionario}</td>
                        <td>
                            <i class="fas fa-pencil-alt text-info ml-2" data-toggle="modal" data-target="#modal-pedidos" onclick="controller.fill(${m.id_pedido})"></i>
                        </td>
                    </tr>
                `).join('')}
            </tbody>
        `
    }

    table_update(model){
        this._table.innerHTML = ''
        this._table.innerHTML = this._template(model)
    }

    modal_update(model, itens){
        console.log(itens)
        this._modal_body.innerHTML = `
        <input type="hidden" id="id_pedido" value="${model[0].id_pedido}"> 
        <h5>ID do Pedido</h5>
        <p id="id_pedido">#${model[0].id_pedido}</p>

        <h5>Nome do cliente</h5>
        <p id="nome_cliente">${model[0].nome_cliente}</p>
        
        <h5>Nome do cliente</h5>
        <p id="nome_cliente">${model[0].nome_funcionario}</p>

        <h5>CPF do cliente</h5>
        <p id="cpf_cliente">${model[0].cpf_cliente}</p>

        <h5>Email</h5>
        <p id="email_cliente">${model[0].email_cliente}</p>

        <h5>Telefone</h5>
        <p id="telefone">${model[0].telefone}</p>

        <h5>Mesa</h5>
        <p id="mesa">${model[0].mesa}</p>

        <h5>Lista de pedido</h5>
        <ul class="list-group" id='list_pedido'>
            ${itens.map((m) => `<li class="list-group-item">${m.id_produto} - ${m.nome_produto} </li>`).join('')}
        </ul>
        `
        
        this._modal_footer.innerHTML = `
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-times mr-1"></i>
            Fechar
        </button>
        <button type="button" class="btn btn-primary" onclick="controller.finish(${model[0].id_pedido})">
            <i class="fas fa-check-circle mr-1"></i>
            Finalizar
        </button>
        <button type="button" class="btn btn-danger" onclick="controller.cancel(${model[0].id_pedido})">
            <i class="fas fa-times mr-1"></i>
            Cancelar
        </button>
        `
    }
}