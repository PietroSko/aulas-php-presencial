$(document).ready(function() {
    let resposta = false;

    $("input[name=cep]").mask("00000-000");
    $("input[name=numero]").mask("n",{
        translation: {
            'n':{
                pattern: /[0-9]/,
                recursive: true
            }
        }
    });
    
    $("input[name=telefone]").mask("(00) 00000-0000");
    $('input[name=telefone]').on('keyup',function(){   
        let telefone = $("input[name=telefone]").val();
        telefone = telefone.replace(/[\D]/g,'');

        if (telefone.length < 11) {
            mascara = '(00) 0000-00000';
        } else {
            mascara = '(00) 00000-0000';
        }

        $("input[name=telefone]").mask(mascara);
    });    

    const urlEstados = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados?orderBy=nome';

    $.getJSON(urlEstados, function(data) {
        data.forEach(function(estado) {
            $('#estado').append(`<option value="${estado.sigla}">${estado.nome}</option>`);
        });
    });

    $("form").on("submit", function(event){
        $("form input").prop("disabled", false);
        $("form select").prop("disabled", false);

    });
    
    $("input[name=cep]").on("keyup", function(event){
        let cep = $("input[name=cep]").val();
        cep = cep.replace("-", "");
        if(cep.length == 8){
            $("input[name=cep]").removeClass("is-invalid");
            
            $.ajax({url: "https://viacep.com.br/ws/"+ cep +"/json", dataType: "text"})
                .done(function(data){
                    resposta = JSON.parse(data); // Removed JSON.parse since data is already parsed
                    if(resposta.erro){
                        $("input[name=cep]").addClass("is-invalid");
                    }else{
                        $("input[name=rua]").val(resposta.logradouro);
                        if(resposta.logradouro !== "") {
                            $("input[name=rua]").prop("disabled", true);
                        }
                        $("input[name=bairro]").val(resposta.bairro);
                        if(resposta.bairro !== "") {
                            $("input[name=bairro]").prop("disabled", true);
                        }
                        $("select[name=estado]").val(resposta.uf);
                        $("select[name=estado]").trigger("change");
                        $("input[name=complemento]").val(resposta.complemento);
                        $("select[name=estado]").prop("disabled", true);
                        $("select[name=cidade]").prop("disabled", true);
                    }
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    resposta = { "erro": true };
                    $("input[name=cep]").addClass("is-invalid");
                });
            
        } else {
            $("input[name=rua]").prop("disabled", false);
            $("input[name=rua]").val("");
            $("input[name=bairro]").prop("disabled", false);
            $("input[name=bairro]").val("");
            $("select[name=cidade]").prop("disabled", false);
            $("select[name=cidade]").val("");
            $("select[name=estado]").prop("disabled", false);
            $("select[name=estado]").val("");
        }
    });

    $('#estado').on('change', function() {
        let estadoId = $(this).val();

        if (estadoId) {
            const urlCidades = `https://servicodados.ibge.gov.br/api/v1/localidades/estados/${estadoId}/municipios`;

            $.getJSON(urlCidades, function(data) {
                $('#cidade').empty();
                $('#cidade').append(`<option value="">Selecione a cidade</option>`);

                data.sort(function(a, b) {
                    return a.nome.localeCompare(b.nome);
                });

                data.forEach(function(cidade) {
                    $('#cidade').append(`<option value="${cidade.nome}">${cidade.nome}</option>`);
                });

                if (!resposta.erro && resposta.uf == $("select[name=estado]").val()) {
                    $("select[name=cidade]").val(resposta.localidade);
                }
            });
        } else {
            $('#cidade').empty();
            $('#cidade').append(`<option value="">Primeiro selecione o estado</option>`);
        }
    });
});