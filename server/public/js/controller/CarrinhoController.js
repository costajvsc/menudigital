class CarrinhoController{
    constructor(){
        let $ = document.querySelector.bind(document)
        this.lista = new ProdutoList()
        this.view = new CarrinhoView($('#modal_itens'))
        this.form = new CarrinhoForm($('#nome_cliente'), $('#email_cliente'), $('#cpf_cliente'), $('#telefone'))
    }

    fill(produto){
        swal({
            title: `Deseja incluir este produto ${produto.nome_produto}?`
        })
        .then((addCard) => {
            if (addCard) 
            {
                this.lista.push(new Produto(produto.id_produto, produto.nome_produto, produto.descricao, produto.preco, produto.categoria, produto.status, produto.ext))
                swal("Produto inserido com sucesso!", {icon: "success"})
            }
            else
            {
                swal("Operação cancelada!")
            }
        })
    }

    create(event){
        event.preventDefault()
        if(this.lista.produtos.length === 0){
            return swal({
                title: "Carrinho vazio!",
                text: "Saco vazio não para em pé, acrescente algum item ao carrinho antes de adicionar!",
                icon: "warning",
            })
        }

        let url = `http://localhost:8000/api/pedidos`
        let formData = new FormData()
        formData.append('nome_cliente', this.form.input_nome_cliente.value)
        formData.append('cpf_cliente', this.form.input_cpf_cliente.value)
        formData.append('email_cliente', this.form.input_email_cliente.value)
        formData.append('telefone', this.form.input_telefone.value)
        formData.append('id_funcionario', 1)
        formData.append('itens', JSON.stringify(this.lista.produtos.map(item => item.id_produto)))


        fetch(url,{  
            method: 'POST',
            body: formData
        }).then(response => {
            if(!response.ok){
                swal("Um erro inesperado aconteceu!", {icon: "warning"})
                return
            }
            this.form.clear()
            this.lista.pop()
            return swal({
                title: "Pedido realizado!",
                text: "Em alguns instantes você receberá um email!",
                icon: "success",
            })
        })
    }

    fillModal(){
        this.view.modal_update(this.lista.produtos)
    }
}