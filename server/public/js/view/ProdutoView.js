class ProdutoView{
    constructor(element, modal_title, modal_img, modal_footer){
        this._element = element
        this._modal_footer = modal_footer
        this._modal_title = modal_title
        this.modal_img = modal_img
        this._modal_title = modal_title
    }

    _template(model){
        return `
            <thead>
                <tr>
                    <th scope="col">ID Produto</th>
                    <th scope="col">Nome produto</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                ${model.map((m) => `
                    <tr>
                        <td>${m.id_produto}</td>
                        <td>${m.nome_produto}</td>
                        <td>${m.preco}</td>
                        <td>
                            <i class="fas fa-pencil-alt text-info ml-2" data-toggle="modal" data-target="#modal-product" onclick="controller.fill(${m.id_produto})"></i>
                            <i class="far fa-trash-alt text-danger ml-2" onclick="controller.delete(${m.id_produto})"></i>
                        </td>
                    </tr>
                `).join('')}
            </tbody>
        `
    }

    table_update(model){
        this._element.innerHTML = ''
        this._element.innerHTML = this._template(model)
    }

    modal_update(title, option){
        this._modal_title.innerHTML = title
        
        this._modal_footer.innerHTML = `
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-times mr-1"></i>
            Fechar
        </button>
        <button type="button" id="submit" class="btn btn-primary" onclick="controller.${option}()">
            <i class="far fa-save mr-1"></i>
            Salvar
        </button>
        `
    }

}