$(function(){
	$("#wizard").steps({
        headerTag: "h4",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: false,
        enablePagination: false,
        transitionEffectSpeed: 250,
        labels: {
            current: ""
        },
        onStepChanging: function (event, currentIndex, newIndex) {
            if (newIndex < currentIndex) {
				return true;
			}

            validated = true;
            if(personal){
				switch(currentIndex + 1){
					case 2:
						$('.required-step2').each(function( index ) {
							$(this).css('border-color', '#ced4da');
							if(!$(this).val()){
								$(this).attr('type') != "file" ? $(this).css('border-color', 'red') : $(this).css('color', 'red');
                                validated = false;
							}
						});
						break;
					case 3:
						$('.required-step2').each(function( index ) {
							$(this).css('border-color', '#ced4da');
							if(!$(this).val()){
								$(this).attr('type') != "file" ? $(this).css('border-color', 'red') : $(this).css('color', 'red');
								validated = false;
							}
						});
						$('.required-step3').each(function( index ) {
							$(this).css('border-color', '#ced4da');
							if(!$(this).val()){
								$(this).attr('type') != "file" ? $(this).css('border-color', 'red') : $(this).css('color', 'red');
								validated = false;
							}
						});
						break;
				}
			}
			else if(empresa){
				switch($("#wizard").steps("getCurrentIndex") + 1) {
					case 2:
						$('.required-step2').each(function( index ) {
							$(this).css('border-color', '#ced4da');
							if($(this).hasClass('email')){
								if( !validateEmail($(this).val())) {
									$(this).attr('type') != "file" ? $(this).css('border-color', 'red') : $(this).css('color', 'red');
									validated = false;
								}
							}

							if($(this).hasClass('integer')){
								if( !isNumber($(this).val()) ) {
									$(this).attr('type') != "file" ? $(this).css('border-color', 'red') : $(this).css('color', 'red');
									validated = false;
								}
							}

							if(!$(this).val()){
								$(this).attr('type') != "file" ? $(this).css('border-color', 'red') : $(this).css('color', 'red');
								validated = false;
							}
						});
						break;
					case 3:
						$('.required-step2').each(function( index ) {
							$(this).css('border-color', '#ced4da');
							if($(this).hasClass('email')){
								if( !validateEmail($(this).val())) {
									$(this).attr('type') != "file" ? $(this).css('border-color', 'red') : $(this).css('color', 'red');
									validated = false;
								}
							}

							if(!$(this).val()){
								$(this).attr('type') != "file" ? $(this).css('border-color', 'red') : $(this).css('color', 'red');
								validated = false;
							}
						});
						$('.required-step3').each(function( index ) {
							$(this).css('border-color', '#ced4da');
							if(!$(this).val()){
								$(this).attr('type') != "file" ? $(this).css('border-color', 'red') : $(this).css('color', 'red');
								validated = false;
							}
						});
						break;
					case 4:
						$('.required-step2').each(function( index ) {
							$(this).css('border-color', '#ced4da');
							if($(this).hasClass('email')){
								if( !validateEmail($(this).val())) {
									$(this).attr('type') != "file" ? $(this).css('border-color', 'red') : $(this).css('color', 'red');
									validated = false;
								}
							}

							if(!$(this).val()){
								$(this).attr('type') != "file" ? $(this).css('border-color', 'red') : $(this).css('color', 'red');
								validated = false;
							}
						});
						$('.required-step3').each(function( index ) {
							$(this).css('border-color', '#ced4da');
							if(!$(this).val()){
								$(this).attr('type') != "file" ? $(this).css('border-color', 'red') : $(this).css('color', 'red');
								validated = false;
							}
						});
						$('.required-step4').each(function( index ) {
							$(this).css('border-color', '#ced4da');
							if(!$(this).val()){
								$(this).attr('type') != "file" ? $(this).css('border-color', 'red') : $(this).css('color', 'red');
								validated = false;
							}
						});
						break;
					case 5:
						$('.required-step2').each(function( index ) {
							$(this).css('border-color', '#ced4da');
							if($(this).hasClass('email')){
								if( !validateEmail($(this).val())) {
									$(this).attr('type') != "file" ? $(this).css('border-color', 'red') : $(this).css('color', 'red');
									validated = false;
								}
							}

							if(!$(this).val()){
								$(this).attr('type') != "file" ? $(this).css('border-color', 'red') : $(this).css('color', 'red');
								validated = false;
							}
						});
						$('.required-step3').each(function( index ) {
							$(this).css('border-color', '#ced4da');
							if(!$(this).val()){
								$(this).attr('type') != "file" ? $(this).css('border-color', 'red') : $(this).css('color', 'red');
								validated = false;
							}
						});
						$('.required-step4').each(function( index ) {
							$(this).css('border-color', '#ced4da');
							if(!$(this).val()){
								$(this).attr('type') != "file" ? $(this).css('border-color', 'red') : $(this).css('color', 'red');
								validated = false;
							}
						});
						$('.required-step5:not(":disabled")').each(function( index ) {
							$(this).css('border-color', '#ced4da');
							if(!$(this).val()){
								$(this).attr('type') != "file" ? $(this).css('border-color', 'red') : $(this).css('color', 'red');
								validated = false;
							}
						});
						if ($('input[name="more_participacion"]').is(':checked') === false) {
							$('#beneficiarios_questao_2_required').show();
							validated = false;
						}
						if ($('input[name="no_participacion"]').is(':checked') === false) {
							$('#beneficiarios_questao_1_required').show();
							validated = false;
						}
						break;
				}
			}

            return validated;
        },
    });

    // Custome Button Jquery Step
    $(document).on('click', '.forward', function(e){
        $("#wizard").steps('next');
    })

    // Select Dropdown
    $('html').click(function() {
        $('.select .dropdown').hide(); 
    });
    $('.select').click(function(event){
        event.stopPropagation();
    });
    $('.select .select-control').click(function(){
        $(this).parent().next().toggle();
    })    
    $('.select .dropdown li').click(function(){
        $(this).parent().toggle();
        var text = $(this).attr('rel');
        $(this).parent().prev().find('div').text(text);
    })
})


