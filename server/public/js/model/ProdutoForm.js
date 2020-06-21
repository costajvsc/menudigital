class ProdutoForm{
    constructor(){
        let $ = document.querySelector.bind(document)
        this.input_id_produto = $('#id_produto')
        this.input_nome_produto = $('#nome_produto')
        this.input_descricao = $('#descricao')
        this.input_preco_produto = $('#preco_produto')
        this.input_categoria = $('#categoria')
        this.input_status = $('#status')
        this.input_img_produto = $('#img_produto')
    }

    clear(){
        this.input_id_produto.value = ''
        this.input_nome_produto.value = ''
        this.input_descricao.value = ''
        this.input_preco_produto.value = ''
        this.input_categoria.value = ''
        this.input_categoria.value = ''
        this.input_status.value = ''
        this.input_img_produto.value = ''
    }
}