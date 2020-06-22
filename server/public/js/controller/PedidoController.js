class PedidoController{
    constructor(){
        let $ = document.querySelector.bind(document)
        this.view = new PedidoView($('#table_pedidos'), $('#modal_body'), $('#modal_footer'))
        this.lista = new PedidoList()
        this.form = $('#id_pedido')
        this.load()
    }

    load(){
        let url = `http://localhost:8000/api/pedidos`

        fetch(url,{ method: 'GET' }).then(response => {return response.json()})
        .then(data =>
        {
            this.lista.pop()
            data.forEach(e => this.lista.push(new Pedido(e.id_pedido, e.nome_cliente, e.cpf_cliente, e.email_cliente, e.telefone, 'Mesa 03' ,e.status, e.nome_funcionario)))
            this.view.table_update(this.lista.pedidos)
        })
    }

    fill(id_pedido){
        let url = `http://localhost:8000/api/pedidos/itens/${id_pedido}`
        fetch(url,{  
            method: 'GET',
        }).then(response => {
            if(!response.ok){
                swal("Um erro inesperado aconteceu!", {icon: "warning"})
                return
            }
            return response.json()
        }).then(data =>{
            let pedido = this.lista.pedidos.filter(item =>  item.id_pedido === id_pedido)
            let itens = data
            this.view.modal_update(pedido, itens)
        })

        
    }

    cancel(id_pedido){
        swal({
            title: `Deseja realmente concluir o pedido ${id_pedido}?`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willCancel) => {
            if (willCancel) 
            {
                let url = `http://localhost:8000/api/pedidos/cancel/${id_pedido}`

                fetch(url,{   method: 'PUT' }
                ).then(response => {
                    if(response.ok)
                    {
                        swal("Pedido cancelado com sucesso.", {icon: "success"})
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

    finish(id_pedido){
        swal({
            title: `Deseja realmente finalizar o pedido ${id_pedido}?`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willFinish) => {
            if (willFinish) 
            {
                let url = `http://localhost:8000/api/pedidos/finish/${id_pedido}`

                fetch(url,{   method: 'PUT' }
                ).then(response => {
                    if(response.ok)
                    {
                        swal("Pedido finalizado com sucesso.", {icon: "success"})
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