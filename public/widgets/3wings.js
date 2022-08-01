$(document).ready(function() {
    let BASE = $('meta[name="base"]').attr('content');
	//DEFINE HEADERS DO AJAX
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

    //FAZ LOGIN
	$('form[name="FormAutenticacao"]').submit(function(event){
		event.preventDefault();
		const action = $(this).attr('action');
		const Form = $(this);
		//SUBMIT DO FORMULÁRIO COM AJAX
		Form.ajaxSubmit({
			url: action,
			type: 'POST',
			dataType: 'json',
			beforeSubmit: function() {},
			uploadProgress: function(evento, posicao, total, completo) {},
			success: function(res) {
				//REDIRECIONA
				if(res.resposta.redirect) {
					setTimeout(function(){
						window.location.href = res.resposta.redirect;
					}, 1000);
				}
				//MONTA TOAST E EXIBE USANDO A FUNCÃO
				if(res.resposta.toast) {
					ToastPresent(
						res.resposta.toast.mensagem,
						res.resposta.toast.classe,
						res.resposta.icone,
						3000
					);
				}
			},
			error: function(){
				//FECHA LOADING
				$('.ub-loading').fadeOut(5000);
				ToastPresent(
					'Ocorreu uma falha na conexão, atualize página e tente novamente...',
					'error',
					'icon',
					15000
				);
			}
		})
	});

	//FAZ LOGOUT
	$('.js_logout').click(function(event){
		event.preventDefault();

		//ACIONA O LOGOUT
		$.ajax({
		    type: "POST",
		    url: 'http://127.0.0.1:8000/logout',
		    data: '',
		    dataType: "json",
		    success: function(res) {
				//REDIRECIONA
				if(res.resposta.redirect) {
					setTimeout(function(){
						window.location.href = res.resposta.redirect;
					}, 1000);
				}
				//MONTA TOAST E EXIBE USANDO A FUNCÃO
				if(res.resposta.toast) {
					ToastPresent(
						res.resposta.toast.mensagem,
						res.resposta.toast.classe,
						res.resposta.icone,
						5000
					);
				}
		    },
		    error: function(){
				ToastPresent(
					'Ocorreu uma falha na conexão, atualize a página e tente novamente...',
					'error',
					'icon',
					15000
				);
            }
		});

	});

    //CADASTRO DE ENQUETES
    $('form[name="FormCadastroCompromisso"]').submit(function(event){
        event.preventDefault();
        const action = $(this).attr('action');
        const Form = $(this);
        //SUBMIT DO FORMULÁRIO COM AJAX
        Form.ajaxSubmit({
            url: action,
            type: 'POST',
            dataType: 'json',
            beforeSubmit: function() {},
            uploadProgress: function(evento, posicao, total, completo) {},
            success: function(res){
                console.log('deu certo');
                if(res.resposta.data.INSERT === true){
                    // ADICIONA HTML
                    if(res.resposta.data.HTML_COMPROMISSO){
                        $('.js_add_compromisso').prepend(res.resposta.data.HTML_COMPROMISSO);
                    }
                    //FECHA MODAL
                    $('#modalForm').modal('hide');
                }
                //MONTA TOAST E EXIBE USANDO A FUNCÃO
                if(res.resposta.toast) {
                    ToastPresent(
                        res.resposta.toast.mensagem,
                        res.resposta.toast.classe,
                        res.resposta.icone,
                        5000
                    );
                }
            },
            error: function(){
                console.log('deu errado');
                //FECHA LOADING
                $('.ub-loading').fadeOut(5000);
                ToastPresent(
                    'Ocorreu uma falha na conexão, atualize página e tente novamente...',
                    'error',
                    'icon',
                    15000
                );
            }
        })
    });

    //VOTACAO
    $('form[name="FormVotacao"]').submit(function(event){
        event.preventDefault();

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'Tem certeza?',
            text: "Você não será capaz de reverter isso!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Confirmar voto!',
            cancelButtonText: 'Cancelar voto!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const action = $(this).attr('action');
                const Form = $(this);
                //SUBMIT DO FORMULÁRIO COM AJAX
                Form.ajaxSubmit({
                    url: action,
                    type: 'POST',
                    dataType: 'json',
                    beforeSubmit: function() {},
                    uploadProgress: function(evento, posicao, total, completo) {},
                    success: function(res){
                        console.log('deu certo');
                        if(res.resposta.data.insert === false){
                            if(res.resposta.toast) {
                                ToastPresent(
                                    res.resposta.toast.mensagem,
                                    res.resposta.toast.classe,
                                    res.resposta.icone,
                                    5000
                                );
                            }
                        }
                        if(res.resposta.data.insert === true){
                            swalWithBootstrapButtons.fire(
                            'Confirmado!',
                            'Seu voto foi contabilizado.',
                            'success'
                            )
                            //REDIRECIONA
                            if(res.resposta.redirect) {
                                setTimeout(function(){
                                    window.location.href = res.resposta.redirect;
                                }, 1000);
                            }
                        }
                    },
                    error: function(){
                        console.log('deu errado');
                        //FECHA LOADING
                        $('.ub-loading').fadeOut(5000);
                        ToastPresent(
                            'Ocorreu uma falha na conexão, atualize página e tente novamente...',
                            'error',
                            'icon',
                            15000
                        );
                    }
                })
            } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelado',
                'Seu voto não foi contabilizado.',
                'error'
                )
            }
        }) 
    });

    $("body").on("click", ".js_visualizar_compromisso", function(event){
		event.preventDefault();
		$('#js_modal_preview_compromisso').slideToggle(300);
		//REMOVE O DISPLAY NONE DO LOUDING CASO EXISTA
		if(document.querySelector('#js_loading_modal_preview_compromisso').classList.contains("d-none") === true){
			$('#js_loading_modal_preview_compromisso').removeClass('d-none');
		}
		if(document.querySelector('#js_modal_preview_compromisso').classList.contains("d-none") === false){
			document.querySelector('#js_modal_preview_compromisso').classList.add("d-none");
		}
		//DETERMINA O ID DA FICHA
		let ID = $(this).data('id');
		$.ajax({
			url: 'http://127.0.0.1:8000/preview-compromisso',
			type: "POST",
			dataType: "json",
			data: {ID: ID},
			success: function(res){
                console.log("deu certo")
				if(res.resposta.data.COMPROMISSO_VALIDO === true){
					document.querySelector('#js_loading_modal_preview_compromisso').classList.add("d-none");
					$('.js_dados_compromisso_add').html(res.resposta.data.HTML_PREVIEW_COMPROMISSO);
					if(document.querySelector('#js_modal_preview_compromisso').classList.contains("d-none") === true){
						$('#js_modal_preview_compromisso').removeClass('d-none');
						$('#js_modal_preview_compromisso').slideToggle(400);
					}
				}
			},
			error: function(){
                console.log("deu errado")
				ToastPresent('Ocorreu uma falha de conexão, atualize a página e tente novamente...',
				'error',
				'icon',
				5000);
			}
		});
    });

	$("body").on("click", ".js_compromisso_feito", function(event){
		event.preventDefault();
		let ID = $(this).data('id');
		const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-primary',
				cancelButton: 'btn btn-danger'
			},
			buttonsStyling: false
		})
		//MODAL PARA A CONFIRMAÇAO DA EXCLUSÃO
		swalWithBootstrapButtons.fire({
			title: 'Concluir Compromisso',
			text: "Você tem certeza que deseja concluir esse compromisso?",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Concluir',
			cancelButtonText: 'Cancelar',
			reverseButtons: true
		}).then((res) => {
			//SE CONFIRMAR A EXCLUSÃO
			if(res.isConfirmed) {
				$.ajax({
					url: 'http://127.0.0.1:8000/concluir-compromisso',
					type: "POST",
					dataType: "json",
					data: {ID: ID},
					success: function(res){
						console.log('deu certo');
						//ABRE O SWEET ALERT DE SUCESSO
						if(res.resposta.data.SWAL_SUCESSO === true){
                            $('.compromisso_' + ID).remove();

                            // ADICIONA HTML
                            if(res.resposta.data.HTML_COMPROMISSO_CONCLUIDO){
                                $('.js_add_compromisso_concluido').prepend(res.resposta.data.HTML_COMPROMISSO_CONCLUIDO);
                            }

							swalWithBootstrapButtons.fire(
								'Sucesso',
								'Compromisso concluído com sucesso!',
								'success'
							)
						}
					},
					error: function(){
						console.log('deu errado');
						ToastPresent('Ocorreu uma falha de conexão, atualize a página e tente novamente...',
						'error',
						'icon',
						5000);
					}
				});
			} else if(res.dismiss === Swal.DismissReason.cancel){
				swalWithBootstrapButtons.fire(
					'Cancelado',
					'O compromisso não foi concluido!',
					'error'
				)
			}
		})
	});

    $("body").on("click", ".js_cancelar_compromisso", function(event){
		event.preventDefault();
		let ID = $(this).data('id');
		const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-primary',
				cancelButton: 'btn btn-danger'
			},
			buttonsStyling: false
		})
		//MODAL PARA A CONFIRMAÇAO DA EXCLUSÃO
		swalWithBootstrapButtons.fire({
			title: 'Cancelar Compromisso',
			text: "Você tem certeza que deseja cancelar esse compromisso?",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Sim, cancelar!',
			cancelButtonText: 'Não',
			reverseButtons: true
		}).then((res) => {
			//SE CONFIRMAR A EXCLUSÃO
			if(res.isConfirmed) {
				$.ajax({
					url: 'http://127.0.0.1:8000/cancelar-compromisso',
					type: "POST",
					dataType: "json",
					data: {ID: ID},
					success: function(res){
						console.log('deu certo');
						//ABRE O SWEET ALERT DE SUCESSO
						if(res.resposta.data.SWAL_SUCESSO === true){
                            $('.compromisso_' + ID).remove();
							swalWithBootstrapButtons.fire(
								'Sucesso',
								'Compromisso cancelado com sucesso!',
								'success'
							)
						}
					},
					error: function(){
						console.log('deu errado');
						ToastPresent('Ocorreu uma falha de conexão, atualize a página e tente novamente...',
						'error',
						'icon',
						5000);
					}
				});
			} else if(res.dismiss === Swal.DismissReason.cancel){
				swalWithBootstrapButtons.fire(
					'Cancelado',
					'O compromisso não foi cancelado!',
					'error'
				)
			}
		})
	});

    //MASCARAS
    $(".js-mask-data-hora").mask("00/00/0000 00:00");

});

/*
	FUNCÕES DE HELPER
*/
function ToastPresent(mensagem, classe, icone, duracao){
	toastr.options = {
       "closeButton": false,
       "debug": true,
       "newestOnTop": true,
       "progressBar": false,
       "positionClass": "toast-top-center",
       "preventDuplicates": false,
       "onclick": null,
       "showDuration": "1000",
       "hideDuration": "1000",
       "timeOut": duracao,
       "extendedTimeOut": "1000",
       "showEasing": "swing",
       "hideEasing": "linear",
       "showMethod": "slideDown",
       "hideMethod": "slideUp"
   }
   toastr[classe](mensagem);
}


