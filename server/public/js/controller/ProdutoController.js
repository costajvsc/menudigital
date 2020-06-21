class ProdutoController{
    constructor(){
        let $ = document.querySelector.bind(document)
        this.view = new ProdutoView($('#table_produtos'), $('#modal_title'), $('#modal_img') ,$('#modal_footer'))
        this.lista = new ProdutoList()
        this.form = new ProdutoForm()
        this.load(4)
    }

    load(){
        let url = `http://localhost:8000/api/produtos`

        fetch(url,{ method: 'GET' }).then(response => {return response.json()})
        .then(data =>
        {
            this.lista.pop()
            data.forEach(e => this.lista.push(new Produto(e.id_produto, e.nome_produto, e.descricao, e.preco, e.categoria, e.status, e.ext)))
            this.view.table_update(this.lista.produtos)
        })
    }
    
    clearForm(){
        this.view.modal_update('Adicionar Produto', 'create')
        this.form.clear()
    }

    create(){
        
        let url = `http://localhost:8000/api/produtos`
        
        let formData = new FormData()
        formData.append('nome_produto',this.form.input_nome_produto.value)
        formData.append('descricao', this.form.input_descricao.value)
        formData.append('preco', this.form.input_preco_produto.value)
        formData.append('categoria', this.form.input_categoria.value)
        formData.append('status', this.form.input_status.value)
        formData.append('img_produto', this.form.input_img_produto.files[0], this.form.input_img_produto.files[0].name)
        
        fetch(url,{  
            method: 'POST',
            body: formData
        }).then(response => {
            console.log(response)
            if(response.status == 201){
                swal("Produto inserido com sucesso.", {icon: "success"})
                this.load()
            }
            else{
                swal("Um erro inesperado aconteceu!", {icon: "warning"})
            }
        })
    }

    fill(id_produto){
        let url = `http://localhost:8000/api/produtos/${id_produto}`

        fetch(url,{  
            method: 'GET',
        }).then(response => {
            if(!response.ok){
                swal("Um erro inesperado aconteceu!", {icon: "warning"})
                return
            }
            return response.json()
        }).then(data =>{
            this.form.input_id_produto.value = data.id_produto
            this.form.input_nome_produto.value = data.nome_produto
            this.form.input_descricao.value = data.descricao
            this.form.input_preco_produto.value = data.preco
            this.form.input_categoria.value = data.categoria
            this.form.input_status.value = data.status == 1 ? 'ativo' : 'inativo'
            const url = `http://localhost:8000/img/produtos/${data.id_produto}.${data.ext}`
            this.view.modal_img.src = url
            this.view.modal_update('Editar produto Produto', 'update')
        })
    }
    update(){
        let url = `http://localhost:8000/api/produtos/${this.form.input_id_produto.value}`

        let formData = new FormData()
        formData.append('nome_produto', this.form.input_nome_produto.value)
        formData.append('descricao', this.form.input_descricao.value)
        formData.append('preco', this.form.input_preco_produto.value)
        formData.append('categoria', this.form.input_categoria.value)
        formData.append('status', this.form.input_status.value)
        if(this.form.input_img_produto.files[0])
            formData.append('img_produto', this.form.input_img_produto.files[0], this.form.input_img_produto.files[0].name)
        
        fetch(url,{  
            method: 'PUT',
            body: formData
        }).then(response => {
            if(response.status == 200){
                console.log(response)
                swal("Produto alterado com sucesso.", {icon: "success"})
                this.load()
            }
            else{
                swal("Um erro inesperado aconteceu!", {icon: "warning"})
            }
        })
    }
    delete(id_produto){
        swal({
            title: `Deseja realmente excluir o produto ${id_produto}?`,
            text: `Uma vez deletado o produto não estará mais disponível`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) 
            {
                let url = `http://localhost:8000/api/produtos/${id_produto}`

                fetch(url,{   method: 'DELETE' }
                ).then(response => {
                    if(response.ok)
                    {
                        swal("Produto deletado com sucesso.", {icon: "success"})
                        this.load()
                        return;
                    }
                    swal("Um erro inesperado aconteceu!", {icon: "warning"})
                })
            }
            else
            {
                swal("Operação cancelada!")
            }
        })
    }
}