$(document).ready(function() {
    $('.error').hide();
    $('.delete_survey').popup();
    $('.revise_survey').popup();
    $('.add_question_discursive_button').popup();
    $('.add_question_button').popup();

    var form = $(".title");

    $('.delete_survey').click(function(){
        $('.page.dimmer').dimmer('toggle');
    });

    $('.closeDimmer').click(function(){
        $('.page.dimmer').dimmer('toggle');
    });

    $(".add_question_button").click(function(e){

        var cursor = $("input[name^='question']").length;

        e.preventDefault();
        $(form).append(
            '<div> ' +
                '<div class="ui fluid action input field">' +
                    '<input type="text" name="question['+cursor+']" placeholder="digite aqui sua questão"/>' +
                    '<button href="#" class="remove_question ui red right labeled icon button">' +
                        '<i class="icon remove"></i>' +
                        'Remover questão' +
                    '</button>' +
                '</div>' +
                '<div class="ui fluid input field left labeled">' +
                    '<div class="ui label teal">primeira alternativa</div>' +
                    '<input type="text" name="alternative['+cursor+'][1]" placeholder="primeira alternativa"/>' +
                '</div>' +
                '<div class="ui fluid input field left labeled">' +
                    '<div class="ui label teal">segunda alternativa</div>' +
                    '<input type="text" name="alternative['+cursor+'][2]" placeholder="segunda alternativa"/>' +
                '</div>' +
                '<div class="ui fluid input field left labeled">' +
                    '<div class="ui label teal">terceira alternativa</div>' +
                    '<input type="text" name="alternative['+cursor+'][3]" placeholder="terceira alternativa"/>' +
                '</div>' +
                '<div class="ui field">' +
                    '<div class="ui divider"></div>' +
                '</div>' +
            '</div>');
    });

    $(".add_question_discursive_button").click(function(e){
        e.preventDefault();
        $(form).append(
            '<div> ' +
                '<div class="ui fluid action input field">' +
                    '<input type="text" name="mytext[]" placeholder="digite aqui sua questão"/>' +
                    '<button href="#" class="remove_question ui red right labeled icon button">' +
                        '<i class="icon remove"></i>' +
                        'Remover questão' +
                    '</button>' +
                '</div>' +
                '<div class="ui field">' +
                    '<div class="ui divider"></div>' +
                '</div>' +
            '</div>');
    });

    $('.revise_survey').click(function(){
        // titulo da enquete
        var surveyName = $('.title').val();

        // inicializando variáveis
        var questions = [];
        var alternatives = [];
        var actualQuestion = null;

        // iteração de questões
        $("input[name^='question']").each(function(index){
            actualQuestion = index;

            // cada 'actualQuestion' é uma questão
            questions[actualQuestion] = [];

            // a posição 0 corresponde ao enunciado da questão
            questions[actualQuestion][0] = $(this).val();

            // a posição 1 corresponde a um array com as alternativas
            questions[actualQuestion][1] = [];

            // guardando as alternativas dentro de suas respectivas questões
            $("input[name^='alternative["+index+"]']").each(function(indexToo){
                questions[actualQuestion][1][indexToo] =  $(this).val();
            });
        });

        // chamada ajax
        $.ajax({
            url: "/save_survey",
            method: 'POST',
            data: {
                title: surveyName,
                questions: questions
            }
        }).done(function(data) {
            if(data.success == 'true'){
                window.location.replace("/");
            }
        });

    });

    $(form).on("click",".remove_question", function(e){
        e.preventDefault(); $(this).parent('div').parent('div').remove();
    })
});
