class CarrinhoForm{
    constructor(input_nome_cliente, input_email_cliente, input_cpf_cliente, input_telefone){
        this.input_nome_cliente = input_nome_cliente
        this.input_email_cliente = input_email_cliente
        this.input_cpf_cliente = input_cpf_cliente
        this.input_telefone = input_telefone
    }

    clear(){
        this.input_nome_cliente = ''
        this.input_email_cliente = ''
        this.input_cpf_cliente = ''
        this.input_telefone = ''
    }
}